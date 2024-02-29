/*
 * @author Mestafor
 * @name Scroll styler
 *
 */
'use strict';
// ******************* SCROLL-STYLER **************************
/**
 * Стилізує скролл
 * @param options []
 * @param options.element - передаємо елемент, якому потрібно стилізувати скролл
 * @constructor
 */
function RunScrollStyler( options ) {

    "use strict";

    var element = document.querySelector( options.element );

    if( ! element )
        return;

    // конструктор стилізатора
    function ScrollStyler () {
        this.element      = element; // елемент, який має скрол
        this.scrollHeight = this.element.scrollHeight; // висота скрола
        this.scrollWidth  = this.element.offsetWidth - this.element.clientWidth; // ширина скрола
    }

    // методи стилізатора
    ScrollStyler.prototype = {
        constructor : ScrollStyler,
        /**
         * ховає скрол
         */
        hideScroll  : function () {

            // якщо скрол не потрібний
            if ( this.scrollWidth <= 0 ) {
                this.scrollWidth = 0;
                this.removeScroll();
            }
            else {
                // в іншому випадку додаємо скролл
                this.addScroll();
            }

            // визначає ширину блока зі скролом
            this.element.style.marginRight = - this.scrollWidth + 'px';
        },
        /**
         * створює скрол і додає його
         */
        addScroll   : function () {

            // видаляє скрол
            this.removeScroll();

            var self   = this;
            var scroll = this.element.querySelector( '.myScroll' ); // вибирає створений скрол
            var scrolling;

            // якщо немає скрола, створює його
            if ( ! scroll ) {

                scroll           = document.createElement( 'DIV' );
                scrolling             = document.createElement( 'SPAN' );

                scroll.appendChild( scrolling );
                scroll.className = 'myScroll';
                //this.scroll.sass.right = this.scrollWidth + 'px';
                this.element.parentNode.appendChild( scroll );

            }

            // задається висота скрола
            var precentHeight      = this.element.offsetHeight / this.scrollHeight;
            var spanHeight         = this.element.offsetHeight * precentHeight;
            scrolling.style.height = spanHeight + "px";

            var scrollTop       = this.element.scrollTop / self.scrollHeight;
            scrollTop           = scrollTop * self.element.offsetHeight;
            scrolling.style.top = scrollTop + 'px';

            // при скролі зміщувати стилізований блок так само, як скролл
            addEvent(this.element,'scroll', function () {
                scrollTop       = this.scrollTop / self.scrollHeight;
                scrollTop           = scrollTop * self.element.offsetHeight;
                scrolling.style.top = scrollTop + 'px';
            });

            var startY;
            var lastY;

            var isScroll = false;

            function scrollMouseDown( ev ) {
                ev = ev || window.event;
                ev.preventDefault();
                startY = ev.clientY;
                isScroll = true;
                addEvent(self.element, 'mousemove', scrollMouseMove);
            }

            function scrollMouseMove ( e ){

                if (!isScroll)
                    return;

                e = e || window.event;
                e.preventDefault();

                if (e.which == 1) {

                    lastY = e.clientY;

                    var top =  self.element.scrollTop;
                    var precentTop = self.element.scrollTop / self.element.scrollHeight;
                    var scrollTop = precentTop * self.element.offsetHeight;

                    scrollTop += lastY - startY;
                    scrolling.style.top = scrollTop + 'px';

                    self.element.scrollTop = scrollTop / self.element.offsetHeight * self.element.scrollHeight;

                    startY = lastY;

                }
            }

            function scrollMouseUp ( e ) {
                isScroll = false;
            }

            addEvent(scrolling, 'mousedown', scrollMouseDown);
            addEvent(scrolling, 'mousemove', scrollMouseMove);
            addEvent(self.element, 'mouseup', scrollMouseUp);
            addEvent(scrolling, 'mouseup', scrollMouseUp);

        },
        /**
         * видаляє скрол
         */
        removeScroll: function () {
            var scroll = this.element.parentNode.querySelector( '.myScroll' );
            if ( scroll )
                this.element.parentNode.removeChild( scroll );
        }
    };


    // якщо підтримується тач, скролл не стилізується
    if ( window.ontouchstart !== undefined )
        return;

    try {
        // створюється обєкт
        var scroller = new ScrollStyler();

        // стилізує скролл
        scroller.hideScroll();

        var timer;
        // стилізує скролл при ресайзі

        removeEvent(window, 'resize', resize);
        addEvent( window, 'resize', resize );

        //var timer;

    } catch (e) {
        console.log('Problem with scroll styler ' + e);
    } finally {
        return;
    }

    function resize () {
        scroller.hideScroll();
        scroller = new ScrollStyler();
        scroller.hideScroll();
    }

}