
<?php

class DB {	

    /*
	
	*/
	
	var $db_host = "localhost";
	var $db_name = "pbd_digiedge";
	var $db_user = "root";
	var $db_password = "";
	var $db;
	
	function DB()
	{
		
	}
	
	function open()
	{
		$this->db = mysqli_connect($this->db_host, $this->db_user, $this->db_password);
		$this->_db_error();
		mysqli_select_db($this->db,$this->db_name);
	}

	function close()
	{
		mysqli_close($this->db);
	}

	function _db_error()
	{
		if (mysqli_errno($this->db))
		{
			trigger_error("Database error: #" . mysqli_errno($this->db) . " - " . mysqli_error($this->db), E_USER_ERROR);					
		}
	}

	function execute_reader($cmd)
	{
		$result = array();
		$rs = mysqli_query($this->db,$cmd);
		$this->_db_error();
		$i = 0;
		while ($row = mysqli_fetch_object($rs))
		{
			$result[$i] = $row;
			$i++;
		}
		mysqli_free_result($rs);
		return $result;
	}

	function execute_non_query($cmd)
	{
		mysqli_query($this->db,$cmd);
		$this->_db_error();
		return true;
	}

	function execute_scalar($cmd)
	{
		$rs = mysqli_query($this->db,$cmd);
		$this->_db_error();
		if ($row = mysqli_fetch_array($rs))
		{
			$result = $row[0];
		}
		else
		{
			$result = null;
		}
		mysqli_free_result($rs);
		return $result;
	}

	function check_record($cmd)
	{
		$rs = mysqli_query($this->db,$cmd);
		$this->_db_error();
		if ($row = mysqli_fetch_array($rs))
		{
			$result = 1;
		}
		else
		{
			$result = null;
		}
		mysqli_free_result($rs);
		return $result;
	}

	function fetch_onerow($cmd)
	{
		$rs = mysqli_query($this->db,$cmd);
		$this->_db_error();	
		$result = mysqli_fetch_object($rs);
		mysqli_free_result($rs);
		return $result;
	}

	function cleanQuery($string)
	{
		$st ='';
		if(get_magic_quotes_gpc()) 
		{
			
			$string = stripslashes($string);
		}
		if (phpversion() >= '4.3.0')
		{
			$string = mysqli_real_escape_string($this->db,$string);
		}
		else
		{
			$string = mysqli_escape_string($string);
		}
		return $string;
	}

	function encode($name)
	{
		for( $a=0; $a<2; $a++ )
		{
			$name=base64_encode($name);
			for( $b=0; $b<3; $b++ )
			{
				$name=base64_encode($name);
			}
		}
		return $name;
	}

	function decode($name)
	{			
		for( $a=0; $a<2; $a++ )
		{
			$name=base64_decode($name);
			for( $b=0; $b<3; $b++ )
			{
				$name=base64_decode($name);
			}
		}
		return $name;
	}



	function insertLead($user_name , $email , $phone, $message, $ip_address, $country){

		$query = $this->execute_non_query("INSERT INTO `lead` (`user_name`, `email`, `phone` , `message`,`ip_address`,`country`) VALUES ( '".$user_name."', '".$email."' , '".$phone."' , '".$message."' , '".$ip_address."', '".$country."') ");

		if($query){

		if($query == "success"){
			return "success";
		}
		}else{
			return "error";
		}


	}
	
	
	function insertWebsiteDesignLead($what_you_like_done , $website_type , $website_platform, $website_started, $website_spending, $msg, $website_url,$fn, $em,$pn,$ip,$country){

		$query = $this->execute_non_query("INSERT INTO `webdesign_lp` (`what_you_like_done`, `website_type`, `website_platform`, `website_started`, `website_spending`, `msg`, `website_url`, `cn`, `em`, `pn`, `ip_address`, `country`) VALUES ( '".$what_you_like_done."', '".$website_type."' , '".$website_platform."' , '".$website_started."' , '".$website_spending."' , '".$msg."' , '".$website_url."', '".$fn."', '".$em."', '".$pn."', '".$ip."', '".$country."') ");

		if($query){

		if($query == "success"){
			return "success";
		}
		}else{
			return "error";
		}


	}
	
	
	function fetchAllLeads(){

		$query = $this->execute_reader("SELECT * FROM `lead` order by `id` desc ");

		if($query){
			return $query;
		}else{
			return "error";
		}
		
	}
	
	function fetchAllWebdesignLeads(){

		$query = $this->execute_reader("SELECT * FROM `webdesign_lp` order by `id` desc ");

		if($query){
			return $query;
		}else{
			return "error";
		}
		
	}
	

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function getLocationByIp(){  
  /*  $client_ip  = $_SERVER['HTTP_CLIENT_IP'];
    $forward_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote_ip  = $_SERVER['REMOTE_ADDR'];*/
    $result  = array('countryCode'=>'', 'countryName'=>'', 'region'=>'', 'city'=>'');
  /*  if(filter_var($client_ip, FILTER_VALIDATE_IP)){
        $ip_address = $client_ip;
    }elseif(filter_var($forward_ip, FILTER_VALIDATE_IP)){
        $ip_address = $forward_ip;
    }else{
        $ip_address = $remote_ip;
    }*/
    
     if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ip_address = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ip_address = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ip_address = $_SERVER['REMOTE_ADDR'];
    else
        $ip_address = 'UNKNOWN';
        
    $loc_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip_address));    
    if($loc_data && $loc_data->geoplugin_countryName != null){
        $result['countryCode'] = $loc_data->geoplugin_countryCode;
        $result['countryName'] = $loc_data->geoplugin_countryName;
        $result['region'] = $loc_data->geoplugin_region;
        $result['city'] = $loc_data->geoplugin_city;
    }else{
        $result['countryCode'] = 'US';
    }
    return $result;
}

}

?>