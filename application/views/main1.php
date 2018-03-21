<!DOCTYPE html>
<html>
<head>
	<!-- <link href='//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/search_drop.css"> -->
	<!-- <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/search_drop.css"></ script>-->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
	<link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
	<link href='//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>

<style type="text/css">
html,body {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}
body {
  background-color: #ffecb3;
  overflow: hidden;
}
* {
  box-sizing: border-box;
}
.container {
  display: block;
  position: absolute;
  text-align: center;
  width: 100%;
  top: 50%;
  padding: 50px 0;
  -moz-transform: translateY(-50%);
  -webkit-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
  background-color: rgba(211,45,45,0.2);
}
.container:before {
  content: '';
  display: block;
  position: absolute;
  width: 150%;
  height: 100%;
  top: 0;
  left: -25%;
  -moz-transform: rotate(-3deg);
  -webkit-transform: rotate(-3deg);
  -o-transform: rotate(-3deg);
  -ms-transform: rotate(-3deg);
  transform: rotate(-3deg);
  z-index: -1;
  background-color: rgba(244,67,54,0.15);
}
h1 {
  font-family: "Lato";
  font-size: 1.3em;
  color: #fff;
  letter-spacing: 1px;
  margin-bottom: 50px;
}
h3 {
  display: block;
  height: 19px;
  margin-top: 30px;
  font-family: "Lato";
  font-size: 1em;
  color: #fff;
  opacity: 0;
}
.search-box-container {
  display: inline-block;
  box-sizing: content-box;
  height: 50px;
  width: 50px;
  padding: 0;
  background-color: #fff;
  border: 3px solid #f44336;
  border-radius: 28px;
  overflow: hidden;
}
.search-box-container * {
  display: inline-block;
  margin: 0;
  height: 100%;
  padding: 5px;
  border: 0;
  outline: none;
}
.search-box {
  width: calc(100% - 50px);
  padding: 0 20px;
  float: left;
  font-family: "Lato";
  font-size: 1em;
  color: #212121;
  background-color: #fff;
}
.submit {
  float: right;
  width: 50px;
  left: 0;
  top: 0;
  font-size: 1.2em;
  text-align: center;
  cursor: pointer;
  background-color: #fff;
}
.fa {
  display: inline !important;
  line-height: 100%;
  pointer-event: none;
  color: #d32f2f;
}

</style>
<script type="text/javascript">
$.fn.toggleState = function(b) {
  $(this)
    .stop()
    .animate(
    {
      width: b ? "300px" : "50px"
    },
    600,
    "easeOutElastic"
  );
};

$(document).ready(function() {
  var container = $(".container");
  var boxContainer = $(".search-box-container");
  var submit = $(".submit");
  var searchBox = $(".search-box");
  var response = $(".response");
  var isOpen = false;
  submit.on("mousedown", function(e) {
    e.preventDefault();
    boxContainer.toggleState(!isOpen);
    isOpen = !isOpen;
    if (!isOpen) {
      handleRequest();
     
    } else {
      searchBox.focus();
    }
  });
  searchBox.keypress(function(e) {
    if (e.which === 13) {
      boxContainer.toggleState(false);
      isOpen = false;
      handleRequest();
    }
  });
  searchBox.blur(function() {
    boxContainer.toggleState(false);
    isOpen = false;
  });
  function handleRequest() {
    // You could do an ajax request here...
    var value = searchBox.val();
    searchBox.val("");
    if (value.length > 0) {
      response.text('Searching for "' + value + '" . . .');
      response
        .animate(
        {
          opacity: 1
        },
        300
      )
        .delay(2000)
        .animate(
        {
          opacity: 0
        },
        300
      );
    }
  }
});
// $("#button").click(function() {
//   $('<form action="http://localhost/project/index.php/map" method="POST">' + 
//     '<input type="hidden" name="aid" value="' + Keyword + '">' +
//     '</form>').submit();
// });

</script>
	
</head>
<body>
<!-- <form method="POST" action="http://localhost/project/index.php/main">
<div class="container">
	
	<div class="search-box-container">
		<div class="submit">
			<i><input type="submit" class="fa fa-search"></i>
		</div>
		<input type="text" name="Keyword" class='search-box'>
	<div>
	<h3 class="response"></h3>
</div>
</form>
 -->
 <form method="POST" action="http://localhost/project/index.php/main" id="form1">
 <div class='container'>
 	
  <h1>Go on, click me!</h1>
  <div class='search-box-container'>
    <button type="submit" class='submit'>
      <i class='fa fa-search'></i>
    </button>
    <input name="Keyword" class='search-box'>
  </div>
  <h3 class='response'></h3>
</div>
 </form>
</body>
</html>




<!-- jQuery.ajax(
			        {
			        	type: "POST",
						url: "http://localhost/project/index.php/main"
					}); -->
					