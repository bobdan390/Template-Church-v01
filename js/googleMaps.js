        var source, destination;
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();
        google.maps.event.addDomListener(window, 'load', function () {
            new google.maps.places.SearchBox(document.getElementById('origen'));
            new google.maps.places.SearchBox(document.getElementById('destino'));
            directionsDisplay = new google.maps.DirectionsRenderer({ 'draggable': false });
        });

        function GetRoute() {
            var mexico = new google.maps.LatLng(23.3854868, -111.5710472);
            var mapOptions = {
                zoom: 5,
                center: mexico
            };
            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            directionsDisplay.setMap(map);
            /*directionsDisplay.setPanel(document.getElementById('dvPanel'));*/

            //*********DIRECTIONS AND ROUTE**********************//
            source = document.getElementById("origen").value;
            destination = document.getElementById("destino").value;

            var request = {
                origin: source,
                destination: destination,
                travelMode: google.maps.TravelMode.DRIVING
            };
            directionsService.route(request, function (response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                }
            });

            //*********DISTANCE AND DURATION**********************//
            var service = new google.maps.DistanceMatrixService();
            service.getDistanceMatrix({
                origins: [source],
                destinations: [destination],
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC,
                avoidHighways: false,
                avoidTolls: false
            }, function (response, status) {
                if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
                    var distance = response.rows[0].elements[0].distance.text;
                    var duration = response.rows[0].elements[0].duration.text;
                    var dvDistance = document.getElementById("dvDistance");
                    dvDistance.innerHTML = "";
                    dvDistance.innerHTML += "Distancia: " + distance + "<br />";
                    dvDistance.innerHTML += "Duracion:" + duration;
					
					document.getElementById("mapDistancia").value = distance;
					document.getElementById("mapTiempo").value = duration;

                } else {
                    alert("Distancia muy larga por carretera!");
                }
            });
        }