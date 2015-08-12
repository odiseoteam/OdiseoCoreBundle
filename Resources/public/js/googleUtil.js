var GOOGLE_MAP = (function(){

 var placeSearch, autocomplete, map, addressMarked;
 var mapOptions = {
    zoom: 7,
    center: new google.maps.LatLng(18.1987192, -66.3526747),
    disableDefaultUI: true
  }
 
 var _initialize = function(){
    
    // Create the autocomplete object, restricting the search
    // to geographical location types.
    autocomplete = new google.maps.places.Autocomplete(
     (document.getElementById('odiseo_product_address')),
        { types: ['address'],
          componentRestrictions: {country: "pr"}});
    // When the user selects an address from the dropdown,
    // populate the address fields in the form.
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
      _localizarAddress(autocomplete.getPlace());

    });
    map = new google.maps.Map(document.getElementById('map_container'),   mapOptions);
    
    $('#odiseo_product_town').change( function(){
    	  var optionSelected = $(this).find("option:selected");
    	  var townSelected   = optionSelected.text();
    	  var matchedTown =  _matchCity(townSelected);
    });   
 
 }
 
 var _matchCity = function(townSelected){
	    var service = new google.maps.places.AutocompleteService();
	    var predictions = service.getPlacePredictions({ componentRestrictions: {country: 'pr'} , input : townSelected ,  types: ['(cities)']  }, _updatePlaceConfiguration);
 }

 var _updatePlaceConfiguration= function(predictions, status){
		
	     var placeService =  new google.maps.places.PlacesService(map);
		 var details = placeService.getDetails( { placeId : predictions[0].place_id }, function(placeResult, placesServiceStatus){
			 if (placeResult.geometry.viewport) {
			      map.fitBounds(placeResult.geometry.viewport);
			      autocomplete.bindTo('bounds', map);
			    } else {
			      map.setCenter(placeResult.geometry.location);
			      map.setZoom(17);  // Why 17? Because it looks good.
			    }
		 });
 }

 var _localizarAddress = function(place) {
	 	
	    //Esto que sigue genera acoplamiento. Separar en móulos, lanzar eventos.
	    $('#odiseo_product_address').attr('value', place.name );
	    $('#odiseo_product_town').attr('value', place.vicinity);
	    $('#odiseo_product_latitud').attr('value', place.geometry.location.lat() );
	    $('#odiseo_product_longitud').attr('value',  place.geometry.location.lng());
	  
	   var location = place.geometry.location
	   if (addressMarked != undefined)
		   addressMarked.setMap(null); 
        
	 	map.setCenter(location);
        map.setZoom(15);
        addressMarked = new google.maps.Marker({
            map: map,
            position: location
        });
        
        
  }
  google.maps.event.addDomListener(window, 'load', _initialize);

  return{
     localizarAddress  : _localizarAddress
  };
})();
