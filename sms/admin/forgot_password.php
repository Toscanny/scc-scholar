<!-- Includes&Header -->
<?php

include('../class/dbcon.php');

$object = new sms;

if($object->is_login())
{
  header("location:".$object->base_url."admin/dashboard.php");
}

?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SMS | Forgot Password</title>
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/bootstrap.min.css"/>
      <link rel="stylesheet" type="text/css" href="../vendor/fontawesome-free/all.min.css"/>
      <link rel="stylesheet" type="text/css" href="../vendor/datepicker/bootstrap-datepicker.css"/>
      <link rel="stylesheet" type="text/css" href="../vendor/parsley/parsley.css"/>
      <link rel="stylesheet" type="text/css" href="../vendor/bootstrap-select/bootstrap-select.min.css"/>

    <style>
    .box
    {
    width:800px;
    margin:0 auto;
    }
    .active_tab1
    {
    background-color:#fff;
    color:#333;
    font-weight: 600;
    }
    .inactive_tab1
    {
    background-color: #f5f5f5;
    color: #333;
    cursor: not-allowed;
    }
    .has-error
    {
    border-color:#cc0000;
    background-color:#ffff99;
    }
    </style>
  </head>
  <body>
  <br />
    <div class="container box">
    <br />
    <h2 align="center">Forgot Password</h2><br />
    <span id="message"></span>
    <form method="post" id="change_password_form">
          <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active_tab1" id="list_account_details" style="border:1px solid #ccc">Account Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link inactive_tab1" id="list_otp_details" style="border:1px solid #ccc">OTP Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link inactive_tab1" id="list_pass_details" style="border:1px solid #ccc">Password Details</a>
            </li>
          </ul>
<!-- Account Details -->
  <div class="tab-content" style="margin-top:16px;">
    <div class="tab-pane show active" id="account_details">
      <div class="card">
        <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill Account Details</div>
        <div class="card-body">
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" id="email" class="form-control" />
              <span id="error_email" class="text-danger"></span>
            </div>
            <div class="form-group">
              <div class="alert alert-warning" role="alert" style="font-style: italic;"><b>Note:</b> Please provide your email address to get a code.</div>
            </div>
            <div class="form-group text-center">
            <a class="btn btn-primary" href="index.php" role="button">Back</a>
            <input type="button" name="btn_email" id="btn_email" class="btn btn-success" value="Submit" />
            </div>
        </div>
        </div>
    </div>
<!-- OTP Details -->
      <div class="tab-pane" id="otp_details">
        <div class="card">
            <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill OTP Details</div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                            <label>OTP<span class="text-danger">*</span></label>
                            <input type="text" name="otp" id="otp" class="form-control" required/>
                            <span id="error_otp" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                  <button type="button" name="previous_btn_otp" id="previous_btn_otp" class="btn btn-primary btn-md">Previous</button>
                  <!-- <input type="hidden" name="action" value="otp_verify" /> -->
                  <input type="button" name="btn_otp" id="btn_otp" class="btn btn-success" value="Next" />
                </div>
            </div>
        </div>
      </div>
<!-- Password Details -->
      <div class="tab-pane" id="pass_details">
        <div class="card">
            <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill Password Details</div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                            <label>New Password<span class="text-danger">*</span></label>
                            <input type="password" name="npass" id="npass" class="form-control" required/>
                            <span id="error_npass" class="text-danger"></span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                            <label>Confirm Password<span class="text-danger">*</span></label>
                            <input type="password" name="ncpass" id="ncpass" class="form-control" required/>
                            <span id="error_ncpass" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                  <button type="button" name="previous_btn_pass" id="previous_btn_pass" class="btn btn-primary btn-md">Previous</button>
                  <input type="hidden" name="action" value="change_pass" />
                  <input type="submit" name="btn_pass" id="btn_pass" class="btn btn-success" value="Submit" />
                </div>
            </div>
        </div>
      </div>
    </div>
   </form>
  </div>

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
<!-- Script -->
  <script>
    $(document).ready(function(){

// Input Email Address
  // Account Details
    $('#btn_email').click(function(){
      
      var error_email = '';
      
      if($.trim($('#email').val()).length == 0)
      {
      error_email = 'Email is required';
      $('#error_email').text(error_email);
      $('#email').addClass('has-error');
      }
      else
      {
      error_email = '';
      $('#error_email').text(error_email);
      $('#email').removeClass('has-error');
      }

      if( error_email != '')
      {
        return false;
      }
      else
      {  
            var email = $('#email').val();

            $.ajax({
              url:"forgot_password_action.php",
              method:"POST", 
              data:{email:email, action:'submit_email'},
              dataType:'json',
              beforeSend:function(){
                $('#btn_email').attr('disabled', 'disabled');
              },
              success:function(data)
              {
                $('#btn_email').attr('disabled', false);

                if(data.error !== '')
                {
                  $('#message').html(data.error);
                  setTimeout(function() 
                  {
                    $('#message').html('');
                  }, 2000);
                }
                if(data.success != '')
                {
                  $('#message').html(data.success);
                  setTimeout(function() 
                  {
                    $('#message').html('');
                  }, 2000);

                    $('#list_account_details').removeClass('active active_tab1');
                    $('#list_account_details').removeAttr('href data-toggle');
                    $('#account_details').removeClass('active');
                    $('#list_account_details').addClass('inactive_tab1');
                    $('#list_otp_details').removeClass('inactive_tab1');
                    $('#list_otp_details').addClass('active_tab1 active');
                    $('#list_otp_details').attr('href', '#otp_details');
                    $('#list_otp_details').attr('data-toggle', 'tab');
                    $('#otp_details').addClass('active in');

                }
              }
            });
      }
    });

    $('#previous_btn_otp').click(function(){
    $('#list_otp_details').removeClass('active active_tab1');
    $('#list_otp_details').removeAttr('href data-toggle');
    $('#otp_details').removeClass('active in');
    $('#list_otp_details').addClass('inactive_tab1');
    $('#list_account_details').removeClass('inactive_tab1');
    $('#list_account_details').addClass('active_tab1 active');
    $('#list_account_details').attr('href', '#account_details');
    $('#list_account_details').attr('data-toggle', 'tab');
    $('#account_details').addClass('active in');
    });

// Inputing OTP
  // OTP Details
    $('#btn_otp').click(function(){
      
        var error_otp = '';

        if($.trim($('#otp').val()).length == 0)
        {
          error_otp = 'OTP is required';
        $('#error_otp').text(error_otp);
        $('#otp').addClass('has-error');
        }
        else
        {
          error_otp = '';
        $('#error_otp').text(error_otp);
        $('#otp').removeClass('has-error');
        }

      if(error_otp != '')
      {
        return false
      }

        var otp = $('#otp').val();

        $.ajax({
              url:"forgot_password_action.php",
              method:"POST",
              data:{otp:otp, action:'otp_verify'},
              dataType:'json',
              beforeSend:function(){
                $('#btn_otp').attr('disabled', 'disabled');
              },
              success:function(data)
              {
                $('#btn_otp').attr('disabled', false);
                // $('#verify_sid_form')[0].reset();
                if(data.error !== '')
                {
                  $('#message').html(data.error);
                  setTimeout(function() 
                  {
                    $('#message').html('');
                  }, 2000);
                }
                if(data.success != '')
                {
                  $('#message').html(data.success);
                  setTimeout(function() 
                  {
                    $('#message').html('');
                  }, 2000);

                  $('#list_otp_details').removeClass('active active_tab1');
                  $('#list_otp_details').removeAttr('href data-toggle');
                  $('#otp_details').removeClass('active');
                  $('#list_otp_details').addClass('inactive_tab1');
                  $('#list_pass_details').removeClass('inactive_tab1');
                  $('#list_pass_details').addClass('active_tab1 active');
                  $('#list_pass_details').attr('href', '#pass_details');
                  $('#list_pass_details').attr('data-toggle', 'tab');
                  $('#pass_details').addClass('active in');
                }
              }
            });
    });

    $('#previous_btn_pass').click(function(){
    $('#list_pass_details').removeClass('active active_tab1');
    $('#list_pass_details').removeAttr('href data-toggle');
    $('#pass_details').removeClass('active in');
    $('#list_pass_details').addClass('inactive_tab1');
    $('#list_otp_details').removeClass('inactive_tab1');
    $('#list_otp_details').addClass('active_tab1 active');
    $('#list_otp_details').attr('href', '#otp_details');
    $('#list_otp_details').attr('data-toggle', 'tab');
    $('#otp_details').addClass('active in');
    });

// Inputing New Password
  // Password Details
    $('#btn_pass').click(function(){
        
        var error_npass = '';
        var error_ncpass = '';

        if($.trim($('#npass').val()).length == 0)
        {
          error_npass = 'New Password is required';
        $('#error_npass').text(error_npass);
        $('#npass').addClass('has-error');
        }
        else
        {
          error_npass = '';
        $('#error_npass').text(error_npass);
        $('#npass').removeClass('has-error');
        }

        if($.trim($('#ncpass').val()).length == 0)
        {
          error_ncpass = 'Confirm Password is required';
        $('#error_ncpass').text(error_ncpass);
        $('#ncpass').addClass('has-error');
        }
        else
        {
          error_ncpass = '';
        $('#error_ncpass').text(error_ncpass);
        $('#ncpass').removeClass('has-error');
        }

      if(error_npass != '' || error_ncpass != '')
      {
        return false
      }

      $('#change_password_form').parsley();
    
      $('#change_password_form').on('submit', function(event){
      event.preventDefault();

      if($('#change_password_form').parsley().isValid())
      {
        
        $.ajax({
          url:"forgot_password_action.php",
          method:"POST",
          data:$(this).serialize(),
          dataType:'json',
          beforeSend:function(){
            $('#btn_pass').attr('disabled', 'disabled');
          },
          success:function(data)
          {
            $('#btn_pass').attr('disabled', false);

            if(data.error !== '')
            {
              $('#message').html(data.error);
              setTimeout(function() 
              {
                $('#message').html('');
              }, 2000);
            }
            if(data.success != '')
            {         
              $('#message').html(data.success);
              setTimeout(function() 
              {
                window.location.href = "index.php";
              }, 2000);
            }
          }
        });
      }

    });

  });

  });           
  </script>