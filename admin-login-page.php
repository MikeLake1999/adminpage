<?php include ('login.php') 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>EDM NEWS</title>

  <!-- Favicons -->
  <link href="https://loopcentral.net/wp-content/uploads/2018/01/loopcentral-logo-150x110.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <style>
  .error {
    width: 92%; 
    margin: 2px auto; 
    padding: 5px; 
    color: #a94442; 
    background: #f2dede; 
    border-radius: 5px; 
    text-align: left;
  }
  .success {
    color: #3c763d; 
    background: #dff0d8; 
    border: 1px solid #3c763d;
    margin-bottom: 20px;
  }
  </style>
  
</head>

<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container" style="margin-top: 150px;">
      <form class="form-login"  method="post" action="admin-login-page.php">
        <h2 class="form-login-heading" style="background-color:#484848;"><img src="https://loopcentral.net/wp-content/uploads/2018/01/loopcentral-logo-150x110.png" alt="Smiley face" height="75" width="100"></h2>
        
				<?php include('errors.php'); ?>
        <?php $errors = array(); ?>
        <?php echo "<p class='error'>" .$_SESSION['msg']. "</p>"; ?>
        <div class="login-wrap">
          <input type="text" name="username" class="form-control" placeholder="Admin Name" autofocus>
          <br>
          <input type="password" name="password" class="form-control" placeholder="Password">
          <button class="btn btn-theme " style="background-color:#484848; margin-top: 10px;" name="login_user" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
          <label class="checkbox">
            <span class="pull-right">
            </span>
            </label>
    
        </div>
			</form>
        <!-- Modal -->
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("img/456.jpg", {
      speed: 500
    });
  </script>
</body>

</html>
