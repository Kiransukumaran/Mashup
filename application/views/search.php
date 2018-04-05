<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <title>Animated Search box [Pure CSS]</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Antic'>

    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
    <style type="text/css">
        .form-style {
            padding-top: 150px;
            padding-left: 580px;

        }
        .font-styles {
            font-size: 6em;
            color:white;
            text-align: center;
            font-style: italic;
            font-weight: bold;
            border-bottom: 1px dashed white;
        }
    </style>
  
</head>

<body>
  
  <!-- <div align="center">
  <br>
  <br>
  <br>
  <div class="text">Simple animated search box</div>
  <br>
  <br>
  <br>
 -->  
 <h1 class="font-styles">Search It : Profiler</h1>
<form class="form-styles" style="float: right;padding-top: 200px;" method="POST" action="http://localhost/project/index.php/people">
  <select  class="submits" name="option">
    <option>Location</option>
    <option>People</option>
  </select>
  <input type="text" class="submits" name="Keyword" placeholder="Search..." autofocus="true" required="true">
  <input type="submit" class="submits" value="Search">


</form>
  
  <script src='https://use.edgefonts.net/amaranth.js'></script>
<footer style="padding-top: 360px;color: black;">
<pre>&copy Mashup Trios                                                                          Developed by Arya,Kiran,Sreedev,Nithin Shoji 
</pre>
</footer>
<script type="text/javascript">
        var headID = document.getElementsByTagName("head")[0];
        var newCss = document.createElement('link');
        newCss.rel = 'stylesheet';
        newCss.type = 'text/css';
        window._botUsername = '652080';
        window._botName = 'Ask Me What You Want ';
        newCss.href = "http://rebot.me/assets/css/bot.css";
        var newScript = document.createElement('script');
        newScript.src = "http://rebot.me/assets/js/bot.js";
        newScript.type = 'text/javascript';
        headID.appendChild(newScript);
        headID.appendChild(newCss);
        </script>
</body>

</html>
