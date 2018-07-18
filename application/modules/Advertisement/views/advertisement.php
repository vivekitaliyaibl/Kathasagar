<style type="text/css">
.mrtl-13{
	margin-top: -13px;
	margin-left: -13px;
}
.mrt-9{
	margin-top: -9px;
}
label.error{
	color: red;
	position: absolute;
	width: 100%;
	top: 40px;
	line-height: 14px;
	left: 0px; 
}
body.stop-scrolling{
	overflow-x: hidden;
}
.zoom-img {
	transition: transform .2s;
	cursor: pointer;
}

.zoom-img:hover {
	-ms-transform: scale(1.2); /* IE 9 */
	-webkit-transform: scale(1.2); /* Safari 3-8 */
	transform: scale(1.2);
	box-shadow: 2px 2px 2px 0px #465c6f;
}
.product-image-overlay {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: rgba(0, 0, 0, 0.9);
	z-index: 9999;
	display: none;
}

.product-image-overlay .product-image-overlay-close {
	display: block;
	position: absolute;
	top: 20px;
	left: 20px;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	border: 1px solid #eee;
	line-height: 35px;
	font-size: 20px;
	color: #eee;
	text-align: center;
	cursor: pointer;
}

.product-image-overlay img {
	width: auto;
	max-width: 80%;
	position: absolute;
	top: 50%;
	left: 50%;
	-webkit-transform: translate(-50%, -50%);
	-moz-transform: translate(-50%, -50%);
	-o-transform: translate(-50%, -50%);
	transform: translate(-50%, -50%);
}
</style>

<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title">Advertisement</h4>
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
					<div class="col-md-2 add-new-btn">
						<button class="btn btn-block btn-success" data-toggle="modal" data-target="#add-edit-advertisement" aria-hidden="true">Add Advertisement</button>
					</div>
					<br/><br/>
					<div class="table-responsive">
						<table id="advertisement_tbl" class="table table-striped">
							<thead>
								<tr>
									<th>Advertisement image</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="">
								<?php
								if($advertise_details) {
									foreach ($advertise_details as $key => $value) {
										?>
										<tr id="<?=$value['id'];?>">
											<td><img src="<?=base_url()?>uploads/valamadvertisement/120_90/<?= $value['advertise_image']?>" class="zoom-img" width="75" height="50"></td>
											<td>
												<label class="switch">
													<input type="checkbox" onchange="status_Changed(this)" id="status_<?=$value['id'];?>" data-id="<?=$value['status']?>" <?php echo ($value['status'] == 1)?'checked="checked"':'';?>/>
													<span class="slider round"></span>
												</label>
											</td>
											<td>
												<!-- <button class="btn btn-success btn-circle waves-effect waves-light advertise-update" title="update" data-id="<?=$value['id'];?>">
													<i class="fa fa-edit "></i>
												</button> -->
												<button class="btn btn-danger btn-circle waves-effect waves-light advertise-delete" title="Delete" data-id="<?=$value['id'];?>">
													<i class="fa fa-trash "></i>
												</button>
											</td>
										</tr>
										<?php
									}
								}  ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
<!-- / row -->
</div>

<!-- modal -->
<div id="add-edit-advertisement" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title header-titles">Add Advertisement Image</h4>
			</div>
			<form  id="upload-advertisement-image" enctype="multipart/form-data" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group youtube-link"> 
								<label class="control-label" for="video_link">Advertisement Image</label>
								<div class="input-group">
									<input type="file" class="form-control" id="inputImage" name="inputimage" >
								</div>
							</div>
						</div>
					</div>
					<img id="image" src="" width="100%">
					<input type="hidden" name="hide_advertise_id" id="hide_advertise_id">
					<div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success waves-effect waves-light" data-method="">Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /modal -->

<script type="text/javascript">
	$(document).ready(function(){
		/*crop image */
		var $image = $('#image');
		$image.cropper({
			aspectRatio: 16 / 9,
			preview: '.img-preview',
		});

		// Import image
		var $inputImage = $('#inputImage');
		var URL = window.URL || window.webkitURL;
		var blobURL;

		if (URL) {
			$inputImage.change(function () {
				var files = this.files;
				var file;

				if (!$image.data('cropper')) {
					return;
				}

				if (files && files.length) {
					file = files[0];

					if (/^image\/\w+$/.test(file.type)) {
						blobURL = URL.createObjectURL(file);
						$image.one('built.cropper', function () {
			            // Revoke when load complete
			            URL.revokeObjectURL(blobURL);
			        }).cropper('reset').cropper('replace', blobURL);
			          //$inputImage.val('');
			      } else {
			      	window.alert('Please choose an image file.');
			      }
			  }
			});
		} else {
			$inputImage.prop('disabled', true).parent().addClass('disabled');
		}
		/*end crop image*/

		/*view image on click*/
		$('body').append('<div class="product-image-overlay"><span class="product-image-overlay-close">x</span><img src="" /></div>');
		var productImage = $('.zoom-img');
		var productOverlay = $('.product-image-overlay');
		var productOverlayImage = $('.product-image-overlay img');

		$(document).on('click', '.zoom-img', function() {
    	//productImage.click(function () {
    		var productImageSource = $(this).attr('src');
    		productImageSource = productImageSource.replace("120_90", "orignal");
    		productOverlayImage.attr('src', productImageSource);
    		productOverlay.fadeIn(100);
    		$('body').css('overflow', 'hidden');

    		$('.product-image-overlay-close').click(function () {
    			productOverlay.fadeOut(100);
    			$('body').css('overflow', 'auto');
    		});
    	});
		/*end view image*/
		
		$('#advertisement_tbl').DataTable();
		$('#upload-advertisement-image').validate({
			rules:{
				inputimage:{
					required: true,
				},
			},
			messages:{
				inputimage: {
					required: "Please enter image.",
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

	$('#add-edit-advertisement').on('hidden.bs.modal', function () { 
		$(this).find('form')[0].reset();
		$(this).validate().resetForm();
		$("#image").attr('src','');
		$(".cropper-container.cropper-bg").remove();
	});

	$(document).on('submit', '#upload-advertisement-image', function() {
		if($("#upload-advertisement-image").validate()){
			$('.preloader').show();
			var cropcanvas = $('#image').cropper('getCroppedCanvas');
			var croppng = cropcanvas.toDataURL("image");
			var hide_id = $("#hide_advertise_id").val();
			//var formData = new FormData();
			//var fromdata = new FormData($("#upload-event-image")[0]);
			$.ajax({
				url: '<?= base_url(); ?>valamadvertise/valamadvertise-upload',
				type: "post",
				data: {
					imageData:croppng,
					hide_id:hide_id
				},
				cache:false,
				dataType:"json",
				//processData:false,
				//contentType:false,
				success: function(response) {
					$('.preloader').hide();
					$('#add-edit-advertisement').modal('hide');
					var data = response.data;
					if(response.key == 1) {
						jQuery.each(data, function(index, value){
							var checked = '';
							if(value.status == 1) {
								checked = "checked";
							}
							newRow = jQuery('#advertisement_tbl').dataTable().fnAddData([
								'<img src="<?=base_url()?>uploads/valamadvertisement/120_90/'+value.advertise_image+'" class="zoom-img" width="75" height="50">',
								'<label class="switch"> <input type="checkbox" onchange="status_Changed(this)" id="status_'+value.id+'" data-id="'+value.status+'" '+checked+'/> <span class="slider round"></span> </label>',
								'<button class="btn btn-danger btn-circle waves-effect waves-light advertise-delete" title="Delete" data-id="'+value.id+'"> <i class="fa fa-trash "></i> </button>'
								]);
							var row = $('#advertisement_tbl').dataTable().fnGetNodes(newRow);
							$(row).attr('id', value.id);
							var oSettings = jQuery('#advertisement_tbl').dataTable().fnSettings();
							var nTr = oSettings.aoData[newRow[0] ].nTr;
						});

						$.toast({
							heading: 'Advertisement successfully add.',
							position: 'top-right',
							loaderBg:'#ff6849',
							icon: 'success',
							hideAfter: 3500, 
							stack: 6
						});
					} else if(response.key == 2){
						$.toast({
							heading: 'Advertisement updated successfully.',
							position: 'top-right',
							loaderBg:'#ff6849',
							icon: 'success',
							hideAfter: 3500, 
							stack: 6
						});
					}
					$("#image").attr('src','');
					$(".cropper-container.cropper-bg").remove();
					$('#upload-advertisement-image')[0].reset();
				}
			});
		}
		return false;
	});

	function status_Changed(element) {
		var acc_ids = element.getAttribute('id');
		var acc_array = acc_ids.split('_');
		var acc_id = acc_array[1];
		var data_id = 	$("#"+acc_ids).attr("data-id");
		var status = "";
		swal({
			title: "Are you sure?",   
			text: "You want to change status!",   
			type: "warning",   
			showCancelButton: true,   
			confirmButtonColor: "#DD6B55",   
		}, function(isConfirm){
			if (!isConfirm){
				if(data_id == 1) {
					$("#"+acc_ids).prop("checked", "checked");
				}else {
					$("#"+acc_ids).prop('checked', false); 
				}
				return;	
			}
			$('.preloader').show();
			if(element.checked){
				status = 1;
			}else{
				status = 0;
			}
			$.ajax({
				url:'<?=base_url();?>valamadvertise/change-status',
				data:'status='+status+'&advertise_id='+acc_id,
				type:'post',
				dataType :"json",
				success:function(respones) {
					$('.preloader').hide();
					if (respones.key == '1') {
						$("#"+acc_ids).attr("data-id",status);
						$.toast({
							heading: 'Advertisement status successfully change.',
							position: 'top-right',
							loaderBg:'#ff6849',
							icon: 'success',
							hideAfter: 3500, 
							stack: 6
						});
					} else {
						$.toast({
							heading: 'Error while change Advertisement status',
							position: 'top-right',
							loaderBg:'#ff6849',
							icon: 'error',
							hideAfter: 3500
						});
					}
				}
			});
		});
	}


	$(document).on('click', '.advertise-delete', function() {
		var id = $(this).attr('data-id');
		swal({
			title: "Are you sure?",   
			text: "You will not be able to recover this imaginary file!",   
			type: "warning",   
			showCancelButton: true,   
			confirmButtonColor: "#DD6B55",   
		}, function(isConfirm){
			if (!isConfirm) return;
			$('.preloader').show();
			$.ajax({
				type : "POST",
				url : "<?=base_url()?>valamadvertise/valamadvertise-delete",
				data : {id:id},
				cache : false,
				dataType : "json",
				success : function(response){
					$('.preloader').hide();
					if(response.key == 1) {
						$('#advertisement_tbl').dataTable().fnDeleteRow($('#'+id));
						$.toast({
							heading: 'Advertisement successfully delete.',
							position: 'top-right',
							loaderBg:'#ff6849',
							icon: 'success',
							hideAfter: 3500, 
							stack: 6
						});
					} else {
						$.toast({
							heading: 'Invalid Advertisement found your list.',
							position: 'top-right',
							loaderBg:'#ff6849',
							icon: 'error',
							hideAfter: 3500, 
							stack: 6
						});
					}
				}
			});
		});
	});
</script>
