<?php
/* this model is used to denid common function through the website */
/* put this model in auto load */
class Mdl_common extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }    

  function is_admin_logged_in($mode=0) { 
    $logged_in = $this->session->userdata('logged_in');
    if(!empty($logged_in)){
      $validate=1;
    }else{
      $validate=0;
    }
    
    if($mode==0) {
      if($validate==0)           
        return FALSE;
      else
        return TRUE; 
    } else {
      if($validate!=1)
        redirect('login'); 
    }
  }     
}
?>