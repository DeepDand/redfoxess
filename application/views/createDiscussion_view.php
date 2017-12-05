
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
		$("#logout").click(function(){
        window.location.href = "https://login.marist.edu/cas/logout";
    });
		</script>
  </head>
  <body>
		<div id="logout" align="right"><button id="logout" class="btn btn-primary">Logout</button></div>


		<div class="container fluid" id="cview">

      <?php echo "<h3>".$title."</h3>" ?><br />
      <a href="<?php echo base_url().'Discussion/newDiscussion'; ?>"><button type="button" class="btn btn-default btn-lg" id="btn-next">Create Discussion</button></a>
			<br /><br /><br />
			<a href="<?php echo base_url().'Discussion/discussionList'; ?>"><button type="button" class="btn btn-default btn-lg" id="btn-next">View on going Discussions</button></a>

    </div>


  </body>
</html>
