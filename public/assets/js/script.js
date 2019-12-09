$(document).ready(function (){

    var drop1 = $('#dropdown1');

    drop1.click(function () {

        $('#dropdownDestinations').slideToggle()
    });

    var drop2 = $('#dropdown2');

    drop2.click(function () {

        $('#dropdownDestinations').slideToggle()
    });
});





// Quand l'utilisateur scroll la page cela exécute myFunction
window.onscroll = function() {myFunction()};

// Cible l'élément avec l'id navbar
var navbar = document.getElementById("navbar");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}