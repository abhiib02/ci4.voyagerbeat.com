function init_dates_inputs() {

    $('input[type="dates"]').daterangepicker({
            autoUpdateInput: !1,
            locale: {
                cancelLabel: "Clear"
            }
        }),
        $('input[type="dates"]').on("apply.daterangepicker", function (t, a) {
            $(this).val(a.startDate.format("DD/MM/YYYY") + " - " + a.endDate.format("DD/MM/YYYY"));
            refreshDates();
        }),
        $('input[type="dates"]').on("cancel.daterangepicker", function (t, a) {
            $(this).val("");
        });
}

$(document).ready(init_dates_inputs());



var add_button = document.querySelector('.add');
var rem_button = document.querySelector('.remove');
var submit_button = document.querySelector('.submit');
var STRVIEWER = document.querySelector('.dates_string');
var DATE_INPUT_ARR,DATE_SURCHARGE_INPUT_ARR;
var DATE_INPUT_GROUP = document.querySelector('.date_input_group');


function generateInputsFromString(STRVIEWER, parent_element) {

    let string = STRVIEWER.textContent;
    let dates_arr = string.split(",");
    dates_arr.forEach((one_date) => {
        const onlyDate = one_date.split("|")[0];
        const surchargeValue = one_date.split("|")[1];
        const node = document.createElement("input");
        const surchargeInput = document.createElement("input");
        node.setAttribute("class", "date_input form-control");
        surchargeInput.setAttribute("class", "date_surcharge_input form-control");
        surchargeInput.setAttribute("placeholder", "Surcharge/Person");
        node.style = "width:200px;";
        surchargeInput.style = "width:90px;";
        node.setAttribute("type", "dates");
        node.setAttribute("value", onlyDate);
        surchargeInput.setAttribute("type", "number");
        surchargeInput.setAttribute("value",surchargeValue);
        node.setAttribute("oninput", "refreshDates()");
        surchargeInput.setAttribute("oninput", "refreshDates()");
        parent_element.appendChild(node);
        parent_element.appendChild(surchargeInput);
    })
    init_dates_inputs();
}
generateInputsFromString(STRVIEWER, DATE_INPUT_GROUP)


function refreshDates() {

    DATE_INPUT_ARR = document.querySelectorAll('.date_input');
    DATE_SURCHARGE_INPUT_ARR = document.querySelectorAll('.date_surcharge_input');
    let temp = commaSeperatedStringGen(DATE_INPUT_ARR,DATE_SURCHARGE_INPUT_ARR);
    STRVIEWER.value = temp;
}
function commaSeperatedStringGen(arr,surchargeArr) {
    var COMMA_SEPERATED_DATES = '';
    arr.forEach((P_Date, index) => {
        // Remove old surcharge if already present
        let cleanDate = P_Date.value.split('|')[0];

        let surchargeValue = surchargeArr[index].value || 0;

        let CombinedString = cleanDate + '|' + surchargeValue;

        COMMA_SEPERATED_DATES += CombinedString;

        if (index < arr.length - 1) {
            COMMA_SEPERATED_DATES += ',';
        }
    })
    return COMMA_SEPERATED_DATES;
}

function insertDateInput(parent_element) {
    const node = document.createElement("input");
    const surchargeInput = document.createElement("input");
    node.setAttribute("class", "date_input form-control");
    surchargeInput.setAttribute("class", "date_surcharge_input form-control");
    surchargeInput.setAttribute("placeholder", "Surcharge/Person");
    node.style = "width:200px;";
    surchargeInput.style = "width:90px;";
    node.setAttribute("type", "dates");
    surchargeInput.setAttribute("type", "number");
    node.setAttribute("oninput", "refreshDates()");
    surchargeInput.setAttribute("oninput", "refreshDates()");
    parent_element.appendChild(node);
    parent_element.appendChild(surchargeInput);
    refreshDates();
}

function deleteDateInput(element) {
    DATE_INPUT_ARR = document.querySelectorAll(element);
    DATE_INPUT_ARR[DATE_INPUT_ARR.length - 1].remove();
    refreshDates();
}

add_button.addEventListener('click', (e) => {
    insertDateInput(DATE_INPUT_GROUP);

    refreshDates();
    init_dates_inputs();
})
rem_button.addEventListener('click', (e) => {
    deleteDateInput('.date_input');
    deleteDateInput('.date_surcharge_input');
    refreshDates();
    init_dates_inputs();
})


submit_button.addEventListener('click', (e) => {
    refreshDates();
    init_dates_inputs();
})