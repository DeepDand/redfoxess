<!DOCTYPE html>
<html lang="en">
<head>
  <title>Marist Discussion Forum</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
  <!-- jQuery -->
  <!-- BS JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>/js/jquery.easyPaginate.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

  <script>
    function fetchComments(myURL){
      var resultUrl = myURL; //document.getElementById('getURL').value; //"<?php //echo base_url().'Discussion/discussionDetails/'; ?>"+getdid;
      console.log(resultUrl);
      $('#comments').load(resultUrl);
      $('#comments').css('display','block');//showing the list of discussion
      $('#dlist').css('display','none');//hiding the list of on going discussions
      $('#main_page').css('display','none'); //hiding the button create new discussion and view on-going discussions
      console.log(resultUrl);
    }
  </script>
  <style>

    .easyPaginateNav a {
      padding:5px;float: inherit;color: #000;
      text-decoration: none;
    }
    .easyPaginateNav a.current {
      font-weight:bold;background-color: #4CAF50;color: #000;border-radius: 8px;text-decoration: none;
    }
    .easyPaginateNav a.active {
      background-color: #4CAF50;color: #000;
      color: white;text-decoration: none;
  }

  .easyPaginate a:hover:not(.active) {background-color: #ddd;}

  </style>

</head>
<body>
  <?php //echo form_open(base_url().'Discussion/discussionDetails','role="form"'); ?>
  <div class="container fluid">
    <h2>Discussion body</h2>
    <!--View to show the body of discussions, forums and comments on the discussions -->
    <div class="list-group list-group-item">
      <?php
    if($query->result()) {
      foreach ($query->result() as $result) : $this->input->post($result->d_title,$result->cwid,$result->d_id,$result->d_body); //$d_id=$result->d_id;?>
        <h4 class="list-group-item-heading">Title: <?php echo $result->d_title; ?></h4>
        <p class="list-group-item-text" style="color:gray"><?php echo "Created by".$result->cwid; ?></p>
        <p><?php echo $result->d_body; ?></p><br />

    <?php endforeach; } else {?>
      </div>
      <div class="list-group list-group-item">
        <p>No discussion found</p>
      </div><br />
    <?php } ?>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Post</button>
    <br /><br />
    <div class="list-group" style="margin-left:20px" id="easyPaginate" name="easyPaginate">
    <?php
    if($postquery) {
    foreach ($postquery->result() as $postresult) : $this->input->post($postresult->p_title,$postresult->p_body);?>

      <li class="list-group-item">
      <h4 class="list-group-item-heading">Post title: <?php echo $postresult->p_title; ?></h4>
      <input type="hidden" id="p_id" value = "<?php echo (isset($postresult->p_id))?$postresult->p_id:'';?>" />
      <p class="list-group-item-text" style="color:gray"><?php echo "Created by".$postresult->cwid; ?></p>
      <p><?php echo $postresult->p_body; ?></p>
      <a id="anchorid" href="javascript:fetchComments('<?php echo base_url().'Discussion/commentView/'.$postresult->p_id; ?>')"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myComment">View Comments</button></a>
      <input type="hidden" id="getURL" name="getURL" value="<?php echo base_url().'Discussion/commentView/'.$postresult->p_id; ?>"></input><!--this is to pass urls to specific discussions -->
      <!--<a href="<?php //echo base_url().'Discussion/commentView/'.$postresult->p_id ?>"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myComment">View Comments</button></a>-->
    </li>


    <br /><!--<?php  ?>-->
  <?php endforeach; //echo $links;?>
  </div>
  <div id="pagination"></div>
  <?php } else {?>
      <div class="list-group list-group-item">
        <p>No posts on this discussion yet.</p>
      </div><br />
    <?php } ?>




    <!-- Modal for adding Post -->
    <div class="modal fade" id="myModal" name="myModal" role="dialog" >
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">New Post</h4>
          </div>
          <div class="modal-body">
            <form role="form">
                   <div class="form-group">
                       <label for="pcwid">CWID</label>
                       <input type="text" class="form-control" id="pcwid" placeholder="Enter your CWID"/>
                   </div>
                   <div class="form-group">
                       <label for="postTitle">Post Title</label>
                       <input type="text" class="form-control" id="postTitle" placeholder="Title"/>
                   </div>
                   <div class="form-group">
                       <label for="postBody">Post Body</label>
                       <textarea class="form-control" id="postBody" placeholder="Enter your message"></textarea>
                       <input type="hidden" id="di_id" value = "<?php echo (isset($result->d_id))?$result->d_id:'';?>" />
                   </div>
               </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary submitBtn" onclick="submitPostForm()" >SUBMIT</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>  <!-- Modal end for adding Post -->
    </div>
    <!--<?php// echo form_close(); ?>-->
    <script type="text/javascript">
    $('#easyPaginate').easyPaginate({
	      paginateElement: 'li',
	      elementsPerPage: 3,
	      effect: 'climb'
	});
  </script>
</body>
</html>
