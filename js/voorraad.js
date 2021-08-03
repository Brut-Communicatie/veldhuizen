const printButtons = document.getElementsByClassName("print-button-wrapper")
// console.log(printButtons)
for (let i=printButtons.length -1; i >= 0; i-- ) {
    printButtons[i].remove()
}