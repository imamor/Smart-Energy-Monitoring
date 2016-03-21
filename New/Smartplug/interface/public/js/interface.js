// Refresh sensor data
setInterval(function() {

  // Update sensor & core status
  $.get('/get', {command: '/current', core: 'core'}, function(json_data) {

    // sensor
    if (json_data.result){
      $("#sensorDisplay").html("Current: " + json_data.result + "A");
    }

    // Core status
    if (json_data.coreInfo['connected'] == true){
      $("#CoreStatus").html("Core Online");
      $("#CoreStatus").css("color","green");    
    }
    else {
      $("#CoreStatus").html("Core Offline");
      $("#CoreStatus").css("color","red");     
    }

  
  });
   
}, 1000);
setInterval(function() {

  // Update sensor & core status
  $.get('/get', {command: '/voltage', core: 'core'}, function(json_data) {

    // sensor
    if (json_data.result){
      $("#voltageDisplay").html("Voltage: " + json_data.result + "A");
    }

    // Core status
    if (json_data.coreInfo['connected'] == true){
      $("#CoreStatus").html("Core Online");
      $("#CoreStatus").css("color","green");    
    }
    else {
      $("#CoreStatus").html("Core Offline");
      $("#CoreStatus").css("color","red");     
    }

  
  });
   
}, 1000);


// Function to control the lamp
function buttonClick(clicked_id){

  if (clicked_id == "1"){
    $.get('/post', {command: '/relay', core: 'core', params: '1'});
  } 

  if (clicked_id == "2"){
    $.get('/post', {command: '/relay', core: 'core', params: '0'});
  } 

}



