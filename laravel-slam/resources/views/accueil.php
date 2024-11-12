

<header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <style>


.hero-image {
  background-image: url("images/BG1.webp");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  min-height: 100vh; 
  width: 100%;
  height: auto;
  position: relative;
}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: orange;
  text-shadow: 2px 2px 4px black;
  animation: color-change 19000ms infinite;
}

.hero-image {
  transition: background-image 0.5s ease-in-out;
}

@keyframes color-change {
  0% {
    color: orange;
  }
  25% {
    color: red;
  }
  50% {
    color: yellow;
  }
  75% {
    color: red;
  }
  100% {
    color: orange;
  }
}
    </style>
</header>
<body>


<div class="hero-image">
  <div class="hero-text">
    <h1 style="font-size: 5rem;">Light Casino</h1>
    <p style="font-size: 2rem;">Un Casino, mais en light</p>
    <p style="font-size: 0.5rem;">(je cherche encore un nom pour le casino)</p>
  </div>
</div>

<script>
var images = ["images/BG1.webp", "images/BG2.jpg", "images/BG1.avif", "images/bg4.jpg", "images/BGbj.jpg"];
var currentIndex = 0;

function changeBackground() {
  currentIndex = (currentIndex + 1) % images.length;
  var imageUrl = images[currentIndex];
  document.querySelector('.hero-image').style.backgroundImage = 'url(' + imageUrl + ')';
}


setInterval(changeBackground, 5000);
</script>