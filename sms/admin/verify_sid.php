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
   <form method="post" id="verify_sid_form">
<!-- Student ID Details -->
<div class="tab-content" style="margin-top:16px;">
    <div class="tab-pane show active" id="ss_id_details">
      <div class="card">
          <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill Student ID Details</div>
          <div class="card-body">
              <div class="form-group">
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                          <label>Student ID NO.<span class="text-danger">*</span></label>
                          <input type="text" name="ss_id" id="ss_id" class="form-control" />
                          <span id="error_ss_id" class="text-danger"></span>
                      </div>
                  </div>
              </div>
              <div class="form-group text-center">
              <a class="btn btn-primary" href="index.php" role="button">Back</a>
              <input type="hidden" name="action" value="sid_verify" />
              <input type="submit" name="btn_sid_verify" id="btn_sid_verify" class="btn btn-success" value="Next" />
              <!-- <button type="button" name="btn_ss_id_details" id="btn_ss_id_details" class="btn btn-success btn-md">Next</button> -->
              </div>
          </div>
      </div>
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
<script>
// Student Details
    $(document).ready(function(){

  // sid 
    $('#btn_sid_verify').click(function(){
      
        var error_ss_id = '';

        if($.trim($('#ss_id').val()).length == 0)
        {
        error_ss_id = 'Student ID No. is required';
        $('#error_ss_id').text(error_ss_id);
        $('#ss_id').addClass('has-error');
        }
        else
        {
        error_ss_id = '';
        $('#error_ss_id').text(error_ss_id);
        $('#ss_id').removeClass('has-error');
        }

        if(error_ss_id != '')
      {
        return false
      }
    // else{
        $('#verify_sid_form').parsley();
    
        $('#verify_sid_form').on('submit', function(event){
          event.preventDefault();
          if($('#verify_sid_form').parsley().isValid())
          {
            $.ajax({
              url:"verify_sid_action.php",
              method:"POST",
              data:$(this).serialize(),
              dataType:'json',
              beforeSend:function(){
                $('#btn_sid_verify').attr('disabled', 'disabled');
              },
              success:function(data)
              {
                $('#btn_sid_verify').attr('disabled', false);
                // $('#verify_sid_form')[0].reset();
                if(data.error !== '')
                {
                    $('#message').html(data.error);
                    //For wait 2 seconds
                    setTimeout(function() 
                    {
                    location.reload();  //Refresh page
                    }, 1000);
                    }
                if(data.success != '')
                {
                  $('#message').html(data.success);
                  location. href = "register.php";
                }
              }
            });
          }

        });
    //   }
    });
});
</script>