/* recross theme — main JS */
(function () {
    'use strict';

    // --- Mobile nav toggle ---------------------------------------------------
    var toggle = document.querySelector('.site-header__toggle');
    var nav    = document.getElementById('primary-nav');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var open = nav.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    }

    // --- TOP slider (auto-rotate, fade) -------------------------------------
    var slider = document.querySelector('[data-recross-slider]');
    if (slider) {
        var slides = slider.querySelectorAll('.mv__slide');
        if (slides.length > 1) {
            slides.forEach(function (slide, i) {
                slide.style.position   = i === 0 ? 'relative' : 'absolute';
                slide.style.top        = '0';
                slide.style.left       = '0';
                slide.style.width      = '100%';
                slide.style.opacity    = i === 0 ? '1' : '0';
                slide.style.transition = 'opacity .8s ease';
            });
            slider.style.position = 'relative';

            var idx = 0;
            setInterval(function () {
                slides[idx].style.opacity = '0';
                idx = (idx + 1) % slides.length;
                slides[idx].style.opacity = '1';
            }, 5000);
        }
    }
}());
