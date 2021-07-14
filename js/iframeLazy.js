let openID
let targetImg
let n
let firstSlide = true 
let modalOpen = false
let iframe = document.getElementById('youtubeIframe')
let youtubeSources = document.getElementsByClassName('youtubeThumb')

const openIframe = (event) => {
    if (modalOpen === false) {
        document.getElementById('youtubeModal').style.display = 'block'         
        let iframe = document.getElementById('youtubeIframe')                   
        openID = event.target.id
        iframe.id = openID                                                      
        iframe.src = 'https://youtube.com/embed/' + iframe.id                   
        
        targetImg = event.target
        targetImg.id = 'open'
        return openID, targetImg
    } else {
        console.log('Modal closed')
    }
}

const slide = (x) => {
    if ( firstSlide === true ) {
        youtubeSources = Object.values(youtubeSources)                             
        let index = youtubeSources.map(e => e['id']).indexOf(targetImg.id)

        if ((index + x) >= youtubeSources.length) {
            n = 0
            iframe.src = 'https://youtube.com/embed/' + youtubeSources[n].id
        } else if ((index + x) < 0) {
            n = (youtubeSources.length - 1)
            iframe.src = 'https://youtube.com/embed/' + youtubeSources[n].id
        } else {
            n = index + x
            iframe.src = 'https://youtube.com/embed/' + youtubeSources[n].id
        }
        iframe.id = 'youtubeIframe'
        targetImg.id = openID
        firstSlide = false
        return n, firstSlide, targetImg
    } else {
        n += x
        if ( n >= youtubeSources.length ) {
            n = 0
            iframe.src = 'https://youtube.com/embed/' + youtubeSources[n].id
        } else if (n < 0 ) {
            n = (youtubeSources.length - 1)
            iframe.src = 'https://youtube.com/embed/' + youtubeSources[n].id
        } else {
            iframe.src = 'https://youtube.com/embed/' + youtubeSources[n].id
        }
    }
}

const closeModal = () => {
    document.getElementById("youtubeModal").style.display = "none"
    console.log(openID)
    if (iframe.id === openID) {
        iframe.id = 'youtubeIframe'
    }
    firstSlide = true
    modalOpen = false
}
