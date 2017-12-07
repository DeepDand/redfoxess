
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script>
		$(document).ready(function(){
			$("#logout").click(function(){
				//window.location.replace = "http://localhost/redfoxes/Discussion/createDiscussion_view";
        window.location.href = "https://login.marist.edu/cas/logout";
				//window.location.replace = "http://localhost/redfoxes/Discussion/createDiscussion_view";
			});
    });

		</script>
		<script type="text/javascript" src="../js/check_browser_close.js"></script>
  </head>
  <body>
		<div id="logout" align="right"><button id="logout" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span> Logout</button></div>
		<div class="container fluid" id="cview">
      <?php echo "<h3>".$title."</h3>" ?><br />
      <a href="<?php echo base_url().'Discussion/newDiscussion'; ?>"><button type="button" class="btn btn-default btn-lg" id="btn-next">Create Discussion</button></a>
			<br /><br /><br />
			<a href="<?php echo base_url().'Discussion/discussionList'; ?>"><button type="button" class="btn btn-default btn-lg" id="btn-next">View on going Discussions</button></a>
			<p>This is p tag<br /><?php echo $user; ?></p>
    </div>
  </body>
</html>
<?php
print str_pad('',4096)."\n";
ob_flush();
flush();
set_time_limit(45);
?>
