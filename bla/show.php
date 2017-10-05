<?php

//TODO hier cookie setzen statt get
//wenn cookie gesetzt dann zeige profil an
if(isset($_GET["id"])){
    error_reporting(0);
    $id = $_GET["id"];
    $url = "http://localhost:8080/rest/kunden/$id";
    $xml = simplexml_load_file($url);
    if(!$xml){
        error_reporting(0);
        echo "kein User gefunden";
    }
    echo $xml->uId;
    echo $xml->uName;
    echo $xml->uEmail;

    if(isset($xml->waren)){
        foreach($xml->waren as $val){
            echo $val;
            echo $val->wName;
        }
    }
    echo "<a href='http://localhost/bla/edit.php?id=$id'>bla</a>";
}
//sonst login form
else{
    include "login.php";
}