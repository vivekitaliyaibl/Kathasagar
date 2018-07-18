<style type="text/css">
label.error{
  color: red;
  position: absolute;
  width: 100%;
  top: 40px;
  line-height: 14px;
  left: 0px; 
}
</style>

<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">Image</h4>
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
        <button class="btn btn-block btn-success add_tech" data-toggle="modal" data-target="#add-image" aria-hidden="true">Add Image</button>
      </div>
      <br/><br/>
      <div class="table-responsive">
        <table id="image_tbl" class="table table-striped">
          <thead>
            <tr>
              <th>Image</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="img_data">
            <?php 
            foreach ($tech_detail as $key => $tech_value) {
              ?>
              <tr id="<?=$tech_value['id'];?>">
                <td><?=$tech_value['tags']?></td>
                <td>
                  <label class="switch">
                    <input type="checkbox" onchange="status_Changed(this)" id="status_<?=$tech_value['id'];?>" data-id="<?=$tech_value['status']?>" <?php echo ($tech_value['status'] == 1)?'checked="checked"':'';?>/>
                    <span class="slider round"></span>
                  </label>
                </td>
                <td>
                  <button class="btn btn-warning btn-circle waves-effect waves-light tech-edit" title="Update" data-id="<?=$tech_value['id'];?>" data-name="<?=$tech_value['tags'];?>" data-toggle="modal" data-target="#edit-technology" aria-hidden="true">
                    <i class="fa fa-pencil-square-o" style="margin-left: 3px;margin-top: 3px;"></i>
                  </button>
                  <button class="btn btn-danger btn-circle waves-effect waves-light tech-delete" title="Delete" data-id="<?=$tech_value['id'];?>">
                    <i class="fa fa-trash "></i>
                  </button>
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /row -->
</div>

<!-- modal -->
<div id="add-image" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title header-titles"> </h4>
      </div>
      <form  id="upload-image" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label>Upload Image File</label>
            <div class="input-group">
              <input type="file" class="form-control" id="image_file" name="image_file">
              <span class="input-group-addon"><i class="fa fa-upload"></i></span> 
            </div>
          </div>
        </div>
        <input type="hidden" name="tech_id_hiiden" id="tech_id_hiiden">
        <div class="modal-footer">
          <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
          <button type="Submit" class="btn btn-success waves-effect waves-light">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /modal -->

<script type="text/javascript">
  $(document).ready(function(){
    $('#designation_tbl').DataTable();
    var whitelist = ['png','jpe?g','gif'];
    $('#upload-image').validate({
      rules:{
        image_file:{
          required: true,
          accept: whitelist.join('|'),
        },
      },
      messages:{ 
        image_file: {
          required:"Please upload image.",
          accept: "Please upload a valid file type. (png, jpe, jpeg)",
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

  $(document).on('submit','#upload-image',function() { 
    if($("#upload-image").validate()){
      
      return false;
    }
  });
</script>

