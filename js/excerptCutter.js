// console.log('poep')
let excerpts = document.getElementsByClassName('article-excerpt')
const winWidth = window.innerWidth
const cutExcerpt = (charAmount) => {
    for ( x = 0; x < excerpts.length; x++ ) {
        let articleText = excerpts[x].textContent
        articleText = articleText.substr(0, charAmount)
        excerpts[x].textContent = articleText + '...'
    }
}

window.onload = () => {
    if (winWidth <= 600  && winWidth > 450) {
        cutExcerpt(150)
     } else if (winWidth <= 450) {
         cutExcerpt(100)
     }
}
