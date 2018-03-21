<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(e){
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#","");
        var concept = $(this).text();
        $('.search-panel span#search_concept').text(concept);
        $('.input-group #search_param').val(param);
    });
});
</script>
</head>
<body style="margin-top: 20px;padding-top: 300px;">
<div class="container">
    <div class="row">    
        <div class="col-xs-8 col-xs-offset-2">
            <form method="POST" action="http://localhost/project/index.php/news">
                <div class="input-group">
                <div class="input-group-btn search-panel">
                
                <input type="text" class="form-control" name="Keyword" placeholder="Search term..." autofocus="true">
                <span class="input-group-btn">
                   <p style="padding:15px;text-align: center;"> <input type="submit" value="Search" class="btn btn-default btn-special fit" style="padding:5px 35px 5px 35px; color: #1f70f2;"></p>
                </span>
                </div>
            </form>
        </div>
    </div>
</div>


</body>
</html>