<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title">Change Password</h4>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li class="active"><a href="#">Change Password</a></li>
		</ol>
	</div>
	<!-- /.col-lg-12 -->
</div>

<!--row -->
<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="white-box">
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<form id="change_password" method="post">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>New Password</label>
									<div class="input-group">
										<input type="password" class="form-control" name="password" id="password">
										<span class="input-group-addon"><i class="fa fa-key"></i></span> 
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Confirm Password</label>
									<div class="input-group">
										<input type="password" class="form-control" id="confirm_password" name="confirm_password">
										<span class="input-group-addon"><i class="fa fa-key"></i></span> 
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row pull-right">
							<div class="col-md-12">
								<button type="button" class="btn btn-inverse waves-effect waves-light">Cancel</button>
								<button type="button" class="btn btn-success waves-effect waves-light m-r-10 save-password">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- row -->
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#change_password').bootstrapValidator({
			fields: {
				password: {
					validators: { 
						notEmpty: { message: 'Please Enter password'},
						identical: {
							field: 'confirmPassword',
							message: 'The password and its confirm are not the same'
						},
						required:true,
					}
				},
				confirm_password: {
					notEmpty: { message: 'Please Enter confirm password'},
					validators: {
						identical: {
							field: 'password',
							message: 'The password and its confirm are not the same'
						},
						required:true,	
					}
				}
			}
		});
	});

	$(document).on('click', '.save-password', function(){
		$('.preloader').show();
		$.ajax({
			url  : "<?=base_url()?>change-password",
			type : "post",
			data : $('#change_password').serialize(),
			cache: false,
			processData:false,
			dataType : "json",
			success : function(response){
				$('.preloader').hide();
				if(response.key = 1) {
					window.location.href = "<?=base_url()?>/logout/password-pwd-reste-"+response.key;
				} else {
					$.toast({
						heading: 'Sometgthing wrong on paassword update.',
						position: 'top-right',
						loaderBg:'#ff6849',
						icon: 'error',
						hideAfter: 3500, 
						stack: 6
					});
				}
			},
		});
		return false;
	});
</script>