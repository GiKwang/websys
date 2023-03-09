/*--------------------------------- Nav Bar function -------------- */
const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');

if (bar) {
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    });
}

if (close) {
    close.addEventListener('click', () => {
        nav.classList.remove('active');
    });
}


/*--------------------------------- Magic text function -------------- */
let index = 0,
        interval = 1000;

const rand = (min, max) =>
    Math.floor(Math.random() * (max - min + 1)) + min;

const animate = star => {
    star.style.setProperty("--star-left", `${rand(-10, 100)}%`);
    star.style.setProperty("--star-top", `${rand(-40, 80)}%`);

    star.style.animation = "none";
    star.offsetHeight;
    star.style.animation = "";
};

for (const star of document.getElementsByClassName("magic-star")) {
    setTimeout(() => {
        animate(star);
        setInterval(() => animate(star), 1000);
    }, index++ * (interval / 3));
}

/*--------------------------------- Slider function -------------- */
// Get the element with the ID "image-track"
const track = document.getElementById("image-track");

// Get all elements with the class "image" inside the "image-track" element
const images = track.getElementsByClassName("image");

// Count the number of images
const numImages = images.length;

// Get the width of the first image (assuming all images are the same width)
const imageWidth = images[0].offsetWidth;

// Calculate the total width of the track (number of images * image width)
const trackWidth = numImages * imageWidth;

// Calculate the total width of the slider, including the space after the last image
const totalWidth = trackWidth + 600;

// Add a "mousedown" event listener to the track element
track.addEventListener('mousedown', e => {

    // Set the "mouseDownAt" attribute of the track element to the X position of the mouse cursor
    track.dataset.mouseDownAt = e.clientX;
});

// Add a "touchstart" event listener to the track element
track.addEventListener('touchstart', e => {

    // Set the "mouseDownAt" attribute of the track element to the X position of the first touch
    track.dataset.mouseDownAt = e.touches[0].clientX;
});

// Add a "mouseup" event listener to the track element
track.addEventListener('mouseup', () => {

    // Set the "mouseDownAt" attribute of the track element to 0
    track.dataset.mouseDownAt = "0";

    // Store the previous percentage of track movement in the "prevPercentage" attribute of the track element
    track.dataset.prevPercentage = track.dataset.percentage;
});

// Add a "touchend" event listener to the track element
track.addEventListener('touchend', () => {

    // Set the "mouseDownAt" attribute of the track element to 0
    track.dataset.mouseDownAt = "0";

    // Store the previous percentage of track movement in the "prevPercentage" attribute of the track element
    track.dataset.prevPercentage = track.dataset.percentage;
});

// Add a "mousemove" event listener to the track element
track.addEventListener('mousemove', e => {

    // If the "mouseDownAt" attribute of the track element is 0, return
    if (track.dataset.mouseDownAt === "0")
        return;

    // Calculate the amount the mouse has moved since "mousedown"
    const mouseDelta = parseFloat(track.dataset.mouseDownAt) - e.clientX;

    // Set the maximum delta that the mouse can move to 1/4 of the window width
    maxDelta = window.innerWidth * 2;

    // Calculate the percentage of track movement based on the mouse movement
    const percentage = (mouseDelta / maxDelta) * -100;

    // Calculate the next percentage of track movement, constrained within the range of possible movement
    const nextPercentageUnconstrained = parseFloat(track.dataset.prevPercentage) + percentage;
    const maxPercentage = (totalWidth - window.innerWidth) / totalWidth * -100;
    const nextPercentage = Math.max(Math.min(nextPercentageUnconstrained, 0), maxPercentage);

    // Set the "percentage" attribute of the track element to the next percentage of track movement
    track.dataset.percentage = nextPercentage;

    // Animate the track element's transformation to move to the next percentage of track movement
    track.animate({
        transform: `translateX(${nextPercentage}%)`
    }, {duration: 1200, fill: "forwards"});

    // Animate the
    for (const image of images) {
        image.animate({
            objectPosition: `${100 + nextPercentage}% center`
        }, {duration: 1200, fill: "forwards"});
    }
});

track.addEventListener('touchmove', e => { // listen for touchmove events on the track element
    if (track.dataset.mouseDownAt === "0") // if mouse is not currently down, return and do nothing
        return;

    // calculate mouse movement delta and max movement allowed based on screen size
    const mouseDelta = parseFloat(track.dataset.mouseDownAt) - e.touches[0].clientX,
            maxDelta = window.innerWidth * 2;

    // calculate the next percentage of track movement based on mouse movement and max movement allowed
    const percentage = (mouseDelta / maxDelta) * -100,
            nextPercentageUnconstrained = parseFloat(track.dataset.prevPercentage) + percentage,
            maxPercentage = (totalWidth - window.innerWidth) / totalWidth * -100, // calculate max percentage based on total width
            nextPercentage = Math.max(Math.min(nextPercentageUnconstrained, 0), maxPercentage);

    track.dataset.percentage = nextPercentage; // update the percentage attribute on the track element

    // animate the track element's transformation to move to the next percentage of track movement
    track.animate({
        transform: `translate(${nextPercentage}%, -50%)`
    }, {duration: 1200, fill: "forwards"});

    // animate each image element's object position to move in the opposite direction of track movement
    for (const image of images) {
        image.animate({
            objectPosition: `${100 + nextPercentage}% center`
        }, {duration: 1200, fill: "forwards"});
    }
});

/* ========== User Form =========== */

// Get the DOM elements needed
const formWrapper = document.querySelector(".form-wrapper");
const inputs = document.querySelectorAll(".form-box input[type = 'password']");
const icons = [...document.querySelectorAll(".form-icon")];
const spans = [...document.querySelectorAll(".form-box .top span")];
const userForm = document.querySelector(".user-form");

// Add click event listeners for showing/hiding userForm and hiding navList
[".user-icon", ".user-link"].forEach((p) => {
    document.querySelector(p).onclick = () => {
        console.log("Hello, world!");
        // If the user is not logged in, show the registration form
        userForm.classList.add("show");
        navList.classList.remove("show");
    };
});


// Add click event listener for closing userForm
document.querySelector(".close-form").onclick = () => {
    userForm.classList.remove("show");
};

// Add click event listeners for toggling the color theme of the form
spans.map((span) => {
    span.addEventListener("click", (e) => {
        const color = e.target.dataset.id;
        formWrapper.classList.toggle("active");
        userForm.classList.toggle("active");
        document.querySelector(":root").style.setProperty("--custom", color);
    });
});

// Add click event listeners for toggling the visibility of password inputs
Array.from(inputs).map((input) => {
    icons.map((icon) => {
        // Set the HTML for the icon to display a "show password" icon
        icon.innerHTML = `<img src="./images/eye.svg" alt="" />`;

        // Add a click event listener for toggling the input type
        icon.addEventListener("click", () => {
            const type = input.getAttribute("type");
            if (type === "password") {
                input.setAttribute("type", "text");
                icon.innerHTML = `<img src="./images/hide.svg" alt="" />`;
            } else if (type === "text") {
                input.setAttribute("type", "password");
                icon.innerHTML = `<img src="./images/eye.svg" alt="" />`;
            }
        });
    });
});


/*=====================================this is for carousel effect function==========*/
$(document).ready(function () {
    $('.carousel').carousel();
});
