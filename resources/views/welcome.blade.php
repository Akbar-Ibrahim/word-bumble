<!DOCTYPE html>
<html>
<head>
<title>Word Bumble | Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>

<link href="{{ asset('css/app.css') }}" rel="stylesheet">


<link href="{{ asset('css/w3-css.css') }}" rel="stylesheet">
<link href="{{ asset('css/w3-css-color.css') }}" rel="stylesheet">

<style>
.w3-button {
  font-size: 20px;
}

button {
  color: white;
}

a {
  text-decoration: none;
  
}
</style>

</head>
<body>

<!-- Sidebar -->
<nav class="w3-sidebar w3-green w3-animate-top w3-xxlarge" style="display:none;padding-top:150px;z-index:4;color:white;" id="mySidebar">
  <a style="font-size: 30px; color: white;" href="javascript:void(0)" onclick="w3_close()" class="w3-green w3-text-white w3-xxlarge w3-padding w3-display-topright" style="padding:6px 24px">
    <i class="fa fa-remove"></i>
  </a>
  <div class="w3-bar-block w3-center" style="width: 30%;">
    <a style="text-decoration: none; color: white;" href="/" class="w3-bar-item w3-text-white w3-hover-amber">Home</a>
    <a style="text-decoration: none; color: white;" href="/" class="w3-bar-item w3-text-white w3-hover-amber">Games</a>
  </div>
</nav>


<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a style="text-decoration: none;" href="/" class="w3-bar-item "><b>Word Bumble</b> </a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right">
      <!-- <a href="#projects" class="w3-bar-item w3-button">Projects</a>
      <a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="#contact" class="w3-bar-item w3-button">Contact</a> -->
      <span style="cursor: pointer;" class="w3-right" onclick="w3_open()"><i class="fas fa fa-bars"></i></span> 
    </div>
  </div>
</div>

<!-- Header -->
<!-- <header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
  <img class="w3-image" src="/images/abcmagnet.jpg" alt="Architecture" width="1500" height="800">
  <div class="w3-display-middle w3-margin-top w3-center">
    <!-- <h1 class="w3-xxlarge w3-text-white w3-center"><span class="w3-padding w3-black w3-opacity-min"><b>Word Bumble</b></span> <span class="w3-hide-small w3-text-light-grey"></span></h1> -->
  </div>
</header> -->

<header class="w3-container w3-content w3-wide" style="max-width:1500px;" id="home">
  <div class="w3-middle w3-margin-top w3-center">
    <h1 class="w3-hide-small w3-xxlarge w3-text-white w3-center"><span style="font-size: 100px;"  class="w3-padding w3-black w3-opacity-min">Word Bumble</span> <span class="w3-hide-small w3-text-light-grey"></span></h1>
    <h1 style="margin-top:50px;" class="w3-hide-large w3-xxlarge w3-text-white w3-center"><span style="font-size: 30px;"  class="w3-padding w3-black w3-opacity-min">Word Bumble</span> <span class="w3-hide-small w3-text-light-grey"></span></h1>
  </div>
</header>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

  <!-- Project Section -->
  <div class="w3-container w3-padding-32" id="projects">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Games</h3>
  </div>


<div id="app">
  <div class="w3-row-padding" style="margin-bottom: 100px;">
    <div class="w3-col l6 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>The begining is the end, the end is the begining</h3>
        <div class="w3-container w3-center w3-margin">
            <play-button route="/last/letter"></play-button>
        </div>
      </div>
    </div>
    <div class="w3-col l6 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>The begining is the end, the end is the begining: Reloaded</h3>
        <div class="w3-container w3-center w3-margin">
            <play-button route="/begining-and-end/equal"></play-button>
        </div>
      </div>
    </div>

  </div>



  <div class="w3-row-padding">
  <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Ends With</h3>
        <div class="w3-container w3-center w3-margin">
        <play-button route="/ends"></play-button>
        </div>
      </div>
    </div>
    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Every Letter</h3>
        <div class="w3-container w3-center w3-margin">
            <play-button route="/every-letter"></play-button>
        </div>
      </div>
    </div>
    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Word Fill</h3>
        <div class="w3-container w3-center w3-margin">
            <play-button route="/begin-end/fill"></play-button>
        </div>
      </div>
    </div>
    
  </div>





  <div class="w3-row-padding" style="margin-top: 100px;">
  <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Words by definitions</h3>
        <div class="w3-container w3-center w3-margin">
         <button class="w3-button w3-border w3-win8-lime" style="color: black;">Coming Soon</button> 
         <!-- <play-button route="/word-definition"></play-button> -->
        </div>
      </div>
    </div>
    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Vowels Unclustered</h3>
        <div class="w3-container w3-center w3-margin">
            <play-button route="/vowel/unclustered"></play-button>
        </div>
      </div>
    </div>
    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Consonants Unclustered</h3>
        <div class="w3-container w3-center w3-margin">
            <play-button route="/consonant/unclustered"></play-button>
        </div>
      </div>
    </div>
    
  </div>

  
  <div class="w3-row-padding" style="margin-top: 100px;">
  <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Vowel Clusters</h3>
        <div class="w3-container w3-center w3-margin">
            <play-button route="/vowel/clusters"></play-button>
        </div>
      </div>
    </div>

    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Consonant Clusters</h3>
        <div class="w3-container w3-center w3-margin">
            <play-button route="/consonant/clusters"></play-button>
        </div>
      </div>
    </div>


    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Me Before You: Vowels</h3>
        <div class="w3-container w3-center w3-margin">
            <play-button route="/me-before-you/vowel"></play-button>
        </div>
      </div>
    </div>

  </div>
  


<div class="w3-row-padding" style="margin-top: 100px;">

<div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Me Before You: Consonants</h3>
        <div class="w3-container w3-center w3-margin">
            <play-button route="/me-before-you/consonant"></play-button>
        </div>
      </div>
    </div>


    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Begining And End: Same Letter</h3>
        <div class="w3-container w3-center w3-margin">
            <play-button route="/begining-and-end"></play-button>
        </div>
      </div>
    </div>


    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Begining And End: Consonants</h3>
        <div class="w3-container w3-center w3-margin">
            <play-button route="/begin-and-end/consonant"></play-button>
        </div>
      </div>
    </div>


</div>



<div class="w3-row-padding" style="margin-top: 100px;">

<div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Begining And End: Vowels</h3>
        <div class="w3-container w3-center w3-margin">
            <play-button route="/begin-and-end/vowel"></play-button>
        </div>
      </div>
    </div>


    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Nth Position</h3>
        <div class="w3-container w3-center w3-margin">
            <play-button route="/nth-position"></play-button>
        </div>
      </div>
    </div>

    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Random Position</h3>
        <div class="w3-container w3-center w3-margin">
            <play-button route="/random-position"></play-button>
        </div>
      </div>
    </div>

    

</div>


</div>



<!-- End page content -->
</div>

<hr style="margin-bottom: 100px;">

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-16">
  <!-- <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p> -->
</footer>

<script>
// Open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.width = "100%";
  document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}

$(document).ready(function(){
$(document).keydown(function(event) {
    if (event.keyCode == 27) {
      $("#mySidebar").hide();
    }

});
});
</script>

</body>
</html>
