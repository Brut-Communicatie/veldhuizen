const wcNotification = document.getElementsByClassName('woocommerce-notices-wrapper').item(0)

let i = 1;                                  // counts amount of times to run loop, starts at value of 1
let x = 1;                                  // value of the opacity

function myLoop() {         
  setTimeout(function() {   
    x = x - 0.01 
    wcNotification.style.opacity = x;
    console.log(i)
    i++;         
    if (i < 101) { 
      myLoop();      
    }
  }, 20)
}

myLoop()