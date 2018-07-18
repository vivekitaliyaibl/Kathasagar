<style type="text/css">
.mrtl-13{
	margin-top: -13px;
	margin-left: -13px;
}
.mrt-9{
	margin-top: -9px;
}
/*label.error{
	color: red;
	position: absolute;
	width: 100%;
	top: 40px;
	line-height: 14px;
	left: 0px; 
	}*/
</style>


<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title">About Us</h4>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
	</div>
	<!-- /.col-lg-12 -->
</div>

<!--row -->
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-2 offset-md-10" style="margin-top: -10px;">
				<button class="btn btn-block btn-success add-notes-btn" data-toggle="modal" data-target="#add-edit-aboutus" aria-hidden="true">Add Notes</button>
			</div>
			<br/><br/>
		</div>
		<div class=" row row-notes">
			<?php
			if($notes_details) {
				foreach ($notes_details as $key => $value) {
					?>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="notes_id_<?=$value['id']?>">
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="pull-left mrtl-13">
									<label class="switch">
										<input type="checkbox" onchange="status_Changed(this)" id="status_<?=$value['id'];?>" data-id="<?=$value['status']?>" <?php echo ($value['status'] == 1)?'checked="checked"':'';?>/>
										<span class="slider round"></span>
									</label>
								</div>
								<div class="panel-action mrt-9">
									<div class="dropdown"> 
										<a class="dropdown-toggle" id="examplePanelDropdown" data-toggle="dropdown" href="#" aria-expanded="false" role="button">Action 
											<span class="caret"></span>
										</a>
										<ul class="dropdown-menu bullet dropdown-menu-right" aria-labelledby="examplePanelDropdown" role="menu">
											<li role="presentation">
												<a href="javascript:void(0)" role="menuitem" class="edit-notes" data-toggle="modal" data-target="#add-edit-aboutus" aria-hidden="true" data-id="<?=$value['id']?>">
													<i class="icon wb-share" aria-hidden="true"></i> Edit
												</a>
											</li>
											<li role="presentation">
												<a href="javascript:void(0)" role="menuitem" class="delete-notes" data-id="<?=$value['id']?>">
													<i class="icon wb-trash" aria-hidden="true"></i> Delete
												</a>
											</li>
										</ul>
										<textarea style="display: none;" id="text_<?=$value['id']?>"><?=$value['notes']?></textarea>
										<textarea style="display: none;" class="text-view-area" id="texts_<?=$value['id']?>"><?=$value['notes']?></textarea>
									</div>
								</div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body summernote-text" data-id="<?=$value['id']?>">
									<?php echo $value['notes']?>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			} else {
				?>
				<div class="col-md-6 offset-md-3 div-empty">
					<center><strong>Data not found</strong></center>
				</div>
				<?php
			} ?>
		</div>
	</div>
</div>
<!-- / row -->
</div>


<!-- modal -->
<div id="add-edit-aboutus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title header-titles"></h4>
			</div>
			<form  id="add_edit_aboutus" enctype="multipart/form-data" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">About us Notes</label>
								<textarea name="about_us_notes" id="about_us_notes" class="summernote"></textarea>
							</div>
						</div>
					</div>				
					<input type="hidden" name="hide_id" id="hide_id">
					<div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /modal -->


<!--View modal -->
<div id="view-more" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">View</h4>
			</div>
			<div class="modal-body">
				<div class="view-info"></div>		
				<div class="modal-footer">
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- / Viewmodal -->

<script type="text/javascript">
	$(document).ready(function(){
		$('.summernote').summernote({
			height: 300,
			minHeight: null, 
			maxHeight: 200, 
			focus: false
		});
		htmtotext();

		$('#add_edit_aboutus').validate({
			rules:{
				about_us_notes:{
					required: true,
				},
			},
			messages:{
				about_us_notes: {
					required: "Please enter notes.",
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

	$('#add-edit-aboutus').on('hidden.bs.modal', function () { 
		$('.header-titles').text('Add About Us');
		$(this).find('form')[0].reset();
		$('.note-editable').html('');
	    $(this).validate().resetForm();
	});

	$(document).on('click','.add-notes-btn',function(){
		$('#hide_id').val('');
	});

	$(document).on('submit', '#add_edit_aboutus', function() {
		if($(this).validate()){ 
			$('.preloader').show();
			$.ajax({
				type : "post",
				url  : "<?=base_url()?>about-us/add-edit-aboutus-notes",
				data: $(this).serialize(),
				cache:false,
				dataType:"json",
				success : function(response) {
					var data = response.data;
					console.log(data);
					$('.preloader').hide();
					$('#add-edit-aboutus').modal('hide');
					if(response.key == 1) {
						checked = ''
						if(data[0].status == 1) {
							checked = "checked";
						}
						var html = '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="notes_id_'+data[0].id+'"> <div class="panel panel-default"> <div class="panel-heading"> <div class="pull-left mrtl-13"> <label class="switch"> <input type="checkbox" onchange="status_Changed(this)" id="status_'+data[0].id+'" data-id="'+data[0].status+'" checked="'+checked+'"/> <span class="slider round"></span> </label> </div> <div class="panel-action mrt-9"> <div class="dropdown"> <a class="dropdown-toggle" id="examplePanelDropdown" data-toggle="dropdown" href="#" aria-expanded="false" role="button">Action <span class="caret"></span> </a> <ul class="dropdown-menu bullet dropdown-menu-right" aria-labelledby="examplePanelDropdown" role="menu"> <li role="presentation"> <a href="javascript:void(0)" role="menuitem" class="edit-notes" data-toggle="modal" data-target="#add-edit-aboutus" aria-hidden="true" data-id="'+data[0].id+'"> <i class="icon wb-share" aria-hidden="true"></i> Edit </a> </li> <li role="presentation"> <a href="javascript:void(0)" role="menuitem" class="delete-notes" data-id="'+data[0].id+'"> <i class="icon wb-trash" aria-hidden="true"></i> Delete </a> </li> </ul> <textarea style="display: none;" id="text_'+data[0].id+'">'+data[0].notes+'</textarea> <textarea style="display: none;" class="text-view-area" id="texts_'+data[0].id+'">'+data[0].notes+'</textarea> </div> </div> </div> <div class="panel-wrapper collapse in"> <div class="panel-body summernote-text" data-id="'+data[0].id+'">'+data[0].notes+' </div> </div> </div> </div>';
						$('.row-notes').prepend(html);
						htmtotext();
					} else if(response.key == 2){

						$('#notes_id_'+data[0].id).remove();
						checked = ''
						if(data.status == 1) {
							checked = "checked";
						}

						var html = '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="notes_id_'+data[0].id+'"> <div class="panel panel-default"> <div class="panel-heading"> <div class="pull-left mrtl-13"> <label class="switch"> <input type="checkbox" onchange="status_Changed(this)" id="status_'+data[0].id+'" data-id="'+data[0].status+'" checked="'+checked+'"/> <span class="slider round"></span> </label> </div> <div class="panel-action mrt-9"> <div class="dropdown"> <a class="dropdown-toggle" id="examplePanelDropdown" data-toggle="dropdown" href="#" aria-expanded="false" role="button">Action <span class="caret"></span> </a> <ul class="dropdown-menu bullet dropdown-menu-right" aria-labelledby="examplePanelDropdown" role="menu"> <li role="presentation"> <a href="javascript:void(0)" role="menuitem" class="edit-notes" data-toggle="modal" data-target="#add-edit-aboutus" aria-hidden="true" data-id="'+data[0].id+'"> <i class="icon wb-share" aria-hidden="true"></i> Edit </a> </li> <li role="presentation"> <a href="javascript:void(0)" role="menuitem" class="delete-notes" data-id="'+data[0].id+'"> <i class="icon wb-trash" aria-hidden="true"></i> Delete </a> </li> </ul> <textarea style="display: none;" id="text_'+data[0].id+'">'+data[0].notes+'</textarea> <textarea style="display: none;" class="text-view-area" id="texts_'+data[0].id+'">'+data[0].notes+'</textarea> </div> </div> </div> <div class="panel-wrapper collapse in"> <div class="panel-body summernote-text" data-id="'+data[0].id+'">'+data[0].notes+' </div> </div> </div> </div>';
						$('.row-notes').append(html);
						htmtotext();
					}
					$('.div-empty').remove();
				}
			});
		}
		return false;
	});

	$(document).on('click', '.edit-notes', function() {
		var id = $(this).attr('data-id');
		var notes = $('#text_'+id).val();
		$('.note-editable').html(notes);
		$('#about_us_notes').val(notes);
		$('#hide_id').val(id);
		$('.header-titles').text('Edit About Us');
	});

	$(document).on('click', '.delete-notes', function() {
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
				type : "post",
				url  : "<?=base_url()?>about-us/delete-notes",
				data : {id:id},
				cache: false,
				dataType : "json",
				success : function(response) {
					$('.preloader').hide();
					if(response.key == 1) {
						var html = '';
						$('.summernote-text').each(function(i) {
							if(i<=0){
								html = '<div class="col-md-6 offset-md-3 div-empty"> <center><strong>Data not found</strong></center> </div>';
							}
							if(i<= 1 && i != 0){
								html = '';
							}
						});
						$('#notes_id_'+id).remove();
						$.toast({
							heading: 'Aboutus notes successfully delete.',
							position: 'top-right',
							loaderBg:'#ff6849',
							icon: 'success',
							hideAfter: 3500, 
							stack: 6
						});
						$('.row-notes').append(html)
						
					} else {
						$.toast({
							heading: 'Invalid aboutus found your list.',
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

	$(document).on('click', '.view-more', function() {
		var id = $(this).attr('data-id');
		var notes_html = $('#texts_'+id).val();
		$('.view-info').html(notes_html);
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
				url:'<?=base_url();?>about-us/change-status',
				data:'status='+status+'&notes_id='+acc_id,
				type:'post',
				dataType :"json",
				success:function(respones) {
					$('.preloader').hide();
					if (respones.key == '1') {
						$("#"+acc_ids).attr("data-id",status);
						$.toast({
							heading: 'Aboutus status successfully change.',
							position: 'top-right',
							loaderBg:'#ff6849',
							icon: 'success',
							hideAfter: 3500, 
							stack: 6
						});
					} else {
						$.toast({
							heading: 'Error while change aboutus status',
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

	function htmtotext() {
		$('.summernote-text').each(function() {
			var notes = $(this).text();
			var id = $(this).attr('data-id');
			if(notes.length > 150) {
				var sort_desc = notes.substring(0, 150)+"<a href='javascript:void(0)' class='view-more' data-toggle='modal' data-target='#view-more' aria-hidden='true' data-id='"+id+"'>...View More</a>";
				$(this).html(sort_desc);
			} else {
				$(this).text(notes+".");
			}
		});
	}
</script>