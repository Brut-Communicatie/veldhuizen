const productInfo = document.getElementById("product-info").innerHTML
console.log(productInfo)

let newStr = productInfo
newStr= newStr.replace(/€/g,  "<var>€")
newStr = newStr.replace(/=/g, "=</var>")
console.log(newStr)

document.getElementById("product-info").innerHTML = newStr
