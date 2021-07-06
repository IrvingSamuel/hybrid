<?php


include ("config.php");

if(!isset($_POST["firstname"]) || empty($_POST['firstname'])){
	echo json_encode(["status"=>"error","message"=>"First Name não pode ser vazio"]);
	return;
}

if(!isset($_POST["lastname"]) || empty($_POST['lastname'])){
	echo json_encode(["status"=>"error","message"=>"Last Name não pode ser vazio"]);
	return;
}

if(!isset($_POST["email"]) || empty($_POST['email'])){
	echo json_encode(["status"=>"error","message"=>"E-mail não pode ser vazio"]);
	return;
}

if(!isset($_POST["password"]) || empty($_POST['password'])){
	echo json_encode(["status"=>"error","message"=>"Password não pode ser vazio!"]);
	return;
}

if(!isset($_POST["cpassword"]) || empty($_POST['cpassword'])){
	echo json_encode(["status"=>"error","message"=>"Confirmação de senha não pode ser vazia!"]);
	return;
}

$firstname = mysqli_real_escape_string($con,$_POST['firstname']);
$lastname = mysqli_real_escape_string($con,$_POST['lastname']);
$email = mysqli_real_escape_string($con,$_POST['email']);

$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

$user = mysqli_fetch_assoc(mysqli_query($con,"SELECT *, COUNT(*) as qtd FROM user WHERE email = '$email'"));

if($password != $cpassword){
	echo json_encode(["status"=>"error","message"=>"Senhas não combinam!"]);
	return;
}

if($user['qtd'] > 0){
	echo json_encode(["status"=>"error","message"=>"E-mail já registrado!"]);
	return;
}

$password = password_hash($password, PASSWORD_BCRYPT);

$fullname = $firstname." ".$lastname;
mysqli_query($con,"INSERT INTO user (name, email, password) VALUES ('$fullname','$email','$password')");

echo json_encode(["status"=>"success","message"=>"Cadastro realizado com sucesso!"]);
return;

?>