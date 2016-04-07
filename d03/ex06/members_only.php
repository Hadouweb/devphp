<?php
$valid_passwords = array ("zaz" => "jaimelespetitsponeys");
$valid_users = array_keys($valid_passwords);

$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

if (!$validated) 
{
  header('WWW-Authenticate: Basic realm="My Realm"');
  header('HTTP/1.0 401 Unauthorized');
  die ("Not authorized");
}
$name = $user[0] + 32;
echo "<html><body>\n";
echo "Bonjour $name<br />\n";
echo "<img src=data:image/png;base64,".base64_encode(file_get_contents("../img/42.png")).">";
echo "</body></html>\n";
?>