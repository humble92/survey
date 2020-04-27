function viewResult(id) {
    document.getElementById('mode').value = 'v';
    document.getElementById('f').method.value = 'POST';
    document.getElementById('f').submit();
}

//cf. https://stackoverflow.com/questions/11557526/deserialize-query-string-to-json-object
function queryStringToJSON(queryString) {
    if(queryString.indexOf('?') > -1){
        queryString = queryString.split('?')[1];
    }
    var pairs = queryString.split('&');
    var result = {};
    pairs.forEach(function(pair) {
        pair = pair.split('=');
        result[pair[0]] = decodeURIComponent(pair[1] || '');
    });
    return result;
}

function saveResponse() {
    let res = $("#f").serialize();
    let o = queryStringToJSON(res);

    try {
        localStorage.setItem(o.survey_id, res);
    }
    catch(err) {
        console.log("The request violates a policy decision,\nor, your browser might be configured \nto deny permission to persist data for the \nspecified origin (e.g. file: or data: scheme).");
        return;
    }
}