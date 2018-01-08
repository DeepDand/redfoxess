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
</script>
</head>
<body>
  <!--<?php //echo form_open(base_url().'Discussion/discussionDetails','role="form"'); ?>-->
  <div class="container fluid">
    <!--View to show the body of discussions, forums and comments on the discussions -->
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
  </div>
  <!--<?php// echo form_close(); ?>-->
</body>
</html>
