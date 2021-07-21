<!DOCTYPE html>
<html>
<title>Word Bumble | Home</title>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


    <link href="{{ asset('css/w3-css.css') }}" rel="stylesheet">
    <link href="{{ asset('css/w3-css-color.css') }}" rel="stylesheet">

<style>
.w3-button {
  font-size: 30px;
  background-color: red;
  color: white;
}
</style>
    
    </head>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a style="text-decoration: none;" href="/" class="w3-bar-item "><b>Word Bumble</b> </a>
    <!-- Float links to the right. Hide them on small screens -->
    <!-- <div class="w3-right w3-hide-small">
      <a href="#projects" class="w3-bar-item w3-button">Projects</a>
      <a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="#contact" class="w3-bar-item w3-button">Contact</a>
    </div> -->
  </div>
</div>

<div id="app" class="" style="margin-top: 100px;">
<main class="py-4">
  @yield('content')
</main>
</div>


@yield('scripts')

<script>
$(document).ready(function(){
  $(".go-button").addClass("w3-win8-lime");
  $(".go-button").css("color", "white");
});

</script>


</body>
</html>
