window.addEventListener('load', function () {
    const filters = document.getElementsByClassName('veldhuizen__filter--item');

    function hideAndShow(elemToHide, elemToShow) {
        for (const item of elemToHide) {
            item.classList.add('veldhuizen__filter--hidden');
            setTimeout(function () {
                item.style.display = "none";
            }, 100);
        }
        for (const item of elemToShow) {
            item.classList.remove('veldhuizen__filter--hidden');
            setTimeout(function () {
                item.style.display = "flex";
            }, 100);
        }
    }
    
    if (filters) {

        const block = document.getElementsByClassName('block');
        const voor = document.getElementsByClassName('rijbewijs-be-voor-2013');
        const na = document.getElementsByClassName('rijbewijs-be-na-2013');

        for (let i = 0; i < filters.length; i++) {

            filters[i].addEventListener("click", function () {
                for (let x = 0; x < filters.length; x++) {
                    filters[x].classList.remove('veldhuizen__filter--item-selected');
                }

                this.classList.add('veldhuizen__filter--item-selected');
                if (i === 0) {
                    for (const item of block) {
                        item.classList.remove('veldhuizen__filter--hidden');
                        setTimeout(function () {
                            item.style.display = "flex";
                        }, 100);
                    }
                } else if (i === 1) {
                    hideAndShow(na, voor);
                } else if (i === 2) {
                    hideAndShow(voor, na);
                }
            });
        }
    }
});