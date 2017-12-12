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
<?php @session_start();//echo form_open(base_url().'Discussion/discussionDetails','role="form"'); ?>
<div class="container fluid">
  <form name="myForm" id="myForm" method="post" action="<?php echo base_url().'Discussion/discussionDetails/'; ?>">
  <h2>On-going Discussions</h2>
      <div class="col-md-3">
      <table class="table table-responsive">
        <thead>
          <td>Discussion Title</td>
          <td>Created By</td>
        </thead>
      </div>
      <?php
        foreach ($query->result() as $result) ://$this->input->post($result->d_id, $result->d_title, $result->cwid);?>
        <div class="col-md-3">
          <tr>
            <td><a href="<?php echo base_url().'Discussion/discussionDetails/'.$result->d_id; ?>"><?php echo $result->d_title; ?></a></td>
            <td><?php echo $result->cwid; ?></td>
            <td><input type="hidden" id="d_id" name= "d_id" value ="<?php echo (isset($result->d_id))?$result->d_id:'';?>" required="required" /></td>
          </tr>
        </div>
<?php endforeach; ?>
</table>
</form>
</div>
<?php //echo form_close(); ?>
</body>
</html>
<script type="text/javascript">
var resultUrl = "<?php echo base_url('Discussion/discussionList')?>";
$('#disclist').load(resultUrl);
</script>
