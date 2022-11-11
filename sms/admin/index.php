
<?php

include('../class/dbcon.php');

$object = new sms;

if($object->is_login())
{
  header("location:".$object->base_url."admin/dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Scholarship Management System</title>

    <!-- Custom fonts for this template-->
    <!-- <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="../vendor/parsley/parsley.css"/>


    <meta name="viewport" content="width=device-width, initial-scale=1">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>



    <style>
    html,
    /* body {
      height: 100%;
    }

    body {
      display: flex;
      align-items: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }
 */


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



    .form-signin {
      width: 100%;
      max-width: 4000px;
      padding: 5px;
      margin: ;
    }
    .form-signin .checkbox {
      font-weight: 400;
    }
    .form-signin .form-control {
      position: relative;
      box-sizing: border-box;
      height: auto;
      padding: 5px;
      font-size: 16px;
    }
    .form-signin .form-control:focus {
      z-index: 2;
    }
    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
    </style>

</head>

<body>
    


<nav class="navbar navbar-expand-lg navbar-light bg-light">

          <div class="container-fluid">
            <a href="../index1.php" class="navbar-brand">
            <img src="img/SCC.png" alt="scc"  style="width:7vmin;height:7vmin;"> SCC Scholarship Management System
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




            <main class="form-signin">
         <form method="post" id="login_form">
            <!-- <h1 class="h3 mb-3 fw-normal">Scholarship Management System for St. Cecilia's College</h1> -->
            <span id="error"></span>
            <?php
              if(isset($_SESSION["success_message"]))
              {
                echo $_SESSION["success_message"];
                unset($_SESSION["success_message"]);
              }
            ?>
            <span id="message"></span>
            <div class="form-group">
                <input type="text" name="admin_email_address" id="admin_email_address" class="form-control" required autofocus data-parsley-type="email" data-parsley-trigger="keyup" placeholder="Enter Email Address..." />
            </div>
            <div class="form-group">
                <input type="password" name="admin_password" id="admin_password" class="form-control" required  data-parsley-trigger="keyup" placeholder="Password" />
            </div>
            <div class="form-group">
                <button type="submit" name="login_button" id="login_button" class="btn btn-primary btn-user btn-block">Login</button>
            </div>
            <div class="form-group">
                <button type="button" name="register_button" id="register_button" class="btn btn-success btn-user btn-block">Register</button>
            </div>
            <div class="form-group">
                <div class="text-center">
                    <a class="small" href="forgot_password.php">Forgot Password?</a>
                </div>
            </div>
        </form>
    </main>





          </div>
        </div>
      </div>
    </div>
  </div>
</section>











<!-- <body class="text-center"> -->
  

    

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <script type="text/javascript" src="../vendor/parsley/dist/parsley.min.js"></script>

</body>

</html>

<script>

$(document).ready(function(){

    $('#login_form').parsley();

    $('#login_form').on('submit', function(event){
        event.preventDefault();
        if($('#login_form').parsley().isValid())
        {       
            $.ajax({
                url:"login_action.php",
                method:"POST",
                data:$(this).serialize(),
                dataType:'json',
                beforeSend:function()
                {
                    $('#login_button').attr('disabled', 'disabled');
                    $('#login_button').val('wait...');
                },
                success:function(data)
                {
                    $('#login_button').attr('disabled', false);
                    if(data.error != '')
                    {
                        $('#error').html(data.error);
                        $('#login_button').val('Login');
                    }
                    else
                    {
                        window.location.href = data.url;
                    }
                }
            })
        }
    });

});

document. getElementById("register_button"). onclick = function () {
location. href = "register.php";
};

</script>