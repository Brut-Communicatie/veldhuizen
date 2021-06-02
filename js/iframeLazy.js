let modalOpen = false
let openID

const openIframe = (event) => {
    if (modalOpen === false) {
        document.getElementById('youtubeModal').style.display = 'block'
        
        let iframe = document.getElementById('youtubeIframe')
        // console.log(iframe)
        iframe.id = event.target.id
        iframe.src = 'https://youtube.com/embed/' + event.target.id
        openID = event.target.id
        return openID
    } else {
        console.log('Modal closed')
    }
}

const slide = () => {
    let youtubeSources = document.getElementsByClassName('youtubeThumb')
    youtubeSources = Object.values(youtubeSources) //  console.log(youtubeSources[0].src)

    let index = youtubeSources.map(e => e['id']).indexOf(openID)
    console.log(index)
}

const closeModal = () => {
    document.getElementById("youtubeModal").style.display = "none"
    let resetID = document.getElementsByTagName('iframe')
    console.log(resetID)
    resetID.id = 'youtubeIframe'
    console.log(resetID)
    modalOpen = false
    // openId = null
}