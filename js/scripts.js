jQuery(document).ready(function($) {      
    $(".slider").slick({
    arrows: true,
    autoplay: true,
    dots: true,
    infinite: true,
    slidesToShow: 1,
    adaptiveHeight: true,
    swipeToSlide: true,
    });    
});

const Palvelut = document.getElementById("Palvelut")
const palvelutContent = document.getElementById("Palvelut-content")

const Oppaita = document.getElementById("Oppaita")
const oppaitaContent = document.getElementById("Oppaita-content")

const Tietoa = document.getElementById("Tietoa")
const tietoaContent = document.getElementById("Tietoa-content")


let palvelutActive = false
let oppaitaActive = false
let tietoaContentActive = false

const handleMenuOpen = (header) => {

    if (header === "palvelut" && !palvelutActive) {
        console.log("clicked")
        palvelutContent.style.height = "350px"

        palvelutContent.classList.add("active")
        oppaitaContent.classList.remove("active")
        tietoaContent.classList.remove("active")
        oppaitaContent.style.height = "0px"
        tietoaContent.style.height = "0px"

        palvelutActive = true
        oppaitaActive = false
        tietoaContentActive = false
    } else if (header === "oppaita" && !oppaitaActive) {

        oppaitaContent.style.height = "100px"

        palvelutContent.classList.remove("active")
        oppaitaContent.classList.add("active")
        tietoaContent.classList.remove("active")
        palvelutContent.style.height = "0px"
        tietoaContent.style.height = "0px"

        palvelutActive = false
        oppaitaActive = true
        tietoaContentActive = false
    } else if (header === "tietoa" && !tietoaContentActive) {

        tietoaContent.style.height = "100px"

        palvelutContent.classList.remove("active")
        oppaitaContent.classList.remove("active")
        tietoaContent.classList.add("active")
        palvelutContent.style.height = "0px"
        oppaitaContent.style.height = "0px"

        palvelutActive = false
        oppaitaActive = false
        tietoaContentActive = true
    } else {

        palvelutContent.style.height = "0px"
        oppaitaContent.style.height = "0px"
        tietoaContent.style.height = "0px"


        palvelutContent.classList.remove("active")


        palvelutActive = false
        oppaitaActive = false
        tietoaContentActive = false
    }

}

Palvelut.addEventListener("click", (e) => {
    e.preventDefault;
    handleMenuOpen("palvelut")
})
Oppaita.addEventListener("click", (e) => {
    e.preventDefault;
    handleMenuOpen("oppaita")
})
Tietoa.addEventListener("click", (e) => {
    e.preventDefault;
    handleMenuOpen("tietoa")
})



