<html>
<head>
  <script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>
</head>
<body>
  <div id="map" style="width: 500px; height: 400px;"></div>

  <script type="text/javascript">
    var locations = [
      ['Sunnyside', 54.587091, -5.928134],
      // [(<?php echo "\"PLACE NAME\""; ?>), 54.587091, -5.928134]

    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 14,
          mapTypeControl: false,
          panControl: false,
          PanControlOptions: false,
          zoomControl: false,
          zoomControlOptions: false,
          scaleControl: false,
          scrollwheel: false,
        rotateControl: false,
        streetViewControl: false,       
          overviewMapControl: false,        
          mapTypeId: 'roadmap', 
      //need to make this the halfway point coords
      center: new google.maps.LatLng(54.5970, -5.9300),
      // center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
</body>
</html>
