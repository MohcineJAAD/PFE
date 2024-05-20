// Action of accordion element
const accordingItemHeaders = document.querySelectorAll(".according-item-header");

accordingItemHeaders.forEach(accordingItemHeader => {
    accordingItemHeader.addEventListener("click", event => {
        const currentaccordingItemHeader = document.querySelector(".according-item-header.droppedOff");
        if(currentaccordingItemHeader && currentaccordingItemHeader !== accordingItemHeader)
        {
            currentaccordingItemHeader.classList.toggle("droppedOff");
            currentaccordingItemHeader.nextElementSibling.style.maxHeight = 0;
            currentaccordingItemHeader.style.color = "#000";
        }


        accordingItemHeader.classList.toggle("droppedOff");
        const accordingItemBody = accordingItemHeader.nextElementSibling;
        if(accordingItemHeader.classList.contains("droppedOff"))
        {
            accordingItemBody.style.maxHeight = accordingItemBody.scrollHeight + "px";
            accordingItemHeader.style.color = "#0075ff"
        }
        else
        {
            accordingItemBody.style.maxHeight = 0;
            accordingItemHeader.style.color = "#000"
        }
    })
});

// Action of Hamburger drop Menu
// const dropMenu = document.querySelector(".drop-menu");
// const iconMenu = document.getElementById("iconMenu");
// iconMenu.addEventListener("click" , event => {
//     dropMenu.classList.toggle("drop-menu-Active");
// })

document.addEventListener("DOMContentLoaded", function() {
    const iconMenu = document.getElementById("iconMenu");
    const dropMenu = document.getElementById("dropMenu");

    iconMenu.addEventListener("click", function() {
        dropMenu.classList.toggle("drop-menu-Active");
    });
});



// hide or show password
const showPass = document.querySelector("#eye");
const inputPass = document.querySelector("#pass");

showPass.addEventListener("click", function() {
    if (inputPass.type === "password") {
        inputPass.type = "text";
        this.src = "assets/imgs/show.png";
    } else {
        inputPass.type = "password";
        this.src = "assets/imgs/hide.png";
    }
});
