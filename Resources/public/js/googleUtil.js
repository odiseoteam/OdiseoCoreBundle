var GOOGLE_MAP = (function()
{
    var placeSearch, autocomplete, map, addressMarked;
    var mapOptions = {
        zoom: 7,
        center: new google.maps.LatLng(18.1987192, -66.3526747),
        disableDefaultUI: true
    };
 
    var _initialize = function()
    {
        // Create the autocomplete object, restricting the search
        // to geographical location types.
        autocomplete = new google.maps.places.Autocomplete(document.getElementById('odiseo_product_address'), {
            types: ['address'],
            //componentRestrictions: {country: "pr"}
        });

        // When the user selects an address from the dropdown,
        // populate the address fields in the form.
        google.maps.event.addListener(autocomplete, 'place_changed', function()
        {
         
            _localizarAddress(autocomplete.getPlace());
        });
        map = new google.maps.Map(document.getElementById('map_container'), mapOptions);


        $('#odiseo_product_address').focusout(function(e){
            e.stopPropagation();
            $('#odiseo_product_address').val("");
            if (addressMarked != undefined)
                addressMarked.setMap(null);
            $('#odiseo_product_town_name').attr('value', "");
            $('#odiseo_product_town_region_name').attr('value', "");
            $('#odiseo_product_latitud').attr('value', "" );
            $('#odiseo_product_longitud').attr('value', "");

        });
    };

    var _refreshMap = function()
    {
        map = new google.maps.Map(document.getElementById('map_container'), mapOptions);
        google.maps.event.trigger(map, 'resize');
    };

    //restringe las predicciones del autocomplete a una zona determinada.
    var _matchCity = function(townSelected)
    {
	    var service = new google.maps.places.AutocompleteService();
	    var predictions = service.getPlacePredictions({ componentRestrictions: {country: 'pr'} , input : townSelected ,  types: ['(cities)']  }, _updatePlaceConfiguration);
    };

    var _updatePlaceConfiguration= function(predictions, status)
    {
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
    };

    var _localizarAddress = function(place)
    {
	    //Esto que sigue genera acoplamiento. Separar en móulos, lanzar eventos.
	    $('#odiseo_product_address').attr('value', place.name );
	    $('#odiseo_product_town_name').attr('value', place.vicinity);
        country = _retrieveCountry(place);
        $('#odiseo_product_town_region_name').attr('value', country);

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
    };

    var _retrieveCountry = function(place)
    {
       var country = '';
       $.each(place.address_components , function( index, component){
            $.each(component.types , function( index, value){
                if ( value == 'country')
                {
                    country =   component.long_name;
                }

            });
        });
        return country;
    };

    google.maps.event.addDomListener(window, 'load', _initialize);

    return {
        localizarAddress  : _localizarAddress,
        refreshMap: _refreshMap
    };

})();