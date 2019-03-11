<?php
session_start();


$servername = "localhost";
$username1 = "root";
$password = "root";
$dbname = "edm";
$port ="8889";
$errors = array();


// connect to the database
$db = mysqli_connect($servername, $username1, $password, $dbname, $port);



  // Finally, register user if there are no errors in the form


  if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $nameuser = mysqli_real_escape_string($db, $_GET['nameuser']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $query = "SELECT * FROM admin WHERE AdminName='$username' AND AdminPassword='$password' AND Active='1'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: admin-homepage.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }

    }
  }




  ?>
