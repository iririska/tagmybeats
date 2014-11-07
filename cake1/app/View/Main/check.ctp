<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<? echo $this->Html->script('jquery'); ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style>
body {
  padding-top: 50px;
}
.starter-template {
  padding: 40px 250px;
  text-align: center;
}
</style>
<script>
function startRefresh() {
    setTimeout(startRefresh,5000);
    $.get('ajax', function(data) {
        $('#reztable').html(data);    
    });
}


$(function() {
    startRefresh();
    $( "#checkstatus" ).click(function() {
     // alert( "Handler for .click() called." );
	  //get request
	  $.get( "ajax", function( data ) {
    // $( ".result" ).html( data );
  alert( data);
});
	  
      return false;
    });

    $(document).on('click', ".playmusic", function() {
        var musicurl = $(this).prev().attr("href");
        //alert(musicurl);
        $("#audplayer").html("<audio src='"+musicurl+"' controls autoplay></audio>");
    });
});
</script>
</head>
<body>




    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">TagMyBeats.com</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index">Home</a></li>
            <li class="active"><a href="check">Check status</a></li>
            <? if ($rez) { ?>
            <li><a>User: <?=$rez['Siteuser']['email'];?></a></li>
            <? } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

  
<? if($secret) { ?>
<div class="starter-template">
	    <h1>Registration complete!</h1>
		<p class="lead">login link: http://tagmybeats.com/cake/login?id=<?=$secret;?></p>
</div>
	  <? } ?>
<div id="audplayer"><!-- <audio src="<?=$row[2];?>" controls></audio>--> </div>
<table class="table" id="reztable">
    <thead>
        <tr>
            <th>main file</th>
            <th>tag file</th>
            <th>result file</th>
            <th>delay</th>
            <th>repeats</th>
            <th>start</th>
            <th>addtime</th>
            <th>proceed</th>
        </tr>
    </thead>
    <tbody>
<? foreach($tasks as $row) { ?>
        <tr>
            <td>
                <a href="../test/<?=$row['Task']['mainfile'];?>"><?=$row['Task']['mainfile_name'];?></a>
            </td>
            <td><a href="../test/<?=$row['Task']['tagfile'];?>"><?=$row['Task']['tagfile_name'];?></a></td>
            <td>
            <?if ($row['Task']['proceed']=="1") {?>
            <a href="../test/upload/<?=$row['Task']['out_file'];?>"><?=$row['Task']['out_file'];?></a>
            <?}?>
            </td>
            <td><?=$row['Task']['delay'];?></td>
            <td><?=$row['Task']['times'];?></td>
            <td><?=$row['Task']['start'];?></td>
            <td><?=$row['Task']['addtime'];?></td>
            <td><?=$row['Task']['proceed'];?></td>
        </tr>
<? }?>

 </tbody>
</table>
    </div>
</body>
</html>