$(document).ready(function(){

    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        immediateUpdates: true,
        todayBtn: true,
        todayHighlight: true
    }).datepicker("setDate",'now');


    
});