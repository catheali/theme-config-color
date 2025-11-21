define(['jquery', 'domReady!'], function ($) {
    'use strict';

    return function (config) {
        var color = config.color;

        if (!color) {
            return;
        }

        function applyColor() {
            $('button.primary, button.action.primary, .button').css({
                'background-color': color,
                'border-color': color
            });
        }

        applyColor();

        $('body').on('contentUpdated', applyColor);

        var observer = new MutationObserver(function (mutations) {
            applyColor();
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    };
});
