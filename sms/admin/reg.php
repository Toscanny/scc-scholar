

<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>SMS | Register</title>
    <!-- Bootstrap CSS -->
    <link href="../vendor/bootstrap/bootstrap.min.css" rel="stylesheet" />
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
  <div class="container box">
   <h2 align="center">Create Account</h2>
   <form method="post" id="student_register_form">
        <span id="message"></span>
          <div class="card">
          <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill Account Details</div>
            <div class="card-body">
            <div class="form-group">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-3">
                    <label>First Name<span class="text-danger">*</span></label>
                    <input type="text" name="sfname" id="sfname" class="form-control" />
                    <span id="error_sfname" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-3">
                    <label>Middle Name<span class="text-danger">*</span></label>
                    <input type="text" name="smname" id="smname" class="form-control" />
                    <span id="error_smname" class="text-danger"></span>
                    </div>
					        <div class="col-xs-12 col-sm-12 col-md-3">
                    <label>Last Name<span class="text-danger">*</span></label>
                    <input type="text" name="slname" id="slname" class="form-control" />
                    <span id="error_slname" class="text-danger"></span>
                  </div>
                  </div>
              </div>
              <div align="center">
                <input type="hidden" name="action" value="student_register" />
                <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-success" value="Register" />
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

<script>

$(document).ready(function(){

    $('#student_register_form').parsley();
    
    $('#student_register_form').on('submit', function(event){
      
      event.preventDefault();

      if($('#student_register_form').parsley().isValid())
      {
        $.ajax({
          url:"reg_action.php",
          method:"POST",
          data:$(this).serialize(),
          dataType:'json',
          beforeSend:function(){
            $('#btn_submit').attr('disabled', 'disabled');
          },
          success:function(data)
          {
            $('#btn_submit').attr('disabled', false);
            $('#student_register_form')[0].reset();
            if(data.error !== '')
            {
              $('#message').html(data.error);
            }
            if(data.success != '')
            {
              $('#message').html(data.success);
            }
          }
        });
      }

    });
});
</script>