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
      zoom: 13,
      center: { lng: 79.9066, lat:6.89066 }
    });
    //var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
    // Create a marker icon from an image URL:
    var icon = new H.map.Icon('assets/graphics/parksymbol1.png');

    // Create a marker using the previously instantiated icon:
    var cpmarker1 = new H.map.Marker({ lat: 6.91175, lng: 79.8514 }, { icon: icon });
    var cpmarker2 = new H.map.Marker({ lat: 6.83284, lng: 79.8673 }, { icon: icon });
    var cpmarker3 = new H.map.Marker({ lat: 6.84131, lng: 79.8932 }, { icon: icon });
    var cpmarker4 = new H.map.Marker({ lat: 6.79585, lng: 79.8883 }, { icon: icon });
    var cpmarker5 = new H.map.Marker({ lat: 6.91175, lng: 79.8514 }, { icon: icon });
    var cpmarker6 = new H.map.Marker({ lat: 6.89066, lng: 79.9066 }, { icon: icon });

    // Add the marker to the map:
    map.addObject(cpmarker1);
    map.addObject(cpmarker2);
    map.addObject(cpmarker3);
    map.addObject(cpmarker4);
    map.addObject(cpmarker5);
    map.addObject(cpmarker6);

      
      

//public variables
var lat=0;
var lng=0;
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
    cpInfoArray[i]=new Array(i,0,0,0,0,0,0,0);
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
    document.getElementById("carkpark-info").className = "btn btn-ghost";
    console.log(lat,lng);
    center={lat:lat,lng: lng };
    map.setCenter (center, true);
    var mylocation = new H.map.Marker({ lat: lat, lng: lng });
    map.addObject(mylocation);
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
    cpInfoArray[index][6]=(distanceint/1000);
    cpInfoArray[index][7]=(traveltimeint/60);
    
    updateCarParkButtons();
}

//redirect to here maps for navigation
function navigate(cplat,cplng){
    console.log(cplat);
    console.log(cplng);
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
                cpInfoArray[index][1]=cp[1];
                cpInfoArray[index][2]=cp[2];
                cpInfoArray[index][3]=parseInt(cp[3],10);
                cpInfoArray[index][4]=parseInt(cp[4],10);
                cpInfoArray[index][5]=parseInt(cp[5],10);
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

        valueA = a[7];
        valueB = b[7];
        if (valueA < valueB) {
            return -1;
        }
        else if (valueA > valueB) {
            return 1;
        }
        return 0;
    });
    cpAvailableArray =  new Array();
    for(j=0;j<cpno;j++){
        cpAvailableArray[j]=new Array(0,0,0,0,0,0,0,0);
    }
    cpaan=1;
    for(var k=1;k<cpno; k++){
        
        console.log(cpInfoArray[k][3]);
        if(cpInfoArray[k][3]!==0){
            cpAvailableArray[cpaan]=cpInfoArray[k];
            document.getElementById("carpark"+ cpaan +"-btn").className="btn-carpark";
            console.log(cpInfoArray[k][7]);
            cpaan++;
        }
    }
    for(var k=1;k<cpno; k++){
        if(cpInfoArray[k][3]==0){
            cpAvailableArray[cpaan]=cpInfoArray[k];
            document.getElementById("carpark"+ cpaan +"-btn").className="btn-carpark disabled";
            document.getElementById("carpark"+ cpaan +"-btn").onclick=function(){alert("Car Park doesn't have any available slots");};
            cpaan++;
        }
    }
    console.log(cpAvailableArray[3][1]);
    console.log(cpInfoArray[1][0]+"- Distance: "+ cpInfoArray[1][6]+", Travel Time: "+cpInfoArray[1][7]+ " cpavailable: " + cpInfoArray[1][3]);
    console.log(cpInfoArray[2][0]+"- Distance: "+ cpInfoArray[2][6]+", Travel Time: "+cpInfoArray[2][7]+ " cplat: " + cpInfoArray[2][1]);
    console.log(cpInfoArray[3][0]+"- Distance: "+ cpInfoArray[3][6]+", Travel Time: "+cpInfoArray[3][7]);
    console.log(cpInfoArray[4][0]+"- Distance: "+ cpInfoArray[4][6]+", Travel Time: "+cpInfoArray[4][7]);
    console.log(cpInfoArray[5][0]+"- Distance: "+ cpInfoArray[5][6]+", Travel Time: "+cpInfoArray[5][7]);
    console.log(cpInfoArray[6][0]+"- Distance: "+ cpInfoArray[6][6]+", Travel Time: "+cpInfoArray[6][7]);
    document.getElementById("carpark1-btn").innerHTML="<span>   Car Park "+ cpAvailableArray[1][0]+"<br/><p>Distance: "+ cpAvailableArray[1][6]+"km<br/>   Travel Time: "+(cpAvailableArray[1][7]).toFixed(2)+"min<br/>  Available Slots: "+cpAvailableArray[1][3]+"<br/>  Booked: "+cpAvailableArray[1][5]+"</p></span>";
    document.getElementById("carpark2-btn").innerHTML="<span>   Car Park "+ cpAvailableArray[2][0]+"<br/><p>Distance: "+ cpAvailableArray[2][6]+"km<br/>   Travel Time: "+(cpAvailableArray[2][7]).toFixed(2)+"min<br/>  Available Slots: "+cpAvailableArray[2][3]+"<br/>  Booked: "+cpAvailableArray[2][5]+"</p></span>";
    document.getElementById("carpark3-btn").innerHTML="<span>   Car Park "+ cpAvailableArray[3][0]+"<br/><p>Distance: "+ cpAvailableArray[3][6]+"km<br/>   Travel Time: "+(cpAvailableArray[3][7]).toFixed(2)+"min<br/>  Available Slots: "+cpAvailableArray[3][3]+"<br/>  Booked: "+cpAvailableArray[3][5]+"</p></span>";
    document.getElementById("carpark4-btn").innerHTML="<span>   Car Park "+ cpAvailableArray[4][0]+"<br/><p>Distance: "+ cpAvailableArray[4][6]+"km<br/>   Travel Time: "+(cpAvailableArray[4][7]).toFixed(2)+"min<br/>  Available Slots: "+cpAvailableArray[4][3]+"<br/>  Booked: "+cpAvailableArray[4][5]+"</p></span>";
    document.getElementById("carpark5-btn").innerHTML="<span>   Car Park "+ cpAvailableArray[5][0]+"<br/><p>Distance: "+ cpAvailableArray[5][6]+"km<br/>   Travel Time: "+(cpAvailableArray[5][7]).toFixed(2)+"min<br/>  Available Slots: "+cpAvailableArray[5][3]+"<br/>  Booked: "+cpAvailableArray[5][5]+"</p></span>";
    document.getElementById("carpark6-btn").innerHTML="<span>   Car Park "+ cpAvailableArray[6][0]+"<br/><p>Distance: "+ cpAvailableArray[6][6]+"km<br/>   Travel Time: "+(cpAvailableArray[6][7]).toFixed(2)+"min<br/>  Available Slots: "+cpAvailableArray[6][3]+"<br/>  Booked: "+cpAvailableArray[6][5]+"</p></span>";
    //document.getElementById("carpark1-btn").onclick=navigate(cpAvailableArray[1][1], cpAvailableArray[1][2]);
    

    }
    
    /*document.getElementById("carpark2-btn").onclick=navigate(cpAvailableArray[2][1], cpAvailableArray[2][2]);
    document.getElementById("carpark3-btn").onclick=navigate(cpAvailableArray[3][1], cpAvailableArray[3][2]);
    document.getElementById("carpark4-btn").onclick=navigate(cpAvailableArray[4][1], cpAvailableArray[4][2]);
    document.getElementById("carpark5-btn").onclick=navigate(cpAvailableArray[5][1], cpAvailableArray[5][2]);
    document.getElementById("carpark6-btn").onclick=navigate(cpAvailableArray[6][1], cpAvailableArray[6][2]);
    document.getElementById("carpark1-btn").className="btn-carpark";
    document.getElementById("carpark2-btn").className="btn-carpark";
    document.getElementById("carpark3-btn").className="btn-carpark";
    document.getElementById("carpark4-btn").className="btn-carpark";
    document.getElementById("carpark5-btn").className="btn-carpark";
    document.getElementById("carpark6-btn").className="btn-carpark";*/
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

//disabled button no slots available
function noSlotsAvailable(){
    alert("Car Park doesn't have any available slots");
}

//reserving
function checkReserve(){
    

}
