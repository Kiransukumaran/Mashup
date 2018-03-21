
<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
  </head>
  <body>
    <h3>My Google Maps Demo</h3>
    <div id="map"></div>
        <!-- var lat = <?php echo $location['latitude']; ?>;
        var lng = <?php echo $location['longitude']; ?>;
        var uluru = {lat,lng}; -->
    <script>
      function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjMDx-ZnkOy9YRyC7bYsKK6us6E7BYKsE&callback=initMap">
    </script>
  </body>
</html>