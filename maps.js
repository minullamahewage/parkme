// Initialize the platform object:
var platform = new H.service.Platform({
    'app_id': 'EaMacGi1Wj3dRmQlGXCu',
    'app_code': 'YXiH50dmZNPxmzS0ldy6Sw'
    });

    // Obtain the default map types from the platform object
    var maptypes = platform.createDefaultLayers();

    // Instantiate (and display) a map object:
    var map = new H.Map(
    document.getElementById('mapContainer'),
    maptypes.normal.map,
    {
      zoom: 14,
      center: { lng: 79.861788, lat:6.913887  }
    });
    //var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
    // Create a marker icon from an image URL:
    var icon = new H.map.Icon('assets/graphics/parksymbol1.png');

    // Create a marker using the previously instantiated icon:
    var marker = new H.map.Marker({ lat: 6.911750, lng: 79.851406 }, { icon: icon });

    // Add the marker to the map:
    map.addObject(marker);
//get current location
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
    this.lat = position.coords.latitude;
    this.lng = position.coords.longitude;
    console.log(lat,lng);
    //return lat+ "," + lng;
  }
//reading xml file
function getDistance(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        readDistance(this);
        }
    };
    var lat = showPosition().lat;
    var lng = showPosition().lng;
    console.log(lat,lng);
    xhttp.open("GET", "https://route.api.here.com/routing/7.2/calculateroute.xml?app_id=EaMacGi1Wj3dRmQlGXCu&app_code=YXiH50dmZNPxmzS0ldy6Sw&waypoint0=geo!"+lat+","+lng+"&waypoint1=geo!6.911750,79.851406&mode=fastest;car;traffic:disabled", true);
    xhttp.send();
}
//get distance from xml file    
function readDistance(xml) {
    var xmlDoc = xml.responseXML;
    var x = xmlDoc.getElementsByTagName('Distance')[0];
    var y = x.childNodes[0];
    console.log(y);
    //document.getElementById("demo").innerHTML = y.nodeValue; 
}

//function getRoute(){
   // https://route.api.here.com/routing/7.2/calculateroute.xml?app_id=EaMacGi1Wj3dRmQlGXCu&app_code=YXiH50dmZNPxmzS0ldy6Sw&waypoint0=geo!6.795043,79.900576&waypoint1=geo!6.911750,79.851406&mode=fastest;car;traffic:disabled
//}