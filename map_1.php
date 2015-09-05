<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Web GIS Emisi Udara Kota Bandung</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	
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
<div id="header">
		<div>
			<ul id="navigation">
				<li>
					<a href="index.html">Home</a>
				</li>
				<li class="active">
					<a href="map_1.php">Map</a>
				</li>
				<li>
					<a href="data.html">Data</a>
				</li>
				<li>
					<a href="about.html">About the inventory</a>
				</li>
				<li>
					<a href="contact.html">Contact</a>
				</li>
			</ul>
		</div>
	</div>

<div id="map">
Pilih Emisi:<br />
<form action="query_map.php" method="post">

<table>
<tr>
<td>
Jenis Emisi:<br />
<select name="jenis">
<option value="">---Pilih Data---</option>
<?php
include "db.inc.php";

$sql="SELECT DISTINCT jenis FROM emisi_grid";
$hasil=pg_exec($dbh,$sql);
while ($row1 = pg_fetch_array($hasil)){
	echo "<option value='".$row1['jenis']."'>".$row1['jenis']."</option>";
}
?>
</select><br /></td>

<td>
ID Metadata<br />
<select name="id_me">
<option value="">---Pilih Data---</option>
<?php
$sql="SELECT * FROM metadata";
$hasil=pg_exec($dbh,$sql);
while ($row1 = pg_fetch_array($hasil)){
	echo "<option value='".$row1['id_me']."'>".$row1['metode'].", ".$row1['sumber'].", ".$row1['keterangan'].", ".$row1['tahun']."</option>";
}
?>
</select><br /></td>
</tr>

<tr><td>
<input type="submit" value="Pilih!" />
</form>
</p>
</td></tr>
</table>

<?php
$jenis=$_POST['jenis'];
$id_me=$_POST['id_me'];
?>
      <!-- GetLegendGraphic, customized with some LEGEND_OPTIONS -->
      <img class="legend img-rounded" src="http://localhost:8080/geoserver/wms?SERVICE=WMS&REQUEST=GetLegendGraphic&VERSION=1.1.0&FORMAT=image/png&WIDTH=26&HEIGHT=18&STRICT=false&LAYER=grid&LEGEND_OPTIONS=fontName:sans-serif;fontSize:11;fontAntiAliasing:true;fontStyle:bold;fontColor:0xFFFFFF;bgColor:0x000000">
    </div>
<div class="span6" id="mouse-position">&nbsp;</div>

   
	<script>

var mousePositionControl = new ol.control.MousePosition({
  coordinateFormat: ol.coordinate.createStringXY(4),
  // comment the following two lines to have the mouse position
  // be placed within the map.
  className: 'custom-mouse-position',
  target: document.getElementById('mouse-position'),
  undefinedHTML: '&nbsp;'
});
	// Base map
var osmLayer = new ol.layer.Tile({source: new ol.source.OSM()});

// Emisi map layer
var wmsLayer = new ol.layer.Image({
  source: new ol.source.ImageWMS({
    url: 'http://localhost:8080/geoserver/wms',
    params: {'LAYERS': 'Emisi:grid'}
  }),
  opacity: 0.6
});

var map = new ol.Map({
  controls: ol.control.defaults({
    attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
      collapsible: false
    })
  }).extend([mousePositionControl]),
  layers: [osmLayer, wmsLayer],
  target: 'map',
  renderer: 'canvas',
  view: new ol.View({
	center: [11979540, -772368],
    zoom: 12
	})
});
  
	</script>

		<div id="footer">
		<div class="clearfix">
			
			<p>
				<center>Web GIS Emisi Udara Kota Bandung.
			</p>
		</div>
	</div>
</body>
</html>