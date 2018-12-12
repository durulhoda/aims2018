$(document).ready(function () {
    $("#mmmenu").mmenu();
    var API = $("#mmmenu").data("mmenu");
    $("#mmmenu").click(function () {
        API.open();
    });
});

function txtChange(thisPointer) {
    var peraddress = document.getElementById("peraddress");
    var presentaddresstxt = thisPointer.value;
    var permanentaddress = document.getElementById("permanentaddress");
    if (peraddress.checked == true) {
        permanentaddress.value = presentaddresstxt;
    }
}

function check(thisPointer) {
    var presentaddress = document.getElementById("presentaddress");
    var presentaddresstxt = presentaddress.value;
    var permanentaddress = document.getElementById("permanentaddress");
    if (thisPointer.checked == true) {
        permanentaddress.value = presentaddresstxt;
    } else {
        permanentaddress.value = "";
    }
}

//Miltiple Step From

var currentTab = 0;
showTab(currentTab);
function showTab(n) {
    var x = document.getElementsByClassName("formsegment");
    x[n].style.display = "block";
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
}

function nextPrev(n) {
    var x = document.getElementsByClassName("formsegment");
    x[currentTab].style.display = "none";
    currentTab = currentTab + n;
    console.log(n);
    console.log("Current form segment :" + currentTab);
    console.log("Total form segment :" + x.length);
    if (currentTab >= x.length) {
        document.getElementById("regForm").submit();
        return false;
    }
    showTab(currentTab);
}
