//Comment, Video scroll scripts

let eclipse = document.querySelectorAll('.com_p_ecl');
let comPageNum = 0;
var comblockwidth = document.querySelectorAll('.com_block');
let video = document.querySelectorAll('.video');
let vPlay = document.querySelectorAll('.v_play');
var select = document.querySelectorAll('#select');

if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    // код для мобильных устройств
    for (let n = 0; n < video.length; n++) {
        vPlay[n].style.display = "none";
    }

} else {
    // код для обычных устройств
    for (let n = 0; n < video.length; n++) {
        video[n].addEventListener('play', function () {
            vPlay[n].style.opacity = "0";
        })
        video[n].addEventListener('pause', function () {
            vPlay[n].style.opacity = "1";
        })
    }
}


function setActive(a) {
    for (let n = 0; n < eclipse.length; n++) {
        eclipse[n].classList.remove('active');
    }
    eclipse[a].classList.add('active');
}

$(document).ready(function () {
    const slider = $(".cst-carousel").owlCarousel({
        margin: 20,
        autoWidth: true,
        responsive: {
            0: {
                center: true
            },
            768: {
                center: false
            }
        }
    });
    const slider2 = $(".cst_com_slider").owlCarousel({
        loop: true,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayHoverPause: true,
        autoWidth: true,
        navText: [
            `<div class="left_btn"></div>`,
            `<div class="right_btn"></div>`
        ],
        responsive: {
            0: {
                center: true
            },
            768: {
                center: false
            }
        }
    });
});

(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                form.classList.add('was-validated');
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    //Свой код вставить сюда при условии что обе input заполнены(input`s in kenes.blade.php)
                }
            }, false)
        })
})();


//PHOME MASK JQUERY
$(".phone_mask").mask("+7 (999) 999-99-99");
$(".t_input").mask("+7 (999) 999-99-99");


// POPUP script
// let btnPupup=document.querySelector('.pupup');
// let pupupBlock = document.querySelector('.mail_send_pupup');
// let esc_btn = document.querySelector('.esc_btn');
// let send_block = document.querySelector('.send_block');

// btnPupup.addEventListener('click',function(){
//     pupupBlock.style.display="flex";
//     setTimeout(function(){
//         pupupBlock.style.opacity="1";
//     },150);
// });

// esc_btn.addEventListener('click',function(){
//     escapePupup();
// });
// function escapePupup(){
//     pupupBlock.style.opacity="0";
//     setTimeout(function(){
//         pupupBlock.style.display="none";
//     },400);
// }
// pupupBlock.addEventListener( 'click', (e) => {
//     const withinBoundaries = e.composedPath().includes(send_block);

//     if ( ! withinBoundaries ) {
//         escapePupup();
//     }
// });


$('img.img-svg').each(function(){
  var $img = $(this);
  var imgClass = $img.attr('class');
  var imgURL = $img.attr('src');
  $.get(imgURL, function(data) {
    var $svg = $(data).find('svg');
    if(typeof imgClass !== 'undefined') {
      $svg = $svg.attr('class', imgClass+' replaced-svg');
    }
    $svg = $svg.removeAttr('xmlns:a');
    if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
      $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
    }
    $img.replaceWith($svg);
  }, 'xml');
});
