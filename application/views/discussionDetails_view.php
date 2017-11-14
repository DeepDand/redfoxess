<!DOCTYPE html>
<html lang="en">
<head>
  <title>Marist Discussion Forum</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php //echo form_open(base_url().'Discussion/discussionDetails','role="form"'); ?>

<div class="container fluid">
<h2>Discussion body</h2>
<!--View to show the body of discussions, forums and comments on the discussions -->
<?php
  foreach ($query->result() as $result) : $this->input->post($result->d_title,$result->cwid,$result->d_id,$result->d_body);?>
  <div class="list-group list-group-item">
    <h4 class="list-group-item-heading">Title: <?php echo $result->d_title; ?></h4>
    <p class="list-group-item-text"><?php echo "Created by".$result->cwid; ?></p>
    <p><?php echo $result->d_body; ?></p>
  </div><br />
<?php endforeach; ?>
</div>
<?php// echo form_close(); ?>

</body>
</html>
