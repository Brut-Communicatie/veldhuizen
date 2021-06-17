let excerpts = document.getElementsByClassName('article-excerpt')
const originalExcerpts = document.getElementsByClassName('article-excerpt')
const winWidth = window.innerWidth

// if (!originalExcerpts) {
//     originalExcerpts = excerpts
// }

const cutExcerpt = (charAmount) => {
    for ( x = 0; x < excerpts.length; x++ ) {
        let articleText = excerpts[x].textContent
        articleText = articleText.substr(0, charAmount)
        articleText += '...'
        excerpts[x].textContent = articleText
    }
}

window.onload = () => {
    if (winWidth <= 600  && winWidth > 450) {
        cutExcerpt(150)
     } else if (winWidth <= 450) {
         cutExcerpt(100)
    }
}

// Even fixen dat er 1 read is voor originals
// dan kan de original weer ingezet worden als de width boven 600 komt oid
// window.onresize = () => {
//     const winWidth = window.innerWidth
//     console.log(originalExcerpts[0].textContent)
//     if (winWidth <= 600  && winWidth > 450) {
//         cutExcerpt(150)
//      } else if (winWidth <= 450) {
//          cutExcerpt(100)
//     } else {
//         console.log(originalExcerpts[0].textContent)
//     }
// }
