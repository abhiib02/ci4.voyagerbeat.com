const IsParsable = (data) => {
    try {
        JSON.parse(data);
    } catch (e) {
        return e;
    }
    return true;
}

function convertJSONtoString(data) {
    return JSON.stringify(data);
}

function convertStringtoJSON(str) {

    if (!str) {
        return '';
    }
    return JSON.parse(str);
}