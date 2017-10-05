
<?php

//TODO hier cookie setzen statt get
//wenn cookie gesetzt dann zeige profil an
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $url = "http://localhost:8080/rest/kunden/$id";
    $xml = simplexml_load_file($url);
    echo $xml->kId;
    echo $xml->kName;
    echo $xml->kEmail;

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

?>

