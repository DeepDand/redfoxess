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

			public function discussion_list() {
				// List of discussions from the database
				// to add sort method in the improvement
				$query = "SELECT * FROM 'discussion' ORDER BY 'discussion'.'age' DESC";
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
