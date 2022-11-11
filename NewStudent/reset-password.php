<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
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
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    
   
   
<style>

* {
  box-sizing: border-box;
}


    body {
  background-image: url('images/1.png');
  background-repeat: no-repeat;
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
   background-color: #1261A0;
   color: white;
   text-align: center;

}

    
    </style>
</head>
<body>
    

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

          <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <img src="images/logo.png" height="28" alt="Lira's Shop">Lira's Shop
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">

      

                    <a href="home1.php" class="nav-item nav-link">Home</a>
                    <a href="#" class="nav-item nav-link">Blog</a>
                   
                </div>
                
                <div class="navbar-nav ms-auto">
                <nav class="nav nav-pills flex-column flex-sm-row">
                    
                    <a href="logout.php" class="nav-item nav-link">Sign Out</a>
                   
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
      <img src="images/2.png" class="img-fluid" alt="Responsive image" width="80%">
        <h1 class="fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
         Lira's Shop <br />
          <span style="color: hsl(218, 81%, 75%)">Discover your favorite with us.</span>
        </h1>
        <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
        We believe online shopping should be accessible, easy and enjoyable. This is the vision Lira's Shop aspires to deliver on the platform, every single day.

        </p>
      </div>


      


  <div class="addcolumn right">
  <h1 style="text-align:center;">Reset Password</h1>
  <p style="text-align:center;">Please fill out this form to reset your password. </p><br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
               <center> <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-danger" href="login.php">Cancel</a>

            </div>
        </form>
    </div>    
</body>
</html>