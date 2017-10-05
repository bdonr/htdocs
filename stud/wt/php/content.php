<?php


$target_dir = "../uploads/";

//Read XML from users.xml and put into $myXMLstring
$myXMLfile= fopen("../xml/users.xml", "r") or die("Unable to open file!");
$myXMLstring= fread($myXMLfile,filesize("../xml/users.xml"));
fclose($myXMLfile);
//Read XML from users.xml and put into $myXMLstring -- END

$xml = new SimpleXMLElement($myXMLstring);

foreach($xml->user as $user){
	if($user->name == filter_input(INPUT_GET, 'selectedUser')){
		
		if($user->uploads > 0)
		foreach($user->pictures->picture as $pic){
			echo '<img src="' . $target_dir . $pic . '" alt="Sweet Pussy" width="200" height="200">';
			echo " ";
		}else{
			echo "No pictures uploaded :-(";
		}
		break;
	}
}
echo "<br><br>";


?>
