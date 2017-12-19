<!DOCTYPE html>
<html lang="en">
<head>
  <title>Marist Discussion Forums</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script type="text/javascript">
  /*document.getElementById('ogd').onclick = function() {getList()};
  function getList() {
    var resultUrl = "<?php //echo base_url('Discussion/discussionList')?>";
    $('#disclist').load(resultUrl);
  }*/
//  var getdid = document.getElementById('d_id').value;
//  $(function(){
    function fetchList(myURL){
      var resultUrl = myURL//document.getElementById('getURL').value; //"<?php //echo base_url().'Discussion/discussionDetails/'; ?>"+getdid;
      $('#dlist').load(resultUrl);
      $('#dlist').css('display','block');//showing the list of discussion
      $('#main_page').css('display','none'); //hiding the button create new discussion and view on-going discussions
      console.log(resultUrl);
    }
    //$('#anchorid').click(fetchList);
//  });
  </script>
</head>
<body>
<?php @session_start();//echo form_open(base_url().'Discussion/discussionDetails','role="form"'); ?>
<div class="col-md-9 fluid">
  <form name="dview" id="dview" method="post" action="<?php echo base_url().'Discussion/discussionDetails/'; ?>">
  <h2>On-going Discussions</h2>
      <div class="col-md-9 fluid">
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
            <td><a id="anchorid" href="javascript:fetchList('<?php echo base_url().'Discussion/discussionDetails/'.$result->d_id; ?>')"><?php echo $result->d_title; ?></a></td>
          <!--  <td><a href="<?php //echo base_url().'Discussion/discussionDetails/'.$result->d_id; ?>"><?php echo $result->d_title;echo "dont click"; ?></a></td>-->
            <td><?php echo $result->cwid; ?></td>
            <td><input type="hidden" id="d_id" name= "d_id" value ="<?php echo (isset($result->d_id))?$result->d_id:'';?>" required="required" /></td>
            <td><input type="hidden" id="getURL" name="getURL" value="<?php echo base_url().'Discussion/discussionDetails/'.$result->d_id; ?>"></input><!--this is to pass urls to specific discussions -->
          </tr>
        </div>
<?php endforeach; ?>
</table>
</form>
</div>
<?php //echo form_close(); ?>
</body>
</html>
