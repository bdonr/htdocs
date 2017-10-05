<?php
$ch = curl_init();

$myXMLfile= fopen("../xml/users.xml", "r") or die("Unable to open file!");
$myXMLstring= fread($myXMLfile,filesize("../xml/users.xml"));
fclose($myXMLfile);
//Read XML from users.xml and put into $myXMLstring -- END

//Create Simple XML and add two children
simplexml_load_string($myXMLstring);
$xml = simplexml_load_string($myXMLstring);


curl_setopt($ch, CURLOPT_URL,"localhost:8080/rest/user");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/xml',
    'Connection: Keep-Alive'
));
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS,$xml->asXML());


$request=  curl_getinfo($ch);
var_dump($xml);


$content = curl_exec($ch);





