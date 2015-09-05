<!DOCTYPE html>
<html>
  <head>
    <title>Boundless Census Map</title>
    <!-- JQuery -->
    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <!-- OpenLayers -->
    <link rel="stylesheet" href="http://openlayers.org/en/v3.0.0/css/ol.css" type="text/css">
    <script src="http://openlayers.org/en/v3.0.0/build/ol.js" type="text/javascript"></script>
    <!-- Our Application -->
    <style>
      html, body, #map {
        height: 100%;
      }
      #map {
        padding-top: 50px;
      }
      .legend {
        position: absolute;
        z-index: 1;
        left: 10px;
        bottom: 10px;
        opacity: 0.6;
      }
    </style>
  </head>
  <body>
   <div class="span6" id="mouse-position">&nbsp;</div>


    <div id="map">

    
    </div>
	
	<script>

	var mousePositionControl = new ol.control.MousePosition({
  coordinateFormat: ol.coordinate.createStringXY(4),
  projection: 'EPSG:4326',
  // comment the following two lines to have the mouse position
  // be placed within the map.
  className: 'custom-mouse-position',
  target: document.getElementById('mouse-position'),
  undefinedHTML: '&nbsp;'
});	
	// TUTORIAL #1
// Base map
var osmLayer = new ol.layer.Tile({source: new ol.source.OSM()});

/*
// Census map layer
var wmsLayer = new ol.layer.Image({
  source: new ol.source.ImageWMS({
    url: 'http://apps.boundlessgeo.com/geoserver/wms',
    params: {'LAYERS': 'opengeo:normalized'}
  }),
  opacity: 0.6
});
*/

// Map object
var map = new ol.Map({
  controls: ol.control.defaults({
    attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
      collapsible: false
    })
  }).extend([mousePositionControl]),
  layers: [osmLayer],
  target: 'map',
  renderer: 'canvas',
  view: new ol.View({
    center: [0, 0],
    zoom: 2
  })
});

/*
// !TUTORIAL #1

// TUTORIAL #2
// Load variables into dropdown
$.get("../data/DataDict.txt", function(response) {
  // We start at line 3 - line 1 is column names, line 2 is not a variable
  $(response.split('\n').splice(2)).each(function(index, line) {
    $('#topics').append($('<option>')
      .val(line.substr(0, 10).trim())
      .html(line.substr(10, 105).trim()));
  });
});
// !TUTORIAL #2

// TUTORIAL #3
// Add behaviour to dropdown
$('#topics').change(function() {
  wmsLayer.getSource().updateParams({
    'viewparams': 'column:' + $('#topics>option:selected').val()
  });
});
// !TUTORIAL #3

// TUTORIAL #6
// Create an ol.Overlay with a popup anchored to the map
var popup = new ol.Overlay({
  element: $('#popup')
});
olMap.addOverlay(popup);

// Handle map clicks to send a GetFeatureInfo request and open the popup
olMap.on('singleclick', function(evt) {
  var view = olMap.getView();
  var url = wmsLayer.getSource().getGetFeatureInfoUrl(evt.coordinate,
      view.getResolution(), view.getProjection(), {'INFO_FORMAT': 'text/html'});
  popup.setPosition(evt.coordinate);
  $('#popup-content iframe').attr('src', url);
  $('#popup')
    .popover({content: function() { return $('#popup-content').html(); }})
    .popover('show');
  // Close popup when user clicks on the 'x'
  $('.popover-title').click(function() {
    $('#popup').popover('hide');
  });
});
// !TUTORIAL #6
*/
	
	</script>
	
	<div id="footer">
		<div class="clearfix">
			
			<p>
				2023 Zerotype. All Rights Reserved.
			</p>
		</div>
	</div>
  </body>
</html>