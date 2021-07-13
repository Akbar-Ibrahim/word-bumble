<!DOCTYPE html>
<html>
<title>Word Bumble | Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="#home" class="w3-bar-item w3-button"><b>Word Bumble</b> </a>
    <!-- Float links to the right. Hide them on small screens -->
    <!-- <div class="w3-right w3-hide-small">
      <a href="#projects" class="w3-bar-item w3-button">Projects</a>
      <a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="#contact" class="w3-bar-item w3-button">Contact</a>
    </div> -->
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
  <img class="w3-image" src="/images/abcmagnet.jpg" alt="Architecture" width="1500" height="800">
  <div class="w3-display-middle w3-margin-top w3-center">
    <!-- <h1 class="w3-xxlarge w3-text-white w3-center"><span class="w3-padding w3-black w3-opacity-min"><b>Word Bumble</b></span> <span class="w3-hide-small w3-text-light-grey"></span></h1> -->
  </div>
</header>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

  <!-- Project Section -->
  <div class="w3-container w3-padding-32" id="projects">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Games</h3>
  </div>


  <div class="w3-row-padding" style="margin-bottom: 100px;">
    <div class="w3-col l6 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>The begining is the end, the end is the begining</h3>
        <div class="w3-container w3-center w3-margin">
            <button route="/last/letter" onclick="location.href=this.getAttribute('route')" class="w3-button w3-border">Play</button>
        </div>
      </div>
    </div>
    <div class="w3-col l6 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>The begining is the end, the end is the begining: Reloaded</h3>
        <div class="w3-container w3-center w3-margin">
            <button route="/begining-and-end/equal" onclick="location.href=this.getAttribute('route')" class="w3-button w3-border">Play</button>
        </div>
      </div>
    </div>
    
  </div>

  <div class="w3-row-padding">
  <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Word Length Mine Field</h3>
        <div class="w3-container w3-center w3-margin">
            <!-- <button route="/words/4" onclick="location.href=this.getAttribute('route')" class="w3-button w3-border">Play</button> -->
        </div>
      </div>
    </div>
    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Vowels Unclustered</h3>
        <div class="w3-container w3-center w3-margin">
            <button route="/vowel/unclustered" onclick="location.href=this.getAttribute('route')" class="w3-button w3-border">Play</button>
        </div>
      </div>
    </div>
    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Consonants Unclustered</h3>
        <div class="w3-container w3-center w3-margin">
            <button route="/consonant/unclustered" onclick="location.href=this.getAttribute('route')" class="w3-button w3-border">Play</button>
        </div>
      </div>
    </div>
    
  </div>

  
  <div class="w3-row-padding" style="margin-top: 100px;">
  <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Vowel Clusters</h3>
        <div class="w3-container w3-center w3-margin">
            <button route="/vowel/clusters" onclick="location.href=this.getAttribute('route')" class="w3-button w3-border">Play</button>
        </div>
      </div>
    </div>

    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Consonant Clusters</h3>
        <div class="w3-container w3-center w3-margin">
            <button route="/consonant/unclustered" onclick="location.href=this.getAttribute('route')" class="w3-button w3-border">Play</button>
        </div>
      </div>
    </div>


    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Me Before You: Vowels</h3>
        <div class="w3-container w3-center w3-margin">
            <button route="/me-before-you/vowel" onclick="location.href=this.getAttribute('route')" class="w3-button w3-border">Play</button>
        </div>
      </div>
    </div>

  </div>
  


<div class="w3-row-padding" style="margin-top: 100px;">

<div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Me Before You: Consonants</h3>
        <div class="w3-container w3-center w3-margin">
            <button route="/me-before-you/consonant" onclick="location.href=this.getAttribute('route')" class="w3-button w3-border">Play</button>
        </div>
      </div>
    </div>


    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Begining And End: Same Letter</h3>
        <div class="w3-container w3-center w3-margin">
            <button route="/begining-and-end" onclick="location.href=this.getAttribute('route')" class="w3-button w3-border">Play</button>
        </div>
      </div>
    </div>


    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Begining And End: Consonants</h3>
        <div class="w3-container w3-center w3-margin">
            <button route="/begin-and-end/consonant" onclick="location.href=this.getAttribute('route')" class="w3-button w3-border">Play</button>
        </div>
      </div>
    </div>


</div>



<div class="w3-row-padding" style="margin-top: 100px;">

<div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Begining And End: Vowels</h3>
        <div class="w3-container w3-center w3-margin">
            <button route="/begin-and-end/vowel" onclick="location.href=this.getAttribute('route')" class="w3-button w3-border">Play</button>
        </div>
      </div>
    </div>


    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-container w3-center">
        <h3>Nth Position</h3>
        <div class="w3-container w3-center w3-margin">
            <button route="/nth-position" onclick="location.href=this.getAttribute('route')" class="w3-button w3-border">Play</button>
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

</body>
</html>
