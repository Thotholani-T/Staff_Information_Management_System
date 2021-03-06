<?php
    session_start();

    include('config/db_connection.php');
    
    $msg = "";
    if(isset($_POST['login'])){
      $emp_id = $_POST['emp_id'];
      $password = $_POST['password'];

      $sql = "SELECT * FROM employee WHERE emp_id='$emp_id'";

      $result = mysqli_query($conn,$sql);

      $employee_details = mysqli_fetch_all($result,MYSQLI_ASSOC);

      //checks if inputted id is valid
      if (count($employee_details) > 0) {

        //checks if inputted password is valid
        if ($employee_details['0']['password'] == $password) {
          // echo 'correct pass and id';

          //assign session variables
          session_regenerate_id();
          $_SESSION['emp_id'] = $employee_details['0']['emp_id'];
          $_SESSION['job_id'] = $employee_details['0']['job_id'];
          $_SESSION['password'] = $employee_details['0']['password'];
          $_SESSION['first_name'] = $employee_details['0']['first_name'];
          $_SESSION['last_name'] = $employee_details['0']['last_name'];
          session_write_close();

          //checks type of user
          if($result->num_rows==1 && $_SESSION['job_id'] != "ADMIN") {
            header("location:employee_dash.php");
          } else if($result->num_rows==1 && $_SESSION['job_id'] == "ADMIN") {
            header("location:admin_dash.php");
          } else {
            $msg = '<div class="alert alert-danger" role="alert" style="text-align: center">Employee ID or Password is Incorrect</div>';
          }
          //end of type of user check

        } else {
          $msg = '<div class="alert alert-danger" role="alert" style="text-align: center">Employee ID or Password is Incorrect</div>';
        }
        //end of password check

      } else {
        //print login error as no user with those details exists
        $msg = '<div class="alert alert-danger" role="alert" style="text-align: center">Employee ID or Password is Incorrect</div>';
      }
      //end of id check
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheets\styles-login.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/173e7e290b.js" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <link rel="icon" href="favicon.ico">

    <title>Sign In</title>
  </head>

  <style>
    .bounding {
      background-color: #1f4c85;
      padding: 10px;
      border-radius: 0px 5px 5px 0px;
      text-align: center;
      display: flex;
      justify-content: center;
      height: 100%;
      color: white;
    }
    .bounding:hover {
      text-decoration: none;
      color: white;
    }
  </style>

  <body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="index.html"><i class="fa fa-cube"></i> Workspace</a>
    <!-- <button class="navbar-toggler first-button" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <!-- <li class="nav-item">
          <a class="nav-link" href="login.html"><i class="fas fa-user icon"></i> Login</a>
        </li> -->
      </ul>
    </div>
  </nav>
<!-- Navigation Bar -->
    

        
        <div class="body">
            <section id="page-content">

            <!-- PAGE CONTENT -->
            <!-- Login Page-->
            <section id="container-login">
                <div class="row">
                  <div class="col-md-6 container left-centered login-text-col">
                    <div class="header">
                        <h2 class="main-heading">Welcome Back</h2>
                        <h5 class="sub-heading">Sign into your account and pick up where you left off</h5>
                        <h5 class=""><?= $msg;  ?></h5>
                    </div>

                    <!-- *** -->
                    <form class="login-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                        <div class="form-group input-group input-group-lg text-box">
                            <input type="text" class="form-control login-input" placeholder="Employee Number" name="emp_id" required>
                          </div>

                            <div class="input-group form-group input-group input-group-lg text-box" id="show_hide_password">
                              <input class="form-control login-input" type="password" placeholder="Password" name="password" required>
                              <div class="input-group-addon">
                                <a href="" class="bounding"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                              </div>
                            </div>
                          
                          <!-- <div class="form-group input-group input-group-lg text-box">
                            <input type="password" class="form-control login-input" >
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-lg"><input type="checkbox" onclick="myFunction()"> Show Password</span>
                            </div>
                          </div>  -->


                        <!-- <div class="form-group input-group input-group-lg text-box">
                            <input type="password" id="myPassword" class="form-control login-input" placeholder="Password" name="password" required>
                            <br>
                            <input type="checkbox" onclick="myFunction()">Show Password
                          </div> -->
                        
                        <div class="row submit-links">
                            <div class="col-md-7 login-btn">
                                <button type="submit" name="login" class="btn btn-primary btn-block" value="login">Login</button>
                            </div>
                            <!-- <div class="col-md-5 forgot-pass">
                                <a href="" class="login-link">Forgot Password?</a>
                            </div> -->
                        </div>
                    </form>

                    
                  </div>

                  <div class="col-md-6 container">
                    <img src="images/pexels-timur-saglambilek-87223.jpg" alt="image-of-tutor" class="image login-image mid-centered" >
                  </div>
                </div>
                
              </section>
              <!-- Login Page-->

            </section>
            <!-- PAGE CONTENT -->
    
            <!-- Footer -->
            <!-- Footer -->
        </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
      $(document).ready(function() {
          $("#show_hide_password a").on('click', function(event) {
              event.preventDefault();
              if($('#show_hide_password input').attr("type") == "text"){
                  $('#show_hide_password input').attr('type', 'password');
                  $('#show_hide_password i').addClass( "fa-eye-slash" );
                  $('#show_hide_password i').removeClass( "fa-eye" );
              }else if($('#show_hide_password input').attr("type") == "password"){
                  $('#show_hide_password input').attr('type', 'text');
                  $('#show_hide_password i').removeClass( "fa-eye-slash" );
                  $('#show_hide_password i').addClass( "fa-eye" );
              }
          });
      });
    </script>
  
  </body>
</html>