<div id = "pageLocation" class = "buffer"></div>
<div class = "content">
    <h2 id = "locationtitle">Our Locations</h2>
    <h4 id = "locationtxt">We are based in the heart of Surrey and cover the majority of this beautiful county exploring all of the stunning parks, nature reserves and play areas whilst on walks! <br> We offer this service to anyone within the postcoded areas: KT, TW, SL, GU</h4>
    <div id = "map"></div>
    <script>
    function initMap() {
    var options = {
        zoom:10,
        center:{lat: 51.3470,lng: -0.5090}
    }
    var map = new google.maps.Map(document.getElementById('map'), options);

    // Add circle overlay and bind to marker
    var circle = new google.maps.Circle({
        map: map,
        center: options.center,
        radius: 16093,    // 10 miles in metres
        fillColor: '#AA0000'
    });
    }
    </script>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsu8m97OtYsQ4iPblsHdLuAwfcDhmOca4&callback=initMap" async defer>
    </script>
    <button class = "booknow" id = "locationbookbtn"><a href = "index.php?p=booking">Book Now</a></button>
</div>  