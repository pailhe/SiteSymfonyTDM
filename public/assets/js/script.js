$(document).ready(function (){

    var drop1 = $('#dropdown1');

    drop1.click(function () {

        $('#dropdownDestinations').slideToggle()
    });


    var drop2 = $('#dropdown2');

    drop2.click(function () {
        resetDropdown();
        $('#dropdownAfrique').slideToggle()
    });

    var drop3 = $('#dropdown3');

    drop3.click(function () {

        $('#dropdownAmeriqueNord').slideToggle()
    });

    var drop4 = $('#dropdown4');

    drop4.click(function () {

        $('#dropdownAmeriqueSud').slideToggle()
    });

    var drop5 = $('#dropdown5');

    drop5.click(function () {

        $('#dropdownAsie').slideToggle()
    });

    var drop6 = $('#dropdown6');

    drop6.click(function () {

        $('#dropdownEurope').slideToggle()
    });

    var drop7 = $('#dropdown7');

    drop7.click(function () {

        $('#dropdownOceanie').slideToggle()
    });

});

function resetDropdown(){
    $(document).ready(function (){
        var drops = document.querySelectorAll('.dropdown');
        for (var i = 0; i < drops.length; i++){
            drops.slideToggle();
        }
    });
    }