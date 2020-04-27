//configuration
const server = "/survey/admin";

//executed on load, to avoid global variables
(function() {
    let btnAddSurvey = document.getElementById('btnToggleForm'); 
    let btnAdd = document.getElementById('btnAdd');
    let btnSearch = document.getElementById('btnSearch');
    
    //add event listeners
    btnAddSurvey.addEventListener('click', toggleAddForm);
    btnAdd.addEventListener('click', addSurvey);
    btnSearch.addEventListener('click', searchSurvey);
})();

//toggle input form
function toggleAddForm() {
    var c = document.getElementById("addFormContainer");	//document.querySelector("#addFormContainer");
    if (c.style.display == "block") {
      c.style.display = "none";
	  clearAddFrom();
    } else {
      c.style.display = "block";
    }
}

//clear input form
function clearAddFrom() {
	document.getElementById("name").value = "";
	document.getElementById("desc").value = "";
	document.getElementById("sType").value = "";
}

function viewSurvey(btn) {
    var uid = btn.parentNode.parentNode.id;
    let url = window.location.protocol + '//' 
            + window.location.hostname + ':' 
            + window.location.port + '/survey/index.php?id=' + uid;
    window.open(url);
}

function dupSurvey(btn) {
    var data = new FormData();
    data.append( "mode", "dup" );
    data.append( "id", btn.parentNode.parentNode.id );

    fetch(server + '/api/manageSurvey.php',
    {
        method: "POST",
        body: data
    })
    .then(function(res){ return res.json(); })
    .then(function(data){ 
        if(data.result) {
            window.location.reload();
        } else {
            alert("Something wrong: Failed to duplicate survey");
        }
    })
}

function resetSurvey(btn) {
    if(!confirm("Do you want to reset all responses of survey?")) return;

    var data = new FormData();
    data.append( "mode", "reset" );
    data.append( "id", btn.parentNode.parentNode.id );

    fetch(server + '/api/manageSurvey.php',
    {
        method: "POST",
        body: data
    })
    .then(function(res){ return res.json(); })
    .then(function(data){ if(data.result) alert( data.msg ) })
}

function deleteSurvey(btn) {
    if(!confirm("Do you want to delete this survey?")) return;

    var data = new FormData();
    data.append( "mode", "delete" );
    data.append( "id", btn.parentNode.parentNode.id );

    fetch(server + '/api/manageSurvey.php',
    {
        method: "POST",
        body: data
    })
    .then(function(res){ return res.json(); })
    .then(function(data){ 
        if(data.result) {
            btn.parentNode.parentNode.remove();
        } else {
            alert("Something wrong: Failed to delete survey");
        }
    })
}

//search survey, case insensitive
function searchSurvey() {
    //display searching survey
    let name = document.getElementById("searchName").value;

    fetch(server + '/api/seachSurvey.php?keyword=' + name).
        then((res) => res.json() ).   // obtain data as json
        then( (data) => { 
            //init
            hideSurveys();
            if(data.result) {
                for (let i = 0; i < data.survey.length; i++){
                    addSurveyToList(data.survey[i]);
                }
            } else {
                alert("Something wrong: Failed to save survey to database");
            }
        }).
        catch((err) => console.log(err));
}

//hide surveys
function hideSurveys() {
    var cards = document.getElementsByClassName("card");
    while(cards.length) {
      cards[0].remove();  
    }
}

//add survey to database
function addSurvey() {
    let surveyInfo = new Object();
    surveyInfo.name = document.getElementById("name").value;
    surveyInfo.desc = document.getElementById("desc").value;
    surveyInfo.sType = document.getElementById("sType").value;
    
	//verifying input values
	if(surveyInfo.name.trim() == "") {
		alert("Please type: survey name");
		return;
	}
	if(surveyInfo.desc.trim() == "") {
		alert("Please type: about survey");
		return;
	}
	if(surveyInfo.sType.trim() == "" || !surveyTypes.includes(surveyInfo.sType.trim().toUpperCase())) {
		alert("Please type: type of survey");
		return;
	}

    var data = new FormData();
    data.append( "json", JSON.stringify( surveyInfo ) );

    fetch(server + '/api/addSurvey.php', {
        method: 'POST',
        body: data
    }).
    then((res) => res.json() ).   // obtain data as json
    then( (data) => { 
        if(data.result) {
            window.location.reload();
        } else {
            alert("Something wrong: Failed to save survey to database");
        }
    }).
    catch((err) => console.log(err));
}

//add survey to UI
function addSurveyUI(uid) {

    let name = document.getElementById("name").value;
    let desc = document.getElementById("desc").value;
    let sType = document.getElementById("sType").value;
    
    //save into local storage
    var survey = new Object();
    survey.uid = uid;
    survey.name = name;
    survey.desc = desc;
    survey.sType = sType;

    //display survey
    addSurveyToList(survey);

    //hide & clear fields
    toggleAddForm();
}

function imageExists(image_url, good, bad){
    var img = new Image();
    img.onload = good; 
    img.onerror = bad;
    img.src = image_url;
}

function addSurveyToList(o) {
    let name = o.name;
    let desc = o.explanation;
    let sType = o.type;
    let uid = o.id;
    
    //div
    let node = document.createElement("div");
    node.setAttribute("class", "card clearfix");
    node.setAttribute("data-type", sType);
    node.setAttribute("id", uid);
    
    //span
    let spanNode = document.createElement("span");
    //name
    let nameNode = document.createElement("p");
    nameNode.setAttribute("class", "survey_name");
    nameNode.textContent = `${uid}. [${sType}] ` + name;
    spanNode.appendChild(nameNode);
    //desc
    let descNode = document.createElement("p");
    descNode.setAttribute("class", "survey_desc");
    descNode.textContent = desc;
    spanNode.appendChild(descNode);
    node.appendChild(spanNode);
    
    //buttons
    let btnContainer = document.createElement("div");
    //button : delete
    let btnNode = document.createElement("button");
    btnNode.setAttribute("class", "btn red");
	btnNode.setAttribute("onclick","deleteSurvey(this)");
    btnNode.textContent = "Delete";
    btnContainer.appendChild(btnNode);

    //button : reset
    btnNode = document.createElement("button");
    btnNode.setAttribute("class", "btn orange");
	btnNode.setAttribute("onclick","resetSurvey(this)");
    btnNode.textContent = "Reset";
    btnContainer.appendChild(btnNode);

    //button : duplicate
    btnNode = document.createElement("button");
    btnNode.setAttribute("class", "btn blue");
	btnNode.setAttribute("onclick","dupSurvey(this)");
    btnNode.textContent = "Duplicate";
    btnContainer.appendChild(btnNode);

    //button : manage
    btnNode = document.createElement("button");
    btnNode.setAttribute("class", "btn darkGreen");
	btnNode.setAttribute("onclick","manageQuestion(this)");
    btnNode.textContent = "Manage";
    btnContainer.appendChild(btnNode);

    //button : view
    btnNode = document.createElement("button");
    btnNode.setAttribute("class", "btn green");
	btnNode.setAttribute("onclick","viewSurvey(this)");
    btnNode.textContent = "View";
    btnContainer.appendChild(btnNode);

    node.appendChild(btnContainer);
    
    //Append and display
    let parent = document.getElementById("list");
    parent.appendChild(node);
}

function manageQuestion(btn) {
    let id = btn.parentNode.parentNode.id;
    let sType = btn.parentNode.parentNode.getAttribute("data-type");

    let url = window.location.protocol + '//' 
            + window.location.hostname + ':' 
            + window.location.port + `/survey/admin/index.php?id=${id}&sType=${sType}`;
    window.open(url);
}