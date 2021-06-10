const productInfo = document.getElementById("product-info").innerHTML
const regexMeerprijs = new RegExp('=</var></strong><br>', 'g')

let newStr = productInfo
newStr= newStr.replace(/€/g,  "<var>€")
newStr = newStr.replace(/=/g, "=</var>")

const index = newStr.search('<br><strong>Meerprijs voor:</strong>')
let priceStr = newStr.slice(index)
// console.log(priceStr)
newStr = newStr.replace(priceStr, "")

priceStr = priceStr.replace(/–<br>/g, "<br>- ")
priceStr = priceStr.replace(/<br><strong><var>€/g , "<strong><var>€")
priceStr = priceStr.replace(regexMeerprijs, "=</var></strong>")
document.getElementById("product-info").innerHTML = newStr + priceStr

