const FaqInputs = document.getElementById("faq_inputs");
const FaqTextArea = document.getElementById("faq_textarea");

function addQuestion() {
  let questiongroup = document.createElement("div");
  let question = document.createElement("input");
  let answer = document.createElement("textarea");

  questiongroup.setAttribute("ID", "question_group");

  question.setAttribute("class", `col-6 faq-question form-control mb-1`);
  question.setAttribute("Placeholder", `Question`);

  answer.setAttribute("class", `col-6 faq-answer form-control mb-3`);
  answer.setAttribute("Placeholder", `Answer`);

  question.addEventListener("input", generateFaqJSON);
  answer.addEventListener("input", generateFaqJSON);
  questiongroup.appendChild(question);
  questiongroup.appendChild(answer);
  FaqInputs.appendChild(questiongroup);
}
function removeQuestion() {
  let questionsgrp = document.querySelectorAll("#question_group");

  const lastquestionsgrp = questionsgrp[questionsgrp.length - 1];

  lastquestionsgrp.remove();

  generateFaqJSON();
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
    let questiongroup = document.createElement("div");
    let questionInp = document.createElement("input");
    let answerInp = document.createElement("textarea");

    questiongroup.setAttribute("ID", "question_group");

    questionInp.setAttribute("class", `col-12 faq-question form-control mb-1`);
    questionInp.setAttribute("Placeholder", `Question`);

    answerInp.setAttribute("class", `col-12 faq-answer form-control mb-3`);
    answerInp.setAttribute("Placeholder", `Answer`);

    questionInp.addEventListener("input", generateFaqJSON);

    answerInp.addEventListener("input", generateFaqJSON);

    questionInp.setAttribute("value", `${question.question}`);

    answerInp.value = question.answer;
    questiongroup.appendChild(questionInp);
    questiongroup.appendChild(answerInp);
    targetEle.appendChild(questiongroup);
  });
}

generateFaqInputsFromJSON("faq_textarea", "faq_inputs");
