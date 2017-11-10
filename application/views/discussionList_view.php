<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container fluid">
  <h2>On-going Discussions</h2>
  <?php
    foreach ($query->result() as $result) : $this->input->post($result->d_title,$result->cwid,$result->d_id);?>
  <div class="list-group list-group-item">
      <a href="<?php echo base_url().'c=Discussion&m=discussionDetails&d_id='.$result->d_id; ?>"><h4 class="list-group-item-heading"><?php echo $result->d_title; ?></h4></a>
      <p class="list-group-item-text"><?php echo "Created by".$result->cwid; ?></p>
  </div><br />
<?php endforeach; ?>
</div>

</body>
</html>
