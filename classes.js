"use strict";
var CarPark = function(Name,Location,slots){
	var name = Name;
	var location = Location;
	var availability = true;
	var availableSlots = slots;
	
	this.getLocation = function(){
		return location;
	}
	this.setAvailability = function(Availability){
		availability = Availability;
	}
	this.getAvailability = function(){
		return availability;
	}
	this.setAvailableSlots = function(Slots){
		availableSlots = Slots;
	}
	this.getAvailableSlots = function(){
		return availableSlots;
	}
}

var Location = function(Longitude,Latitude){
	var longitude = Longitude;
	var latitude = Latitude;
	
	this.getLongitude = function(){
		return longitude;
	}
	this.setLongitude = function(newLongitude){
		longitude = newLongitude;
	}
	this.getLatitude = function(){
		return latitude;
	}
	this.setAvailableSlots = function(newLatitude){
		latitude = newLatitude;
	}
}