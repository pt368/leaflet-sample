<?php
$data = [
    [ -75.16682669461794, 39.93789296877245],
    [ -75.19261881668366, 39.941611126302696],
    [ -75.18545195414627, 39.94707283203062],
    [ -75.18193289590774, 39.950198310932606],
    [ -75.18086001229436, 39.95144846246922],
    [ -75.17952963661375, 39.954409256545716],
    [ -75.16369387448023, 39.95243540806903],

];
?>

<!doctype html>
<html>
<head>
<title>leeflet test</title>
<meta name="description" content="leeflet">
<meta name="keywords" content="html tutorial template">
<link rel="stylesheet" href="leaflet.css" />
<script src="leaflet.js"></script>
</head>
<body>
<div id='map' style="min-height:100vh"></div>
</body>
<script>
var latlong = JSON.parse('<?php echo json_encode($data);?>');
var map = L.map('map').setView([37.8, -96], 4);
map.createPane('labels');

// This pane is above markers but below popups
map.getPane('labels').style.zIndex = 650;

// Layers in this pane are non-interactive and do not obscure mouse/touch events
map.getPane('labels').style.pointerEvents = 'none';

var cartodbAttribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="https://carto.com/attribution">CARTO</a>';

var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);
var data = [
    {
        "type": "Feature",
        "properties": {"name": "District 1"},
        "geometry": {
            "type": "Polygon",
            "coordinates": [latlong]
        }
    }
]

var geojson = L.geoJson(data, {}).addTo(map);
geojson.eachLayer(function (layer) {
    layer.bindPopup(layer.feature.properties.name);
});
map.fitBounds(geojson.getBounds());
</script>
</html>