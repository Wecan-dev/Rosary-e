wow = new WOW({
  animateClass: 'animated',
  mobile: false,
  offset: 100,
});
wow.init();


$(function () {
  'use strict'

  $('[data-toggle="offcanvas"]').on('click', function () {
    $('.offcanvas-collapse').toggleClass('open')
  })
})

// $('.dropdown-toggle').dropdown()



//invocamos al objeto (window) y a su método (scroll), solo se ejecutara si el usuario hace scroll en la página
$(window).scroll(function () {
  if ($(this).scrollTop() > 300) { //condición a cumplirse cuando el usuario aya bajado 301px a más.
    $("#js_up").slideDown(300); //se muestra el botón en 300 mili segundos
  } else { // si no
    $("#js_up").slideUp(300); //se oculta el botón en 300 mili segundos
  }
});

//creamos una función accediendo a la etiqueta i en su evento click
$("#js_up i").on('click', function (e) {
  e.preventDefault(); //evita que se ejecute el tag ancla (<a href="#">valor</a>).
  $("body,html").animate({ // aplicamos la función animate a los tags body y html
    scrollTop: 0 //al colocar el valor 0 a scrollTop me volverá a la parte inicial de la página
  }, 700); //el valor 700 indica que lo ara en 700 mili segundos
  return false; //rompe el bucle
});

// Menú fixed
$(window).scroll(function () {
  if ($(document).scrollTop() > 70 && ($(window).width() >= 768)) {
    $('.navbar-fixed-js').addClass('fixed');
    $('.navbar-fixed-js--custom').addClass('fixed--white');
    $('.navbar-fixed-js--custom .nav-item a').removeClass('fixed--link');
    $('.nav-link').addClass('fixed-color');
    $('.nav-top__header').addClass('nav-top__header--detele');
	      $('.main-brand__top').addClass('height-0')
$('.main-brand__top').removeClass('height-100')
    // $("#iso").addClass('img-size').attr('src', 'assets/img/logo-white.jpg').removeClass('scroll-up');

  } else {
    $('.main-brand__top').addClass('height-100')
$('.main-brand__top').removeClass('height-0')	  
    $('.navbar-fixed-js--custom .nav-item a').addClass('fixed--link');
    $('.navbar-fixed-js').removeClass('fixed');
    $('.navbar-fixed-js--custom').addClass('fixed--white');
    $('.nav-link').removeClass('fixed-color');
    $('.nav-top__header').removeClass('nav-top__header--detele');
    // $("#iso").removeClass('img-size').attr('src', 'assets/img/logo-fvr.jpg').removeClass('scroll-up');

  }
});






var lowerSlider = document.querySelector('#lower');
var upperSlider = document.querySelector('#upper');

document.querySelector('#two').value = upperSlider.value;
document.querySelector('#one').value = lowerSlider.value;

var lowerVal = parseInt(lowerSlider.value);
var upperVal = parseInt(upperSlider.value);

upperSlider.oninput = function () {
  lowerVal = parseInt(lowerSlider.value);
  upperVal = parseInt(upperSlider.value);

  if (upperVal < lowerVal + 4) {
    lowerSlider.value = upperVal - 4;
    if (lowerVal == lowerSlider.min) {
      upperSlider.value = 4;
    }
  }
  document.querySelector('#two').value = this.value
};

lowerSlider.oninput = function () {
  lowerVal = parseInt(lowerSlider.value);
  upperVal = parseInt(upperSlider.value);
  if (lowerVal > upperVal - 4) {
    upperSlider.value = lowerVal + 4;
    if (upperVal == upperSlider.max) {
      lowerSlider.value = parseInt(upperSlider.max) - 4;
    }
  }
  document.querySelector('#one').value = this.value
};


$('.nav-link-p').click(function () {
  $('.offcanvas-collapse').removeClass('open');
})

$(".hamburger").on("click", function () {
  $(this).toggleClass("is-active");
});
const getTime = dateTo => {
    let now = new Date(),
        time = (new Date(dateTo) - now + 1000) / 1000,
        seconds = ('0' + Math.floor(time % 60)).slice(-2),
        minutes = ('0' + Math.floor(time / 60 % 60)).slice(-2),
        hours = ('0' + Math.floor(time / 3600 % 24)).slice(-2),
        days = Math.floor(time / (3600 * 24));
 
    return {
        seconds,
        minutes,
        hours,
        days,
        time
    }
};
 
const countdown = (dateTo, element) => {
    const item = document.getElementById(element);
 
    const timerUpdate = setInterval( () => {
        let currenTime = getTime(dateTo);
        item.innerHTML = `
            <div class="row">
                <div class="col-lg-2">
                    <div class="countdown-container">
                        <div class="number">
                            ${currenTime.days}
                        </div>
                        <div class="concept">
                            Días
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="countdown-container">
                        <div class="number">
                            ${currenTime.hours}
                        </div>
                        <div class="concept">
                            Horas
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="countdown-container">
                        <div class="number">
                            ${currenTime.minutes}
                        </div>
                        <div class="concept">
                            Minutos
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="countdown-container">
                        <div class="number">
                            ${currenTime.seconds}
                        </div>
                        <div class="concept">
                            Segundos
                        </div>
                    </div>
                </div>
            </div>`;
 
        if (currenTime.time <= 1) {
            clearInterval(timerUpdate);
            alert('Fin de la cuenta '+ element);
        }
 
    }, 1000);
};