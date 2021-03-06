<?php
class mod_account extends CI_Model 
{  
	function get_timezone() 
	{
    	 //$timezone_table=oxm_timezone;             
         $query=$this->db->get('oxm_timezone');
         return $query->result();
	}
	
	function get_country() 
	{
    	           
         $query=$this->db->get('djx_geographic_locations');
         return $query->result();
	}
	
	function get_myaccount() 
	{
    	  $id=$this->session->userdata('session_publisher_account_id');  
		 $this->db->where("accountid",$id);    
         $query=$this->db->get('oxm_userdetails');
		  return $query->result();
		
	}
	
	 function get_admin_email()
     {
          
        $resObj = $this->db->where('default_account_id',2)->get('ox_users');
                      
         if($resObj->num_rows >0)
           {
                        
            $temp = $resObj->result();
            return $temp[0]->email_address;
           }
                                
         else
           {
                        
            return FALSE;
           }
    }
		/*-------------------------------------------
		UPDATE MY Account TABLE
	---------------------------------------------*/
	
	function myaccount_update($data)
	{
	$id=$this->session->userdata('session_publisher_account_id');
	$userDet		=	array(
							
						//"username"		    =>	mysql_real_escape_string($data['username']),
						"email"		   =>mysql_real_escape_string($data['email']),
						"address "	   =>mysql_real_escape_string($data['address']),
						"city"		   =>mysql_real_escape_string($data['city']),
						"state"		   =>mysql_real_escape_string($data['state']),
						"country"	   =>mysql_real_escape_string($data['country']),
						"mobileno"	   =>mysql_real_escape_string($data['mobileno']),
						"paypalid"	   =>mysql_real_escape_string($data['paypalid']),
						"bank_acctype" =>mysql_real_escape_string($data['bank_acctype']),
						"tax"		   =>mysql_real_escape_string($data['tax'])
						);
						
	if(isset($data['avatar'])){
			$userDet["avatar"] = 	mysql_real_escape_string($data['avatar']);
	}

	$userox		=	array(
							
						//"username"		    =>	mysql_real_escape_string($data['username']),
						"email_address"		    =>mysql_real_escape_string($data['email']));
							
	if(isset($data['avatar']))
	{						
		//Unlink process
		$this->db->select('avatar');
		$this->db->where("accountid", $id);
		$query=$this->db->get('oxm_userdetails');
	
		if($query->num_rows()>0)
		{
			$temp=$query->row();
			$avatar_image=$temp->avatar;
	
			if($avatar_image != '')
			{
		
				if(file_exists($this->config->item('user_img_url').$avatar_image))
				{	
				
					unlink($this->config->item('user_img_url').$avatar_image);
				}
				else
				{
					$this->session->set_flashdata('message_error', $this->lang->line('label_upload_path_error'));
					redirect("publisher/myaccount");
				}
			}
		}
	}
	
	$this->db->where("accountid", $id);
	$this->db->update('oxm_userdetails',$userDet);
    $this->db->where("default_account_id",$id);
	$this->db->update('ox_users',$userox);
    
	$up	=array("oac_category_id" => $data['category'],
"email" =>mysql_real_escape_string($data['email']),"updated"=>date("Y-m-d H:i:s"));

	$this->db->where("account_id", $id);
	$this->db->update('ox_affiliates',$up);
	
    $this->session->set_userdata('session_publisher_email',$data['email']);
    // $this->session->set_userdata('session_publisher_name',$data['username']);	
	}

	function myaccount_delete_avatar()
	{
		$id=$this->session->userdata('session_publisher_account_id');	
		//Unlink process
		$this->db->select('avatar');
		$this->db->where("accountid",$id);
		$query=$this->db->get('oxm_userdetails');
	
		if($query->num_rows()>0)
		{
			$temp=$query->row();
			$avatar_image=$temp->avatar;
			if($avatar_image != '')
			{
				if(file_exists($this->config->item('user_img_url').$avatar_image))
				{	
					unlink($this->config->item('user_img_url').$avatar_image);
				}
				else
				{
					$this->session->set_flashdata('message_error', $this->lang->line('label_upload_path_error'));
					redirect("publisher/myaccount");
				}
			}
		}
		
		$userDet		=	array("avatar"		=>	'');
		$this->db->where("accountid",$id);
		$query=$this->db->update('oxm_userdetails',$userDet);
	}	
	
	/* Get Category list */
	function getCategory($where ='')
	{
		if($where !='')
		{
			$this->db->where($where);
		}
		
		$query 		=$this->db->get('djx_campaign_categories');
		
		if($query->num_rows >0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}


}   
