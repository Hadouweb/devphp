<?php

session_start();
date_default_timezone_set('Europe/Paris');

function ft_update_chat($msg)
{
	if (file_exists("../private") === FALSE)
	{
		if (!mkdir("../private", 0777, false)) {
	    	return FALSE;
		}
	}
	$handle = fopen("../private/chat", "a+");
	flock($handle, LOCK_EX); 
	@$file = file_get_contents("../private/chat");
	if ($file === FALSE)
		return FALSE;
	$tab = unserialize($file);
	$user["login"] = $_SESSION["loggued_on_user"];
	$user["time"] = time();
	$user["msg"] = $msg;
	$tab[] = $user;
	$data = serialize($tab);
	$ret = file_put_contents("../private/chat", $data);
	flock($handle, LOCK_UN);
	if ($ret === FALSE)
		return FALSE;
	return TRUE;
}

if ($_POST['msg'] !== NULL && $_POST['submit'] === "ENVOYER")
{
	if (ft_update_chat($_POST['msg']) === FALSE)
		echo "ERROR\n";
}
?>

<html>
<head>
	<meta charset="UTF-8" />
</head>
<body>
	<script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
	<form method="POST" action="speak.php">
		Message: <input type="text" name="msg" value="" />		
		<br />
		<input type="submit" name="submit" value="ENVOYER"/>
	</form>
</body>
</html>