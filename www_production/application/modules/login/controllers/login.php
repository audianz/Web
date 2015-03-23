<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller 
{

	public function __construct() 
    {
		parent::__construct();
		$this->load->model('mod_login');
                $this->load->library('email');
    }
	/* Dashboard Page */
	public function index()
	
	{
       if($this->session->userdata('session_publisher_name') !='' and $this->session->userdata('session_user_type') =='TRAFFICKER')
			  {
		           
			   redirect("publisher/dashboard");

              }
              elseif($this->session->userdata('session_advertiser_name') !='' and$this->session->userdata('session_user_type') =='ADVERTISER')
               {
			   redirect("advertiser/dashboard");

                             }
		   	 
		else
                      {
       
			$this->load->view('login');
                      }  
		
	
		
	}
	
		/* Change Password */
	public function change_password()
	{ 
 		/* Breadcrumb Setup Start */
		
		$link = breadcrumb();
		
		$data['breadcrumb'] = $link;
		
		/* Breadcrumb Setup End */
	
		$data['page_content']	=	$this->load->view('changepwd', $data, true);
		
		if($this->session->userdata('session_user_type') =='TRAFFICKER')
		{
			$this->load->view('publisher_layout', $data);
		}
		else if($this->session->userdata('session_user_type') =='ADVERTISER')
		{
			$this->load->view('advertiser_layout', $data);
		}
		else
		{
			redirect('login/login');
		}
	}
	
	public function forgot_password()
	{
		$this->load->view('forgot_password');
	}
	
	function login_process()
	{
		$type			=$this->input->post('checkbox_type'); 
        $remember		=$this->input->post('remember');    
		$inputData 		=array(
								"username"	=>	trim($this->input->post("username")),
								"password"	=>  md5($this->input->post("password"))
   						      );                    

			$admin_login=$this->mod_login->login_process($inputData, $type, $remember);
			 $login_type= $admin_login['type'] ;
                       
			if( $login_type =='TRAFFICKER')
			{
                          
                           if($this->input->post('remember')== '1')
                                        {
                                                $expire=time()+60*60*24*30;
                                                setcookie("cookie_dreamads_publisher_user", $this->input->post('username'), $expire);
                                                setcookie("cookie_dreamads_publisher_user_pwd", $this->input->post('password'), $expire);
												
													
												
												
						//setcookie("cookie_dreamads_user_pwd", $this->input->post('password'), $expire,"/");
                                        }
                                        else
                                        {
                                                $expire=time()-60*60*24*30;
                                                setcookie("cookie_dreamads_publisher_user", '', $expire);
                                                setcookie("cookie_dreamads_user_publisher_pwd", '', $expire);
                                        }     
			  redirect("publisher/dashboard");
		 					
			}
			elseif( $admin_login['type'] == 'ADVERTISER')
			{
                           
                           if($this->input->post('remember')== '1')
                                        {
                                                $expire=time()+60*60*24*30;
                                                setcookie("cookie_dreamads_advertiser_user", $this->input->post('username'), $expire);
                                                setcookie("cookie_dreamads_advertiser_user_pwd", $this->input->post('password'), $expire);
												
												//$expire=time()+60*60*24*30;
												//setcookie("test_cookie from login page", "Welcome To DreamAds");
												
						//setcookie("cookie_dreamads_user_pwd", $this->input->post('password'), $expire,"/");
                                        }
                                        else
                                        {
                                                $expire=time()-60*60*24*30;
                                                setcookie("cookie_dreamads_advertiser_user", '', $expire);
                                                setcookie("cookie_dreamads_user_advertiser_pwd", '', $expire);
                                        }     
			  redirect("advertiser/dashboard");
		 					
			}
			else
			{
			 
				$this->session->set_userdata('message', $this->lang->line('label_invalid_user_password'));
				//$this->index();
				$this->load->view('login'); 
			}	
	  }
	  function login_process_ajax()
	{
                    
		$type			=$this->input->post('checkbox_type'); 
        	$remember		=$this->input->post('remember');    
		$inputData 		=array(
								"username"	=>	trim($this->input->post("username")),
								"password"	=>  md5($this->input->post("password"))
   						      );  
		     $admin_login=$this->mod_login->login_process($inputData, $type, $remember);
			 $login_type= $admin_login['type'] ;
                       
			if( $login_type =='TRAFFICKER')
			{
                          
                           if($this->input->post('remember')== '1')
                                        {
                                                $expire=time()+60*60*24*30;
                                                setcookie("cookie_dreamads_publisher_user", $this->input->post('username'), $expire,"/");
                                                setcookie("cookie_dreamads_publisher_user_pwd", $this->input->post('password'), $expire,"/");
						//setcookie("cookie_dreamads_user_pwd", $this->input->post('password'), $expire,"/");
                                        }
                                        else
                                        {
                                                $expire=time()-60*60*24*30;
                                                setcookie("cookie_dreamads_publisher_user", '', $expire,"/");
                                                setcookie("cookie_dreamads_user_publisher_pwd", '', $expire,"/");
                                        }     
			 echo "1";exit;		
		 					
			}
			elseif( $admin_login['type'] == 'ADVERTISER')
			{
                           
                           if($this->input->post('remember')== '1')
                                        {
												
                                                $expire=time()+60*60*24*30;
                                                setcookie("cookie_dreamads_advertiser_user", $this->input->post('username'), $expire,"/");
                                                setcookie("cookie_dreamads_advertiser_user_pwd", $this->input->post('password'), $expire,"/");
												setcookie("apple_1", "Welcome To DreamAds");
												
						//setcookie("cookie_dreamads_user_pwd", $this->input->post('password'), $expire,"/");
                                        }
                                        else
                                        {
                                                $expire=time()-60*60*24*30;
                                                setcookie("cookie_dreamads_advertiser_user", '', $expire,"/");
                                                setcookie("cookie_dreamads_user_advertiser_pwd", '', $expire,"/");
										}	  
			 echo "2";
			 exit;	
			 
			 
		 					
			}
			else
			{
			 
			echo "yes";exit;	; 
			}	
	  }
	  
	  function forget_password_process()
		{
		    $type		=$this->input->post("checkbox_type");
			$inputData  =array(
							"useremail"	=>	trim($this->input->post("useremail"))
   						     );

			$admin_login=$this->mod_login->forget_password_process($inputData, $type);
		
			if($admin_login !=FALSE)
			{

				$content			=$this->load->view('email/login/forget_password',$admin_login,TRUE);
				$data['content']	=$content;
		    	$mail_content		=$this->load->view('email/login/email_tpl', $data, TRUE);
		 
		     	$admin_email        =$this->mod_login->get_admin_email();
	   		 	$subject            =$this->lang->line('site_title').$this->lang->line('lang_forget_password_subject');
	  		 	$message            =$mail_content;
				$toemail			=$admin_login['email'];
                $config['protocol'] ="sendmail";
                $config['wordwrap'] =TRUE;		
				$config['mailtype']	='html';
				$config['charset']	='UTF-8';        
						
				$this->email->initialize($config);
				$this->email->from($admin_email ,$this->lang->line('site_title'));
				$this->email->to($toemail);        
				$this->email->subject($subject);        
				$this->email->message($message);
				$this->email->send();		

			    $this->session->set_userdata('eamilmessage', $this->lang->line('lang_forget_password_information'));
				$this->load->view('forgot_password');
			}
			else
			{
				$this->session->set_userdata('message', $this->lang->line('invalid_user_emailid'));
				//$this->index();
				$this->load->view('forgot_password'); 
			}
	  }		
	  
	   function forget_password_process_ajax()
		{
		    $type		=$this->input->post("checkbox_type");
			$inputData  =array(
							"useremail"	=>	trim($this->input->post("email"))
   						     );

			$admin_login=$this->mod_login->forget_password_process($inputData, $type);
		
			if($admin_login !=FALSE)
			{

				$content			=$this->load->view('email/login/forget_password',$admin_login,TRUE);
				$data['content']	=$content;
		    	$mail_content		=$this->load->view('email/login/email_tpl', $data, TRUE);
		 
		     	$admin_email        =$this->mod_login->get_admin_email();
	   		 	$subject            =$this->lang->line('site_title').$this->lang->line('lang_forget_password_subject');
	  		 	$message            =$mail_content;
				$toemail			=$admin_login['email'];
                $config['protocol'] ="sendmail";
                $config['wordwrap'] =TRUE;		
				$config['mailtype']	='html';
				$config['charset']	='UTF-8';        
						
				$this->email->initialize($config);
				$this->email->from($admin_email ,$this->lang->line('site_title'));
				$this->email->to($toemail);        
				$this->email->subject($subject);        
				$this->email->message($message);
				$this->email->send();		

			   echo "N0";exit;
			}
			else
			{
				echo "yes";exit;
			}
	  }		
	  
	   function change_password_process()
		{
			$inputData = array(
							   "oldpwd" =>md5($this->input->post("oldpwd")),
							   "newpwd" =>$this->input->post("newpwd")	
						      );
						   
			$password_change	=$this->mod_login->change_password_process($inputData);
			if($password_change != FALSE)
			{
				/*-----------------------------------------------------------------------*/
				/*	SEND  EMAIL TO  CHANGE PASSWORD										 */
				/*-----------------------------------------------------------------------*/
		     
			  $content				= $this->load->view('email/login/change_password', $password_change, TRUE);
			  $data['content']		=$content;
			  $mail_content			=$this->load->view('email/login/email_tpl', $data, TRUE);
		   	  $admin_email          =$this->mod_login->get_admin_email();
	   		  $subject              =$this->lang->line('lang_forget_password_subject');
	  		  $message              =$mail_content;
		      $toemail				=$password_change['email'];
                                       
              $config['protocol']   ="sendmail";
              $config['wordwrap']   =TRUE;		
			  $config['mailtype'] 	='html';
			  $config['charset']	='UTF-8';        
			  
			  $this->email->initialize($config);
			  $this->email->from($admin_email ,'DreamAds');
			  $this->email->to($toemail);        
			  $this->email->subject($subject);        
			  $this->email->message($message);
			  $this->email->send();	
		
			  $this->session->set_flashdata('message', 'Password change is successfully.');
			}
			else
			{
				$this->session->set_flashdata('message', 'Your old Password is incorrect.');
			}	   
			                    
			redirect("login/login/change_password");
	  }		
	  
	 
}

/* End of file dashboard.php */
/* Location: ./modules/dashboard/dashboard.php */
