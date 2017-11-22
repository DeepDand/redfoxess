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

	public function successView(){
		$this->load->view('success_view');
	}

	public function failView(){
		$this->load->view('fail_view');
	}

	public function commentView(){
		$post_id = $this->uri->segment(3);
		$post_data['query'] = $this->Discussion_model->fetch_postid($post_id);
		$post_data['commentquery'] = $this->Discussion_model->fetch_comment($post_id);
		$this->load->view('comment_view',$post_data);
	}

	public function discussionList(){
		$page_data['query'] = $this->Discussion_model->discussion_list();
		$this->load->view('discussionList_view',$page_data);
	}

	public function newDiscussion(){
		$data['title'] = "Marist Disussion Forums";
    $this->load->view('newDiscussion_view.php',$data);
	}

	public function addNewPost(){
		$data['title'] = "Marist Disussion Forums";

    // Submitted form data
    $data['cwid']   = $_POST['cwid'];
    $data['p_title']   = $_POST['postTitle'];
    $data['p_body']   = $_POST['postBody'];
		$data['d_id']   = $_POST['d_id'];
		$did = $_POST['d_id'];
/*    $data['cwid']   = $this->uri->segment(3);
    $data['postTitle']   = $this->uri->segment(4);
    $data['postBody']   = $this->uri->segment(5);
		$data['d_id']   = $this->uri->segment(6);*/


		if($this->Discussion_model->createPost($data)){
			$post_data['postquery'] = $this->Discussion_model->fetch_post($did);
			$post_data['query'] = $this->Discussion_model->fetch_discussion($did);
			$this->load->view('discussionDetails_view',$post_data);
			} else {
				$this->load->view('fail_view');
			}
		}

		public function addNewComment(){
			$data['title'] = "Marist Disussion Forums";
	    // Submitted form data
	    $data['cwid']   = $_POST['cwid'];
	    $data['c_body']   = $_POST['commentBody'];
			$data['p_id'] = $_POST['p_id'];
			$pid = $_POST['p_id'];
			if($this->Discussion_model->createComment($data)){
				$comment_data['query'] = $this->Discussion_model->fetch_post($pid);
				$comment_data['commentquery'] = $this->Discussion_model->fetch_comment($pid);
				$this->load->view('comment_view',$comment_data);
				} else {
					$this->load->view('fail_view');
			}
		}

	public function discussionDetails(){
		//details include the discussion body, posts on the discussion and the comments on these posts
		//first step - load discussion body, then load related posts and then comments on the posts.
		//$page_data['query'] = $this->Discussion_model->discussion_list();
		//$data = array('d_id' => $this->input->post('d_id'));
		$did = $this->uri->segment(3);
		//var_dump($did);
		$pid = array();
		//$pid = $_POST['p_id'];
		//fetch discussions from Discussion IDs
		if($did != '') {
			$discussion_data['query'] = $this->Discussion_model->fetch_discussion($did);
			$config = array();
      $config["base_url"] = base_url() .'Discussion/discussionDetails/';
      $config['total_rows'] = $this->Discussion_model->count_post($did);
      $config['per_page'] = 2;
      $config['uri_segment'] = 3;
      $this->pagination->initialize($config);
      $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$discussion_data['postquery'] = $this->Discussion_model->fetch_post($did,$config['per_page'],$page);
			$discussion_data['links'] = $this->pagination->create_links();
			//$pid['p_ids'] = $this->Discussion_model->fetch_postID($did);
			//$discussion_data['commentquery'] = $this->Discussion_model->fetch_commentDiscussionID($did);
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
