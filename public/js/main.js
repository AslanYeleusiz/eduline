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




//PHOME MASK JQUERY
$(".phone_mask").mask("+7 (999) 999-99-99");
$(".t_input").mask("+7 (999) 999-99-99");



var $speed_pp = 400;
// POPUP script
var $pupupBlock = $('.mail_send_pupup');
var $send_block = $('.send_block');
$('.pupup').on('click', function () {
    $pupupBlock.fadeIn($speed_pp);
});
$('.esc_icon').on('click', function () {
    $pupupBlock.fadeOut($speed_pp);
});
$(document).mouseup(function (e) {
    var div = $send_block;
    if (!div.is(e.target) && div.has(e.target).length === 0) $pupupBlock.fadeOut($speed_pp);
});

// First POPUP script in mymaterial.blade.php
var $mypupupBlock = $('#popup1');
var $mysend_block = $('.popup_body');
$('.pupup1').on('click', function () {
    $mypupupBlock.fadeIn($speed_pp);
});
$('.my_esc_icon').on('click', function () {
    $mypupupBlock.fadeOut($speed_pp);
});
$(document).mouseup(function (e) {
    var div = $mysend_block;
    if (!div.is(e.target) && div.has(e.target).length === 0) $mypupupBlock.fadeOut($speed_pp);
});


// Second POPUP script in mymaterial.blade.php
var $mypupupBlock2 = $('#popup2');
var $mysend_block2 = $('.popup_body');
$('.popup2').on('click', function () {
    $mypupupBlock2.fadeIn($speed_pp);
});
$('.my_esc_icon').on('click', function () {
    $mypupupBlock2.fadeOut($speed_pp);
});
$(document).mouseup(function (e) {
    var div = $mysend_block2;
    var div2 = $('.my_send_block');
    if (!div.is(e.target) && div.has(e.target).length === 0 && !div2.is(e.target) && div2.has(e.target).length === 0) $mypupupBlock2.fadeOut($speed_pp);
});

//hint подсказка in materialpublication
$('.question').on('click', function () {
    $('.hint').fadeIn($speed_pp);
});
$(document).mouseup(function (e) {
    var div = $('.hint');
    if (!div.is(e.target) && div.has(e.target).length === 0) div.fadeOut($speed_pp);
});

$('img.img-svg').each(function () {
    var $img = $(this);
    var imgClass = $img.attr('class');
    var imgURL = $img.attr('src');
    $.get(imgURL, function (data) {
        var $svg = $(data).find('svg');
        if (typeof imgClass !== 'undefined') {
            $svg = $svg.attr('class', imgClass + ' replaced-svg');
        }
        $svg = $svg.removeAttr('xmlns:a');
        if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
            $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
        }
        $img.replaceWith($svg);
    }, 'xml');
});
