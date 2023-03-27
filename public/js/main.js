(function() {
    "use strict";
    let images_1 = ['assets/img/sweets/service1.jpg', 'assets/img/sweets/service2.jpg'];
    let images_2 = ['assets/img/sweets/service1.jpg', 'assets/img/sweets/service2.jpg'];

    let index_1 = 0;
    let index_2 = 0;
    const imgElement_1 = document.querySelector('#first-changed');
    const imgElement_2 = document.querySelector('#second-changed');

    function change_1() {
        if (typeof images_1[index_1] !== 'undefined') {
            imgElement_1.src = images_1[index_1];
            index_1 > 1 ? index_1 = 0 : index_1++;
        } else {
            index_1 = 0;
        }
    }

    function change_2() {
        if (typeof images_2[index_2] !== 'undefined') {
            imgElement_2.src = images_2[index_2];
            index_2 > 1 ? index_2 = 0 : index_2++;
        } else {
            console.log("======undefinded")
            index_2 = 0;
        }
    }

    window.onload = function() {
        setInterval(change_1, 5000);
        setInterval(change_2, 3000);
    };
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.documentElement.scrollTop > 20) {
            document.getElementById("navbar").style.opacity = 0.8;
        } else {
            document.getElementById("navbar").style.opacity = 1;
        }
    }


})()