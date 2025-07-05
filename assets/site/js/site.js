$(function () {
    const $root = $('html');
    const $themeSwitcher = $('#theme-switch');

    const Animate = function (config) {
        const min = config.min || 0;
        const max = config.max || 0;
        const elements = () =>
            [...document.querySelectorAll(config.selector)].sort(
                () => Math.random() - 0.5
            );
        const timeout = () => Math.floor(Math.random() * (max - min)) + min;
        const animations = [...config.animations].map((x) => [
            "animate__animated",
            `animate__${x}`,
            "animate__repeat-1",
        ]);
        let stack = [document.querySelector(config.selector), ...elements()];

        const element = () => {
            if (!stack.length) {
                stack = elements();
            }
            return stack.shift();
        };

        const animate = () => {
            requestAnimationFrame(() => {
                const el = element();
                el?.classList.add(...animations.sort(() => Math.random() - 0.5)[0]);
                el?.addEventListener(
                    "animationend",
                    () => {
                        el?.classList.remove(...animations.flat());
                        setTimeout(() => animate(), timeout());
                    },
                    {
                        once: true,
                    }
                );
            });
        };

        return {
            animate,
        };
    };

    $themeSwitcher.on('click', () => {
        $root.toggleClass('light dark');
        const theme = $root.attr('class');
        const $prompt = $themeSwitcher.closest('.terminal-prompt');
        document.cookie = `theme=${theme};path=/;max-age=31536000;secure;samesite=lax`;
        if ($prompt.hasClass('learn')) {
            $prompt.toggleClass('learn');
            document.cookie = `learn=1;path=/;max-age=31536000;secure;samesite=lax`;
        }
    });

    Animate({
        "selector": "section.index>div.photo-container",
        "animations": [
            "wobble",
            "rubberBand",
            "headShake",
            "tada",
            "jello",
            "swing",
            "shakeY",
            "shakeX",
            "flash",
            "bounce",
        ],
        "min": 3000,
        "max": 8000,
        "initial": "section[index] div.photo-container",
    }).animate();
    $('[data-toggle="tooltip"]').tooltip();
    $(document).on('pjax:start', () => $('.video-widget').trigger('destroy.video'));
    $(document).on('pjax:send', () => $('#loader').show() && $('body').toggleClass('blur'));
    $(document).on('pjax:end', () => $('#loader').hide() && $('body').toggleClass('blur'));
    $(document).on('readystatechange', (ev) => ev.target.readyState === "complete" && $('#loader').hide());
});
