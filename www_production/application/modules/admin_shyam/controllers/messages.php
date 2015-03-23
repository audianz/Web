<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->sessid	=$this->session->userdata('mads_sess_admin_id');
		$this->load->library('email');
		/* Models */
		//$this->load->model("mod_suggestions",'suggestions');
    }
	
	/* Suggestion Landing Page */
	public function index()
	{
		redirect('admin/messages/messages_list/0');
	}
  
    function tabview($status=false, $limit=3)
	{
		$data['rs']	=$this->mod_suggestions->get_tablist($this->sessid);
		$content	=$this->load->view('messages/tabview', $data, TRUE);
		echo $content;
	} 

    function messages_list($type=0, $start =0)
	{
		/* Breadcrumb Setup Start */
			$link 					=breadcrumb();
			$data['breadcrumb'] 	=$link;
		/* Breadcrumb Setup End */

		$data['page_title'] 	= $this->lang->line('label_messages');
		
		$where				 =array('oxs.suggestion_reciever' =>$this->sessid); 
 	    $data['rs']		     =$this->mod_suggestions->get_read_listing($where);
	   		
		//echo $this->db->last_query(); die();
		//print_r($data); die();
		$data['page_content']	     =$this->load->view('messages/messages_list', $data, true);
		$this->load->view('page_layout', $data);
	} 
  
    function view($id=false)
	{
		if($id ==false)
		{
			redirect('admin/dashboard');
		}
		else
		{
			$update_status		 =$this->mod_suggestions->set_read_status($id);
			
			$where				 =array('oxs.suggestion_id' =>$id , 'oxs.suggestion_reciever' =>$this->sessid); //,'oxs.suggestion_status' =>0
 	    	$data['rs']		     =$this->mod_suggestions->get_read_listing($where);
		
			$data['content']	=$this->load->view('messages/view_layout', $data, TRUE);
			$this->load->view('messages/view_tpl', $data);
		}
	} 

    function reply($id=false)
	{

	$where				 =array('oxs.suggestion_id' =>$id , 'oxs.suggestion_reciever' =>$this->sessid); //'oxs.suggestion_status' =>0,
 	  $data['rs']	=$this->mod_suggestions->get_read_listing($where);
		
		$data['content']	=$this->load->view('messages/reply_layout', $data, TRUE);
		$this->load->view('messages/view_tpl', $data);
	} 

    function process()
	{
			$date			=date("Y-m-d H:i:s");
			$sendertype		='MANAGER';
			$senderid		=2;
			$recieverid		=$this->input->post('recieverid');
			$subject		=$this->input->post('subject');
			$content		=$this->input->post('content');
			$repliedid		=$this->input->post('suggestionid');
			$recievertype	=$this->input->post('recievertype');
			
			$sender			=$this->input->post('sender');
			$reciever	    =$this->input->post('reciever');

			$update_status		 =$this->mod_suggestions->set_read_status($repliedid);
			
			$ins		=array('suggestion_sender' =>$senderid, 'suggestion_reciever' =>$recieverid, 'suggestion_subject' => $subject, 'suggestion_content' => $content, 'suggestion_repliedid' => $repliedid, 'suggestion_date' => $date, 'suggestion_sendertype' => $sendertype);
	
			$data['sender_email']	=$sender;
			$data['reciever_email']	=$reciever;
			$data['rs']				=$ins;
			$data['recievertype']	=$recievertype;
			$data['content']		=$this->load->view('messages/mail_layout', $data, TRUE);
			$content				=$this->load->view('messages/view_tpl', $data, TRUE);

			////// /////////// Mailing \\\\\\\\\\\\\\\\\\\\\\\
															
			$config['mailtype'] 			='html';
			$config['charset'] 				='UTF-8';	
			$this->email->set_newline("\r\n");
			$this->email->initialize($config);
			$this->email->from($sender);
			$this->email->to($reciever);        
			$this->email->subject($subject);        
			$this->email->message($content);
			$this->email->send();			
			
			////// /////////// Mailing \\\\\\\\\\\\\\\\\\\\\\\

			$this->session->set_flashdata('message', 'Message sent successfully.'/*$this->lang->line('label_suggestions_reply_success')*/);

			$status	=$this->mod_suggestions->insert($ins);
			echo $status;
	} 
	
}

/* End of file myaccount.php */
/* Location: ./modules/admin/myaccount.php */
