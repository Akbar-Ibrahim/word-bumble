<!DOCTYPE html>
<html>
<title>Word Bumble | Home</title>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> -->
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <link href="{{ asset('css/w3-css.css') }}" rel="stylesheet">
    <link href="{{ asset('css/w3-css-color.css') }}" rel="stylesheet">

    


<style>
.w3-button {
  font-size: 30px;
  color: white;

}

a {
  text-decoration: none;
  
}
</style>
    
    </head>
<body>


<nav class="w3-sidebar w3-black w3-animate-top w3-xxlarge" style="display:none;padding-top:150px;z-index:4;color:white;" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-black w3-text-white w3-xxlarge w3-padding w3-display-topright" style="padding:6px 24px;color: white;">
    <i class="fa fa-remove"></i>
  </a>
  <div class="w3-bar-block w3-center" style="width: 30%">
    <a style="text-decoration: none; color: white" href="/" class="w3-bar-item w3-text-white w3-hover-amber">Home</a>
    <a style="text-decoration: none; color: white;" href="/" class="w3-bar-item w3-text-white w3-hover-amber">Games</a>
  </div>
</nav>



<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a style="text-decoration: none;" href="/" class="w3-bar-item "><b>Word Bumble</b> </a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right ">
      <!-- <a href="#projects" class="w3-bar-item w3-button">Projects</a>
      <a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="#contact" class="w3-bar-item w3-button">Contact</a> -->
      <span style="cursor: pointer;" class="w3-right" onclick="w3_open()"><i class="fas fa fa-bars"></i></span> 
    </div>
  </div>
</div>

<div id="app" class="" >
<main class="py-4">
<div class="w3-container" style="margin-top: 100px;">
  @yield('content')
  </div>
</main>
</div>

<script>
// Open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.width = "100%";
  document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>


@yield('scripts')

<script>
$(document).ready(function(){
//   $(".go-button").addClass("w3-win8-lime");
//   $(".go-button").css("color", "white");
// });

$(document).keydown(function(event) {
    if (event.keyCode == 27) {
      $("#mySidebar").hide();
    }

});

</script>


</body>
</html>
