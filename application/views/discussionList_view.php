<!DOCTYPE html>
<html lang="en">
<head>
  <title>Marist Discussion Forums</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php @session_start();//echo form_open(base_url().'Discussion/discussionDetails','role="form"'); ?>
  
  <form name="dview" id="dview" method="post" action="<?php echo base_url().'Discussion/discussionDetails/'; ?>">
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

<?php //echo form_close(); ?>
</body>
</html>
