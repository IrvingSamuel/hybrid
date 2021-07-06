<?php


include ("config.php");

if(!isset($_POST["email"])){
	echo json_encode(["status"=>"error","message"=>"E-mail não pode ser vazio"]);
	return;
}

if(!isset($_POST["password"])){
	echo json_encode(["status"=>"error","message"=>"Password não pode ser vazio!"]);
	return;
}


$email = mysqli_real_escape_string($con,$_POST['email']);
$password = $_POST['password'];

$user = mysqli_fetch_assoc(mysqli_query($con,"SELECT *, COUNT(*) as qtd FROM user WHERE email = '$email'"));

if($user['qtd'] == 0){
	echo json_encode(["status"=>"error","message"=>"E-mail ou senha incorretos!"]);
	return;
}

if($user['password'] != $password){
	echo json_encode(["status"=>"error","message"=>"E-mail ou senha incorretos!"]);
	return;
}

$token = md5($password."".$email."".time());

mysqli_query($con,"UPDATE user SET token_login = '$token' WHERE id = '".$user['id']."'");
session_start();

$_SESSION['token_hybrid'] = $token;

echo json_encode(["status"=>"success","message"=>"Login realizado com sucesso!"]);
return;

?>