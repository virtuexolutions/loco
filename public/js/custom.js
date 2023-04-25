














//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
$("#move_calender").datepicker({
  navigationAsDateFormat: true,
  minDate: 0,
  onSelect:function(dateText,inst)
  {
    $("#move_date").val(dateText);
  }

});

$(".next").click(function(){

  var step  = $(this).attr("target-validation");
  if(step == "step_1"){ 
    if(step_1_validate(step) == false)
    {
      return
    }
  }
  if(step == "step_2"){ 
    if(step_2_validate(step) == false)
    {
      return
    }
  }
  if(step == "step_3"){ 
    if(step_3_validate(step) == false)
    {
      return
    }
  }
  if(step == "step_4"){ 
    if(step_4_validate(step) == false)
    {
      return
    }
  }
  if(step == "step_5"){ 
    if(step_5_validate(step) == false)
    {
      return
    }
  }
  if(step == "step_6"){ 
    if(step_6_validate(step) == false)
    {
      return
    }
  }
  if(step == "step_7"){ 
    if(step_7_validate(step) == false)
    {
      return
    }
  }
  if(step == "step_8"){ 
    if(step_8_validate(step) == false)
    {
      return
    }
  }
  if(step == "step_9"){ 
    if(step_9_validate(step) == false)
    {
      return
    }
  }
  if(step == "step_11"){ 
    if(step_11_validate(step) == false)
    {
      return
    }
  }
  if(step == "step_12"){ 
    if(step_12_validate(step) == false)
    {
      return
    }
  }
  if(step == "step_13"){ 
    if(step_13_validate(step) == false)
    {
      return
    }
  }
  if(step == "step_14"){ 
    if(step_14_validate(step) == false)
    {
      return
    }
  }
  if(step == "step_15"){ 
    if(step_15_validate(step) == false)
    {
      return
    }
  }
  
if(animating) return false;
animating = true;

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//activate next step on progressbar using the index of next_fs
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show(); 
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
  step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale current_fs down to 80%
      scale = 1 - (1 - now) * 0.2;
      //2. bring next_fs from the right(50%)
      left = (now * 50)+"%";
      //3. increase opacity of next_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({
  'transform': 'scale('+scale+')',
  'position': 'absolute'
});
      next_fs.css({'left': left, 'opacity': opacity});
  }, 
  duration: 800, 
  complete: function(){
      current_fs.hide();
      animating = false;
  }, 
  //this comes from the custom easing plugin
  easing: 'easeInOutBack'
 });
});

function  step_1_validate(step)
{
  var fields = $("#"+step).find("input[type='checkbox']:checked");
  if(fields.length == 0 )
  {
    var message = "how many room you want ? atlease select on of them";
    show_tiles_notification(message);
    return false;
  }
  else
  {
    return true;
  }
}
function step_2_validate(step)
{
  var field_1 = parseInt($("#"+step).find("select[name='price_range_min']").val()) ?? 0
  var field_2 = parseInt($("#"+step).find("select[name='price_range_max']").val()) ?? 0;
  if(field_1 == 0 || field_2 == 0)
  {
    var message = "Price Range minimum & maximum must be required "
    show_tiles_notification(message);
    return false;
  }
  if(field_1 > field_2)
  {
    var message = "Minimum Field must be smaller compasrison to maximum field"
    show_tiles_notification(message);
    return false;
  }
  return true
}
function step_3_validate(step)
{
  var field = parseInt($("#"+step).find("select[name='monthly_income']").val()) ?? 0
  if(field == 0)
  {
    var message = "Monthly combined income must be required "
    show_tiles_notification(message);
    return false;
  }
  return true
}
function step_4_validate(step)
{
  var field = $(".progControlSelect2").select2('data');
  if(field.length == 0)
  {
    var message = "atleast moving destination must be required "
    show_tiles_notification(message);
    return false;
  }
  return true
}
function  step_5_validate(step)
{
  var fields = $("#"+step).find("input[type='checkbox']:checked");
  if(fields.length == 0 )
  {
    var message = "atleast one type of builder must be required";
    show_tiles_notification(message);
    return false;
  }
  else
  {
    return true;
  }
}

function  step_6_validate(step)
{
  var fields = $("#"+step).find("input[type='checkbox']:checked");
  if(fields.length == 0 )
  {
    var message = "atleast one Features & Amenities must be required";
    show_tiles_notification(message);
    return false;
  }
  else
  {
    return true;
  }
}
function  step_7_validate(step)
{
  var fields = $("#"+step).find("input[type='checkbox']:checked");
  if(fields.length == 0 )
  {
    var message = "atleast one Bathroom Features must be required";
    show_tiles_notification(message);
    return false;
  }
  else
  {
    return true;
  }
}
function  step_8_validate(step)
{
  var fields = $("#"+step).find("input[type='checkbox']:checked");
  if(fields.length == 0 )
  {
    var message = "atleast one Furry Friends must be required";
    show_tiles_notification(message);
    return false;
  }
  else
  {
    return true;
  }
}
function  step_9_validate(step)
{
  var fields = $("#"+step).find("input[type='checkbox']:checked");
  if(fields.length == 0 )
  {
    var message = "atleast one you get there must be required";
    show_tiles_notification(message);
    return false;
  }
  else
  {
    return true;
  }
}

function  step_11_validate(step)
{
  var fields = $("#"+step).find("input[type='checkbox']:checked");
  if(fields.length == 0 )
  {
    var message = "atleast one Care Most About must be required";
    show_tiles_notification(message);
    return false;
  }
  else
  {
    return true;
  }
}
function  step_12_validate(step)
{
  var fields = $("#"+step).find("input[type='hidden']").val();
  if(fields.length == "")
  {
    var message = "move date must be required";
    show_tiles_notification(message);
    return false;
  }
  else
  {
    return true;
  }
}
function  step_13_validate(step)
{
  var field = parseInt($("#"+step).find("select[name='looking_lease_leght']").val()) ?? 0
  if(field == 0)
  {
    var message = "move date must be required";
    show_tiles_notification(message);
    return false;
  }
  else
  {
    return true;
  }
}
function  step_14_validate(step)
{
  debugger
  var field = $("#"+step).find("input[type='radio']:checked").val()
  debugger
  if(field == undefined)
  {
    var message = "flexible can your move must be required";
    show_tiles_notification(message);
    return false;
  }
  else
  {
    return true;
  }
}
function  step_15_validate(step)
{
  debugger
  var field = $("#"+step).find("input[type='radio']:checked").val()
  debugger
  if(field == undefined)
  {
    var message = "Ever been evicted in the last 7 years? anwser must be required";
    show_tiles_notification(message);
    return false;
  }
  else
  {
    return true;
  }
}



function show_tiles_notification(message)
{
    $.toast({
      heading: 'Validation Error',
      text: message,
      icon: 'warning',
      position: 'top-right',
      loader: true,        // Change it to false to disable loader
      loaderBg: '#9EC600'  // To change the background
  })
}


$(".previous").click(function(){
if(animating) return false;
animating = true;

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//de-activate current step on progressbar
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show(); 
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
  step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale previous_fs from 80% to 100%
      scale = 0.8 + (1 - now) * 0.2;
      //2. take current_fs to the right(50%) - from 0%
      left = ((1-now) * 50)+"%";
      //3. increase opacity of previous_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({'left': left});
      previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
  }, 
  duration: 800, 
  complete: function(){
      current_fs.hide();
      animating = false;
  }, 
  //this comes from the custom easing plugin
  easing: 'easeInOutBack'
});
});

$(".image-checkbox").each(function () {
if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
      $(this).addClass('image-checkbox-checked');
    }
    else {
      $(this).removeClass('image-checkbox-checked');
    }
});
// sync the state to the input
$(".image-checkbox").on("click", function (e) {
$(this).toggleClass('image-checkbox-checked');
var $checkbox = $(this).find('input[type="checkbox"]');
$checkbox.prop("checked",!$checkbox.prop("checked"))

e.preventDefault();
});

$(".image-checkbox-1").each(function () {
if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
$(this).addClass('image-checkbox-1-checked');
}
else {
$(this).removeClass('image-checkbox-1-checked');
}
});

// sync the state to the input
$(".image-checkbox-1").on("click", function (e) {
$(this).toggleClass('image-checkbox-1-checked');
var $checkbox = $(this).find('input[type="checkbox"]');
$checkbox.prop("checked",!$checkbox.prop("checked"))

e.preventDefault();
});

var canvas = document.getElementById('map-canvas');
var myLatlng = new google.maps.LatLng(52.512594,13.431108);

var mapOptions = {
zoom: 13,
center: myLatlng,
mapTypeId: google.maps.MapTypeId.ROADMAP
};
var map = new google.maps.Map(canvas, mapOptions);

var circleOptions = {
draggable: true,
editable: true,
 strokeColor: '#eeeeee',
 strokeOpacity: 0.8,
strokeWeight: 1,
 fillColor: '#FF0000',
 fillOpacity: 0.15,
 map: map,
 center: myLatlng,
 radius: 2000
};
var circle = new google.maps.Circle(circleOptions);

google.maps.event.addListener(circle, 'center_changed', update);
google.maps.event.addListener(circle, 'radius_changed', update);

function update() {
    var debug = document.getElementById("debug");
    var d = Math.pow(10,5);
    debug.innerHTML = "lat: " + Math.round(circle.getCenter().lat()*d)/d + "<br>";
    debug.innerHTML += "lng: " + Math.round(circle.getCenter().lng()*d)/d + "<br>";
    debug.innerHTML += "radius: " + Math.round(circle.getRadius()) + " m<br>";
}

update();

$(document).ready(function() {
var $progControl = $(".progControlSelect2").select2({
  placeholder: "Type to add an activity to user..."
});
//Disable select open on option remove
$("select").on("select2:unselect", function (evt) {
  if (!evt.params.originalEvent) {
      return;
  }
  evt.params.originalEvent.stopPropagation();
});


});







var searchInput = 'search_input';

$(document).ready(function () {
   
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
        types: ['geocode'],
        componentRestrictions: {
          country: "US"
        }
    });
	
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var near_place = autocomplete.getPlace();
        // alert(near_place.geometry);
        debugger
        document.getElementById('loc_lat').value = near_place.geometry.location.lat();
        document.getElementById('loc_long').value = near_place.geometry.location.lng();
	  });
});