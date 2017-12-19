
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="./css/redfox.css">
	<!--	<script src="http://code.jquery.com/jquery-1.10.0.min.js" integrity="sha256-2+LznWeWgL7AJ1ciaIG5rFP7GKemzzl+K75tRyTByOE=" crossorigin="anonymous"></script>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.1.0.js"></script>-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
		<!-- jQuery -->
		<!-- BS JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>/js/jquery.easyPaginate.js"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<script>
		/*document.getElementById('ogd').onclick = function() {getList()};
		function getList() {
			var resultUrl = "<?php //echo base_url('Discussion/discussionList')?>";
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
			$("#hidecontainer").click(function(){
				//window.location.replace = "http://localhost/redfoxes/Discussion/createDiscussion_view";
        $('#cview').css('display','none');
				//window.location.replace = "http://localhost/redfoxes/Discussion/createDiscussion_view";
			});
    });
		function submitPostForm(){
				var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
				var cwid = $('#cwid').val();
				var title = $('#postTitle').val();
				var body = $('#postBody').val();
				var d_id = $('#di_id ').val();

				if(cwid.trim() == '' ){
						alert('Please enter your CWID.');
						$('#cwid').focus();
						return false;
				}else if(title.trim() == '' ){
						alert('Please enter your post title.');
						$('#postTitle').focus();
						return false;
				}else if(body.trim() == '' ){
						alert('Please enter your message.');
						$('#postBody').focus();
						return false;
				}else{
					//console.log("finally in else");
						$.ajax({
								type:'POST',
								url:'<?php echo base_url() ?>'+'Discussion/addNewPost', //+cwid+'/'+title+'/'+body+'/'+d_id
								//data:'contactFrmSubmit=1&cwid='+cwid+'&postTitle='+title+'&postBody='+body+'&d_id='+d_id,//,
								data:{'contactFrmSubmit':'1', 'cwid' :cwid, 'postTitle' :title, 'postBody':body, 'd_id':d_id},
								beforeSend: function () {
										$('.submitBtn').attr("disabled","disabled");
										$('.modal-body').css('opacity', '.5');
										//alert('inside success');
								},
								success:function(msg){

										if(msg == 'ok'){
												$('#cwid').val('');
												$('#postTitle').val('');
												$('#postBody').val('');
												$('.statusMsg').html('<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>');
										}else{
												$('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
										}
										$('.submitBtn').removeAttr("disabled");
										$('.modal-body').css('opacity', '');
										//$('#myModal').modal('hide');
										$('#myModal').modal('hide');
										$(document).on('hidden.bs.modal','#myModal', function () {
											//alert("in location reload");
											//document.location.reload();
											window.location.href='<?php echo base_url()?>'+'Discussion/discussionDetails/'+d_id;//document.getElementById('anchorid');
											console.log();
										})

								}
						});
				}
		}
	    function fetchList(myURL){
	      var resultUrl = myURL//document.getElementById('getURL').value; //"<?php //echo base_url().'Discussion/discussionDetails/'; ?>"+getdid;
	      $('#dlist').load(resultUrl);
	      $('#dlist').css('display','block');//showing the list of discussion
	      $('#main_page').css('display','none'); //hiding the button create new discussion and view on-going discussions
	      console.log(resultUrl);
	    }
			/**/
	    //$('#anchorid').click(fetchList);
		</script>
  </head>
  <body>
		<div id="logout" align="right"><button id="logout" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span> Logout</button></div>

		<div class="container fluid" id="cview">

			<div id="main_page" class="form-group">

	      <?php echo "<h3>".$title."</h3>" ?><br />
	      <button type="button" class="btn btn-default btn-lg" id="newDiscussion" name="newDiscussion">Create Discussion</button>
				<br /><br /><br />
				<button type="button" class="btn btn-default btn-lg" id="ogd" name="ogd">View on going Discussions</button>
				<br /><br />
				<p>This is p tag<br /><?php echo $user; ?></p>

				<div id="disclist" name="disclist" class="col-md-8">

				</div>

				<div id="newDisc" class="form-horizontal">
				</div>

		</div>
		<div id="dlist">
		</div>
    </div>
		<div id="hidemaincontainer"><button id="hidecontainer" name="hidecontainer">kill main</button></div>
			<script>
    
	  </script>
  </body>
</html>
