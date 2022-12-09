<?php

include('class/dbcon.php');

$object = new sms;

if(!$object->is_login())
{
    header("location:".$object->base_url."");
}

$object->query = "
SELECT * FROM users 
WHERE S_id = '".$_SESSION["S_id"]."'
";

$result = $object->get_result();

include('header.php');

?>
<!-- Admin Profile -->
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Profile</h1>

    <!-- DataTales Example -->
<!-- Admin Profile -->
    <form method="post" id="profile_form" enctype="multipart/form-data">
        <div class="row"><div class="col-md-8"><span id="message"></span><div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col">
                        <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                    </div>
                    <div clas="col" align="right">
                        <input type="hidden" name="action" value="profile" />
                        <button type="submit" name="edit_button" id="edit_button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button>
                        &nbsp;&nbsp;
                    </div>
                </div>
            </div>
            <div class="card-body">
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="username" id="username" class="form-control" required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-maxlength="175" data-parsley-trigger="keyup" />
                        </div>
                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" required  data-parsley-trigger="keyup" />
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" name="capass_button" id="capass_button">Change</button>
                                </div>
                            </div>
                        </div>       
            </div>
        </div></div></div>
    </form>
<!-- Input Old Pass Modal -->
    <div id="capassModal" class="modal fade">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<form method="post" id="capass_form">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="modal_title" style="font-weight: bold; font-size: 20px;">Change Password</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
                    <span id="capassmessage"></span>
						<div class="card">
							<div class="card-header" style="font-weight: bold; font-size: 18px;">Old Password</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12">
											<label>Input Old Password<span class="text-danger">*</span></label>
											<input type="password" name="ocapass" id="ocapass" class="form-control" autocomplete="off" required/>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
                    <input type="hidden" name="action" value="coapass" />
                    <input type="submit" name="btn_ocapass" id="btn_ocapass" class="btn btn-success" value="Submit" />
					</div>
				</div>
			</form>
		</div>
	</div>
<!-- Input New Password Modal -->
    <div id="ncapassModal" class="modal fade">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<form method="post" id="ncapass_form">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="modal_title" style="font-weight: bold; font-size: 20px;">Change Password</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
                    <span id="ncapassmessage"></span>
						<div class="card">
							<div class="card-header" style="font-weight: bold; font-size: 18px;">New Password</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
											<label>New Password<span class="text-danger">*</span></label>
											<input type="password" name="ncapass" id="ncapass" class="form-control" autocomplete="off" required/>
										</div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
											<label>Confirm Password<span class="text-danger">*</span></label>
											<input type="password" name="nccapass" id="nccapass" class="form-control" autocomplete="off" required/>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
                    <input type="hidden" name="action" value="ncccapass" />
                    <input type="submit" name="btn_ncapass" id="btn_ncapass" class="btn btn-success" value="Change" />
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
// Admin Profile Fetch
        <?php
        foreach($result as $row)
        {
        ?>
        $('#username').val("<?php echo $row['username']; ?>");
        $('#password').val("<?php echo $row['password']; ?>");
        <?php
        }
        ?>
// Change Password
    $('#capass_button').click(function(){ 

    $('#capass_form')[0].reset();

    $('#capass_form').parsley().reset();

    $('#capassModal').modal('show');

    });
// Admin Submit Form
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
// Submit Input Old Password Form
    $('#capass_form').parsley();
    
    $('#capass_form').on('submit', function(event){
    event.preventDefault();
    if($('#capass_form').parsley().isValid())
    {
        $.ajax({
        url:"profile_action.php",
        method:"POST",
        data:$(this).serialize(),
        dataType:'json',
        beforeSend:function(){
            $('#btn_ocapass').attr('disabled', 'disabled');
            $('#btn_ocapass').html('wait...');
        },
        success:function(data)
        {
            $('#btn_ocapass').attr('disabled', false);

            if(data.error !== '')
            {
                $('#capassmessage').html(data.error);
                $('#capass_form')[0].reset();
                $('#capass_form').parsley().reset();

                setTimeout(function()
                {
                    $('#capassmessage').html('');
                }, 3000);
                
            }
            if(data.success != '')
            {

                $('#capassmessage').html(data.success);

                setTimeout(function() 
                {
                    $('#capassModal').modal('hide');
                }, 1000);

                setTimeout(function() 
                {
                    $('#ncapassModal').modal('show');
                }, 2000);
                }
        }
        });
    }

    });
// Submit New Password Form
    $('#ncapass_form').parsley();
    
    $('#ncapass_form').on('submit', function(event){
    event.preventDefault();
    if($('#ncapass_form').parsley().isValid())
    {
        $.ajax({
        url:"profile_action.php",
        method:"POST",
        data:$(this).serialize(),
        dataType:'json',
        beforeSend:function(){
            $('#btn_ncapass').attr('disabled', 'disabled');
            $('#btn_ncapass').html('wait...');
        },
        success:function(data)
        {
            $('#btn_ncapass').attr('disabled', false);

            if(data.error !== '')
            {
                $('#ncapassmessage').html(data.error);
                $('#ncapass_form')[0].reset();
                $('#ncapass_form').parsley().reset();

                setTimeout(function()
                {
                    $('#ncapassmessage').html('');
                }, 3000);
                
            }
            if(data.success != '')
            {
                $('#message').html(data.success);

                $('#ncapassModal').modal('hide');

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