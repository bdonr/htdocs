<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<style>
		.error {color: #FF0000;}
	</style>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

<?php

//Open connection to MySQL Database
	$dbservername= "localhost";
	$dbusername= "root";
	$dbpassword= "";
	$dbname= "wt";
	//Create Connection
	$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
	//Ceck connection
		if($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}
	//Ceck connection -- END
//Open connection to MySQL Database -- END


// define variables and set to empty values
$usernameErr = $passwordErr = "";
$username = $password = "";


if(isset($_POST['register'])){
	//Username test
	if (empty($_POST["username"])) {
		$usernameErr = "Username is required";
	} else {
		$username = test_input($_POST["username"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
			$usernameErr = "Only letters and white space allowed"; 
		}
	}
	//Username test -- END
	//Password test
	if (empty($_POST["password"])) {
		$passwordErr = "Password is required";
	} else {
		$password = test_input($_POST["password"]);
	}
	//Password test -- END
	
	if($usernameErr == "" && $passwordErr == ""){
		try_to_register($conn, $username, $password);
	}
}



function try_to_register($conn, $username, $password){
	//User exists?
	$sql= "SELECT * FROM user WHERE username='" . $username . "';";
	$result= $conn->query($sql);
		
	if($result->num_rows > 0){
		$GLOBALS['usernameErr']= "Username already taken";
	}else{
		$sql= "INSERT INTO user (username, password) VALUES ('" . $username ."', '" . $password . "');";
		$conn->query($sql);
		
		//Read XML from users.xml and put into $myXMLstring
		$myXMLfile= fopen("./xml/users.xml", "r") or die("Unable to open file!");
		$myXMLstring= fread($myXMLfile,filesize("./xml/users.xml"));
		fclose($myXMLfile);
		//Read XML from users.xml and put into $myXMLstring -- END
		
		//Create Simple XML and add two children
		$xml = new SimpleXMLElement($myXMLstring);
		$xmlUser = $xml->addChild('user');
		$xmlUser->addChild('name', $username);
		$xmlUser->addChild('date', date("Y.m.d"));
		$xmlUser->addChild('uploads', "0");
		$xmlUser->addChild('pictures');
		//Create Simple XML and add two children -- END
		
		//Overwrite old users.txt with new xml-data
		$myXMLfile= fopen("./xml/users.xml", "w") or die("Unable to open file!");
		fwrite($myXMLfile, $xml->asXML());
		fclose($myXMLfile);
		//Overwrite old users.txt with new xml-data -- END
		
			
		try_to_login($conn, $username, $password);
	}
}





if(isset($_POST['login'])){
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//Username test
	if (empty($_POST["username"])) {
		$usernameErr = "Username is required";
	} else {
		$username = test_input($_POST["username"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
			$usernameErr = "Only letters and white space allowed"; 
		}
	}
	//Username test -- END
	//Password test
	if (empty($_POST["password"])) {
		$passwordErr = "Password is required";
	} else {
		$password = test_input($_POST["password"]);
	}
	//Password test -- END
	if($usernameErr == "" && $passwordErr == ""){
		try_to_login($conn, $username, $password);
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function try_to_login($conn, $username, $password){
	
	//Send query
	$sql= "SELECT password FROM user WHERE username='" . $username . "';";
	$result= $conn->query($sql);
		
	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		if($password == $row["password"]){
			$_SESSION["user"] = $username;
			//header("Location: http://localhost/stud/wt/php/catbook.php?selectedUser=" . $username);
			header("Location: ./php/catbook.php?selectedUser=" . $username);
		}else{
			$GLOBALS["passwordErr"]="Wrong password";
		}
	}else{
		$GLOBALS["usernameErr"]="Wrong username";
	}

	//Send query --END
}

?>

<div id="page">

	<div id="twentyheightBox">
		<img src="./css/csspics/Logo.png" alt="Broken Link">
	</div>

	<div id="mainLogin">
		<br><br><br><br><br><br><br><br><br>

		<h2>Login:</h2>

		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
		  Username: <input type="text" name="username" value="<?php echo $username;?>">
		  <span class="error"> <?php echo $usernameErr;?></span>
		  <br><br>
		  Password: <input type="password" name="password" value="<?php echo $password;?>">
		  <span class="error"><?php echo $passwordErr;?></span>
		  <br><br>
		  <input type="submit" name="login" value="Login">  
		  <input type="submit" name="register" value="Register">
        <a href="php/test.php">backup</a>
		</form>
	</div>

	<?php include 'php/footer.php';?>

</div>
</body>
</html>