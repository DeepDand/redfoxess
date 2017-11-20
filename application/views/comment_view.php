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
  function submitCommentForm(){
      var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
      var cwid = $('#ccwid').val();
      var body = $('#commentBody').val();
      var p_id = $('#p_id ').val();

      if(cwid.trim() == '' ){
          alert('Please enter your CWID.');
          $('#ccwid').focus();
          return false;
      }else if(body.trim() == '' ){
          alert('Please enter your message.');
          $('#commentBody').focus();
          return false;
      }else{
          $.ajax({
              type:'POST',
              url:'<?php echo base_url() ?>'+'Discussion/addNewComment', //+cwid+'/'+title+'/'+body+'/'+d_id
              //data:'contactFrmSubmit=1&cwid='+cwid+'&postTitle='+title+'&postBody='+body+'&d_id='+d_id,//,
              data:{'cwid' :cwid, 'p_id' : p_id, 'commentBody':body},
              beforeSend: function () {
                  $('.submitBtn').attr("disabled","disabled");
                  $('.modal-body').css('opacity', '.5');
              },
              success:function(msg){
                  if(msg == 'ok'){
                      $('#ccwid').val('');
                      $('#commentBody').val('');
                      $('.statusMsg').html('<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>');
                  }else{
                      $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                  }
                  $('.submitBtn').removeAttr("disabled");
                  $('.modal-body').css('opacity', '');
                  $('#myComment').modal('hide');
                  $('#myComment').on('hidden.bs.modal', function () {
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
    if($query) {
      foreach ($query->result() as $result) : $this->input->post($result->p_title,$result->cwid,$result->p_id,$result->p_body); ?>
      <div class="list-group list-group-item">
        <h4 class="list-group-item-heading">Title: <?php echo $result->p_title; ?></h4>
        <p class="list-group-item-text"><?php echo "Created by".$result->cwid; ?></p>
        <input type="hidden" id="p_id" value = "<?php echo (isset($result->p_id))?$result->p_id:'';?>" />
        <p><?php echo $result->p_body; ?></p>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myComment">Add Comments</button>
      </div><br />
    <?php endforeach; } else {?>
      <div class="list-group list-group-item">
        <p>No discussion found</p>
      </div><br />


    <?php } ?>
    <?php
    if($commentquery) {
    foreach ($commentquery->result() as $commentresult) : $this->input->post($commentresult->c_body);?>
    <div class="list-group list-group-item" style="margin-left:20px">
      <p><?php echo $commentresult->c_body; ?></p>
      <p class="list-group-item-text" style="color:gray"><?php echo "Created by ".$commentresult->cwid; ?></p>
    </div><br />
  <?php endforeach; } else {?>
      <div class="list-group list-group-item">
        <p>No comments on this post yet.</p>
      </div><br />
    <?php } ?>

  <!-- Modal for adding comment on a post -->
    <div class="modal fade" id="myComment" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">New Comment</h4>
          </div>
          <div class="modal-body">
            <form role="form">
                   <div class="form-group">
                       <label for="cwid">CWID</label>
                       <input type="text" class="form-control" id="ccwid" placeholder="Enter your CWID"/>
                   </div>
                   <div class="form-group">
                       <label for="commentBody">Your Comment</label>
                       <textarea class="form-control" id="commentBody" placeholder="Enter your Comment"></textarea>
                         <input type="hidden" id="p_id" value = "<?php echo (isset($result->p_id))?$result->p_id:'';?>" />
                   </div>
               </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary submitBtn" onclick="submitCommentForm()">SUBMIT</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php// echo form_close(); ?>

</body>
</html>
