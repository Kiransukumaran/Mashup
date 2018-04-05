<!DOCTYPE html>
<html>
<head>
  <title>Location Output</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body background="red">
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <h1 style="color: blue;text-align: center;font-size: 250%;border-bottom: 2px dashed red">Profile:<b><?php echo $key; ?></b></h1>
      <!-- (Latitude:<?php echo $location['latitude']; ?>,Longitude:<?php echo $location['longitude']; ?>) -->
      <!-- (Latitude:<?php echo $location['latitude']; ?>,Longitude:<?php echo $location['longitude']; ?>) -->
      
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <h4 style="text-align: justify;"><?php echo $data; ?></h4>
    </div>
  </div>
  <iframe
  width="500"
  height="500"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCFi3P4pgNY8ALD3tqexVxAKeMW9pXYTLo&q=<?php echo $key; ?>" allowfullscreen>
</iframe>
  <div class="row">
    <div class="col-xs-12">
      <h1 style="text-align: center;font-size: 250%;border-bottom: 2px dotted red">Profile: Latest News</h1>

    </div>
  <?php 
  for ($i=0; $i <10 ; $i++) { 
  ?>
  <div class="row">
    <div class="col-xs-12">
      <h2>Trends:<?php echo $name[$i]; ?></h2>
      <h3>Description:<?php echo $desc[$i]; ?><a href="<?php echo $url[$i]; ?>">view more</a></h3>
      <h4></h4>
      

    </div>
  </div>
<?php unset($name[$i]);unset($desc[$i]); }  
?>

</div>


</body>
</html>
