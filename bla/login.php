<!-- $username = $_POST['uname'];
 $pw = $_REQUEST['psw'];

$url = "http://localhost:8080/rest/login";
$xml = simplexml_load_file($url);

$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, $url );
curl_setopt( $ch, CURLOPT_POST, true );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch, CURLOPT_POSTFIELDS, "<username>$username</username><pw>$pw</pw>" );
$result = curl_exec($ch);
curl_close($ch);
$context  = stream_context_create($options);
var_dump($context);
*/
!-->

<form action="http://localhost:8080/rest/login" method="post">
    <div class="container">
        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <button type="submit">Login</button>
        <input type="checkbox" checked="checked"> Remember me
    </div>

    <div class="container" style="background-color:#f1f1f1">
        <button type="button" class="cancelbtn">Cancel</button>
        <span class="psw">Forgot <a href="http://localhost:80/bla/register.php">registrieren?</a></span>
    </div>
</form>
