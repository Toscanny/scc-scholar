<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo "welcome";
    header("location:LoginProfile.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT S_id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $S_id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["S_id"] = $S_id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location:LoginProfile.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>

* {
  box-sizing: border-box;
}


    body {
        background-position: center;
  background-size: cover;
  background-image: url("img/1st.png");
  background-repeat: no-repeat;
  min-height: 100%;
}

/* Create three equal columns that floats next to each other */
.addcolumn {

float: left;
width: 100%;
padding: 15px;

}


/* Clear floats after the columns */
.addrow:after {
content: "";
display: table;
clear: both;

}



.right{
width: 50%;
background-color: white;
border-radius: 1em;
}

/* .left{
width: 50%;
padding: 50px;
} */


/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media (max-width: 400px) {
.addcolumn {
  width: 100%;
}
}

.footer {
   position: flex;
   left: 0;
   bottom: 2px;
   width: 100%;
    padding: 20px;
   background-color: red;
   color: white;
   text-align: center;

}

    
    </style>
</head>
<body>
    

<nav class="navbar navbar-expand-lg navbar-light bg-light">

          <div class="container-fluid">
            <a href="../index1.php" class="navbar-brand">
            <img src="img/SCC.png" alt="ched"  style="width:7vmin;height:7vmin;"> SCC Scholarship Management System
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">

      

                   
                </div>
                
                <div class="navbar-nav ms-auto">
                <nav class="nav flex-column flex-sm-row">
                    <a href="register.php" class="nav-item nav-link ">Sign up</a>
                    <a href="login.php"  class="nav-item nav-link active">Login</a>
                </div></nav>
            </div>
        </div>
    </nav>






    <div class="addrow">
    <div class="addcolumn">
    <!-- <section class="background-radial-gradient overflow-hidden">
     -->
  <div class="container px-md-5 text-center text-lg-start my-5">
    <div class="row gx-lg-5 align-items-center mb-5">
      <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
      <!-- <img src="images/2.png" class="img-fluid" alt="Responsive image" width="80%"> -->
        <h1 class="fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
        St. Cecilia's College - Cebu, Inc. <br />
          <!-- <span style="color: hsl(218, 81%, 75%)">Discover your favorite with us.</span> -->
        </h1>
        <p class="mb-4 opacity-100" style="color: white">
        SCC is a non-stock, non-profit educational institution that envisions itself to be a Center of excellence in Academics, Technology, and the Arts. It aspires to produce professionals and leaders who are globally competitive, imbued with Christian values, integrity, patriotism and stewardship, through quality human education.
        </p>
      </div>


      


  <div class="addcolumn right">
      <h1 style="text-align:center;">Login</h1>    
      <p style="text-align:center;">Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';}        
        ?>

        <?php 
            if(isset($_SESSION['message']))
            {
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Hi!</strong> You may login Now!.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
            }
            unset($_SESSION['message']);
         ?>

       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-outline mb-4">
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder= "Username">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    

            <div class="form-outline mb-4">
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder= "Password">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>

            <div class="form-outline mb-4">
             <center>   <input type="submit" class="btn btn-primary" value="Login">
            </div>

            <center> <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>



        </form>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- <div class="footer">
<center><h6>Copyright © 2021 Lira's Shop. Trademarks belong to their respective owners. All rights reserved.</h4>
</div> -->

</body>
</html>