<?php
class Discussion_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		// $this->load->database();
	}
  public function create($data) {
    // Look and see if the email address already exists in the users
    // table, if it does return the primary key, if not create them
    // a user account and return the primary key.
    $discussion_data = array('cwid' => $data['cwid'],'d_title' => $data['ds_title'],'d_body' =>$data['ds_body'],'category'=>'General'); //can be added a field for active discussions 'ds_is_active' => '1'
		$inserting =  $this->db->insert("discussion",$discussion_data);
    if ($inserting) {
			return 1;
		} else {
			return 0;
		}
	}
	public function createPost($data) {
    // Look and see if the email address already exists in the users
    // table, if it does return the primary key, if not create them
    // a user account and return the primary key.
    $post_data = array('d_id' => $data['d_id'],'p_title' => $data['p_title'],'p_body' =>$data['p_body'],'cwid' =>$data['cwid']); //can be added a field for active discussions 'ds_is_active' => '1'
		$inserting =  $this->db->insert("post",$post_data);
    if ($inserting) {
			return 1;
		} else {
			return 0;
		}
	}

	public function fetch_discussion($did){
		//function to fetch discussions details from the database
		$condition = 'd_id='."'".$did."'";
		$this->db->select('*');
		$this->db->from('discussion');
		$this->db->where($condition);
		//$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows() == 1) {
			return $query;
		} else {
			return false;
		}
	}
	public function fetch_post($did){
		//function to fetch discussions details from the database
		$condition = 'd_id='."'".$did."'";
		$this->db->select('*');
		$this->db->from('post');
		$this->db->where($condition);
		//$this->db->limit(1);
		$postquery = $this->db->get();

		if($postquery->num_rows() > 0) {
			return $postquery;
		} else {
				return false;
		}
	}

	public function discussion_list() {
			// List of discussions from the database to add sort method in the improvement
			$query = "SELECT 'discussion'.'d_id','discussion'.'d_title', 'discussion'.'cwid' FROM 'discussion' ORDER BY 'discussion'.'age' DESC";
			/*if ($sort != null) {
				if ($filter == `age`) {
					$filter = `ds_created_at`;
					switch ($direction) {
						case `ASC`:
						$dir = `ASC`;
						break;
						case `DESC`:
						$dir = `DESC`;
						break;
						default:
						$dir = `ASC`;
					}
				}
			} else {
				$dir = `ASC`;
			}
			$query .= "ORDER BY `ds_created_at` " . $dir;*/
			$result = $this->db->query($query);
			if ($result) {
				return $result;
			} else {
				return false;
			}
		}
}
?>
