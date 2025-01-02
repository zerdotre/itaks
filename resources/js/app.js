import './bootstrap';

var isMapsLoaded = false;
window.loadMaps = function (callback) {
    if(!isMapsLoaded){
        var script = document.createElement('script');
        script.src = 'https://maps.googleapis.com/maps/api/js?key='+GOOGLE_MAPS_API_KEY+'&libraries=places&callback='+callback;
        script.async = true;
        document.head.appendChild(script);
        isMapsLoaded = true;
    }else{
        window[callback]();
    }
};

window.scrollToTop = function(){

    window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth",
      });

}