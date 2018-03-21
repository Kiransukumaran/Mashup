<!DOCTYPE html>
<html>
<head>
  <title>People Output</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body background="red">
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <h1 style="color: blue;text-align: center;font-size: 250%;border-bottom: 2px dashed red"><b><?php echo $key; ?></b></h1>
      <!-- (Latitude:<?php echo $location['latitude']; ?>,Longitude:<?php echo $location['longitude']; ?>) -->
      
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <h1 style="text-align: center;font-size: 250%;border-bottom: 2px dotted red">Profile: Description and Info</h1>

    </div>
  <div class="row">
    <div class="col-xs-12">

      <h4 style="text-align: justify;"><?php echo $data; ?></h4>
    </div>
  </div>
   <div class="row">
    <div class="col-xs-12">
      <h1 style="text-align: center;font-size: 250%;border-bottom: 2px dotted red">Profile: Latest News</h1>

    </div>
  <?php 
  for ($i=0; $i <10 ; $i++) { 
  ?>
  <div class="row">
    <div class="col-xs-12">
      <h2>Source:<?php echo $name[$i]; ?></h2>
      <h3>Description:<?php echo $desc[$i]; ?></h3>
      

    </div>
  </div>
<?php } ?>
</div>


</body>
</html>
      <!-- <a href="<?php echo $news['url']; ?>" target="_blank">View more</a>
      <img src="<?php echo $news['urlToImage']; ?>" class="img-fluid img-responsive" width="70%" height="auto" alt="urlToImage is not available">
      <h3>Published At:<?php echo $news['publishedAt']; ?></h3> -->