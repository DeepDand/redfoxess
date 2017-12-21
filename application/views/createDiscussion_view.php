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
			$("#navi").click(function(){
				//window.location.replace = "http://localhost/redfoxes/Discussion/createDiscussion_view";
        window.location.href = '<?php echo base_url() ?>';
				//window.location.replace = "http://localhost/redfoxes/Discussion/createDiscussion_view";
			});

			var resultUrll = "<?php echo base_url('Discussion/discussionList')?>";
			$('#disclist').load(resultUrll);
			$('#disclist').css('display','block');
			$('#newDisc').css('display','none');

			//validation for create discussions
			$("#newd").validate({
				errorClass: "my-error-class",
				 rules: {
					 cwid:"required",
					 ds_title:"required",
					 ds_body:"required",

						cwid: {
							 required: true,
							 minlength: 8,
							 maxlength: 8
						},
						ds_title: {
							 required: true,
							 minlength: 8,
							 maxlength: 255
						},
						ds_body: {
							 required: true,
							 minlength: 20,
							 maxlength: 500
						},
				 },
				 messages: {
						cwid: {
							 required: "CWID required",
							 minlength: "Your CWID must be 8 characters long",
							 maxlength: "Your CWID must be 8 characters long"
						},
						ds_title: {
							 required: "Discussion title required",
							 minlength: "Your Discussion title must be at least 8 characters long",
							 maxlength: "Your Discussion title must be of maximum 255 characters"
						},
						ds_body: {
							 required: "Discussion body required",
							 minlength: "Your Discussion body must be at least 20 characters long",
							 maxlength: "Your Discussion body must be of maximum 500 characters"
						}
				 },

				 onfocusout: function (element) {
					 $(element).valid();
				 }
			 });

			 $("#cancel").click(function() {
				$("#cwid").val("");
 				$("#ds_title").val("");
 				$("#ds_body").val("");
 				$("#cwid-error").hide();
				$("#ds_title-error").hide();
				$("#ds_body-error").hide();
   			$(".error").removeClass(".my-error-class");
				//alert("clicked cancel");
  		 });
		 });


		 var create = document.getElementById("newDisc");
		 var view = document.getElementById("discList");
		//	$('#ogd').click(function(){
				//alert('yay');


				//alert('again yay');
			//});
			/*$('#newDiscussion').click(function(){
				//alert('yay');

				var resultUrl = "<?php //echo base_url('Discussion/newDiscussion')?>";
				$('#newDisc').load(resultUrl);
				$('#newDisc').css('display','block');
				$('#disclist').css('display','none');
				//alert('again yay');
			});*/

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
											document.location.reload();
											window.location.href='<?php echo base_url()?>'+'Discussion/discussionDetails/'+d_id;//document.getElementById('anchorid');
											console.log();
										})

								}
						});
				}
		}
		function submitCommentForm(){
	      var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
	      var cwid = $('#ccwid').val();
	      var body = $('#commentBody').val();
	      var p_id = $('#po_id ').val();

	      if(cwid.trim() == '' ){
	          alert('Please enter your CWID.');
	          $('#ccwid').focus();
	          return false;
	      }else if(body.trim() == '' ){
	          alert('Please enter your message.');
	          $('#commentBody').focus();
	          return false;
	      }else{
	          $.ajax({
	              type:'POST',
	              url:'<?php echo base_url() ?>'+'Discussion/addNewComment', //+cwid+'/'+title+'/'+body+'/'+d_id
	              //data:'contactFrmSubmit=1&cwid='+cwid+'&postTitle='+title+'&postBody='+body+'&d_id='+d_id,//,
	              data:{'cwid' :cwid, 'p_id' : p_id, 'commentBody':body},
	              beforeSend: function () {
	                  $('.submitBtn').attr("disabled","disabled");
	                  $('.modal-body').css('opacity', '.5');
	              },
	              success:function(msg){
	                  if(msg == 'ok'){
	                      $('#ccwid').val('');
	                      $('#commentBody').val('');
	                      $('.statusMsg').html('<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>');
	                  }else{
	                      $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
	                  }
	                  $('.submitBtn').removeAttr("disabled");
	                  $('.modal-body').css('opacity', '');
	                  $('#myComment').modal('hide');
	                  $(document).on('hidden.bs.modal','#myComment', function () {
											//document.location.reload();
											window.location.href='<?php echo base_url()?>'+'Discussion/commentView/'+p_id;//document.getElementById('anchorid');
											console.log();
	                  })

	              }
	          });
	      }
	  }
    function fetchList(myURL){
      var resultUrl = myURL;//document.getElementById('getURL').value; //"<?php //echo base_url().'Discussion/discussionDetails/'; ?>"+getdid;
			console.log(resultUrl);
      $('#dlist').load(resultUrl);
      $('#dlist').css('display','block');//showing the list of discussion
      $('#main_page').css('display','none'); //hiding the button create new discussion and view on-going discussions
      //console.log(resultUrl);
		}
		function fetchComments(myURL){
      var resultUrl = myURL;//document.getElementById('getURL').value; //"<?php //echo base_url().'Discussion/discussionDetails/'; ?>"+getdid;
			console.log(resultUrl);
      $('#comments').load(resultUrl);
      $('#comments').css('display','block');//showing the list of discussion
      $('#main_page').css('display','none'); //hiding the button create new discussion and view on-going discussions
      $('#dlist').css('display','none');//hiding the list of on going discussions
      //console.log(resultUrl);
		}
			/**/
	    //$('#anchorid').click(fetchList);

		</script>
  </head>
  <body>
		<div id="navi" align="right" class="container fluid">
			<br /><br /><button id="home" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Home</button>
			<button id="logout" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span> Logout</button>
		</div>

		<div class="container fluid" id="cview">
			<div id="main_page" class="form-group">

	      <?php echo "<h3>".$title."</h3>" ?><br />
	      <button type="button" class="btn btn-default btn-lg" id="newDiscussion" name="newDiscussion" data-toggle="modal" data-target="#newModal">Create Discussion</button>
				<br /><br /><br />
				<!--<button type="button" class="btn btn-default btn-lg" id="ogd" name="ogd">View on going Discussions</button>
				<br /><br />-->
				<p>This is p tag<br /><?php echo $user; ?></p>

				<div id="disclist" name="disclist" class="col-md-8"></div>
				<div id="newDisc" class="form-horizontal"></div>
				<!-- Modal for adding Post -->
		    <div class="modal fade" id="newModal" name="newModal" role="dialog" >
		      <div class="modal-dialog">

		        <!-- Modal content-->
		        <div class="modal-content">
		          <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal">&times;</button>
		            <h4 class="modal-title">Create a new Discussion</h4>
		          </div>
							<?php $attributes = array('name' => 'newd','id'=>'newd');echo form_open(base_url().'Discussion/create',$attributes) ; ?>

		          <div class="modal-body">
						    <div>
						      <label for="cwid"><?php echo $this->lang->line('cwid');?></label>
						      <input type="text" name="cwid" class="form-control" id="cwid" required="required" value="<?php echo set_value('cwid'); ?>" />
						    </div>
						    <div>
						      <label for="ds_title"><?php echo $this->lang->line('discussion_ds_title');?></label>
						      <input type="text" name="ds_title" class="form-control" id="ds_title" value="<?php echo set_value('ds_title'); ?>" />
						    </div>
						    <div>
						      <label for="ds_body"><?php echo $this->lang->line('discussion_ds_body');?></label>
						      <textarea class="form-control" rows="3" name="ds_body" id="ds_body" value="<?php echo set_value('ds_body'); ?>" ></textarea>
						    </div>

		          </div>
		          <div class="modal-footer">
		            <button type="submit" class="btn btn-success"><?php echo $this->lang->line('common_form_elements_go');?></button>
		            <button type="button" class="btn btn-warning" data-dismiss="modal" id="cancel" name="cancel">Close</button>
		          </div>
							<?php echo form_close() ; ?>
		        </div>
		      </div>
		    </div>  <!-- Modal end for adding Post -->
			</div>
			<div id="dlist">
			</div>
			<div id="comments">
			</div>
	    </div>
  </body>
</html>
