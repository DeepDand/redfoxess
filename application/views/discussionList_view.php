<!DOCTYPE html>
<html lang="en">
<head>
  <title>Marist Discussion Forums</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php //echo form_open(base_url().'Discussion/discussionDetails','role="form"'); ?>
<div class="container fluid">
  <h2>On-going Discussions</h2>
  <table class="table table-hover">
    <thead>
      <td>Discussion Title</td>
      <td>Created By</td>
      <td>View the discussion</td>
    </thead>
  <?php
    foreach ($query->result() as $result) :
      //$this->input->post($result->d_id, $result->d_title, $result->cwid);?>
    <tr>
      <td><a href="<?php echo base_url().'Discussion/discussionDetails/'.$result->d_id; ?>"><?php echo $result->d_title; ?></a></td>
      <td><?php echo $result->cwid; ?></td>
      <td><button type="submit">View discussion</button></td>
    </tr>
  </div><br />
<?php endforeach; ?>
</div>
<?php //echo form_close(); ?>
</body>
</html>
