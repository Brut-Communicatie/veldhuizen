const productInfo = document.getElementById("product-info").innerHTML
console.log(productInfo)

let newStr = productInfo
newStr= newStr.replace(/€/g,  "<var>€")
newStr = newStr.replace(/=/g, "=</var>")
console.log(newStr)

document.getElementById("product-info").innerHTML = newStr


// location of specific symbol/string
// const pos = productInfo.indexOf("€")
// console.log(pos)

// const pos2 = productInfo.indexOf("=") // find position of next occurence after 1st find
// console.log(pos2)

// String.prototype.replaceAt = (index, replacement) => {
//     if (index >= this.length) {
//         return this.valueOf();
//     }
 
//     return this.substring(0, index) + replacement + this.substring(index + 1);
// }

// const startStr = productInfo.slice(pos)
// const endStr = productInfo.slice(pos2 + 1)

// const isolatedStr = "<h1>" + productInfo.slice(pos, pos2+1) + "</h1>"
// console.log(isolatedStr)

// const newHTML = productInfo.replaceAt(pos, isolatedStr)
// console.log(newHTML)

// document.getElementById("product-info").innerHTML = newHTML
// document.getElementById("product-info") = newStr