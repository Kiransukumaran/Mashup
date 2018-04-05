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
      <!--  -->
      
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
  <?php if(!empty($location)){ ?>
  <h1 style="text-align: center;font-size: 250%;border-bottom: 2px dotted red">Map of the place</h1>
  <iframe
  width="800"
  height="500"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCFi3P4pgNY8ALD3tqexVxAKeMW9pXYTLo&q=<?php echo $key; ?>" allowfullscreen>
</iframe>
<?php } ?>
   <div class="row">
    <div class="col-xs-12">
      <h1 style="text-align: center;font-size: 250%;border-bottom: 2px dotted red">News Summary</h1>
      <h4> <?php echo $lnews; ?></h4>
    </div>


   <div class="row">
    <div class="col-xs-12">
      <h1 style="text-align: center;font-size: 250%;border-bottom: 2px dotted red">Latest Trends in the World</h1>

    </div>
  <?php 
  for ($i=0; $i <5 ; $i++) { 
  ?>
  <div class="row">
    <div class="col-xs-12">
      <h2>Trends:<?php echo $name[$i]; ?></h2>
      <h3>Description:<?php echo $desc[$i]; ?><a href="<?php echo $url[$i]; ?>">view more</a></h3>
      <h4></h4>
      

    </div>
  </div>
<?php }  
?>
</div>


</body>
</html>
      <!-- <a href="<?php echo $news['url']; ?>" target="_blank">View more</a>
      <img src="<?php echo $news['urlToImage']; ?>" class="img-fluid img-responsive" width="70%" height="auto" alt="urlToImage is not available">
      <h3>Published At:<?php echo $news['publishedAt']; ?></h3> -->