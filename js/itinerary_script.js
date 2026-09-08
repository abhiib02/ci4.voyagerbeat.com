/*------------------ itinerary script -------------------------*/

let itinerary = document.querySelector('#add-package-itinerary');

let day_inputs = document.querySelector('#day_inputs');

let gcount = 0;

document.addEventListener('DOMContentLoaded', function () {

    gcount = document.querySelectorAll(".dayTitle").length;

});





function addDay() {

    let dayTitle = document.createElement("input");

    let dayDesc = document.createElement("textarea");

    const editorId = `day_editor_${gcount}`;
    
    dayDesc.id = editorId;

    dayTitle.setAttribute('class', `col-lg-4 col-md-4 col-sm-4 dayTitle autosize  form-control my-2`);

    dayDesc.setAttribute('class', `col-lg-8 col-md-8 col-sm-8 dayDesc autosize materialize-textarea`);

    dayTitle.setAttribute('PLACEHOLDER', `Day ${gcount}`);

    dayDesc.setAttribute('PLACEHOLDER', `Day ${gcount} Desc`);

    dayTitle.addEventListener("input", generateItinerary);

        dayDesc.addEventListener("input", generateItinerary);

    day_inputs.appendChild(dayTitle);

    day_inputs.appendChild(dayDesc);

// Initialize TinyMCE on the newly created textarea ID
    tinymce.init({
        selector: `#${editorId}`,
        height: 200,
        menubar: false,
        plugins: 'lists link code',
        toolbar: 'undo redo | bold italic | bullist numlist | link code',
        setup: function (editor) {
            // Trigger generateItinerary whenever content inside TinyMCE changes
            editor.on('change keyup input', function () {
                editor.save(); // Syncs TinyMCE content back to the hidden <textarea>
                generateItinerary();
            });
        }
    });

    gcount++;

}



function removeDay() {

    let dayTitles = document.querySelectorAll(".dayTitle");

    let dayDescs = document.querySelectorAll(".dayDesc");

    const lastTitle = dayTitles[dayTitles.length - 1];
    const lastDesc = dayDescs[dayDescs.length - 1];
     // Remove TinyMCE instance first
    const editor = tinymce.get(lastDesc.id);
    if (editor) {
        editor.remove();
    }

    lastTitle.remove();
    lastDesc.remove();

    generateItinerary();



}



function generateItinerary() {

    itinerary.value = "";

    let dayTitles = document.querySelectorAll('.dayTitle');

    let dayDescs = document.querySelectorAll('.dayDesc');

    gcount = dayTitles.length;

    let DaysArr = [];



    dayTitles.forEach((day, index) => {

        let DayObj = {

            dayTitle: dayTitles[index].value,

            dayDesc: dayDescs[index].value,

        };

        DaysArr.push(DayObj);

    })



    itinerary.value = JSON.stringify(DaysArr);

}



function getDaysList(id, method = 1) {

    let DaysListStr;

    if (method == 0) {

        DaysListStr = document.getElementById(id).textContent;

    }

    if (method == 1) {

        DaysListStr = document.getElementById(id).value;

    }



    if (DaysListStr == "") {

        return '';

    }

    let days_data = convertStringtoJSON(DaysListStr);

    return days_data;

};



function generateItineraryInputsFromData(data, target) {
    
    if (!data) {

        return;

    }

    let targetEle = document.getElementById(target);

    data.forEach((day, index) => {

        let dayTitle = document.createElement("input");

        let dayDesc = document.createElement("textarea");

        const editorId = `day_editor_${index}`;
        dayDesc.id = editorId;

        dayTitle.setAttribute('class', `col-lg-4 col-md-4 col-sm-4 dayTitle autosize form-control my-2`);

        dayTitle.setAttribute('data-day', `${index}`);

        dayDesc.setAttribute('class', `col-lg-8 col-md-8 col-sm-8 dayDesc autosize materialize-textarea tinymce_daydesc `);

        dayTitle.setAttribute('PLACEHOLDER', `Day ${index}`);

        dayDesc.setAttribute('PLACEHOLDER', `Day ${index} Desc`);

        dayTitle.addEventListener("input", generateItinerary);

        dayDesc.addEventListener("input", generateItinerary);

        dayTitle.setAttribute('value', `${day.dayTitle}`);

        dayDesc.value = day.dayDesc;

        targetEle.appendChild(dayTitle);
        targetEle.appendChild(dayDesc);
        
            
    })

        


}



generateItineraryInputsFromData(getDaysList('iti'), 'day_inputs');

