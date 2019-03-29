<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>DP Food Finder</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            #map {
                height: 400px;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card" style="border: 1px solid #ffffff;">
                        <div class="card-body" style="width: 100%;">
                            <div class="input-group mb-3">
                                <input oninput="validateButton(event)" type="text" class="form-control input-sm" placeholder="Search Keyword" id="search" name="search">
                                <div class="input-group-append">
                                    <button id="search_btn" onclick="search()" class="btn btn-outline-secondary" type="button">Search</button>
                                </div>
                            </div>
                            <hr>
                            <h5 class="card-title">Map</h5>
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="border: 1px solid #ffffff;">
                        <div class="card-body" style="width: 100%;">
                            <div id="card_result">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
    <script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&callback=initMap"></script>
    <script>

        $.ajaxSetup({
            headers: {"cache-control":"no-cache"},
            beforeSend: function(request) {
                return request.setRequestHeader("X-CSRF-Token", $("meta[name='csrf-token']").attr('content'));
            }
        });

        // Initialize and add the map
        let map, markers = [];
        function initMap() {
            let options = {
                zoom: 14,
                center: {lat: 7.0806522, lng: 125.6136265}
            };

            map = new google.maps.Map(document.getElementById('map'), options);
        }

        function validateButton(e) {
            if (e.target.value === '') {
                $('#search_btn').prop('disabled', true);
            } else {
                $('#search_btn').prop('disabled', false);
            }
        }

        function search() {
            setMapOnAll(null);
            const keyword = $('#search').val();
            if (keyword.length === 0) {
                alert('Please enter a keyword');
                return;
            }
            $.post(`/api/search-restaurant`, {search: keyword}, function(response) {
                const res = response.data;
                const status = response.status;

                if (status === 'success') {
                    let card_result = $('#card_result'), result = '';

                    res.map(item => {
                        addMarker(Number(item.latitude), Number(item.longitude), item.name);
                        result += `<div onclick="restoInfo(${item.id}, ${item.latitude}, ${item.longitude}, '${item.name}')" class="card" style="border: 1px solid #ffffff; cursor: pointer;">
                                        <div class="card-body" style="width: 100%">
                                            <h5 id="restoName_${item.id}" class="card-title" style="color: blue;">${item.name}</h5>
                                            <hr>
                                            <div id="resto_info_${item.id}" style="display: none;">
                                                <address>${item.address}</address>
                                                <hr>
                                                <p><small>Location: </small><strong>Lat: ${item.latitude} , Lng: ${item.longitude}</strong></p>
                                                <p><small>Category: </small> <strong>${item.category.category}</strong></p>
                                                <p><small>Speciality: </small> <strong>${item.speciality.speciality}</strong></p>
                                                <p><small>Daily: </small> <strong>${item.sale.total_daily_sales.toFixed(2)}</strong></p>
                                                <p><small>Monthly: </small> <strong>${item.sale.total_monthly_sales.toFixed(2)}</strong></p>
                                            </div>
                                        </div>
                                    </div>`
                    });

                    card_result.html(result);
                    $('#search').val('');
                }
            });
        }


        function restoInfo(id, latitude, longitude, name) {

            let info_dev = $('#resto_info_' + id);
            let info_id = localStorage.getItem('info_id');
            let elem = document.getElementById('map');

            if (typeof info_id !== 'undefined')  {
                $('#restoName_' + info_id).css('color', 'blue');
                $('#resto_info_' + info_id).css('display', 'none');
                setMapOnAll(null);
            }

            addMarker(latitude, longitude, name);

            $('#restoName_' + id).css('color', '#000000');
            info_dev.css('display', 'block');
            info_dev.css('border', '1px solid #cccccc');
            info_dev.css('padding', '5px');
            info_dev.css('border-radius', '5px');
            localStorage.setItem('info_id', id);
            setTimeout(() => {
                elem.scrollIntoView();
            }, 5000);
        }

        function addMarker(latitude, longitude, name) {

            let marker = new google.maps.Marker({position: {lat: latitude, lng: longitude},map: map});
            markers.push(marker);

            let infoMarkerWindow = new google.maps.InfoWindow({
                content: `<div>
                            <p>${name}</p>
                            <p>Latitude: ${latitude} Longitude: ${longitude}</p>
                        </div>`
            });

            marker.addListener('click', function() {
                infoMarkerWindow.open(map, marker);
            });
        }

        function setMapOnAll(map) {
            for (let i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

    </script>
</html>
