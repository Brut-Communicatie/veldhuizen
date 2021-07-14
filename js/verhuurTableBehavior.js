const tableWrapper = document.getElementById("rgprint")
const tableRows = tableWrapper.getElementsByTagName("tr")

String.prototype.nthIndexOf = function(searchElement, n, fromElement) {
    n = n || 0;
    fromElement = fromElement || 0;
    while (n > 0) {
        fromElement = this.indexOf(searchElement, fromElement);
        if (fromElement < 0) {
            return -1;
        }
        --n;
        ++fromElement;
    }
    return fromElement - 1;
};

String.prototype.replaceAt = function(index, replacement) {
    if (index >= this.length) {
        return this.valueOf();
    }
 
    return this.substring(0, index) + replacement + this.substring(index + 2);
}
// console.log(tableRows)

// for (x=0;x<tableRows.length;x++) {
//     console.log(tableRows[x].innerHTML)
// }

const entries = Object.entries(tableRows)
for (const entry of entries) {
    // console.log(entry[1].childNodes.length)
    if (entry[1].childNodes.length === 2) {

        const posTableCell = entry[1].innerHTML.nthIndexOf('td>', 3)
        const newStr = entry[1].innerHTML.replaceAt(posTableCell, 'td colspan="2"')
        console.log(newStr)
        entry[1].innerHTML = newStr

    }
}


// const map = new Map(Object.entries(tableRows))
// console.log(map)