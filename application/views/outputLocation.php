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
      <h1 style="color: blue;text-align: center;font-size: 250%;border-bottom: 2px dashed red"><b><?php echo $key; ?></b>(Latitude:<?php echo $location['latitude']; ?>,Longitude:<?php echo $location['longitude']; ?>)</h1>
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
      <h1 style="text-align: center;font-size: 250%;border-bottom: 2px dotted red">Latest News</h1>

    </div>
  <div class="row">
    <div class="col-xs-12">
      <h2>Source:<?php echo $news['source']; ?></h2>
      <h2>Title:<?php echo $news['title']; ?></h2>
      <h3>Description:<?php echo $news['description']; ?></h3>
      <a href="<?php echo $news['url']; ?>" target="_blank">View more</a>
      <img src="<?php echo $news['urlToImage']; ?>" class="img-fluid img-responsive" width="70%" height="auto" alt="urlToImage is not available">
      <h3>Published At:<?php echo $news['publishedAt']; ?></h3>

    </div>
  </div>

</div>


</body>
</html>
