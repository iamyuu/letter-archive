$(document).ready(function() {
    $('.modal').modal();
    $('ul.tabs').tabs();
    $('.button-collapse').sideNav({
        menuWidth: 225
    });
    $('select').material_select();
    $('.dropdown-button').dropdown();
    $('.datepicker').pickadate({
        format: 'yyyy-mm-dd',
        selectMonths: true,
        selectYears: 15
    });
});
