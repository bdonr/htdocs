<?php
session_start();

$GLOBALS['prompt']= "";
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>Catbook</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>

<body>

<div id="page">

	<div id="header">
		<img src="../css/csspics/Logo.png" alt="Broken Link">
	</div>

	<div id="account">
		<form method= "post" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			Hello <?php echo $_SESSION["user"]; ?>	
			<input type="submit" name="logout" value="Logout">  
		</form>
	</div>

	<div id="menue">
		<p>Users:</p>
		
		<?php
		
			//Read XML from users.xml and put into $myXMLstring
			$myXMLfile= fopen("../xml/users.xml", "r") or die("Unable to open file!");
			$myXMLstring= fread($myXMLfile,filesize("../xml/users.xml"));
			fclose($myXMLfile);
			//Read XML from users.xml and put into $myXMLstring -- END

			$xml = new SimpleXMLElement($myXMLstring);

			foreach($xml->user as $user){
				echo '<a href="?selectedUser=' . $user->name . '">' . $user->name . '</a><br>';
			}
					
		
		?>
	</div>


	<div id="content">
		<?php 
		echo "<h2>Pictures from " . filter_input(INPUT_GET, 'selectedUser') .":</h2><br>";
		
		include 'content.php';
		
		?>
	</div>

	<div id="upload">

		<h2>File Upload</h2>
		
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload Image" name="submitUpload">
		</form>

	</div>

	<?php include 'footer.php';?>

</div>
</body>
</html>


<?php

if(isset($_POST['logout'])){
	session_unset();
	session_destroy();
	header("Location: ../index.php");
}




if(isset($_POST['submitUpload'])){

$GLOBALS['prompt']= "";
$target_dir = "../uploads/";

$fileExtension =basename($_FILES["fileToUpload"]["name"]);
$fileExtension= pathinfo($fileExtension, PATHINFO_EXTENSION);
$dirSize= count(scandir($target_dir)) - 1;

$target_file = $target_dir . $dirSize . "_" . $_SESSION["user"] . "." . $fileExtension;


$uploadOk = 1;

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
//if(isset($_POST["submitUpload"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $GLOBALS['prompt'] = $GLOBALS['prompt'] . "File is not an image.<br>";
        $uploadOk = 0;
    }
//}

// Check if file already exists
if (file_exists($target_file) && $uploadOk == 1) {
    $GLOBALS['prompt'] = $GLOBALS['prompt'] . "File already exists.<br>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000  && $uploadOk == 1) {
    $GLOBALS['prompt'] = $GLOBALS['prompt'] . "File is too large.<br>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
   $GLOBALS['prompt'] = $GLOBALS['prompt'] . "Only JPG, JPEG, PNG & GIF files are allowed.<br>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $GLOBALS['prompt'] = $GLOBALS['prompt'] . "Your file was not uploaded.<br>";

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       $GLOBALS['prompt'] = $GLOBALS['prompt'] . "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
	   
	   //Read XML from users.xml and put into $myXMLstring
		$myXMLfile= fopen("../xml/users.xml", "r") or die("Unable to open file!");
		$myXMLstring= fread($myXMLfile,filesize("../xml/users.xml"));
		fclose($myXMLfile);
		//Read XML from users.xml and put into $myXMLstring -- END
		
		
		//Writing picturname into the xml-data and increment uploads
		$xml = new SimpleXMLElement($myXMLstring);
		foreach($xml->user as $user){
			if($user->name == $_SESSION["user"]){
				$user->pictures->addChild('picture', basename($target_file));
				$user->uploads= $user->uploads +1;
				break;
			}
		}
		//Writing picturname into the xml-data and increment uploads -- END
		
		//Overwrite old users.txt with new xml-data
		$myXMLfile= fopen("../xml/users.xml", "w") or die("Unable to open file!");
		fwrite($myXMLfile, $xml->asXML());
		fclose($myXMLfile);
		//Overwrite old users.txt with new xml-data -- END
	   
    } else {
       $GLOBALS['prompt'] = $GLOBALS['prompt'] . "Sorry, there was an error uploading your file.<br>";
    }

}
header("Location: ./catbook.php?selectedUser=" . $_SESSION["user"]);
// to see prompt comment /\ out;
echo $prompt;

}
?>