<?php

include('../class/dbcon.php');

$object = new sms;

if(!$object->is_login())
{
    header("location:".$object->base_url."");
}

if($_SESSION['type'] != 'Student')
{
    header("location:".$object->base_url."");
}

$object->query = "
    SELECT * FROM tbl_student
    WHERE s_id = '".$_SESSION["admin_id"]."'
    ";

$result = $object->get_result();

include('header.php');

?>
<!-- Edit Student Profile -->
    <form method="post" id="profile_form" enctype="multipart/form-data">
        <div class="row justify-content-center">
            <div class="col-md-10">
            <h1 class="h3 mb-4 text-gray-800">Student Profile Management</h1>
            <span id="message"></span>
            <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col">
                        <h5 style="font-weight: bold; font-size: 18px">Profile</h5>
                    </div>
                    <div class="col" align="right">
                        <input type="hidden" name="action" value="student_profile" />
                        <button type="submit" name="edit_button" id="edit_button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button>
                        &nbsp;&nbsp;
                    </div>
                </div>
            </div>
            <div class="card-body">
                        <span id="form_message"></span>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <label>Student First Name<span class="text-danger">*</span></label>
                                    <input type="text" name="sfname" id="sfname" class="form-control" required data-parsley-trigger="keyup" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <label>Student Middle Name<span class="text-danger">*</span></label>
                                    <input type="text" name="smname" id="smname" class="form-control" required data-parsley-trigger="keyup" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <label>Student Last Name<span class="text-danger">*</span></label>
                                    <input type="text" name="slname" id="slname" class="form-control" required data-parsley-trigger="keyup" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label>Student Date of Birth <span class="text-danger">*</span></label>
                                    <input type="date" name="sdbirth" id="sdbirth" class="form-control" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label>Student Address <span class="text-danger">*</span></label>
                                    <input type="text" name="saddress" id="saddress" class="form-control" required data-parsley-trigger="keyup" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label>Student Course<span class="text-danger">*</span></label>
                                    <select name="sccourse" id="sccourse" class="form-control" required>
                                    <option value="">-Select-</option>
                                    <option value="BSIT">BSIT</option>
                                    <option value="BSBA">BSBA</option>
                                    <option value="BEED">BEED</option>
                                    <option value="BSED">BSED</option>
                                    <option value="BSCRIM">BSCRIM</option>
                                    <option value="BSHM">BSHM</option>
                                    <option value="BSTM">BSTM</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label>Student Year Level<span class="text-danger">*</span></label>
                                    <select name="scsyrlvl" id="scsyrlvl" class="form-control" required>
                                    <option value="">-Select-</option>
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label>Student Email Address<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="semail" id="semail" class="form-control" required data-parsley-type="email" data-parsley-trigger="keyup" />
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" name="cemail_button" id="cemail_button">Change</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label>Student Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="spass" id="spass" class="form-control" required  data-parsley-trigger="keyup" />
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" name="cpass_button" id="cpass_button">Change</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<!-- Change Email Modal -->
	<div id="cemailModal" class="modal fade">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<form method="post" id="cemail_form">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="modal_title" style="font-weight: bold; font-size: 20px;">Change Email</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
                    <span id="cmessage"></span>
						<div class="card">
							<div class="card-header" style="font-weight: bold; font-size: 18px;">Email</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12">
											<label>New Email<span class="text-danger">*</span></label>
											<input type="text" name="nssemail" id="nssemail" class="form-control" autocomplete="off" required/>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
                    <input type="hidden" name="action" value="cemail" />
                    <input type="submit" name="btn_cemail" id="btn_cemail" class="btn btn-success" value="Change" />
					</div>
				</div>
			</form>
		</div>
	</div>
<!-- Input OTP Modal -->
    <div id="otpcemailModal" class="modal fade">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<form method="post" id="otpcemail_form">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="modal_title" style="font-weight: bold; font-size: 20px;">Change Email</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
                    <span id="otpcmessage"></span>
						<div class="card">
							<div class="card-header" style="font-weight: bold; font-size: 18px;">OTP</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12">
											<label>Input OTP Code<span class="text-danger">*</span></label>
											<input type="text" name="otpcemail" id="otpcemail" class="form-control" autocomplete="off" required/>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
                    <input type="hidden" name="action" value="otpcemail" />
                    <input type="submit" name="btn_otpcemail" id="btn_otpcemail" class="btn btn-success" value="Change" />
					</div>
				</div>
			</form>
		</div>
	</div>
<!-- Input Old Pass Modal -->
    <div id="cpassModal" class="modal fade">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<form method="post" id="cpass_form">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="modal_title" style="font-weight: bold; font-size: 20px;">Change Password</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
                    <span id="cpassmessage"></span>
						<div class="card">
							<div class="card-header" style="font-weight: bold; font-size: 18px;">Old Password</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12">
											<label>Input Old Password<span class="text-danger">*</span></label>
											<input type="password" name="ocpass" id="ocpass" class="form-control" autocomplete="off" required/>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
                    <input type="hidden" name="action" value="copass" />
                    <input type="submit" name="btn_ocpass" id="btn_ocpass" class="btn btn-success" value="Submit" />
					</div>
				</div>
			</form>
		</div>
	</div>
<!-- Input New Password Modal -->
    <div id="ncpassModal" class="modal fade">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<form method="post" id="ncpass_form">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="modal_title" style="font-weight: bold; font-size: 20px;">Change Password</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
                    <span id="ncpassmessage"></span>
						<div class="card">
							<div class="card-header" style="font-weight: bold; font-size: 18px;">New Password</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
											<label>New Password<span class="text-danger">*</span></label>
											<input type="password" name="ncpass" id="ncpass" class="form-control" autocomplete="off" required/>
										</div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
											<label>Confirm Password<span class="text-danger">*</span></label>
											<input type="password" name="nccpass" id="nccpass" class="form-control" autocomplete="off" required/>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
                    <input type="hidden" name="action" value="ncspass" />
                    <input type="submit" name="btn_ncpass" id="btn_ncpass" class="btn btn-success" value="Change" />
					</div>
				</div>
			</form>
		</div>
	</div>
    <?php
    include('footer.php');
    ?>
<!-- Script -->
    <script>
    $(document).ready(function(){

        <?php
        foreach($result as $row)
        {
        ?>
        $('#sfname').val("<?php echo $row['sfname']; ?>");
        $('#smname').val("<?php echo $row['smname']; ?>");
        $('#slname').val("<?php echo $row['slname']; ?>");
        $('#sdbirth').val("<?php echo $row['sdbirth']; ?>");
        $('#saddress').val("<?php echo $row['saddress']; ?>");
        $('#sccourse').val("<?php echo $row['sccourse']; ?>");
        $('#scsyrlvl').val("<?php echo $row['scsyrlvl']; ?>");
        $('#semail').val("<?php echo $row['semail']; ?>");
        $('#spass').val("<?php echo $row['spass']; ?>");
        <?php
        }
        ?>
// Submit Student Profile
    $('#profile_form').parsley();

	$('#profile_form').on('submit', function(event){
		event.preventDefault();
		if($('#profile_form').parsley().isValid())
		{		
			$.ajax({
				url:"profile_action.php",
				method:"POST",
				data:new FormData(this),
                dataType:'json',
                contentType:false,
                processData:false,
				beforeSend:function()
				{
					$('#edit_button').attr('disabled', 'disabled');
					$('#edit_button').html('wait...');
				},
				success:function(data)
				{
                    $('#edit_button').attr('disabled', false);
                    $('#edit_button').html('<i class="fas fa-edit"></i> Edit');

                    if(data.error != '')
                    {
                        $('#message').html(data.error);
                    }
                    else
                    {
                        $('#message').html(data.success);

                        setTimeout(function(){

                            $('#message').html('');

                        }, 2000);

                        setTimeout(function(){

                        location.reload();

                        }, 4000);
                    }
				}
			})
		}
	});

// Change Email
    $('#cemail_button').click(function(){ 

    $('#cemail_form')[0].reset();

    $('#cemail_form').parsley().reset();

    $('#cemailModal').modal('show');

    });

// Change Password
    $('#cpass_button').click(function(){ 

    $('#cpass_form')[0].reset();

    $('#cpass_form').parsley().reset();

    $('#cpassModal').modal('show');

    });
// Submit Change Email Form
    $('#cemail_form').parsley();
    
    $('#cemail_form').on('submit', function(event){
      event.preventDefault();
      if($('#cemail_form').parsley().isValid())
      {
        $.ajax({
          url:"profile_action.php",
          method:"POST",
          data:$(this).serialize(),
          dataType:'json',
          beforeSend:function(){
            $('#btn_cemail').attr('disabled', 'disabled');
            $('#btn_cemail').html('wait...');
          },
          success:function(data)
          {
            $('#btn_cemail').attr('disabled', false);

            if(data.error !== '')
            {
                $('#cmessage').html(data.error);
                $('#cemail_form')[0].reset();
                $('#cemail_form').parsley().reset();

				setTimeout(function()
                {
                $('#cmessage').html('');
                }, 3000);
                
                // setTimeout(function() 
                // {
                // location.reload();  //Refresh page
                // }, 5000);
            }
            if(data.success != '')
            {
                $('#cmessage').html(data.success);

                setTimeout(function() 
                {
                    $('#cemailModal').modal('hide');
                }, 2000);

                setTimeout(function() 
                {
                    $('#otpcemailModal').modal('show');
                }, 3000);
            }
          }
        });
      }

    });
// Submit OTP Change Email Form
    $('#otpcemail_form').parsley();
        
        $('#otpcemail_form').on('submit', function(event){
        event.preventDefault();
        if($('#otpcemail_form').parsley().isValid())
        {
            $.ajax({
            url:"profile_action.php",
            method:"POST",
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function(){
                $('#btn_otpcemail').attr('disabled', 'disabled');
                $('#btn_otpcemail').html('wait...');
            },
            success:function(data)
            {
                $('#btn_otpcemail').attr('disabled', false);

                if(data.error !== '')
                {
                    $('#otpcmessage').html(data.error);
                    $('#otpcemail_form')[0].reset();
                    $('#otpcemail_form').parsley().reset();

                    setTimeout(function()
                    {
                        $('#otpcmessage').html('');
                    }, 3000);
                    
                }
                if(data.success != '')
                {
                    $('#message').html(data.success);

                    $('#otpcemailModal').modal('hide');

                    setTimeout(function() 
                    {
                        location.reload();  //Refresh page
                    }, 3000);
                }
            }
            });
        }

        });
// Submit Input Old Password Form
    $('#cpass_form').parsley();
    
    $('#cpass_form').on('submit', function(event){
    event.preventDefault();
    if($('#cpass_form').parsley().isValid())
    {
        $.ajax({
        url:"profile_action.php",
        method:"POST",
        data:$(this).serialize(),
        dataType:'json',
        beforeSend:function(){
            $('#btn_ocpass').attr('disabled', 'disabled');
            $('#btn_ocpass').html('wait...');
        },
        success:function(data)
        {
            $('#btn_ocpass').attr('disabled', false);

            if(data.error !== '')
            {
                $('#cpassmessage').html(data.error);
                $('#cpass_form')[0].reset();
                $('#cpass_form').parsley().reset();

                setTimeout(function()
                {
                    $('#cpassmessage').html('');
                }, 3000);
                
            }
            if(data.success != '')
            {

                $('#cpassmessage').html(data.success);

                setTimeout(function() 
                {
                    $('#cpassModal').modal('hide');
                }, 1000);

                setTimeout(function() 
                {
                    $('#ncpassModal').modal('show');
                }, 2000);
                }
        }
        });
    }

    });
// Submit New Password Form
    $('#ncpass_form').parsley();
    
    $('#ncpass_form').on('submit', function(event){
    event.preventDefault();
    if($('#ncpass_form').parsley().isValid())
    {
        $.ajax({
        url:"profile_action.php",
        method:"POST",
        data:$(this).serialize(),
        dataType:'json',
        beforeSend:function(){
            $('#btn_ncpass').attr('disabled', 'disabled');
            $('#btn_ncpass').html('wait...');
        },
        success:function(data)
        {
            $('#btn_ncpass').attr('disabled', false);

            if(data.error !== '')
            {
                $('#ncpassmessage').html(data.error);
                $('#ncpass_form')[0].reset();
                $('#ncpass_form').parsley().reset();

                setTimeout(function()
                {
                    $('#ncpassmessage').html('');
                }, 3000);
                
            }
            if(data.success != '')
            {
                $('#message').html(data.success);

                $('#ncpassModal').modal('hide');

                setTimeout(function() 
                {
                    location.reload();  //Refresh page
                }, 3000);
            }
        }
        });
    }

    });

    });
    </script>