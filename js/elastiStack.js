'use strict';
function extend( a, b ) {
    for ( var key in b ) {
        if ( b.hasOwnProperty( key ) ) {
            a[key] = b[key];
        }
    }
    return a;
}

// support
var is3d = ! ! getStyleProperty( 'perspective' ),
    support = {
        transitions: Modernizr.csstransitions
    },
// transition end event name
    transEndEventNames = {
        'WebkitTransition': 'webkitTransitionEnd', 'MozTransition': 'transitionend', 'OTransition': 'oTransitionEnd', 'msTransition': 'MSTransitionEnd', 'transition': 'transitionend'
    },
    transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
    onEndTransition = function ( el, callback ) {
        var onEndCallbackFn = function ( ev ) {
            if ( support.transitions ) {
                if ( ev.target != this )
                    return;
                this.removeEventListener( transEndEventName, onEndCallbackFn );
            }
            if ( callback && typeof callback === 'function' ) {
                callback.call( this );
            }
        };
        if ( support.transitions ) {
            el.addEventListener( transEndEventName, onEndCallbackFn );
        }
        else {
            onEndCallbackFn();
        }
    };
function ElastiStack( el, options ) {
    this.container = el;
    this.options = extend( { }, this.options );
    extend( this.options, options );
    this._init();
}

function setTransformStyle( el, tval ) {
    el.style.WebkitTransform = tval;
    el.style.msTransform = tval;
    el.style.transform = tval;
}

ElastiStack.prototype.options = {
    // distDragBack: if the user stops dragging the image in a area that does not exceed [distDragBack]px for either x or
    // y then the image goes back to the stack
    distDragBack: 200,
    // distDragMax: if the user drags the image in a area that exceeds [distDragMax]px for either x or y then the image
    // moves away from the stack
    distDragMax: 450,
    // callback
    onUpdateStack: function ( current ) {
        return false;
    }

};
ElastiStack.prototype._init = function () {
    // items
    this.items = [ ].slice.call( this.container.children );
    // total items
    this.itemsCount = this.items.length;
    // current item's index (the one on the top of the stack)
    this.current = this.current ? this.current : 0;
    // set initial styles
    this._setStackStyle();
    // return if no items or only one
    if ( this.itemsCount <= 1 )
        return;

    RunScrollStyler({
        element: '.info-about-app_block'
        //child: '.stack'
    } );

    this.onClick();
};
ElastiStack.prototype._setStackStyle = function () {
    var item1 = this._firstItem(), item2 = this._secondItem(), item3 = this._thirdItem();
    if ( item1 ) {
        item1.style.opacity = 1;
        item1.style.zIndex = 4;
        item1.style.background = 'none';
        //setTransformStyle( item1, is3d ? 'translate3d(0,0,0)' :
        //    'translate(0,0)' );
        item1.style.WebkitTransform = 'translate(0,0) scale(1)';
        item1.style.transform = 'translate(0,0) scale(1)';
    }

    $( item1 ).find( 'img' ).css( {
        opacity: 1
    } );

    if ( item2 ) {
        item2.style.opacity = 1;
        item2.style.zIndex = 3;
        item2.style.background = '';
        //setTransformStyle( item2, is3d ?
        //    'translate3d(7px, 3px, -22px)' : 'translate(7px,-22px)' );
        item2.style.WebkitTransform = 'translate(16px, 21px) scale(0.96)';
        item2.style.transform = 'translate(16px, 21px) scale(0.96)';
    }

    $( item2 ).find( 'img' ).css( {
        opacity: 0
    } );

    if ( item3 ) {
        item3.style.opacity = 1;
        item3.style.zIndex = 2;
        item3.style.background = '';
        //setTransformStyle( item3, is3d ?
        //    'translate3d(14px, -1px, -56px)' : 'translate(14px,-56px)' );
        item3.style.WebkitTransform = 'translate(30px, 38px) scale(0.93)';
        item3.style.transform = 'translate(30px, 38px) scale(0.93)';
    }

    $( item3 ).find( 'img' ).css( {
        opacity: 0
    } );

    var $li = $( '.info-about-app' ).find( '.bottom' ).find( 'ul' ).find( 'li' );
    if ( $li.length ) {
        $li.removeClass( 'active' );
        var index = $( item1 ).index();
        $( $li[index] ).addClass( 'active' );
    }

    //  $('.stack').height($(item1).find('img').height());

};
ElastiStack.prototype._reset = function () {
    // reorder stack
    this.current = this.current < this.itemsCount - 1 ?
    this.current + 1 : 0;
    // new front items
    var item1 = this._firstItem(), item2 = this._secondItem(), item3 = this._thirdItem();
    // reset transition timing function
    classie.remove( item1, 'move-back' );
    if ( item2 )
        classie.remove( item2, 'move-back' );
    if ( item3 )
        classie.remove( item3, 'move-back' );
    var self = this;
    setTimeout( function () {
        // the upcoming one will animate..
        classie.add( self._lastItem(), 'animate' );
        // reset styles
        self._setStackStyle();
    }, 25 );

    // add dragging capability
    this._initDragg();

    // init drag events on new current item
    this._initEvents();

    this.onClick();
    // callback
    this.options.onUpdateStack( this.current );
};
ElastiStack.prototype._moveAway = function ( instance ) {
    var el = instance.element;
    // disable drag
    this._disableDragg();
    // add class "animate"
    classie.add( el, 'animate' );
    // calculate how much to translate in the x and y axis
    var tVal = this._getTranslateVal( instance );
    // apply it
    setTransformStyle( el, is3d ?
    'translate3d(' + tVal.x + 'px,' + tVal.y + 'px, 0px)' :
    'translate(' + tVal.x + 'px,' + tVal.y + 'px)' );
    // item also fades out
    el.style.opacity = 0;
    // other items move back to stack
    var item2 = this._secondItem(), item3 = this._thirdItem();
    if ( item2 ) {
        classie.add( item2, 'move-back' );
        classie.add( item2, 'animate' );
        setTransformStyle( item2, is3d ? 'translate3d(0,0,-60px)' :
            'translate(0,0)' );
    }

    if ( item3 ) {
        classie.add( item3, 'move-back' );
        classie.add( item3, 'animate' );
        setTransformStyle( item3, is3d ? 'translate3d(0,0,-120px)' :
            'translate(0,0)' );
    }

    // after transition ends..
    var self = this;
    onEndTransition( el, function () {
        // reset first item
        setTransformStyle( el, is3d ? 'translate3d(0,0,-180px)' :
            'translate(0,0,0)' );
        el.style.left = el.style.top = '0px';
        el.style.zIndex = - 1;
        classie.remove( el, 'animate' );
        self._reset();
    } );
};
ElastiStack.prototype._moveBack = function ( instance ) {
    var item2 = this._secondItem(), item3 = this._thirdItem();
    classie.add( instance.element, 'move-back' );
    classie.add( instance.element, 'animate' );
    setTransformStyle( instance.element, is3d ?
        'translate3d(0,0,0)' : 'translate(0,0)' );
    instance.element.style.left = '0px';
    instance.element.style.top = '0px';
    if ( item2 ) {
        classie.add( item2, 'move-back' );
        classie.add( item2, 'animate' );
        setTransformStyle( item2, is3d ? 'translate3d(0,0,-60px)' :
            'translate(0,0)' );
    }
    if ( item3 ) {
        classie.add( item3, 'move-back' );
        classie.add( item3, 'animate' );
        setTransformStyle( item3, is3d ? 'translate3d(0,0,-120px)' :
            'translate(0,0)' );
    }
};
ElastiStack.prototype.nextItem = function ( val ) {

    if ( this.isAnimating ) {
        return false;
    }
    this.isAnimating = true;
    var item1 = this._firstItem(), item2 = this._secondItem(), item3 = this._thirdItem();
    // first item get class animate
    classie.add( item1, 'animate' );
    if ( item2 ) {
        classie.add( item2, 'animate' );
    }
    if ( item3 ) {
        classie.add( item3, 'animate' );
    }

    // now translate up and fade out (Z axis)
    setTransformStyle( item1, is3d ? val.transform :
        'translate(0,0)' );
    item1.style.opacity = 0;
    item1.style.zIndex = 5;
    var self = this;
    onEndTransition( item1, function () {
        classie.remove( item1, 'animate' );
        //classie.remove( this, 'move-back' );
        item1.style.zIndex = - 1;
        // reset first item
        setTimeout( function () {
            setTransformStyle( item1, is3d ?
                'translate3d(0,0,-180px)' : 'translate(0,0,0)' );
            self.isAnimating = false;
        }, 25 );
    } );
    // disable drag
    this._disableDragg();
    this._reset();
};
// returns true if x or y is bigger than distDragMax
ElastiStack.prototype._outOfBounds = function ( el ) {
    return Math.abs( el.position.x ) > this.options.distDragMax || Math.abs( el.position.y ) > this.options.distDragMax;
};
// returns true if x or y is bigger than distDragBack
ElastiStack.prototype._outOfSight = function ( el ) {
    return Math.abs( el.position.x ) > this.options.distDragBack || Math.abs( el.position.y ) > this.options.distDragBack;
};
ElastiStack.prototype._getTranslateVal = function ( el ) {
    var h = Math.sqrt( Math.pow( el.position.x, 2 ) + Math.pow( el.position.y, 2 ) ),
        a = Math.asin( Math.abs( el.position.y ) / h ) / (Math.PI / 180),
        hL = h + this.options.distDragBack,
        dx = Math.cos( a * (Math.PI / 180) ) * hL,
        dy = Math.sin( a * (Math.PI / 180) ) * hL,
        tx = dx - Math.abs( el.position.x ),
        ty = dy - Math.abs( el.position.y );
    return {
        x: el.position.x > 0 ? tx : tx * - 1,
        y: el.position.y > 0 ? ty : ty * - 1
    }
};
// returns the first item in the stack
ElastiStack.prototype._firstItem = function () {
    if ( this.current >= this.itemsCount )
        this.current = 0;
    return this.items[ this.current ];
};
// returns the second item in the stack
ElastiStack.prototype._secondItem = function () {
    if ( this.itemsCount >= 2 ) {
        return this.current + 1 < this.itemsCount ?
            this.items[ this.current + 1 ] :
            this.items[ Math.abs( this.itemsCount - (this.current + 1) ) ];
    }
};
// returns the third item in the stack
ElastiStack.prototype._thirdItem = function () {
    if ( this.itemsCount >= 3 ) {
        return this.current + 2 < this.itemsCount ?
            this.items[ this.current + 2 ] :
            this.items[ Math.abs( this.itemsCount - (this.current + 2) ) ];
    }
};
// returns the last item (of the first three) in the stack
ElastiStack.prototype._lastItem = function () {
    if ( this.itemsCount >= 3 ) {
        return this._thirdItem();
    }
    else {
        return this._secondItem();
    }
};

ElastiStack.prototype.onClick = function () {

    var self = this;

    $( '#elasticstack' ).find( 'li' ).on( 'click', function () {

        var index = $( this ).index() + 1;

        var item1 = self._firstItem(), item2 = self._secondItem(), item3 = self._thirdItem();

        if ( self.isAnimating ) {
            return false;
        }
        self.isAnimating = true;

        classie.add( item1, 'animate' );
        if ( item2 ) {
            classie.add( item2, 'animate' );
        }
        if ( item3 ) {
            classie.add( item3, 'animate' );
        }

        setTransformStyle( item1, is3d = 'translate(0,0)' );
        item1.style.opacity = 0;
        item1.style.zIndex = 5;

        //        self._disableDragg();

        // reorder stack
        self.current = index;
        // new front items
        item1 = self._firstItem(), item2 = self._secondItem(), item3 = self._thirdItem();

        setTimeout( function () {
            // the upcoming one will animate..
            classie.add( self._lastItem(), 'animate' );
            // reset styles
            self._setStackStyle();
            self.isAnimating = false;
        }, 25 );

        self.onClick();
        // callback
        self.options.onUpdateStack( self.current );

        RunScrollStyler({
            element: '.info-about-app_block',
            child: '.stack'
        } );

    } );

    $( '.info-about-app' ).find( '.bottom' ).find( 'li' ).find( 'a' ).unbind().on( 'click', function ( e ) {

        e.preventDefault();

        var index = $( this ).parent().index();

        var item1 = self._firstItem(), item2 = self._secondItem(), item3 = self._thirdItem();

        if ( item1 !== item2 ) {

            if ( self.isAnimating ) {
                return false;
            }
            self.isAnimating = true;

            classie.add( item1, 'animate' );
            if ( item2 ) {
                classie.add( item2, 'animate' );
            }
            if ( item3 ) {
                classie.add( item3, 'animate' );
            }

            setTransformStyle( item1, is3d = 'translate(0,0)' );
            item1.style.opacity = 0;
            item1.style.zIndex = 5;

            //        self._disableDragg();

            // reorder stack
            self.current = index;
            // new front items
            item1 = self._firstItem(), item2 = self._secondItem(), item3 = self._thirdItem();

            setTimeout( function () {
                // the upcoming one will animate..
                classie.add( self._lastItem(), 'animate' );
                // reset styles
                self._setStackStyle();
                self.isAnimating = false;
            }, 25 );

            self.onClick();

            self.options.onUpdateStack( self.current );

        }

        RunScrollStyler({
            element: '.info-about-app_block',
            child: '.stack'
        } );

    } );
};

// on Resize ElastiStack
addEvent(window, 'resize', function(){
    if ( $( window ).width() >= 767 )
        window.ElastiStack = ElastiStack;

    if ( $( '.top-left-block' ).hasClass( 'open' ) ) {

        if ( $( window ).width() > 991 ) {
            $( '.top-left-block' ).css( {
                WebkitTransform: 'rotate(0) translate(50%, -50%)',
                transform: 'rotate(0) translate(50%, -50%)'
            } );
        }
        if ( $( window ).width() <= 991 ) {
            $( '.top-left-block' ).css( {
                WebkitTransform: 'rotate(0) translate(-42%, -56%)',
                transform: 'rotate(0) translate(-42%, -56%)'
            } );
        }

    }

    if ( $( window ).width() < 767 ) {
        $( 'nav' ).removeClass( 'opacity' );
        $( '.info-about-app' ).removeClass( 'open' );
        $( '.about-app' ).removeClass( 'close' );
        $( '.open-info-about-app' ).removeClass( 'open' );
        $( '.open-info-about-app' ).css( {
            MozTransform: '',
            MsTransform: '',
            WebkitTransform: '',
            transform: ''
        } );

    }
});

function initElastiStack() {

    var elastiStack = document.querySelector( '#stack-titles' );

    if( ! elastiStack )
        return;

    var titles = [ ].slice.call( document.querySelectorAll( '#stack-titles > li' ) ),
        totalTitles = titles.length;
    var stack = new ElastiStack( document.getElementById( 'elasticstack' ), {
        onUpdateStack: function ( idx ) {
            $( titles ).removeClass( 'current' );
            $( titles[idx] ).addClass( 'current' );
        }
    } );

    var check = false;

    $( '.open-info-about-app' ).on(
        'animationend webkitAnimationEnd oAnimationEnd', function () {
            check = true;
        }
    );

    if ( ! Modernizr.cssanimations ) {
        check = true;
    }

    if ( window.ontouchstart !== undefined ) {
        check = true;
    }

    $( '.open-info-about-app' ).unbind( 'click' ).on(
        'click', function ( event ) {
            event = event || window.event;

            if($(this ).parent().hasClass('about-app'))
                check = true;

            if ( ! check )
                return;

            var self = this;
            openAbout( self );

            check = false;

        }
    );

    function openAbout( self ) {

        stack._init();
        $( 'nav' ).addClass( 'opacity' );
        var $selfParent   = $( self ).parent().find( '.main_block' );
        var $topLeftBlock = $( self ).parent().parent().find( '.top-left-block' );

        var position = $( '#elasticstack' ).offset();

        $( 'body' ).unbind();
        $( '.info-about-app' ).addClass( 'open' );

        if ( $selfParent.length )
            $selfParent.addClass( 'close' );
        else
            $( self ).parent().addClass( 'close' );

        $topLeftBlock.addClass( 'open' );

        $topLeftBlock.css(
            {
                right          : window.innerWidth - position.left - $( '#elasticstack' ).width(),
                top            : position.top,
                WebkitTransform: 'rotate(0)',
                transform      : 'rotate(0)'
            }
        );

        setTimeout(
            function () {
                $( '.info-about-app' ).find( '.stack' ).addClass( 'open' );
            }, 500
        );

        window.onresize = function () {
            position = $( '#elasticstack' ).offset();

            if ( $( window ).width() > 767 ) {
                if ( $topLeftBlock.hasClass( 'open' ) ) {
                    $topLeftBlock.css(
                        {
                            right          : window.innerWidth - position.left - $( '#elasticstack' ).width(),
                            top            : position.top,
                            WebkitTransform: 'rotate(0)',
                            transform      : 'rotate(0)'
                        }
                    );
                }
            }
            else {
                $topLeftBlock.css(
                    {
                        right          : '',
                        top            : '',
                        WebkitTransform: '',
                        transform      : ''
                    }
                );
            }

        };

        $( '.info-about-app' ).find( '.bottom .close-this' ).unbind( 'click' ).on(
            'click', function ( e ) {

                e.stopPropagation();

                position = $( '#elasticstack' ).offset();

                $topLeftBlock.css(
                    {
                        right               : window.innerWidth - position.left - $( '#elasticstack' ).width(),
                        top                 : position.top,
                        WebkitTransform     : 'rotate(0)',
                        transform           : 'rotate(0)',
                        '-webkit-transition': '-webkit-transform 0s ease',
                        transition          : 'transform 0s ease'
                    }
                );

                var src = $( stack.items[ stack.current ] ).find( 'img' ).attr( 'src' );

                $( '.top-left-block' ).find( 'img' ).attr( 'src', src );

                e.preventDefault();

                $( 'nav' ).removeClass( 'opacity' );
                $( '.info-about-app' ).removeClass( 'open' );

                $( 'body' ).keyup(
                    function ( e ) {
                        if ( e.keyCode === 37 ) {
                            PageTransitions.prevPage( 21 );
                        }
                        if ( e.keyCode === 39 ) {
                            PageTransitions.nextPage( 22 );
                        }
                    }
                );

                if ( $selfParent.length )
                    $selfParent.removeClass( 'close' );
                else
                    $( self ).parent().removeClass( 'close' );

                $topLeftBlock.removeClass( 'open' );

                setTimeout(
                    function () {
                        $topLeftBlock.css(
                            {
                                WebkitTransform     : '',
                                transform           : '',
                                transition          : '',
                                '-webkit-transition': '',
                                right               : '',
                                top                 : ''
                            }
                        );
                    }, 200
                );

                $( '.info-about-app' ).find( '.stack' ).removeClass( 'open' );

            }
        );

    }


}