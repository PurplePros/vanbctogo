function togglePopup() {
	document.getElementById("popup").classList.toggle("active");
// 	console.log('toggled')
}

function displayMap() {
    // e.preventDefault();
    if ($(".interactiveMap").is(":hidden")) {
        // e.stopPropagation();
        $(".interactiveMap").show();
        // $(".interactiveMapAbout").show();
        // $(".interactiveMapAbout").backgroundColor = "red";
    }
    if ($(".placesList").is(":visible")) {
        $(".placesList").hide();
    }
}

function displayListing() {
    // e.preventDefault()
    if ($(".interactiveMap").is(":visible")) {
        // e.stopPropagation();
        $(".interactiveMap").hide();
        // $(".interactiveMapAbout").hide();
        // $(".interactiveMapAbout").backgroundColor = "blue";
    }
    if ($(".placesList").is(":hidden")) {
        $(".placesList").show();
    }
}

$(document).on("mousedown touchstart", ".help-btn", function(e) {
    e.preventDefault();
    togglePopup()
    // console.log("mousedown touchstart");
});

$(document).on("click touchstart", ".help-btn", function(e) {
    e.preventDefault();
    togglePopup()
    // console.log("click touchstart");
});

window.onload = function() {
    if ($(".interactiveMap").is(":visible") && $(".placesList").is(":visible")) {
        displayMap();
    } 
}