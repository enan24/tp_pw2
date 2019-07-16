$(document).ready(function () {
    var x = $("#location");
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(savePosition, showError);
        }
    }

    function savePosition(position) {
        var latitud = position.coords.latitude;
        var logitud = position.coords.longitude;
        x.text("Latitud: " + latitud + " Longitud: " + logitud);
        $("#latitud").val(latitud);
        $("#longitud").val(logitud);
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                x.text("Se ha denegado el acceso a la geolocalización.");
                break;
            case error.POSITION_UNAVAILABLE:
                x.text("La información no esta disponible.");
                break;
            case error.TIMEOUT:
                x.text("Tiempo de espera agotado.");
                break;
            case error.UNKNOWN_ERROR:
                x.text("Error desconocido.");
                break;
        }
    }
    getLocation();
});