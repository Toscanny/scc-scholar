<!-- Includes&Header -->
  <html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SMS | Register</title>
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/bootstrap.min.css"/>
      <!-- <link rel="stylesheet" type="text/css" href="../vendor/fontawesome-free/all.min.css"/> -->
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
    <h2 align="center">Create Account</h2><br />
    <span id="message"></span>
    <form method="post" id="student_register_form">
          <ul class="nav nav-tabs">
              <li class="nav-item">
                  <a class="nav-link active_tab1" id="list_ss_details" style="border:1px solid #ccc">Student Details</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link inactive_tab1" id="list_account_details" style="border:1px solid #ccc">Account Details</a>
              </li>
          </ul>
<!-- Student ID Details -->
  <div class="tab-content" style="margin-top:16px;">
    <div class="tab-pane show active" id="ss_details">
      <div class="card">
          <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill Student Details</div>
          <div class="card-body">
              <div class="form-group">
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-4">
                          <label>Student ID NO.<span class="text-danger">*</span></label>
                          <input type="text" name="vss_id" id="vss_id" class="form-control" required/>
                          <span id="error_vss_id" class="text-danger"></span>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-4">
                        <label>Last Name<span class="text-danger">*</span></label>
                        <input type="text" name="vslname" id="vslname" class="form-control" />
                        <span id="error_vslname" class="text-danger"></span>
                      </div>
                      <div class="col-xs-10 col-sm-12 col-md-4">
                        <label>Date of Birth<span class="text-danger">*</span></label>
                          <input type="date" name="vsdbirth" id="vsdbirth" autocomplete="off" class="form-control" />
                        <span id="error_vsdbirth" class="text-danger"></span>
                      </div>
                  </div>
              </div>
              <div class="form-group text-center">
              <a class="btn btn-primary" href="index.php" role="button">Back</a>
              <!-- <input type="hidden" name="action" value="ssid_verify" /> -->
              <input type="button" name="btn_ss_details" id="btn_ss_details" class="btn btn-success" value="Next" />
              <!-- <button type="button" name="btn_ss_details" id="btn_ss_details" class="btn btn-success btn-md">Next</button> -->
              </div>
          </div>
      </div>
    </div>
<!-- Account Details -->
        <div class="tab-pane" id="account_details">
          <div class="card">
          <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill Account Details</div>
            <div class="card-body">
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="semail" id="semail" class="form-control" />
                <span id="error_semail" class="text-danger"></span>
              </div>
              <div class="form-group">
                <div class="alert alert-warning" role="alert" style="font-style: italic;"><b>Note:</b> Please provide your email address to get your account credentials and make sure to only use gmail address other addresses is not accepted.</div>
              </div>
              <div class="form-group text-center">
              <button type="button" name="previous_btn_account" id="previous_btn_account" class="btn btn-primary btn-md">Previous</button>
              <input type="hidden" name="action" value="student_register" />
              <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-success" value="Register" />
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

// Student ID Details 
    $('#btn_ss_details').click(function(){
      

        var error_vss_id = '';
        var error_vslname = '';
        var error_vsdbirth = '';

        if($.trim($('#vss_id').val()).length == 0)
        {
          error_vss_id = 'Student ID No. is required';
        $('#error_vss_id').text(error_vss_id);
        $('#vss_id').addClass('has-error');
        }
        else
        {
          error_vss_id = '';
        $('#error_vss_id').text(error_vss_id);
        $('#vss_id').removeClass('has-error');
        }

        if($.trim($('#vslname').val()).length == 0)
        {
          error_vslname = 'Last Name is required';
        $('#error_vslname').text(error_vslname);
        $('#vslname').addClass('has-error');
        }
        else
        {
          error_vslname = '';
        $('#error_vslname').text(error_vslname);
        $('#vslname').removeClass('has-error');
        }

        if($.trim($('#vsdbirth').val()).length == 0)
        {
          error_vsdbirth = 'Date of Birth is required';
        $('#error_vsdbirth').text(error_vsdbirth);
        $('#vsdbirth').addClass('has-error');
        }
        else
        {
          error_vsdbirth = '';
        $('#error_vsdbirth').text(error_vsdbirth);
        $('#vsdbirth').removeClass('has-error');
        }

        if(error_vss_id != '' || 
        error_vslname != '' ||
        error_vsdbirth != ''
        )
      {
        return false
      }
      // else{
        var vss_id = $('#vss_id').val();
        var vslname = $('#vslname').val();
        var vsdbirth = $('#vsdbirth').val();

        $.ajax({
              url:"register_action.php",
              method:"POST",
              data:{vss_id:vss_id, vslname:vslname, vsdbirth:vsdbirth, action:'ssid_verify'},
              dataType:'json',
              beforeSend:function(){
                $('#btn_ss_details').attr('disabled', 'disabled');
              },
              success:function(data)
              {
                $('#btn_ss_details').attr('disabled', false);

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
                  
                  $('#list_ss_details').removeClass('active active_tab1');
                  $('#list_ss_details').removeAttr('href data-toggle');
                  $('#ss_details').removeClass('active');
                  $('#list_ss_details').addClass('inactive_tab1');
                  $('#list_account_details').removeClass('inactive_tab1');
                  $('#list_account_details').addClass('active_tab1 active');
                  $('#list_account_details').attr('href', '#account_details');
                  $('#list_account_details').attr('data-toggle', 'tab');
                  $('#account_details').addClass('active in');

                }
              }
            });
      // }
    });

    $('#previous_btn_account').click(function(){
    $('#list_account_details').removeClass('active active_tab1');
    $('#list_account_details').removeAttr('href data-toggle');
    $('#account_details').removeClass('active in');
    $('#list_account_details').addClass('inactive_tab1');
    $('#list_ss_details').removeClass('inactive_tab1');
    $('#list_ss_details').addClass('active_tab1 active');
    $('#list_ss_details').attr('href', '#ss_details');
    $('#list_ss_details').attr('data-toggle', 'tab');
    $('#ss_details').addClass('active in');
    });
// Account Details
    $('#btn_submit').click(function(){
      
      var error_semail = '';
      var emailval = /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)(?!outlook.com)([\w-]+\.)+[\w-]{2,4})?$/;
      
      if($.trim($('#semail').val()).length == 0)
      {
      error_semail = 'Email is required';
      $('#error_semail').text(error_semail);
      $('#semail').addClass('has-error');
      }
      // else
      // {
      //   if(emailval.test($('#semail').val()))
      //   {
      //     error_semail = 'Invalid Email Only(gmail, hotmail, outlook or yahoo is allowed).';
      //     $('#error_semail').text(error_semail);
      //     $('#semail').addClass('has-error');
      //   }
        else 
        {
          error_semail = '';
          $('#error_semail').text(error_semail);
          $('#semail').removeClass('has-error');
        }
      // }

      if( error_semail != '')
      {
        return false;
      }
      else
      {  
        $('#student_register_form').parsley();
    
        $('#student_register_form').on('submit', function(event){
          event.preventDefault();
          if($('#student_register_form').parsley().isValid())
          {
            $.ajax({
              url:"register_action.php",
              method:"POST",
              data:$(this).serialize(),
              dataType:'json',
              beforeSend:function(){
                $('#btn_submit').attr('disabled', 'disabled');
              },
              success:function(data)
              {
                $('#btn_submit').attr('disabled', false);

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
      }
    });
  });           
  </script>
