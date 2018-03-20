<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="./css/redfox.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
		<!-- jQuery -->
		<!-- BS JavaScript -->

		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>/js/jquery.easyPaginate.js"></script>
		<script type="text/javascript" src="datatables/datatables.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
		<style>
		.foot {
			text-align: center;
			color: #333;
			font-size: 13px;
			width: 100%;
		}

		.foot a:link {
			color: #333;
		}
		.foot a:visited {
			color: #333;
		}

		.foot a:hover {
			color: #B31B1B;
		}

		</style>



  </head>
  <body>
		<div id="navi" align="right" class="container fluid">
			<br /><br /><button id="home" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Home</button>
			<a href="https://login.marist.edu/cas/logout"><button id="logout" type="reset" class="btn btn-logout"><span class="glyphicon glyphicon-log-out"></span> Logout</button></a>
		</div>

		<div class="container fluid" id="cview">
			<div id="main_page" class="form-group">

	      <?php echo "<h3>".$title."</h3>" ?><br />
	      <button type="button" class="btn btn-default btn-lg" id="newDiscussion" name="newDiscussion" data-toggle="modal" data-target="#newModal">Create Discussion</button>
				<br /><br /><br />
				<!--<button type="button" class="btn btn-default btn-lg" id="ogd" name="ogd">View on going Discussions</button>
				<br /><br />-->
				<p><//?php echo $cwid; ?></p>

				<div id="ddetails"></div>
				<div id="ddetails1"></div>
				<div id="disclist" name="disclist" class="col-md-8"></div>
				<div id="newDisc" class="form-horizontal"></div>
				<!-- Modal for adding Post -->
		    <div class="modal fade" id="newModal" name="newModal" role="dialog" >
		      <div class="modal-dialog">

		        <!-- Modal content-->
		        <div name="newd" id="newd" class="modal-content">

		          <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal">&times;</button>
		            <h4 class="modal-title col-md-9">Create a new Discussion</h4>
		          </div>
							<!--<?php //$attributes = array('name' => 'newd','id'=>'newd');echo form_open(base_url().'Discussion/create',$attributes) ; ?>-->

		          <div class="modal-body">
								<form role="form" id="newModalDisc">
									<div class="form-group">
										<div class="dropdown">
											<label for="category">Category</label>
										  <select class="form-control" id="category" name="category">
												<option value="General"><a href="#">General</a></option>
										    <option value="Academic"><a href="#">Academic</a></option>
												<option value="Accommodation"><a href="#">Accommodation</a></option>
										    <option value="Registrar"><a href="#">Registrar</a></option>
												<option value="Events"><a href="#">Events</a></option>
											 	<option value="IT issues"><a href="#">IT issues</a></option>
											 	<option value="Transportation"><a href="#">Transportation</a></option>
										  </select>
										</div>
									</div>
									<div class="form-group">
								    <div>
								      <label for="ds_title"><?php echo $this->lang->line('discussion_ds_title');?></label>
								      <input type="text" name="ds_title" class="form-control" id="ds_title" value="<?php echo set_value('ds_title'); ?>" />
								    </div>
									</div>
									<div class="form-group">
								    <div>
								      <label for="ds_body"><?php echo $this->lang->line('discussion_ds_body');?></label>
								      <textarea class="form-control" rows="3" name="ds_body" id="ds_body" value="<?php echo set_value('ds_body'); ?>" ></textarea>
								    </div>
									</div>
									<div class="modal-footer">
				            <button type="submit" class="btn btn-success" onclick="submitDiscussionForm()"><?php echo $this->lang->line('common_form_elements_go');?></button>
				            <button type="button" class="btn btn-warning" data-dismiss="modal" id="cancel" name="cancel">Close</button>
				          </div>
								</form>
								<!--<input type="text" name="ds_num" class="form-control" id="ds_num" value="<?php //echo mt_rand(); ?>" />-->
							</div>
							<?php //echo form_close() ; ?>
		        </div>
		      </div>
		    </div>  <!-- Modal end for adding Post -->
			</div>
			<div id="dlist" class="col-md-9 fluid"></div>

			<div id="contactResponse"></div>
			<div id="comments"></div>
	    </div>

			<div class="bottom_container">
	        <p class = "foot">
	            James A. Cannavino Library, 3399 North Road, Poughkeepsie, NY 12601; 845.575.3199
	            <br />
	            &#169; Copyright 2007-2016 Marist College. All Rights Reserved.
			<a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a>
	        </p>
	    </div>
			<script type="text/javascript" class="init">

			$(document).ready(function(){
				$("#navi").click(function(){
					//window.location.replace = "http://localhost/redfoxes/Discussion/createDiscussion_view";
					window.location.href = '<?php echo base_url() ?>';
					//window.location.replace = "http://localhost/redfoxes/Discussion/createDiscussion_view";
				});


				var resultUrll = "<?php echo base_url()?>"+'Discussion/discussionList';
				$('#disclist').load(resultUrll);
				$('#disclist').css('display','block');
				//$('#newDisc').css('display','block');
                $('#ddetails').css('display','block');


				//validation for create discussions
				$("#newModalDisc").validate({
					errorClass: "my-error-class",
					 rules: {
						 //cwid:"required",
						 ds_title:"required",
						 ds_body:"required",

							/*cwid: {
								 required: true,
								 minlength: 8,
								 maxlength: 8
							},*/
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
							/*cwid: {
								 required: "CWID required",
								 minlength: "Your CWID must be 8 characters long",
								 maxlength: "Your CWID must be 8 characters long"
							},*/
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
					 $("#cat:first-child").text("Select Discussion Category");
					 $("#cat:first-child").val("default");
					$("#ds_title").val("");
					$("#ds_body").val("");
					//$("#cwid-error").hide();
					$("#ds_title-error").hide();
					$("#ds_body-error").hide();
					$(".error").removeClass(".my-error-class");
					//alert("clicked cancel");
				 });
			 });
			 var create = document.getElementById("newDisc");
			 var view = document.getElementById("discList");

			function submitPostForm(){
					var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
					//var pcwid = $('#pcwid').val();
					var ptitle = $('#postTitle').val();
					var pbody = $('#postBody').val();
					var d_id = $('#di_id ').val();

					/*if(pcwid.trim() == '' ){
							alert('Please enter your CWID.');
							$('#cwid').focus();
							return false;
					}else */
					if(ptitle.trim() == '' ){
							alert('Please enter your post title.');
							$('#postTitle').focus();
							return false;
					}else if(pbody.trim() == '' ){
							alert('Please enter your message.');
							$('#postBody').focus();
							return false;
					}else{
						//console.log("finally in else");
							$.ajax({
									type:'POST',
									url:'<?php echo base_url() ?>'+'Discussion/addNewPost', //+cwid+'/'+title+'/'+body+'/'+d_id
									//data:'contactFrmSubmit=1&cwid='+cwid+'&postTitle='+title+'&postBody='+body+'&d_id='+d_id,//,
									data:{'contactFrmSubmit':'1', 'postTitle' :ptitle, 'postBody':pbody, 'd_id':d_id},
									beforeSend: function () {
											$('.submitBtn').attr("disabled","disabled");
											$('.modal-body').css('opacity', '.5');
											//alert('inside success');
									},
									success:function(msg){

											if(msg == 'ok'){
													//$('#cwid').val('');
													$('#postTitle').val('');
													$('#postBody').val('');
													$('.statusMsg').html('<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>');
											}else{
													$('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
											}

											var resultUrl = '<?php echo base_url()?>'+'Discussion/search_discussion/'+d_id;//document.getElementById('getURL').value; //"<?php //echo base_url().'Discussion/discussionDetails/'; ?>"+getdid;
									    console.log(resultUrl);
											$('#ddetails').empty();
											$('#dlist').css('display','none');
											$('#disclist').css('display','none');
									    $('#ddetails').load(resultUrl);
									    $('#ddetails').css('display','block');
//need to fix this part!
											//fetchPost('<?php //echo base_url()?>'+'Discussion/search_discussion/'+d_id);
											$('.submitBtn').removeAttr("disabled");
											$('.modal-body').css('opacity', '');
											$('#myModal').modal('hide');
											$('.modal-backdrop').remove();


											$(document).on('hidden.bs.modal','#myModal', function () {
												//alert('closed modal');
												$('.modal-backdrop').remove();
												//document.location.reload();
												//window.location.assign('<?php //echo base_url()?>'+'Discussion/search_discussion/'+d_id);
												});

									},

							});//showCurrDiss();
					}
			}
			function showCurrDiss(){
				//need to redirect to same discussion after adding a new post
			}
			function submitCommentForm(){
					var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
					//var cwid = $('#ccwid').val();
					var cbody = $('#commentBody').val();
					console.log("this is your message\n"+cbody);
					var p_id = $('#post_id').val();
					console.log("adding your reply to post:"+p_id);
					//alert(cbody);

					/*if(cwid.trim() == '' ){
							alert('Please enter your CWID.');
							$('#ccwid').focus();
							return false;
					}else */
					if(cbody.trim() == '' ){
							alert('Please enter your message.');
							$('#commentBody').focus();
							return false;
					}else{
							$.ajax({
									type:'POST',
									url:'<?php echo base_url() ?>'+'Discussion/addNewComment', //+cwid+'/'+title+'/'+body+'/'+d_id
									//data:'contactFrmSubmit=1&cwid='+cwid+'&postTitle='+title+'&postBody='+body+'&d_id='+d_id,//,
									data:{/*'cwid' :cwid,*/ 'p_id' : p_id, 'commentBody':cbody},
									beforeSend: function () {
											$('.submitBtn').attr("disabled","disabled");
											$('.modal-body').css('opacity', '.5');
									},
									success:function(msg){
											if(msg == 'ok'){
													//$('#ccwid').val('');
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
												//window.location.href='<?php //echo base_url()?>'+'Discussion/commentView/'+p_id;//document.getElementById('anchorid');
												//console.log();
												fetchComments('<?php echo base_url()?>'+'Discussion/seeReplyView/'+p_id);
										    $(this).find('input[name="post_id"]').val("");
											})

									}
							});
					}
			}
			//this method submits the newly created discussion and returns to the discussion details page.
			function submitDiscussionForm(){
					var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
					//var cwid = $('#ccwid').val();
					var category = $('#category').val();
					console.log("this is your category\n"+category);
					var ds_title = $('#ds_title').val();
					console.log("discussion title:"+ds_title);
					var ds_body = $('#ds_body').val();
					console.log("discussion body:"+ds_body);
					var ds_num = Math.random() * 1000000;
					console.log("discussion random number:"+ds_num);

					if(category.trim() == '' ){
							alert('Please enter your CWID.');
							$('#category').focus();
							return false;
					}else if(ds_title.trim() == '' ){
							alert('Please enter your message.');
							$('#ds_title').focus();
							return false;
					}else if(ds_body.trim() == '' ){
							alert('Please enter your message.');
							$('#ds_body').focus();
							return false;
					}else{
						//alert("in else");
							$.ajax({
									type:'POST',
									url:'<?php echo base_url(); ?>'+'Discussion/create', //+cwid+'/'+title+'/'+body+'/'+d_id
									//data:'contactFrmSubmit=1&cwid='+cwid+'&postTitle='+title+'&postBody='+body+'&d_id='+d_id,//,
									data:{/*'cwid' :cwid,*/ 'category' : category, 'ds_title':ds_title, 'ds_body':ds_body, 'ds_num':ds_num},
									beforeSend: function () {
											$('.submitBtn').attr("disabled","disabled");
											$('.modal-body').css('opacity', '.5');
									},
									success:function(msg){
											if(msg == 'ok'){
													//$('#ccwid').val('');
													$('#category').val('');
													$('#ds_title').val('');
													$('#ds_body').val('');
													$('.statusMsg').html('<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>');
											}else{
													$('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
											}
											fetchDiscussion('<?php echo base_url()?>'+'Discussion/search_discussion/'+ds_num);
											$('.submitBtn').removeAttr("disabled");
											$('.modal-body').css('opacity', '');
											$('#newModal').modal('hide');
											$('.modal-backdrop').remove();
											$(document).on('hidden.bs.modal','#newModal', function () {
								});
							}
						});
					}
				}
			/*function fetchList(myURL){
				var resultUrl = myURL;//document.getElementById('getURL').value; //"<//?php //echo base_url().'Discussion/discussionDetails/'; ?>"+getdid;
				console.log(resultUrl);
				$('#dlist').load(resultUrl);
				$('#dlist').css('display','block');//showing the list of discussion
				$('#main_page').css('display','none'); //hiding the button create new discussion and view on-going discussions
				//console.log(resultUrl);
			}*/
				$(function(){
					$(".dropdown-menu option a").click(function(){
						$("#cat:first-child").text($(this).text());
						$("#cat:first-child").val($(this).text());

					});
				});
			  function addComments(myURL){
			    var resultUrl = myURL;//document.getElementById('getURL').value; //"<?php //echo base_url().'Discussion/discussionDetails/'; ?>"+getdid;
			    console.log(resultUrl);
			    $('#viewreplies').load(resultUrl);
			    $('#viewreplies').css('display','block');//showing the list of discussion
			    $('#dlist').css('display','none');
					$('#disclist').css('display','none'); //hiding the button create new discussion and view on-going discussions
			    //$('#dlist').css('display','none');//hiding the list of on going discussions
			    //console.log(resultUrl);
			  }
				function fetchDiscussion(myURL){
			    var resultUrl = myURL;//document.getElementById('getURL').value; //"<?php //echo base_url().'Discussion/discussionDetails/'; ?>"+getdid;
			    console.log(resultUrl);
					$('#ddetails').empty();
					$('#dlist').css('display','none');
					$('#disclist').css('display','none');
			    $('#ddetails').load(resultUrl);
			    $('#ddetails').css('display','block');//showing the list of discussion
			    //$('#main_page').css('display','none'); //hiding the button create new discussion and view on-going discussions
			    //$('#dlist').css('display','none');//hiding the list of on going discussions
			    //console.log(resultUrl);
			  }

				function fetchPost(myURL){
			    var resultUrl = myURL;//document.getElementById('getURL').value; //"<?php //echo base_url().'Discussion/discussionDetails/'; ?>"+getdid;
			    console.log(resultUrl);
					$('#ddetails').empty();
					//$('#dlist').css('display','none');
					//$('#disclist').css('display','none');
			    $('#ddetails').load(resultUrl);
			    $('#ddetails').css('display','block');//showing the list of discussion
			  }



			  function addNewComment(){
			    $('#myComment').modal('show');
			  }
			  function commentclose(){
			    $('#myComment').modal('hide');
			  }
				/*$("#logout").click(function(){
					alert('bye!');
					window.location.href = "https://login.marist.edu/cas/logout";
				});*/

				//showing the newly discussion created
     $("#contactForm").submit(function(event)
		 {
			 alert("new ajax");
         /* stop form from submitting normally */
         event.preventDefault();

         /* get some values from elements on the page: */
         var $form = $( this ),
             $submit = $form.find( 'button[type="submit"]' ),
						 cat_value = $form.find( 'select[name="category"]' ).val(),
             dstitle_value = $form.find( 'input[name="ds_title"]' ).val(),
             dsbody_value = $form.find( 'textarea[name="ds_body"]' ).val(),
             url = $form.attr('action');

         /* Send the data using post */
         var posting = $.post( url, {
                           category: cat_value,
                           ds_title: dstitle_value,
                           ds_body: dsbody_value
                       });

         posting.done(function( data )
         {
             /* Put the results in a div */
             $( "#contactResponse" ).html(data);

             /* Change the button text. */
             $submit.text('Sent, Thank you');

             /* Disable the button. */
             $submit.attr("disabled", true);
         });
			 });
			</script>
  </body>
</html>
