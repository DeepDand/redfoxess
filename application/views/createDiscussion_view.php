
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<style>
			.mystyle {
			    width: 100%;
			    padding: 25px;
			    background-color: coral;
			    color: white;
			    font-size: 25px;
			    box-sizing: border-box;
			}
		</style>
		<link rel="stylesheet" href="./css/redfox.css">
		<script src="http://code.jquery.com/jquery-1.10.0.min.js" integrity="sha256-2+LznWeWgL7AJ1ciaIG5rFP7GKemzzl+K75tRyTByOE=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>


		<script type="text/javascript">
		/*document.getElementById('ogd').onclick = function() {getList()};
		function getList() {
			var resultUrl = "<?php echo base_url('Discussion/discussionList')?>";
			$('#disclist').load(resultUrl);
		}*/
		$(document).ready(function(){
			$("#logout").click(function(){
				//window.location.replace = "http://localhost/redfoxes/Discussion/createDiscussion_view";
        window.location.href = "https://login.marist.edu/cas/logout";
				//window.location.replace = "http://localhost/redfoxes/Discussion/createDiscussion_view";
			});
			var create = document.getElementById("newDisc");
			var view = document.getElementById("discList");
			$('#ogd').click(function(){
				//alert('yay');

				var resultUrl = "<?php echo base_url('Discussion/discussionList')?>";
				$('#disclist').load(resultUrl);
				$('#disclist').css('display','block');
				$('#newDisc').css('display','none');
				//alert('again yay');
			});
			$('#newDiscussion').click(function(){
				//alert('yay');

				var resultUrl = "<?php echo base_url('Discussion/newDiscussion')?>";
				$('#newDisc').load(resultUrl);
				$('#newDisc').css('display','block');
				$('#disclist').css('display','none');
				//alert('again yay');
			});
    });

		</script>
  </head>
  <body>
		<div id="logout" align="right"><button id="logout" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span> Logout</button></div>
		<div class="container fluid" id="cview">
      <?php echo "<h3>".$title."</h3>" ?><br />
      <button type="button" class="btn btn-default btn-lg" id="newDiscussion" name="newDiscussion">Create Discussion</button>
			<br /><br /><br />
			<button type="button" class="btn btn-default btn-lg" id="ogd" name="ogd">View on going Discussions</button>
			<br /><br />
			<p>This is p tag<br /><?php echo $user; ?></p>
			<div id="disclist" name="disclist">

			</div>
			<div id="newDisc">
			</div>

    </div>
  </body>
</html>
