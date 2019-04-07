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

//public variables
var lat;
var lng;
var distance;
var traveltime;
var cp_var;
var cparrayglobal;
var testValue=0;
//array 0 - cpid, 1 - distance, 2 - travel time, 3- cplat, 4 - cplng
cpInfoArray = new Array();
cpno=7;
//Initialise carpark info array
for(i=0;i<cpno;i++){
    cpInfoArray[i]=new Array(i,0,0,0,0);
}


//get current location
//main function; button press
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
//called inside getLocation()
function showPosition(position) {
    lat = position.coords.latitude;
    lng = position.coords.longitude;
    console.log(lat,lng);
  }

//reading xml file
//main function; button press
function getDistance(cplat,cplng,index){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            readDistance(this,index);  
        }
    };
    xhttp.open("GET", "https://route.api.here.com/routing/7.2/calculateroute.xml?app_id=EaMacGi1Wj3dRmQlGXCu&app_code=YXiH50dmZNPxmzS0ldy6Sw&waypoint0=geo!"+lat+","+lng+"&waypoint1=geo!"+cplat+","+cplng+"&mode=fastest;car;traffic:disabled", true);
    xhttp.send();
    //window.open("https://route.api.here.com/routing/7.2/calculateroute.xml?app_id=EaMacGi1Wj3dRmQlGXCu&app_code=YXiH50dmZNPxmzS0ldy6Sw&waypoint0=geo!"+lat+","+lng+"&waypoint1=geo!"+cplat+","+cplng+"&mode=fastest;car;traffic:disabled");   
}

//get distance from xml file; called inside getDistance()   
function readDistance(xml,index) {
    //var xmlText = new XMLSerializer().serializeToString(xml);
    var xmlDoc = xml.responseXML;
    var x = xmlDoc.getElementsByTagName('Distance')[0];
    var y = x.childNodes[0];
    //console.log(typeof b);

    var a = xmlDoc.getElementsByTagName('BaseTime')[0];
    var b = a.childNodes[0];
    distance= xmlToString(y);
    traveltime=xmlToString(b);
    var distanceint=parseInt(distance,10);
    var traveltimeint=parseInt(traveltime,10);
    console.log(distanceint);
    console.log(distance);
    console.log(traveltime);
    cpInfoArray[index][1]=distanceint;
    cpInfoArray[index][2]=traveltimeint;
    cpInfoArray[index][3]=cp[1];
    cpInfoArray[index][4]=cp[2];
    updateCarParkButtons();
}

//redirect to here maps for navigation
function navigate(cplat,cplng){
    window.open("https://wego.here.com/directions/drive/"+lat+","+lng+"/"+cplat+","+cplng+"?map="+cplat+","+cplng+",13,normal&avoid=carHOV") ;
}

//function getRoute(){
   // https://route.api.here.com/routing/7.2/calculateroute.xml?app_id=EaMacGi1Wj3dRmQlGXCu&app_code=YXiH50dmZNPxmzS0ldy6Sw&waypoint0=geo!6.795043,79.900576&waypoint1=geo!6.911750,79.851406&mode=fastest;car;traffic:disabled
//}
//Add all carpark distance and travel data to carpark info array
function getDistancesList(cparray){
    //console.log(cpDistanceArray[3][1]);
    for (index = 1; index < 7; index++) {
            cparrayglobal=cparray;    
            cp=cparray[index];
                cp_var=cp;
                getDistance(cp[1],cp[2],index);   
    }    
    
    
       
    
}
function updateCarParkButtons(){
    testValue+=1;
    console.log(testValue);
    //sort array of car parks based on travel time
    if (testValue==cpno-1){
    cpInfoArray.sort(function(a, b) {
        var valueA, valueB;

        valueA = a[2];
        valueB = b[2];
        if (valueA < valueB) {
            return -1;
        }
        else if (valueA > valueB) {
            return 1;
        }
        return 0;
    });
    console.log(cpInfoArray[1][0]+"- Distance: "+ cpInfoArray[1][1]+", Travel Time: "+cpInfoArray[1][2]);
    console.log(cpInfoArray[2][0]+"- Distance: "+ cpInfoArray[2][1]+", Travel Time: "+cpInfoArray[2][2]+ " cplat: " + cpInfoArray[2][3]);
    console.log(cpInfoArray[3][0]+"- Distance: "+ cpInfoArray[3][1]+", Travel Time: "+cpInfoArray[3][2]);
    console.log(cpInfoArray[4][0]+"- Distance: "+ cpInfoArray[4][1]+", Travel Time: "+cpInfoArray[4][2]);
    console.log(cpInfoArray[5][0]+"- Distance: "+ cpInfoArray[5][1]+", Travel Time: "+cpInfoArray[5][2]);
    console.log(cpInfoArray[6][0]+"- Distance: "+ cpInfoArray[6][1]+", Travel Time: "+cpInfoArray[6][2]);
    document.getElementById("carpark1-btn").innerHTML="<span>   Car Park "+ cpInfoArray[1][0]+"<br/><p>Distance: "+ cpInfoArray[1][1]+"m<br/>   Travel Time: "+cpInfoArray[1][2]+"s</p></span>";
    document.getElementById("carpark2-btn").innerHTML="<span>   Car Park "+ cpInfoArray[2][0]+"<br/><p>Distance: "+ cpInfoArray[2][1]+"m<br/>   Travel Time: "+cpInfoArray[2][2]+"s</p></span>";
    document.getElementById("carpark3-btn").innerHTML="<span>   Car Park "+ cpInfoArray[3][0]+"<br/><p>Distance: "+ cpInfoArray[3][1]+"m<br/>   Travel Time: "+cpInfoArray[3][2]+"s</p></span>";
    document.getElementById("carpark4-btn").innerHTML="<span>   Car Park "+ cpInfoArray[4][0]+"<br/><p>Distance: "+ cpInfoArray[4][1]+"m<br/>   Travel Time: "+cpInfoArray[4][2]+"s</p></span>";
    document.getElementById("carpark5-btn").innerHTML="<span>   Car Park "+ cpInfoArray[5][0]+"<br/><p>Distance: "+ cpInfoArray[5][1]+"m<br/>   Travel Time: "+cpInfoArray[5][2]+"s</p></span>";
    document.getElementById("carpark6-btn").innerHTML="<span>   Car Park "+ cpInfoArray[6][0]+"<br/><p>Distance: "+ cpInfoArray[6][1]+"m<br/>   Travel Time: "+cpInfoArray[6][2]+"s</p></span>";
    }
}
//convert xml objects to string
function xmlToString(xmlData) { 

    var xmlString;
    //IE
    if (window.ActiveXObject){
        xmlString = xmlData.xml;
    }
    // code for Mozilla, Firefox, Opera, etc.
    else{
        xmlString = (new XMLSerializer()).serializeToString(xmlData);
    }
    return xmlString;
}


//reserving
function checkReserve(){
    

}