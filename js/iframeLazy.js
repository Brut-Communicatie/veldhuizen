let modalOpen = false
let openID
let targetImg
let iframe = document.getElementById('youtubeIframe')
let n = false
let youtubeSources = document.getElementsByClassName('youtubeThumb')

const openIframe = (event) => {
    if (modalOpen === false) {
        document.getElementById('youtubeModal').style.display = 'block'         // get modal element and change display
        let iframe = document.getElementById('youtubeIframe')                   // get iframe element
        openID = event.target.id
        iframe.id = openID                                                      // change the id of the iframe to the id of the img (is the youtube id)
        iframe.src = 'https://youtube.com/embed/' + iframe.id                   // change the source to base url + (youtube) id
        
        targetImg = event.target
        targetImg.id = 'open'
        return openID, targetImg
    } else {
        console.log('Modal closed')
    }
}

const slide = (x) => {
    if (!n) {
        youtubeSources = Object.values(youtubeSources)                             
        let index = youtubeSources.map(e => e['id']).indexOf(targetImg.id)
        iframe.src = 'https://youtube.com/embed/' + youtubeSources[(index + x)].id
        n = index + x
        console.log(n)
        return n
    } else {
        n += x
        console.log(n)
        iframe.src = 'https://youtube.com/embed/' + youtubeSources[n].id
    }
}

const closeModal = () => {
    document.getElementById("youtubeModal").style.display = "none"              // get the modal element and change style to none  
    let resetID = document.getElementById(openID)                               // get the iframe element to change it's id back so we can reopen it later with a new id
    resetID.id = 'youtubeIframe'
    targetImg.id = openID
    modalOpen = false
    n = false
}