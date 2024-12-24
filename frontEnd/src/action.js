$(document).ready(function () {
    if (window.sessionStorage.getItem("lsign")) {
        console.log('first');
    }
    else {
        console.log('next');
        noSign();
    }
});