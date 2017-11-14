<?php
class Discussion extends CI_Controller
{

	private $current_line;
	private $recent = true;

	public function __construct()
	{

		parent::__construct();
		$this->lang->load('en_admin_lang');
		$this->load->model('Discussion_model');

	}

	/*
     * Retrieve passcodes,resids,emails from db
     * Load data into crr_view
     *
     */
	public function index()
	{
		$data['title'] = "Marist Disussion Forums";
		$date = date("m/d/Y");
		//$data['rooms'] = $this -> crr_model -> getRooms($date);
		//$data['hours'] = $this -> crr_model -> getHours();
		//$data['resId'] = $this->crr_model->getResIds();
    //    $data['categories'] = $this->crr_model->getCategories();
    //    $data['patrons'] = $this->crr_model->getPatrons();
		//$data['passcode'] = $this -> crr_model -> getPwd(1);
		//$data['Apasscode'] = $this -> crr_model -> getPwd(2);
		//$data['emails'] = $this->crr_model->getEmails();
		$this->load->view('createDiscussion_view', $data);
	}

	public function newDiscussion(){
		$data['title'] = "Marist Disussion Forums";
    $this->load->view('newDiscussion_view.php',$data);
	}
	public function successView(){
		$this->load->view('success_view');
	}
	public function failView(){
		$this->load->view('fail_view');
	}

	public function discussionList(){
		$page_data['query'] = $this->Discussion_model->discussion_list();
		$this->load->view('discussionList_view',$page_data);
	}

	public function discussionDetails(){
		//details include the discussion body, posts on the discussion and the comments on these posts
		//first step - load discussion body, then load related posts and then comments on the posts.
		//$page_data['query'] = $this->Discussion_model->discussion_list();
		//$data = array('d_id' => $this->input->post('d_id'));

		$did = $this->uri->segment(3);
		//fetch discussions from Discussion IDs
		if($did != '') {
			$discussion_data['query'] = $this->Discussion_model->fetch_discussion($did);
			$this->load->view('discussionDetails_view',$discussion_data);
		/*	if($page_data != ''){
				$this->load->view('discussionDetails_view',$page_data);
				}
			else {
				$this->load->view('success_view');
			}*/
		}
		else {
			$this->load->view('fail_view');
		}
	}


	public function create() {
    $this->form_validation->set_rules('cwid', $this->lang->line('cwid'), 'required|min_length[8]|max_length[8]');
    $this->form_validation->set_rules('ds_title', $this->lang->line('discussion_ds_title'), 'required|min_length[1]|max_length[50]');
    $this->form_validation->set_rules('ds_body', $this->lang->line('discussion_ds_body'), 'required|min_length[1]|max_length[500]');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = "Marist Disussion Forums";
			$this->load->view('newDiscussion_view',$data);//add alert and bring user to same page to fill the form again.
		} else {
			$data = array('cwid' => $this->input->post('cwid'),
				            'ds_title' => $this->input->post('ds_title'),
				            'ds_body' =>  $this->input->post('ds_body')
				           );
			if ($this->Discussion_model->create($data)) {
				redirect('Discussion/discussionList'); //need to redirected to the list of discussions __******
			} else {
				// error
				// load view and flash sess error
				$this->load->view('errors/error_exception');
			}
		}
	}
}
 ?>
