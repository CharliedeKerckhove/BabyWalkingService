/*allow login pop up*/
function login() {
    console.log("yes");
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

$(document).ready(function () {
    /*gets information from viewChildren.php*/
    $.get("ajax/viewChildren.php", function (data) {
        /*display data within div labelled regChildren*/
        $("#regChildren").html(data);
    })
});

$(document).ready(function () {
    /*gets information from FirstName.php*/
    $.get("ajax/FirstName.php", function (data) {
        $("#hideF").html(data);
    });
    /*gets information from LastName.php*/
    $.get("ajax/LastName.php", function (data) {
        $("#hideL").html(data);
    });
    /*gets information from Phone.php*/
    $.get("ajax/Phone.php", function (data) {
        $("#hideP").html(data);
    });
    /*gets information from Email.php*/
    $.get("ajax/Email.php", function (data) {
        $("#hideE").html(data);
    });

});

$(document).ready(function () {
    var facilityList = $('input[name="keyword[]"]:checked');
    console.log(facilityList);
});

/*display input box and update button and hide pencil symbol and current info for first name when pen symbol clicked*/
function changeFName() {
    var hideF = document.getElementById("hideF");
    var inputF = document.getElementById("inputF");
    var updateF = document.getElementById("updateF");
    var pencilF = document.getElementById("pencilF");
    if (hideF.style.display === "none") {
        hideF.style.display = "table-cell";
        inputF.style.display = "none";
        updateF.style.display = "none";
        pencilF.style.display = "table-cell";
    } else {
        hideF.style.display = "none";
        inputF.style.display = "table-cell";
        updateF.style.display = "table-cell";
        pencilF.style.display = "none";
    }
}
/*display input box and update button and hide pencil symbol and current info for last name when pen symbol clicked*/
function changeLName() {
    var hideL = document.getElementById("hideL");
    var inputL = document.getElementById("inputL");
    var updateL = document.getElementById("updateL");
    var pencilL = document.getElementById("pencilL");
    if (hideL.style.display === "none") {
        hideL.style.display = "table-cell";
        inputL.style.display = "none";
        updateL.style.display = "none";
        pencilL.style.display = "table-cell";
    } else {
        hideL.style.display = "none";
        inputL.style.display = "table-cell";
        updateL.style.display = "table-cell";
        pencilL.style.display = "none";
    }
}
/*display input box and update button and hide pencil symbol and current info for phone number when pen symbol clicked*/
function changePhone() {
    var hideP = document.getElementById("hideP");
    var inputP = document.getElementById("inputP");
    var updateP = document.getElementById("updateP");
    var pencilP = document.getElementById("pencilP");
    if (hideP.style.display === "none") {
        hideP.style.display = "table-cell";
        inputP.style.display = "none";
        updateP.style.display = "none";
        pencilP.style.display = "table-cell";
    } else {
        hideP.style.display = "none";
        inputP.style.display = "table-cell";
        updateP.style.display = "table-cell";
        pencilP.style.display = "none";
    }
}
/*display input box and update button and hide pencil symbol and current info for email when pen symbol clicked*/
function changeEmail() {
    var hideE = document.getElementById("hideE");
    var inputE = document.getElementById("inputE");
    var updateE = document.getElementById("updateE");
    var pencilE = document.getElementById("pencilE");
    if (hideE.style.display === "none") {
        hideE.style.display = "table-cell";
        inputE.style.display = "none";
        updateE.style.display = "none";
        pencilE.style.display = "table-cell";
    } else {
        hideE.style.display = "none";
        inputE.style.display = "table-cell";
        updateE.style.display = "table-cell";
        pencilE.style.display = "none";
    }
}