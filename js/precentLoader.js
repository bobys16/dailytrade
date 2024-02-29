/*
 * @author Mestafor
 * @name Precent Loader
 *
 */
'use strict';
// перевіряє, чи svg загрузився
// якщо загрузився, робить його видимим
(function checkSVG (){

    "use strict";

    var svg = document.querySelector( '.mondePreloader' );

    if (navigator.userAgent.search("Firefox") > -1) {

        if( ! svg )
        return;

        try {

            var svgDoc = svg.getSVGDocument();
            if ( svgDoc !== null )
                var g10 = svgDoc.getElementById( 'g10' );
            if ( g10 === null ) {
                setTimeout( checkSVG, 20 );
            }
            else {
                svg.className = svg.className.replace( ' opacity', '' );
            }
        } catch (e) {
            console.log('Problem with svg preloader ' + e);
        } finally {
            if ( svg )
                svg.className = svg.className.replace( ' opacity', '' );
        }

    } else {

        svg.addEventListener('load', function(){
            svg.className = svg.className.replace( ' opacity', '' );
        });

    }

}());

//***************** PRECENT LOADER ******************************
var docReady = false;
/**
 * namespace for preloader
 */
var LoadPrecente = function () {

    "use strict";

    /**
     * Прелоадер
     * @param options - settings
     * @param options.id  - передає id елемента
     * @param options.speed  - передає швидкість оновлення кадрів
     * @constructor
     */
    function LoadPrecent( options ) {
        this.element       = document.getElementById( options.id )
            || document.getElementById( 'loadPrecent' );
        this.speed         = options.speed || 1000;
        this.statusPrecent = 0;
        this.deg = 0;
        this.isAnimate = true;
        this.duration = 600000;
        this.stop = null;
        this.rotateStep = 0.00002;
        this.doRotate = false;
    }

    LoadPrecent.prototype = {
        constructor: LoadPrecent,
        start      : function ( ) {

            var wrapp = document.querySelector('.wrapp');

            if( ! wrapp )
                return;

            var self = this;

            var imgs = document.querySelectorAll('IMG:not([src="#"])'),
                imgLoaded = 0;


            if ( ! imgs ) {
                self.statusPrecent = 100;
                self.element.innerHTML = self.statusPrecent + '%';
            } else {

                for(var i = 0; i < imgs.length; i++) {
                    var img = new Image();
                    addEvent(img, 'load', function ( ) {
                        self.element.style.display = 'none';
                        imgLoaded ++;
                        self.statusPrecent = parseInt(imgLoaded * 100 / imgs.length, 10);
                        self.element.innerHTML = parseInt(self.statusPrecent, 10) + '%';
                        self.element.style.display = '';
                    });
                    img.src = imgs[i].src;
                }

            }

            var mondePreloader = wrapp.querySelector('.mondePreloader');
            var $defaultPreloader = $( '.default-preloader' );

            $(window).on('load', function(){
                startShow (); 
            });

            function startShow () {

                self.statusPrecent = 100;
                self.element.innerHTML = self.statusPrecent + '%';

                $defaultPreloader.addClass('opacity');

                if ( ! $( self.element ).hasClass( 'opacity' ) )
                    $( self.element ).addClass( 'opacity' );

                if( ! wrapp )
                    return;

                if ( $(wrapp).hasClass('show-preloader') ) {
                    wrapp.className += ' done';

                    self.doRotate = true;

                    $(mondePreloader).addClass('stop');

                    self.startRotate( );

                    return;
                }

                wrapp.className += ' hide-preloader';

                setTimeout(function(){
                    mondePreloader.parentNode.removeChild(mondePreloader);
                    wrapp.querySelector('.scaleDiv' ).style.display = 'none';
                }, 2000);
            }

        },
        animate    : function ( options ) {
            "use strict";
            var start = new Date( ).getTime( ),
                self  = this;

            window.requestAnimationFrame(
                function animate() {

                    // timeFraction от 0 до 1
                    var now = new Date().getTime();

                    if ( ! self.isAnimate ) {
                        self.stop = now - start;
                        return;
                    }

                    if ( self.stop ) {
                        start     = now - self.stop;
                        self.stop = null;
                    }

                    var timeFraction = ( now - start ) / options.duration;
                    if ( timeFraction > 1 ) {
                        timeFraction = 0;
                        start        = new Date().getTime();
                    }
                    // текущее состояние анимации
                    var progress = options.timing( timeFraction );
                    options.draw( );

                    setTimeout( animate, 1000 / 60 );
                }
            );
        },
        rotate     : function (  ) {
            "use strict";

            var self = this;

            var element  = self.element.parentNode,
                duration = self.duration;

            self.animate(
                {
                    duration: duration,
                    timing  : function ( timefraction ) {
                        return timefraction;
                    },
                    draw    : function (  ) {

                        self.deg += 360 * self.rotateStep;
                        if ( self.deg > 360 )
                            self.deg = 0;

                        element.style.WebkitTransform = "rotate(" + self.deg + "deg)";
                        element.style.transform       = "rotate(" + self.deg + "deg)";

                    }
                }
            );

        },
        startRotate: function (  ) {

            "use strict";
            this.isAnimate = true;

            if ( ! this.doRotate )
                return;

            this.rotate(  );
        },
        stopRotate : function () {
            "use strict";
            this.isAnimate = false;
        },
        changeSpeed: function ( speed ) {
            this.speed = speed;
        }
    };

    var obj = new LoadPrecent(
        {
            id: 'loadPrecent',
            speed: '16'
        }
    );

    obj.start();

    return obj;

};

var LoadPrecenter = LoadPrecente();