(function(window, $, countUp) {
    'use strict';

    var config = {
        mobileBreakPoint: 1285, /* px */
        countUpOptions: {
            useEasing: true,
            useGrouping: true,
            separator: ',',
            decimal: '.',
            prefix: '',
            suffix: ''
        }
    };

    var Ui = {
        main: $('#main'),
        sideBar: $('.side-bar'),
        sideBarToggleButton: $('#tog'),
        pageContent: $('.page-content'),
    };

    var windowWidth = $(window).width();
    var userMinimizedSideBar;

    $(function() {
        userMinimizedSideBar = Ui.main.hasClass('mobile'); // initialize from document

        animateEarnings();
        updatePageContentWidth();
    });

    $(window).on('resize', function() {

        var width = $(window).width();
        if (width != windowWidth) {
            $.event.trigger('union-window-width', [width]);
        }
    });

    $(window).on('union-window-width', function(e, width) {
        windowWidth = width;
        updatePageContentWidth();
    });

    Ui.sideBarToggleButton.on('click', function() {
        Ui.main.toggleClass('mobile');
        userMinimizedSideBar = Ui.main.hasClass('mobile');

        if (windowWidth > config.mobileBreakPoint) {
            var w = windowWidth - Ui.sideBar.width();
            Ui.pageContent.css('width', w).css('margin-left', Ui.sideBar.width());
        }
    });

    // count up animation for user earnings
    function animateEarnings() {
        new countUp('earning', 0, Number($('#earning').html()), 0, 2.5, config.countUpOptions).start();
    }

    function updatePageContentWidth() {

        var windowWidth = $(window).width();
        if (windowWidth < config.mobileBreakPoint) {
            Ui.main.addClass('mobile');
            var w = windowWidth - Ui.sideBar.width();
            Ui.pageContent.css('width', w).css('margin-left', Ui.sideBar.width());



            if (userMinimizedSideBar) {
                Ui.main.removeClass('mobile');
            }
        }
        else {
            if (!userMinimizedSideBar) {
                Ui.main.removeClass('mobile');
            }
            var w = windowWidth - Ui.sideBar.width();
            Ui.pageContent.css('width', w);
//            Ui.sideBar.css('position', 'relative');
            Ui.pageContent.css('margin-left', Ui.sideBar.width());
        }
    }

    //performance dashboard javascripts
    function pop(id) {
        $(id).css('height', '100%');
    }

    function dismiss(id) {
        $(id).css('height', 0);
    }

    window.Union = {
        pop: pop,
        dismiss: dismiss,
    };

})(window, jQuery, countUp);


function notify()
{
    $('.notification-pop').toggleClass('notify',400);
}