<?php

include ("config.php");

if(!isset($_POST["email"]) || empty($_POST['email'])){
	echo json_encode(["status"=>"error","message"=>"E-mail vazio!"]);
	return;
}


$user = mysqli_fetch_assoc(mysqli_query($con,"SELECT *, COUNT(*) as qtd FROM user WHERE email = '$email'"));

if($user['qtd'] == 0){
	echo json_encode(["status"=>"error","message"=>"E-mail não encontrado'!"]);
	return;
}

$token = md5($email.time());

mysqli_query($con,"UPDATE user SET token_recovery = '$token' WHERE id = '".$user['id']."'");

$url = "";
$url .= "?code=".$token;

/*
Envio do email
*/

echo json_encode(["status"=>"success","message"=>"E-mail enviado, por favor verifique sua caixa de entrada!"]);
return;
?>