jQuery(document).ready(function() {
    // Enable the API on each Vimeo video
    // Check to make sure that the Frugaloop library has been loaded.
    if ( typeof $f == 'function' ) {
        jQuery('iframe.vimeo').each(function(){
            Froogaloop(this).addEvent('ready', ready);
        });
    }

    function ready( playerID ){
        console.log( playerID + ' is ready' );
        // Add event listeners
        // http://developer.vimeo.com/player/js-api#events
        Froogaloop( playerID ).addEvent( "play", recordPlay );
        Froogaloop( playerID ).addEvent( "pause", recordPause );
        Froogaloop( playerID ).addEvent( "finish", recordFinish );
    }
    function recordPlay( playerID ) {
        var videoName = jQuery( 'iframe#' + playerID ).data( 'videoname' );
        // console.log( 'Recording Event: played for video: ' + playerID + ' with videoName: ' + videoName );
        _kmq.push(['record', 'Played Video', {'Played Video Name':videoName}]);
    }
    function recordPause( playerID ) {
        var videoName = jQuery( 'iframe#' + playerID ).data( 'videoname' );
        // console.log( 'Recording Event: pause for video: ' + playerID + ' with videoName: ' + videoName );
        _kmq.push(['record', 'Paused Video', {'Paused Video Name':videoName}]);
    }
    function recordFinish( playerID ) {
        var videoName = jQuery( 'iframe#' + playerID ).data( 'videoname' );
        // console.log( 'Recording Event: finish for video: ' + playerID + ' with videoName: ' + videoName );
        _kmq.push(['record', 'Finished Video', {'Finished Video Name':videoName}]);
    }
});