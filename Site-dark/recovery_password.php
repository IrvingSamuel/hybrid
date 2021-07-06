<?php

include ("config.php");

if(!isset($_POST["password"]) || empty($_POST['password'])){
	echo json_encode(["status"=>"error","message"=>"Password não pode ser vazio!"]);
	return;
}

$token  = $_POST['token'];

$user = mysqli_fetch_assoc(mysqli_query($con,"SELECT *, COUNT(*) as qtd FROM user WHERE token_recovery = '$token'"));

if($user['qtd'] == 0){
	echo json_encode(["status"=>"error","message"=>"Link de recuperação expirou!"]);
	return;
}

$password = $_POST['password'];
$password = password_hash($password, PASSWORD_BCRYPT);

mysqli_query($con,"UPDATE user SET password = '$password' WHERE id = '".$user['id']."'");


echo json_encode(["status"=>"success","message"=>"Senha alterada com sucesso!"]);
return;
?>