let productImages = []
let modalOpen = false
let openImage
let n = -1 

const expandImage = (imgs) => {
    // get the expanded image
    const expandImg = document.getElementById("big-image")
    // use the same src in the expanded image
    expandImg.src = imgs.src
    // Show the container element (hidden with CSS)
    expandImg.parentElement.style.display = "block";
}

const openModal = (event) => {    
    if (modalOpen === false) {
        // console.log('modal is nu geopend')
        document.getElementById("myModal").style.display = "block"
        const modalImage = document.getElementById("modal-image")
        // console.log(event.target)
        modalImage.src = event.target.src
        openImage = modalImage.src
        modalOpen = true
        return openImage
    } else {
        console.log('Modal is closed')
    }
}

const nextSlide = (x) => {
    const modalImage = document.getElementById("modal-image")
    productImages = document.getElementsByClassName('gallery-pictures')
    

    // HIER ZOEKEN NAAR POSITIE VAN openImage IN productImages
    productImages = Object.values(productImages)                                // make array from HTMLCollection object
    let index = productImages.map(e => e['currentSrc']).indexOf(openImage)      // Look up index of openImage in array and store in index
    if (n == -1) {
        n = (index) + x
        console.log(n)
        modalImage.src = productImages[n].currentSrc
    } else if (n >= 0 && n <= (productImages.length - 2)) {
        n += x
        modalImage.src = productImages[n].currentSrc
    } else {
        n = 0
        modalImage.src = productImages[n].currentSrc
    }
}

const previousSlide = (x) => {
    const modalImage = document.getElementById("modal-image")
    productImages = document.getElementsByClassName('gallery-pictures')

    productImages = Object.values(productImages)                                // make array from HTMLCollection object
    let index = productImages.map(e => e['currentSrc']).indexOf(openImage)      // Look up index of openImage in array and store in index
    if (n == -1) {
        if (index + x < 0) {
            n = (productImages.length -1)
            modalImage.src = productImages[n].currentSrc
        } else {
            n = (index) + x
            modalImage.src = productImages[n].currentSrc
        }
    } else if (n >= 1 && n <= (productImages.length - 1)) {
        n += x
        modalImage.src = productImages[n].currentSrc
    } else {
        n = (productImages.length -1)
        modalImage.src = productImages[n].currentSrc

    }
}

const closeModal = () => {
    document.getElementById("myModal").style.display = "none"
    console.log("Dit is n (voor sluiten): " + n)
    n = -1
    console.log("Dit is n: " + n)
    modalOpen = false
    
}

// DEZE VIEZE FUNCTIE WOLLAH
// window.onclick = (e) => {
//     clickedImage = e.target.src
//     return clickedImage
// }

// window.onload = () => {
//     productImages = document.getElementsByClassName('gallery-pictures')
//     // console.log(productImages)

//     // const entries = Object.entries(productImages)
//     // console.log(entries)

//     const entries= Object.entries(productImages)
//     console.log(productImages[1].currentSrc)
//     console.log(entries)
  
//     // FOR OF LOOP
//     // for (const [key, value] of Object.entries(productImages)) {
//     //     console.log(`${key}:${productImages[key]}`);
//     // }

//     // FOR IN LOOP WITH HASOWNPROPERTY
//     // for (const key in productImages) {
//     //     if (productImages.hasOwnProperty(key)) {
//     //         console.log("hasOwnProperty method" + `${key}:${productImages[key]}`)
//     //     }
//     // }
//     return productImages
// }
