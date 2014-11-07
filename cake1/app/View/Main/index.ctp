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
$(function() {
    $( "#sendbutton" ).click(function() {
        var derror = false;
        if ($("#delay").val().length<1)
        {
            $("#delay").parent().addClass("has-error");
            derror = true;
        } else {$("#delay").parent().removeClass("has-error"); }
        
         if ($("#repeat").val().length<1)
         {
           $("#repeat").parent().addClass("has-error");
            derror = true;
         } else {$("#repeat").parent().removeClass("has-error"); }
         
         if (derror)
         {
             return false;
         }
    });
    
    //repeat
       
        
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
            <li class="active"><a href="index">Home</a></li>
            <? if ($rez) { ?>
            <li><a href="check">Check status</a></li>
            <li><a>User: <?=$rez['Siteuser']['email'];?></a></li>
            <? } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="starter-template">
        <h1>Upload your files</h1>
       <form role="form" method="post" action="check" id="PostAddForm" enctype="multipart/form-data" class="form-horizontal">
   <input type='hidden' name='posted' value='posted'>
   <div class="form-group">
      <label for="inputfile">Main file</label>
      <input type="file" id="mainfile" name="mainfile">
      <p class="help-block">only .wav .mp3</p>
   </div>
    <div class="form-group">
      <label for="inputfile">Tag file</label>
      <input type="file" id="tagfile" name="tagfile">
      <p class="help-block">only .wav .mp3</p>
   </div> 
   <div class="form-group">
      <label for="delay">delay between tags</label>
      <input type="number" min="0" step="1" class="form-control" id="delay" name="delay" size="2"
         placeholder="Enter digit">
   </div>
      <div class="form-group">
      <label for="delay">* times repeat</label>
      <input type="number" min="0" step="1" class="form-control" name="repeat" id="repeat" size="2"
         placeholder="Enter digit">
   </div>
         <div class="form-group">
      <label for="start">Start a tag with * second</label>
      <input type="number" min="0" step="1" class="form-control" name="start" id="start" size="2"
         placeholder="Enter digit">
   </div>
   <? if ($rez==False) { ?>
            <div class="form-group">
      <label for="start">Email for registration</label>
      <input type="email" class="form-control" name="email" id="email"
         placeholder="Enter email">
   </div>
   <? } ?>
   
   
   <button type="submit" id="sendbutton" class="btn btn-default">Submit</button>
</form>
      </div>

    </div>
</body>
</html>