<!DOCTYPE html>  
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>plugins/images/IBL-Infotech-logo.jpg"> -->
  <title>Valam Bhakati | Login</title>
  <!-- <title>Elite CRM Admin Template - CRM admin dashboard web app kit</title> -->
  <!-- Bootstrap Core CSS -->
  <link href="<?php echo base_url(); ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
  <!-- animation CSS -->
  <link href="<?php echo base_url(); ?>css/animate.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
  <!-- color CSS -->
  <link href="<?php echo base_url(); ?>css/colors/gray-dark.css" id="theme"  rel="stylesheet">
  <style type="text/css">
  .login-register {
    background: url('<?php echo base_url(); ?>plugins/images/login-register.jpg') center center/cover no-repeat!important;
    height: 100%;
    position: fixed;
  }
</style>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <!-- Preloader -->
  <div class="preloader">
    <div class="cssload-speeding-wheel"></div>
  </div>
  <?php 
  $CI = & get_instance(); 
  if($CI->session->flashdata('success_msg')){ 
    ?>
    <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;"> 
      <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> 
      <?php echo $CI->session->flashdata('success_msg') ?> 
    </div>
    <?php 
  } ?>
  <section id="wrapper" class="login-register">
    <div class="login-box login-sidebar">
      <div class="white-box">
        <form class="form-horizontal form-material" id="loginform" action="<?php echo site_url('check-login');?>" method="post">
          <a href="javascript:void(0)" class="text-center db">
            <!-- <img src="<?php echo base_url(); ?>plugins/images/IBL-Infotech-New-Logo.png" alt="Home" /><br/> -->
          </a>
          <div class="form-group m-t-40">
            <div class="col-xs-12">
              <input class="form-control" name="email" type="text" required placeholder="Email" >
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-12">
              <input class="form-control" name="password" type="password" required placeholder="Password">
            </div>
          </div>

          <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
              <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
            </div>
          </div>
          <?php 
          if(isset($err_in_login)){
            ?>
            <p style="color: red;">Invalid Email or Password</p>
            <?php
          } ?>
        </form>
      </div>
    </div>
  </section>
  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap Core JavaScript -->
  <script src="<?php echo base_url(); ?>bootstrap/dist/js/tether.min.js"></script>
  <script src="<?php echo base_url(); ?>bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
  <!-- Menu Plugin JavaScript -->
  <script src="<?php echo base_url(); ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

  <!--slimscroll JavaScript -->
  <script src="<?php echo base_url(); ?>js/jquery.slimscroll.js"></script>
  <!--Wave Effects -->
  <script src="<?php echo base_url(); ?>js/waves.js"></script>
  <!-- Custom Theme JavaScript -->
  <script src="<?php echo base_url(); ?>js/custom.min.js"></script>
  <!--Style Switcher -->
  <script src="<?php echo base_url(); ?>plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    setTimeout(function(){ 
      $('.alert-dismissable').hide();
    }, 2000);
  });
</script>