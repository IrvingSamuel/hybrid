<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Hybrid | Change Password</title>
  <link rel="icon" href="assets/img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body id="dark">
  <div class="vh-100 d-flex justify-content-center">
    <div class="form-access my-auto">
      <div class="navbar-brand"><img src="assets/img/logo-light.png" alt="logo" style="width: 350px; margin-bottom: 30px;"></div>
      <form>
        <span>Reset Password</span>
        <div class="form-group">
          <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
          <input type="password" name="password" class="form-control" placeholder="Type your new password">
        </div>
        <button type="submit" class="btn btn-primary">Change Password</button>
      </form>
    </div>
  </div>

  <script src="assets/js/jquery-3.4.1.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/amcharts-core.min.js"></script>
  <script src="assets/js/amcharts.min.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>