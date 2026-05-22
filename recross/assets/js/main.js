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

    // --- Generic slider (fade) -----------------------------------------------
    // Works on any [data-recross-slider] whose direct children are slides.
    document.querySelectorAll('[data-recross-slider]').forEach(function (slider) {
        var slides = slider.children;
        if (slides.length < 2) {
            return;
        }
        var idx = 0;
        // Reveal first slide explicitly (CSS keeps the rest at opacity 0).
        slides[0].classList.add('is-active');
        setInterval(function () {
            slides[idx].classList.remove('is-active');
            idx = (idx + 1) % slides.length;
            slides[idx].classList.add('is-active');
        }, 5500);
    });
}());
