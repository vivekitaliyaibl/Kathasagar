<style type="text/css">
.mrtl-13{
	margin-top: -13px;
	margin-left: -13px;
}
.mrt-9{
	margin-top: -9px;
}
#map{
	/*width: 40%;*/
	height: 400px;
}
#address{
	width: 95%;
	left: 10px !important;
	top: 8px !important;
}
label.error{
  color: red;
  position: absolute;
  width: 100%;
  top: 40px;
  line-height: 14px;
  left: 0px; 
}
label[for='address']{
	top: 50px !important;
    font-size: 14px !important;
    left: 10px !important;
}
</style>

<?php
if(isset($contact_details)){
	$hide_id = $contact_details['id'];
	$name = $contact_details['name'];
	$address = $contact_details['address'];
	$phoneNo = $contact_details['phone_number'];
	$latitude = $contact_details['lat'];
	$longitude = $contact_details['lng'];
}else {
	$hide_id = '';
	$name = '';
	$address = '';
	$phoneNo = '';
	$latitude = '';
	$longitude = '';
}

?>
<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title">Contact Us</h4>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
	</div>
	<!-- /.col-lg-12 -->
</div>

<!--row -->
<div class="row">
	<div class="col-md-12">
		<!--.row-->
		<div class="row">
			<div class="col-md-12">
				<div class="white-box">
					<div class="row">
						<div class="col-sm-12 col-xs-12">
							<form id="add_edit_contactus" method="post">
								<div class="row">
									<div class="form-group col-md-6">
										<label for="exampleInputuname">Name</label>
										<div class="input-group">
											<div class="input-group-addon"><i class="ti-user"></i></div>
											<input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo $name ?>">
										</div>
									</div>
									<div class="form-group col-md-6">
										<label for="exampleInputuname">Phone Number</label>
										<div class="input-group">
											<div class="input-group-addon"><i class="ti-user"></i></div>
											<input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter phone number" value="<?php echo $phoneNo ?>">
										</div>
									</div>
									<div class="form-group col-md-6">
										<label for="exampleInputEmail1">Address</label>
										<div class="input-group">
											<input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="<?php echo $address ?>"> 
										</div>
										<div id="map"></div>
									</div>
									<input type="hidden" name="hide_id" id="hide_id" value="<?php echo $hide_id ?>">
									<input type="hidden" class="form-control" id="latitude" name="latitude" placeholder="Enter latitude" value="<?php echo $latitude ?>">

									<input type="hidden" class="form-control" id="longitude" name="longitude" placeholder="Enter longitude" value="<?php echo $longitude ?>">
								</div>
								<div class="row">
									<div class="form-group col-md-6">	
										<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
										<button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
<!-- / row -->
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#add_edit_contactus').validate({
	      rules:{
	        name:{
	          required: true,
	        },
	        phone_number : {
	          required: true,
	        },
	        address : {
	          required: true,
	        },
	      },
	      messages:{
	        name: {
	          required: "Please enter name.",
	        },
	        phone_number : { 
	          required : "Please enter Phone number.",
	        },
	        address : { 
	          required : "Please enter address.",
	        },
	      },
	      highlight: function(element) {
	        $(element).parent().addClass('has-error');
	      },
	      unhighlight: function(element) {
	        $(element).parent().removeClass('has-error');
	      },
	    });
	});

	$(document).on('submit', '#add_edit_contactus', function() {
		if($(this).validate()){
			$('.preloader').show();
			$.ajax({
				type : "post",
				url  : "<?=base_url()?>contact-us/add-edit-contactus",
				data: $(this).serialize(),
				cache:false,
				dataType:"json",
				success : function(response) {
					var data = response.data;
					$('.preloader').hide();
					if(response.key == 1) {
						$("#hide_id").val(data.id);
						$.toast({
							heading: 'Contact Detail save successfully.',
							position: 'top-right',
							loaderBg:'#ff6849',
							icon: 'success',
							hideAfter: 3500, 
							stack: 6
						});
					} else if(response.key == 2){
						$.toast({
							heading: 'Contact Detail updated successfully.',
							position: 'top-right',
							loaderBg:'#ff6849',
							icon: 'success',
							hideAfter: 3500, 
							stack: 6
						});
					}
				}
			});
		}
		return false;
	});
</script>
