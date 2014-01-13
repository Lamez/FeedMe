<?php
include("includes.php");
$session=new Session();
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$person = new Person($db);
$page = new Page("new page");
//$person->changeFirstName(1, "JaMEs");
$session->displayAll();
echo "<Br /><br />";

//$website = new Website($db);
/*
$array = $website->getAll();
foreach($array as $d){
	print_r($d);
}*/

echo "<br />";
$session->add("add", $session->get("add") + 1);
$email = new Email();
$email->to("James", "wizkid916@yahoo.com");
$email->from("John", "wizkid916@yahoo.com");
$email->email("Hello There ".$session->get("add"), "This is my important message!");
//$server, $port, $protocol, $auth_required, $username = NULL, $password = NULL
$email->settings("smtp.mail.yahoo.com", 465, "ssl", 1, "wizkid916@yahoo.com", "JRLjrl97jrljrl");


$email = new DatabaseEmail($db);
//$email->setID(1);
$email->email("database email test", "this is only a test:)))");
$email->to("James Little", "wizkid916@yahoo.com");
$email->sendEmail();
if(!$email->sent()){
	echo $email->error();
}else{
	echo "Email sent!";
}
?>