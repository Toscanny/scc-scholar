<?php
// Include config file
session_start();
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT S_id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                $_SESSION['message'] = "Registration Successful";
                header("location: login.php");
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
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

 
    
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
   background-color: #1261A0;
   color: white;
   text-align: center;

}

    </style>
</head>
<body>
    

<nav class="navbar navbar-expand-lg navbar-light bg-light">

          <div class="container-fluid">
            <a href="present.gui.php" class="navbar-brand">
            <img src="img/SCC.png" alt="ched"  style="width:7vmin;height:7vmin;"> SCC Scholarship Management System
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">

      
<!-- 
                    <a href="home1.php" class="nav-item nav-link">Home</a>
                    <a href="blog.php" class="nav-item nav-link">Blog</a> -->
                   
                </div>
                
                <div class="navbar-nav ms-auto">
                <nav class="nav flex-column flex-sm-row">
                    <a href="register.php" class="nav-item nav-link active">Sign up</a>
                    <a href="login.php"  class="nav-item nav-link ">Login</a>
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

      <center>  <h2>Sign Up</h2>
       <center> <p>Please fill this form to create an account.</p> 
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">   
           
       
     
        <div class="form-outline mb-4">
                <!-- <label>Username</label> -->
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>"   placeholder= "Username">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-outline mb-4">
                <!-- <label>Password</label> -->
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder= "Password">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-outline mb-4">
                <!-- <label>Confirm Password</label>  -->
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" placeholder= "Confirm Password">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-outline mb-4">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
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