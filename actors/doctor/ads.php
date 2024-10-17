<style>
section {
    margin: 20px;
}

.ad-banner {
    width: 100%;
    max-width: 77%;
    height: 300px;
    margin-left: 266px;
    border: 2px solid #ddd;
    overflow: hidden;
    position: relative;
}

.ad-banner img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: opacity 1s ease-in-out;
    position: absolute;
    top: 0;
    left: 0;
}
</style>

<div class="ad-banner">
    <img id="adImage" src="../img/esd.jpg" alt="إعلان" />
</div>

<script>
const ads = [
    "../img/esd.jpg",
    "../img/ad2.jpg",  // Update these paths as needed
    "../img/ad3.jpg"
];

let currentAdIndex = 0;

function changeAd() {
    const adImage = document.getElementById("adImage");

    // Fade out the current image
    adImage.style.opacity = 0;

    // Change the image source after the fade-out transition completes
    setTimeout(() => {
        currentAdIndex = (currentAdIndex + 1) % ads.length;
        adImage.src = ads[currentAdIndex];

        // Fade the new image back in
        adImage.style.opacity = 1;
    }, 1000); // Matches the CSS transition time
}

// Set the interval to change ads every 5 seconds
setInterval(changeAd, 5000);
</script>

