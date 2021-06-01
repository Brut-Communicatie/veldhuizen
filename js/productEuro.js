const productInfo = document.getElementById("product-info").innerHTML

let newStr = productInfo
newStr= newStr.replace(/€/g,  "<var>€")
newStr = newStr.replace(/=/g, "=</var>")

const index = newStr.search('<br><strong>Meerprijs voor:</strong>')
let priceStr = newStr.slice(index)
newStr = newStr.replace(priceStr, "")

priceStr = priceStr.replace(/–/g, "")
priceStr = priceStr.replace(/<br><strong><var>€/g , "<strong><var>€")
console.log(priceStr)
// console.log(index)
// console.log(newStr.slice(index))



document.getElementById("product-info").innerHTML = newStr + priceStr

