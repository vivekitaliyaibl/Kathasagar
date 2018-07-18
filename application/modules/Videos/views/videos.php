<style type="text/css">
label.error{
  color: red;
  position: absolute;
  width: 100%;
  top: 40px;
  line-height: 14px;
  left: 0px; 
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
    <h4 class="page-title">Video</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
  </div>
  <!-- /.col-lg-12 -->
</div>

<!--row -->
<div class="row">
  <div class="col-md-12">
    <div class="white-box">
      <div class="col-md-2 add-new-btn">
        <button class="btn btn-block btn-success" data-toggle="modal" data-target="#add-edit-video" aria-hidden="true">Add Video</button>
      </div>
      <br/><br/>
      <div class="table-responsive">
        <table id="video_tbl" class="table table-striped">
          <thead>
            <tr>
              <th>Video image</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="tech_data">
            <?php
            if($video_details) {
              foreach ($video_details as $key => $value) {
                ?>
                <tr id="<?=$value['id'];?>">
                  <td><img src="<?=base_url()?>/uploads/videos/120_90/<?=$value['viedo_image']?>" class="zoom-img" width="75" height="50"></td>
                  <td>
                    <label class="switch">
                      <input type="checkbox" onchange="status_Changed(this)" id="status_<?=$value['id'];?>" data-id="<?=$value['status']?>" <?php echo ($value['status'] == 1)?'checked="checked"':'';?>/>
                      <span class="slider round"></span>
                    </label>
                  </td>
                  <td>
                    <a href="<?=$value['video_link']?>" target="_blank">
                      <button class="btn btn-success btn-circle waves-effect waves-light" title="link">
                        <i class="fa fa-link"></i>
                      </button>
                    </a>
                    <button class="btn btn-danger btn-circle waves-effect waves-light video-delete" title="Delete" data-id="<?=$value['id'];?>">
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
<!-- /row -->
</div>

<!-- modal -->
<div id="add-edit-video" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title header-titles">Add Video Link</h4>
      </div>
      <form  id="upload-video-link" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="row">
            <!-- <div class="col-md-4">
              <div class="form-group">
                <label class="control-label" for="video_type">Video Type</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-file-video-o"></i></div>
                  <select class="form-control select2" id="video_type"  name="video_type">
                    <option value="" selected>Select type</option>
                    <option value="1" selected="selected">Youtube Link</option>
                    <option value="2">Upload Video</option>
                  </select>
                </div>
              </div>
            </div> -->
            <div class="col-md-12">
              <!-- style="display: none;" -->
              <div class="form-group youtube-link"> 
                <label class="control-label" for="video_link">Youtube Link</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-link"></i></div>
                  <input type="text" class="form-control yt-url" id="video_link" name="video_link">
                </div>
              </div>
              <div class="form-group upload-video" style="display: none;">
                <label class="control-label" for="video_upload">Upload Video</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-upload"></i></div>
                  <input type="file" class="form-control " id="video_upload" name="video_upload">
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="hide_video_id" id="hide_video_id">
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

<script type="text/javascript">
  $(document).ready(function(){
    $("#video_type").change();  
    $('#video_tbl').DataTable();

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

    // $.validator.setDefaults({
    //   ignore: ".upload-video:hidden"
    // });
    // $("#upload-video-link").validate({
    //   ignore: ".youtube-link:hidden"
    // });

    jQuery.validator.addMethod("link", function(value, element) {
      var regExp =  /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
      return value.match(regExp);
    },"Please enter valid url");

    var whitelist = ['ogg','ogv','avi','mpe?g','mov','wmv','flv','mp4', 'mkv'];
    $('#upload-video-link').validate({
      rules:{
        video_type:{
          required: true,
        },
        video_link : {
          required: true,
          link : true,
        },
        // video_upload : {
        //   required: true,
        //   accept: whitelist.join('|'),
        // },
      },
      messages:{ 
        video_type: {
          required: "Please select Video type.",
        },
        video_link : { 
          required : "Please enter youtube link.",
        },
        // video_upload : { 
        //   required : "Please upload video file.",
        //   accept: "Please upload a valid file type.",
        // },
      },
      highlight: function(element) {
        $(element).parent().addClass('has-error');
      },
      unhighlight: function(element) {
        $(element).parent().removeClass('has-error');
      },
    });
  });

  $('#add-edit-video').on('hidden.bs.modal', function () { 
    $('.header-titles').text('Add Video Link')
    $(this).find('form')[0].reset();
    $(this).validate().resetForm();
  });

  $(document).on('submit', '#upload-video-link', function() {
    if($("#upload-video-link").validate()){
     $('.preloader').show();
     var fromdata = new FormData($("#upload-video-link")[0]);
     var videourl = jQuery("input[name='video_link']").val();
     var regExp = /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
     var match = videourl.match(regExp);
     if(match && match[1].length == 11){
      fromdata.append("videourlid", match[1]);
    }
    $.ajax({
      url: '<?= base_url(); ?>videos/video-upload',
      type: "post",
      data: fromdata,
      cache:false,
      dataType:"json",
      processData:false,
      contentType:false,
      success: function(respones) { 
        $('.preloader').hide();
        $('#add-edit-video').modal('hide');
        jQuery.each(respones.data, function(index, value){
          var checked = '';
          if(value.status == 1) {
            checked = "checked";
          }
          newRow = jQuery('#video_tbl').dataTable().fnAddData([
           '<img src="<?=base_url()?>/uploads/videos/1920_1080/'+value.viedo_image+'" class="zoom-img" width="75" height="50">',
           '<label class="switch"> <input type="checkbox" onchange="status_Changed(this)" id="status_'+value.id+'" data-id="'+value.status+'" '+checked+'/> <span class="slider round"></span> </label>',
           '<a href="'+value.video_link+'" target="_blank"> <button class="btn btn-success btn-circle waves-effect waves-light" title="link"> <i class="fa fa-link"></i> </button> </a> <button class="btn btn-danger btn-circle waves-effect waves-light video-delete" title="Delete" data-id="'+value.id+'"> <i class="fa fa-trash "></i> </button>'
           ]);
          var row = $('#video_tbl').dataTable().fnGetNodes(newRow);
          $(row).attr('id', value.id);
          var oSettings = jQuery('#video_tbl').dataTable().fnSettings();
          var nTr = oSettings.aoData[newRow[0] ].nTr;
        });
        $.toast({
          heading: 'Video successfully add.',
          position: 'top-right',
          loaderBg:'#ff6849',
          icon: 'success',
          hideAfter: 3500, 
          stack: 6
        });
        $('#upload-video-link')[0].reset();
      }
    });
  }
  return false;
});

  $(document).on('change', '#video_type', function() {
    if($(this).val() === "1") {
      $('.youtube-link').show();
      $('.upload-video').hide();
      $('#video_upload').val('');
    } else {
      $('.upload-video').show();
      $('.youtube-link').hide();
      $('#video_link').val('');
    }
  });

  $(document).on('click', '.video-delete', function() {
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
        url : "<?=base_url()?>videos/video-delete",
        data : {id:id},
        cache : false,
        dataType : "json",
        success : function(response){
          $('.preloader').hide();
          if(response.key == 1) {
            $('#video_tbl').dataTable().fnDeleteRow($('#'+id));
            $.toast({
              heading: 'Video successfully delete.',
              position: 'top-right',
              loaderBg:'#ff6849',
              icon: 'success',
              hideAfter: 3500, 
              stack: 6
            });
          } else {
            $.toast({
              heading: 'Invalid video found your list.',
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

  function status_Changed(element) {
    var acc_ids = element.getAttribute('id');
    var acc_array = acc_ids.split('_');
    var acc_id = acc_array[1];
    var data_id =   $("#"+acc_ids).attr("data-id");
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
        url:'<?=base_url();?>videos/change-status',
        data:'status='+status+'&video_id='+acc_id,
        type:'post',
        dataType :"json",
        success:function(respones) {
          $('.preloader').hide();
          if (respones.key == '1') {
            $("#"+acc_ids).attr("data-id",status);
            $.toast({
              heading: 'Video status successfully change.',
              position: 'top-right',
              loaderBg:'#ff6849',
              icon: 'success',
              hideAfter: 3500, 
              stack: 6
            });
          } else {
            $.toast({
              heading: 'Error while change video status',
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
</script>