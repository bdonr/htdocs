<?php

$x = $_GET['groesse'];
$y=$_GET['gewicht'];
if($x<=1.35 || ($x>=2.50)){
    echo "nope";
}
else if ($y<=30 || $y>200){
    echo "du fettes stück kot";
}
else {
    $bmi = round((double)$y / ($x * $x), 2);
    echo "deine bmi ist " . $bmi . "bei einer größe von " . $x . "und einem gewicht von " . $y."du bist".($bmi<20 ? "dünn" : $bmi>20 &&$bmi<30 ? " normal":" fett")." iss gurke bljat mach sport bljat";
}

?>