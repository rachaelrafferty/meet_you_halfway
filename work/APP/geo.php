    <div class="map-container" style="height: 250px; width: 250px; margin: 0; padding: 0;">

    <script type="text/javascript">

      var user_map;

      function initialize() {
        var user_mapOptions = {
          zoom: 16,

          zoomControl: false,
          zoomControlOptions: false,
          scaleControl: false,
          scrollwheel: false
          

        };
        user_map = new google.maps.Map(document.getElementById('map-canvas'),
            user_mapOptions);

        // Try HTML5 geolocation
        if(navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = new google.maps.LatLng(position.coords.latitude,
                                             position.coords.longitude);

            var marker = new google.maps.Marker({
                position: pos,
                map: user_map,
                content: "testing",
                icon: 'img/map-marker.png'
            });

            user_map.setCenter(pos);
          }, function() {
            handleNoGeolocation(true);
          });


        } else {
          // Browser doesn't support Geolocation
          handleNoGeolocation(false);
        }
      }

      function handleNoGeolocation(errorFlag) {
        if (errorFlag) {
          var content = 'Error: The Geolocation service failed.';
        } else {
          var content = 'Error: Your browser doesn\'t support geolocation.';
        }

        var options = {
          map: user_map,
          position: new google.maps.LatLng(60, 105),
          content: content
        };

        var infowindow = new google.maps.InfoWindow(options);
        map.setCenter(options.position);
      }

      google.maps.event.addDomListener(window, 'load', initialize);

    </script>
	
  <div id="map-canvas" style="height: 100%; width: 100%; margin: 0; padding: 0;"></div>


</div>
    
