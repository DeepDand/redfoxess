<?php
class Discussion extends CI_Controller
{

	private $current_line;
	private $recent = true;

	public function __construct()
	{

		parent::__construct();
		if(!isset($_SESSION))
    {
        session_start();
				//$_SESSION['id'] = session_id();
    }
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
	  if (isset($_SESSION['LAST_SESSION']) && (time() - $_SESSION['LAST_SESSION'] > 900)) {
					 if(!isset($_SESSION['CAS'])) {
							 $_SESSION['CAS'] = false; // set the CAS session to false
					 }
			 }
		$authenticated = $_SESSION['CAS'];
		$_SESSION['id'] = session_id();
			 //URL accessable when the authentication works
	  //$casurl = "http%3A%2F%2Flocalhost%2Frepository%2F%3Fc%3Dauth%26m%3DdbAuth";
	  //$casurl = "http://localhost/redfoxes/Discussion/createDiscussion_view";
		$casurl = "http%3A%2F%2Flocalhost%2Fredfoxes%2F%3Fc%3DDiscussion%26m%3DcreateDiscussion_view";
		if (!$authenticated) {
					 $_SESSION['LAST_SESSION'] = time(); // update last activity time stamp
					 $_SESSION['CAS'] = true;
					 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=https://login.marist.edu/cas/?service='.$casurl.'">';
					 exit;
				 }
		if ($authenticated) {
		 //$this->session->set_userdata('ad', true); // this needs to be set when the user access is accepted by CAS
		 if (isset($_GET["ticket"])) {
			 //set up validation URL to ask CAS if ticket is good
			 $_url = "https://login.marist.edu/cas/validate";
			 //  $serviceurl = "http://localhost:9090/repository-2.0/?c=repository&m=cas_admin";
			 // $cassvc = 'IU'; //search kb.indiana.edu for "cas application code" to determine code to use here in place of "appCode"
			 //$ticket = $_GET["ticket"];
			 $params = "ticket=$_GET[ticket]&service=$casurl";
			 $urlNew = "$_url?$params";
			// $urlNew = "$_url";

			 //CAS sending response on 2 lines. First line contains "yes" or "no". If "yes", second line contains username (otherwise, it is empty).
			 $ch = curl_init();
			 $timeout = 5; // set to zero for no timeout
			 curl_setopt ($ch, CURLOPT_URL, $urlNew);
			 curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			 ob_start();
			 curl_exec($ch);
			 curl_close($ch);
			 $cas_answer = ob_get_contents();
			 ob_end_clean();

			 //split CAS answer into access and user
			 list($access,$user) = preg_split("/\n/",$cas_answer,2);
			 $access = trim($access);
			 $user = trim($user);
			 //$this->session->set_userdata('access',$access)
			 //set user and session variable if CAS says YES
			 if ($access == "yes") {
					 $user= str_replace('@marist.edu','',$user);
					 $_SESSION['user'] = $user;
					 $_SESSION['access'] = $access;
					 $data['user'] = $_SESSION['user'];
					 $data['title'] = "D Disussion Forums";
					 $ad = $_GET['ticket'];
		 			$this->session->set_userdata('ad',$access);
	 				$this->load->view('createDiscussion_view',$data);
					 } else {
						 echo "<h1>UnAuthorized Access</h1>";
					 }
				 }//END SESSION user
				 else{
					 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=https://login.marist.edu/cas?service='.$casurl.'">';
				 }
			 } else  {
				 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=https://login.marist.edu/cas?service='.$casurl.'">';
			 }
			/* if($_GET['ticket']!='') {
				 if(empty($_SESSION['login'])){
					 $_SESSION['login'] = 'yes';
				 }
		 }*/
	 }



	public function successView(){
		$this->load->view('success_view');
	}

	public function failView(){
		$this->load->view('fail_view');
	}

	public function createDiscussion_view(){

				$data['user'] = $_SESSION['user'];
				$data['title'] = "Marist Disussion Forums";
				$this->load->view('createDiscussion_view',$data);
	}



	public function commentView(){
		$ad = $this->session->userdata('ad');
		if($ad!='') {
			$post_id = $this->uri->segment(3);
			$post_data['query'] = $this->Discussion_model->fetch_postid($post_id);
			$post_data['commentquery'] = $this->Discussion_model->fetch_comment($post_id);
			$this->load->view('comment_view',$post_data);
		} else {
			echo "Please <a href ='http://localhost/redfoxes/Discussion/index'>login</a> first";echo $ad;
		}
	}

	public function discussionList(){
		$page_data['query'] = $this->Discussion_model->discussion_list();
		$this->load->view('discussionList_view',$page_data);
		/*$ad = $this->session->userdata('ad');
		$has_session = session_status() == PHP_SESSION_ACTIVE;
		if(isset($_SESSION['user'])) {
			$page_data['query'] = $this->Discussion_model->discussion_list();
			$this->load->view('discussionList_view',$page_data);
		} else {
			echo "Please <a href ='http://localhost/redfoxes/Discussion/index'>login</a> first";echo $ad;
		}*/
	}

	public function newDiscussion(){
		$data['title'] = "Marist Disussion Forums";
			$this->load->view('newDiscussion_view.php',$data);
	}

	public function addNewPost(){
		$data['title'] = "Marist Disussion Forums";
		$ad = $this->session->userdata('ad');
			if($ad!='') {
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
			} else {
				echo "Please <a href ='http://localhost/redfoxes/Discussion/index'>login</a> first";echo $ad;
			}
		}

		public function addNewComment(){
			$data['title'] = "Marist Disussion Forums";
	    // Submitted form data
			$ad = $this->session->userdata('ad');
			if($ad!='') {
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
			} else {
				echo "Please <a href ='http://localhost/redfoxes/Discussion/index'>login</a> first";echo $ad;
			}
		}

	public function discussionDetails(){
		//details include the discussion body, posts on the discussion and the comments on these posts
		//first step - load discussion body, then load related posts and then comments on the posts.
		//$page_data['query'] = $this->Discussion_model->discussion_list();
		//$data = array('d_id' => $this->input->post('d_id'));
		$ad = $this->session->userdata('ad');
		if($ad!='') {
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
	      //$this->pagination->initialize($config);
	      //$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				$discussion_data['postquery'] = $this->Discussion_model->fetch_post($did);//,$config['per_page'],$page);
				//$discussion_data['links'] = $this->pagination->create_links();
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
		} else {
			echo "Please <a href ='http://localhost/redfoxes/Discussion/index'>login</a> first";echo $ad;
		}
	}


	public function create() {
		$ad = $this->session->userdata('ad');
		if($ad!='') {
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
		} else {
			echo "Please <a href ='http://localhost/redfoxes/Discussion/index'>login</a> first";echo $ad;
		}
	}
}
?>
