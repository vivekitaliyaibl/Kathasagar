<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" sizes="16x16" href="">
  <title>KathaSagar</title>
  <?php
  // load CSS file from the controller
  if(!empty($CSS)) {
    foreach($CSS as $value) {
      ?>  
      <link href="<?php echo base_url(); ?><?php echo $value;?>" rel="stylesheet">
      <?php
    }
  } ?>
  <!-- Bootstrap Core CSS -->
  <link href="<?php echo base_url(); ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

  <!-- Menu CSS -->
  <link href="<?php echo base_url(); ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
  <!-- toast CSS -->
  <link href="<?php echo base_url(); ?>plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>plugins/bower_components/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />

  <!-- animation CSS -->
  <link href="<?php echo base_url(); ?>css/animate.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet">
  <!-- color CSS -->
  <link href="<?php echo base_url(); ?>css/colors/gray-dark.css" id="theme" rel="stylesheet">

  <script src="<?php echo base_url(); ?>plugins/bower_components/jquery/dist/jQuery.min.js"></script>
  <style type="text/css">
  #side-menu li:last-child{
    margin-bottom: 15px;
  }
</style>
</head>

<body>
  <!-- Preloader -->
  <div class="preloader">
    <div class="cssload-speeding-wheel"></div>
  </div>
  <div id="wrapper">
    <!-- Top Navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
      <div class="navbar-header">
        <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
          <i class="ti-menu"></i>
        </a>
        <div class="top-left-part" style="position: fixed;">
          <a class="logo">
            <b>
            </b>
            <span class="hidden-xs">
            </span>
          </a>
        </div>
        <ul class="nav navbar-top-links navbar-left hidden-xs" style="margin-left: 220px;">
          <li>
            <a class="waves-effect waves-light">
            </a>
          </li>
        </ul>
      </div>
      <!-- /.navbar-header -->
      <!-- /.navbar-top-links -->
      <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->

    <!-- Left navbar-header -->
    <div class="navbar-default sidebar" role="navigation" style="position: fixed;">
      <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <div class="user-profile">
          <div class="dropdown user-pro-body">
            <?php
            if ($this->session->userdata('profile_image') != '') {
              ?>
              <div><img src="<?php echo base_url(); ?>upload/employee_document/<?php echo $this->session->userdata('user_id'); ?>/<?php echo $this->session->userdata('profile_image'); ?>" alt="user-img" class="img-circle"></div>
              <?php
            } else if ($this->session->userdata('gender') == 'M') {
              ?>
              <div><img src="<?php echo base_url(); ?>assets/images/male.png" alt="user-img" class="img-circle" style="border: 1px solid #d6d6d6;"></div>
              <?php

            } else if ($this->session->userdata('gender') == 'F') {
              ?>
              <div><img src="<?php echo base_url(); ?>assets/images/Female.png" alt="user-img" class="img-circle" style="border: 1px solid #d6d6d6;"></div>
              <?php
            } else {
              ?>
              <div><img src="<?php echo base_url(); ?>assets/images/male.png" alt="user-img" class="img-circle" style="border: 1px solid #d6d6d6;"></div>
              <?php
            }
            ?>
            <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$this->session->userdata('name');?><span class="caret"></span>
            </a>
            <ul class="dropdown-menu animated flipInY">
              <!-- <li><a href="<?=base_url();?>profile"><i class="ti-user"></i> My Profile</a></li> -->
              <li><a href="<?=base_url();?>change-password"><i class="ti-key"></i> Change Password</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="<?php echo base_url(); ?>logout"><i class="fa fa-power-off"></i> Logout</a></li>
            </ul>
          </div>
        </div>
        <ul class="nav" id="side-menu">
          <li>
            <a href="<?php echo base_url();?>dashboard" class="waves-effect">
              <i class="fa fa-home" data-icon="v"></i>
              <span class="hide-menu"> Dashboard </span>
            </a>
          </li>

          <!-- <li>
            <a href="<?=base_url()?>Image" class="waves-effect">
              <i class="fa fa-photo"></i>
              <span class="hide-menu">Photos</span>
            </a>
          </li> -->

          <li>
            <a href="<?=base_url();?>videos" class="waves-effect">
              <i class="fa fa-video-camera"></i>
              <span class="hide-menu">Videos</span>
            </a>
          </li>

          <li>
            <a href="<?=base_url()?>advertisement" class="waves-effect">
              <i class="fa fa-television"></i>
              <span class="hide-menu">Advertisement</span>
            </a>
          </li>

          <li>
            <a href="<?=base_url()?>event" class="waves-effect">
              <i class="fa fa-calendar"></i>
              <span class="hide-menu">Event</span>
            </a>
          </li>

        <li>
          <a href="<?=base_url();?>contact-us" class="waves-effect">
            <i class="fa fa-phone"></i>
            <span class="hide-menu">Contact us</span>
          </a>
        </li>

        <li>
          <a href="<?=base_url();?>about-us" class="waves-effect">
            <i class="fa fa-user"></i>
            <span class="hide-menu">About us</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <div id="page-wrapper">
   <div class="container-fluid">