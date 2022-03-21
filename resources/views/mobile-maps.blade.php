@if(request()->has('lat') && request()->has('lng'))
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maps</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" />
    <style>
        html, body {
            height: 100%;
            margin: 0px;
            padding: 0px;
        }
    </style>
</head>
<body>
    <div id="peta" style="width: 100%; height: 100%;"></div>

    <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js"></script>
    <script src="https://turbo87.github.io/sidebar-v2/js/leaflet-sidebar.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.71.1/src/L.Control.Locate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-pulse-icon@0.1.0/src/L.Icon.Pulse.min.js"></script>
    <script src="https://unpkg.com/beautifymarker@1.0.7/leaflet-beautify-marker-icon.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

    <script>
        var basemaps={

            "Google Street":L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                    maxZoom: 20,
                    subdomains:['mt0','mt1','mt2','mt3'],
                    attribution:''
            }),

        }

        var map = L.map('peta', {
            center: [{{ request()->get('lat') }}, {{ request()->get('lng') }}],
            zoom: 15,
            preferCanvas:true,
            bounceAtZoomLimits:false,
            minZoom: 8,
                maxBounds:[
                    [-9.319,110.868],
                    [-5.713,116.103]
                ],
            zoomControl:false,
            layers: [
                basemaps["Google Street"]
            ],
        });
        map.touchZoom.disable();
        map.doubleClickZoom.disable();
        map.scrollWheelZoom.disable();
        map.boxZoom.disable();
        map.keyboard.disable();

        var redIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        L.marker([{{ request()->get('lat') }}, {{ request()->get('lng') }}], {icon : redIcon}).addTo(map);
    </script>
</body>
</html>
@else
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Not Authorize</title>
</head>
<body>
    <h5>Not Authorize</h5>
</body>
</html>
@endif
