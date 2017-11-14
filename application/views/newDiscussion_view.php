<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
  <?php echo validation_errors(); ?>
  <?php echo form_open(base_url().'Discussion/create','role="form"') ; ?>
    <div class="container fluid" id="cview">
    <h4> Create a new Discussion</h4>
    <br />
    <div class="form-group col-md-5">
      <label for="cwid"><?php echo $this->lang->line('cwid');?></label>
      <input type="text" name="cwid" class="form-control" id="cwid" value="<?php echo set_value('cwid'); ?>">
    </div>
    <div class="form-group col-md-10">
      <label for="ds_title"><?php echo $this->lang->line('discussion_ds_title');?></label>
      <input type="text" name="ds_title" class="form-control" id="ds_title" value="<?php echo set_value('ds_title'); ?>">
    </div>
    <div class="form-group  col-md-10">
      <label for="ds_body"><?php echo $this->lang->line('discussion_ds_body');?></label>
      <textarea class="form-control" rows="3" name="ds_body" id="ds_body" value="<?php echo set_value('ds_body'); ?>" ></textarea>
    </div>
    <div class="form-group  col-md-11">
      <button type="submit" class="btn btn-success btn-md"><?php echo $this->lang->line('common_form_elements_go');?></button>
    </div>
    <?php echo form_close() ; ?>
    </div>
  </body>
</html>