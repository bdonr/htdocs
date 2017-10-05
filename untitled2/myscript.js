$(function () {
    $("#groesse").on('keyup',function () {
        if (checkgroesse($("#groesse").val()) && checkgewicht($("#gewicht").val())){
            $("#ausgabe").text("berechne");
        }
    });

    $("#gewicht").on('keyup',function () {
        if (checkgroesse($("#groesse").val()) && checkgewicht($("#gewicht").val())){
            $("#ausgabe").text("berechne");
        }
    });
    function checkgroesse(c) {
        if(c<=1.1){
            $("#warning").text("nope");
            return false;
        }
        else if(c>2){
            $("#warning").text("auch nope");
            return false;
        }
        else{
            $("#warning").text("cool");
            return true;
        }
    }

    function checkgewicht(c){
        if(c<=10){
            $("#warning").text("nope");
            return false;
        }
        else if(c>200){
            $("#warning").text("auch nope");
            return false;
        }
        else{
            $("#warning").text("cool");
            return true;
        }
    }
}) ;