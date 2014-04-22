
function send_match_request(user_a_id, user_b_id, user_b_email, user_b_name, user_b_surname){
	console.log("User B Email", user_b_email);
    getCurrentPosition(function(position){
        user_a_latitude = position.coords.latitude;
        user_a_longitude = position.coords.longitude;

        $.ajax({
    		method: 'POST',
    		url: 'send_match_request.php',
    		data: { user_a: { id: user_a_id, latitude: user_a_latitude, longitude: user_a_longitude},
                    user_b: { id: user_b_id, email: user_b_email, name: user_b_name, surname: user_b_surname}},
    		success: function(data){ refresh();  },
    		error: function(){ alert("Boo error!"); }
    	});
    });
}

function accept_request(request_id){
    getCurrentPosition(function(position){
        latitude = position.coords.latitude;
        longitude = position.coords.longitude;

        $.ajax({
            method: 'POST',
            url: 'accept_request.php',
            data: { request_id: request_id, latitude: latitude, longitude: longitude},

            success: function(data){ refresh();  },
            error: function(){ alert("Request denied!"); }
        });
    });
}

function send_venue_choice(venue_id, match_id){
    console.log("venue id ", venue_id);

    $.ajax({
        method: 'POST',
        url: 'select_venue.php',
        data: { venue_id: venue_id, match_id: match_id},
        success: function(data){ refresh();  },
        error: function(){ alert("NOOO venue id not sent"); }
    });
}

function confirm_venue_choice(match_id){

    $.ajax({
        method: 'POST',
        url: 'confirm_venue.php',
        data: {match_id: match_id},
        success: function(data){ 
            //Refresh the page. 
            refresh(); 
            //Should really updating the page to show success
        },
        error: function(){ alert("NOOO match id not sent"); }
    });
}

function finished(request_id){

    $.ajax({
        method: 'POST',
        url: 'finished.php',
        data: {request_id: request_id},
        success: function(data){ 
            //Refresh the page. 
            refresh(); 
            //Should really updating the page to show success
        },
        error: function(){ alert("NOOO request id not sent"); }
    });
}

function getCurrentPosition(callback){
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(callback);
    }
}

function refresh(){
    window.location.reload();
}

window.onload = function() {      
    var map = new google.maps.Map(document.getElementById("mapbg"),
    {        
    center: new google.maps.LatLng(54.5970, -5.9300),        
    zoom: 14,
    mapTypeControl: false,
    panControl: false,
    PanControlOptions: false,
    zoomControl: false,
    zoomControlOptions: false,
    scaleControl: false,
    scrollwheel: false,
	rotateControl: false,
	streetViewControl: false,       
    overviewMapControl: false,        
    mapTypeId: 'roadmap'      
    });      
}


$('#aboutModal').modal();
$('#contactModal').modal();
$('#requestModal').modal();

$(document).ready(function(){
    // set up hover panels
    // although this can be done without JavaScript, we've attached these events
    // because it causes the hover to be triggered when the element is tapped on a touch device
    $('.hover').hover(function(){
        $(this).addClass('flip');
    },function(){
        $(this).removeClass('flip');
    });

  //name of the button to click to make the change
  $("#hide-modal-btn").click(function(){
    //the emelent to add the class to
    $("#hide-modal").addClass("hide-modal-class");
                  //class name to add
  });
});