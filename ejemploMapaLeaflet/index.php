<!DOCTYPE html><html>
<meta charset="utf-8" />
<head>

    <!--
      Para añadir leaflet a nuestro proyecto basta con incluir la librería javascript y el css que nos proporciona leaflet. Por comodidad, añadiremos ambas desde el CDN.
    -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
     integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
     crossorigin=""/>
   <!-- Make sure you put this AFTER Leaflet's CSS -->
   <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
     integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
     crossorigin=""></script>
 <style>
  #mapid {
    height: 180px;
    height: 600px;
  }
 </style>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 </head>
  <body>
   <div id="mapid"></div>
 <script>

  $(document).ready(function(){
    var info = "";
    $.getJSON('prueba.php',info, function(resp){
      console.log(resp);
    });
  });

 var miArray = [
   {"loc":[41.575330,13.102411], "title":"aquamarine"},
   {"loc":[41.575730,13.002411], "title":"black"},
   {"loc":[41.807149,13.162994], "title":"blue"},
   {"loc":[41.507149,13.172994], "title":"chocolate"},
   {"loc":[41.847149,14.132994], "title":"coral"},
   {"loc":[41.219190,13.062145], "title":"cyan"},
   {"loc":[41.344190,13.242145], "title":"darkblue"},
   {"loc":[41.679190,13.122145], "title":"Darkred"},
   {"loc":[41.329190,13.192145], "title":"Darkgray"},
   {"loc":[41.379290,13.122545], "title":"dodgerblue"},
   {"loc":[41.409190,13.362145], "title":"gray"},
   {"loc":[41.794008,12.583884], "title":"green"},
   {"loc":[41.805008,12.982884], "title":"greenyellow"},
   {"loc":[41.536175,13.273590], "title":"red"},
   {"loc":[41.516175,13.373590], "title":"rosybrown"},
   {"loc":[41.506175,13.273590], "title":"royalblue"},
   {"loc":[41.836175,13.673590], "title":"salmon"},
   {"loc":[41.796175,13.570590], "title":"seagreen"},
   {"loc":[41.436175,13.573590], "title":"seashell"},
   {"loc":[41.336175,13.973590], "title":"silver"},
   {"loc":[41.236175,13.273590], "title":"skyblue"},
   {"loc":[41.546175,13.473590], "title":"yellow"},
   {"loc":[41.239190,13.032145], "title":"white"}
 ];
 console.log("Loc x:"+miArray[3]["loc"][0]+" - Loc y:"+miArray[3]["loc"][1]+" - Title:"+miArray[3]["title"]);

 var arrayNew = [];

 //arrayNew.push({"loc":[41.219190,13.062145], "title":"cyan"});
 //console.log("Loc x:"+arrayNew[0]["loc"][0]);


 <?php
  $coorx = 39.190878;
  $coory = -6.7806939999999996;
   for ($i=0; $i<5; $i++) {
     //echo "nom:".$i;
 ?>
      arrayNew.push({"loc":[<?php echo $coorx; ?>,<?php echo $coory+$i; ?>], "title":<?php echo 'nombre'.$coory-$i; ?>});
 <?php
   }
   //$i=3;
 ?>

 //console.log("Loc x:"+arrayNew[1]["loc"][1]);



  /**
    Para poder cargar el mapa, necesitamos indicarle a leaflet el identificador un elemento div cargado en el DOM de nuestra página. Le indicaremos a leaflet que utilice el elemento con id “map”.
    La llamada a la función “setView” nos centrará el mapa en las coordenadas que le indiquemos (lat, lng) y con el nivel de zoom que deseemos.
  **/
  var mymap = L.map('mapid').setView([40.453191, -3.509236], 6);

  /**
  A continuación, tenemos que añadirle un “tileLayer” a nuestro mapa. Un “tile” es una imagen que representa un área determinada. Cada nivel de zoom cargará los “tiles” asociados a ese nivel de zoom, los cuales tendrán más o menos detalle en función de la escala del nivel de zoom.

  Para cargar los tiles de OpenStreetMap, utilizaremos el siguiente código:
  **/

  var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
  var osmAttrib = 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';

  var osm = new L.TileLayer(osmUrl, {
      attribution: osmAttrib,
      minZoom: 5,
      maxZoom: 16
      /*id: 'mapbox.streets',*/
      /*accessToken: 'your.mapbox.access.token'*/
  });

  osm.addTo(mymap);
  //L.control.scale().addTo(mymap);

/**
  En cuanto a este codigo comentar un par de detalles:

  En cuanto a la URL, el párametro “s” representa subdominios (para cargar de distintos subdominios si el servicio dispone de ellos y aligerar la carga), el parámetro “z” el nivel de zoom, y los parámetros “x” e “y” las coordenadas del “tile”.
  La atribución añadirá una nota al pie del mapa indicando el origen de los mismos.
  Para crear la capa, se debe indicar la URL del servicio de mapas, y entre las opciones podemos indicar los niveles de zoom máximo y mínimo que queremos permitir.
  Con esto ya tendríamos nuestro mapa centrado en el punto que deseemos
**/

/*
  marcadores con iconos:
*/

var positionicon = L.icon({
  iconUrl: 'marcador-de-posicion.png',
  //shadowUrl: 'marcador-de-posicion.png',

  iconSize:     [40, 40], // size of the icon
  //shadowSize:   [50, 64], // size of the shadow
  iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
  shadowAnchor: [4, 62],  // the same for the shadow
  popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

/** 5. Añadir marcadores a nuestro mapa
    Leaflet nos permite añadir marcadores de forma sencilla:
**/
//L.marker([41.66, -4.71], {draggable: true}).addTo(mymap);
  var marker1 = L.marker([38.190878, -6.7806939999999996]).addTo(mymap);
  //var marker = L.marker([39.190878, -5.7806939999999996]).addTo(mymap);
  var marker3 = L.marker([38.190878, -4.7806939999999996], {icon: positionicon}).addTo(mymap);

  var markersLayer = new L.LayerGroup();
	mymap.addLayer(markersLayer);

  for(i in arrayNew) {
      var loc = arrayNew[i].loc, title = arrayNew[i].title;
      console.log("arreglo: "+arrayNew[i].loc+" - "+arrayNew[i].title);
      markerq = new L.Marker(new L.latLng(loc)).addTo(mymap);

      marker = new L.Marker(new L.latLng(loc), {title: title, icon:positionicon});
      marker.bindPopup("<b>Hello world!</b><br>I am a popup."+title).openPopup();
      markersLayer.addLayer(marker);

  }

  var polilinea= L.polyline([
    [39.190878, -6.7806939999999996],
    [38.190878, -6.7806939999999996],
    [39.190878, -5.780694],
    [39.190878, -4.780694],
  ], {color:"orange", weight: 10, opacity: 0.8}).addTo(mymap);


//5.1. Adding a circle:
  var circle = L.circle([39.190878, -4.7806939999999996], {
      color: 'red',
      fillColor: '#f03',
      fillOpacity: 0.5,
      radius: 800
  }).addTo(mymap);

  //Adding a polygon:

  var polygon = L.polygon([
    [39.190879, -5.7806939999999993],
    [39.190873, -5.7806939999999991],
    [39.190421, -5.780693999999999670]
]).addTo(mymap);


//añade popup al marcador que se le indique marcador:

marker1.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
circle.bindPopup("I am a circle.");
polygon.bindPopup("I am a polygon.");


/*
var popup = L.popup()
    .setLatLng([39.190870, -5.7806939999999990])
    .setContent("I am a standalone popup.")
    .openOn(mymap);
*/
/* Muestra alerta por cada click:
function onMapClick(e) {
    alert("You clicked the map at " + e.latlng);
}

mymap.on('click', onMapClick);
*/

/* Muestra popup con latitud y longitud donde se le de clic: */

var popupp = L.popup();

function onMapClick(e) {
    popupp
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(mymap);
}

mymap.on('click', onMapClick);


/** 6. Mostrar un popup con información de un marcador **/
/**
  Si además de mostrar el marcador, queremos que nos muestre alguna información adicional, podemos emplear un popup para representar esta información en forma de HTML. Para ello podemos refactorizar el código anterior ligeramente
**/

/*
  var location = [39.190878, -5.7806939999999996];
  var marker = L.marker(location)
  marker.bindPopup('<p>Latitud:'+location[0]+'</p><p>Longitud:'+location[1]+'</p>');
  marker.addTo(mymap);
*/



/*http://inisig.com/comenzar-con-leaflet-y-el-webmapping-i/*/
/*
https://www.blogsig.com/2018/04/que-es-leaflet-y-como-usarlo.html:

  L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'your.mapbox.access.token'
}).addTo(mymap);
*/


/** https://www.adictosaltrabajo.com/tutoriales/mapas-interactivos-con-leaflet-js/#05 **/

 </script>
 </body>
 </html>
