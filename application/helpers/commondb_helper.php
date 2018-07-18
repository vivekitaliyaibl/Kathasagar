<?php
/*
+------------------------------------------------------------------+
	Function will be use for generate random string.
	@params-> $table : Name of table
+------------------------------------------------------------------+
*/
function get_random_string($table,$field_code)
{
    // Create a random user id

  if (function_exists('com_create_guid') === true)
  {
    return trim(com_create_guid(), '{}');
  }
  $random_unique  =  sprintf('%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

    //$random_unique = random_string('alnum', 6);
    // Make sure the random user_id isn't already in use
  $CI = get_instance();
  $CI->db->where($field_code, $random_unique);
  $query = $CI->db->get_where($table);

  if ($query->num_rows() > 0)
  {
        // If the random user_id is already in use, get a new number
    $this->get_random_string();
  }
  return $random_unique;
}

function get_random_short_string($table,$field_code,$last_id)
{
    // Create a random user id

  if (function_exists('com_create_guid') === true)
  {
    return trim(com_create_guid(), '{}');
  }

  $random_unique = 'PRO'.$last_id;

    // $random_unique  =  sprintf('%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

    //$random_unique = random_string('alnum', 6);

    // Make sure the random user_id isn't already in use
  $CI = get_instance();
  $CI->db->where($field_code, $random_unique);
  $query = $CI->db->get_where($table);

  if ($query->num_rows() > 0)
  {
        // If the random user_id is already in use, get a new number
    $this->get_random_short_string();
  }
  return $random_unique;
}

function random_number($table,$field_code)
{
    // Create a random user id

  if (function_exists('com_create_guid') === true)
  {
    return trim(com_create_guid(), '{}');
  }
  $random_unique  =  mt_rand(0, 9999).mt_rand(0, 9999).mt_rand(0, 9999);

    //$random_unique = random_string('alnum', 6);

    // Make sure the random user_id isn't already in use
  $CI = get_instance();
  $CI->db->where($field_code, $random_unique);
  $query = $CI->db->get_where($table);

  if ($query->num_rows() > 0)
  {
        // If the random user_id is already in use, get a new number
    $this->get_random_string();
  }
  return $random_unique;
}

/*Roll Field permission check */
function is_allowed($name,$type='',$data="")
{
  $CI = get_instance();
  if($type=="module")
  {
    if($CI->session->userdata('role_name')!="Admin")
    {
      $modules=$CI->session->userdata('role_module');
      if (in_array($name,$modules))
      {
        return true;
      }else
      {
        return false;
      }
    }else
    {
      return true;
    }
  }else
  {
    return false;
  }
}
?>
