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

$url = "https://24hybrid.com/reset-password-setpass.php";
$url .= "?token=".urlencode($token);

 error_reporting( E_ALL );
    $from = "no-reply@24hybrid.com";
    $to = $email;
    $subject = "Change Password Attempt";
    
    $message = '<!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
     <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>IronFx Landing Page Client</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body style="margin: 0; padding: 0;">
        <style>
            .button-confirm {
                box-shadow: 0 0px 0px 0 rgba(0,0,0,0.24), 0 0px 0px 0 rgba(0,0,0,0.19);
                transition: linear 0.5s;
            }
            .button-confirm:hover {
                box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
                transition: linear 0.5s;
            }
        </style>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style=" border: 1px solid #cccccc;">
        <tr>
            <td align="center" bgcolor="#ffffff" style="padding: 0px 0px 0px 0;">
                <img src="https://24hybrid.com/assets/img/pass-reset-head.jpg" style="width: 100%; height: auto;" alt="">
            </td>
        </tr>
        <tr>
            <td bgcolor ="#ffffff" style="padding: 40px 30px 40px 30px;border: 0px solid #cccccc;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td style="color: #14213d; font-family: Arial, sans-serif; font-size: 24px; text-align: center;">
                <b>Hello '.$user['name'].'</b>
                </td>
            </tr>
            <tr>
                <td style="padding: 20px 0 30px 0; color: #14213d; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px; text-align: center;">
                    We received a password change request from your email at 24Hybrid.<br> If you have not requested this change please ignore this email. <br><br>
If you really have been requested click on the button below!
                </td>
            </tr>
            <tr>
                <td style="padding: 20px 0 30px 0; color: #14213d; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px; text-align: center;">
                    <a class="button-confirm" href="'.$url.'" style="background-image: linear-gradient(to bottom right, #1b459a , #3e8ec6); color: white; padding: 14px 40px; border-radius: 8px;" >Change Password</a>
                </td>
            </tr>
            </table>
            </td>
        </tr>
        </table>                                    
    </body>
    </html>';
    
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From:" . $from;
    mail($to,$subject,$message, $headers);

echo json_encode(["status"=>"success","message"=>"E-mail enviado, por favor verifique sua caixa de entrada!"]);
return;
?>