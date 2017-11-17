<!DOCTYPE html>
<html lang="en">
<head>
  <title>Marist Discussion Forum</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>

  function submitContactForm(){
      var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
      var cwid = $('#cwid').val();
      var title = $('#postTitle').val();
      var body = $('#postBody').val();
      var d_id = $('#d_id ').val();

      if(cwid.trim() == '' ){
          alert('Please enter your CWID.');
          $('#cwid').focus();
          return false;
      }else if(title.trim() == '' ){
          alert('Please enter your post title.');
          $('#postTitle').focus();
          return false;
      }else if(body.trim() == '' ){
          alert('Please enter your message.');
          $('#postBody').focus();
          return false;
      }else{
          $.ajax({
              type:'POST',
              url:'<?php echo base_url() ?>'+'Discussion/addNewPost', //+cwid+'/'+title+'/'+body+'/'+d_id
              //data:'contactFrmSubmit=1&cwid='+cwid+'&postTitle='+title+'&postBody='+body+'&d_id='+d_id,//,
              data:{'contactFrmSubmit':'1', 'cwid' :cwid, 'postTitle' :title, 'postBody':body, 'd_id':d_id},
              beforeSend: function () {
                  $('.submitBtn').attr("disabled","disabled");
                  $('.modal-body').css('opacity', '.5');
              },
              success:function(msg){
                  if(msg == 'ok'){
                      $('#cwid').val('');
                      $('#postTitle').val('');
                      $('#postBody').val('');
                      $('.statusMsg').html('<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>');
                  }else{
                      $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                  }
                  $('.submitBtn').removeAttr("disabled");
                  $('.modal-body').css('opacity', '');
                  $('#myModal').modal('hide');
                  $('#myModal').on('hidden.bs.modal', function () {
                    location.reload();
                  })

              }
          });
      }
  }
</script>
</head>
<body>
  <?php //echo form_open(base_url().'Discussion/discussionDetails','role="form"'); ?>
  <div class="container fluid">
    <h2>Discussion body</h2>
    <!--View to show the body of discussions, forums and comments on the discussions -->
    <?php
    if($query->result()) {
      foreach ($query->result() as $result) : $this->input->post($result->d_title,$result->cwid,$result->d_id,$result->d_body); $d_id=$result->d_id?>
      <div class="list-group list-group-item">
        <h4 class="list-group-item-heading">Title: <?php echo $result->d_title; ?></h4>
        <p class="list-group-item-text"><?php echo "Created by".$result->cwid; ?></p>
        <p><?php echo $result->d_body; ?></p>
      </div><br />
    <?php endforeach; } else {?>
      <div class="list-group list-group-item">
        <p>No discussion found</p>
      </div><br />


    <?php } ?>

    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Post</button>
    <br /><br />
    <?php

    if($postquery) {
    foreach ($postquery->result() as $postresult) : $this->input->post($postresult->p_title,$postresult->p_body);?>
    <div class="list-group list-group-item">
      <h4 class="list-group-item-heading">Post title: <?php echo $postresult->p_title; ?></h4>
      <p class="list-group-item-text"><?php echo "Created by".$postresult->cwid; ?></p>
      <p><?php echo $postresult->p_body; ?></p>
    </div><br />
  <?php endforeach; } else {?>
    <div class="list-group list-group-item">
      <p>No posts on this discussion yet.</p>
    </div><br />
  <?php } ?>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
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
                       <label for="cwid">CWID</label>
                       <input type="text" class="form-control" id="cwid" placeholder="Enter your CWID"/>
                   </div>
                   <div class="form-group">
                       <label for="postTitle">Post Title</label>
                       <input type="text" class="form-control" id="postTitle" placeholder="Title"/>
                   </div>
                   <div class="form-group">
                       <label for="postBody">Post Body</label>
                       <textarea class="form-control" id="postBody" placeholder="Enter your message"></textarea>
                       <input type"hidden" id="d_id" value = "<?php echo (isset($result->d_id))?$result->d_id:'';?>" />
                   </div>
               </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">SUBMIT</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php// echo form_close(); ?>

</body>
</html>
