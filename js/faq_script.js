const FaqInputs = document.getElementById("faq_inputs");
const FaqTextArea = document.getElementById("faq_textarea");

function addQuestion() {
  let question = document.createElement("input");
  let answer = document.createElement("textarea");

  question.setAttribute("class", `col-12 faq-question form-control`);
  answer.setAttribute("class", `col-12 faq-answer form-control`);

  question.addEventListener("input", generateFaqJSON);
  answer.addEventListener("input", generateFaqJSON);
  FaqInputs.appendChild(question);
  FaqInputs.appendChild(answer);
}

function generateFaqJSON() {
  FaqTextArea.value = "";
  let questions = document.querySelectorAll(".faq-question");
  let answers = document.querySelectorAll(".faq-answer");
  let QuestionArr = [];
  questions.forEach((question, index) => {
    let QuestionObj = {
      question: questions[index].value,
      answer: answers[index].value,
    };
    QuestionArr.push(QuestionObj);
  });
  FaqTextArea.value = JSON.stringify(QuestionArr);
}

function generateFaqInputsFromJSON(data, target) {
  let datajson = JSON.parse(document.getElementById(data).value);

  if (!datajson) {
    return;
  }

  let targetEle = document.getElementById(target);

  datajson.forEach((question, index) => {
    let questionInp = document.createElement("input");
    let answerInp = document.createElement("textarea");

    questionInp.setAttribute("class", `col-12 faq-question form-control`);
    answerInp.setAttribute("class", `col-12 faq-answer form-control`);

    questionInp.addEventListener("input", generateFaqJSON);

    answerInp.addEventListener("input", generateFaqJSON);

    questionInp.setAttribute("value", `${question.question}`);

    answerInp.value = question.answer;

    targetEle.appendChild(questionInp);
    targetEle.appendChild(answerInp);
  });
}

generateFaqInputsFromJSON("faq_textarea", "faq_inputs");
