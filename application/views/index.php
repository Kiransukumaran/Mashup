<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Lato:100,300,400,700);
        @import url(https://raw.github.com/FortAwesome/Font-Awesome/master/docs/assets/css/font-awesome.min.css);

body {
    background: #000;
    font-size: 15px;
}
#wrap {
  margin: 50px 100px;
  display: inline-block;
  position: relative;
  height: 60px;
  float: right;
  padding: 0;
  position: relative;
}

input[type="text"] {
  height: 60px;
  font-size: 55px;
  display: inline-block;
  font-family: "Lato";
  font-weight: 100;
  border: none;
  outline: none;
  color: #FFF;
  padding: 3px;
  padding-right: 60px;
  width: 0px;
  position: absolute;
  top: 0;
  right: 0;
  background: none;
  z-index: 3;
  transition: width .4s cubic-bezier(0.000, 0.795, 0.000, 1.000);
  cursor: pointer;
}

input[type="text"]:focus:hover {
  border-bottom: 1px solid #BBB;
}

input[type="text"]:focus {
  width: 700px;
  z-index: 1;
  border-bottom: 1px solid #BBB;
  cursor: text;
}
input[type="submit"] {
  height: 67px;
  width: 63px;
  display: inline-block;
  color:red;
  float: right;
  background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAMAAABg3Am1AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADNQTFRFU1NT9fX1lJSUXl5e1dXVfn5+c3Nz6urqv7+/tLS0iYmJqampn5+fysrK39/faWlp////Vi4ZywAAABF0Uk5T/////////////////////wAlrZliAAABLklEQVR42rSWWRbDIAhFHeOUtN3/ags1zaA4cHrKZ8JFRHwoXkwTvwGP1Qo0bYObAPwiLmbNAHBWFBZlD9j0JxflDViIObNHG/Do8PRHTJk0TezAhv7qloK0JJEBh+F8+U/hopIELOWfiZUCDOZD1RADOQKA75oq4cvVkcT+OdHnqqpQCITWAjnWVgGQUWz12lJuGwGoaWgBKzRVBcCypgUkOAoWgBX/L0CmxN40u6xwcIJ1cOzWYDffp3axsQOyvdkXiH9FKRFwPRHYZUaXMgPLeiW7QhbDRciyLXJaKheCuLbiVoqx1DVRyH26yb0hsuoOFEPsoz+BVE0MRlZNjGZcRQyHYkmMp2hBTIzdkzCTc/pLqOnBrk7/yZdAOq/q5NPBH1f7x7fGP4C3AAMAQrhzX9zhcGsAAAAASUVORK5CYII=) center center no-repeat;
  text-indent: -10000px;
  border: none;
  position: absolute;
  top: 0;
  right: 0;
  z-index: 2;
  cursor: pointer;
  opacity: 0.4;
  cursor: pointer;
  transition: opacity .4s ease;
}

input[type="submit"]:hover {
  opacity: 0.8;
}
    </style>
</head>
<body style="margin-top: 20px;padding-top: 300px;" background="white">

            <form method="POST" action="http://localhost/project/index.php/email">
              <div id="wrap">
                <form action="" autocomplete="on">
                  <input id="search" name="Keyword" type="text" placeholder="What're we looking for ?" autofocus="true">
                  <<!-- select name="select">
                    <option>Location</option>
                    <option>Email</option>
                    <option>People</option>
                  </select> -->
                  <input id="search_submit" value="Rechercher" type="submit">
                  </form>
              </div>
            <!--  <input type="text" class="form-control" name="Keyword" placeholder="Search term..." autofocus="true">-->
            <!--  <input type="submit" value="Search"> -->
                
            </form>
            <span><a href="<?php echo base_url(); ?>application/views/Git/index.php">Search for a github profile</a></span>
        <!-- Chat box code-->
        <script type="text/javascript">
        var headID = document.getElementsByTagName("head")[0];
        var newCss = document.createElement('link');
        newCss.rel = 'stylesheet';
        newCss.type = 'text/css';
        window._botUsername = '652080';
        window._botName = 'Our Assistant';
        newCss.href = "http://rebot.me/assets/css/bot.css";
        var newScript = document.createElement('script');
        newScript.src = "http://rebot.me/assets/js/bot.js";
        newScript.type = 'text/javascript';
        headID.appendChild(newScript);
        headID.appendChild(newCss);
        </script>
        

        
        
        

</body>
</html>