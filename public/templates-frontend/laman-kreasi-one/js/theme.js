/* =====================================
[ Javascript Plugins List ]
* Animate Text JS
* Morp Text JS
* Dzs Parallaxer JS
* Circle Progress JS
* Cubeportfolio JS
* Easing JS
* Fancybox JS
* Cloudzoom JS
* Slicknav JS
* Jquery Nav JS
* Niceselect JS
* Particles JS
* Finalcountdown JS
* CounterUp JS
* Waypoints JS
* Owl carousel JS
* Flex slider JS
* Wow JS
* Youtube Player JS
* Jquery Count JS
* Magnific Popup JS
* jquery ScrollUp JS
========================================*/ 
// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Animate Text JS //
jQuery(document).ready(function($){
	//set animation timing
	var animationDelay = 2500,
		//loading bar effect
		barAnimationDelay = 3800,
		barWaiting = barAnimationDelay - 3000, //3000 is the duration of the transition on the loading bar - set in the scss/css file
		//letters effect
		lettersDelay = 50,
		//type effect
		typeLettersDelay = 150,
		selectionDuration = 500,
		typeAnimationDelay = selectionDuration + 800,
		//clip effect 
		revealDuration = 600,
		revealAnimationDelay = 1500;
	
	initHeadline();
	

	function initHeadline() {
		//insert <i> element for each letter of a changing word
		singleLetters($('.cd-headline.letters').find('b'));
		//initialise headline animation
		animateHeadline($('.cd-headline'));
	}

	function singleLetters($words) {
		$words.each(function(){
			var word = $(this),
				letters = word.text().split(''),
				selected = word.hasClass('is-visible');
			for (i in letters) {
				if(word.parents('.rotate-2').length > 0) letters[i] = '<em>' + letters[i] + '</em>';
				letters[i] = (selected) ? '<i class="in">' + letters[i] + '</i>': '<i>' + letters[i] + '</i>';
			}
		    var newLetters = letters.join('');
		    word.html(newLetters).css('opacity', 1);
		});
	}

	function animateHeadline($headlines) {
		var duration = animationDelay;
		$headlines.each(function(){
			var headline = $(this);
			
			if(headline.hasClass('loading-bar')) {
				duration = barAnimationDelay;
				setTimeout(function(){ headline.find('.cd-words-wrapper').addClass('is-loading') }, barWaiting);
			} else if (headline.hasClass('clip')){
				var spanWrapper = headline.find('.cd-words-wrapper'),
					newWidth = spanWrapper.width() + 10
				spanWrapper.css('width', newWidth);
			} else if (!headline.hasClass('type') ) {
				//assign to .cd-words-wrapper the width of its longest word
				var words = headline.find('.cd-words-wrapper b'),
					width = 0;
				words.each(function(){
					var wordWidth = $(this).width();
				    if (wordWidth > width) width = wordWidth;
				});
				headline.find('.cd-words-wrapper').css('width', width);
			};

			//trigger animation
			setTimeout(function(){ hideWord( headline.find('.is-visible').eq(0) ) }, duration);
		});
	}

	function hideWord($word) {
		var nextWord = takeNext($word);
		
		if($word.parents('.cd-headline').hasClass('type')) {
			var parentSpan = $word.parent('.cd-words-wrapper');
			parentSpan.addClass('selected').removeClass('waiting');	
			setTimeout(function(){ 
				parentSpan.removeClass('selected'); 
				$word.removeClass('is-visible').addClass('is-hidden').children('i').removeClass('in').addClass('out');
			}, selectionDuration);
			setTimeout(function(){ showWord(nextWord, typeLettersDelay) }, typeAnimationDelay);
		
		} else if($word.parents('.cd-headline').hasClass('letters')) {
			var bool = ($word.children('i').length >= nextWord.children('i').length) ? true : false;
			hideLetter($word.find('i').eq(0), $word, bool, lettersDelay);
			showLetter(nextWord.find('i').eq(0), nextWord, bool, lettersDelay);

		}  else if($word.parents('.cd-headline').hasClass('clip')) {
			$word.parents('.cd-words-wrapper').animate({ width : '2px' }, revealDuration, function(){
				switchWord($word, nextWord);
				showWord(nextWord);
			});

		} else if ($word.parents('.cd-headline').hasClass('loading-bar')){
			$word.parents('.cd-words-wrapper').removeClass('is-loading');
			switchWord($word, nextWord);
			setTimeout(function(){ hideWord(nextWord) }, barAnimationDelay);
			setTimeout(function(){ $word.parents('.cd-words-wrapper').addClass('is-loading') }, barWaiting);

		} else {
			switchWord($word, nextWord);
			setTimeout(function(){ hideWord(nextWord) }, animationDelay);
		}
	}

	function showWord($word, $duration) {
		if($word.parents('.cd-headline').hasClass('type')) {
			showLetter($word.find('i').eq(0), $word, false, $duration);
			$word.addClass('is-visible').removeClass('is-hidden');

		}  else if($word.parents('.cd-headline').hasClass('clip')) {
			$word.parents('.cd-words-wrapper').animate({ 'width' : $word.width() + 10 }, revealDuration, function(){ 
				setTimeout(function(){ hideWord($word) }, revealAnimationDelay); 
			});
		}
	}

	function hideLetter($letter, $word, $bool, $duration) {
		$letter.removeClass('in').addClass('out');
		
		if(!$letter.is(':last-child')) {
		 	setTimeout(function(){ hideLetter($letter.next(), $word, $bool, $duration); }, $duration);  
		} else if($bool) { 
		 	setTimeout(function(){ hideWord(takeNext($word)) }, animationDelay);
		}

		if($letter.is(':last-child') && $('html').hasClass('no-csstransitions')) {
			var nextWord = takeNext($word);
			switchWord($word, nextWord);
		} 
	}

	function showLetter($letter, $word, $bool, $duration) {
		$letter.addClass('in').removeClass('out');
		
		if(!$letter.is(':last-child')) { 
			setTimeout(function(){ showLetter($letter.next(), $word, $bool, $duration); }, $duration); 
		} else { 
			if($word.parents('.cd-headline').hasClass('type')) { setTimeout(function(){ $word.parents('.cd-words-wrapper').addClass('waiting'); }, 200);}
			if(!$bool) { setTimeout(function(){ hideWord($word) }, animationDelay) }
		}
	}

	function takeNext($word) {
		return (!$word.is(':last-child')) ? $word.next() : $word.parent().children().eq(0);
	}

	function takePrev($word) {
		return (!$word.is(':first-child')) ? $word.prev() : $word.parent().children().last();
	}

	function switchWord($oldWord, $newWord) {
		$oldWord.removeClass('is-visible').addClass('is-hidden');
		$newWord.removeClass('is-hidden').addClass('is-visible');
	}
});	

/*! Morphext - v2.4.4 - 2015-05-21 */
!function(a){"use strict";function b(b,c){this.element=a(b),this.settings=a.extend({},d,c),this._defaults=d,this._init()}var c="Morphext",d={animation:"bounceIn",separator:",",speed:2e3,complete:a.noop};b.prototype={_init:function(){var b=this;this.phrases=[],this.element.addClass("morphext"),a.each(this.element.text().split(this.settings.separator),function(c,d){b.phrases.push(a.trim(d))}),this.index=-1,this.animate(),this.start()},animate:function(){this.index=++this.index%this.phrases.length,this.element[0].innerHTML='<span class="animated '+this.settings.animation+'">'+this.phrases[this.index]+"</span>",a.isFunction(this.settings.complete)&&this.settings.complete.call(this)},start:function(){var a=this;this._interval=setInterval(function(){a.animate()},this.settings.speed)},stop:function(){this._interval=clearInterval(this._interval)}},a.fn[c]=function(d){return this.each(function(){a.data(this,"plugin_"+c)||a.data(this,"plugin_"+c,new b(this,d))})}}(jQuery);


/*
 * Author: Digital Zoom Studio
 * Website: http://digitalzoomstudio.net/
 * Portfolio: http://codecanyon.net/user/ZoomIt/portfolio
 *
 * Version: 2.63
 *
 */

"use strict";

window.dzsprx_self_options = {};
window.dzsprx_index = 0;

(function($) {

    $.fn.dzsparallaxer = function(o) {

        var defaults = {
            settings_mode : 'scroll' // scroll or mouse or mouse_body or oneelement
            , mode_scroll : 'normal' // -- normal or fromtop
            , easing : 'easeIn' // -- easeIn or easeOutQuad or easeInOutSine
            , animation_duration : '20' // -- animation duration in ms
            , direction: 'normal' // -- normal or reverse
            , js_breakout: 'off' // -- if on it will try to breakout of the container and cover fullwidth
            , breakout_fix: 'off' // -- if you are using a div breakout this will add classes and tagnames back
            , is_fullscreen: 'off' // -- if this is fullscreen parallaxer, then we can just follow
            ,settings_movexaftermouse: "off" // -- if on the parallax will move after the mouse
            ,animation_engine: "js" // -- js or css
            ,init_delay: "0" // -- a delay on which to start the init function
            ,init_functional_delay: "0" // -- a delay on which to start the parallax movement
            ,settings_substract_from_th: 0 // -- if you only want to show some part of the image you can substract pixels from the total height
            ,settings_detect_out_of_screen: true // -- detect if the parallax is outside the viewable area and not animate handleframe
            ,init_functional_remove_delay_on_scroll: "off" // -- remove the delay on which to start the parallax movement
            ,settings_makeFunctional: false
            ,settings_scrollTop_is_another_element_top: null // -- an object on which the scroll is actually simulated into an elements top position

            ,settings_clip_height_is_window_height: false // -- replace the clip height to the window height
            ,settings_listen_to_object_scroll_top: null // -- replace the scroll top listening with a value from the outside
            ,settings_mode_oneelement_max_offset : '20'
            ,simple_parallaxer_convert_simple_img_to_bg_if_possible:"on"
        }

        if(typeof o =='undefined'){
            if(typeof $(this).attr('data-options')!='undefined'  && $(this).attr('data-options')!=''){
                var aux = $(this).attr('data-options');
                aux = 'window.dzsprx_self_options = ' + aux;
                eval(aux);
                o = $.extend({},window.dzsprx_self_options);
                window.dzsprx_self_options = $.extend({},{});
            }
        }


        o = $.extend(defaults, o);



        Math.easeIn = function(t, b, c, d) {

            return -c *(t/=d)*(t-2) + b;

        };

        Math.easeOutQuad = function (t, b, c, d) {
            t /= d;
            return -c * t*(t-2) + b;
        };
        Math.easeInOutSine = function (t, b, c, d) {
            return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
        };

        o.settings_mode_oneelement_max_offset = parseInt(o.settings_mode_oneelement_max_offset,10);
        var simple_parallaxer_max_offset = parseInt(o.settings_mode_oneelement_max_offset,10);

        this.each( function(){
            var cthis = $(this);
            var _theTarget = null
                ,_theTargetClone = null // -- only for horizontal
                ,_blackOverlay = null
                ,_fadeouttarget = null
            ;

            var cthis_index = window.dzsprx_index++;

            var nritems = 0
                ,tobeloaded=0
            ;
            var i =0;

            var tw = 0 // -- target width
                ,th = 0
                ,ch = 0
                ,cw = 0 // -- clip width
                ,ww = 0
                ,wh = 0
                ,nw = 0 // -- natural width
                ,nh = 0
                ,last_wh = 0 // -- compare to the last known last wh
                ,last_cthis_ot = 0 // -- compare to the last known last wh
                ,initialheight = 0
            ;

            var int_calculate_dims = 0;


            // Starting time and duration.

            // Starting Target, Begin, Finish & Change
            // --- easing params

            var duration_viy = 0
            ;

            var target_viy = 0
                ,target_vix = 0
                ,target_bo = 0
            ;

            var begin_viy = 0
                ,begin_vix = 0
                ,begin_bo = 0
            ;

            var finish_viy = 0
                ,finish_vix = 0
                ,finish_bo = 0
            ;

            var change_viy = 0
                ,change_vix = 0
                ,change_bo = 0
            ;

            var backup_duration_viy = 0
            var api_outer_update_func = null
                ,_scrollTop_is_another_element_top = null
            ;


            var st = 0 //--scroll top
                ,vi_y = 0 // -- view index y
                ,bo_o = 0 // -- black offset opacity
                ,cthis_ot  = 0 //--offset top
            ;

            var lazyloading_setsource = '';

            var started = false
                ,debug_var = false
            ;

            var animator_objects_arr = null;

            var stop_enter_frame = false
                ,sw_suspend_functional = false
                ,sw_stop_enter_frame = false
                ,destroyed = false
                ,sw_out_of_display = false

            ;

            var init_delay = 0
                ,init_functional_delay = 0
            ;

            var inter_debug_func=0
                ,inter_suspend_enter_frame = 0
                ,inter_scroll_from_resize = 0
                ,inter_recheck_dims = 0
            ;

            // -- some rresponsive scaling options

            var responsive_reference_width = 0
                ,responsive_optimal_height = 0
            ;

            var parallaxer_aftermouse_elements = [];

            var _loadTarget = null; // -- new image()
            var _loadTarget_src = '';


            init_delay = Number(o.init_delay);
            init_functional_delay = Number(o.init_functional_delay);


            if(init_delay){
                setTimeout(init, init_delay);
            }else{

                init();
            }

            function init(){


                //console.warn('init()',cthis);
                if (o.settings_makeFunctional == true) {
                    var allowed = false;

                    var url = document.URL;
                    var urlStart = url.indexOf("://") + 3;
                    var urlEnd = url.indexOf("/", urlStart);
                    var domain = url.substring(urlStart, urlEnd);
                    //console.log(domain);
                    if (domain.indexOf('l') > -1 && domain.indexOf('c') > -1 && domain.indexOf('o') > -1 && domain.indexOf('l') > -1 && domain.indexOf('a') > -1 && domain.indexOf('h') > -1) {
                        allowed = true;
                    }
                    if (domain.indexOf('d') > -1 && domain.indexOf('i') > -1 && domain.indexOf('g') > -1 && domain.indexOf('d') > -1 && domain.indexOf('z') > -1 && domain.indexOf('s') > -1) {
                        allowed = true;
                    }
                    if (domain.indexOf('o') > -1 && domain.indexOf('z') > -1 && domain.indexOf('e') > -1 && domain.indexOf('h') > -1 && domain.indexOf('t') > -1) {
                        allowed = true;
                    }
                    if (domain.indexOf('e') > -1 && domain.indexOf('v') > -1 && domain.indexOf('n') > -1 && domain.indexOf('a') > -1 && domain.indexOf('t') > -1) {
                        allowed = true;
                    }
                    if (allowed == false) {
                        return;
                    }

                }


                if(o.settings_scrollTop_is_another_element_top){
                    _scrollTop_is_another_element_top = o.settings_scrollTop_is_another_element_top;
                }



                _theTarget = cthis.find('.dzsparallaxer--target').eq(0);
                if(cthis.find('.dzsparallaxer--blackoverlay').length>0){
                    _blackOverlay = cthis.find('.dzsparallaxer--blackoverlay').eq(0);
                }
                if(cthis.find('.dzsparallaxer--fadeouttarget').length>0){
                    _fadeouttarget = cthis.find('.dzsparallaxer--fadeouttarget').eq(0);
                }
                if(cthis.find('.dzsparallaxer--aftermouse').length){
                    cthis.find('.dzsparallaxer--aftermouse').each(function(){
                        var _t = $(this);

                        parallaxer_aftermouse_elements.push(_t);
                    })
                }

                // console.info(parallaxer_aftermouse_elements);

                if(!cthis.hasClass('wait-readyall')){
                    setTimeout(function(){
                        duration_viy = Number(o.animation_duration);
                    },300);
                }

                cthis.addClass('mode-'+o.settings_mode);
                cthis.addClass('animation-engine-'+o.animation_engine);

                //console.info(cthis,_theTarget, o);


                //console.info(duration_viy);

                //console.info(cthis,_theTarget,_blackOverlay, o);


                ch = cthis.height();
                if(o.settings_movexaftermouse=='on'){
                    cw = cthis.width();
                }


                if(_theTarget){
                    th = _theTarget.height();
                    if(o.settings_movexaftermouse=='on'){
                        tw = _theTarget.width();
                    }
                }
                if(o.settings_substract_from_th){
                    th-= o.settings_substract_from_th;
                }


                //console.info(cthis,ch);


                initialheight = ch;

                if(o.breakout_fix=='2'){
                    console.info(cthis.prev());
                }

                if(cthis.attr('data-responsive-reference-width')){
                    responsive_reference_width = Number(cthis.attr('data-responsive-reference-width'));
                }
                if(cthis.attr('data-responsive-optimal-height')){
                    responsive_optimal_height = Number(cthis.attr('data-responsive-optimal-height'));
                }

                //console.log(cthis, responsive_reference_width, responsive_optimal_height);


                //console.info(is_touch_device());

                if(cthis.find('.dzsprxseparator--bigcurvedline').length){

                    cthis.find('.dzsprxseparator--bigcurvedline').each(function(){
                        var _t2 = $(this);

                        var color = "#FFFFFF";

                        if(_t2.attr('data-color')){
                            color = _t2.attr('data-color');
                        }

                        var aux = '<svg class="display-block" width="100%"  viewBox="0 0 2500 100" preserveAspectRatio="none" ><path class="color-bg" fill="'+color+'" d="M2500,100H0c0,0-24.414-1.029,0-6.411c112.872-24.882,2648.299-14.37,2522.026-76.495L2500,100z"/></svg>';


                        _t2.append(aux);

                    });

                }

                if(cthis.find('.dzsprxseparator--2triangles').length){




                    cthis.find('.dzsprxseparator--2triangles').each(function(){
                        var _t2 = $(this);

                        var color = "#FFFFFF";

                        if(_t2.attr('data-color')){
                            color = _t2.attr('data-color');
                        }

                        var aux = '<svg class="display-block" width="100%"  viewBox="0 0 1500 100" preserveAspectRatio="none" ><polygon class="color-bg" fill="'+color+'" points="1500,100 0,100 0,0 750,100 1500,0 "/></svg>';


                        _t2.append(aux);

                    });


                }

                if(cthis.find('.dzsprxseparator--triangle').length){





                    cthis.find('.dzsprxseparator--triangle').each(function(){
                        var _t2 = $(this);

                        var color = "#FFFFFF";

                        if(_t2.attr('data-color')){
                            color = _t2.attr('data-color');
                        }

                        var aux = '<svg class="display-block" width="100%"  viewBox="0 0 2200 100" preserveAspectRatio="none" ><polyline class="color-bg" fill="'+color+'" points="2200,100 0,100 0,0 2200,100 "/></svg>';


                        _t2.append(aux);

                    });



                }


                if(cthis.get(0)){
                    cthis.get(0).api_set_scrollTop_is_another_element_top = function(arg){
                        //console.info('actually!! api_set_scrollTop_is_another_element_top', arg);
                        _scrollTop_is_another_element_top = arg;
                    }
                }


                if(o.settings_mode == 'horizontal') {

                    _theTarget.wrap('<div class="dzsparallaxer--target-con"></div>');

                    if(o.animation_duration!='20'){
                        cthis.find('.horizontal-fog,.dzsparallaxer--target').css({
                            'animation':'slideshow '+(Number(o.animation_duration)/1000)+'s linear infinite'
                        })
                    }
                }
                // console.info('is_touch_device - ', is_touch_device());

                if(is_touch_device()){
                    cthis.addClass('is-touch');
                }
                if(is_mobile()){
                    cthis.addClass('is-mobile');
                }

                if(cthis.find('.divimage').length>0 || cthis.find('img').length>0){
                    var _loadTarget = cthis.children('.divimage, img').eq(0);
                    if(_loadTarget.length==0){
                        _loadTarget = cthis.find('.divimage, img').eq(0);
                    }
                    //console.info(_loadTarget.attr('data-src'));

                    if(_loadTarget.attr('data-src')){
                        lazyloading_setsource = _loadTarget.attr('data-src');
                        $(window).on('scroll.dzsprx'+cthis_index,handle_scroll);
                        handle_scroll();

                    }else{
                        init_start();
                    }
                }else{

                    init_start();
                }



                if(o.settings_mode == 'horizontal') {


                    _theTarget.before(_theTarget.clone());
                    _theTarget.prev().addClass('cloner');
                    _theTargetClone = _theTarget.parent().find('.cloner').eq(0);
                }

            }

            function init_start(){

                if(started){
                    return;
                }
                started = true;

                //console.info(is_ie, is_ie(), version_ie(), is_ie11());
                if(is_ie11()){
                    cthis.addClass('is-ie-11');
                }



                //$(window).unbind('resize',handle_resize);
                $(window).on('resize',handle_resize);
                handle_resize();

                inter_recheck_dims = setInterval(function(){
                    handle_resize(null, {
                        'call_from': 'autocheck'
                    })
                },2000);

                if(cthis.hasClass('wait-readyall')){
                    setTimeout(function(){
                        handle_scroll();
                    },700);
                }

                setTimeout(function(){
                    cthis.addClass('dzsprx-readyall');
                    handle_scroll();

                    if(cthis.hasClass('wait-readyall')) {
                        duration_viy = Number(o.animation_duration);
                    }
                },1000);

                if(cthis.find('*[data-parallaxanimation]').length>0) {
                    cthis.find('*[data-parallaxanimation]').each(function () {
                        var _t = $(this);
                        //console.info(_t);

                        if(_t.attr('data-parallaxanimation')){
                            if(animator_objects_arr==null){
                                animator_objects_arr = [];
                            }

                            animator_objects_arr.push(_t);


                            var aux = _t.attr('data-parallaxanimation');
                            aux = 'window.aux_opts2 = ' + aux;
                            aux = aux.replace(/'/g, '"')
                            // console.info(aux);
                            try {
                                eval(aux);
                            }
                            catch(err) {
                                console.info(aux, err);
                                window.aux_opts2=null;
                            }
                            //console.info(aux_opts2);

                            if(window.aux_opts2){
                                for(i=0;i<window.aux_opts2.length;i++){
                                    if(isNaN(Number(window.aux_opts2[i].initial))==false){
                                        window.aux_opts2[i].initial = Number(window.aux_opts2[i].initial);
                                    }
                                    if(isNaN(Number(window.aux_opts2[i].mid))==false){
                                        window.aux_opts2[i].mid = Number(window.aux_opts2[i].mid);
                                    }
                                    if(isNaN(Number(window.aux_opts2[i].final))==false){
                                        window.aux_opts2[i].final = Number(window.aux_opts2[i].final);
                                    }
                                }
                                _t.data('parallax_options', window.aux_opts2);
                                //console.info(_t, _t.data('parallax_options'));
                            }

                        }

                    });
                }

                //console.info(animator_objects_arr);

                if(init_functional_delay){
                    sw_suspend_functional = true;
                    //console.info('CEVA');

                    setTimeout(function(){
                        sw_suspend_functional = false;
                    },init_functional_delay)
                }


                if(!cthis.hasClass('simple-parallax')){
                    handle_frame();
                }else{
                    _theTarget.wrap('<div class="simple-parallax-inner"></div>');


                    if(o.simple_parallaxer_convert_simple_img_to_bg_if_possible=='on' && _theTarget.attr('data-src') && _theTarget.children().length==0){
                        _theTarget.parent().addClass('is-image');
                    }



                    if(simple_parallaxer_max_offset>0){
                        handle_frame();
                    }
                }

                inter_debug_func = setInterval(debug_func, 1000);


                setTimeout(function(){
                    //finish.y = -300;
                }, 1500);


                if(cthis.hasClass('use-loading')){
                    if(cthis.find('.divimage').length>0 || cthis.children('img').length>0){
                        if(cthis.find('.divimage').length>0){
                            if(lazyloading_setsource){
                                cthis.find('.divimage').eq(0).css('background-image','url('+lazyloading_setsource+')');
                                cthis.find('.dzsparallaxer--target-con .divimage').css('background-image','url('+lazyloading_setsource+')');
                            }
                            _loadTarget_src = (String(cthis.find('.divimage').eq(0).css('background-image')).split('"'))[1];
                            if(_loadTarget_src == undefined){
                                _loadTarget_src = (String(cthis.find('.divimage').eq(0).css('background-image')).split('url('))[1];
                                _loadTarget_src = (String(_loadTarget_src).split(')'))[0];
                            }
                            _loadTarget = new Image();

                            //console.info(cthis.find('.divimage').eq(0).css('background-image'), _loadTarget_src);

                            _loadTarget.onload = function(e){
                                init_loaded();
                            };





                            //console.info('_loadTarget_src - ',_loadTarget_src);
                            _loadTarget.src = _loadTarget_src;

                        }
                    }else{

                        cthis.addClass('loaded');
                    }

                    setTimeout(function(){
                        cthis.addClass('loaded');
                        calculate_dims();
                    }, 10000)
                }

                //console.info(_theTarget);





                cthis.get(0).api_set_update_func = function(arg){
                    api_outer_update_func = arg;
                }
                cthis.get(0).api_handle_scroll = handle_scroll;
                cthis.get(0).api_destroy = destroy;
                cthis.get(0).api_destroy_listeners = destroy_listeners;
                cthis.get(0).api_handle_resize = handle_resize;


                if(o.settings_mode == 'scroll' || o.settings_mode=='oneelement'){
                    $(window).off('scroll.dzsprx'+cthis_index);
                    $(window).on('scroll.dzsprx'+cthis_index,handle_scroll);
                    handle_scroll();
                    setTimeout(handle_scroll,1000);

                    if(document && document.addEventListener){

                        document.addEventListener("touchmove", handle_mousemove, false);
                    }


                }

                if(o.settings_mode == 'mouse_body' || o.settings_movexaftermouse=='on' || parallaxer_aftermouse_elements.length){
                    $(document).on('mousemove', handle_mousemove);
                }
            }

            function init_loaded(){

                cthis.addClass('loaded');



                if(o.settings_mode == 'horizontal'){


                    console.info(_loadTarget, _loadTarget_src, _loadTarget.naturalWidth, cw, tw);

                    nw = _loadTarget.naturalWidth;
                    nh = _loadTarget.naturalHeight;
                    tw = nw/nh * ch;

                    console.log(nw,nh,tw, ch);
                    if(_theTarget.hasClass('divimage')){

                    }



                    console.info(_theTargetClone);
                    _theTargetClone.css({

                        'left':'calc(-100% + 1px)'
                        //'left':'-100%',
                    })
                    _theTarget.css({
                        'width':'100%'
                    })

                    if(_theTarget.hasClass('repeat-pattern')){

                        console.info('nw - ',nw, 'cw - ',cw);

                        tw = Math.ceil(cw / nw ) * nw;
                        console.info('tw - ',tw);

                    }


                    cthis.find('.dzsparallaxer--target-con').css({
                        'width':tw
                    })
                    //_theTargetClone.animate({
                    //    'left':'0'
                    //},{
                    //    queue:false
                    //    ,duration: Number(o.animation_duration)
                    //    ,easing: 'linear'
                    //    ,complete:function(e,ui){
                    //    }
                    //})
                    //_theTarget.animate({
                    //    'left':tw
                    //},{
                    //    queue:false
                    //    ,duration: Number(o.animation_duration)
                    //    ,easing: 'linear'
                    //    ,complete:function(e,ui){
                    //        var _t = $(this);
                    //    }
                    //})
                }
            }

            function destroy(){
                api_outer_update_func = null;
                stop_enter_frame = true;
                api_outer_update_func = null;
                destroyed = true;
                $(window).off('scroll.dzsprx'+cthis_index,handle_scroll);
                if(document && document.addEventListener){

                    document.removeEventListener("touchmove", handle_mousemove, false);
                }
            }
            function debug_func(){
                //console.info(debug_var);
                debug_var = true;
            }
            function destroy_listeners(){

                console.info('DESTROY LISTENERS', cthis);
                destroyed = true;

                clearInterval(inter_debug_func);
                $(window).off('scroll.dzsprx'+cthis_index);
                sw_stop_enter_frame = true;
            }

            function handle_resize(e, pargs){
                cw=cthis.width();
                ww = window.innerWidth;
                wh = window.innerHeight;

                var margs = {
                    'call_from': 'event'
                };

                if(pargs){
                    margs = $.extend(margs,pargs);
                }


                if(started===false){
                    return;
                }


                if(o.settings_mode=='oneelement'){
                    var last_translate = cthis.css('transform');
                    cthis.css('transform','translate3d(0,0,0)');
                }


                cthis_ot = parseInt(cthis.offset().top,10);


                if(margs.call_from=='autocheck'){
                    if(Math.abs(last_wh-wh)<4 && Math.abs(last_cthis_ot-cthis_ot)<4){
                        if(o.settings_mode=='oneelement') {
                            cthis.css('transform', last_translate);
                        }
                        return false;
                    }
                }
                // console.warn('handle_resize', last_wh, wh, st, last_cthis_ot, cthis_ot, margs);
                last_wh = wh;
                last_cthis_ot = cthis_ot;




                // console.info(cthis_ot, cthis);

                // console.warn('responsive_reference_width - ', responsive_reference_width, 'responsive_optimal_height - ',responsive_optimal_height, 'cw - ',cw);

                if(responsive_reference_width && responsive_optimal_height){
                    if(cw<responsive_reference_width){
                        var aux = cw/responsive_reference_width*responsive_optimal_height;
                        // console.log('aux  ( calculate optimal ) - ',aux);

                        cthis.height(aux);
                    }else{

                        cthis.height(responsive_optimal_height);
                    }
                }

                if(cw<760){
                    cthis.addClass('under-760')
                }else{

                    cthis.removeClass('under-760')
                }
                if(cw<500){
                    cthis.addClass('under-500')
                }else{

                    cthis.removeClass('under-500')
                }

                if(int_calculate_dims){
                    clearTimeout(int_calculate_dims);
                }

                int_calculate_dims = setTimeout(calculate_dims,700);


                if(o.js_breakout=='on'){
                    cthis.css('width',ww+'px');

                    cthis.css('margin-left','0');

                    //console.info(cthis, cthis.get(0).offsetLeft, cthis.offset().left, _theTarget.offset().left)

                    if(cthis.offset().left>0){
                        cthis.css('margin-left','-'+cthis.offset().left+'px');
                    }
                }

                if(o.is_fullscreen=='on'){
                    //console.log(_theTarget,_theTarget.height(), target_viy, ch, th, wh);

                    // -- trying to fix damage ..
                    //if(th + target_viy < wh){
                    //    target_viy = wh-th;
                    //    vi_y = wh-th;
                    //    //console.info('WHAT HERE', duration_viy, vi_y);
                    //    if(duration_viy>0){
                    //
                    //        backup_duration_viy = duration_viy;
                    //    }
                    //    duration_viy = 0;
                    //    //console.log('yesyes', _theTarget,th, target_viy, ch, th, wh);
                    //    handle_scroll(null, {force_vi_y : vi_y});
                    //    setTimeout(function(){
                    //        //console.info('WHAT', backup_duration_viy);
                    //        duration_viy = backup_duration_viy;
                    //    },50)
                    //    //console.info(target_viy, th-_theTarget.height())
                    //}
                }
            }

            function calculate_dims(){

                //console.info(_theTarget);
                ch = cthis.outerHeight();
                th = _theTarget.outerHeight();
                wh = window.innerHeight;

                if(o.settings_substract_from_th){
                    th-= o.settings_substract_from_th;
                }

                if(o.settings_clip_height_is_window_height){
                    ch = window.innerHeight;
                }




                //return;

                //console.info(initialheight);
                if(cthis.hasClass('allbody')==false && cthis.hasClass('dzsparallaxer---window-height')==false && responsive_reference_width==0){

                    // console.info("hier");
                    if(th<=initialheight && th > 0){
                        if(o.settings_mode!='oneelement' && cthis.hasClass('do-not-set-js-height')==false && cthis.hasClass('height-is-based-on-content')==false) {
                            cthis.height(th);
                        }
                        ch = cthis.height();
                        //_theTarget.css('top',0);



                        if(is_ie()&&version_ie()<=10){

                            _theTarget.css('top','0');
                        }else{

                            // _theTarget.css('transform','translate3d(0,'+0+'px,0)');
                            _theTarget.css('transform','');
                        }

                        if(_blackOverlay){
                            _blackOverlay.css('opacity','0');
                        }
                    }else{

                        //console.log(cthis, 'why do we do this ? ');

                        // console.info(cthis.hasClass('do-not-set-js-height'));
                        if(o.settings_mode!='oneelement' && cthis.hasClass('do-not-set-js-height')==false && cthis.hasClass('height-is-based-on-content')==false){

                            // cthis.height(initialheight);
                        }

                    }
                }
                if(_theTarget.attr('data-forcewidth_ratio')){
                    _theTarget.width(Number(_theTarget.attr('data-forcewidth_ratio')) * _theTarget.height());
                    if(_theTarget.width()<cthis.width()){
                        _theTarget.width(cthis.width());
                    }
                }

                clearTimeout(inter_scroll_from_resize);
                inter_scroll_from_resize = setTimeout(handle_scroll,200);
                // setTimeout(function(){
                //
                // }, 300);

            }

            //console.info(th, ch);

            function handle_mousemove(e){



                // console.info(e, o.settings_movexaftermouse);


                if(o.settings_mode == 'mouse_body' ){
                    st = e.pageY - $(window).scrollTop();

                    var vi_y = 0;

                    if(th==0){
                        return;
                    }

                    vi_y = st/wh  * (ch-th);

                    bo_o = st/ch;

                    //console.info(ch,th,vi_y);

                    if(vi_y > 0){ vi_y = 0 };
                    if(vi_y < ch-th){ vi_y = ch-th };
                    if(bo_o > 1){ bo_o = 1 };
                    if(bo_o < 0){ bo_o = 0 };

                    finish_viy = vi_y;


                    //console.info('finish_viy - ',finish_viy,ch,th, vi_y);
                    //_theTarget.css('transform','translate3d(0,'+vi_y+'px,0)');
                }


                if( o.settings_movexaftermouse=='on'){
                    var mx = e.pageX;


                    var vi_x = 0;


                    vi_x = (mx/ww) * (cw-tw);


                    if(vi_x > 0){ vi_x = 0 };
                    if(vi_x < cw-tw){ vi_x = cw-tw };

                    // console.info(vi_x);


                    finish_vix = vi_x;


                    //console.info(mx, ww, cw, tw, vi_x);

                }

                if(parallaxer_aftermouse_elements){

                    var mx = e.pageX;
                    var my = e.clientY;


                    vi_x = ((mx/ww) * simple_parallaxer_max_offset * 2) - simple_parallaxer_max_offset;
                    vi_y = ((my/wh) * simple_parallaxer_max_offset * 4) - simple_parallaxer_max_offset * 2;

                    // console.info(vi_x);

                    // console.info(my, wh, vi_y);

                    if(vi_x > simple_parallaxer_max_offset){ vi_x = simple_parallaxer_max_offset };
                    if(vi_x < -simple_parallaxer_max_offset){ vi_x = -simple_parallaxer_max_offset };

                    if(vi_y > simple_parallaxer_max_offset){ vi_y = simple_parallaxer_max_offset };
                    if(vi_y < -simple_parallaxer_max_offset){ vi_y = -simple_parallaxer_max_offset };

                    // console.info(parallaxer_aftermouse_elements);
                    for(var i3=0;i3<parallaxer_aftermouse_elements.length;i3++){
                        var _c = parallaxer_aftermouse_elements[i3];

                        // console.info(_c);
                        _c.css({
                            'top': vi_y
                            ,'left':vi_x
                        },{
                            queue:false
                            ,duration: 100
                        })
                    }

                }

            }

            function handle_scroll(e, pargs){
                //console.info('handle_scroll', cthis, e, $(window).scrollTop());
                st = $(window).scrollTop();
                vi_y = 0;




                // console.info(st,cthis_ot-cthis.outerHeight(), st, cthis_ot+cthis.outerHeight() );


                //|| o.mode_scroll=='fromtop'
                if( (cthis_ot > st-wh && st<cthis_ot+cthis.outerHeight()) ){


                    sw_out_of_display = false;
                    sw_suspend_functional = false;
                }else{





                    if(o.settings_detect_out_of_screen){
                        sw_out_of_display = true;
                        sw_suspend_functional = true;
                    }
                }


                if(_scrollTop_is_another_element_top){
                    st = -parseInt(_scrollTop_is_another_element_top.css('top'),10);
                    //console.info('handle_scroll', cthis, e, _scrollTop_is_another_element_top, _scrollTop_is_another_element_top.css('top'), st);
                    if(_scrollTop_is_another_element_top.data('targettop')){
                        st = -_scrollTop_is_another_element_top.data('targettop');
                    }

                }

                //console.info('scroll top is - ',st, o.settings_listen_to_object_scroll_top, _scrollTop_is_another_element_top.css('top'),'target top->',_scrollTop_is_another_element_top.data('targettop'));


                if(o.settings_listen_to_object_scroll_top){
                    st = o.settings_listen_to_object_scroll_top.val;
                }


                if(isNaN(st)){
                    st = 0;
                }

                if(e){
                    if(o.init_functional_remove_delay_on_scroll=='on'){
                        //console.info("REMOVE SUSPEND FUNCTIONAL !!! ", cthis, sw_suspend_functional, e);
                        sw_suspend_functional = false;
                    }
                }



                var margs = {
                    force_vi_y: null
                    ,from: ''
                    ,force_ch: null
                    ,force_th: null
                    ,force_th_only_big_diff: true
                };



                if(pargs){
                    margs = $.extend(margs,pargs);
                }


                if(o.settings_clip_height_is_window_height){
                    ch = window.innerHeight;
                }

                //console.info('ch pre force_ch',ch);
                if(margs.force_ch!=null){
                    ch = margs.force_ch;
                }
                if(margs.force_th!=null){

                    if(margs.force_th_only_big_diff){
                        // console.warn('forced th diff - ',Math.abs(margs.force_th - th));

                        if(Math.abs(margs.force_th - th)>20){
                            th = margs.force_th;
                        }
                    }else{

                        th = margs.force_th;
                    }

                    // console.warn('forced th - ',th);
                }

                //console.info('ch post force_ch',ch);


                //console.info(margs);


                if(started===false){
                    wh = window.innerHeight;
                    if((st+wh)>=cthis.offset().top){
                        init_start();
                    }
                }

                //console.info(th);


                if(th==0){
                    return;
                }


                //console.warn(st+wh, cthis_ot, started)
                if(started===false || (o.settings_mode!='scroll' && o.settings_mode!='oneelement') ){
                    return;
                }
                //console.warn(st+wh, cthis_ot, 'what')

                if(o.settings_mode=='oneelement'){


                    var aux_r = (st-cthis_ot+wh) / wh;

                    if(cthis.attr('id')=='debug') {
                        // console.info((st-cthis_ot+wh), st,cthis_ot, wh, aux_r);
                    }

                    if(aux_r<0){
                        aux_r = 0;
                    }
                    if(aux_r>1){
                        aux_r = 1;
                    }


                    if (o.direction == 'reverse') {
                        aux_r = Math.abs(1-aux_r);
                    }

                    vi_y = (aux_r * ( o.settings_mode_oneelement_max_offset*2) ) - o.settings_mode_oneelement_max_offset ;

                    finish_viy = vi_y;
                    //console.warn(st+wh, cthis_ot, aux_r)


                    if(cthis.attr('id')=='debug'){

                        // console.info(vi_y);
                    }

                }


                if(o.settings_mode=='scroll') {








                    if (o.mode_scroll == 'fromtop') {
                        vi_y = ((st / ch)) * (ch - th);

                        if (o.is_fullscreen == 'on') {

                            vi_y = st / (th - wh) * (ch - th);


                            if (_scrollTop_is_another_element_top) {


                                vi_y = st / (_scrollTop_is_another_element_top.height() - wh) * (ch - th);

                            }
                        }

                        if (o.direction == 'reverse') {
                            vi_y = (1 - (st / ch)) * (ch - th);
                            //console.info(st,th)


                            if (o.is_fullscreen == 'on') {

                                vi_y = (1 - (st / (th - wh)) ) * (ch - th);


                                //console.info(_scrollTop_is_another_element_top);
                                if (_scrollTop_is_another_element_top) {


                                    vi_y = (1 - (st / (_scrollTop_is_another_element_top.height() - wh)) ) * (ch - th);

                                    //console.log(st,_scrollTop_is_another_element_top.height(),wh,ch,th, vi_y);
                                    //vi_y = st / ( - wh)  * (ch-th);

                                }
                            }
                        }


                    }


                    cthis_ot = cthis.offset().top;


                    if (_scrollTop_is_another_element_top) {
                        cthis_ot = -parseInt(_scrollTop_is_another_element_top.css('top'), 10);
                    }

                    // console.log(st, cthis_ot, wh, ch);
                    var auxer5 = (st - (cthis_ot - wh)) / ((cthis_ot + ch) - (cthis_ot - wh));


                    //console.info('is fullscreen ?? - ', o.is_fullscreen);
                    if (o.is_fullscreen == 'on') {



                        //console.info('scrolltop - ',st);

                        auxer5 = st / ($('body').height() - wh);

                        //console.info($('body').height(), wh);

                        if (_scrollTop_is_another_element_top) {


                            auxer5 = st / (_scrollTop_is_another_element_top.outerHeight() - wh);

                            //cthis_ot = -parseInt(_scrollTop_is_another_element_top.css('top'),10);
                        }
                    }

                    // console.info('st and auxer5 - ',st, auxer5, vi_y, o.settings_listen_to_object_scroll_top);
                    if (auxer5 > 1) {
                        auxer5 = 1;
                    }
                    if (auxer5 < 0) {
                        auxer5 = 0;
                    }
                    // console.info('st and auxer5 - ',st, auxer5, vi_y, o.settings_listen_to_object_scroll_top);

                    if (animator_objects_arr) {

                        // console.info(animator_objects_arr);
                        for (i = 0; i < animator_objects_arr.length; i++) {

                            var _c = animator_objects_arr[i];
                            var cdata = _c.data('parallax_options');


                            //console.info(cdata);
                            if (cdata) {
                                for (var j = 0; j < cdata.length; j++) {

                                    if (auxer5 <= 0.5) {
                                        var auxer5_doubled = auxer5 * 2;
                                        var auxer5_doubled_inverse = (auxer5 * 2) - 1;
                                        if (auxer5_doubled_inverse < 0) {
                                            auxer5_doubled_inverse = -auxer5_doubled_inverse;
                                        }

                                        //var auxval = cdata[j].initial + (auxer5*2) * cdata[j].mid;
                                        //if(cdata[j].initial > cdata[j].mid){
                                        //    auxval = (auxer5*2) * cdata[j].mid - cdata[j].initial;
                                        //}

                                        var auxval = auxer5_doubled_inverse * cdata[j].initial + auxer5_doubled * cdata[j].mid;
                                        var cval = cdata[j].value;

                                        cval = cval.replace(/{{val}}/g, auxval);
                                        //console.log(cval);
                                        //console.info(cdata[j].property, auxval);
                                        _c.css(cdata[j].property, cval);
                                    } else {

                                        var auxer5_doubled = (auxer5 - 0.5) * 2;
                                        var auxer5_doubled_inverse = auxer5_doubled - 1;
                                        if (auxer5_doubled_inverse < 0) {
                                            auxer5_doubled_inverse = -auxer5_doubled_inverse;
                                        }

                                        //var auxval = cdata[j].initial + (auxer5*2) * cdata[j].mid;
                                        //if(cdata[j].initial > cdata[j].mid){
                                        //    auxval = (auxer5*2) * cdata[j].mid - cdata[j].initial;
                                        //}

                                        var auxval = auxer5_doubled_inverse * cdata[j].mid + auxer5_doubled * cdata[j].final;

                                        //console.info(auxval,auxer5_doubled_inverse,auxer5_doubled)
                                        var cval = cdata[j].value;
                                        cval = cval.replace(/{{val}}/g, auxval);
                                        _c.css(cdata[j].property, cval);
                                    }
                                }

                            }


                            //console.info(animator_objects_arr[i],);
                        }
                    }

                    //console.info(auxer5, ch,th);

                    //console.info('pre calculate vi_y', auxer5, ch, th);
                    if (o.mode_scroll == 'normal') {


                        vi_y = auxer5 * (ch - th);
                        //consoel.info(auxer5, vi_y);

                        if (o.direction == 'reverse') {

                            vi_y = (1 - (auxer5)) * (ch - th);
                        }

                        // console.info(vi_y, 'auxer5 - ', auxer5, ch, th, cthis_ot, cthis.attr('class'));

                        if (cthis.hasClass('debug-target')) {
                            console.info(o.mode_scroll, st, cthis_ot, wh, ch, (cthis_ot + ch), auxer5);
                        }


                    }
                    if (o.mode_scroll == 'fromtop') {



                        if (vi_y < ch - th) {
                            vi_y = ch - th
                        }

                        // console.info(ch,th);

                    }


                    // console.info('vi_y - ',vi_y);

                    if(cthis.hasClass('simple-parallax')){
                        aux_r = (st+wh-cthis_ot) / (wh+th);


                        // console.info('scroll top - ',st);
                        // console.info('window height - ',wh);
                        // console.info('cthis offset top - ',cthis_ot);
                        // console.info('total height - ',th);

                        if(aux_r<0){
                            aux_r = 0;
                        }
                        if(aux_r>1){
                            aux_r = 1;
                        }

                        aux_r = Math.abs(1-aux_r);


                        // console.info(aux_r);

                        if(cthis.hasClass('is-mobile')){
                            simple_parallaxer_max_offset = cthis.height()/2;
                        }

                        vi_y = (aux_r * ( simple_parallaxer_max_offset*2) ) - simple_parallaxer_max_offset ;

                        // console.warn(aux_r, vi_y);
                    }

                    //console.info('calculate vi_y', vi_y);

                    if (_fadeouttarget) {

                        var auxer4 = Math.abs(((st - cthis_ot) / cthis.outerHeight()) - 1);
                        if (auxer4 > 1) {
                            auxer4 = 1;
                        }
                        if (auxer4 < 0) {
                            auxer4 = 0;
                        }


                        _fadeouttarget.css('opacity', auxer4);
                    }


                    bo_o = st / ch;
                    // console.info('crds - ',st, vi_y,ch,th);


                    if(cthis.hasClass('simple-parallax')==false){
                        if (vi_y > 0) {
                            vi_y = 0
                        }
                        ;
                        if (vi_y < ch - th) {
                            vi_y = ch - th
                        }
                        ;

                        // console.info(vi_y);
                    }

                    if (bo_o > 1) {
                        bo_o = 1
                    }
                    ;
                    if (bo_o < 0) {
                        bo_o = 0
                    }
                    ;

                    //console.log(vi_y);


                    if (margs.force_vi_y) {
                        vi_y = margs.force_vi_y;
                    }

                    finish_viy = vi_y;
                    finish_bo = bo_o;


                    // console.info(finish_viy);

                    // console.info('check ' , duration_viy);

                    if (duration_viy === 0 || o.animation_engine=='css') {

                        target_viy = finish_viy;

                        if (sw_suspend_functional == false || 0) {
                            //console.info('DURATION VIY = 0', st, vi_y, target_viy)
                            // if (is_ie() && version_ie() <= 10) {
                            //     _theTarget.css('top', '' + target_viy + 'px');
                            // } else {
                            //
                            //
                            //     _theTarget.css('transform', 'translate3d(0,' + target_viy + 'px,0)');
                            // }


                            // console.info('check 2' , duration_viy);



                            if(cthis.hasClass('simple-parallax')){

                                if(_theTarget.parent().hasClass('is-image') || cthis.hasClass('simple-parallax--is-only-image')){
                                    //_theTarget.css('background-position-y',target_viy+'px')
                                    _theTarget.css('background-position-y','calc(50% - '+parseInt(target_viy,10)+'px)')
                                }

                            }else{
                                if(is_ie()&&version_ie()<=10){
                                    _theTarget.css('top',''+target_viy+'px');
                                }else{
                                    _theTarget.css('transform','translate3d('+target_vix+'px,'+target_viy+'px,0)');


                                    if(o.settings_mode=='oneelement'){
                                        cthis.css('transform','translate3d('+target_vix+'px,'+target_viy+'px,0)');
                                    }
                                }
                            }
                        }


                    }

                    //clearTimeout(inter_suspend_enter_frame);
                    //if(sw_suspend_functional==false){
                    //    inter_suspend_enter_frame = setTimeout(switch_suspend_enter_frame,700);
                    //}
                    //sw_suspend_functional = false;

                }
                var time=0;
                //console.info(vi_y);

                //console.info(st/ch, vi_y);
                //_theTarget.css('top',vi_y);
                //_theTarget.css('transform','translate3d(0,'+vi_y+'px,0)');

            }

            function switch_suspend_enter_frame(){
                sw_suspend_functional=true;
            }

            function handle_frame(){


                if(sw_suspend_functional){
                    requestAnimFrame(handle_frame);
                    return false;
                }

                //console.info('handle_frame', finish_viy, duration_viy, target_viy);
                //console.info('handle_frame()' , cthis);

                if(isNaN(target_viy)){
                    target_viy=0;
                }

                if(debug_var){
                    //console.log('animation running');
                    debug_var=false;
                }


                if(o.settings_mode=='horizontal'){
                    return false;
                }

                //console.info(duration_viy);
                if(duration_viy===0 || o.animation_engine=='css' ){

                    //console.info("RETURN");
                    if(api_outer_update_func){
                        api_outer_update_func(target_viy);
                    }
                    requestAnimFrame(handle_frame);
                    return false;
                }

                begin_viy = target_viy;
                change_viy = finish_viy - begin_viy;

                begin_bo = target_bo;
                change_bo = finish_bo - begin_bo;


                //console.info(finish_viy, begin_viy, change_viy);
                //console.log(duration_viy);
                if(o.easing=='easeIn'){
                    target_viy =  Number(Math.easeIn(1, begin_viy, change_viy, duration_viy).toFixed(5));
                    //target_viy =  Number(Math.easeIn(1, begin_viy, change_viy, duration_viy));
                    target_bo =  Number(Math.easeIn(1, begin_bo, change_bo, duration_viy).toFixed(5));

                    // console.info(target_viy);
                }
                if(o.easing=='easeOutQuad'){
                    target_viy = Math.easeOutQuad(1, begin_viy, change_viy, duration_viy);
                    target_bo = Math.easeOutQuad(1, begin_bo, change_bo, duration_viy);
                }
                if(o.easing=='easeInOutSine'){
                    target_viy = Math.easeInOutSine(1, begin_viy, change_viy, duration_viy);
                    target_bo = Math.easeInOutSine(1, begin_bo, change_bo, duration_viy);
                }


                target_vix = 0;
                if(o.settings_movexaftermouse=='on'){
                    begin_vix = target_vix;
                    change_vix = finish_vix - begin_vix;

                    //console.info(begin_vix, change_vix, duration_viy);
                    target_vix = Math.easeIn(1, begin_vix, change_vix, duration_viy);
                }


                //console.log(begin_viy, change_viy, target_viy);

                // console.info('DURATION VIY = many', duration_viy, vi_y, target_viy)

                if(cthis.hasClass('simple-parallax')){

                    if(_theTarget.parent().hasClass('is-image')){
                        //_theTarget.css('background-position-y',target_viy+'px')
                        _theTarget.css('background-position-y','calc(50% - '+parseInt(target_viy,10)+'px)')
                    }

                }else{
                    if(is_ie()&&version_ie()<=10){
                        _theTarget.css('top',''+target_viy+'px');
                    }else{
                        _theTarget.css('transform','translate3d('+target_vix+'px,'+target_viy+'px,0)');


                        if(o.settings_mode=='oneelement'){
                            cthis.css('transform','translate3d('+target_vix+'px,'+target_viy+'px,0)');
                        }
                    }
                }




                //console.info(_blackOverlay,target_bo);;

                if(_blackOverlay){
                    _blackOverlay.css('opacity',target_bo);
                }

                if(api_outer_update_func){
                    api_outer_update_func(target_viy);
                }

                if(stop_enter_frame){
                    return false;
                }

                requestAnimFrame(handle_frame);
            }

        })
    }
    window.dzsprx_init = function(selector, settings) {
        if(typeof(settings)!="undefined" && typeof(settings.init_each)!="undefined" && settings.init_each==true ){
            var element_count = 0;
            for (var e in settings) { element_count++; }
            if(element_count==1){
                settings = undefined;
            }

            $(selector).each(function(){
                var _t = $(this);
                _t.dzsparallaxer(settings)
            });
        }else{
            $(selector).dzsparallaxer(settings);
        }

    };
})(jQuery);

function is_mobile() {
    var userAgent = navigator.userAgent || navigator.vendor || window.opera;

    // Windows Phone must come first because its UA also contains "Android"
    if (/windows phone/i.test(userAgent)) {
        return true;
    }

    if (/android/i.test(userAgent)) {
        return true;
    }

    // iOS detection from: http://stackoverflow.com/a/9039885/177710
    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        return true;
    }

    return false;
}

function is_touch_device() {
    return !!('ontouchstart' in window);
}

window.requestAnimFrame = (function(){
    return  window.requestAnimationFrame       ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame    ||
        function( callback ){
            window.setTimeout(callback, 1000 / 60);
        };
})();


function is_ie() {
    var ua = window.navigator.userAgent;
    //console.info(ua);

    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }

    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }

    var edge = ua.indexOf('Edge/');
    if (edge > 0) {
        // IE 12 => return version number
        return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
    }

    // other browser
    return false;
}
;

function is_ie11(){
    return !(window.ActiveXObject) && "ActiveXObject" in window;
}
function version_ie() {
    return parseFloat(navigator.appVersion.split("MSIE")[1]);
}
;


jQuery(document).ready(function($){

    $('.dzsparallaxer---window-height').each(function(){
        var _t = $(this);
        //return false;

        $(window).on('resize',handle_resize);
        handle_resize();

        function handle_resize(){
            var wh = window.innerHeight;

            _t.height(wh);
        }
    })
    dzsprx_init('.dzsparallaxer.auto-init', {init_each: true});

});

// Cube Portfolio JS //

/*
* Cube Portfolio - Responsive jQuery Grid Plugin
*
* version: 4.3.0 (9 August, 2017)
* require: jQuery v1.8+
*
* Copyright 2013-2017, Mihai Buricea (http://scriptpie.com/cubeportfolio/live-preview/)
* Licensed under CodeCanyon License (http://codecanyon.net/licenses)
*
*/
!function(e,t,n,o){"use strict";function i(t,n,a){var r=this;if(e.data(t,"cubeportfolio"))throw new Error("cubeportfolio is already initialized. Destroy it before initialize again!");r.obj=t,r.$obj=e(t),e.data(r.obj,"cubeportfolio",r),n.sortToPreventGaps!==o&&(n.sortByDimension=n.sortToPreventGaps,delete n.sortToPreventGaps),r.options=e.extend({},e.fn.cubeportfolio.options,n,r.$obj.data("cbp-options")),r.isAnimating=!0,r.defaultFilter=r.options.defaultFilter,r.registeredEvents=[],r.queue=[],r.addedWrapp=!1,e.isFunction(a)&&r.registerEvent("initFinish",a,!0);var s=r.$obj.children();r.$obj.addClass("cbp"),(0===s.length||s.first().hasClass("cbp-item"))&&(r.wrapInner(r.obj,"cbp-wrapper"),r.addedWrapp=!0),r.$ul=r.$obj.children().addClass("cbp-wrapper"),r.wrapInner(r.obj,"cbp-wrapper-outer"),r.wrapper=r.$obj.children(".cbp-wrapper-outer"),r.blocks=r.$ul.children(".cbp-item"),r.blocksOn=r.blocks,r.wrapInner(r.blocks,"cbp-item-wrapper"),r.plugins={},e.each(i.plugins,function(e,t){var n=t(r);n&&(r.plugins[e]=n)}),r.triggerEvent("afterPlugins"),r.removeAttrAfterStoreData=e.Deferred(),r.loadImages(r.$obj,r.display)}e.extend(i.prototype,{storeData:function(t,n){var o=this;n=n||0,t.each(function(t,i){var a=e(i),r=a.width(),s=a.height();a.data("cbp",{index:n+t,indexInitial:n+t,wrapper:a.children(".cbp-item-wrapper"),widthInitial:r,heightInitial:s,width:r,height:s,widthAndGap:r+o.options.gapVertical,heightAndGap:s+o.options.gapHorizontal,left:null,leftNew:null,top:null,topNew:null,pack:!1})}),this.removeAttrAfterStoreData.resolve()},wrapInner:function(e,t){var i,a,r;if(t=t||"",!(e.length&&e.length<1))for(e.length===o&&(e=[e]),a=e.length-1;a>=0;a--){for(i=e[a],(r=n.createElement("div")).setAttribute("class",t);i.childNodes.length;)r.appendChild(i.childNodes[0]);i.appendChild(r)}},removeAttrImage:function(e){this.removeAttrAfterStoreData.then(function(){e.removeAttribute("width"),e.removeAttribute("height"),e.removeAttribute("style")})},loadImages:function(t,n){var o=this;requestAnimationFrame(function(){var i=t.find("img").map(function(t,n){if(n.hasAttribute("width")&&n.hasAttribute("height")){if(n.style.width=n.getAttribute("width")+"px",n.style.height=n.getAttribute("height")+"px",n.hasAttribute("data-cbp-src"))return null;if(null===o.checkSrc(n))o.removeAttrImage(n);else{var i=e("<img>");i.on("load.cbp error.cbp",function(){e(this).off("load.cbp error.cbp"),o.removeAttrImage(n)}),n.srcset?(i.attr("sizes",n.sizes||"100vw"),i.attr("srcset",n.srcset)):i.attr("src",n.src)}return null}return o.checkSrc(n)}),a=i.length;0!==a?e.each(i,function(t,i){var r=e("<img>");r.on("load.cbp error.cbp",function(){e(this).off("load.cbp error.cbp"),0===--a&&n.call(o)}),i.srcset?(r.attr("sizes",i.sizes),r.attr("srcset",i.srcset)):r.attr("src",i.src)}):n.call(o)})},checkSrc:function(t){var n=t.srcset,i=t.src;if(""===i)return null;var a=e("<img>");n?(a.attr("sizes",t.sizes||"100vw"),a.attr("srcset",n)):a.attr("src",i);var r=a[0];return r.complete&&r.naturalWidth!==o&&0!==r.naturalWidth?null:r},display:function(){var e=this;e.width=e.$obj.outerWidth(),e.triggerEvent("initStartRead"),e.triggerEvent("initStartWrite"),e.width>0&&(e.storeData(e.blocks),e.layoutAndAdjustment()),e.triggerEvent("initEndRead"),e.triggerEvent("initEndWrite"),e.$obj.addClass("cbp-ready"),e.runQueue("delayFrame",e.delayFrame)},delayFrame:function(){var e=this;requestAnimationFrame(function(){e.resizeEvent(),e.triggerEvent("initFinish"),e.isAnimating=!1,e.$obj.trigger("initComplete.cbp")})},resizeEvent:function(){var e=this;i["private"].resize.initEvent({instance:e,fn:function(){e.triggerEvent("beforeResizeGrid");var t=e.$obj.outerWidth();e.width!==t&&(e.width=t,"alignCenter"===e.options.gridAdjustment&&(e.wrapper[0].style.maxWidth=""),e.layoutAndAdjustment(),e.triggerEvent("resizeGrid")),e.triggerEvent("resizeWindow")}})},gridAdjust:function(){var t=this;"responsive"===t.options.gridAdjustment?t.responsiveLayout():(t.blocks.removeAttr("style"),t.blocks.each(function(n,o){var i=e(o).data("cbp"),a=o.getBoundingClientRect(),r=t.columnWidthTruncate(a.right-a.left),s=Math.round(a.bottom-a.top);i.height=s,i.heightAndGap=s+t.options.gapHorizontal,i.width=r,i.widthAndGap=r+t.options.gapVertical}),t.widthAvailable=t.width+t.options.gapVertical),t.triggerEvent("gridAdjust")},layoutAndAdjustment:function(e){var t=this;e&&(t.width=t.$obj.outerWidth()),t.gridAdjust(),t.layout()},layout:function(){var t=this;t.computeBlocks(t.filterConcat(t.defaultFilter)),"slider"===t.options.layoutMode?(t.sliderLayoutReset(),t.sliderLayout()):(t.mosaicLayoutReset(),t.mosaicLayout()),t.blocksOff.addClass("cbp-item-off"),t.blocksOn.removeClass("cbp-item-off").each(function(t,n){var o=e(n).data("cbp");o.left=o.leftNew,o.top=o.topNew,n.style.left=o.left+"px",n.style.top=o.top+"px"}),t.resizeMainContainer()},computeFilter:function(e){var t=this;t.computeBlocks(e),t.mosaicLayoutReset(),t.mosaicLayout(),t.filterLayout()},filterLayout:function(){var t=this;t.blocksOff.addClass("cbp-item-off"),t.blocksOn.removeClass("cbp-item-off").each(function(t,n){var o=e(n).data("cbp");o.left=o.leftNew,o.top=o.topNew,n.style.left=o.left+"px",n.style.top=o.top+"px"}),t.resizeMainContainer(),t.filterFinish()},filterFinish:function(){var e=this;e.isAnimating=!1,e.$obj.trigger("filterComplete.cbp"),e.triggerEvent("filterFinish")},computeBlocks:function(e){var t=this;t.blocksOnInitial=t.blocksOn,t.blocksOn=t.blocks.filter(e),t.blocksOff=t.blocks.not(e),t.triggerEvent("computeBlocksFinish",e)},responsiveLayout:function(){var t=this;t.cols=t[e.isArray(t.options.mediaQueries)?"getColumnsBreakpoints":"getColumnsAuto"](),t.columnWidth=t.columnWidthTruncate((t.width+t.options.gapVertical)/t.cols),t.widthAvailable=t.columnWidth*t.cols,"mosaic"===t.options.layoutMode&&t.getMosaicWidthReference(),t.blocks.each(function(n,o){var i,a=e(o).data("cbp"),r=1;"mosaic"===t.options.layoutMode&&(r=t.getColsMosaic(a.widthInitial)),i=t.columnWidth*r-t.options.gapVertical,o.style.width=i+"px",a.width=i,a.widthAndGap=i+t.options.gapVertical,o.style.height=""});var n=[];t.blocks.each(function(t,o){e.each(e(o).find("img").filter("[width][height]"),function(t,o){var i=0;e(o).parentsUntil(".cbp-item").each(function(t,n){var o=e(n).width();if(o>0)return i=o,!1});var a=parseInt(o.getAttribute("width"),10),r=parseInt(o.getAttribute("height"),10),s=parseFloat((a/r).toFixed(10));n.push({el:o,width:i,height:Math.round(i/s)})})}),e.each(n,function(e,t){t.el.width=t.width,t.el.height=t.height,t.el.style.width=t.width+"px",t.el.style.height=t.height+"px"}),t.blocks.each(function(n,o){var i=e(o).data("cbp"),a=o.getBoundingClientRect(),r=Math.round(a.bottom-a.top);i.height=r,i.heightAndGap=r+t.options.gapHorizontal})},getMosaicWidthReference:function(){var t=this,n=[];t.blocks.each(function(t,o){var i=e(o).data("cbp");n.push(i.widthInitial)}),n.sort(function(e,t){return e-t}),n[0]?t.mosaicWidthReference=n[0]:t.mosaicWidthReference=t.columnWidth},getColsMosaic:function(e){var t=this;if(e===t.width)return t.cols;var n=e/t.mosaicWidthReference;return n=n%1>=.79?Math.ceil(n):Math.floor(n),Math.min(Math.max(n,1),t.cols)},getColumnsAuto:function(){var e=this;if(0===e.blocks.length)return 1;var t=e.blocks.first().data("cbp").widthInitial+e.options.gapVertical;return Math.max(Math.round(e.width/t),1)},getColumnsBreakpoints:function(){var t,n=this,o=n.width;return e.each(n.options.mediaQueries,function(e,n){if(o>=n.width)return t=n,!1}),t||(t=n.options.mediaQueries[n.options.mediaQueries.length-1]),n.triggerEvent("onMediaQueries",t.options),t.cols},columnWidthTruncate:function(e){return Math.floor(e)},resizeMainContainer:function(){var t,n=this,a=Math.max(n.freeSpaces.slice(-1)[0].topStart-n.options.gapHorizontal,0);"alignCenter"===n.options.gridAdjustment&&(t=0,n.blocksOn.each(function(n,o){var i=e(o).data("cbp"),a=i.left+i.width;a>t&&(t=a)}),n.wrapper[0].style.maxWidth=t+"px"),a!==n.height?(n.obj.style.height=a+"px",n.height!==o&&(i["private"].modernBrowser?n.$obj.one(i["private"].transitionend,function(){n.$obj.trigger("pluginResize.cbp")}):n.$obj.trigger("pluginResize.cbp")),n.height=a,n.triggerEvent("resizeMainContainer")):n.triggerEvent("resizeMainContainer")},filterConcat:function(e){return e.replace(/\|/gi,"")},pushQueue:function(e,t){var n=this;n.queue[e]=n.queue[e]||[],n.queue[e].push(t)},runQueue:function(t,n){var o=this,i=o.queue[t]||[];e.when.apply(e,i).then(e.proxy(n,o))},clearQueue:function(e){this.queue[e]=[]},registerEvent:function(e,t,n){var o=this;o.registeredEvents[e]||(o.registeredEvents[e]=[]),o.registeredEvents[e].push({func:t,oneTime:n||!1})},triggerEvent:function(e,t){var n,o,i=this;if(i.registeredEvents[e])for(n=0,o=i.registeredEvents[e].length;n<o;n++)i.registeredEvents[e][n].func.call(i,t),i.registeredEvents[e][n].oneTime&&(i.registeredEvents[e].splice(n,1),n--,o--)},addItems:function(t,n,o){var a=this;a.wrapInner(t,"cbp-item-wrapper"),a.$ul[o](t.addClass("cbp-item-loading").css({top:"100%",left:0})),i["private"].modernBrowser?t.last().one(i["private"].animationend,function(){a.addItemsFinish(t,n)}):a.addItemsFinish(t,n),a.loadImages(t,function(){if(a.$obj.addClass("cbp-updateItems"),"append"===o)a.storeData(t,a.blocks.length),e.merge(a.blocks,t);else{a.storeData(t);var n=t.length;a.blocks.each(function(t,o){e(o).data("cbp").index=n+t}),a.blocks=e.merge(t,a.blocks)}a.triggerEvent("addItemsToDOM",t),a.triggerEvent("triggerSort"),a.layoutAndAdjustment(!0),a.elems&&i["public"].showCounter.call(a.obj,a.elems)})},addItemsFinish:function(t,n){var o=this;o.isAnimating=!1,o.$obj.removeClass("cbp-updateItems"),t.removeClass("cbp-item-loading"),e.isFunction(n)&&n.call(o,t),o.$obj.trigger("onAfterLoadMore.cbp",[t])},removeItems:function(t,n){var o=this;o.$obj.addClass("cbp-updateItems"),i["private"].modernBrowser?t.last().one(i["private"].animationend,function(){o.removeItemsFinish(t,n)}):o.removeItemsFinish(t,n),t.each(function(t,n){o.blocks.each(function(t,a){if(n===a){var r=e(a);o.blocks.splice(t,1),i["private"].modernBrowser?(r.one(i["private"].animationend,function(){r.remove()}),r.addClass("cbp-removeItem")):r.remove()}})}),o.blocks.each(function(t,n){e(n).data("cbp").index=t}),o.triggerEvent("triggerSort"),o.layoutAndAdjustment(!0),o.elems&&i["public"].showCounter.call(o.obj,o.elems)},removeItemsFinish:function(t,n){var o=this;o.isAnimating=!1,o.$obj.removeClass("cbp-updateItems"),e.isFunction(n)&&n.call(o,t)}}),e.fn.cubeportfolio=function(e,t,n){return this.each(function(){if("object"==typeof e||!e)return i["public"].init.call(this,e,t);if(i["public"][e])return i["public"][e].call(this,t,n);throw new Error("Method "+e+" does not exist on jquery.cubeportfolio.js")})},i.plugins={},e.fn.cubeportfolio.constructor=i}(jQuery,window,document),function(e,t,n,o){"use strict";var i=e.fn.cubeportfolio.constructor;e.extend(i.prototype,{mosaicLayoutReset:function(){var t=this;t.blocksAreSorted=!1,t.blocksOn.each(function(n,o){e(o).data("cbp").pack=!1,t.options.sortByDimension&&(o.style.height="")}),t.freeSpaces=[{leftStart:0,leftEnd:t.widthAvailable,topStart:0,topEnd:Math.pow(2,18)}]},mosaicLayout:function(){for(var e=this,t=0,n=e.blocksOn.length;t<n;t++){var o=e.getSpaceIndexAndBlock();if(null===o)return e.mosaicLayoutReset(),e.blocksAreSorted=!0,e.sortBlocks(e.blocksOn,"widthAndGap","heightAndGap",!0),void e.mosaicLayout();e.generateF1F2(o.spaceIndex,o.dataBlock),e.generateG1G2G3G4(o.dataBlock),e.cleanFreeSpaces(),e.addHeightToBlocks()}e.blocksAreSorted&&e.sortBlocks(e.blocksOn,"topNew","leftNew")},getSpaceIndexAndBlock:function(){var t=this,n=null;return e.each(t.freeSpaces,function(o,i){var a=i.leftEnd-i.leftStart,r=i.topEnd-i.topStart;return t.blocksOn.each(function(t,s){var l=e(s).data("cbp");if(!0!==l.pack)return l.widthAndGap<=a&&l.heightAndGap<=r?(l.pack=!0,n={spaceIndex:o,dataBlock:l},l.leftNew=i.leftStart,l.topNew=i.topStart,!1):void 0}),!t.blocksAreSorted&&t.options.sortByDimension&&o>0?(n=null,!1):null===n&&void 0}),n},generateF1F2:function(e,t){var n=this,o=n.freeSpaces[e],i={leftStart:o.leftStart+t.widthAndGap,leftEnd:o.leftEnd,topStart:o.topStart,topEnd:o.topEnd},a={leftStart:o.leftStart,leftEnd:o.leftEnd,topStart:o.topStart+t.heightAndGap,topEnd:o.topEnd};n.freeSpaces.splice(e,1),i.leftEnd>i.leftStart&&i.topEnd>i.topStart&&(n.freeSpaces.splice(e,0,i),e++),a.leftEnd>a.leftStart&&a.topEnd>a.topStart&&n.freeSpaces.splice(e,0,a)},generateG1G2G3G4:function(t){var n=this,o=[];e.each(n.freeSpaces,function(e,i){var a=n.intersectSpaces(i,t);null!==a?(n.generateG1(i,a,o),n.generateG2(i,a,o),n.generateG3(i,a,o),n.generateG4(i,a,o)):o.push(i)}),n.freeSpaces=o},intersectSpaces:function(e,t){var n={leftStart:t.leftNew,leftEnd:t.leftNew+t.widthAndGap,topStart:t.topNew,topEnd:t.topNew+t.heightAndGap};if(e.leftStart===n.leftStart&&e.leftEnd===n.leftEnd&&e.topStart===n.topStart&&e.topEnd===n.topEnd)return null;var o=Math.max(e.leftStart,n.leftStart),i=Math.min(e.leftEnd,n.leftEnd),a=Math.max(e.topStart,n.topStart),r=Math.min(e.topEnd,n.topEnd);return i<=o||r<=a?null:{leftStart:o,leftEnd:i,topStart:a,topEnd:r}},generateG1:function(e,t,n){e.topStart!==t.topStart&&n.push({leftStart:e.leftStart,leftEnd:e.leftEnd,topStart:e.topStart,topEnd:t.topStart})},generateG2:function(e,t,n){e.leftEnd!==t.leftEnd&&n.push({leftStart:t.leftEnd,leftEnd:e.leftEnd,topStart:e.topStart,topEnd:e.topEnd})},generateG3:function(e,t,n){e.topEnd!==t.topEnd&&n.push({leftStart:e.leftStart,leftEnd:e.leftEnd,topStart:t.topEnd,topEnd:e.topEnd})},generateG4:function(e,t,n){e.leftStart!==t.leftStart&&n.push({leftStart:e.leftStart,leftEnd:t.leftStart,topStart:e.topStart,topEnd:e.topEnd})},cleanFreeSpaces:function(){var e=this;e.freeSpaces.sort(function(e,t){return e.topStart>t.topStart?1:e.topStart<t.topStart?-1:e.leftStart>t.leftStart?1:e.leftStart<t.leftStart?-1:0}),e.correctSubPixelValues(),e.removeNonMaximalFreeSpaces()},correctSubPixelValues:function(){var e,t,n,o,i=this;for(e=0,t=i.freeSpaces.length-1;e<t;e++)n=i.freeSpaces[e],(o=i.freeSpaces[e+1]).topStart-n.topStart<=1&&(o.topStart=n.topStart)},removeNonMaximalFreeSpaces:function(){var t=this;t.uniqueFreeSpaces(),t.freeSpaces=e.map(t.freeSpaces,function(n,o){return e.each(t.freeSpaces,function(e,t){if(o!==e)return t.leftStart<=n.leftStart&&t.leftEnd>=n.leftEnd&&t.topStart<=n.topStart&&t.topEnd>=n.topEnd?(n=null,!1):void 0}),n})},uniqueFreeSpaces:function(){var t=this,n=[];e.each(t.freeSpaces,function(t,o){e.each(n,function(e,t){if(t.leftStart===o.leftStart&&t.leftEnd===o.leftEnd&&t.topStart===o.topStart&&t.topEnd===o.topEnd)return o=null,!1}),null!==o&&n.push(o)}),t.freeSpaces=n},addHeightToBlocks:function(){var t=this;e.each(t.freeSpaces,function(n,o){t.blocksOn.each(function(n,i){var a=e(i).data("cbp");!0===a.pack&&t.intersectSpaces(o,a)&&-1===o.topStart-a.topNew-a.heightAndGap&&(i.style.height=a.height-1+"px")})})},sortBlocks:function(t,n,o,i){o=void 0===o?"leftNew":o,i=void 0===i?1:-1,t.sort(function(t,a){var r=e(t).data("cbp"),s=e(a).data("cbp");return r[n]>s[n]?i:r[n]<s[n]?-i:r[o]>s[o]?i:r[o]<s[o]?-i:r.index>s.index?i:r.index<s.index?-i:void 0})}})}(jQuery,window,document),jQuery.fn.cubeportfolio.options={filters:"",search:"",layoutMode:"grid",sortByDimension:!1,drag:!0,auto:!1,autoTimeout:5e3,autoPauseOnHover:!0,showNavigation:!0,showPagination:!0,rewindNav:!0,scrollByPage:!1,defaultFilter:"*",filterDeeplinking:!1,animationType:"fadeOut",gridAdjustment:"responsive",mediaQueries:!1,gapHorizontal:10,gapVertical:10,caption:"pushTop",displayType:"fadeIn",displayTypeSpeed:400,lightboxDelegate:".cbp-lightbox",lightboxGallery:!0,lightboxTitleSrc:"data-title",lightboxCounter:'<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',singlePageDelegate:".cbp-singlePage",singlePageDeeplinking:!0,singlePageStickyNavigation:!0,singlePageCounter:'<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',singlePageAnimation:"left",singlePageCallback:null,singlePageInlineDelegate:".cbp-singlePageInline",singlePageInlineDeeplinking:!1,singlePageInlinePosition:"top",singlePageInlineInFocus:!0,singlePageInlineCallback:null,plugins:{}},function(e,t,n,o){"use strict";var i=e.fn.cubeportfolio.constructor,a=e(t);i["private"]={publicEvents:function(t,n,o){var i=this;i.events=[],i.initEvent=function(e){0===i.events.length&&i.scrollEvent(),i.events.push(e)},i.destroyEvent=function(n){i.events=e.map(i.events,function(e,t){if(e.instance!==n)return e}),0===i.events.length&&a.off(t)},i.scrollEvent=function(){var r;a.on(t,function(){clearTimeout(r),r=setTimeout(function(){e.isFunction(o)&&o.call(i)||e.each(i.events,function(e,t){t.fn.call(t.instance)})},n)})}},checkInstance:function(t){var n=e.data(this,"cubeportfolio");if(!n)throw new Error("cubeportfolio is not initialized. Initialize it before calling "+t+" method!");return n.triggerEvent("publicMethod"),n},browserInfo:function(){var e,n,o=i["private"],a=navigator.appVersion;-1!==a.indexOf("MSIE 8.")?o.browser="ie8":-1!==a.indexOf("MSIE 9.")?o.browser="ie9":-1!==a.indexOf("MSIE 10.")?o.browser="ie10":t.ActiveXObject||"ActiveXObject"in t?o.browser="ie11":/android/gi.test(a)?o.browser="android":/iphone|ipad|ipod/gi.test(a)?o.browser="ios":/chrome/gi.test(a)?o.browser="chrome":o.browser="",void 0!==typeof o.styleSupport("perspective")&&(e=o.styleSupport("transition"),o.transitionend={WebkitTransition:"webkitTransitionEnd",transition:"transitionend"}[e],n=o.styleSupport("animation"),o.animationend={WebkitAnimation:"webkitAnimationEnd",animation:"animationend"}[n],o.animationDuration={WebkitAnimation:"webkitAnimationDuration",animation:"animationDuration"}[n],o.animationDelay={WebkitAnimation:"webkitAnimationDelay",animation:"animationDelay"}[n],o.transform=o.styleSupport("transform"),e&&n&&o.transform&&(o.modernBrowser=!0))},styleSupport:function(e){var t,o="Webkit"+e.charAt(0).toUpperCase()+e.slice(1),i=n.createElement("div");return e in i.style?t=e:o in i.style&&(t=o),i=null,t}},i["private"].browserInfo(),i["private"].resize=new i["private"].publicEvents("resize.cbp",50,function(){if(t.innerHeight==screen.height)return!0})}(jQuery,window,document),function(e,t,n,o){"use strict";var i=e.fn.cubeportfolio.constructor;i["public"]={init:function(e,t){new i(this,e,t)},destroy:function(t){var n=i["private"].checkInstance.call(this,"destroy");n.triggerEvent("beforeDestroy"),e.removeData(this,"cubeportfolio"),n.blocks.removeData("cbp"),n.$obj.removeClass("cbp-ready").removeAttr("style"),n.$ul.removeClass("cbp-wrapper"),i["private"].resize.destroyEvent(n),n.$obj.off(".cbp"),n.blocks.removeClass("cbp-item-off").removeAttr("style"),n.blocks.find(".cbp-item-wrapper").each(function(t,n){var o=e(n),i=o.children();i.length?i.unwrap():o.remove()}),n.destroySlider&&n.destroySlider(),n.$ul.unwrap(),n.addedWrapp&&n.blocks.unwrap(),0===n.blocks.length&&n.$ul.remove(),e.each(n.plugins,function(e,t){"function"==typeof t.destroy&&t.destroy()}),e.isFunction(t)&&t.call(n),n.triggerEvent("afterDestroy")},filter:function(t,n){var o,a=i["private"].checkInstance.call(this,"filter");if(!a.isAnimating){if(a.isAnimating=!0,e.isFunction(n)&&a.registerEvent("filterFinish",n,!0),e.isFunction(t)){if(void 0===(o=t.call(a,a.blocks)))throw new Error("When you call cubeportfolio API `filter` method with a param of type function you must return the blocks that will be visible.")}else{if(a.options.filterDeeplinking){var r=location.href.replace(/#cbpf=(.*?)([#\?&]|$)/gi,"");location.href=r+"#cbpf="+encodeURIComponent(t),a.singlePage&&a.singlePage.url&&(a.singlePage.url=location.href)}a.defaultFilter=t,o=a.filterConcat(a.defaultFilter)}a.triggerEvent("filterStart",o),a.singlePageInline&&a.singlePageInline.isOpen?a.singlePageInline.close("promise",{callback:function(){a.computeFilter(o)}}):a.computeFilter(o)}},showCounter:function(t,n){var o=i["private"].checkInstance.call(this,"showCounter");e.isFunction(n)&&o.registerEvent("showCounterFinish",n,!0),o.elems=t,t.each(function(){var t=e(this),n=o.blocks.filter(t.data("filter")).length;t.find(".cbp-filter-counter").text(n)}),o.triggerEvent("showCounterFinish",t)},appendItems:function(e,t){i["public"].append.call(this,e,t)},append:function(t,n){var o=i["private"].checkInstance.call(this,"append"),a=e(t).filter(".cbp-item");o.isAnimating||a.length<1?e.isFunction(n)&&n.call(o,a):(o.isAnimating=!0,o.singlePageInline&&o.singlePageInline.isOpen?o.singlePageInline.close("promise",{callback:function(){o.addItems(a,n,"append")}}):o.addItems(a,n,"append"))},prepend:function(t,n){var o=i["private"].checkInstance.call(this,"prepend"),a=e(t).filter(".cbp-item");o.isAnimating||a.length<1?e.isFunction(n)&&n.call(o,a):(o.isAnimating=!0,o.singlePageInline&&o.singlePageInline.isOpen?o.singlePageInline.close("promise",{callback:function(){o.addItems(a,n,"prepend")}}):o.addItems(a,n,"prepend"))},remove:function(t,n){var o=i["private"].checkInstance.call(this,"remove"),a=e(t).filter(".cbp-item");o.isAnimating||a.length<1?e.isFunction(n)&&n.call(o,a):(o.isAnimating=!0,o.singlePageInline&&o.singlePageInline.isOpen?o.singlePageInline.close("promise",{callback:function(){o.removeItems(a,n)}}):o.removeItems(a,n))},layout:function(t){var n=i["private"].checkInstance.call(this,"layout");n.width=n.$obj.outerWidth(),n.isAnimating||n.width<=0?e.isFunction(t)&&t.call(n):("alignCenter"===n.options.gridAdjustment&&(n.wrapper[0].style.maxWidth=""),n.storeData(n.blocks),n.layoutAndAdjustment(),e.isFunction(t)&&t.call(n))}}}(jQuery,window,document),function(e,t,n,o){"use strict";var i=e.fn.cubeportfolio.constructor;e.extend(i.prototype,{updateSliderPagination:function(){var t,n,o=this;if(o.options.showPagination){for(t=Math.ceil(o.blocksOn.length/o.cols),o.navPagination.empty(),n=t-1;n>=0;n--)e("<div/>",{"class":"cbp-nav-pagination-item","data-slider-action":"jumpTo"}).appendTo(o.navPagination);o.navPaginationItems=o.navPagination.children()}o.enableDisableNavSlider()},destroySlider:function(){var t=this;"slider"===t.options.layoutMode&&(t.$obj.removeClass("cbp-mode-slider"),t.$ul.removeAttr("style"),t.$ul.off(".cbp"),e(n).off(".cbp"),t.options.auto&&t.stopSliderAuto())},nextSlider:function(e){var t=this;if(t.isEndSlider()){if(!t.isRewindNav())return;t.sliderActive=0}else t.options.scrollByPage?t.sliderActive=Math.min(t.sliderActive+t.cols,t.blocksOn.length-t.cols):t.sliderActive+=1;t.goToSlider()},prevSlider:function(e){var t=this;if(t.isStartSlider()){if(!t.isRewindNav())return;t.sliderActive=t.blocksOn.length-t.cols}else t.options.scrollByPage?t.sliderActive=Math.max(0,t.sliderActive-t.cols):t.sliderActive-=1;t.goToSlider()},jumpToSlider:function(e){var t=this,n=Math.min(e.index()*t.cols,t.blocksOn.length-t.cols);n!==t.sliderActive&&(t.sliderActive=n,t.goToSlider())},jumpDragToSlider:function(e){var t,n,o,i=this,a=e>0;i.options.scrollByPage?(t=i.cols*i.columnWidth,n=i.cols):(t=i.columnWidth,n=1),e=Math.abs(e),o=Math.floor(e/t)*n,e%t>20&&(o+=n),i.sliderActive=a?Math.min(i.sliderActive+o,i.blocksOn.length-i.cols):Math.max(0,i.sliderActive-o),i.goToSlider()},isStartSlider:function(){return 0===this.sliderActive},isEndSlider:function(){var e=this;return e.sliderActive+e.cols>e.blocksOn.length-1},goToSlider:function(){var e=this;e.enableDisableNavSlider(),e.updateSliderPosition()},startSliderAuto:function(){var e=this;e.isDrag?e.stopSliderAuto():e.timeout=setTimeout(function(){e.nextSlider(),e.startSliderAuto()},e.options.autoTimeout)},stopSliderAuto:function(){clearTimeout(this.timeout)},enableDisableNavSlider:function(){var e,t,n=this;n.isRewindNav()||(t=n.isStartSlider()?"addClass":"removeClass",n.navPrev[t]("cbp-nav-stop"),t=n.isEndSlider()?"addClass":"removeClass",n.navNext[t]("cbp-nav-stop")),n.options.showPagination&&(e=n.options.scrollByPage?Math.ceil(n.sliderActive/n.cols):n.isEndSlider()?n.navPaginationItems.length-1:Math.floor(n.sliderActive/n.cols),n.navPaginationItems.removeClass("cbp-nav-pagination-active").eq(e).addClass("cbp-nav-pagination-active")),n.customPagination&&(e=n.options.scrollByPage?Math.ceil(n.sliderActive/n.cols):n.isEndSlider()?n.customPaginationItems.length-1:Math.floor(n.sliderActive/n.cols),n.customPaginationItems.removeClass(n.customPaginationClass).eq(e).addClass(n.customPaginationClass))},isRewindNav:function(){var e=this;return!e.options.showNavigation||!(e.blocksOn.length<=e.cols)&&!!e.options.rewindNav},sliderItemsLength:function(){return this.blocksOn.length<=this.cols},sliderLayout:function(){var t=this;t.blocksOn.each(function(n,o){var i=e(o).data("cbp");i.leftNew=t.columnWidth*n,i.topNew=0,t.sliderFreeSpaces.push({topStart:i.heightAndGap})}),t.getFreeSpacesForSlider(),t.$ul.width(t.columnWidth*t.blocksOn.length-t.options.gapVertical)},getFreeSpacesForSlider:function(){var e=this;e.freeSpaces=e.sliderFreeSpaces.slice(e.sliderActive,e.sliderActive+e.cols),e.freeSpaces.sort(function(e,t){return e.topStart>t.topStart?1:e.topStart<t.topStart?-1:void 0})},updateSliderPosition:function(){var e=this,t=-e.sliderActive*e.columnWidth;i["private"].modernBrowser?e.$ul[0].style[i["private"].transform]="translate3d("+t+"px, 0px, 0)":e.$ul[0].style.left=t+"px",e.getFreeSpacesForSlider(),e.resizeMainContainer()},dragSlider:function(){function a(t){b.sliderItemsLength()||(w?h=t:t.preventDefault(),b.options.auto&&b.stopSliderAuto(),m?e(d).one("click.cbp",function(){return!1}):(d=e(t.target),c=p(t).x,u=0,f=-b.sliderActive*b.columnWidth,g=b.columnWidth*(b.blocksOn.length-b.cols),v.on(y.move,s),v.on(y.end,r),b.$obj.addClass("cbp-mode-slider-dragStart")))}function r(e){b.$obj.removeClass("cbp-mode-slider-dragStart"),m=!0,0!==u?(d.one("click.cbp",function(e){return!1}),requestAnimationFrame(function(){b.jumpDragToSlider(u),b.$ul.one(i["private"].transitionend,l)})):l.call(b),v.off(y.move),v.off(y.end)}function s(e){((u=c-p(e).x)>8||u<-8)&&e.preventDefault(),b.isDrag=!0;var t=f-u;u<0&&u<f?t=(f-u)/5:u>0&&f-u<-g&&(t=(g+f-u)/5-g),i["private"].modernBrowser?b.$ul[0].style[i["private"].transform]="translate3d("+t+"px, 0px, 0)":b.$ul[0].style.left=t+"px"}function l(){if(m=!1,b.isDrag=!1,b.options.auto){if(b.mouseIsEntered)return;b.startSliderAuto()}}function p(e){return e.originalEvent!==o&&e.originalEvent.touches!==o&&(e=e.originalEvent.touches[0]),{x:e.pageX,y:e.pageY}}var c,u,d,f,g,h,b=this,v=e(n),m=!1,y={},w=!1;b.isDrag=!1,"ontouchstart"in t||navigator.maxTouchPoints>0||navigator.msMaxTouchPoints>0?(y={start:"touchstart.cbp",move:"touchmove.cbp",end:"touchend.cbp"},w=!0):y={start:"mousedown.cbp",move:"mousemove.cbp",end:"mouseup.cbp"},b.$ul.on(y.start,a)},sliderLayoutReset:function(){var e=this;e.freeSpaces=[],e.sliderFreeSpaces=[]}})}(jQuery,window,document),"function"!=typeof Object.create&&(Object.create=function(e){function t(){}return t.prototype=e,new t}),function(){for(var e=0,t=["moz","webkit"],n=0;n<t.length&&!window.requestAnimationFrame;n++)window.requestAnimationFrame=window[t[n]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[t[n]+"CancelAnimationFrame"]||window[t[n]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(t,n){var o=(new Date).getTime(),i=Math.max(0,16-(o-e)),a=window.setTimeout(function(){t(o+i)},i);return e=o+i,a}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(e){clearTimeout(e)})}(),function(e,t,n,o){"use strict";function i(e){var t=this;t.parent=e,e.filterLayout=t.filterLayout,e.registerEvent("computeBlocksFinish",function(t){e.blocksOn2On=e.blocksOnInitial.filter(t),e.blocksOn2Off=e.blocksOnInitial.not(t)})}var a=e.fn.cubeportfolio.constructor;i.prototype.filterLayout=function(){function t(){n.blocks.removeClass("cbp-item-on2off cbp-item-off2on cbp-item-on2on").each(function(t,n){var o=e(n).data("cbp");o.left=o.leftNew,o.top=o.topNew,n.style.left=o.left+"px",n.style.top=o.top+"px",n.style[a["private"].transform]=""}),n.blocksOff.addClass("cbp-item-off"),n.$obj.removeClass("cbp-animation-"+n.options.animationType),n.filterFinish()}var n=this;n.$obj.addClass("cbp-animation-"+n.options.animationType),n.blocksOn2On.addClass("cbp-item-on2on").each(function(t,n){var o=e(n).data("cbp");n.style[a["private"].transform]="translate3d("+(o.leftNew-o.left)+"px, "+(o.topNew-o.top)+"px, 0)"}),n.blocksOn2Off.addClass("cbp-item-on2off"),n.blocksOff2On=n.blocksOn.filter(".cbp-item-off").removeClass("cbp-item-off").addClass("cbp-item-off2on").each(function(t,n){var o=e(n).data("cbp");n.style.left=o.leftNew+"px",n.style.top=o.topNew+"px"}),n.blocksOn2Off.length?n.blocksOn2Off.last().data("cbp").wrapper.one(a["private"].animationend,t):n.blocksOff2On.length?n.blocksOff2On.last().data("cbp").wrapper.one(a["private"].animationend,t):n.blocksOn2On.length?n.blocksOn2On.last().one(a["private"].transitionend,t):t(),n.resizeMainContainer()},i.prototype.destroy=function(){var e=this.parent;e.$obj.removeClass("cbp-animation-"+e.options.animationType)},a.plugins.animationClassic=function(t){return!a["private"].modernBrowser||e.inArray(t.options.animationType,["boxShadow","fadeOut","flipBottom","flipOut","quicksand","scaleSides","skew"])<0?null:new i(t)}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(e){var t=this;t.parent=e,e.filterLayout=t.filterLayout}var a=e.fn.cubeportfolio.constructor;i.prototype.filterLayout=function(){function t(){n.wrapper[0].removeChild(o),"sequentially"===n.options.animationType&&n.blocksOn.each(function(t,n){e(n).data("cbp").wrapper[0].style[a["private"].animationDelay]=""}),n.$obj.removeClass("cbp-animation-"+n.options.animationType),n.filterFinish()}var n=this,o=n.$ul[0].cloneNode(!0);o.setAttribute("class","cbp-wrapper-helper"),n.wrapper[0].insertBefore(o,n.$ul[0]),requestAnimationFrame(function(){n.$obj.addClass("cbp-animation-"+n.options.animationType),n.blocksOff.addClass("cbp-item-off"),n.blocksOn.removeClass("cbp-item-off").each(function(t,o){var i=e(o).data("cbp");i.left=i.leftNew,i.top=i.topNew,o.style.left=i.left+"px",o.style.top=i.top+"px","sequentially"===n.options.animationType&&(i.wrapper[0].style[a["private"].animationDelay]=60*t+"ms")}),n.blocksOn.length?n.blocksOn.last().data("cbp").wrapper.one(a["private"].animationend,t):n.blocksOnInitial.length?n.blocksOnInitial.last().data("cbp").wrapper.one(a["private"].animationend,t):t(),n.resizeMainContainer()})},i.prototype.destroy=function(){var e=this.parent;e.$obj.removeClass("cbp-animation-"+e.options.animationType)},a.plugins.animationClone=function(t){return!a["private"].modernBrowser||e.inArray(t.options.animationType,["fadeOutTop","slideLeft","sequentially"])<0?null:new i(t)}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(e){var t=this;t.parent=e,e.filterLayout=t.filterLayout}var a=e.fn.cubeportfolio.constructor;i.prototype.filterLayout=function(){function t(){n.wrapper[0].removeChild(o[0]),n.$obj.removeClass("cbp-animation-"+n.options.animationType),n.blocks.each(function(t,n){e(n).data("cbp").wrapper[0].style[a["private"].animationDelay]=""}),n.filterFinish()}var n=this,o=n.$ul.clone(!0,!0);o[0].setAttribute("class","cbp-wrapper-helper"),n.wrapper[0].insertBefore(o[0],n.$ul[0]);var i=o.find(".cbp-item").not(".cbp-item-off");n.blocksAreSorted&&n.sortBlocks(i,"top","left"),i.children(".cbp-item-wrapper").each(function(e,t){t.style[a["private"].animationDelay]=50*e+"ms"}),requestAnimationFrame(function(){n.$obj.addClass("cbp-animation-"+n.options.animationType),n.blocksOff.addClass("cbp-item-off"),n.blocksOn.removeClass("cbp-item-off").each(function(t,n){var o=e(n).data("cbp");o.left=o.leftNew,o.top=o.topNew,n.style.left=o.left+"px",n.style.top=o.top+"px",o.wrapper[0].style[a["private"].animationDelay]=50*t+"ms"});var o=n.blocksOn.length,r=i.length;0===o&&0===r?t():o<r?i.last().children(".cbp-item-wrapper").one(a["private"].animationend,t):n.blocksOn.last().data("cbp").wrapper.one(a["private"].animationend,t),n.resizeMainContainer()})},i.prototype.destroy=function(){var e=this.parent;e.$obj.removeClass("cbp-animation-"+e.options.animationType)},a.plugins.animationCloneDelay=function(t){return!a["private"].modernBrowser||e.inArray(t.options.animationType,["3dflip","flipOutDelay","foldLeft","frontRow","rotateRoom","rotateSides","scaleDown","slideDelay","unfold"])<0?null:new i(t)}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(e){var t=this;t.parent=e,e.filterLayout=t.filterLayout}var a=e.fn.cubeportfolio.constructor;i.prototype.filterLayout=function(){function t(){n.wrapper[0].removeChild(o),n.$obj.removeClass("cbp-animation-"+n.options.animationType),n.filterFinish()}var n=this,o=n.$ul[0].cloneNode(!0);o.setAttribute("class","cbp-wrapper-helper"),n.wrapper[0].insertBefore(o,n.$ul[0]),requestAnimationFrame(function(){n.$obj.addClass("cbp-animation-"+n.options.animationType),n.blocksOff.addClass("cbp-item-off"),n.blocksOn.removeClass("cbp-item-off").each(function(t,n){var o=e(n).data("cbp");o.left=o.leftNew,o.top=o.topNew,n.style.left=o.left+"px",n.style.top=o.top+"px"}),n.blocksOn.length?n.$ul.one(a["private"].animationend,t):n.blocksOnInitial.length?e(o).one(a["private"].animationend,t):t(),n.resizeMainContainer()})},i.prototype.destroy=function(){var e=this.parent;e.$obj.removeClass("cbp-animation-"+e.options.animationType)},a.plugins.animationWrapper=function(t){return!a["private"].modernBrowser||e.inArray(t.options.animationType,["bounceBottom","bounceLeft","bounceTop","moveLeft"])<0?null:new i(t)}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(e){var t=this,n=e.options;t.parent=e,t.captionOn=n.caption,e.registerEvent("onMediaQueries",function(e){e&&e.hasOwnProperty("caption")?t.captionOn!==e.caption&&(t.destroy(),t.captionOn=e.caption,t.init()):t.captionOn!==n.caption&&(t.destroy(),t.captionOn=n.caption,t.init())}),t.init()}var a=e.fn.cubeportfolio.constructor;i.prototype.init=function(){var e=this;""!=e.captionOn&&("expand"===e.captionOn||a["private"].modernBrowser||(e.parent.options.caption=e.captionOn="minimal"),e.parent.$obj.addClass("cbp-caption-active cbp-caption-"+e.captionOn))},i.prototype.destroy=function(){this.parent.$obj.removeClass("cbp-caption-active cbp-caption-"+this.captionOn)},a.plugins.caption=function(e){return new i(e)}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(t){this.parent=t,t.registerEvent("initFinish",function(){t.$obj.on("click.cbp",".cbp-caption-defaultWrap",function(n){if(n.preventDefault(),!t.isAnimating){t.isAnimating=!0;var o=e(this),i=o.next(),a=o.parent(),r={position:"relative",height:i.outerHeight(!0)},s={position:"relative",height:0};if(t.$obj.addClass("cbp-caption-expand-active"),a.hasClass("cbp-caption-expand-open")){var l=s;s=r,r=l,a.removeClass("cbp-caption-expand-open")}i.css(r),t.$obj.one("pluginResize.cbp",function(){t.isAnimating=!1,t.$obj.removeClass("cbp-caption-expand-active"),0===r.height&&(a.removeClass("cbp-caption-expand-open"),i.attr("style",""))}),t.layoutAndAdjustment(!0),i.css(s),requestAnimationFrame(function(){a.addClass("cbp-caption-expand-open"),i.css(r),t.triggerEvent("gridAdjust"),t.triggerEvent("resizeGrid")})}})},!0)}var a=e.fn.cubeportfolio.constructor;i.prototype.destroy=function(){this.parent.$obj.find(".cbp-caption-defaultWrap").off("click.cbp").parent().removeClass("cbp-caption-expand-active")},a.plugins.captionExpand=function(e){return"expand"!==e.options.caption?null:new i(e)}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(t){t.registerEvent("initEndWrite",function(){if(!(t.width<=0)){var n=e.Deferred();t.pushQueue("delayFrame",n),t.blocksOn.each(function(e,n){n.style[a["private"].animationDelay]=e*t.options.displayTypeSpeed+"ms"}),t.$obj.addClass("cbp-displayType-bottomToTop"),t.blocksOn.last().one(a["private"].animationend,function(){t.$obj.removeClass("cbp-displayType-bottomToTop"),t.blocksOn.each(function(e,t){t.style[a["private"].animationDelay]=""}),n.resolve()})}},!0)}var a=e.fn.cubeportfolio.constructor;a.plugins.displayBottomToTop=function(e){return a["private"].modernBrowser&&"bottomToTop"===e.options.displayType&&0!==e.blocksOn.length?new i(e):null}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(t){t.registerEvent("initEndWrite",function(){if(!(t.width<=0)){var n=e.Deferred();t.pushQueue("delayFrame",n),t.obj.style[a["private"].animationDuration]=t.options.displayTypeSpeed+"ms",t.$obj.addClass("cbp-displayType-fadeIn"),t.$obj.one(a["private"].animationend,function(){t.$obj.removeClass("cbp-displayType-fadeIn"),t.obj.style[a["private"].animationDuration]="",n.resolve()})}},!0)}var a=e.fn.cubeportfolio.constructor;a.plugins.displayFadeIn=function(e){return!a["private"].modernBrowser||"lazyLoading"!==e.options.displayType&&"fadeIn"!==e.options.displayType||0===e.blocksOn.length?null:new i(e)}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(t){t.registerEvent("initEndWrite",function(){if(!(t.width<=0)){var n=e.Deferred();t.pushQueue("delayFrame",n),t.obj.style[a["private"].animationDuration]=t.options.displayTypeSpeed+"ms",t.$obj.addClass("cbp-displayType-fadeInToTop"),t.$obj.one(a["private"].animationend,function(){t.$obj.removeClass("cbp-displayType-fadeInToTop"),t.obj.style[a["private"].animationDuration]="",n.resolve()})}},!0)}var a=e.fn.cubeportfolio.constructor;a.plugins.displayFadeInToTop=function(e){return a["private"].modernBrowser&&"fadeInToTop"===e.options.displayType&&0!==e.blocksOn.length?new i(e):null}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(t){t.registerEvent("initEndWrite",function(){if(!(t.width<=0)){var n=e.Deferred();t.pushQueue("delayFrame",n),t.blocksOn.each(function(e,n){n.style[a["private"].animationDelay]=e*t.options.displayTypeSpeed+"ms"}),t.$obj.addClass("cbp-displayType-sequentially"),t.blocksOn.last().one(a["private"].animationend,function(){t.$obj.removeClass("cbp-displayType-sequentially"),t.blocksOn.each(function(e,t){t.style[a["private"].animationDelay]=""}),n.resolve()})}},!0)}var a=e.fn.cubeportfolio.constructor;a.plugins.displaySequentially=function(e){return a["private"].modernBrowser&&"sequentially"===e.options.displayType&&0!==e.blocksOn.length?new i(e):null}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(t){var n=this;n.parent=t,n.filters=e(t.options.filters),n.filterData=[],t.registerEvent("afterPlugins",function(e){n.filterFromUrl(),n.registerFilter()}),t.registerEvent("resetFiltersVisual",function(){var o=t.options.defaultFilter.split("|");n.filters.each(function(t,n){var i=e(n).find(".cbp-filter-item");e.each(o,function(e,t){var n=i.filter('[data-filter="'+t+'"]');if(n.length)return n.addClass("active").siblings().removeClass("active"),o.splice(e,1),!1})}),t.defaultFilter=t.options.defaultFilter})}var a=e.fn.cubeportfolio.constructor;i.prototype.registerFilter=function(){var t=this,n=t.parent,o=n.defaultFilter.split("|");t.wrap=t.filters.find(".cbp-l-filters-dropdownWrap").on({"mouseover.cbp":function(){e(this).addClass("cbp-l-filters-dropdownWrap-open")},"mouseleave.cbp":function(){e(this).removeClass("cbp-l-filters-dropdownWrap-open")}}),t.filters.each(function(i,a){var r=e(a),s="*",l=r.find(".cbp-filter-item"),p={};r.hasClass("cbp-l-filters-dropdown")&&(p.wrap=r.find(".cbp-l-filters-dropdownWrap"),p.header=r.find(".cbp-l-filters-dropdownHeader"),p.headerText=p.header.text()),n.$obj.cubeportfolio("showCounter",l),e.each(o,function(e,t){if(l.filter('[data-filter="'+t+'"]').length)return s=t,o.splice(e,1),!1}),e.data(a,"filterName",s),t.filterData.push(a),t.filtersCallback(p,l.filter('[data-filter="'+s+'"]')),l.on("click.cbp",function(){var o=e(this);if(!o.hasClass("active")&&!n.isAnimating){t.filtersCallback(p,o),e.data(a,"filterName",o.data("filter"));var i=e.map(t.filterData,function(t,n){var o=e.data(t,"filterName");return""!==o&&"*"!==o?o:null});i.length<1&&(i=["*"]);var r=i.join("|");n.defaultFilter!==r&&n.$obj.cubeportfolio("filter",r)}})})},i.prototype.filtersCallback=function(t,n){e.isEmptyObject(t)||(t.wrap.trigger("mouseleave.cbp"),t.headerText?t.headerText="":t.header.html(n.html())),n.addClass("active").siblings().removeClass("active")},i.prototype.filterFromUrl=function(){var e=/#cbpf=(.*?)([#\?&]|$)/gi.exec(location.href);null!==e&&(this.parent.defaultFilter=decodeURIComponent(e[1]))},i.prototype.destroy=function(){var e=this;e.filters.find(".cbp-filter-item").off(".cbp"),e.wrap.off(".cbp")},a.plugins.filters=function(e){return""===e.options.filters?null:new i(e)}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(t){var n=t.options.gapVertical,o=t.options.gapHorizontal;t.registerEvent("onMediaQueries",function(i){t.options.gapVertical=i&&i.hasOwnProperty("gapVertical")?i.gapVertical:n,t.options.gapHorizontal=i&&i.hasOwnProperty("gapHorizontal")?i.gapHorizontal:o,t.blocks.each(function(n,o){var i=e(o).data("cbp");i.widthAndGap=i.width+t.options.gapVertical,i.heightAndGap=i.height+t.options.gapHorizontal})})}e.fn.cubeportfolio.constructor.plugins.changeGapOnMediaQueries=function(e){return new i(e)}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(t){var n=this;n.parent=t,n.options=e.extend({},r,n.parent.options.plugins.inlineSlider),n.runInit(),t.registerEvent("addItemsToDOM",function(){n.runInit()})}function a(e){var t=this;e.hasClass("cbp-slider-inline-ready")||(e.addClass("cbp-slider-inline-ready"),t.items=e.find(".cbp-slider-wrapper").children(".cbp-slider-item"),t.active=t.items.filter(".cbp-slider-item--active").index(),t.total=t.items.length-1,t.updateLeft(),e.find(".cbp-slider-next").on("click.cbp",function(e){e.preventDefault(),t.active<t.total?(t.active++,t.updateLeft()):t.active===t.total&&(t.active=0,t.updateLeft())}),e.find(".cbp-slider-prev").on("click.cbp",function(e){e.preventDefault(),t.active>0?(t.active--,t.updateLeft()):0===t.active&&(t.active=t.total,t.updateLeft())}))}var r={},s=e.fn.cubeportfolio.constructor;a.prototype.updateLeft=function(){var e=this;e.items.removeClass("cbp-slider-item--active"),e.items.eq(e.active).addClass("cbp-slider-item--active"),e.items.each(function(t,n){n.style.left=t-e.active+"00%"})},i.prototype.runInit=function(){var t=this;t.parent.$obj.find(".cbp-slider-inline").not(".cbp-slider-inline-ready").each(function(n,o){var i=e(o),r=i.find(".cbp-slider-item--active").find("img")[0];r.hasAttribute("data-cbp-src")?t.parent.$obj.on("lazyLoad.cbp",function(e,t){t.src===r.src&&new a(i)}):new a(i)})},i.prototype.destroy=function(){var t=this;t.parent.$obj.find(".cbp-slider-next").off("click.cbp"),t.parent.$obj.find(".cbp-slider-prev").off("click.cbp"),t.parent.$obj.off("lazyLoad.cbp"),t.parent.$obj.find(".cbp-slider-inline").each(function(t,n){var o=e(n);o.removeClass("cbp-slider-inline-ready");var i=o.find(".cbp-slider-item");i.removeClass("cbp-slider-item--active"),i.removeAttr("style"),i.eq(0).addClass("cbp-slider-item--active")})},s.plugins.inlineSlider=function(e){return new i(e)}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(t){var n=this;n.parent=t,n.options=e.extend({},a,n.parent.options.plugins.lazyLoad),t.registerEvent("initFinish",function(){n.loadImages(),t.registerEvent("resizeMainContainer",function(){n.loadImages()}),t.registerEvent("filterFinish",function(){n.loadImages()}),r["private"].lazyLoadScroll.initEvent({instance:n,fn:n.loadImages})},!0)}var a={loadingClass:"cbp-lazyload",threshold:400},r=e.fn.cubeportfolio.constructor,s=e(t);r["private"].lazyLoadScroll=new r["private"].publicEvents("scroll.cbplazyLoad",50),i.prototype.loadImages=function(){var t=this,n=t.parent.$obj.find("img").filter("[data-cbp-src]");0!==n.length&&(t.screenHeight=s.height(),n.each(function(n,o){var i=e(o.parentNode);if(t.isElementInScreen(o)){var a=o.getAttribute("data-cbp-src");null===t.parent.checkSrc(e("<img>").attr("src",a))?(t.removeLazyLoad(o,a),i.removeClass(t.options.loadingClass)):(i.addClass(t.options.loadingClass),e("<img>").on("load.cbp error.cbp",function(){t.removeLazyLoad(o,a,i)}).attr("src",a))}else i.addClass(t.options.loadingClass)}))},i.prototype.removeLazyLoad=function(t,n,o){var i=this;t.src=n,t.removeAttribute("data-cbp-src"),i.parent.removeAttrImage(t),i.parent.$obj.trigger("lazyLoad.cbp",t),o&&(r["private"].modernBrowser?e(t).one(r["private"].transitionend,function(){o.removeClass(i.options.loadingClass)}):o.removeClass(i.options.loadingClass))},i.prototype.isElementInScreen=function(e){var t=this,n=e.getBoundingClientRect(),o=n.bottom+t.options.threshold,i=t.screenHeight+o-(n.top-t.options.threshold);return o>=0&&o<=i},i.prototype.destroy=function(){r["private"].lazyLoadScroll.destroyEvent(this)},r.plugins.lazyLoad=function(e){return new i(e)}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(t){var n=this;n.parent=t,n.options=e.extend({},a,n.parent.options.plugins.loadMore),n.loadMore=e(n.options.element).find(".cbp-l-loadMore-link"),0!==n.loadMore.length&&(n.loadItems=n.loadMore.find(".cbp-l-loadMore-loadItems"),"0"===n.loadItems.text()&&n.loadMore.addClass("cbp-l-loadMore-stop"),t.registerEvent("filterStart",function(e){n.populateItems().then(function(){var t=n.items.filter(e).length;t>0?(n.loadMore.removeClass("cbp-l-loadMore-stop"),n.loadItems.html(t)):n.loadMore.addClass("cbp-l-loadMore-stop")})}),n[n.options.action]())}var a={element:"",action:"click",loadItems:3},r=e.fn.cubeportfolio.constructor;i.prototype.populateItems=function(){var t=this;return t.items?e.Deferred().resolve():(t.items=e(),e.ajax({url:t.loadMore.attr("href"),type:"GET",dataType:"HTML"}).done(function(n){var o=e.map(n.split(/\r?\n/),function(t,n){return e.trim(t)}).join("");0!==o.length&&e.each(e.parseHTML(o),function(n,o){e(o).hasClass("cbp-item")?t.items=t.items.add(o):e.each(o.children,function(n,o){e(o).hasClass("cbp-item")&&(t.items=t.items.add(o))})})}).fail(function(){t.items=null,t.loadMore.removeClass("cbp-l-loadMore-loading")}))},i.prototype.populateInsertItems=function(t){var n=this,o=[],i=n.parent.defaultFilter,a=0;n.items.each(function(t,r){if(a===n.options.loadItems)return!1;i&&"*"!==i?e(r).filter(i).length&&(o.push(r),n.items[t]=null,a++):(o.push(r),n.items[t]=null,a++)}),n.items=n.items.map(function(e,t){return t}),0!==o.length?n.parent.$obj.cubeportfolio("append",o,t):n.loadMore.removeClass("cbp-l-loadMore-loading").addClass("cbp-l-loadMore-stop")},i.prototype.click=function(){function e(){t.loadMore.removeClass("cbp-l-loadMore-loading");var e,n=t.parent.defaultFilter;0===(e=n&&"*"!==n?t.items.filter(n).length:t.items.length)?t.loadMore.addClass("cbp-l-loadMore-stop"):t.loadItems.html(e)}var t=this;t.loadMore.on("click.cbp",function(n){n.preventDefault(),t.parent.isAnimating||t.loadMore.hasClass("cbp-l-loadMore-stop")||(t.loadMore.addClass("cbp-l-loadMore-loading"),t.populateItems().then(function(){t.populateInsertItems(e)}))})},i.prototype.auto=function(){function n(){s||i.loadMore.hasClass("cbp-l-loadMore-stop")||i.loadMore.offset().top-200>a.scrollTop()+a.height()||(s=!0,i.populateItems().then(function(){i.populateInsertItems(o)}).fail(function(){s=!1}))}function o(){var e,t=i.parent.defaultFilter;0===(e=t&&"*"!==t?i.items.filter(t).length:i.items.length)?i.loadMore.removeClass("cbp-l-loadMore-loading").addClass("cbp-l-loadMore-stop"):(i.loadItems.html(e),a.trigger("scroll.loadMore")),s=!1,0===i.items.length&&(r["private"].loadMoreScroll.destroyEvent(i),i.parent.$obj.off("filterComplete.cbp"))}var i=this,a=e(t),s=!1;r["private"].loadMoreScroll=new r["private"].publicEvents("scroll.loadMore",100),i.parent.$obj.one("initComplete.cbp",function(){i.loadMore.addClass("cbp-l-loadMore-loading").on("click.cbp",function(e){e.preventDefault()}),r["private"].loadMoreScroll.initEvent({instance:i,fn:function(){i.parent.isAnimating||n()}}),i.parent.$obj.on("filterComplete.cbp",function(){n()}),n()})},i.prototype.destroy=function(){this.loadMore.off(".cbp"),r["private"].loadMoreScroll&&r["private"].loadMoreScroll.destroyEvent(this)},r.plugins.loadMore=function(e){var t=e.options.plugins;return e.options.loadMore&&(t.loadMore||(t.loadMore={}),t.loadMore.element=e.options.loadMore),e.options.loadMoreAction&&(t.loadMore||(t.loadMore={}),t.loadMore.action=e.options.loadMoreAction),t.loadMore&&void 0!==t.loadMore.selector&&(t.loadMore.element=t.loadMore.selector,delete t.loadMore.selector),t.loadMore&&t.loadMore.element?new i(e):null}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(e){var t=this;t.parent=e,!1===e.options.lightboxShowCounter&&(e.options.lightboxCounter=""),!1===e.options.singlePageShowCounter&&(e.options.singlePageCounter=""),e.registerEvent("initStartRead",function(){t.run()},!0)}var a=e.fn.cubeportfolio.constructor,r={delay:0},s={init:function(t,o){var i,a=this;if(a.cubeportfolio=t,a.type=o,a.isOpen=!1,a.options=a.cubeportfolio.options,"lightbox"===o&&(a.cubeportfolio.registerEvent("resizeWindow",function(){a.resizeImage()}),a.localOptions=e.extend({},r,a.cubeportfolio.options.plugins.lightbox)),"singlePageInline"!==o){if(a.createMarkup(),"singlePage"===o){if(a.cubeportfolio.registerEvent("resizeWindow",function(){if(a.options.singlePageStickyNavigation){var e=a.contentWrap[0].clientWidth;e>0&&(a.navigationWrap.width(e),a.navigation.width(e))}}),a.options.singlePageDeeplinking){a.url=location.href,"#"===a.url.slice(-1)&&(a.url=a.url.slice(0,-1));var s=a.url.split("#cbp="),l=s.shift();if(e.each(s,function(t,n){if(a.cubeportfolio.blocksOn.each(function(t,o){var r=e(o).find(a.options.singlePageDelegate+'[href="'+n+'"]');if(r.length)return i=r,!1}),i)return!1}),i){a.url=l;var p=i,c=p.attr("data-cbp-singlePage"),u=[];c?u=p.closest(e(".cbp-item")).find('[data-cbp-singlePage="'+c+'"]'):a.cubeportfolio.blocksOn.each(function(t,n){var o=e(n);o.not(".cbp-item-off")&&o.find(a.options.singlePageDelegate).each(function(t,n){e(n).attr("data-cbp-singlePage")||u.push(n)})}),a.openSinglePage(u,i[0])}else if(s.length){var d=n.createElement("a");d.setAttribute("href",s[0]),a.openSinglePage([d],d)}}a.localOptions=e.extend({},r,a.cubeportfolio.options.plugins.singlePage)}}else{if(a.height=0,a.createMarkupSinglePageInline(),a.cubeportfolio.registerEvent("resizeGrid",function(){a.isOpen&&a.close()}),a.options.singlePageInlineDeeplinking){a.url=location.href,"#"===a.url.slice(-1)&&(a.url=a.url.slice(0,-1));l=(s=a.url.split("#cbpi=")).shift();e.each(s,function(t,n){if(a.cubeportfolio.blocksOn.each(function(t,o){var r=e(o).find(a.options.singlePageInlineDelegate+'[href="'+n+'"]');if(r.length)return i=r,!1}),i)return!1}),i&&a.cubeportfolio.registerEvent("initFinish",function(){a.openSinglePageInline(a.cubeportfolio.blocksOn,i[0])},!0)}a.localOptions=e.extend({},r,a.cubeportfolio.options.plugins.singlePageInline)}},createMarkup:function(){var t=this,o="";"singlePage"===t.type&&"left"!==t.options.singlePageAnimation&&(o=" cbp-popup-singlePage-"+t.options.singlePageAnimation),t.wrap=e("<div/>",{"class":"cbp-popup-wrap cbp-popup-"+t.type+o,"data-action":"lightbox"===t.type?"close":""}).on("click.cbp",function(n){if(!t.stopEvents){var o=e(n.target).attr("data-action");t[o]&&(t[o](),n.preventDefault())}}),"singlePage"===t.type?(t.contentWrap=e("<div/>",{"class":"cbp-popup-content-wrap"}).appendTo(t.wrap),"ios"===a["private"].browser&&t.contentWrap.css("overflow","auto"),t.content=e("<div/>",{"class":"cbp-popup-content"}).appendTo(t.contentWrap)):t.content=e("<div/>",{"class":"cbp-popup-content"}).appendTo(t.wrap),e("<div/>",{"class":"cbp-popup-loadingBox"}).appendTo(t.wrap),"ie8"===a["private"].browser&&(t.bg=e("<div/>",{"class":"cbp-popup-ie8bg","data-action":"lightbox"===t.type?"close":""}).appendTo(t.wrap)),"singlePage"===t.type&&!1===t.options.singlePageStickyNavigation?t.navigationWrap=e("<div/>",{"class":"cbp-popup-navigation-wrap"}).appendTo(t.contentWrap):t.navigationWrap=e("<div/>",{"class":"cbp-popup-navigation-wrap"}).appendTo(t.wrap),t.navigation=e("<div/>",{"class":"cbp-popup-navigation"}).appendTo(t.navigationWrap),t.closeButton=e("<div/>",{"class":"cbp-popup-close",title:"Close (Esc arrow key)","data-action":"close"}).appendTo(t.navigation),t.nextButton=e("<div/>",{"class":"cbp-popup-next",title:"Next (Right arrow key)","data-action":"next"}).appendTo(t.navigation),t.prevButton=e("<div/>",{"class":"cbp-popup-prev",title:"Previous (Left arrow key)","data-action":"prev"}).appendTo(t.navigation),"singlePage"===t.type&&(t.options.singlePageCounter&&(t.counter=e(t.options.singlePageCounter).appendTo(t.navigation),t.counter.text("")),t.content.on("click.cbp",t.options.singlePageDelegate,function(e){e.preventDefault();var o,i,a=t.dataArray.length,r=this.getAttribute("href");for(o=0;o<a;o++)if(t.dataArray[o].url===r){i=o;break}if(void 0===i){var s=n.createElement("a");s.setAttribute("href",r),t.dataArray=[{url:r,element:s}],t.counterTotal=1,t.nextButton.hide(),t.prevButton.hide(),t.singlePageJumpTo(0)}else t.singlePageJumpTo(i-t.current)}),t.contentWrap.on("mousewheel.cbp DOMMouseScroll.cbp",function(e){e.stopImmediatePropagation()})),e(n).on("keydown.cbp",function(e){t.isOpen&&(t.stopEvents||(l&&e.stopImmediatePropagation(),37===e.keyCode?t.prev():39===e.keyCode?t.next():27===e.keyCode&&t.close()))})},createMarkupSinglePageInline:function(){var t=this;t.wrap=e("<div/>",{"class":"cbp-popup-singlePageInline"}).on("click.cbp",function(n){if(!t.stopEvents){var o=e(n.target).attr("data-action");o&&t[o]&&(t[o](),n.preventDefault())}}),t.content=e("<div/>",{"class":"cbp-popup-content"}).appendTo(t.wrap),t.navigation=e("<div/>",{"class":"cbp-popup-navigation"}).appendTo(t.wrap),t.closeButton=e("<div/>",{"class":"cbp-popup-close",title:"Close (Esc arrow key)","data-action":"close"}).appendTo(t.navigation)},destroy:function(){var t=this,o=e("body");e(n).off("keydown.cbp"),o.off("click.cbp",t.options.lightboxDelegate),o.off("click.cbp",t.options.singlePageDelegate),t.content.off("click.cbp",t.options.singlePageDelegate),t.cubeportfolio.$obj.off("click.cbp",t.options.singlePageInlineDelegate),t.cubeportfolio.$obj.off("click.cbp",t.options.lightboxDelegate),t.cubeportfolio.$obj.off("click.cbp",t.options.singlePageDelegate),t.cubeportfolio.$obj.removeClass("cbp-popup-isOpening"),t.cubeportfolio.$obj.find(".cbp-item").removeClass("cbp-singlePageInline-active"),t.wrap.remove()},openLightbox:function(o,i){var a,r,s=this,p=0,c=[];if(!s.isOpen){if(l=!0,s.isOpen=!0,s.stopEvents=!1,s.dataArray=[],s.current=null,null===(a=i.getAttribute("href")))throw new Error("HEI! Your clicked element doesn't have a href attribute.");e.each(o,function(t,n){var o,i=n.getAttribute("href"),r=i,l="isImage";if(-1===e.inArray(i,c)){if(a===i)s.current=p;else if(!s.options.lightboxGallery)return;if(/youtu\.?be/i.test(i)){var u=i.lastIndexOf("v=")+2;1===u&&(u=i.lastIndexOf("/")+1),o=i.substring(u),/autoplay=/i.test(o)||(o+="&autoplay=1"),r="//www.youtube.com/embed/"+(o=o.replace(/\?|&/,"?")),l="isYoutube"}else/vimeo\.com/i.test(i)?(o=i.substring(i.lastIndexOf("/")+1),/autoplay=/i.test(o)||(o+="&autoplay=1"),r="//player.vimeo.com/video/"+(o=o.replace(/\?|&/,"?")),l="isVimeo"):/www\.ted\.com/i.test(i)?(r="http://embed.ted.com/talks/"+i.substring(i.lastIndexOf("/")+1)+".html",l="isTed"):/soundcloud\.com/i.test(i)?(r=i,l="isSoundCloud"):/(\.mp4)|(\.ogg)|(\.ogv)|(\.webm)/i.test(i)?(r=-1!==i.indexOf("|")?i.split("|"):i.split("%7C"),l="isSelfHostedVideo"):/\.mp3$/i.test(i)&&(r=i,l="isSelfHostedAudio");s.dataArray.push({src:r,title:n.getAttribute(s.options.lightboxTitleSrc),type:l}),p++}c.push(i)}),s.counterTotal=s.dataArray.length,1===s.counterTotal?(s.nextButton.hide(),s.prevButton.hide(),s.dataActionImg=""):(s.nextButton.show(),s.prevButton.show(),s.dataActionImg='data-action="next"'),s.wrap.appendTo(n.body),s.scrollTop=e(t).scrollTop(),s.originalStyle=e("html").attr("style"),e("html").css({overflow:"hidden",marginRight:t.innerWidth-e(n).width()}),s.wrap.addClass("cbp-popup-transitionend"),s.wrap.show(),r=s.dataArray[s.current],s[r.type](r)}},openSinglePage:function(o,i){var r,s=this,l=0,p=[];if(!s.isOpen){if(s.cubeportfolio.singlePageInline&&s.cubeportfolio.singlePageInline.isOpen&&s.cubeportfolio.singlePageInline.close(),s.isOpen=!0,s.stopEvents=!1,s.dataArray=[],s.current=null,null===(r=i.getAttribute("href")))throw new Error("HEI! Your clicked element doesn't have a href attribute.");if(e.each(o,function(t,n){var o=n.getAttribute("href");-1===e.inArray(o,p)&&(r===o&&(s.current=l),s.dataArray.push({url:o,element:n}),l++),p.push(o)}),s.counterTotal=s.dataArray.length,1===s.counterTotal?(s.nextButton.hide(),s.prevButton.hide()):(s.nextButton.show(),s.prevButton.show()),s.wrap.appendTo(n.body),s.scrollTop=e(t).scrollTop(),s.contentWrap.scrollTop(0),s.wrap.show(),s.finishOpen=2,s.navigationMobile=e(),s.wrap.one(a["private"].transitionend,function(){e("html").css({overflow:"hidden",marginRight:t.innerWidth-e(n).width()}),s.wrap.addClass("cbp-popup-transitionend"),s.options.singlePageStickyNavigation&&(s.wrap.addClass("cbp-popup-singlePage-sticky"),s.navigationWrap.width(s.contentWrap[0].clientWidth)),--s.finishOpen<=0&&s.updateSinglePageIsOpen.call(s)}),"ie8"!==a["private"].browser&&"ie9"!==a["private"].browser||(e("html").css({overflow:"hidden",marginRight:t.innerWidth-e(n).width()}),s.wrap.addClass("cbp-popup-transitionend"),s.options.singlePageStickyNavigation&&(s.navigationWrap.width(s.contentWrap[0].clientWidth),setTimeout(function(){s.wrap.addClass("cbp-popup-singlePage-sticky")},1e3)),s.finishOpen--),s.wrap.addClass("cbp-popup-loading"),s.wrap.offset(),s.wrap.addClass("cbp-popup-singlePage-open"),s.options.singlePageDeeplinking&&(s.url=s.url.split("#cbp=")[0],location.href=s.url+"#cbp="+s.dataArray[s.current].url),e.isFunction(s.options.singlePageCallback)&&s.options.singlePageCallback.call(s,s.dataArray[s.current].url,s.dataArray[s.current].element),"ios"===a["private"].browser){var c=s.contentWrap[0];c.addEventListener("touchstart",function(){var e=c.scrollTop,t=c.scrollHeight,n=e+c.offsetHeight;0===e?c.scrollTop=1:n===t&&(c.scrollTop=e-1)})}}},openSinglePageInline:function(n,o,i){var a,r,s,l=this;if(i=i||!1,l.fromOpen=i,l.storeBlocks=n,l.storeCurrentBlock=o,l.isOpen)return r=l.cubeportfolio.blocksOn.index(e(o).closest(".cbp-item")),void(l.dataArray[l.current].url!==o.getAttribute("href")||l.current!==r?l.cubeportfolio.singlePageInline.close("open",{blocks:n,currentBlock:o,fromOpen:!0}):l.close());if(l.isOpen=!0,l.stopEvents=!1,l.dataArray=[],l.current=null,null===(a=o.getAttribute("href")))throw new Error("HEI! Your clicked element doesn't have a href attribute.");if(s=e(o).closest(".cbp-item")[0],n.each(function(e,t){s===t&&(l.current=e)}),l.dataArray[l.current]={url:a,element:o},e(l.dataArray[l.current].element).parents(".cbp-item").addClass("cbp-singlePageInline-active"),l.counterTotal=n.length,l.wrap.insertBefore(l.cubeportfolio.wrapper),l.topDifference=0,"top"===l.options.singlePageInlinePosition)l.blocksToMove=n,l.top=0;else if("bottom"===l.options.singlePageInlinePosition)l.blocksToMove=e(),l.top=l.cubeportfolio.height;else if("above"===l.options.singlePageInlinePosition){var p=e(n[l.current]),c=(u=p.data("cbp").top)+p.height();l.top=u,l.blocksToMove=e(),n.each(function(t,n){var o=e(n),i=o.data("cbp").top,a=i+o.height();a<=u||(i>=u&&(l.blocksToMove=l.blocksToMove.add(n)),i<u&&a>u&&(l.top=a+l.options.gapHorizontal,a-u>l.topDifference&&(l.topDifference=a-u+l.options.gapHorizontal)))}),l.top=Math.max(l.top-l.options.gapHorizontal,0)}else{var u=(p=e(n[l.current])).data("cbp").top,c=u+p.height();l.top=c,l.blocksToMove=e(),n.each(function(t,n){var o=e(n),i=o.height(),a=o.data("cbp").top,r=a+i;r<=c||(a>=c-i/2?l.blocksToMove=l.blocksToMove.add(n):r>c&&a<c&&(r>l.top&&(l.top=r),r-c>l.topDifference&&(l.topDifference=r-c)))})}if(l.wrap[0].style.height=l.wrap.outerHeight(!0)+"px",l.deferredInline=e.Deferred(),l.options.singlePageInlineInFocus){l.scrollTop=e(t).scrollTop();var d=l.cubeportfolio.$obj.offset().top+l.top-100;l.scrollTop!==d?e("html,body").animate({scrollTop:d},350).promise().then(function(){l.resizeSinglePageInline(),l.deferredInline.resolve()}):(l.resizeSinglePageInline(),l.deferredInline.resolve())}else l.resizeSinglePageInline(),l.deferredInline.resolve();l.cubeportfolio.$obj.addClass("cbp-popup-singlePageInline-open"),l.wrap.css({top:l.top}),l.options.singlePageInlineDeeplinking&&(l.url=l.url.split("#cbpi=")[0],location.href=l.url+"#cbpi="+l.dataArray[l.current].url),e.isFunction(l.options.singlePageInlineCallback)&&l.options.singlePageInlineCallback.call(l,l.dataArray[l.current].url,l.dataArray[l.current].element)},resizeSinglePageInline:function(){var e=this;e.height=0===e.top||e.top===e.cubeportfolio.height?e.wrap.outerHeight(!0):e.wrap.outerHeight(!0)-e.options.gapHorizontal,e.height+=e.topDifference,e.storeBlocks.each(function(e,t){a["private"].modernBrowser?t.style[a["private"].transform]="":t.style.marginTop=""}),e.blocksToMove.each(function(t,n){a["private"].modernBrowser?n.style[a["private"].transform]="translate3d(0px, "+e.height+"px, 0)":n.style.marginTop=e.height+"px"}),e.cubeportfolio.obj.style.height=e.cubeportfolio.height+e.height+"px"},revertResizeSinglePageInline:function(){var t=this;t.deferredInline=e.Deferred(),t.storeBlocks.each(function(e,t){a["private"].modernBrowser?t.style[a["private"].transform]="":t.style.marginTop=""}),t.cubeportfolio.obj.style.height=t.cubeportfolio.height+"px"},appendScriptsToWrap:function(e){var t=this,o=0,i=function(a){var r=n.createElement("script"),s=a.src;r.type="text/javascript",r.readyState?r.onreadystatechange=function(){"loaded"!=r.readyState&&"complete"!=r.readyState||(r.onreadystatechange=null,e[++o]&&i(e[o]))}:r.onload=function(){e[++o]&&i(e[o])},s?r.src=s:r.text=a.text,t.content[0].appendChild(r)};i(e[0])},updateSinglePage:function(t,n,o){var i,a=this;a.content.addClass("cbp-popup-content").removeClass("cbp-popup-content-basic"),!1===o&&a.content.removeClass("cbp-popup-content").addClass("cbp-popup-content-basic"),a.counter&&(i=e(a.getCounterMarkup(a.options.singlePageCounter,a.current+1,a.counterTotal)),a.counter.text(i.text())),a.fromAJAX={html:t,scripts:n},--a.finishOpen<=0&&a.updateSinglePageIsOpen.call(a)},updateSinglePageIsOpen:function(){var e,t=this;t.wrap.addClass("cbp-popup-ready"),t.wrap.removeClass("cbp-popup-loading"),t.content.html(t.fromAJAX.html),t.fromAJAX.scripts&&t.appendScriptsToWrap(t.fromAJAX.scripts),t.fromAJAX={},t.cubeportfolio.$obj.trigger("updateSinglePageStart.cbp"),(e=t.content.find(".cbp-slider")).length?(e.find(".cbp-slider-item").addClass("cbp-item"),t.slider=e.cubeportfolio({layoutMode:"slider",mediaQueries:[{width:1,cols:1}],gapHorizontal:0,gapVertical:0,caption:"",coverRatio:""})):t.slider=null,t.checkForSocialLinks(t.content),t.cubeportfolio.$obj.trigger("updateSinglePageComplete.cbp")},checkForSocialLinks:function(e){var t=this;t.createFacebookShare(e.find(".cbp-social-fb")),t.createTwitterShare(e.find(".cbp-social-twitter")),t.createGooglePlusShare(e.find(".cbp-social-googleplus")),t.createPinterestShare(e.find(".cbp-social-pinterest"))},createFacebookShare:function(e){e.length&&!e.attr("onclick")&&e.attr("onclick","window.open('http://www.facebook.com/sharer.php?u="+encodeURIComponent(t.location.href)+"', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=400'); return false;")},createTwitterShare:function(e){e.length&&!e.attr("onclick")&&e.attr("onclick","window.open('https://twitter.com/intent/tweet?source="+encodeURIComponent(t.location.href)+"&text="+encodeURIComponent(n.title)+"', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=300'); return false;")},createGooglePlusShare:function(e){e.length&&!e.attr("onclick")&&e.attr("onclick","window.open('https://plus.google.com/share?url="+encodeURIComponent(t.location.href)+"', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=450'); return false;")},createPinterestShare:function(e){if(e.length&&!e.attr("onclick")){var n="",o=this.content.find("img")[0];o&&(n=o.src),e.attr("onclick","window.open('http://pinterest.com/pin/create/button/?url="+encodeURIComponent(t.location.href)+"&media="+n+"', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=400'); return false;")}},updateSinglePageInline:function(e,t){var n=this;n.content.html(e),t&&n.appendScriptsToWrap(t),n.cubeportfolio.$obj.trigger("updateSinglePageInlineStart.cbp"),0!==n.localOptions.delay?setTimeout(function(){n.singlePageInlineIsOpen.call(n)},n.localOptions.delay):n.singlePageInlineIsOpen.call(n)},singlePageInlineIsOpen:function(){function e(){t.wrap.addClass("cbp-popup-singlePageInline-ready"),t.wrap[0].style.height="",t.resizeSinglePageInline(),t.cubeportfolio.$obj.trigger("updateSinglePageInlineComplete.cbp")}var t=this;t.cubeportfolio.loadImages(t.wrap,function(){var n=t.content.find(".cbp-slider");n.length?(n.find(".cbp-slider-item").addClass("cbp-item"),n.one("initComplete.cbp",function(){t.deferredInline.done(e)}),n.on("pluginResize.cbp",function(){t.deferredInline.done(e)}),t.slider=n.cubeportfolio({layoutMode:"slider",displayType:"default",mediaQueries:[{width:1,cols:1}],gapHorizontal:0,gapVertical:0,caption:"",coverRatio:""})):(t.slider=null,t.deferredInline.done(e)),t.checkForSocialLinks(t.content)})},isImage:function(t){var n=this;new Image;n.tooggleLoading(!0),n.cubeportfolio.loadImages(e('<div><img src="'+t.src+'"></div>'),function(){n.updateImagesMarkup(t.src,t.title,n.getCounterMarkup(n.options.lightboxCounter,n.current+1,n.counterTotal)),n.tooggleLoading(!1)})},isVimeo:function(e){var t=this;t.updateVideoMarkup(e.src,e.title,t.getCounterMarkup(t.options.lightboxCounter,t.current+1,t.counterTotal))},isYoutube:function(e){var t=this;t.updateVideoMarkup(e.src,e.title,t.getCounterMarkup(t.options.lightboxCounter,t.current+1,t.counterTotal))},isTed:function(e){var t=this;t.updateVideoMarkup(e.src,e.title,t.getCounterMarkup(t.options.lightboxCounter,t.current+1,t.counterTotal))},isSoundCloud:function(e){var t=this;t.updateVideoMarkup(e.src,e.title,t.getCounterMarkup(t.options.lightboxCounter,t.current+1,t.counterTotal))},isSelfHostedVideo:function(e){var t=this;t.updateSelfHostedVideo(e.src,e.title,t.getCounterMarkup(t.options.lightboxCounter,t.current+1,t.counterTotal))},isSelfHostedAudio:function(e){var t=this;t.updateSelfHostedAudio(e.src,e.title,t.getCounterMarkup(t.options.lightboxCounter,t.current+1,t.counterTotal))},getCounterMarkup:function(e,t,n){if(!e.length)return"";var o={current:t,total:n};return e.replace(/\{\{current}}|\{\{total}}/gi,function(e){return o[e.slice(2,-2)]})},updateSelfHostedVideo:function(e,t,n){var o,i=this;i.wrap.addClass("cbp-popup-lightbox-isIframe");var a='<div class="cbp-popup-lightbox-iframe"><video controls="controls" height="auto" style="width: 100%">';for(o=0;o<e.length;o++)/(\.mp4)/i.test(e[o])?a+='<source src="'+e[o]+'" type="video/mp4">':/(\.ogg)|(\.ogv)/i.test(e[o])?a+='<source src="'+e[o]+'" type="video/ogg">':/(\.webm)/i.test(e[o])&&(a+='<source src="'+e[o]+'" type="video/webm">');a+='Your browser does not support the video tag.</video><div class="cbp-popup-lightbox-bottom">'+(t?'<div class="cbp-popup-lightbox-title">'+t+"</div>":"")+n+"</div></div>",i.content.html(a),i.wrap.addClass("cbp-popup-ready"),i.preloadNearbyImages()},updateSelfHostedAudio:function(e,t,n){var o=this;o.wrap.addClass("cbp-popup-lightbox-isIframe");var i='<div class="cbp-popup-lightbox-iframe"><div class="cbp-misc-video"><audio controls="controls" height="auto" style="width: 75%"><source src="'+e+'" type="audio/mpeg">Your browser does not support the audio tag.</audio></div><div class="cbp-popup-lightbox-bottom">'+(t?'<div class="cbp-popup-lightbox-title">'+t+"</div>":"")+n+"</div></div>";o.content.html(i),o.wrap.addClass("cbp-popup-ready"),o.preloadNearbyImages()},updateVideoMarkup:function(e,t,n){var o=this;o.wrap.addClass("cbp-popup-lightbox-isIframe");var i='<div class="cbp-popup-lightbox-iframe"><iframe src="'+e+'" frameborder="0" allowfullscreen scrolling="no"></iframe><div class="cbp-popup-lightbox-bottom">'+(t?'<div class="cbp-popup-lightbox-title">'+t+"</div>":"")+n+"</div></div>";o.content.html(i),o.wrap.addClass("cbp-popup-ready"),o.preloadNearbyImages()},updateImagesMarkup:function(e,t,n){var o=this;o.wrap.removeClass("cbp-popup-lightbox-isIframe");var i='<div class="cbp-popup-lightbox-figure"><img src="'+e+'" class="cbp-popup-lightbox-img" '+o.dataActionImg+' /><div class="cbp-popup-lightbox-bottom">'+(t?'<div class="cbp-popup-lightbox-title">'+t+"</div>":"")+n+"</div></div>";o.content.html(i),o.wrap.addClass("cbp-popup-ready"),o.resizeImage(),o.preloadNearbyImages()},next:function(){var e=this;e[e.type+"JumpTo"](1)},prev:function(){var e=this;e[e.type+"JumpTo"](-1)},lightboxJumpTo:function(e){var t,n=this;n.current=n.getIndex(n.current+e),n[(t=n.dataArray[n.current]).type](t)},singlePageJumpTo:function(t){var n=this;n.current=n.getIndex(n.current+t),e.isFunction(n.options.singlePageCallback)&&(n.resetWrap(),n.contentWrap.scrollTop(0),n.wrap.addClass("cbp-popup-loading"),n.slider&&a["private"].resize.destroyEvent(e.data(n.slider[0],"cubeportfolio")),n.options.singlePageCallback.call(n,n.dataArray[n.current].url,n.dataArray[n.current].element),n.options.singlePageDeeplinking&&(location.href=n.url+"#cbp="+n.dataArray[n.current].url))},resetWrap:function(){var e=this;"singlePage"===e.type&&e.options.singlePageDeeplinking&&(location.href=e.url+"#"),"singlePageInline"===e.type&&e.options.singlePageInlineDeeplinking&&(location.href=e.url+"#")},getIndex:function(e){var t=this;return(e%=t.counterTotal)<0&&(e=t.counterTotal+e),e},close:function(n,o){function i(){s.slider&&a["private"].resize.destroyEvent(e.data(s.slider[0],"cubeportfolio")),s.content.html(""),s.wrap.detach(),s.cubeportfolio.$obj.removeClass("cbp-popup-singlePageInline-open cbp-popup-singlePageInline-close"),"promise"===n&&e.isFunction(o.callback)&&o.callback.call(s.cubeportfolio)}function r(){var o=e(t).scrollTop();s.resetWrap(),e(t).scrollTop(o),s.options.singlePageInlineInFocus&&"promise"!==n?e("html,body").animate({scrollTop:s.scrollTop},350).promise().then(function(){i()}):i()}var s=this;s.isOpen=!1,"singlePageInline"===s.type?"open"===n?(s.wrap.removeClass("cbp-popup-singlePageInline-ready"),e(s.dataArray[s.current].element).closest(".cbp-item").removeClass("cbp-singlePageInline-active"),s.openSinglePageInline(o.blocks,o.currentBlock,o.fromOpen)):(s.height=0,s.revertResizeSinglePageInline(),s.wrap.removeClass("cbp-popup-singlePageInline-ready"),s.cubeportfolio.$obj.addClass("cbp-popup-singlePageInline-close"),s.cubeportfolio.$obj.find(".cbp-item").removeClass("cbp-singlePageInline-active"),a["private"].modernBrowser?s.wrap.one(a["private"].transitionend,function(){r()}):r()):"singlePage"===s.type?(s.resetWrap(),e(t).scrollTop(s.scrollTop),s.stopScroll=!0,s.wrap.removeClass("cbp-popup-ready cbp-popup-transitionend cbp-popup-singlePage-open cbp-popup-singlePage-sticky"),e("html").css({overflow:"",marginRight:"",position:""}),"ie8"!==a["private"].browser&&"ie9"!==a["private"].browser||(s.slider&&a["private"].resize.destroyEvent(e.data(s.slider[0],"cubeportfolio")),s.content.html(""),s.wrap.detach()),s.wrap.one(a["private"].transitionend,function(){s.slider&&a["private"].resize.destroyEvent(e.data(s.slider[0],"cubeportfolio")),s.content.html(""),s.wrap.detach()})):(l=!1,s.originalStyle?e("html").attr("style",s.originalStyle):e("html").css({overflow:"",marginRight:""}),e(t).scrollTop(s.scrollTop),s.slider&&a["private"].resize.destroyEvent(e.data(s.slider[0],"cubeportfolio")),s.content.html(""),s.wrap.detach())},tooggleLoading:function(e){var t=this;t.stopEvents=e,t.wrap[e?"addClass":"removeClass"]("cbp-popup-loading")},resizeImage:function(){if(this.isOpen){var n=this.content.find("img"),o=n.parent(),i=e(t).height()-(o.outerHeight(!0)-o.height())-this.content.find(".cbp-popup-lightbox-bottom").outerHeight(!0);n.css("max-height",i+"px")}},preloadNearbyImages:function(){for(var e=this,t=[e.getIndex(e.current+1),e.getIndex(e.current+2),e.getIndex(e.current+3),e.getIndex(e.current-1),e.getIndex(e.current-2),e.getIndex(e.current-3)],n=t.length-1;n>=0;n--)"isImage"===e.dataArray[t[n]].type&&e.cubeportfolio.checkSrc(e.dataArray[t[n]])}},l=!1,p=!1,c=!1;i.prototype.run=function(){var t=this,o=t.parent,i=e(n.body);o.lightbox=null,o.options.lightboxDelegate&&!p&&(p=!0,o.lightbox=Object.create(s),o.lightbox.init(o,"lightbox"),i.on("click.cbp",o.options.lightboxDelegate,function(n){n.preventDefault();var i=e(this),a=i.attr("data-cbp-lightbox"),r=t.detectScope(i),s=r.data("cubeportfolio"),l=[];s?s.blocksOn.each(function(t,n){var i=e(n);i.not(".cbp-item-off")&&i.find(o.options.lightboxDelegate).each(function(t,n){a?e(n).attr("data-cbp-lightbox")===a&&l.push(n):l.push(n)})}):l=a?r.find(o.options.lightboxDelegate+"[data-cbp-lightbox="+a+"]"):r.find(o.options.lightboxDelegate),o.lightbox.openLightbox(l,i[0])})),o.singlePage=null,o.options.singlePageDelegate&&!c&&(c=!0,o.singlePage=Object.create(s),o.singlePage.init(o,"singlePage"),i.on("click.cbp",o.options.singlePageDelegate,function(n){n.preventDefault();var i=e(this),a=i.attr("data-cbp-singlePage"),r=t.detectScope(i),s=r.data("cubeportfolio"),l=[];s?s.blocksOn.each(function(t,n){var i=e(n);i.not(".cbp-item-off")&&i.find(o.options.singlePageDelegate).each(function(t,n){a?e(n).attr("data-cbp-singlePage")===a&&l.push(n):l.push(n)})}):l=a?r.find(o.options.singlePageDelegate+"[data-cbp-singlePage="+a+"]"):r.find(o.options.singlePageDelegate),o.singlePage.openSinglePage(l,i[0])})),o.singlePageInline=null,o.options.singlePageInlineDelegate&&(o.singlePageInline=Object.create(s),o.singlePageInline.init(o,"singlePageInline"),o.$obj.on("click.cbp",o.options.singlePageInlineDelegate,function(t){t.preventDefault();var n=e.data(this,"cbp-locked"),i=e.data(this,"cbp-locked",+new Date);(!n||i-n>300)&&o.singlePageInline.openSinglePageInline(o.blocksOn,this)}))},i.prototype.detectScope=function(t){var o,i,a;return(o=t.closest(".cbp-popup-singlePageInline")).length?(a=t.closest(".cbp",o[0]),a.length?a:o):(i=t.closest(".cbp-popup-singlePage")).length?(a=t.closest(".cbp",i[0]),a.length?a:i):(a=t.closest(".cbp"),a.length?a:e(n.body))},i.prototype.destroy=function(){var t=this.parent;e(n.body).off("click.cbp"),p=!1,c=!1,t.lightbox&&t.lightbox.destroy(),t.singlePage&&t.singlePage.destroy(),t.singlePageInline&&t.singlePageInline.destroy()},a.plugins.popUp=function(e){return new i(e)}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(t){var n=this;n.parent=t,n.searchInput=e(t.options.search),n.searchInput.each(function(t,n){var o=n.getAttribute("data-search");o||(o="*"),e.data(n,"searchData",{value:n.value,el:o})});var o=null;n.searchInput.on("keyup.cbp paste.cbp",function(t){t.preventDefault();var i=e(this);clearTimeout(o),o=setTimeout(function(){n.runEvent.call(n,i)},350)}),n.searchNothing=n.searchInput.siblings(".cbp-search-nothing").detach(),n.searchNothingHeight=null,n.searchNothingHTML=n.searchNothing.html(),n.searchInput.siblings(".cbp-search-icon").on("click.cbp",function(t){t.preventDefault(),n.runEvent.call(n,e(this).prev().val(""))})}var a=e.fn.cubeportfolio.constructor;i.prototype.runEvent=function(t){var n=this,o=t.val(),i=t.data("searchData"),a=new RegExp(o,"i");i.value===o||n.parent.isAnimating||(i.value=o,o.length>0?t.attr("value",o):t.removeAttr("value"),n.parent.$obj.cubeportfolio("filter",function(t){var r=t.filter(function(t,n){if(e(n).find(i.el).text().search(a)>-1)return!0});if(0===r.length&&n.searchNothing.length){var s=n.searchNothingHTML.replace("{{query}}",o);n.searchNothing.html(s),n.searchNothing.appendTo(n.parent.$obj),null===n.searchNothingHeight&&(n.searchNothingHeight=n.searchNothing.outerHeight(!0)),n.parent.registerEvent("resizeMainContainer",function(){n.parent.height=n.parent.height+n.searchNothingHeight,n.parent.obj.style.height=n.parent.height+"px"},!0)}else n.searchNothing.detach();return n.parent.triggerEvent("resetFiltersVisual"),r},function(){t.trigger("keyup.cbp")}))},i.prototype.destroy=function(){var t=this;t.searchInput.off(".cbp"),t.searchInput.next(".cbp-search-icon").off(".cbp"),t.searchInput.each(function(t,n){e.removeData(n)})},a.plugins.search=function(e){return""===e.options.search?null:new i(e)}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(t){var n=this;n.parent=t,n.options=e.extend({},a,n.parent.options.plugins.slider);var o=e(n.options.pagination);o.length>0&&(n.parent.customPagination=o,n.parent.customPaginationItems=o.children(),n.parent.customPaginationClass=n.options.paginationClass,n.parent.customPaginationItems.on("click.cbp",function(t){t.preventDefault(),t.stopImmediatePropagation(),t.stopPropagation(),n.parent.sliderStopEvents||n.parent.jumpToSlider(e(this))})),n.parent.registerEvent("gridAdjust",function(){n.sliderMarkup.call(n.parent),n.parent.registerEvent("gridAdjust",function(){n.updateSlider.call(n.parent)})},!0)}var a={pagination:"",paginationClass:"cbp-pagination-active"},r=e.fn.cubeportfolio.constructor;i.prototype.sliderMarkup=function(){var t=this;t.sliderStopEvents=!1,t.sliderActive=0,t.$obj.one("initComplete.cbp",function(){t.$obj.addClass("cbp-mode-slider")}),t.nav=e("<div/>",{"class":"cbp-nav"}),t.nav.on("click.cbp","[data-slider-action]",function(n){if(n.preventDefault(),n.stopImmediatePropagation(),n.stopPropagation(),!t.sliderStopEvents){var o=e(this),i=o.attr("data-slider-action");t[i+"Slider"]&&t[i+"Slider"](o)}}),t.options.showNavigation&&(t.controls=e("<div/>",{"class":"cbp-nav-controls"}),t.navPrev=e("<div/>",{"class":"cbp-nav-prev","data-slider-action":"prev"}).appendTo(t.controls),t.navNext=e("<div/>",{"class":"cbp-nav-next","data-slider-action":"next"}).appendTo(t.controls),t.controls.appendTo(t.nav)),t.options.showPagination&&(t.navPagination=e("<div/>",{"class":"cbp-nav-pagination"}).appendTo(t.nav)),(t.controls||t.navPagination)&&t.nav.appendTo(t.$obj),t.updateSliderPagination(),t.options.auto&&(t.options.autoPauseOnHover&&(t.mouseIsEntered=!1,t.$obj.on("mouseenter.cbp",function(e){t.mouseIsEntered=!0,t.stopSliderAuto()}).on("mouseleave.cbp",function(e){t.mouseIsEntered=!1,t.startSliderAuto()})),t.startSliderAuto()),t.options.drag&&r["private"].modernBrowser&&t.dragSlider()},i.prototype.updateSlider=function(){var e=this;e.updateSliderPosition(),e.updateSliderPagination()},i.prototype.destroy=function(){var e=this;e.parent.customPaginationItems&&e.parent.customPaginationItems.off(".cbp"),(e.parent.controls||e.parent.navPagination)&&(e.parent.nav.off(".cbp"),e.parent.nav.remove())},r.plugins.slider=function(e){return"slider"!==e.options.layoutMode?null:new i(e)}}(jQuery,window,document),function(e,t,n,o){"use strict";function i(t){var n=this;n.parent=t,n.options=e.extend({},a,n.parent.options.plugins.sort),n.element=e(n.options.element),0!==n.element.length&&(n.sort="",n.sortBy="string:asc",n.element.on("click.cbp",".cbp-sort-item",function(o){o.preventDefault(),n.target=o.target,e(n.target).hasClass("cbp-l-dropdown-item--active")||t.isAnimating||(n.processSort(),t.$obj.cubeportfolio("filter",t.defaultFilter))}),t.registerEvent("triggerSort",function(){n.target&&(n.processSort(),t.$obj.cubeportfolio("filter",t.defaultFilter))}),n.dropdownWrap=n.element.find(".cbp-l-dropdown-wrap").on({"mouseover.cbp":function(){e(this).addClass("cbp-l-dropdown-wrap--open")},"mouseleave.cbp":function(){e(this).removeClass("cbp-l-dropdown-wrap--open")}}),n.dropdownHeader=n.element.find(".cbp-l-dropdown-header"))}var a={element:""},r=e.fn.cubeportfolio.constructor;i.prototype.processSort=function(){var t=this,n=t.parent,o=(c=t.target).hasAttribute("data-sort"),i=c.hasAttribute("data-sortBy");if(o&&i)t.sort=c.getAttribute("data-sort"),t.sortBy=c.getAttribute("data-sortBy");else if(o)t.sort=c.getAttribute("data-sort");else{if(!i)return;t.sortBy=c.getAttribute("data-sortBy")}var a=t.sortBy.split(":"),r="string",s=1;if("int"===a[0]?r="int":"float"===a[0]&&(r="float"),"desc"===a[1]&&(s=-1),t.sort){var l=[];n.blocks.each(function(n,o){var i=e(o),a=i.find(t.sort).text();"int"===r&&(a=parseInt(a,10)),"float"===r&&(a=parseFloat(a,10)),l.push({sortText:a,data:i.data("cbp")})}),l.sort(function(e,t){var n=e.sortText,o=t.sortText;return"string"===r&&(n=n.toUpperCase(),o=o.toUpperCase()),n<o?-s:n>o?s:0}),e.each(l,function(e,t){t.data.index=e})}else{var p=[];-1===s&&(n.blocks.each(function(t,n){p.push(e(n).data("cbp").indexInitial)}),p.sort(function(e,t){return t-e})),n.blocks.each(function(t,n){var o=e(n).data("cbp");o.index=-1===s?p[o.indexInitial]:o.indexInitial})}n.sortBlocks(n.blocks,"index"),t.dropdownWrap.trigger("mouseleave.cbp");var c=e(t.target),u=e(t.target).parent();u.hasClass("cbp-l-dropdown-list")?(t.dropdownHeader.html(c.html()),c.addClass("cbp-l-dropdown-item--active").siblings(".cbp-l-dropdown-item").removeClass("cbp-l-dropdown-item--active")):u.hasClass("cbp-l-direction")&&(0===c.index()?u.addClass("cbp-l-direction--second").removeClass("cbp-l-direction--first"):u.addClass("cbp-l-direction--first").removeClass("cbp-l-direction--second"))},i.prototype.destroy=function(){this.element.off("click.cbp")},r.plugins.sort=function(e){return new i(e)}}(jQuery,window,document);

$('#portfolio-item').cubeportfolio({
        filters: '#portfolio-menu',
        loadMore: '#loadMore',
        loadMoreAction: 'click',
        defaultFilter: '*',
		layoutMode: 'grid',
        animationType: 'quicksand',
		gridAdjustment: 'responsive',
        gapHorizontal: 15,
        gapVertical: 15,
        mediaQueries: [{
            width: 1100,
            cols: 4,
        },{
            width: 768,
            cols: 3,
        }, {
            width: 480,
            cols: 2,
        },{
            width: 0,
            cols: 1,
        }],
        caption: 'overlayBottomPush',
        displayType: 'sequentially',
        displayTypeSpeed: 80,

        // lightbox
        lightboxDelegate: '.cbp-lightbox',
        lightboxGallery: true,
        lightboxTitleSrc: 'data-title',
        lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
});

$('#portfolio-item-2').cubeportfolio({
        filters: '#portfolio-menu',
        loadMore: '#loadMore',
        loadMoreAction: 'click',
        defaultFilter: '*',
		layoutMode: 'grid',
        animationType: 'quicksand',
		gridAdjustment: 'responsive',
        gapHorizontal: 15,
        gapVertical: 15,
        mediaQueries: [{
            width: 1100,
            cols: 3,
        },{
            width: 768,
            cols: 3,
        }, {
            width: 480,
            cols: 2,
        },{
            width: 0,
            cols: 1,
        }],
        caption: 'overlayBottomPush',
        displayType: 'sequentially',
        displayTypeSpeed: 80,

        // lightbox
        lightboxDelegate: '.cbp-lightbox',
        lightboxGallery: true,
        lightboxTitleSrc: 'data-title',
        lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
});
$('#portfolio-item-3').cubeportfolio({
        filters: '#portfolio-menu',
        loadMore: '#loadMore',
        loadMoreAction: 'click',
        defaultFilter: '*',
		layoutMode: 'grid',
        animationType: 'quicksand',
		gridAdjustment: 'responsive',
        gapHorizontal: 15,
        gapVertical: 15,
        mediaQueries: [{
            width: 1100,
            cols: 2,
        },{
            width: 768,
            cols: 3,
        }, {
            width: 480,
            cols: 2,
        },{
            width: 0,
            cols: 1,
        }],
        caption: 'overlayBottomPush',
        displayType: 'sequentially',
        displayTypeSpeed: 80,

        // lightbox
        lightboxDelegate: '.cbp-lightbox',
        lightboxGallery: true,
        lightboxTitleSrc: 'data-title',
        lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
});

// Easing JS //
!function(n){"function"==typeof define&&define.amd?define(["jquery"],function(e){return n(e)}):"object"==typeof module&&"object"==typeof module.exports?exports=n(require("jquery")):n(jQuery)}(function(n){function e(n){var e=7.5625,t=2.75;return n<1/t?e*n*n:n<2/t?e*(n-=1.5/t)*n+.75:n<2.5/t?e*(n-=2.25/t)*n+.9375:e*(n-=2.625/t)*n+.984375}n.easing.jswing=n.easing.swing;var t=Math.pow,u=Math.sqrt,r=Math.sin,i=Math.cos,a=Math.PI,c=1.70158,o=1.525*c,s=2*a/3,f=2*a/4.5;n.extend(n.easing,{def:"easeOutQuad",swing:function(e){return n.easing[n.easing.def](e)},easeInQuad:function(n){return n*n},easeOutQuad:function(n){return 1-(1-n)*(1-n)},easeInOutQuad:function(n){return n<.5?2*n*n:1-t(-2*n+2,2)/2},easeInCubic:function(n){return n*n*n},easeOutCubic:function(n){return 1-t(1-n,3)},easeInOutCubic:function(n){return n<.5?4*n*n*n:1-t(-2*n+2,3)/2},easeInQuart:function(n){return n*n*n*n},easeOutQuart:function(n){return 1-t(1-n,4)},easeInOutQuart:function(n){return n<.5?8*n*n*n*n:1-t(-2*n+2,4)/2},easeInQuint:function(n){return n*n*n*n*n},easeOutQuint:function(n){return 1-t(1-n,5)},easeInOutQuint:function(n){return n<.5?16*n*n*n*n*n:1-t(-2*n+2,5)/2},easeInSine:function(n){return 1-i(n*a/2)},easeOutSine:function(n){return r(n*a/2)},easeInOutSine:function(n){return-(i(a*n)-1)/2},easeInExpo:function(n){return 0===n?0:t(2,10*n-10)},easeOutExpo:function(n){return 1===n?1:1-t(2,-10*n)},easeInOutExpo:function(n){return 0===n?0:1===n?1:n<.5?t(2,20*n-10)/2:(2-t(2,-20*n+10))/2},easeInCirc:function(n){return 1-u(1-t(n,2))},easeOutCirc:function(n){return u(1-t(n-1,2))},easeInOutCirc:function(n){return n<.5?(1-u(1-t(2*n,2)))/2:(u(1-t(-2*n+2,2))+1)/2},easeInElastic:function(n){return 0===n?0:1===n?1:-t(2,10*n-10)*r((10*n-10.75)*s)},easeOutElastic:function(n){return 0===n?0:1===n?1:t(2,-10*n)*r((10*n-.75)*s)+1},easeInOutElastic:function(n){return 0===n?0:1===n?1:n<.5?-(t(2,20*n-10)*r((20*n-11.125)*f))/2:t(2,-20*n+10)*r((20*n-11.125)*f)/2+1},easeInBack:function(n){return(c+1)*n*n*n-c*n*n},easeOutBack:function(n){return 1+(c+1)*t(n-1,3)+c*t(n-1,2)},easeInOutBack:function(n){return n<.5?t(2*n,2)*(7.189819*n-o)/2:(t(2*n-2,2)*((o+1)*(2*n-2)+o)+2)/2},easeInBounce:function(n){return 1-e(1-n)},easeOutBounce:e,easeInOutBounce:function(n){return n<.5?(1-e(1-2*n))/2:(1+e(2*n-1))/2}})});

// ==================================================
// fancyBox v3.1.20
//
// Licensed GPLv3 for open source use
// or fancyBox Commercial License for commercial use
//
// http://fancyapps.com/fancybox/
// Copyright 2017 fancyApps
//
// ==================================================
!function(t,e,n,o){"use strict";function i(t){var e=t.currentTarget,o=t.data?t.data.options:{},i=t.data?t.data.items:[],a=n(e).attr("data-fancybox")||"",s=0;t.preventDefault(),t.stopPropagation(),a?(i=i.length?i.filter('[data-fancybox="'+a+'"]'):n('[data-fancybox="'+a+'"]'),s=i.index(e),s<0&&(s=0)):i=[e],n.fancybox.open(i,o,s)}if(n){if(n.fn.fancybox)return void n.error("fancyBox already initialized");var a={loop:!1,margin:[44,0],gutter:50,keyboard:!0,arrows:!0,infobar:!1,toolbar:!0,buttons:["slideShow","fullScreen","thumbs","close"],idleTime:4,smallBtn:"auto",protect:!1,modal:!1,image:{preload:"auto"},ajax:{settings:{data:{fancybox:!0}}},iframe:{tpl:'<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen allowtransparency="true" src=""></iframe>',preload:!0,css:{},attr:{scrolling:"auto"}},animationEffect:"zoom",animationDuration:366,zoomOpacity:"auto",transitionEffect:"fade",transitionDuration:366,slideClass:"",baseClass:"",baseTpl:'<div class="fancybox-container" role="dialog" tabindex="-1"><div class="fancybox-bg"></div><div class="fancybox-inner"><div class="fancybox-infobar"><button data-fancybox-prev title="{{PREV}}" class="fancybox-button fancybox-button--left"></button><div class="fancybox-infobar__body"><span data-fancybox-index></span>&nbsp;/&nbsp;<span data-fancybox-count></span></div><button data-fancybox-next title="{{NEXT}}" class="fancybox-button fancybox-button--right"></button></div><div class="fancybox-toolbar">{{BUTTONS}}</div><div class="fancybox-navigation"><button data-fancybox-prev title="{{PREV}}" class="fancybox-arrow fancybox-arrow--left" /><button data-fancybox-next title="{{NEXT}}" class="fancybox-arrow fancybox-arrow--right" /></div><div class="fancybox-stage"></div><div class="fancybox-caption-wrap"><div class="fancybox-caption"></div></div></div></div>',spinnerTpl:'<div class="fancybox-loading"></div>',errorTpl:'<div class="fancybox-error"><p>{{ERROR}}<p></div>',btnTpl:{slideShow:'<button data-fancybox-play class="fancybox-button fancybox-button--play" title="{{PLAY_START}}"></button>',fullScreen:'<button data-fancybox-fullscreen class="fancybox-button fancybox-button--fullscreen" title="{{FULL_SCREEN}}"></button>',thumbs:'<button data-fancybox-thumbs class="fancybox-button fancybox-button--thumbs" title="{{THUMBS}}"></button>',close:'<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{CLOSE}}"></button>',smallBtn:'<button data-fancybox-close class="fancybox-close-small" title="{{CLOSE}}"></button>'},parentEl:"body",autoFocus:!0,backFocus:!0,trapFocus:!0,fullScreen:{autoStart:!1},touch:{vertical:!0,momentum:!0},hash:null,media:{},slideShow:{autoStart:!1,speed:4e3},thumbs:{autoStart:!1,hideOnClose:!0},onInit:n.noop,beforeLoad:n.noop,afterLoad:n.noop,beforeShow:n.noop,afterShow:n.noop,beforeClose:n.noop,afterClose:n.noop,onActivate:n.noop,onDeactivate:n.noop,clickContent:function(t,e){return"image"===t.type&&"zoom"},clickSlide:"close",clickOutside:"close",dblclickContent:!1,dblclickSlide:!1,dblclickOutside:!1,mobile:{clickContent:function(t,e){return"image"===t.type&&"toggleControls"},clickSlide:function(t,e){return"image"===t.type?"toggleControls":"close"},dblclickContent:function(t,e){return"image"===t.type&&"zoom"},dblclickSlide:function(t,e){return"image"===t.type&&"zoom"}},lang:"en",i18n:{en:{CLOSE:"Close",NEXT:"Next",PREV:"Previous",ERROR:"The requested content cannot be loaded. <br/> Please try again later.",PLAY_START:"Start slideshow",PLAY_STOP:"Pause slideshow",FULL_SCREEN:"Full screen",THUMBS:"Thumbnails"},de:{CLOSE:"Schliessen",NEXT:"Weiter",PREV:"Zurück",ERROR:"Die angeforderten Daten konnten nicht geladen werden. <br/> Bitte versuchen Sie es später nochmal.",PLAY_START:"Diaschau starten",PLAY_STOP:"Diaschau beenden",FULL_SCREEN:"Vollbild",THUMBS:"Vorschaubilder"}}},s=n(t),r=n(e),c=0,l=function(t){return t&&t.hasOwnProperty&&t instanceof n},u=function(){return t.requestAnimationFrame||t.webkitRequestAnimationFrame||t.mozRequestAnimationFrame||t.oRequestAnimationFrame||function(e){return t.setTimeout(e,1e3/60)}}(),d=function(){var t,n=e.createElement("fakeelement"),i={transition:"transitionend",OTransition:"oTransitionEnd",MozTransition:"transitionend",WebkitTransition:"webkitTransitionEnd"};for(t in i)if(n.style[t]!==o)return i[t]}(),f=function(t){return t&&t.length&&t[0].offsetHeight},h=function(t,o,i){var s=this;s.opts=n.extend(!0,{index:i},a,o||{}),o&&n.isArray(o.buttons)&&(s.opts.buttons=o.buttons),s.id=s.opts.id||++c,s.group=[],s.currIndex=parseInt(s.opts.index,10)||0,s.prevIndex=null,s.prevPos=null,s.currPos=0,s.firstRun=null,s.createGroup(t),s.group.length&&(s.$lastFocus=n(e.activeElement).blur(),s.slides={},s.init(t))};n.extend(h.prototype,{init:function(){var t,e,o,i=this,a=i.group[i.currIndex].opts;i.scrollTop=r.scrollTop(),i.scrollLeft=r.scrollLeft(),n.fancybox.getInstance()||n.fancybox.isMobile||"hidden"===n("body").css("overflow")||(t=n("body").width(),n("html").addClass("fancybox-enabled"),t=n("body").width()-t,t>1&&n("head").append('<style id="fancybox-style-noscroll" type="text/css">.compensate-for-scrollbar, .fancybox-enabled body { margin-right: '+t+"px; }</style>")),o="",n.each(a.buttons,function(t,e){o+=a.btnTpl[e]||""}),e=n(i.translate(i,a.baseTpl.replace("{{BUTTONS}}",o))).addClass("fancybox-is-hidden").attr("id","fancybox-container-"+i.id).addClass(a.baseClass).data("FancyBox",i).prependTo(a.parentEl),i.$refs={container:e},["bg","inner","infobar","toolbar","stage","caption"].forEach(function(t){i.$refs[t]=e.find(".fancybox-"+t)}),(!a.arrows||i.group.length<2)&&e.find(".fancybox-navigation").remove(),a.infobar||i.$refs.infobar.remove(),a.toolbar||i.$refs.toolbar.remove(),i.trigger("onInit"),i.activate(),i.jumpTo(i.currIndex)},translate:function(t,e){var n=t.opts.i18n[t.opts.lang];return e.replace(/\{\{(\w+)\}\}/g,function(t,e){var i=n[e];return i===o?t:i})},createGroup:function(t){var e=this,i=n.makeArray(t);n.each(i,function(t,i){var a,s,r,c,l={},u={},d=[];n.isPlainObject(i)?(l=i,u=i.opts||i):"object"===n.type(i)&&n(i).length?(a=n(i),d=a.data(),u="options"in d?d.options:{},u="object"===n.type(u)?u:{},l.src="src"in d?d.src:u.src||a.attr("href"),["width","height","thumb","type","filter"].forEach(function(t){t in d&&(u[t]=d[t])}),"srcset"in d&&(u.image={srcset:d.srcset}),u.$orig=a,l.type||l.src||(l.type="inline",l.src=i)):l={type:"html",src:i+""},l.opts=n.extend(!0,{},e.opts,u),n.fancybox.isMobile&&(l.opts=n.extend(!0,{},l.opts,l.opts.mobile)),s=l.type||l.opts.type,r=l.src||"",!s&&r&&(r.match(/(^data:image\/[a-z0-9+\/=]*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg|ico)((\?|#).*)?$)/i)?s="image":r.match(/\.(pdf)((\?|#).*)?$/i)?s="pdf":"#"===r.charAt(0)&&(s="inline")),l.type=s,l.index=e.group.length,l.opts.$orig&&!l.opts.$orig.length&&delete l.opts.$orig,!l.opts.$thumb&&l.opts.$orig&&(l.opts.$thumb=l.opts.$orig.find("img:first")),l.opts.$thumb&&!l.opts.$thumb.length&&delete l.opts.$thumb,"function"===n.type(l.opts.caption)?l.opts.caption=l.opts.caption.apply(i,[e,l]):"caption"in d&&(l.opts.caption=d.caption),l.opts.caption=l.opts.caption===o?"":l.opts.caption+"","ajax"===s&&(c=r.split(/\s+/,2),c.length>1&&(l.src=c.shift(),l.opts.filter=c.shift())),"auto"==l.opts.smallBtn&&(n.inArray(s,["html","inline","ajax"])>-1?(l.opts.toolbar=!1,l.opts.smallBtn=!0):l.opts.smallBtn=!1),"pdf"===s&&(l.type="iframe",l.opts.iframe.preload=!1),l.opts.modal&&(l.opts=n.extend(!0,l.opts,{infobar:0,toolbar:0,smallBtn:0,keyboard:0,slideShow:0,fullScreen:0,thumbs:0,touch:0,clickContent:!1,clickSlide:!1,clickOutside:!1,dblclickContent:!1,dblclickSlide:!1,dblclickOutside:!1})),e.group.push(l)})},addEvents:function(){var o=this;o.removeEvents(),o.$refs.container.on("click.fb-close","[data-fancybox-close]",function(t){t.stopPropagation(),t.preventDefault(),o.close(t)}).on("click.fb-prev touchend.fb-prev","[data-fancybox-prev]",function(t){t.stopPropagation(),t.preventDefault(),o.previous()}).on("click.fb-next touchend.fb-next","[data-fancybox-next]",function(t){t.stopPropagation(),t.preventDefault(),o.next()}),s.on("orientationchange.fb resize.fb",function(t){t&&t.originalEvent&&"resize"===t.originalEvent.type?u(function(){o.update()}):(o.$refs.stage.hide(),setTimeout(function(){o.$refs.stage.show(),o.update()},500))}),r.on("focusin.fb",function(t){var i=n.fancybox?n.fancybox.getInstance():null;i.isClosing||!i.current||!i.current.opts.trapFocus||n(t.target).hasClass("fancybox-container")||n(t.target).is(e)||i&&"fixed"!==n(t.target).css("position")&&!i.$refs.container.has(t.target).length&&(t.stopPropagation(),i.focus(),s.scrollTop(o.scrollTop).scrollLeft(o.scrollLeft))}),r.on("keydown.fb",function(t){var e=o.current,i=t.keyCode||t.which;if(e&&e.opts.keyboard&&!n(t.target).is("input")&&!n(t.target).is("textarea"))return 8===i||27===i?(t.preventDefault(),void o.close(t)):37===i||38===i?(t.preventDefault(),void o.previous()):39===i||40===i?(t.preventDefault(),void o.next()):void o.trigger("afterKeydown",t,i)}),o.group[o.currIndex].opts.idleTime&&(o.idleSecondsCounter=0,r.on("mousemove.fb-idle mouseenter.fb-idle mouseleave.fb-idle mousedown.fb-idle touchstart.fb-idle touchmove.fb-idle scroll.fb-idle keydown.fb-idle",function(){o.idleSecondsCounter=0,o.isIdle&&o.showControls(),o.isIdle=!1}),o.idleInterval=t.setInterval(function(){o.idleSecondsCounter++,o.idleSecondsCounter>=o.group[o.currIndex].opts.idleTime&&(o.isIdle=!0,o.idleSecondsCounter=0,o.hideControls())},1e3))},removeEvents:function(){var e=this;s.off("orientationchange.fb resize.fb"),r.off("focusin.fb keydown.fb .fb-idle"),this.$refs.container.off(".fb-close .fb-prev .fb-next"),e.idleInterval&&(t.clearInterval(e.idleInterval),e.idleInterval=null)},previous:function(t){return this.jumpTo(this.currPos-1,t)},next:function(t){return this.jumpTo(this.currPos+1,t)},jumpTo:function(t,e,i){var a,s,r,c,l,u,d,h=this,p=h.group.length;if(!(h.isSliding||h.isClosing||h.isAnimating&&h.firstRun)){if(t=parseInt(t,10),s=h.current?h.current.opts.loop:h.opts.loop,!s&&(t<0||t>=p))return!1;if(a=h.firstRun=null===h.firstRun,!(p<2&&!a&&h.isSliding)){if(c=h.current,h.prevIndex=h.currIndex,h.prevPos=h.currPos,r=h.createSlide(t),p>1&&((s||r.index>0)&&h.createSlide(t-1),(s||r.index<p-1)&&h.createSlide(t+1)),h.current=r,h.currIndex=r.index,h.currPos=r.pos,h.trigger("beforeShow",a),h.updateControls(),u=n.fancybox.getTranslate(r.$slide),r.isMoved=(0!==u.left||0!==u.top)&&!r.$slide.hasClass("fancybox-animated"),r.forcedDuration=o,n.isNumeric(e)?r.forcedDuration=e:e=r.opts[a?"animationDuration":"transitionDuration"],e=parseInt(e,10),a)return r.opts.animationEffect&&e&&h.$refs.container.css("transition-duration",e+"ms"),h.$refs.container.removeClass("fancybox-is-hidden"),f(h.$refs.container),h.$refs.container.addClass("fancybox-is-open"),r.$slide.addClass("fancybox-slide--current"),h.loadSlide(r),void h.preload();n.each(h.slides,function(t,e){n.fancybox.stop(e.$slide)}),r.$slide.removeClass("fancybox-slide--next fancybox-slide--previous").addClass("fancybox-slide--current"),r.isMoved?(l=Math.round(r.$slide.width()),n.each(h.slides,function(t,o){var i=o.pos-r.pos;n.fancybox.animate(o.$slide,{top:0,left:i*l+i*o.opts.gutter},e,function(){o.$slide.removeAttr("style").removeClass("fancybox-slide--next fancybox-slide--previous"),o.pos===h.currPos&&(r.isMoved=!1,h.complete())})})):h.$refs.stage.children().removeAttr("style"),r.isLoaded?h.revealContent(r):h.loadSlide(r),h.preload(),c.pos!==r.pos&&(d="fancybox-slide--"+(c.pos>r.pos?"next":"previous"),c.$slide.removeClass("fancybox-slide--complete fancybox-slide--current fancybox-slide--next fancybox-slide--previous"),c.isComplete=!1,e&&(r.isMoved||r.opts.transitionEffect)&&(r.isMoved?c.$slide.addClass(d):(d="fancybox-animated "+d+" fancybox-fx-"+r.opts.transitionEffect,n.fancybox.animate(c.$slide,d,e,function(){c.$slide.removeClass(d).removeAttr("style")}))))}}},createSlide:function(t){var e,o,i=this;return o=t%i.group.length,o=o<0?i.group.length+o:o,!i.slides[t]&&i.group[o]&&(e=n('<div class="fancybox-slide"></div>').appendTo(i.$refs.stage),i.slides[t]=n.extend(!0,{},i.group[o],{pos:t,$slide:e,isLoaded:!1}),i.updateSlide(i.slides[t])),i.slides[t]},scaleToActual:function(t,e,i){var a,s,r,c,l,u=this,d=u.current,f=d.$content,h=parseInt(d.$slide.width(),10),p=parseInt(d.$slide.height(),10),g=d.width,b=d.height;"image"!=d.type||d.hasError||!f||u.isAnimating||(n.fancybox.stop(f),u.isAnimating=!0,t=t===o?.5*h:t,e=e===o?.5*p:e,a=n.fancybox.getTranslate(f),c=g/a.width,l=b/a.height,s=.5*h-.5*g,r=.5*p-.5*b,g>h&&(s=a.left*c-(t*c-t),s>0&&(s=0),s<h-g&&(s=h-g)),b>p&&(r=a.top*l-(e*l-e),r>0&&(r=0),r<p-b&&(r=p-b)),u.updateCursor(g,b),n.fancybox.animate(f,{top:r,left:s,scaleX:c,scaleY:l},i||330,function(){u.isAnimating=!1}),u.SlideShow&&u.SlideShow.isActive&&u.SlideShow.stop())},scaleToFit:function(t){var e,o=this,i=o.current,a=i.$content;"image"!=i.type||i.hasError||!a||o.isAnimating||(n.fancybox.stop(a),o.isAnimating=!0,e=o.getFitPos(i),o.updateCursor(e.width,e.height),n.fancybox.animate(a,{top:e.top,left:e.left,scaleX:e.width/a.width(),scaleY:e.height/a.height()},t||330,function(){o.isAnimating=!1}))},getFitPos:function(t){var e,o,i,a,r,c=this,l=t.$content,u=t.width,d=t.height,f=t.opts.margin;return!(!l||!l.length||!u&&!d)&&("number"===n.type(f)&&(f=[f,f]),2==f.length&&(f=[f[0],f[1],f[0],f[1]]),s.width()<800&&(f=[0,0,0,0]),e=parseInt(c.$refs.stage.width(),10)-(f[1]+f[3]),o=parseInt(c.$refs.stage.height(),10)-(f[0]+f[2]),i=Math.min(1,e/u,o/d),a=Math.floor(i*u),r=Math.floor(i*d),{top:Math.floor(.5*(o-r))+f[0],left:Math.floor(.5*(e-a))+f[3],width:a,height:r})},update:function(){var t=this;n.each(t.slides,function(e,n){t.updateSlide(n)})},updateSlide:function(t){var e=this,o=t.$content;o&&(t.width||t.height)&&(n.fancybox.stop(o),n.fancybox.setTranslate(o,e.getFitPos(t)),t.pos===e.currPos&&e.updateCursor()),t.$slide.trigger("refresh"),e.trigger("onUpdate",t)},updateCursor:function(t,e){var n,i=this,a=i.$refs.container.removeClass("fancybox-is-zoomable fancybox-can-zoomIn fancybox-can-drag fancybox-can-zoomOut");i.current&&!i.isClosing&&(i.isZoomable()?(a.addClass("fancybox-is-zoomable"),n=t!==o&&e!==o?t<i.current.width&&e<i.current.height:i.isScaledDown(),n?a.addClass("fancybox-can-zoomIn"):i.current.opts.touch?a.addClass("fancybox-can-drag"):a.addClass("fancybox-can-zoomOut")):i.current.opts.touch&&a.addClass("fancybox-can-drag"))},isZoomable:function(){var t,e=this,o=e.current;if(o&&!e.isClosing)return!!("image"===o.type&&o.isLoaded&&!o.hasError&&("zoom"===o.opts.clickContent||n.isFunction(o.opts.clickContent)&&"zoom"===o.opts.clickContent(o))&&(t=e.getFitPos(o),o.width>t.width||o.height>t.height))},isScaledDown:function(){var t=this,e=t.current,o=e.$content,i=!1;return o&&(i=n.fancybox.getTranslate(o),i=i.width<e.width||i.height<e.height),i},canPan:function(){var t=this,e=t.current,n=e.$content,o=!1;return n&&(o=t.getFitPos(e),o=Math.abs(n.width()-o.width)>1||Math.abs(n.height()-o.height)>1),o},loadSlide:function(t){var e,o,i,a=this;if(!t.isLoading&&!t.isLoaded){switch(t.isLoading=!0,a.trigger("beforeLoad",t),e=t.type,o=t.$slide,o.off("refresh").trigger("onReset").addClass("fancybox-slide--"+(e||"unknown")).addClass(t.opts.slideClass),e){case"image":a.setImage(t);break;case"iframe":a.setIframe(t);break;case"html":a.setContent(t,t.src||t.content);break;case"inline":n(t.src).length?a.setContent(t,n(t.src)):a.setError(t);break;case"ajax":a.showLoading(t),i=n.ajax(n.extend({},t.opts.ajax.settings,{url:t.src,success:function(e,n){"success"===n&&a.setContent(t,e)},error:function(e,n){e&&"abort"!==n&&a.setError(t)}})),o.one("onReset",function(){i.abort()});break;default:a.setError(t)}return!0}},setImage:function(e){var o,i,a,s,r=this,c=e.opts.image.srcset;if(c){a=t.devicePixelRatio||1,s=t.innerWidth*a,i=c.split(",").map(function(t){var e={};return t.trim().split(/\s+/).forEach(function(t,n){var o=parseInt(t.substring(0,t.length-1),10);return 0===n?e.url=t:void(o&&(e.value=o,e.postfix=t[t.length-1]))}),e}),i.sort(function(t,e){return t.value-e.value});for(var l=0;l<i.length;l++){var u=i[l];if("w"===u.postfix&&u.value>=s||"x"===u.postfix&&u.value>=a){o=u;break}}!o&&i.length&&(o=i[i.length-1]),o&&(e.src=o.url,e.width&&e.height&&"w"==o.postfix&&(e.height=e.width/e.height*o.value,e.width=o.value))}e.$content=n('<div class="fancybox-image-wrap"></div>').addClass("fancybox-is-hidden").appendTo(e.$slide),e.opts.preload!==!1&&e.opts.width&&e.opts.height&&(e.opts.thumb||e.opts.$thumb)?(e.width=e.opts.width,e.height=e.opts.height,e.$ghost=n("<img />").one("error",function(){n(this).remove(),e.$ghost=null,r.setBigImage(e)}).one("load",function(){r.afterLoad(e),r.setBigImage(e)}).addClass("fancybox-image").appendTo(e.$content).attr("src",e.opts.thumb||e.opts.$thumb.attr("src"))):r.setBigImage(e)},setBigImage:function(t){var e=this,o=n("<img />");t.$image=o.one("error",function(){e.setError(t)}).one("load",function(){clearTimeout(t.timouts),t.timouts=null,e.isClosing||(t.width=this.naturalWidth,t.height=this.naturalHeight,t.opts.image.srcset&&o.attr("sizes","100vw").attr("srcset",t.opts.image.srcset),e.hideLoading(t),t.$ghost?t.timouts=setTimeout(function(){t.timouts=null,t.$ghost.hide()},Math.min(300,Math.max(1e3,t.height/1600))):e.afterLoad(t))}).addClass("fancybox-image").attr("src",t.src).appendTo(t.$content),o[0].complete?o.trigger("load"):o[0].error?o.trigger("error"):t.timouts=setTimeout(function(){o[0].complete||t.hasError||e.showLoading(t)},100)},setIframe:function(t){var e,i=this,a=t.opts.iframe,s=t.$slide;t.$content=n('<div class="fancybox-content'+(a.preload?" fancybox-is-hidden":"")+'"></div>').css(a.css).appendTo(s),e=n(a.tpl.replace(/\{rnd\}/g,(new Date).getTime())).attr(a.attr).appendTo(t.$content),a.preload?(i.showLoading(t),e.on("load.fb error.fb",function(e){this.isReady=1,t.$slide.trigger("refresh"),i.afterLoad(t)}),s.on("refresh.fb",function(){var n,i,s,r,c,l=t.$content;if(1===e[0].isReady){try{n=e.contents(),i=n.find("body")}catch(t){}i&&i.length&&(a.css.width===o||a.css.height===o)&&(s=e[0].contentWindow.document.documentElement.scrollWidth,r=Math.ceil(i.outerWidth(!0)+(l.width()-s)),c=Math.ceil(i.outerHeight(!0)),l.css({width:a.css.width===o?r+(l.outerWidth()-l.innerWidth()):a.css.width,height:a.css.height===o?c+(l.outerHeight()-l.innerHeight()):a.css.height})),l.removeClass("fancybox-is-hidden")}})):this.afterLoad(t),e.attr("src",t.src),t.opts.smallBtn===!0&&t.$content.prepend(i.translate(t,t.opts.btnTpl.smallBtn)),s.one("onReset",function(){try{n(this).find("iframe").hide().attr("src","//about:blank")}catch(t){}n(this).empty(),t.isLoaded=!1})},setContent:function(t,e){var o=this;o.isClosing||(o.hideLoading(t),t.$slide.empty(),l(e)&&e.parent().length?(e.parent(".fancybox-slide--inline").trigger("onReset"),t.$placeholder=n("<div></div>").hide().insertAfter(e),e.css("display","inline-block")):t.hasError||("string"===n.type(e)&&(e=n("<div>").append(n.trim(e)).contents(),3===e[0].nodeType&&(e=n("<div>").html(e))),t.opts.filter&&(e=n("<div>").html(e).find(t.opts.filter))),t.$slide.one("onReset",function(){t.$placeholder&&(t.$placeholder.after(e.hide()).remove(),t.$placeholder=null),t.$smallBtn&&(t.$smallBtn.remove(),t.$smallBtn=null),t.hasError||(n(this).empty(),t.isLoaded=!1)}),t.$content=n(e).appendTo(t.$slide),t.opts.smallBtn&&!t.$smallBtn&&(t.$smallBtn=n(o.translate(t,t.opts.btnTpl.smallBtn)).appendTo(t.$content)),this.afterLoad(t))},setError:function(t){t.hasError=!0,t.$slide.removeClass("fancybox-slide--"+t.type),this.setContent(t,this.translate(t,t.opts.errorTpl))},showLoading:function(t){var e=this;t=t||e.current,t&&!t.$spinner&&(t.$spinner=n(e.opts.spinnerTpl).appendTo(t.$slide))},hideLoading:function(t){var e=this;t=t||e.current,t&&t.$spinner&&(t.$spinner.remove(),delete t.$spinner)},afterLoad:function(t){var e=this;e.isClosing||(t.isLoading=!1,t.isLoaded=!0,e.trigger("afterLoad",t),e.hideLoading(t),t.opts.protect&&t.$content&&!t.hasError&&(t.$content.on("contextmenu.fb",function(t){return 2==t.button&&t.preventDefault(),!0}),"image"===t.type&&n('<div class="fancybox-spaceball"></div>').appendTo(t.$content)),e.revealContent(t))},revealContent:function(t){var e,i,a,s,r,c=this,l=t.$slide,u=!1;return e=t.opts[c.firstRun?"animationEffect":"transitionEffect"],a=t.opts[c.firstRun?"animationDuration":"transitionDuration"],a=parseInt(t.forcedDuration===o?a:t.forcedDuration,10),!t.isMoved&&t.pos===c.currPos&&a||(e=!1),"zoom"!==e||t.pos===c.currPos&&a&&"image"===t.type&&!t.hasError&&(u=c.getThumbPos(t))||(e="fade"),"zoom"===e?(r=c.getFitPos(t),r.scaleX=Math.round(r.width/u.width*100)/100,r.scaleY=Math.round(r.height/u.height*100)/100,delete r.width,delete r.height,s=t.opts.zoomOpacity,"auto"==s&&(s=Math.abs(t.width/t.height-u.width/u.height)>.1),s&&(u.opacity=.1,r.opacity=1),n.fancybox.setTranslate(t.$content.removeClass("fancybox-is-hidden"),u),f(t.$content),void n.fancybox.animate(t.$content,r,a,function(){c.complete()})):(c.updateSlide(t),e?(n.fancybox.stop(l),i="fancybox-animated fancybox-slide--"+(t.pos>c.prevPos?"next":"previous")+" fancybox-fx-"+e,l.removeAttr("style").removeClass("fancybox-slide--current fancybox-slide--next fancybox-slide--previous").addClass(i),t.$content.removeClass("fancybox-is-hidden"),f(l),void n.fancybox.animate(l,"fancybox-slide--current",a,function(e){l.removeClass(i).removeAttr("style"),t.pos===c.currPos&&c.complete()},!0)):(f(l),t.$content.removeClass("fancybox-is-hidden"),void(t.pos===c.currPos&&c.complete())))},getThumbPos:function(o){var i,a=this,s=!1,r=function(e){for(var o,i=e[0],a=i.getBoundingClientRect(),s=[];null!==i.parentElement;)"hidden"!==n(i.parentElement).css("overflow")&&"auto"!==n(i.parentElement).css("overflow")||s.push(i.parentElement.getBoundingClientRect()),i=i.parentElement;return o=s.every(function(t){var e=Math.min(a.right,t.right)-Math.max(a.left,t.left),n=Math.min(a.bottom,t.bottom)-Math.max(a.top,t.top);return e>0&&n>0}),o&&a.bottom>0&&a.right>0&&a.left<n(t).width()&&a.top<n(t).height()},c=o.opts.$thumb,l=c?c.offset():0;return l&&c[0].ownerDocument===e&&r(c)&&(i=a.$refs.stage.offset(),s={top:l.top-i.top+parseFloat(c.css("border-top-width")||0),left:l.left-i.left+parseFloat(c.css("border-left-width")||0),width:c.width(),height:c.height(),scaleX:1,scaleY:1}),s},complete:function(){var t=this,o=t.current,i={};o.isMoved||!o.isLoaded||o.isComplete||(o.isComplete=!0,o.$slide.siblings().trigger("onReset"),f(o.$slide),o.$slide.addClass("fancybox-slide--complete"),n.each(t.slides,function(e,o){o.pos>=t.currPos-1&&o.pos<=t.currPos+1?i[o.pos]=o:o&&(n.fancybox.stop(o.$slide),o.$slide.unbind().remove())}),t.slides=i,t.updateCursor(),t.trigger("afterShow"),(n(e.activeElement).is("[disabled]")||o.opts.autoFocus&&"image"!=o.type&&"iframe"!==o.type)&&t.focus())},preload:function(){var t,e,n=this;n.group.length<2||(t=n.slides[n.currPos+1],e=n.slides[n.currPos-1],t&&"image"===t.type&&n.loadSlide(t),e&&"image"===e.type&&n.loadSlide(e))},focus:function(){var t,e=this.current;this.isClosing||(t=e&&e.isComplete?e.$slide.find("button,:input,[tabindex],a").filter(":not([disabled]):visible:first"):null,t=t&&t.length?t:this.$refs.container,t.focus())},activate:function(){var t=this;n(".fancybox-container").each(function(){var e=n(this).data("FancyBox");e&&e.uid!==t.uid&&!e.isClosing&&e.trigger("onDeactivate")}),t.current&&(t.$refs.container.index()>0&&t.$refs.container.prependTo(e.body),t.updateControls()),t.trigger("onActivate"),t.addEvents()},close:function(t,e){var o,i,a,s,r,c,l=this,f=l.current,h=function(){l.cleanUp(t)};return!l.isClosing&&(l.isClosing=!0,l.trigger("beforeClose",t)===!1?(l.isClosing=!1,u(function(){l.update()}),!1):(l.removeEvents(),f.timouts&&clearTimeout(f.timouts),a=f.$content,o=f.opts.animationEffect,i=n.isNumeric(e)?e:o?f.opts.animationDuration:0,f.$slide.off(d).removeClass("fancybox-slide--complete fancybox-slide--next fancybox-slide--previous fancybox-animated"),f.$slide.siblings().trigger("onReset").remove(),i&&l.$refs.container.removeClass("fancybox-is-open").addClass("fancybox-is-closing"),l.hideLoading(f),l.hideControls(),l.updateCursor(),"zoom"!==o||t!==!0&&a&&i&&"image"===f.type&&!f.hasError&&(c=l.getThumbPos(f))||(o="fade"),"zoom"===o?(n.fancybox.stop(a),r=n.fancybox.getTranslate(a),r.width=r.width*r.scaleX,r.height=r.height*r.scaleY,s=f.opts.zoomOpacity,"auto"==s&&(s=Math.abs(f.width/f.height-c.width/c.height)>.1),s&&(c.opacity=0),r.scaleX=r.width/c.width,r.scaleY=r.height/c.height,r.width=c.width,r.height=c.height,n.fancybox.setTranslate(f.$content,r),n.fancybox.animate(f.$content,c,i,h),!0):(o&&i?t===!0?setTimeout(h,i):n.fancybox.animate(f.$slide.removeClass("fancybox-slide--current"),"fancybox-animated fancybox-slide--previous fancybox-fx-"+o,i,h):h(),!0)))},cleanUp:function(t){var e,o=this;o.current.$slide.trigger("onReset"),o.$refs.container.empty().remove(),o.trigger("afterClose",t),o.$lastFocus&&!o.current.focusBack&&o.$lastFocus.focus(),o.current=null,e=n.fancybox.getInstance(),e?e.activate():(s.scrollTop(o.scrollTop).scrollLeft(o.scrollLeft),n("html").removeClass("fancybox-enabled"),n("#fancybox-style-noscroll").remove())},trigger:function(t,e){var o,i=Array.prototype.slice.call(arguments,1),a=this,s=e&&e.opts?e:a.current;return s?i.unshift(s):s=a,i.unshift(a),n.isFunction(s.opts[t])&&(o=s.opts[t].apply(s,i)),o===!1?o:void("afterClose"===t?r.trigger(t+".fb",i):a.$refs.container.trigger(t+".fb",i))},updateControls:function(t){var e=this,o=e.current,i=o.index,a=o.opts,s=a.caption,r=e.$refs.caption;o.$slide.trigger("refresh"),e.$caption=s&&s.length?r.html(s):null,e.isHiddenControls||e.showControls(),n("[data-fancybox-count]").html(e.group.length),n("[data-fancybox-index]").html(i+1),n("[data-fancybox-prev]").prop("disabled",!a.loop&&i<=0),n("[data-fancybox-next]").prop("disabled",!a.loop&&i>=e.group.length-1)},hideControls:function(){this.isHiddenControls=!0,this.$refs.container.removeClass("fancybox-show-infobar fancybox-show-toolbar fancybox-show-caption fancybox-show-nav")},showControls:function(){var t=this,e=t.current?t.current.opts:t.opts,n=t.$refs.container;t.isHiddenControls=!1,t.idleSecondsCounter=0,n.toggleClass("fancybox-show-toolbar",!(!e.toolbar||!e.buttons)).toggleClass("fancybox-show-infobar",!!(e.infobar&&t.group.length>1)).toggleClass("fancybox-show-nav",!!(e.arrows&&t.group.length>1)).toggleClass("fancybox-is-modal",!!e.modal),t.$caption?n.addClass("fancybox-show-caption "):n.removeClass("fancybox-show-caption")},toggleControls:function(){this.isHiddenControls?this.showControls():this.hideControls()}}),n.fancybox={version:"3.1.20",defaults:a,getInstance:function(t){var e=n('.fancybox-container:not(".fancybox-is-closing"):first').data("FancyBox"),o=Array.prototype.slice.call(arguments,1);return e instanceof h&&("string"===n.type(t)?e[t].apply(e,o):"function"===n.type(t)&&t.apply(e,o),e)},open:function(t,e,n){return new h(t,e,n)},close:function(t){var e=this.getInstance();e&&(e.close(),t===!0&&this.close())},destroy:function(){this.close(!0),r.off("click.fb-start")},isMobile:e.createTouch!==o&&/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent),use3d:function(){var n=e.createElement("div");return t.getComputedStyle&&t.getComputedStyle(n).getPropertyValue("transform")&&!(e.documentMode&&e.documentMode<11)}(),getTranslate:function(t){var e;if(!t||!t.length)return!1;if(e=t.eq(0).css("transform"),e&&e.indexOf("matrix")!==-1?(e=e.split("(")[1],e=e.split(")")[0],e=e.split(",")):e=[],e.length)e=e.length>10?[e[13],e[12],e[0],e[5]]:[e[5],e[4],e[0],e[3]],e=e.map(parseFloat);else{e=[0,0,1,1];var n=/\.*translate\((.*)px,(.*)px\)/i,o=n.exec(t.eq(0).attr("style"));o&&(e[0]=parseFloat(o[2]),e[1]=parseFloat(o[1]))}return{top:e[0],left:e[1],scaleX:e[2],scaleY:e[3],opacity:parseFloat(t.css("opacity")),width:t.width(),height:t.height()}},setTranslate:function(t,e){var n="",i={};if(t&&e)return e.left===o&&e.top===o||(n=(e.left===o?t.position().left:e.left)+"px, "+(e.top===o?t.position().top:e.top)+"px",n=this.use3d?"translate3d("+n+", 0px)":"translate("+n+")"),e.scaleX!==o&&e.scaleY!==o&&(n=(n.length?n+" ":"")+"scale("+e.scaleX+", "+e.scaleY+")"),n.length&&(i.transform=n),e.opacity!==o&&(i.opacity=e.opacity),e.width!==o&&(i.width=e.width),e.height!==o&&(i.height=e.height),t.css(i)},animate:function(t,e,i,a,s){var r=d||"transitionend";n.isFunction(i)&&(a=i,i=null),n.isPlainObject(e)||t.removeAttr("style"),t.on(r,function(i){(!i||!i.originalEvent||t.is(i.originalEvent.target)&&"z-index"!=i.originalEvent.propertyName)&&(t.off(r),n.isPlainObject(e)?e.scaleX!==o&&e.scaleY!==o&&(t.css("transition-duration","0ms"),e.width=t.width()*e.scaleX,e.height=t.height()*e.scaleY,e.scaleX=1,e.scaleY=1,n.fancybox.setTranslate(t,e)):s!==!0&&t.removeClass(e),n.isFunction(a)&&a(i))}),n.isNumeric(i)&&t.css("transition-duration",i+"ms"),n.isPlainObject(e)?n.fancybox.setTranslate(t,e):t.addClass(e),t.data("timer",setTimeout(function(){t.trigger("transitionend")},i+16))},stop:function(t){clearTimeout(t.data("timer")),t.off(d)}},n.fn.fancybox=function(t){var e;return t=t||{},e=t.selector||!1,e?n("body").off("click.fb-start",e).on("click.fb-start",e,{items:n(e),options:t},i):this.off("click.fb-start").on("click.fb-start",{items:this,options:t},i),this},r.on("click.fb-start","[data-fancybox]",i)}}(window,document,window.jQuery),function(t){"use strict";var e=function(e,n,o){if(e)return o=o||"","object"===t.type(o)&&(o=t.param(o,!0)),t.each(n,function(t,n){e=e.replace("$"+t,n||"")}),o.length&&(e+=(e.indexOf("?")>0?"&":"?")+o),e},n={youtube:{matcher:/(youtube\.com|youtu\.be|youtube\-nocookie\.com)\/(watch\?(.*&)?v=|v\/|u\/|embed\/?)?(videoseries\?list=(.*)|[\w-]{11}|\?listType=(.*)&list=(.*))(.*)/i,params:{autoplay:1,autohide:1,fs:1,rel:0,hd:1,wmode:"transparent",enablejsapi:1,html5:1},paramPlace:8,type:"iframe",url:"//www.youtube.com/embed/$4",thumb:"//img.youtube.com/vi/$4/hqdefault.jpg"},vimeo:{matcher:/^.+vimeo.com\/(.*\/)?([\d]+)(.*)?/,params:{autoplay:1,hd:1,show_title:1,show_byline:1,show_portrait:0,fullscreen:1,api:1},paramPlace:3,type:"iframe",url:"//player.vimeo.com/video/$2"},metacafe:{matcher:/metacafe.com\/watch\/(\d+)\/(.*)?/,type:"iframe",url:"//www.metacafe.com/embed/$1/?ap=1"},dailymotion:{matcher:/dailymotion.com\/video\/(.*)\/?(.*)/,params:{additionalInfos:0,autoStart:1},type:"iframe",url:"//www.dailymotion.com/embed/video/$1"},vine:{matcher:/vine.co\/v\/([a-zA-Z0-9\?\=\-]+)/,type:"iframe",url:"//vine.co/v/$1/embed/simple"},instagram:{matcher:/(instagr\.am|instagram\.com)\/p\/([a-zA-Z0-9_\-]+)\/?/i,type:"image",url:"//$1/p/$2/media/?size=l"},google_maps:{matcher:/(maps\.)?google\.([a-z]{2,3}(\.[a-z]{2})?)\/(((maps\/(place\/(.*)\/)?\@(.*),(\d+.?\d+?)z))|(\?ll=))(.*)?/i,type:"iframe",url:function(t){return"//maps.google."+t[2]+"/?ll="+(t[9]?t[9]+"&z="+Math.floor(t[10])+(t[12]?t[12].replace(/^\//,"&"):""):t[12])+"&output="+(t[12]&&t[12].indexOf("layer=c")>0?"svembed":"embed")}}};t(document).on("onInit.fb",function(o,i){t.each(i.group,function(o,i){var a,s,r,c,l,u,d,f=i.src||"",h=!1;i.type||(a=t.extend(!0,{},n,i.opts.media),t.each(a,function(n,o){if(r=f.match(o.matcher),u={},d=n,r){if(h=o.type,o.paramPlace&&r[o.paramPlace]){l=r[o.paramPlace],"?"==l[0]&&(l=l.substring(1)),l=l.split("&");for(var a=0;a<l.length;++a){var p=l[a].split("=",2);2==p.length&&(u[p[0]]=decodeURIComponent(p[1].replace(/\+/g," ")))}}return c=t.extend(!0,{},o.params,i.opts[n],u),f="function"===t.type(o.url)?o.url.call(this,r,c,i):e(o.url,r,c),s="function"===t.type(o.thumb)?o.thumb.call(this,r,c,i):e(o.thumb,r),"vimeo"===d&&(f=f.replace("&%23","#")),!1}}),h?(i.src=f,i.type=h,i.opts.thumb||i.opts.$thumb&&i.opts.$thumb.length||(i.opts.thumb=s),"iframe"===h&&(t.extend(!0,i.opts,{iframe:{preload:!1,attr:{scrolling:"no"}}}),i.contentProvider=d,i.opts.slideClass+=" fancybox-slide--"+("google_maps"==d?"map":"video"))):i.type="image")})})}(window.jQuery),function(t,e,n){"use strict";var o=function(){return t.requestAnimationFrame||t.webkitRequestAnimationFrame||t.mozRequestAnimationFrame||t.oRequestAnimationFrame||function(e){
return t.setTimeout(e,1e3/60)}}(),i=function(){return t.cancelAnimationFrame||t.webkitCancelAnimationFrame||t.mozCancelAnimationFrame||t.oCancelAnimationFrame||function(e){t.clearTimeout(e)}}(),a=function(e){var n=[];e=e.originalEvent||e||t.e,e=e.touches&&e.touches.length?e.touches:e.changedTouches&&e.changedTouches.length?e.changedTouches:[e];for(var o in e)e[o].pageX?n.push({x:e[o].pageX,y:e[o].pageY}):e[o].clientX&&n.push({x:e[o].clientX,y:e[o].clientY});return n},s=function(t,e,n){return e&&t?"x"===n?t.x-e.x:"y"===n?t.y-e.y:Math.sqrt(Math.pow(t.x-e.x,2)+Math.pow(t.y-e.y,2)):0},r=function(t){if(t.is("a,button,input,select,textarea")||n.isFunction(t.get(0).onclick))return!0;for(var e=0,o=t[0].attributes,i=o.length;e<i;e++)if("data-fancybox-"===o[e].nodeName.substr(0,14))return!0;return!1},c=function(e){var n=t.getComputedStyle(e)["overflow-y"],o=t.getComputedStyle(e)["overflow-x"],i=("scroll"===n||"auto"===n)&&e.scrollHeight>e.clientHeight,a=("scroll"===o||"auto"===o)&&e.scrollWidth>e.clientWidth;return i||a},l=function(t){for(var e=!1;;){if(e=c(t.get(0)))break;if(t=t.parent(),!t.length||t.hasClass("fancybox-stage")||t.is("body"))break}return e},u=function(t){var e=this;e.instance=t,e.$bg=t.$refs.bg,e.$stage=t.$refs.stage,e.$container=t.$refs.container,e.destroy(),e.$container.on("touchstart.fb.touch mousedown.fb.touch",n.proxy(e,"ontouchstart"))};u.prototype.destroy=function(){this.$container.off(".fb.touch")},u.prototype.ontouchstart=function(o){var i=this,c=n(o.target),u=i.instance,d=u.current,f=d.$content,h="touchstart"==o.type;if(h&&i.$container.off("mousedown.fb.touch"),!d||i.instance.isAnimating||i.instance.isClosing)return o.stopPropagation(),void o.preventDefault();if((!o.originalEvent||2!=o.originalEvent.button)&&c.length&&!r(c)&&!r(c.parent())&&!(o.originalEvent.clientX>c[0].clientWidth+c.offset().left)&&(i.startPoints=a(o),i.startPoints&&!(i.startPoints.length>1&&u.isSliding))){if(i.$target=c,i.$content=f,i.canTap=!0,n(e).off(".fb.touch"),n(e).on(h?"touchend.fb.touch touchcancel.fb.touch":"mouseup.fb.touch mouseleave.fb.touch",n.proxy(i,"ontouchend")),n(e).on(h?"touchmove.fb.touch":"mousemove.fb.touch",n.proxy(i,"ontouchmove")),o.stopPropagation(),!u.current.opts.touch&&!u.canPan()||!c.is(i.$stage)&&!i.$stage.find(c).length)return void(c.is("img")&&o.preventDefault());n.fancybox.isMobile&&(l(i.$target)||l(i.$target.parent()))||o.preventDefault(),i.canvasWidth=Math.round(d.$slide[0].clientWidth),i.canvasHeight=Math.round(d.$slide[0].clientHeight),i.startTime=(new Date).getTime(),i.distanceX=i.distanceY=i.distance=0,i.isPanning=!1,i.isSwiping=!1,i.isZooming=!1,i.sliderStartPos=i.sliderLastPos||{top:0,left:0},i.contentStartPos=n.fancybox.getTranslate(i.$content),i.contentLastPos=null,1!==i.startPoints.length||i.isZooming||(i.canTap=!u.isSliding,"image"===d.type&&(i.contentStartPos.width>i.canvasWidth+1||i.contentStartPos.height>i.canvasHeight+1)?(n.fancybox.stop(i.$content),i.$content.css("transition-duration","0ms"),i.isPanning=!0):i.isSwiping=!0,i.$container.addClass("fancybox-controls--isGrabbing")),2!==i.startPoints.length||u.isAnimating||d.hasError||"image"!==d.type||!d.isLoaded&&!d.$ghost||(i.isZooming=!0,i.isSwiping=!1,i.isPanning=!1,n.fancybox.stop(i.$content),i.$content.css("transition-duration","0ms"),i.centerPointStartX=.5*(i.startPoints[0].x+i.startPoints[1].x)-n(t).scrollLeft(),i.centerPointStartY=.5*(i.startPoints[0].y+i.startPoints[1].y)-n(t).scrollTop(),i.percentageOfImageAtPinchPointX=(i.centerPointStartX-i.contentStartPos.left)/i.contentStartPos.width,i.percentageOfImageAtPinchPointY=(i.centerPointStartY-i.contentStartPos.top)/i.contentStartPos.height,i.startDistanceBetweenFingers=s(i.startPoints[0],i.startPoints[1]))}},u.prototype.ontouchmove=function(t){var e=this;if(e.newPoints=a(t),n.fancybox.isMobile&&(l(e.$target)||l(e.$target.parent())))return t.stopPropagation(),void(e.canTap=!1);if((e.instance.current.opts.touch||e.instance.canPan())&&e.newPoints&&e.newPoints.length&&(e.distanceX=s(e.newPoints[0],e.startPoints[0],"x"),e.distanceY=s(e.newPoints[0],e.startPoints[0],"y"),e.distance=s(e.newPoints[0],e.startPoints[0]),e.distance>0)){if(!e.$target.is(e.$stage)&&!e.$stage.find(e.$target).length)return;t.stopPropagation(),t.preventDefault(),e.isSwiping?e.onSwipe():e.isPanning?e.onPan():e.isZooming&&e.onZoom()}},u.prototype.onSwipe=function(){var e,a=this,s=a.isSwiping,r=a.sliderStartPos.left||0;s===!0?Math.abs(a.distance)>10&&(a.canTap=!1,a.instance.group.length<2&&a.instance.opts.touch.vertical?a.isSwiping="y":a.instance.isSliding||a.instance.opts.touch.vertical===!1||"auto"===a.instance.opts.touch.vertical&&n(t).width()>800?a.isSwiping="x":(e=Math.abs(180*Math.atan2(a.distanceY,a.distanceX)/Math.PI),a.isSwiping=e>45&&e<135?"y":"x"),a.instance.isSliding=a.isSwiping,a.startPoints=a.newPoints,n.each(a.instance.slides,function(t,e){n.fancybox.stop(e.$slide),e.$slide.css("transition-duration","0ms"),e.inTransition=!1,e.pos===a.instance.current.pos&&(a.sliderStartPos.left=n.fancybox.getTranslate(e.$slide).left)}),a.instance.SlideShow&&a.instance.SlideShow.isActive&&a.instance.SlideShow.stop()):("x"==s&&(a.distanceX>0&&(a.instance.group.length<2||0===a.instance.current.index&&!a.instance.current.opts.loop)?r+=Math.pow(a.distanceX,.8):a.distanceX<0&&(a.instance.group.length<2||a.instance.current.index===a.instance.group.length-1&&!a.instance.current.opts.loop)?r-=Math.pow(-a.distanceX,.8):r+=a.distanceX),a.sliderLastPos={top:"x"==s?0:a.sliderStartPos.top+a.distanceY,left:r},a.requestId&&(i(a.requestId),a.requestId=null),a.requestId=o(function(){a.sliderLastPos&&(n.each(a.instance.slides,function(t,e){var o=e.pos-a.instance.currPos;n.fancybox.setTranslate(e.$slide,{top:a.sliderLastPos.top,left:a.sliderLastPos.left+o*a.canvasWidth+o*e.opts.gutter})}),a.$container.addClass("fancybox-is-sliding"))}))},u.prototype.onPan=function(){var t,e,a,s=this;s.canTap=!1,t=s.contentStartPos.width>s.canvasWidth?s.contentStartPos.left+s.distanceX:s.contentStartPos.left,e=s.contentStartPos.top+s.distanceY,a=s.limitMovement(t,e,s.contentStartPos.width,s.contentStartPos.height),a.scaleX=s.contentStartPos.scaleX,a.scaleY=s.contentStartPos.scaleY,s.contentLastPos=a,s.requestId&&(i(s.requestId),s.requestId=null),s.requestId=o(function(){n.fancybox.setTranslate(s.$content,s.contentLastPos)})},u.prototype.limitMovement=function(t,e,n,o){var i,a,s,r,c=this,l=c.canvasWidth,u=c.canvasHeight,d=c.contentStartPos.left,f=c.contentStartPos.top,h=c.distanceX,p=c.distanceY;return i=Math.max(0,.5*l-.5*n),a=Math.max(0,.5*u-.5*o),s=Math.min(l-n,.5*l-.5*n),r=Math.min(u-o,.5*u-.5*o),n>l&&(h>0&&t>i&&(t=i-1+Math.pow(-i+d+h,.8)||0),h<0&&t<s&&(t=s+1-Math.pow(s-d-h,.8)||0)),o>u&&(p>0&&e>a&&(e=a-1+Math.pow(-a+f+p,.8)||0),p<0&&e<r&&(e=r+1-Math.pow(r-f-p,.8)||0)),{top:e,left:t}},u.prototype.limitPosition=function(t,e,n,o){var i=this,a=i.canvasWidth,s=i.canvasHeight;return n>a?(t=t>0?0:t,t=t<a-n?a-n:t):t=Math.max(0,a/2-n/2),o>s?(e=e>0?0:e,e=e<s-o?s-o:e):e=Math.max(0,s/2-o/2),{top:e,left:t}},u.prototype.onZoom=function(){var e=this,a=e.contentStartPos.width,r=e.contentStartPos.height,c=e.contentStartPos.left,l=e.contentStartPos.top,u=s(e.newPoints[0],e.newPoints[1]),d=u/e.startDistanceBetweenFingers,f=Math.floor(a*d),h=Math.floor(r*d),p=(a-f)*e.percentageOfImageAtPinchPointX,g=(r-h)*e.percentageOfImageAtPinchPointY,b=(e.newPoints[0].x+e.newPoints[1].x)/2-n(t).scrollLeft(),m=(e.newPoints[0].y+e.newPoints[1].y)/2-n(t).scrollTop(),y=b-e.centerPointStartX,v=m-e.centerPointStartY,x=c+(p+y),w=l+(g+v),$={top:w,left:x,scaleX:e.contentStartPos.scaleX*d,scaleY:e.contentStartPos.scaleY*d};e.canTap=!1,e.newWidth=f,e.newHeight=h,e.contentLastPos=$,e.requestId&&(i(e.requestId),e.requestId=null),e.requestId=o(function(){n.fancybox.setTranslate(e.$content,e.contentLastPos)})},u.prototype.ontouchend=function(t){var o=this,s=Math.max((new Date).getTime()-o.startTime,1),r=o.isSwiping,c=o.isPanning,l=o.isZooming;return o.endPoints=a(t),o.$container.removeClass("fancybox-controls--isGrabbing"),n(e).off(".fb.touch"),o.requestId&&(i(o.requestId),o.requestId=null),o.isSwiping=!1,o.isPanning=!1,o.isZooming=!1,o.canTap?o.onTap(t):(o.speed=366,o.velocityX=o.distanceX/s*.5,o.velocityY=o.distanceY/s*.5,o.speedX=Math.max(.5*o.speed,Math.min(1.5*o.speed,1/Math.abs(o.velocityX)*o.speed)),void(c?o.endPanning():l?o.endZooming():o.endSwiping(r)))},u.prototype.endSwiping=function(t){var e=this,o=!1;e.instance.isSliding=!1,e.sliderLastPos=null,"y"==t&&Math.abs(e.distanceY)>50?(n.fancybox.animate(e.instance.current.$slide,{top:e.sliderStartPos.top+e.distanceY+150*e.velocityY,opacity:0},150),o=e.instance.close(!0,300)):"x"==t&&e.distanceX>50&&e.instance.group.length>1?o=e.instance.previous(e.speedX):"x"==t&&e.distanceX<-50&&e.instance.group.length>1&&(o=e.instance.next(e.speedX)),o!==!1||"x"!=t&&"y"!=t||e.instance.jumpTo(e.instance.current.index,150),e.$container.removeClass("fancybox-is-sliding")},u.prototype.endPanning=function(){var t,e,o,i=this;i.contentLastPos&&(i.instance.current.opts.touch.momentum===!1?(t=i.contentLastPos.left,e=i.contentLastPos.top):(t=i.contentLastPos.left+i.velocityX*i.speed,e=i.contentLastPos.top+i.velocityY*i.speed),o=i.limitPosition(t,e,i.contentStartPos.width,i.contentStartPos.height),o.width=i.contentStartPos.width,o.height=i.contentStartPos.height,n.fancybox.animate(i.$content,o,330))},u.prototype.endZooming=function(){var t,e,o,i,a=this,s=a.instance.current,r=a.newWidth,c=a.newHeight;a.contentLastPos&&(t=a.contentLastPos.left,e=a.contentLastPos.top,i={top:e,left:t,width:r,height:c,scaleX:1,scaleY:1},n.fancybox.setTranslate(a.$content,i),r<a.canvasWidth&&c<a.canvasHeight?a.instance.scaleToFit(150):r>s.width||c>s.height?a.instance.scaleToActual(a.centerPointStartX,a.centerPointStartY,150):(o=a.limitPosition(t,e,r,c),n.fancybox.setTranslate(a.content,n.fancybox.getTranslate(a.$content)),n.fancybox.animate(a.$content,o,150)))},u.prototype.onTap=function(t){var e,o=this,i=n(t.target),s=o.instance,r=s.current,c=t&&a(t)||o.startPoints,l=c[0]?c[0].x-o.$stage.offset().left:0,u=c[0]?c[0].y-o.$stage.offset().top:0,d=function(e){var i=r.opts[e];if(n.isFunction(i)&&(i=i.apply(s,[r,t])),i)switch(i){case"close":s.close(o.startEvent);break;case"toggleControls":s.toggleControls(!0);break;case"next":s.next();break;case"nextOrClose":s.group.length>1?s.next():s.close(o.startEvent);break;case"zoom":"image"==r.type&&(r.isLoaded||r.$ghost)&&(s.canPan()?s.scaleToFit():s.isScaledDown()?s.scaleToActual(l,u):s.group.length<2&&s.close(o.startEvent))}};if(!(t.originalEvent&&2==t.originalEvent.button||s.isSliding||l>i[0].clientWidth+i.offset().left)){if(i.is(".fancybox-bg,.fancybox-inner,.fancybox-outer,.fancybox-container"))e="Outside";else if(i.is(".fancybox-slide"))e="Slide";else{if(!s.current.$content||!s.current.$content.has(t.target).length)return;e="Content"}if(o.tapped){if(clearTimeout(o.tapped),o.tapped=null,Math.abs(l-o.tapX)>50||Math.abs(u-o.tapY)>50||s.isSliding)return this;d("dblclick"+e)}else o.tapX=l,o.tapY=u,r.opts["dblclick"+e]&&r.opts["dblclick"+e]!==r.opts["click"+e]?o.tapped=setTimeout(function(){o.tapped=null,d("click"+e)},300):d("click"+e);return this}},n(e).on("onActivate.fb",function(t,e){e&&!e.Guestures&&(e.Guestures=new u(e))}),n(e).on("beforeClose.fb",function(t,e){e&&e.Guestures&&e.Guestures.destroy()})}(window,document,window.jQuery),function(t,e){"use strict";var n=function(t){this.instance=t,this.init()};e.extend(n.prototype,{timer:null,isActive:!1,$button:null,speed:3e3,init:function(){var t=this;t.$button=t.instance.$refs.toolbar.find("[data-fancybox-play]").on("click",function(){t.toggle()}),(t.instance.group.length<2||!t.instance.group[t.instance.currIndex].opts.slideShow)&&t.$button.hide()},set:function(){var t=this;t.instance&&t.instance.current&&(t.instance.current.opts.loop||t.instance.currIndex<t.instance.group.length-1)?t.timer=setTimeout(function(){t.instance.next()},t.instance.current.opts.slideShow.speed||t.speed):(t.stop(),t.instance.idleSecondsCounter=0,t.instance.showControls())},clear:function(){var t=this;clearTimeout(t.timer),t.timer=null},start:function(){var t=this,e=t.instance.current;t.instance&&e&&(e.opts.loop||e.index<t.instance.group.length-1)&&(t.isActive=!0,t.$button.attr("title",e.opts.i18n[e.opts.lang].PLAY_STOP).addClass("fancybox-button--pause"),e.isComplete&&t.set())},stop:function(){var t=this,e=t.instance.current;t.clear(),t.$button.attr("title",e.opts.i18n[e.opts.lang].PLAY_START).removeClass("fancybox-button--pause"),t.isActive=!1},toggle:function(){var t=this;t.isActive?t.stop():t.start()}}),e(t).on({"onInit.fb":function(t,e){e&&!e.SlideShow&&(e.SlideShow=new n(e))},"beforeShow.fb":function(t,e,n,o){var i=e&&e.SlideShow;o?i&&n.opts.slideShow.autoStart&&i.start():i&&i.isActive&&i.clear()},"afterShow.fb":function(t,e,n){var o=e&&e.SlideShow;o&&o.isActive&&o.set()},"afterKeydown.fb":function(n,o,i,a,s){var r=o&&o.SlideShow;!r||!i.opts.slideShow||80!==s&&32!==s||e(t.activeElement).is("button,a,input")||(a.preventDefault(),r.toggle())},"beforeClose.fb onDeactivate.fb":function(t,e){var n=e&&e.SlideShow;n&&n.stop()}}),e(t).on("visibilitychange",function(){var n=e.fancybox.getInstance(),o=n&&n.SlideShow;o&&o.isActive&&(t.hidden?o.clear():o.set())})}(document,window.jQuery),function(t,e){"use strict";var n=function(){var e,n,o,i=[["requestFullscreen","exitFullscreen","fullscreenElement","fullscreenEnabled","fullscreenchange","fullscreenerror"],["webkitRequestFullscreen","webkitExitFullscreen","webkitFullscreenElement","webkitFullscreenEnabled","webkitfullscreenchange","webkitfullscreenerror"],["webkitRequestFullScreen","webkitCancelFullScreen","webkitCurrentFullScreenElement","webkitCancelFullScreen","webkitfullscreenchange","webkitfullscreenerror"],["mozRequestFullScreen","mozCancelFullScreen","mozFullScreenElement","mozFullScreenEnabled","mozfullscreenchange","mozfullscreenerror"],["msRequestFullscreen","msExitFullscreen","msFullscreenElement","msFullscreenEnabled","MSFullscreenChange","MSFullscreenError"]],a={};for(n=0;n<i.length;n++)if(e=i[n],e&&e[1]in t){for(o=0;o<e.length;o++)a[i[0][o]]=e[o];return a}return!1}();if(!n)return void(e.fancybox.defaults.btnTpl.fullScreen=!1);var o={request:function(e){e=e||t.documentElement,e[n.requestFullscreen](e.ALLOW_KEYBOARD_INPUT)},exit:function(){t[n.exitFullscreen]()},toggle:function(e){e=e||t.documentElement,this.isFullscreen()?this.exit():this.request(e)},isFullscreen:function(){return Boolean(t[n.fullscreenElement])},enabled:function(){return Boolean(t[n.fullscreenEnabled])}};e(t).on({"onInit.fb":function(t,e){var n,i=e.$refs.toolbar.find("[data-fancybox-fullscreen]");e&&!e.FullScreen&&e.group[e.currIndex].opts.fullScreen?(n=e.$refs.container,n.on("click.fb-fullscreen","[data-fancybox-fullscreen]",function(t){t.stopPropagation(),t.preventDefault(),o.toggle(n[0])}),e.opts.fullScreen&&e.opts.fullScreen.autoStart===!0&&o.request(n[0]),e.FullScreen=o):i.hide()},"afterKeydown.fb":function(t,e,n,o,i){e&&e.FullScreen&&70===i&&(o.preventDefault(),e.FullScreen.toggle(e.$refs.container[0]))},"beforeClose.fb":function(t){t&&t.FullScreen&&o.exit()}}),e(t).on(n.fullscreenchange,function(){var t=e.fancybox.getInstance();t.current&&"image"===t.current.type&&t.isAnimating&&(t.current.$content.css("transition","none"),t.isAnimating=!1,t.update(!0,!0,0))})}(document,window.jQuery),function(t,e){"use strict";var n=function(t){this.instance=t,this.init()};e.extend(n.prototype,{$button:null,$grid:null,$list:null,isVisible:!1,init:function(){var t=this,e=t.instance.group[0],n=t.instance.group[1];t.$button=t.instance.$refs.toolbar.find("[data-fancybox-thumbs]"),t.instance.group.length>1&&t.instance.group[t.instance.currIndex].opts.thumbs&&("image"==e.type||e.opts.thumb||e.opts.$thumb)&&("image"==n.type||n.opts.thumb||n.opts.$thumb)?(t.$button.on("click",function(){t.toggle()}),t.isActive=!0):(t.$button.hide(),t.isActive=!1)},create:function(){var t,n,o=this.instance;this.$grid=e('<div class="fancybox-thumbs"></div>').appendTo(o.$refs.container),t="<ul>",e.each(o.group,function(e,o){n=o.opts.thumb||(o.opts.$thumb?o.opts.$thumb.attr("src"):null),n||"image"!==o.type||(n=o.src),n&&n.length&&(t+='<li data-index="'+e+'"  tabindex="0" class="fancybox-thumbs-loading"><img data-src="'+n+'" /></li>')}),t+="</ul>",this.$list=e(t).appendTo(this.$grid).on("click","li",function(){o.jumpTo(e(this).data("index"))}),this.$list.find("img").hide().one("load",function(){var t,n,o,i,a=e(this).parent().removeClass("fancybox-thumbs-loading"),s=a.outerWidth(),r=a.outerHeight();t=this.naturalWidth||this.width,n=this.naturalHeight||this.height,o=t/s,i=n/r,o>=1&&i>=1&&(o>i?(t/=i,n=r):(t=s,n/=o)),e(this).css({width:Math.floor(t),height:Math.floor(n),"margin-top":Math.min(0,Math.floor(.3*r-.3*n)),"margin-left":Math.min(0,Math.floor(.5*s-.5*t))}).show()}).each(function(){this.src=e(this).data("src")})},focus:function(){this.instance.current&&this.$list.children().removeClass("fancybox-thumbs-active").filter('[data-index="'+this.instance.current.index+'"]').addClass("fancybox-thumbs-active").focus()},close:function(){this.$grid.hide()},update:function(){this.instance.$refs.container.toggleClass("fancybox-show-thumbs",this.isVisible),this.isVisible?(this.$grid||this.create(),this.instance.trigger("onThumbsShow"),this.focus()):this.$grid&&this.instance.trigger("onThumbsHide"),this.instance.update()},hide:function(){this.isVisible=!1,this.update()},show:function(){this.isVisible=!0,this.update()},toggle:function(){this.isVisible=!this.isVisible,this.update()}}),e(t).on({"onInit.fb":function(t,e){e&&!e.Thumbs&&(e.Thumbs=new n(e))},"beforeShow.fb":function(t,e,n,o){var i=e&&e.Thumbs;if(i&&i.isActive){if(n.modal)return i.$button.hide(),void i.hide();o&&e.opts.thumbs.autoStart===!0&&i.show(),i.isVisible&&i.focus()}},"afterKeydown.fb":function(t,e,n,o,i){var a=e&&e.Thumbs;a&&a.isActive&&71===i&&(o.preventDefault(),a.toggle())},"beforeClose.fb":function(t,e){var n=e&&e.Thumbs;n&&n.isVisible&&e.opts.thumbs.hideOnClose!==!1&&n.close()}})}(document,window.jQuery),function(t,e,n){"use strict";function o(){var t=e.location.hash.substr(1),n=t.split("-"),o=n.length>1&&/^\+?\d+$/.test(n[n.length-1])?parseInt(n.pop(-1),10)||1:1,i=n.join("-");return o<1&&(o=1),{hash:t,index:o,gallery:i}}function i(t){var e;""!==t.gallery&&(e=n("[data-fancybox='"+n.escapeSelector(t.gallery)+"']").eq(t.index-1),e.length?e.trigger("click"):n("#"+n.escapeSelector(t.gallery)).trigger("click"))}function a(t){var e;return!!t&&(e=t.current?t.current.opts:t.opts,e.$orig?e.$orig.data("fancybox"):e.hash||"")}n.escapeSelector||(n.escapeSelector=function(t){var e=/([\0-\x1f\x7f]|^-?\d)|^-$|[^\x80-\uFFFF\w-]/g,n=function(t,e){return e?"\0"===t?"�":t.slice(0,-1)+"\\"+t.charCodeAt(t.length-1).toString(16)+" ":"\\"+t};return(t+"").replace(e,n)});var s=null,r=null;n(function(){setTimeout(function(){n.fancybox.defaults.hash!==!1&&(n(t).on({"onInit.fb":function(t,e){var n,i;e.group[e.currIndex].opts.hash!==!1&&(n=o(),i=a(e),i&&n.gallery&&i==n.gallery&&(e.currIndex=n.index-1))},"beforeShow.fb":function(n,o,i,c){var l;i.opts.hash!==!1&&(l=a(o),l&&""!==l&&(e.location.hash.indexOf(l)<0&&(o.opts.origHash=e.location.hash),s=l+(o.group.length>1?"-"+(i.index+1):""),"replaceState"in e.history?(r&&clearTimeout(r),r=setTimeout(function(){e.history[c?"pushState":"replaceState"]({},t.title,e.location.pathname+e.location.search+"#"+s),r=null},300)):e.location.hash=s))},"beforeClose.fb":function(o,i,c){var l,u;r&&clearTimeout(r),c.opts.hash!==!1&&(l=a(i),u=i&&i.opts.origHash?i.opts.origHash:"",l&&""!==l&&("replaceState"in history?e.history.replaceState({},t.title,e.location.pathname+e.location.search+u):(e.location.hash=u,n(e).scrollTop(i.scrollTop).scrollLeft(i.scrollLeft))),s=null)}}),n(e).on("hashchange.fb",function(){var t=o();n.fancybox.getInstance()?!s||s===t.gallery+"-"+t.index||1===t.index&&s==t.gallery||(s=null,n.fancybox.close()):""!==t.gallery&&i(t)}),n(e).one("unload.fb popstate.fb",function(){n.fancybox.getInstance("close",!0,0)}),i(o()))},50)})}(document,window,window.jQuery);

/*jquery.mb.YTPlayer 24-12-2017
 _ jquery.mb.components 
 _ email: matteo@open-lab.com 
 _ Copyright (c) 2001-2017. Matteo Bicocchi (Pupunzi); 
 _ blog: http://pupunzi.open-lab.com 
 _ Open Lab s.r.l., Florence - Italy 
 */
function onYouTubeIframeAPIReady(){ytp.YTAPIReady||(ytp.YTAPIReady=!0,jQuery(document).trigger("YTAPIReady"))}function uncamel(a){return a.replace(/([A-Z])/g,function(a){return"-"+a.toLowerCase()})}function setUnit(a,b){return"string"!=typeof a||a.match(/^[\-0-9\.]+jQuery/)?""+a+b:a}function setFilter(a,b,c){var d=uncamel(b),e=jQuery.browser.mozilla?"":jQuery.CSS.sfx;a[e+"filter"]=a[e+"filter"]||"",c=setUnit(c>jQuery.CSS.filters[b].max?jQuery.CSS.filters[b].max:c,jQuery.CSS.filters[b].unit),a[e+"filter"]+=d+"("+c+") ",delete a[b]}function isTouchSupported(){var a=nAgt.msMaxTouchPoints,b="ontouchstart"in document.createElement("div");return a||b?!0:!1}function isTouchSupported(){var a=nAgt.msMaxTouchPoints,b="ontouchstart"in document.createElement("div");return a||b?!0:!1}var ytp=ytp||{},getYTPVideoID=function(a){var b,c;return a.indexOf("youtu.be")>0?(b=a.substr(a.lastIndexOf("/")+1,a.length),c=b.indexOf("?list=")>0?b.substr(b.lastIndexOf("="),b.length):null,b=c?b.substr(0,b.lastIndexOf("?")):b):a.indexOf("http")>-1?(b=a.match(/[\\?&]v=([^&#]*)/)[1],c=a.indexOf("list=")>0?a.match(/[\\?&]list=([^&#]*)/)[1]:null):(b=a.length>15?null:a,c=b?null:a),{videoID:b,playlistID:c}};!function(jQuery,ytp){jQuery.mbYTPlayer={name:"jquery.mb.YTPlayer",version:"3.1.5",build:"6799",author:"Matteo Bicocchi (pupunzi)",apiKey:"",defaults:{containment:"body",ratio:"auto",videoURL:null,startAt:0,stopAt:0,autoPlay:!0,vol:50,addRaster:!1,mask:!1,opacity:1,quality:"default",mute:!1,loop:!0,fadeOnStartTime:1500,showControls:!0,showAnnotations:!1,showYTLogo:!0,stopMovieOnBlur:!0,realfullscreen:!0,abundance:.2,useOnMobile:!0,mobileFallbackImage:null,gaTrack:!0,optimizeDisplay:!0,remember_last_time:!1,playOnlyIfVisible:!1,anchor:"center,center",addFilters:null,onReady:function(a){},onError:function(a,b){}},controls:{play:"P",pause:"p",mute:"M",unmute:"A",onlyYT:"O",showSite:"R",ytLogo:"Y"},controlBar:null,locationProtocol:"https:",defaultFilters:{grayscale:{value:0,unit:"%"},hue_rotate:{value:0,unit:"deg"},invert:{value:0,unit:"%"},opacity:{value:0,unit:"%"},saturate:{value:0,unit:"%"},sepia:{value:0,unit:"%"},brightness:{value:0,unit:"%"},contrast:{value:0,unit:"%"},blur:{value:0,unit:"px"}},buildPlayer:function(options){return this.each(function(){var YTPlayer=this,$YTPlayer=jQuery(YTPlayer);YTPlayer.loop=0,YTPlayer.opt={},YTPlayer.state=0,YTPlayer.filters=$.extend(!0,{},jQuery.mbYTPlayer.defaultFilters),YTPlayer.filtersEnabled=!0,YTPlayer.id=YTPlayer.id||"YTP_"+(new Date).getTime(),$YTPlayer.addClass("mb_YTPlayer");var property=$YTPlayer.data("property")&&"string"==typeof $YTPlayer.data("property")?eval("("+$YTPlayer.data("property")+")"):$YTPlayer.data("property");"undefined"!=typeof property&&"undefined"!=typeof property.vol&&0===property.vol&&(property.vol=1,property.mute=!0),YTPlayer.opt=jQuery.extend(jQuery.mbYTPlayer.defaults,options,property),console.debug("1:: ",property),console.debug("1:: ",YTPlayer.opt),"true"==YTPlayer.opt.loop&&(YTPlayer.opt.loop=9999),YTPlayer.isRetina=window.retina||window.devicePixelRatio>1;var isIframe=function(){var a=!1;try{self.location.href!=top.location.href&&(a=!0)}catch(b){a=!0}return a};YTPlayer.opt.realfullscreen=isIframe()?!1:YTPlayer.opt.realfullscreen,$YTPlayer.attr("id")||$YTPlayer.attr("id","ytp_"+(new Date).getTime());var playerID="iframe_"+YTPlayer.id;YTPlayer.isAlone=!1,YTPlayer.hasFocus=!0,YTPlayer.videoID=this.opt.videoURL?getYTPVideoID(this.opt.videoURL).videoID:$YTPlayer.attr("href")?getYTPVideoID($YTPlayer.attr("href")).videoID:!1,YTPlayer.playlistID=this.opt.videoURL?getYTPVideoID(this.opt.videoURL).playlistID:$YTPlayer.attr("href")?getYTPVideoID($YTPlayer.attr("href")).playlistID:!1,YTPlayer.opt.showAnnotations=YTPlayer.opt.showAnnotations?"1":"3";var start_from_last=0;if(jQuery.mbCookie.get("YTPlayer_start_from"+YTPlayer.videoID)&&(start_from_last=parseFloat(jQuery.mbCookie.get("YTPlayer_start_from"+YTPlayer.videoID))),YTPlayer.opt.remember_last_time&&start_from_last&&(YTPlayer.start_from_last=start_from_last,jQuery.mbCookie.remove("YTPlayer_start_from"+YTPlayer.videoID)),jQuery.mbBrowser.msie&&jQuery.mbBrowser.version<9&&(this.opt.opacity=1),YTPlayer.isPlayer="self"==YTPlayer.opt.containment,YTPlayer.opt.containment=jQuery("self"==YTPlayer.opt.containment?this:YTPlayer.opt.containment),YTPlayer.isBackground=YTPlayer.opt.containment.is("body"),!YTPlayer.isBackground||!ytp.backgroundIsInited){YTPlayer.isPlayer||$YTPlayer.hide(),YTPlayer.overlay=jQuery("<div/>").css({position:"absolute",top:0,left:0,width:"100%",height:"100%"}).addClass("YTPOverlay"),YTPlayer.isPlayer&&YTPlayer.overlay.on("click",function(){$YTPlayer.YTPTogglePlay()}),YTPlayer.wrapper=jQuery("<div/>").addClass("mbYTP_wrapper").attr("id","wrapper_"+YTPlayer.id),YTPlayer.wrapper.css({position:"absolute",zIndex:0,minWidth:"100%",minHeight:"100%",left:0,top:0,overflow:"hidden",opacity:0});var playerBox=jQuery("<div/>").attr("id",playerID).addClass("playerBox");if(playerBox.css({position:"absolute",zIndex:0,width:"100%",height:"100%",top:0,left:0,overflow:"hidden",opacity:1}),YTPlayer.wrapper.append(playerBox),playerBox.after(YTPlayer.overlay),YTPlayer.isPlayer&&(YTPlayer.inlineWrapper=jQuery("<div/>").addClass("inline-YTPlayer"),YTPlayer.inlineWrapper.css({position:"relative",maxWidth:YTPlayer.opt.containment.css("width")}),YTPlayer.opt.containment.css({position:"relative",paddingBottom:"56.25%",overflow:"hidden",height:0}),YTPlayer.opt.containment.wrap(YTPlayer.inlineWrapper)),YTPlayer.opt.containment.children().not("script, style").each(function(){"static"==jQuery(this).css("position")&&jQuery(this).css("position","relative")}),YTPlayer.isBackground?(jQuery("body").css({boxSizing:"border-box"}),YTPlayer.wrapper.css({position:"fixed",top:0,left:0,zIndex:0}),$YTPlayer.hide()):"static"==YTPlayer.opt.containment.css("position")&&YTPlayer.opt.containment.css({position:"relative"}),YTPlayer.opt.containment.prepend(YTPlayer.wrapper),YTPlayer.isBackground||YTPlayer.overlay.on("mouseenter",function(){YTPlayer.controlBar&&YTPlayer.controlBar.length&&YTPlayer.controlBar.addClass("visible")}).on("mouseleave",function(){YTPlayer.controlBar&&YTPlayer.controlBar.length&&YTPlayer.controlBar.removeClass("visible")}),ytp.YTAPIReady)setTimeout(function(){jQuery(document).trigger("YTAPIReady")},100);else{jQuery("#YTAPI").remove();var tag=jQuery("<script></script>").attr({src:jQuery.mbYTPlayer.locationProtocol+"//www.youtube.com/iframe_api?v="+jQuery.mbYTPlayer.version,id:"YTAPI"});jQuery("head").prepend(tag)}if(jQuery.mbBrowser.mobile&&!YTPlayer.opt.useOnMobile)return YTPlayer.opt.mobileFallbackImage&&(YTPlayer.wrapper.css({backgroundImage:"url("+YTPlayer.opt.mobileFallbackImage+")",backgroundPosition:"center center",backgroundSize:"cover",backgroundRepeat:"no-repeat",opacity:1}),YTPlayer.wrapper.css({opacity:1})),$YTPlayer;jQuery.mbBrowser.mobile&&YTPlayer.opt.autoPlay&&YTPlayer.opt.useOnMobile&&jQuery("body").one("touchstart",function(){YTPlayer.player.playVideo()}),jQuery(document).on("YTAPIReady",function(){YTPlayer.isBackground&&ytp.backgroundIsInited||YTPlayer.isInit||(YTPlayer.isBackground&&(ytp.backgroundIsInited=!0),YTPlayer.opt.autoPlay="undefined"==typeof YTPlayer.opt.autoPlay?YTPlayer.isBackground?!0:!1:YTPlayer.opt.autoPlay,YTPlayer.opt.vol=YTPlayer.opt.vol?YTPlayer.opt.vol:100,jQuery.mbYTPlayer.getDataFromAPI(YTPlayer),jQuery(YTPlayer).on("YTPChanged",function(){if(!YTPlayer.isInit){YTPlayer.isInit=!0;var a={modestbranding:1,autoplay:0,controls:0,showinfo:0,rel:0,enablejsapi:1,version:3,playerapiid:playerID,origin:"*",allowfullscreen:!0,wmode:"transparent",iv_load_policy:YTPlayer.opt.showAnnotations,playsinline:jQuery.browser.mobile?1:0,html5:document.createElement("video").canPlayType?1:0};new YT.Player(playerID,{playerVars:a,events:{onReady:function(a){YTPlayer.player=a.target,YTPlayer.player.loadVideoById({videoId:YTPlayer.videoID.toString(),startSeconds:YTPlayer.opt.startAt,endSeconds:YTPlayer.opt.stopAt,suggestedQuality:YTPlayer.opt.quality}),YTPlayer.isReady||(YTPlayer.isReady=YTPlayer.isPlayer&&!YTPlayer.opt.autoPlay?!1:!0,YTPlayer.playerEl=YTPlayer.player.getIframe(),jQuery(YTPlayer.playerEl).unselectable(),$YTPlayer.optimizeDisplay(),jQuery(window).off("resize.YTP_"+YTPlayer.id).on("resize.YTP_"+YTPlayer.id,function(){$YTPlayer.optimizeDisplay()}),YTPlayer.opt.remember_last_time&&jQuery(window).on("unload.YTP_"+YTPlayer.id,function(){var a=YTPlayer.player.getCurrentTime();jQuery.mbCookie.set("YTPlayer_start_from"+YTPlayer.videoID,a,0)}),jQuery.mbYTPlayer.checkForState(YTPlayer))},onStateChange:function(a){if("function"==typeof a.target.getPlayerState){var b=a.target.getPlayerState();if(YTPlayer.preventTrigger)return void(YTPlayer.preventTrigger=!1);YTPlayer.state=b;var c;switch(b){case-1:c="YTPUnstarted";break;case 0:c="YTPRealEnd";break;case 1:c="YTPPlay",YTPlayer.controlBar.length&&YTPlayer.controlBar.find(".mb_YTPPlaypause").html(jQuery.mbYTPlayer.controls.pause);break;case 2:c="YTPPause",YTPlayer.controlBar.length&&YTPlayer.controlBar.find(".mb_YTPPlaypause").html(jQuery.mbYTPlayer.controls.play);break;case 3:YTPlayer.player.setPlaybackQuality(YTPlayer.opt.quality),c="YTPBuffering",YTPlayer.controlBar.length&&YTPlayer.controlBar.find(".mb_YTPPlaypause").html(jQuery.mbYTPlayer.controls.play);break;case 5:c="YTPCued"}var d=jQuery.Event(c);d.time=YTPlayer.currentTime,YTPlayer.preventTrigger||jQuery(YTPlayer).trigger(d)}},onPlaybackQualityChange:function(a){var b=a.target.getPlaybackQuality(),c=jQuery.Event("YTPQualityChange");c.quality=b,jQuery(YTPlayer).trigger(c)},onError:function(a){150==a.data&&(console.log("Embedding this video is restricted by Youtube."),alert("mb.YTPlayer: Embedding this video ("+YTPlayer.videoID+") is restricted by Youtube"),YTPlayer.isList&&jQuery(YTPlayer).YTPPlayNext()),2==a.data&&YTPlayer.isList&&jQuery(YTPlayer).YTPPlayNext(),"function"==typeof YTPlayer.opt.onError&&YTPlayer.opt.onError($YTPlayer,a)}}})}}))}),$YTPlayer.off("YTPTime.mask"),jQuery.mbYTPlayer.applyMask(YTPlayer)}})},isOnScreen:function(a){var b=a.wrapper,c=$(window).scrollTop(),d=c+$(window).height(),e=b.offset().top,f=e+b.height()/2;return d>=f&&e>=c},getDataFromAPI:function(a){if(a.videoData=jQuery.mbStorage.get("YTPlayer_data_"+a.videoID),jQuery(a).off("YTPData.YTPlayer").on("YTPData.YTPlayer",function(){if(a.hasData&&a.isPlayer&&!a.opt.autoPlay){var b=a.videoData.thumb_max||a.videoData.thumb_high||a.videoData.thumb_medium;a.opt.containment.css({background:"rgba(0,0,0,0.5) url("+b+") center center",backgroundSize:"cover"}),a.opt.backgroundUrl=b}}),a.videoData)setTimeout(function(){a.opt.ratio="auto"==a.opt.ratio?16/9:a.opt.ratio,a.dataReceived=!0;var b=jQuery.Event("YTPChanged");b.time=a.currentTime,b.videoId=a.videoID,jQuery(a).trigger(b);var c=jQuery.Event("YTPData");c.prop={};for(var d in a.videoData)c.prop[d]=a.videoData[d];jQuery(a).trigger(c)},a.opt.fadeOnStartTime),a.hasData=!0;else if(jQuery.mbYTPlayer.apiKey)jQuery.getJSON(jQuery.mbYTPlayer.locationProtocol+"//www.googleapis.com/youtube/v3/videos?id="+a.videoID+"&key="+jQuery.mbYTPlayer.apiKey+"&part=snippet",function(b){function c(b){a.videoData={},a.videoData.id=a.videoID,a.videoData.channelTitle=b.channelTitle,a.videoData.title=b.title,a.videoData.description=b.description.length<400?b.description:b.description.substring(0,400)+" ...",a.videoData.aspectratio="auto"==a.opt.ratio?16/9:a.opt.ratio,a.opt.ratio=a.videoData.aspectratio,a.videoData.thumb_max=b.thumbnails.maxres?b.thumbnails.maxres.url:null,a.videoData.thumb_high=b.thumbnails.high?b.thumbnails.high.url:null,a.videoData.thumb_medium=b.thumbnails.medium?b.thumbnails.medium.url:null,jQuery.mbStorage.set("YTPlayer_data_"+a.videoID,a.videoData)}a.dataReceived=!0;var d=jQuery.Event("YTPChanged");d.time=a.currentTime,d.videoId=a.videoID,jQuery(a).trigger(d),b.items[0]?(c(b.items[0].snippet),a.hasData=!0):(a.videoData={},a.hasData=!1);var e=jQuery.Event("YTPData");e.prop={};for(var f in a.videoData)e.prop[f]=a.videoData[f];jQuery(a).trigger(e)});else{if(setTimeout(function(){var b=jQuery.Event("YTPChanged");b.time=a.currentTime,b.videoId=a.videoID,jQuery(a).trigger(b)},50),a.isPlayer&&!a.opt.autoPlay){var b=jQuery.mbYTPlayer.locationProtocol+"//i.ytimg.com/vi/"+a.videoID+"/maxresdefault.jpg";b&&a.opt.containment.css({background:"rgba(0,0,0,0.5) url("+b+") center center",backgroundSize:"cover"}),a.opt.backgroundUrl=b}a.videoData=null,a.opt.ratio="auto"==a.opt.ratio?"16/9":a.opt.ratio}a.isPlayer&&!a.opt.autoPlay&&(a.loading=jQuery("<div/>").addClass("loading").html("Loading").hide(),jQuery(a).append(a.loading),a.loading.fadeIn())},removeStoredData:function(){jQuery.mbStorage.remove()},getVideoData:function(){var a=this.get(0);return a.videoData},getVideoID:function(){var a=this.get(0);return a.videoID||!1},getPlaylistID:function(){var a=this.get(0);return a.playlistID||!1},setVideoQuality:function(a){var b=this.get(0);return b.player.setPlaybackQuality(a),this},playlist:function(a,b,c){var d=this,e=d.get(0);return e.isList=!0,b&&(a=jQuery.shuffle(a)),e.videoID||(e.videos=a,e.videoCounter=1,e.videoLength=a.length,jQuery(e).data("property",a[0]),jQuery(e).mb_YTPlayer()),"function"==typeof c&&jQuery(e).one("YTPChanged",function(){c(e)}),jQuery(e).on("YTPEnd",function(){jQuery(e).YTPPlayNext()}),this},playNext:function(){var a=this.get(0);return a.videoCounter++,a.videoCounter>a.videoLength&&(a.videoCounter=1),jQuery(a).YTPPlayIndex(a.videoCounter),this},playPrev:function(){var a=this.get(0);return a.videoCounter--,a.videoCounter<=0&&(a.videoCounter=a.videoLength),jQuery(a).YTPPlayIndex(a.videoCounter),this},playIndex:function(a){var b=this.get(0);b.checkForStartAt&&(clearInterval(b.checkForStartAt),clearInterval(b.getState)),b.videoCounter=a,b.videoCounter>=b.videoLength&&(b.videoCounter=b.videoLength);var c=b.videos[b.videoCounter-1];return jQuery(b).YTPChangeVideo(c),this},changeVideo:function(a){console.debug("changeVideo",a);var b=this,c=b.get(0);return c.opt.startAt=0,c.opt.stopAt=0,c.opt.mask=!1,c.opt.mute=!0,c.opt.autoPlay=!0,c.opt.addFilters=!1,c.hasData=!1,c.hasChanged=!0,c.player.loopTime=void 0,a&&jQuery.extend(c.opt,a),c.videoID=getYTPVideoID(c.opt.videoURL).videoID,"true"==c.opt.loop&&(c.opt.loop=9999),jQuery(c.playerEl).CSSAnimate({opacity:0},c.opt.fadeOnStartTime,function(){var a=jQuery.Event("YTPChangeVideo");a.time=c.currentTime,jQuery(c).trigger(a),jQuery(c).YTPGetPlayer().loadVideoById({videoId:c.videoID,startSeconds:c.opt.startAt,endSeconds:c.opt.stopAt,suggestedQuality:c.opt.quality}),jQuery(c).optimizeDisplay(),jQuery.mbYTPlayer.checkForState(c),jQuery.mbYTPlayer.getDataFromAPI(c)}),jQuery.mbYTPlayer.applyMask(c),this},getPlayer:function(){return jQuery(this).get(0).player},playerDestroy:function(){var a=this.get(0);return ytp.YTAPIReady=!0,ytp.backgroundIsInited=!1,a.isInit=!1,a.videoID=null,a.isReady=!1,a.wrapper.remove(),jQuery("#controlBar_"+a.id).remove(),clearInterval(a.checkForStartAt),clearInterval(a.getState),this},fullscreen:function(real){function hideMouse(){YTPlayer.overlay.css({cursor:"none"})}function RunPrefixMethod(a,b){for(var c,d,e=["webkit","moz","ms","o",""],f=0;f<e.length&&!a[c];){if(c=b,""==e[f]&&(c=c.substr(0,1).toLowerCase()+c.substr(1)),c=e[f]+c,d=typeof a[c],"undefined"!=d)return e=[e[f]],"function"==d?a[c]():a[c];f++}}function launchFullscreen(a){RunPrefixMethod(a,"RequestFullScreen")}function cancelFullscreen(){(RunPrefixMethod(document,"FullScreen")||RunPrefixMethod(document,"IsFullScreen"))&&RunPrefixMethod(document,"CancelFullScreen")}var YTPlayer=this.get(0);"undefined"==typeof real&&(real=YTPlayer.opt.realfullscreen),real=eval(real);var controls=jQuery("#controlBar_"+YTPlayer.id),fullScreenBtn=controls.find(".mb_OnlyYT"),videoWrapper=YTPlayer.isPlayer?YTPlayer.opt.containment:YTPlayer.wrapper;if(real){var fullscreenchange=jQuery.mbBrowser.mozilla?"mozfullscreenchange":jQuery.mbBrowser.webkit?"webkitfullscreenchange":"fullscreenchange";jQuery(document).off(fullscreenchange).on(fullscreenchange,function(){var a=RunPrefixMethod(document,"IsFullScreen")||RunPrefixMethod(document,"FullScreen");a?(jQuery(YTPlayer).YTPSetVideoQuality("default"),jQuery(YTPlayer).trigger("YTPFullScreenStart")):(YTPlayer.isAlone=!1,fullScreenBtn.html(jQuery.mbYTPlayer.controls.onlyYT),jQuery(YTPlayer).YTPSetVideoQuality(YTPlayer.opt.quality),videoWrapper.removeClass("YTPFullscreen"),videoWrapper.CSSAnimate({opacity:YTPlayer.opt.opacity},YTPlayer.opt.fadeOnStartTime),videoWrapper.css({zIndex:0}),YTPlayer.isBackground?jQuery("body").after(controls):YTPlayer.wrapper.before(controls),jQuery(window).resize(),jQuery(YTPlayer).trigger("YTPFullScreenEnd"))})}return YTPlayer.isAlone?(jQuery(document).off("mousemove.YTPlayer"),clearTimeout(YTPlayer.hideCursor),YTPlayer.overlay.css({cursor:"auto"}),real?cancelFullscreen():(videoWrapper.CSSAnimate({opacity:YTPlayer.opt.opacity},YTPlayer.opt.fadeOnStartTime),videoWrapper.css({zIndex:0})),fullScreenBtn.html(jQuery.mbYTPlayer.controls.onlyYT),YTPlayer.isAlone=!1):(jQuery(document).on("mousemove.YTPlayer",function(a){YTPlayer.overlay.css({cursor:"auto"}),clearTimeout(YTPlayer.hideCursor),jQuery(a.target).parents().is(".mb_YTPBar")||(YTPlayer.hideCursor=setTimeout(hideMouse,3e3))}),hideMouse(),real?(videoWrapper.css({opacity:0}),videoWrapper.addClass("YTPFullscreen"),launchFullscreen(videoWrapper.get(0)),setTimeout(function(){videoWrapper.CSSAnimate({opacity:1},2*YTPlayer.opt.fadeOnStartTime),videoWrapper.append(controls),jQuery(YTPlayer).optimizeDisplay(),YTPlayer.player.seekTo(YTPlayer.player.getCurrentTime()+.1,!0)},YTPlayer.opt.fadeOnStartTime)):videoWrapper.css({zIndex:1e4}).CSSAnimate({opacity:1},2*YTPlayer.opt.fadeOnStartTime),fullScreenBtn.html(jQuery.mbYTPlayer.controls.showSite),YTPlayer.isAlone=!0),this},toggleLoops:function(){var a=this.get(0),b=a.opt;return 1==b.loop?b.loop=0:(b.startAt?a.player.seekTo(b.startAt):a.player.playVideo(),b.loop=1),this},play:function(){var a=this.get(0);if(!a.isReady)return this;a.player.playVideo(),jQuery(a.playerEl).css({opacity:1}),a.wrapper.CSSAnimate({opacity:a.isAlone?1:a.opt.opacity},a.opt.fadeOnStartTime);var b=jQuery("#controlBar_"+a.id),c=b.find(".mb_YTPPlaypause");return c.html(jQuery.mbYTPlayer.controls.pause),a.state=1,a.orig_background=jQuery(a).css("background-image"),this},togglePlay:function(a){var b=this.get(0);return 1==b.state?this.YTPPause():this.YTPPlay(),"function"==typeof a&&a(b.state),this},stop:function(){var a=this.get(0),b=jQuery("#controlBar_"+a.id),c=b.find(".mb_YTPPlaypause");return c.html(jQuery.mbYTPlayer.controls.play),a.player.stopVideo(),this},pause:function(){var a=this.get(0);return a.player.pauseVideo(),a.state=2,this},seekTo:function(a){var b=this.get(0);return b.player.seekTo(a,!0),this},setVolume:function(a){var b=this.get(0);return b.player.length?(a||b.opt.vol||0!=b.player.getVolume()?!a&&b.player.getVolume()>0||a&&b.opt.vol==a?b.isMute?jQuery(b).YTPUnmute():jQuery(b).YTPMute():(b.opt.vol=a,b.player.setVolume(b.opt.vol),b.volumeBar&&b.volumeBar.length&&b.volumeBar.updateSliderVal(a)):jQuery(b).YTPUnmute(),this):this},toggleVolume:function(){var a=this.get(0);return a?(a.player.isMuted()?jQuery(a).YTPUnmute():jQuery(a).YTPMute(),this):this},mute:function(){var a=this.get(0);if(a.isMute)return this;a.player.mute(),a.isMute=!0,a.player.setVolume(0),a.volumeBar&&a.volumeBar.length&&a.volumeBar.width()>10&&a.volumeBar.updateSliderVal(0);var b=jQuery("#controlBar_"+a.id),c=b.find(".mb_YTPMuteUnmute");c.html(jQuery.mbYTPlayer.controls.unmute),jQuery(a).addClass("isMuted"),a.volumeBar&&a.volumeBar.length&&a.volumeBar.addClass("muted");var d=jQuery.Event("YTPMuted");return d.time=a.currentTime,a.preventTrigger||jQuery(a).trigger(d),this},unmute:function(){var a=this.get(0);if(!a.isMute)return this;a.player.unMute(),a.isMute=!1,a.player.setVolume(a.opt.vol),a.volumeBar&&a.volumeBar.length&&a.volumeBar.updateSliderVal(a.opt.vol>10?a.opt.vol:10);var b=jQuery("#controlBar_"+a.id),c=b.find(".mb_YTPMuteUnmute");c.html(jQuery.mbYTPlayer.controls.mute),jQuery(a).removeClass("isMuted"),a.volumeBar&&a.volumeBar.length&&a.volumeBar.removeClass("muted");var d=jQuery.Event("YTPUnmuted");return d.time=a.currentTime,a.preventTrigger||jQuery(a).trigger(d),this},applyFilter:function(a,b){var c=this,d=c.get(0);d.filters[a].value=b,d.filtersEnabled&&c.YTPEnableFilters()},applyFilters:function(a){var b=this,c=b.get(0);if(!c.isReady)return jQuery(c).on("YTPReady",function(){b.YTPApplyFilters(a)}),this;for(var d in a)b.YTPApplyFilter(d,a[d]);b.trigger("YTPFiltersApplied")},toggleFilter:function(a,b){var c=this,d=c.get(0);return d.filters[a].value?d.filters[a].value=0:d.filters[a].value=b,d.filtersEnabled&&jQuery(d).YTPEnableFilters(),this},toggleFilters:function(a){var b=this,c=b.get(0);return c.filtersEnabled?(jQuery(c).trigger("YTPDisableFilters"),jQuery(c).YTPDisableFilters()):(jQuery(c).YTPEnableFilters(),jQuery(c).trigger("YTPEnableFilters")),"function"==typeof a&&a(c.filtersEnabled),this},disableFilters:function(){var a=this,b=a.get(0),c=jQuery(b.playerEl);return c.css("-webkit-filter",""),c.css("filter",""),b.filtersEnabled=!1,this},enableFilters:function(){var a=this,b=a.get(0),c=jQuery(b.playerEl),d="";for(var e in b.filters)b.filters[e].value&&(d+=e.replace("_","-")+"("+b.filters[e].value+b.filters[e].unit+") ");return c.css("-webkit-filter",d),c.css("filter",d),b.filtersEnabled=!0,this},removeFilter:function(a,b){var c=this,d=c.get(0);if("function"==typeof a&&(b=a,a=null),a)c.YTPApplyFilter(a,0),"function"==typeof b&&b(a);else{for(var e in d.filters)c.YTPApplyFilter(e,0);"function"==typeof b&&b(e),d.filters=$.extend(!0,{},jQuery.mbYTPlayer.defaultFilters)}var f=jQuery.Event("YTPFiltersApplied");return c.trigger(f),this},getFilters:function(){var a=this.get(0);return a.filters},addMask:function(a){var b=this.get(0);a||(a=b.actualMask);var c=jQuery("<img/>").attr("src",a).on("load",function(){b.overlay.CSSAnimate({opacity:0},b.opt.fadeOnStartTime,function(){b.hasMask=!0,c.remove(),b.overlay.css({backgroundImage:"url("+a+")",backgroundRepeat:"no-repeat",backgroundPosition:"center center",backgroundSize:"cover"}),b.overlay.CSSAnimate({opacity:1},b.opt.fadeOnStartTime)})});return this},removeMask:function(){var a=this.get(0);return a.overlay.CSSAnimate({opacity:0},a.opt.fadeOnStartTime,function(){a.hasMask=!1,a.overlay.css({backgroundImage:"",backgroundRepeat:"",backgroundPosition:"",backgroundSize:""}),a.overlay.CSSAnimate({opacity:1},a.opt.fadeOnStartTime)}),this},applyMask:function(a){var b=jQuery(a);if(b.off("YTPTime.mask"),a.opt.mask)if("string"==typeof a.opt.mask)b.YTPAddMask(a.opt.mask),a.actualMask=a.opt.mask;else if("object"==typeof a.opt.mask){for(var c in a.opt.mask)if(a.opt.mask[c]){jQuery("<img/>").attr("src",a.opt.mask[c])}a.opt.mask[0]&&b.YTPAddMask(a.opt.mask[0]),b.on("YTPTime.mask",function(c){for(var d in a.opt.mask)c.time==d&&(a.opt.mask[d]?(b.YTPAddMask(a.opt.mask[d]),a.actualMask=a.opt.mask[d]):b.YTPRemoveMask())})}},toggleMask:function(){var a=this.get(0),b=$(a);return a.hasMask?b.YTPRemoveMask():b.YTPAddMask(),this},manageProgress:function(){var a=this.get(0),b=jQuery("#controlBar_"+a.id),c=b.find(".mb_YTPProgress"),d=b.find(".mb_YTPLoaded"),e=b.find(".mb_YTPseekbar"),f=c.outerWidth(),g=Math.floor(a.player.getCurrentTime()),h=Math.floor(a.player.getDuration()),i=g*f/h,j=0,k=100*a.player.getVideoLoadedFraction();return d.css({left:j,width:k+"%"}),e.css({left:0,width:i}),{totalTime:h,currentTime:g}},buildControls:function(YTPlayer){var data=YTPlayer.opt;if(jQuery("#controlBar_"+YTPlayer.id).remove(),YTPlayer.opt.showControls||(YTPlayer.controlBar=!1),data.showYTLogo=data.showYTLogo||data.printUrl,!jQuery("#controlBar_"+YTPlayer.id).length){YTPlayer.controlBar=jQuery("<span/>").attr("id","controlBar_"+YTPlayer.id).addClass("mb_YTPBar").css({whiteSpace:"noWrap",position:YTPlayer.isBackground?"fixed":"absolute",zIndex:YTPlayer.isBackground?1e4:1e3}).hide();var buttonBar=jQuery("<div/>").addClass("buttonBar"),playpause=jQuery("<span>"+jQuery.mbYTPlayer.controls.play+"</span>").addClass("mb_YTPPlaypause ytpicon").click(function(){1==YTPlayer.player.getPlayerState()?jQuery(YTPlayer).YTPPause():jQuery(YTPlayer).YTPPlay()}),MuteUnmute=jQuery("<span>"+jQuery.mbYTPlayer.controls.mute+"</span>").addClass("mb_YTPMuteUnmute ytpicon").click(function(){0==YTPlayer.player.getVolume()?jQuery(YTPlayer).YTPUnmute():jQuery(YTPlayer).YTPMute()}),volumeBar=jQuery("<div/>").addClass("mb_YTPVolumeBar").css({display:"inline-block"});YTPlayer.volumeBar=volumeBar;var idx=jQuery("<span/>").addClass("mb_YTPTime"),vURL=data.videoURL?data.videoURL:"";vURL.indexOf("http")<0&&(vURL=jQuery.mbYTPlayer.locationProtocol+"//www.youtube.com/watch?v="+data.videoURL);var movieUrl=jQuery("<span/>").html(jQuery.mbYTPlayer.controls.ytLogo).addClass("mb_YTPUrl ytpicon").attr("title","view on YouTube").on("click",function(){window.open(vURL,"viewOnYT")}),onlyVideo=jQuery("<span/>").html(jQuery.mbYTPlayer.controls.onlyYT).addClass("mb_OnlyYT ytpicon").on("click",function(){jQuery(YTPlayer).YTPFullscreen(data.realfullscreen)}),progressBar=jQuery("<div/>").addClass("mb_YTPProgress").css("position","absolute").click(function(a){timeBar.css({width:a.clientX-timeBar.offset().left}),YTPlayer.timeW=a.clientX-timeBar.offset().left,YTPlayer.controlBar.find(".mb_YTPLoaded").css({width:0});var b=Math.floor(YTPlayer.player.getDuration());YTPlayer["goto"]=timeBar.outerWidth()*b/progressBar.outerWidth(),YTPlayer.player.seekTo(parseFloat(YTPlayer["goto"]),!0),YTPlayer.controlBar.find(".mb_YTPLoaded").css({width:0})}),loadedBar=jQuery("<div/>").addClass("mb_YTPLoaded").css("position","absolute"),timeBar=jQuery("<div/>").addClass("mb_YTPseekbar").css("position","absolute");progressBar.append(loadedBar).append(timeBar),buttonBar.append(playpause).append(MuteUnmute).append(volumeBar).append(idx),data.showYTLogo&&buttonBar.append(movieUrl),(YTPlayer.isBackground||eval(YTPlayer.opt.realfullscreen)&&!YTPlayer.isBackground)&&buttonBar.append(onlyVideo),YTPlayer.controlBar.append(buttonBar).append(progressBar),YTPlayer.isBackground?jQuery("body").after(YTPlayer.controlBar):(YTPlayer.controlBar.addClass("inlinePlayer"),YTPlayer.wrapper.before(YTPlayer.controlBar)),volumeBar.simpleSlider({initialval:YTPlayer.opt.vol,scale:100,orientation:"h",callback:function(a){0==a.value?jQuery(YTPlayer).YTPMute():jQuery(YTPlayer).YTPUnmute(),YTPlayer.player.setVolume(a.value),YTPlayer.isMute||(YTPlayer.opt.vol=a.value)}})}},checkForState:function(YTPlayer){clearInterval(YTPlayer.getState);var interval=10;return jQuery.contains(document,YTPlayer)?(jQuery.mbYTPlayer.checkForStart(YTPlayer),void(YTPlayer.getState=setInterval(function(){var prog=jQuery(YTPlayer).YTPManageProgress(),$YTPlayer=jQuery(YTPlayer),data=YTPlayer.opt,startAt=YTPlayer.start_from_last?YTPlayer.start_from_last:YTPlayer.opt.startAt?YTPlayer.opt.startAt:1;YTPlayer.start_from_last=null;var stopAt=YTPlayer.opt.stopAt>YTPlayer.opt.startAt?YTPlayer.opt.stopAt:0;if(stopAt=stopAt<YTPlayer.player.getDuration()?stopAt:0,YTPlayer.currentTime!=prog.currentTime){var YTPEvent=jQuery.Event("YTPTime");YTPEvent.time=YTPlayer.currentTime,jQuery(YTPlayer).trigger(YTPEvent)}if(YTPlayer.currentTime=prog.currentTime,YTPlayer.totalTime=YTPlayer.player.getDuration(),0==YTPlayer.player.getVolume()?$YTPlayer.addClass("isMuted"):$YTPlayer.removeClass("isMuted"),YTPlayer.opt.showControls&&(prog.totalTime?YTPlayer.controlBar.find(".mb_YTPTime").html(jQuery.mbYTPlayer.formatTime(prog.currentTime)+" / "+jQuery.mbYTPlayer.formatTime(prog.totalTime)):YTPlayer.controlBar.find(".mb_YTPTime").html("-- : -- / -- : --")),eval(YTPlayer.opt.stopMovieOnBlur)&&(document.hasFocus()?document.hasFocus()&&!YTPlayer.hasFocus&&-1!=YTPlayer.state&&0!=YTPlayer.state&&(YTPlayer.hasFocus=!0,YTPlayer.player.playVideo()):1==YTPlayer.state&&(YTPlayer.hasFocus=!1,$YTPlayer.YTPPause())),YTPlayer.opt.playOnlyIfVisible&&1==YTPlayer.state){var isOnScreen=jQuery.mbYTPlayer.isOnScreen(YTPlayer);isOnScreen?YTPlayer.player.playVideo():$YTPlayer.YTPPause()}if(YTPlayer.controlBar.length&&YTPlayer.controlBar.outerWidth()<=400&&!YTPlayer.isCompact?(YTPlayer.controlBar.addClass("compact"),YTPlayer.isCompact=!0,!YTPlayer.isMute&&YTPlayer.volumeBar&&YTPlayer.volumeBar.updateSliderVal(YTPlayer.opt.vol)):YTPlayer.controlBar.length&&YTPlayer.controlBar.outerWidth()>400&&YTPlayer.isCompact&&(YTPlayer.controlBar.removeClass("compact"),YTPlayer.isCompact=!1,!YTPlayer.isMute&&YTPlayer.volumeBar&&YTPlayer.volumeBar.updateSliderVal(YTPlayer.opt.vol)),1==YTPlayer.player.getPlayerState()&&(parseFloat(YTPlayer.player.getDuration()-.5)<YTPlayer.player.getCurrentTime()||stopAt>0&&parseFloat(YTPlayer.player.getCurrentTime())>stopAt)){if(YTPlayer.isEnded)return;if(YTPlayer.isEnded=!0,setTimeout(function(){YTPlayer.isEnded=!1},1e3),YTPlayer.isList){if(!data.loop||data.loop>0&&YTPlayer.player.loopTime===data.loop-1){YTPlayer.player.loopTime=void 0,clearInterval(YTPlayer.getState);var YTPEnd=jQuery.Event("YTPEnd");return YTPEnd.time=YTPlayer.currentTime,void jQuery(YTPlayer).trigger(YTPEnd)}}else if(!data.loop||data.loop>0&&YTPlayer.player.loopTime===data.loop-1)return YTPlayer.player.loopTime=void 0,YTPlayer.preventTrigger=!0,YTPlayer.state=2,jQuery(YTPlayer).YTPPause(),void YTPlayer.wrapper.CSSAnimate({opacity:0},YTPlayer.opt.fadeOnStartTime,function(){YTPlayer.controlBar.length&&YTPlayer.controlBar.find(".mb_YTPPlaypause").html(jQuery.mbYTPlayer.controls.play);var a=jQuery.Event("YTPEnd");a.time=YTPlayer.currentTime,jQuery(YTPlayer).trigger(a),YTPlayer.player.seekTo(startAt,!0),YTPlayer.isBackground?YTPlayer.orig_background&&jQuery(YTPlayer).css("background-image",YTPlayer.orig_background):YTPlayer.opt.backgroundUrl&&YTPlayer.isPlayer&&(YTPlayer.opt.backgroundUrl=YTPlayer.opt.backgroundUrl||YTPlayer.orig_background,YTPlayer.opt.containment.css({background:"url("+YTPlayer.opt.backgroundUrl+") center center",backgroundSize:"cover"}))});YTPlayer.player.loopTime=YTPlayer.player.loopTime?++YTPlayer.player.loopTime:1,startAt=startAt||1,YTPlayer.preventTrigger=!0,YTPlayer.state=2,jQuery(YTPlayer).YTPPause(),YTPlayer.player.seekTo(startAt,!0),YTPlayer.player.playVideo()}},interval))):(jQuery(YTPlayer).YTPPlayerDestroy(),clearInterval(YTPlayer.getState),void clearInterval(YTPlayer.checkForStartAt))},checkForStart:function(YTPlayer){var $YTPlayer=jQuery(YTPlayer);if(!jQuery.contains(document,YTPlayer))return void jQuery(YTPlayer).YTPPlayerDestroy();if(jQuery.mbYTPlayer.buildControls(YTPlayer),YTPlayer.overlay)if(YTPlayer.opt.addRaster){var classN="dot"==YTPlayer.opt.addRaster?"raster-dot":"raster";YTPlayer.overlay.addClass(YTPlayer.isRetina?classN+" retina":classN)}else YTPlayer.overlay.removeClass(function(a,b){var c=b.split(" "),d=[];return jQuery.each(c,function(a,b){/raster.*/.test(b)&&d.push(b)}),d.push("retina"),d.join(" ")});YTPlayer.preventTrigger=!0,YTPlayer.state=2,YTPlayer.player.playVideo(),jQuery(YTPlayer).YTPPause(),jQuery(YTPlayer).YTPMute();var startAt=YTPlayer.start_from_last?YTPlayer.start_from_last:YTPlayer.opt.startAt?YTPlayer.opt.startAt:1;YTPlayer.start_from_last=null,YTPlayer.player.playVideo(),YTPlayer.start_from_last&&YTPlayer.player.seekTo(startAt,!0),clearInterval(YTPlayer.checkForStartAt),jQuery(YTPlayer).YTPMute(),YTPlayer.checkForStartAt=setInterval(function(){var canPlayVideo=YTPlayer.player.getVideoLoadedFraction()>=startAt/YTPlayer.player.getDuration();if(YTPlayer.player.getDuration()>0&&YTPlayer.player.getCurrentTime()>=startAt&&canPlayVideo){clearInterval(YTPlayer.checkForStartAt),"function"==typeof YTPlayer.opt.onReady&&YTPlayer.opt.onReady(YTPlayer),YTPlayer.isReady=!0,$YTPlayer.YTPRemoveFilter(),YTPlayer.opt.addFilters?$YTPlayer.YTPApplyFilters(YTPlayer.opt.addFilters):$YTPlayer.YTPApplyFilters({}),$YTPlayer.YTPEnableFilters();var YTPready=jQuery.Event("YTPReady");if(YTPready.time=YTPlayer.currentTime,jQuery(YTPlayer).trigger(YTPready),YTPlayer.preventTrigger=!0,YTPlayer.state=2,jQuery(YTPlayer).YTPPause(),YTPlayer.opt.mute||jQuery(YTPlayer).YTPUnmute(),YTPlayer.preventTrigger=!1,"undefined"!=typeof _gaq&&eval(YTPlayer.opt.gaTrack)?_gaq.push(["_trackEvent","YTPlayer","Play",YTPlayer.hasData?YTPlayer.videoData.title:YTPlayer.videoID.toString()]):"undefined"!=typeof ga&&eval(YTPlayer.opt.gaTrack)&&ga("send","event","YTPlayer","play",YTPlayer.hasData?YTPlayer.videoData.title:YTPlayer.videoID.toString()),
YTPlayer.opt.autoPlay){var YTPStart=jQuery.Event("YTPStart");YTPStart.time=YTPlayer.currentTime,jQuery(YTPlayer).trigger(YTPStart),$YTPlayer.YTPPlay(),"mac"==jQuery.mbBrowser.os.name&&jQuery.mbBrowser.safari&&jQuery.mbBrowser.versionCompare(jQuery.mbBrowser.fullVersion,"10.1")<0&&(YTPlayer.safariPlay=setInterval(function(){1!=YTPlayer.state?$YTPlayer.YTPPlay():clearInterval(YTPlayer.safariPlay)},10))}else setTimeout(function(){YTPlayer.player.pauseVideo(),YTPlayer.start_from_last&&YTPlayer.player.seekTo(startAt,!0),YTPlayer.isPlayer||(jQuery(YTPlayer.playerEl).CSSAnimate({opacity:1},YTPlayer.opt.fadeOnStartTime),YTPlayer.wrapper.CSSAnimate({opacity:YTPlayer.isAlone?1:YTPlayer.opt.opacity},YTPlayer.opt.fadeOnStartTime))},150),YTPlayer.controlBar.length&&YTPlayer.controlBar.find(".mb_YTPPlaypause").html(jQuery.mbYTPlayer.controls.play);YTPlayer.isPlayer&&!YTPlayer.opt.autoPlay&&YTPlayer.loading&&YTPlayer.loading.length&&(YTPlayer.loading.html("Ready"),setTimeout(function(){YTPlayer.loading.fadeOut()},100)),YTPlayer.controlBar&&YTPlayer.controlBar.length&&YTPlayer.controlBar.slideDown(1e3)}else"mac"==jQuery.mbBrowser.os.name&&jQuery.mbBrowser.safari&&jQuery.mbBrowser.fullVersion&&jQuery.mbBrowser.versionCompare(jQuery.mbBrowser.fullVersion,"10.1")<0&&(YTPlayer.player.playVideo(),startAt>=0&&YTPlayer.player.seekTo(startAt,!0))},500)},getTime:function(){var a=this.get(0);return jQuery.mbYTPlayer.formatTime(a.currentTime)},getTotalTime:function(a){var b=this.get(0);return jQuery.mbYTPlayer.formatTime(b.totalTime)},formatTime:function(a){var b=Math.floor(a/60),c=Math.floor(a-60*b);return(9>=b?"0"+b:b)+" : "+(9>=c?"0"+c:c)},setAnchor:function(a){var b=this;b.optimizeDisplay(a)},getAnchor:function(){var a=this.get(0);return a.opt.anchor}},jQuery.fn.optimizeDisplay=function(anchor){var YTPlayer=this.get(0),vid={};YTPlayer.opt.anchor=anchor||YTPlayer.opt.anchor,YTPlayer.opt.anchor="undefined "!=typeof YTPlayer.opt.anchor?YTPlayer.opt.anchor:"center,center";var YTPAlign=YTPlayer.opt.anchor.split(","),el=YTPlayer.wrapper,iframe=jQuery(YTPlayer.playerEl);if(YTPlayer.opt.optimizeDisplay){var abundance=iframe.height()*YTPlayer.opt.abundance,win={};win.width=el.outerWidth(),win.height=el.outerHeight()+abundance,YTPlayer.opt.ratio=eval(YTPlayer.opt.ratio),vid.width=win.width,vid.height=Math.ceil(vid.width/YTPlayer.opt.ratio),vid.marginTop=Math.ceil(-((vid.height-win.height)/2)),vid.marginLeft=0;var lowest=vid.height<win.height;lowest&&(vid.height=win.height,vid.width=Math.ceil(vid.height*YTPlayer.opt.ratio),vid.marginTop=0,vid.marginLeft=Math.ceil(-((vid.width-win.width)/2)));for(var a in YTPAlign)if(YTPAlign.hasOwnProperty(a)){var al=YTPAlign[a].replace(/ /g,"");switch(al){case"top":vid.marginTop=lowest?-((vid.height-win.height)/2):0;break;case"bottom":vid.marginTop=lowest?0:-(vid.height-win.height);break;case"left":vid.marginLeft=0;break;case"right":vid.marginLeft=lowest?-(vid.width-win.width):0;break;default:vid.width>win.width&&(vid.marginLeft=-((vid.width-win.width)/2))}}}else vid.width="100%",vid.height="100%",vid.marginTop=0,vid.marginLeft=0;iframe.css({width:vid.width,height:vid.height,marginTop:vid.marginTop,marginLeft:vid.marginLeft,maxWidth:"initial"})},jQuery.shuffle=function(a){for(var b=a.slice(),c=b.length,d=c;d--;){var e=parseInt(Math.random()*c),f=b[d];b[d]=b[e],b[e]=f}return b},jQuery.fn.unselectable=function(){return this.each(function(){jQuery(this).css({"-moz-user-select":"none","-webkit-user-select":"none","user-select":"none"}).attr("unselectable","on")})},jQuery.fn.YTPlayer=jQuery.mbYTPlayer.buildPlayer,jQuery.fn.YTPGetPlayer=jQuery.mbYTPlayer.getPlayer,jQuery.fn.YTPGetVideoID=jQuery.mbYTPlayer.getVideoID,jQuery.fn.YTPGetPlaylistID=jQuery.mbYTPlayer.getPlaylistID,jQuery.fn.YTPChangeVideo=jQuery.fn.YTPChangeMovie=jQuery.mbYTPlayer.changeVideo,jQuery.fn.YTPPlayerDestroy=jQuery.mbYTPlayer.playerDestroy,jQuery.fn.YTPPlay=jQuery.mbYTPlayer.play,jQuery.fn.YTPTogglePlay=jQuery.mbYTPlayer.togglePlay,jQuery.fn.YTPStop=jQuery.mbYTPlayer.stop,jQuery.fn.YTPPause=jQuery.mbYTPlayer.pause,jQuery.fn.YTPSeekTo=jQuery.mbYTPlayer.seekTo,jQuery.fn.YTPlaylist=jQuery.mbYTPlayer.playlist,jQuery.fn.YTPPlayNext=jQuery.mbYTPlayer.playNext,jQuery.fn.YTPPlayPrev=jQuery.mbYTPlayer.playPrev,jQuery.fn.YTPPlayIndex=jQuery.mbYTPlayer.playIndex,jQuery.fn.YTPMute=jQuery.mbYTPlayer.mute,jQuery.fn.YTPUnmute=jQuery.mbYTPlayer.unmute,jQuery.fn.YTPToggleVolume=jQuery.mbYTPlayer.toggleVolume,jQuery.fn.YTPSetVolume=jQuery.mbYTPlayer.setVolume,jQuery.fn.YTPGetVideoData=jQuery.mbYTPlayer.getVideoData,jQuery.fn.YTPFullscreen=jQuery.mbYTPlayer.fullscreen,jQuery.fn.YTPToggleLoops=jQuery.mbYTPlayer.toggleLoops,jQuery.fn.YTPSetVideoQuality=jQuery.mbYTPlayer.setVideoQuality,jQuery.fn.YTPManageProgress=jQuery.mbYTPlayer.manageProgress,jQuery.fn.YTPApplyFilter=jQuery.mbYTPlayer.applyFilter,jQuery.fn.YTPApplyFilters=jQuery.mbYTPlayer.applyFilters,jQuery.fn.YTPToggleFilter=jQuery.mbYTPlayer.toggleFilter,jQuery.fn.YTPToggleFilters=jQuery.mbYTPlayer.toggleFilters,jQuery.fn.YTPRemoveFilter=jQuery.mbYTPlayer.removeFilter,jQuery.fn.YTPDisableFilters=jQuery.mbYTPlayer.disableFilters,jQuery.fn.YTPEnableFilters=jQuery.mbYTPlayer.enableFilters,jQuery.fn.YTPGetFilters=jQuery.mbYTPlayer.getFilters,jQuery.fn.YTPGetTime=jQuery.mbYTPlayer.getTime,jQuery.fn.YTPGetTotalTime=jQuery.mbYTPlayer.getTotalTime,jQuery.fn.YTPAddMask=jQuery.mbYTPlayer.addMask,jQuery.fn.YTPRemoveMask=jQuery.mbYTPlayer.removeMask,jQuery.fn.YTPToggleMask=jQuery.mbYTPlayer.toggleMask,jQuery.fn.YTPSetAnchor=jQuery.mbYTPlayer.setAnchor,jQuery.fn.YTPGetAnchor=jQuery.mbYTPlayer.getAnchor}(jQuery,ytp),jQuery.support.CSStransition=function(){var a=(document.body||document.documentElement).style;return void 0!==a.transition||void 0!==a.WebkitTransition||void 0!==a.MozTransition||void 0!==a.MsTransition||void 0!==a.OTransition}(),jQuery.CSS={name:"mb.CSSAnimate",author:"Matteo Bicocchi",version:"2.0.0",transitionEnd:"transitionEnd",sfx:"",filters:{blur:{min:0,max:100,unit:"px"},brightness:{min:0,max:400,unit:"%"},contrast:{min:0,max:400,unit:"%"},grayscale:{min:0,max:100,unit:"%"},hueRotate:{min:0,max:360,unit:"deg"},invert:{min:0,max:100,unit:"%"},saturate:{min:0,max:400,unit:"%"},sepia:{min:0,max:100,unit:"%"}},normalizeCss:function(a){var b=jQuery.extend(!0,{},a);jQuery.browser.webkit||jQuery.browser.opera?jQuery.CSS.sfx="-webkit-":jQuery.browser.mozilla?jQuery.CSS.sfx="-moz-":jQuery.browser.msie&&(jQuery.CSS.sfx="-ms-"),jQuery.CSS.sfx="";for(var c in b){if("transform"===c&&(b[jQuery.CSS.sfx+"transform"]=b[c],delete b[c]),"transform-origin"===c&&(b[jQuery.CSS.sfx+"transform-origin"]=a[c],delete b[c]),"filter"!==c||jQuery.browser.mozilla||(b[jQuery.CSS.sfx+"filter"]=a[c],delete b[c]),"blur"===c&&setFilter(b,"blur",a[c]),"brightness"===c&&setFilter(b,"brightness",a[c]),"contrast"===c&&setFilter(b,"contrast",a[c]),"grayscale"===c&&setFilter(b,"grayscale",a[c]),"hueRotate"===c&&setFilter(b,"hueRotate",a[c]),"invert"===c&&setFilter(b,"invert",a[c]),"saturate"===c&&setFilter(b,"saturate",a[c]),"sepia"===c&&setFilter(b,"sepia",a[c]),"x"===c){var d=jQuery.CSS.sfx+"transform";b[d]=b[d]||"",b[d]+=" translateX("+setUnit(a[c],"px")+")",delete b[c]}"y"===c&&(d=jQuery.CSS.sfx+"transform",b[d]=b[d]||"",b[d]+=" translateY("+setUnit(a[c],"px")+")",delete b[c]),"z"===c&&(d=jQuery.CSS.sfx+"transform",b[d]=b[d]||"",b[d]+=" translateZ("+setUnit(a[c],"px")+")",delete b[c]),"rotate"===c&&(d=jQuery.CSS.sfx+"transform",b[d]=b[d]||"",b[d]+=" rotate("+setUnit(a[c],"deg")+")",delete b[c]),"rotateX"===c&&(d=jQuery.CSS.sfx+"transform",b[d]=b[d]||"",b[d]+=" rotateX("+setUnit(a[c],"deg")+")",delete b[c]),"rotateY"===c&&(d=jQuery.CSS.sfx+"transform",b[d]=b[d]||"",b[d]+=" rotateY("+setUnit(a[c],"deg")+")",delete b[c]),"rotateZ"===c&&(d=jQuery.CSS.sfx+"transform",b[d]=b[d]||"",b[d]+=" rotateZ("+setUnit(a[c],"deg")+")",delete b[c]),"scale"===c&&(d=jQuery.CSS.sfx+"transform",b[d]=b[d]||"",b[d]+=" scale("+setUnit(a[c],"")+")",delete b[c]),"scaleX"===c&&(d=jQuery.CSS.sfx+"transform",b[d]=b[d]||"",b[d]+=" scaleX("+setUnit(a[c],"")+")",delete b[c]),"scaleY"===c&&(d=jQuery.CSS.sfx+"transform",b[d]=b[d]||"",b[d]+=" scaleY("+setUnit(a[c],"")+")",delete b[c]),"scaleZ"===c&&(d=jQuery.CSS.sfx+"transform",b[d]=b[d]||"",b[d]+=" scaleZ("+setUnit(a[c],"")+")",delete b[c]),"skew"===c&&(d=jQuery.CSS.sfx+"transform",b[d]=b[d]||"",b[d]+=" skew("+setUnit(a[c],"deg")+")",delete b[c]),"skewX"===c&&(d=jQuery.CSS.sfx+"transform",b[d]=b[d]||"",b[d]+=" skewX("+setUnit(a[c],"deg")+")",delete b[c]),"skewY"===c&&(d=jQuery.CSS.sfx+"transform",b[d]=b[d]||"",b[d]+=" skewY("+setUnit(a[c],"deg")+")",delete b[c]),"perspective"===c&&(d=jQuery.CSS.sfx+"transform",b[d]=b[d]||"",b[d]+=" perspective("+setUnit(a[c],"px")+")",delete b[c])}return b},getProp:function(a){var b,c=[];for(b in a)0>c.indexOf(b)&&c.push(uncamel(b));return c.join(",")},animate:function(a,b,c,d,e){return this.each(function(){function f(){g.called=!0,g.CSSAIsRunning=!1,h.off(jQuery.CSS.transitionEnd+"."+g.id),clearTimeout(g.timeout),h.css(jQuery.CSS.sfx+"transition",""),"function"==typeof e&&e.apply(g),"function"==typeof g.CSSqueue&&(g.CSSqueue(),g.CSSqueue=null)}var g=this,h=jQuery(this);g.id=g.id||"CSSA_"+(new Date).getTime();var i=i||{type:"noEvent"};if(g.CSSAIsRunning&&g.eventType==i.type&&!jQuery.browser.msie&&9>=jQuery.browser.version)g.CSSqueue=function(){h.CSSAnimate(a,b,c,d,e)};else if(g.CSSqueue=null,g.eventType=i.type,0!==h.length&&a){if(a=jQuery.normalizeCss(a),g.CSSAIsRunning=!0,"function"==typeof b&&(e=b,b=jQuery.fx.speeds._default),"function"==typeof c&&(d=c,c=0),"string"==typeof c&&(e=c,c=0),"function"==typeof d&&(e=d,d="cubic-bezier(0.65,0.03,0.36,0.72)"),"string"==typeof b)for(var j in jQuery.fx.speeds){if(b==j){b=jQuery.fx.speeds[j];break}b=jQuery.fx.speeds._default}if(b||(b=jQuery.fx.speeds._default),"string"==typeof e&&(d=e,e=null),jQuery.support.CSStransition){var k={"default":"ease","in":"ease-in",out:"ease-out","in-out":"ease-in-out",snap:"cubic-bezier(0,1,.5,1)",easeOutCubic:"cubic-bezier(.215,.61,.355,1)",easeInOutCubic:"cubic-bezier(.645,.045,.355,1)",easeInCirc:"cubic-bezier(.6,.04,.98,.335)",easeOutCirc:"cubic-bezier(.075,.82,.165,1)",easeInOutCirc:"cubic-bezier(.785,.135,.15,.86)",easeInExpo:"cubic-bezier(.95,.05,.795,.035)",easeOutExpo:"cubic-bezier(.19,1,.22,1)",easeInOutExpo:"cubic-bezier(1,0,0,1)",easeInQuad:"cubic-bezier(.55,.085,.68,.53)",easeOutQuad:"cubic-bezier(.25,.46,.45,.94)",easeInOutQuad:"cubic-bezier(.455,.03,.515,.955)",easeInQuart:"cubic-bezier(.895,.03,.685,.22)",easeOutQuart:"cubic-bezier(.165,.84,.44,1)",easeInOutQuart:"cubic-bezier(.77,0,.175,1)",easeInQuint:"cubic-bezier(.755,.05,.855,.06)",easeOutQuint:"cubic-bezier(.23,1,.32,1)",easeInOutQuint:"cubic-bezier(.86,0,.07,1)",easeInSine:"cubic-bezier(.47,0,.745,.715)",easeOutSine:"cubic-bezier(.39,.575,.565,1)",easeInOutSine:"cubic-bezier(.445,.05,.55,.95)",easeInBack:"cubic-bezier(.6,-.28,.735,.045)",easeOutBack:"cubic-bezier(.175, .885,.32,1.275)",easeInOutBack:"cubic-bezier(.68,-.55,.265,1.55)"};k[d]&&(d=k[d]),h.off(jQuery.CSS.transitionEnd+"."+g.id),k=jQuery.CSS.getProp(a);var l={};jQuery.extend(l,a),l[jQuery.CSS.sfx+"transition-property"]=k,l[jQuery.CSS.sfx+"transition-duration"]=b+"ms",l[jQuery.CSS.sfx+"transition-delay"]=c+"ms",l[jQuery.CSS.sfx+"transition-timing-function"]=d,setTimeout(function(){h.one(jQuery.CSS.transitionEnd+"."+g.id,f),h.css(l)},1),g.timeout=setTimeout(function(){g.called||!e?(g.called=!1,g.CSSAIsRunning=!1):(h.css(jQuery.CSS.sfx+"transition",""),e.apply(g),g.CSSAIsRunning=!1,"function"==typeof g.CSSqueue&&(g.CSSqueue(),g.CSSqueue=null))},b+c+10)}else{for(k in a)"transform"===k&&delete a[k],"filter"===k&&delete a[k],"transform-origin"===k&&delete a[k],"auto"===a[k]&&delete a[k],"x"===k&&(i=a[k],j="left",a[j]=i,delete a[k]),"y"===k&&(i=a[k],j="top",a[j]=i,delete a[k]),"-ms-transform"!==k&&"-ms-filter"!==k||delete a[k];h.delay(c).animate(a,b,e)}}})}},jQuery.fn.CSSAnimate=jQuery.CSS.animate,jQuery.normalizeCss=jQuery.CSS.normalizeCss,jQuery.fn.css3=function(a){return this.each(function(){var b=jQuery(this),c=jQuery.normalizeCss(a);b.css(c)})};var nAgt=navigator.userAgent;jQuery.browser=jQuery.browser||{},jQuery.browser.mozilla=!1,jQuery.browser.webkit=!1,jQuery.browser.opera=!1,jQuery.browser.safari=!1,jQuery.browser.chrome=!1,jQuery.browser.androidStock=!1,jQuery.browser.msie=!1,jQuery.browser.edge=!1,jQuery.browser.ua=nAgt;var getOS=function(){var a={version:"Unknown version",name:"Unknown OS"};return-1!=navigator.appVersion.indexOf("Win")&&(a.name="Windows"),-1!=navigator.appVersion.indexOf("Mac")&&0>navigator.appVersion.indexOf("Mobile")&&(a.name="Mac"),-1!=navigator.appVersion.indexOf("Linux")&&(a.name="Linux"),/Mac OS X/.test(nAgt)&&!/Mobile/.test(nAgt)&&(a.version=/Mac OS X (10[\.\_\d]+)/.exec(nAgt)[1],a.version=a.version.replace(/_/g,".").substring(0,5)),/Windows/.test(nAgt)&&(a.version="Unknown.Unknown"),/Windows NT 5.1/.test(nAgt)&&(a.version="5.1"),/Windows NT 6.0/.test(nAgt)&&(a.version="6.0"),/Windows NT 6.1/.test(nAgt)&&(a.version="6.1"),/Windows NT 6.2/.test(nAgt)&&(a.version="6.2"),/Windows NT 10.0/.test(nAgt)&&(a.version="10.0"),/Linux/.test(nAgt)&&/Linux/.test(nAgt)&&(a.version="Unknown.Unknown"),a.name=a.name.toLowerCase(),a.major_version="Unknown",a.minor_version="Unknown","Unknown.Unknown"!=a.version&&(a.major_version=parseFloat(a.version.split(".")[0]),a.minor_version=parseFloat(a.version.split(".")[1])),a};jQuery.browser.os=getOS(),jQuery.browser.hasTouch=isTouchSupported(),jQuery.browser.name=navigator.appName,jQuery.browser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.browser.majorVersion=parseInt(navigator.appVersion,10);var nameOffset,verOffset,ix;if(-1!=(verOffset=nAgt.indexOf("Opera")))jQuery.browser.opera=!0,jQuery.browser.name="Opera",jQuery.browser.fullVersion=nAgt.substring(verOffset+6),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8));else if(-1!=(verOffset=nAgt.indexOf("OPR")))jQuery.browser.opera=!0,jQuery.browser.name="Opera",jQuery.browser.fullVersion=nAgt.substring(verOffset+4);else if(-1!=(verOffset=nAgt.indexOf("MSIE")))jQuery.browser.msie=!0,jQuery.browser.name="Microsoft Internet Explorer",jQuery.browser.fullVersion=nAgt.substring(verOffset+5);else if(-1!=nAgt.indexOf("Trident")){jQuery.browser.msie=!0,jQuery.browser.name="Microsoft Internet Explorer";var start=nAgt.indexOf("rv:")+3,end=start+4;jQuery.browser.fullVersion=nAgt.substring(start,end)}else-1!=(verOffset=nAgt.indexOf("Edge"))?(jQuery.browser.edge=!0,jQuery.browser.name="Microsoft Edge",jQuery.browser.fullVersion=nAgt.substring(verOffset+5)):-1!=(verOffset=nAgt.indexOf("Chrome"))?(jQuery.browser.webkit=!0,jQuery.browser.chrome=!0,jQuery.browser.name="Chrome",jQuery.browser.fullVersion=nAgt.substring(verOffset+7)):-1<nAgt.indexOf("mozilla/5.0")&&-1<nAgt.indexOf("android ")&&-1<nAgt.indexOf("applewebkit")&&!(-1<nAgt.indexOf("chrome"))?(verOffset=nAgt.indexOf("Chrome"),jQuery.browser.webkit=!0,jQuery.browser.androidStock=!0,jQuery.browser.name="androidStock",jQuery.browser.fullVersion=nAgt.substring(verOffset+7)):-1!=(verOffset=nAgt.indexOf("Safari"))?(jQuery.browser.webkit=!0,jQuery.browser.safari=!0,jQuery.browser.name="Safari",jQuery.browser.fullVersion=nAgt.substring(verOffset+7),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8))):-1!=(verOffset=nAgt.indexOf("AppleWebkit"))?(jQuery.browser.webkit=!0,jQuery.browser.safari=!0,jQuery.browser.name="Safari",jQuery.browser.fullVersion=nAgt.substring(verOffset+7),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8))):-1!=(verOffset=nAgt.indexOf("Firefox"))?(jQuery.browser.mozilla=!0,jQuery.browser.name="Firefox",jQuery.browser.fullVersion=nAgt.substring(verOffset+8)):(nameOffset=nAgt.lastIndexOf(" ")+1)<(verOffset=nAgt.lastIndexOf("/"))&&(jQuery.browser.name=nAgt.substring(nameOffset,verOffset),jQuery.browser.fullVersion=nAgt.substring(verOffset+1),jQuery.browser.name.toLowerCase()==jQuery.browser.name.toUpperCase()&&(jQuery.browser.name=navigator.appName));-1!=(ix=jQuery.browser.fullVersion.indexOf(";"))&&(jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,ix)),-1!=(ix=jQuery.browser.fullVersion.indexOf(" "))&&(jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,ix)),jQuery.browser.majorVersion=parseInt(""+jQuery.browser.fullVersion,10),isNaN(jQuery.browser.majorVersion)&&(jQuery.browser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.browser.majorVersion=parseInt(navigator.appVersion,10)),jQuery.browser.version=jQuery.browser.majorVersion,jQuery.browser.android=/Android/i.test(nAgt),jQuery.browser.blackberry=/BlackBerry|BB|PlayBook/i.test(nAgt),jQuery.browser.ios=/iPhone|iPad|iPod|webOS/i.test(nAgt),jQuery.browser.operaMobile=/Opera Mini/i.test(nAgt),jQuery.browser.windowsMobile=/IEMobile|Windows Phone/i.test(nAgt),jQuery.browser.kindle=/Kindle|Silk/i.test(nAgt),jQuery.browser.mobile=jQuery.browser.android||jQuery.browser.blackberry||jQuery.browser.ios||jQuery.browser.windowsMobile||jQuery.browser.operaMobile||jQuery.browser.kindle,jQuery.isMobile=jQuery.browser.mobile,jQuery.isTablet=jQuery.browser.mobile&&765<jQuery(window).width(),jQuery.isAndroidDefault=jQuery.browser.android&&!/chrome/i.test(nAgt),jQuery.mbBrowser=jQuery.browser,jQuery.browser.versionCompare=function(a,b){if("stringstring"!=typeof a+typeof b)return!1;for(var c=a.split("."),d=b.split("."),e=0,f=Math.max(c.length,d.length);f>e;e++){if(c[e]&&!d[e]&&0<parseInt(c[e])||parseInt(c[e])>parseInt(d[e]))return 1;if(d[e]&&!c[e]&&0<parseInt(d[e])||parseInt(c[e])<parseInt(d[e]))return-1}return 0};var nAgt=navigator.userAgent;jQuery.browser=jQuery.browser||{},jQuery.browser.mozilla=!1,jQuery.browser.webkit=!1,jQuery.browser.opera=!1,jQuery.browser.safari=!1,jQuery.browser.chrome=!1,jQuery.browser.androidStock=!1,jQuery.browser.msie=!1,jQuery.browser.edge=!1,jQuery.browser.ua=nAgt;var getOS=function(){var a={version:"Unknown version",name:"Unknown OS"};return-1!=navigator.appVersion.indexOf("Win")&&(a.name="Windows"),-1!=navigator.appVersion.indexOf("Mac")&&0>navigator.appVersion.indexOf("Mobile")&&(a.name="Mac"),-1!=navigator.appVersion.indexOf("Linux")&&(a.name="Linux"),/Mac OS X/.test(nAgt)&&!/Mobile/.test(nAgt)&&(a.version=/Mac OS X (10[\.\_\d]+)/.exec(nAgt)[1],a.version=a.version.replace(/_/g,".").substring(0,5)),/Windows/.test(nAgt)&&(a.version="Unknown.Unknown"),/Windows NT 5.1/.test(nAgt)&&(a.version="5.1"),/Windows NT 6.0/.test(nAgt)&&(a.version="6.0"),/Windows NT 6.1/.test(nAgt)&&(a.version="6.1"),/Windows NT 6.2/.test(nAgt)&&(a.version="6.2"),/Windows NT 10.0/.test(nAgt)&&(a.version="10.0"),/Linux/.test(nAgt)&&/Linux/.test(nAgt)&&(a.version="Unknown.Unknown"),a.name=a.name.toLowerCase(),a.major_version="Unknown",a.minor_version="Unknown","Unknown.Unknown"!=a.version&&(a.major_version=parseFloat(a.version.split(".")[0]),a.minor_version=parseFloat(a.version.split(".")[1])),a};jQuery.browser.os=getOS(),jQuery.browser.hasTouch=isTouchSupported(),jQuery.browser.name=navigator.appName,jQuery.browser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.browser.majorVersion=parseInt(navigator.appVersion,10);var nameOffset,verOffset,ix;if(-1!=(verOffset=nAgt.indexOf("Opera")))jQuery.browser.opera=!0,jQuery.browser.name="Opera",jQuery.browser.fullVersion=nAgt.substring(verOffset+6),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8));else if(-1!=(verOffset=nAgt.indexOf("OPR")))jQuery.browser.opera=!0,jQuery.browser.name="Opera",jQuery.browser.fullVersion=nAgt.substring(verOffset+4);else if(-1!=(verOffset=nAgt.indexOf("MSIE")))jQuery.browser.msie=!0,jQuery.browser.name="Microsoft Internet Explorer",jQuery.browser.fullVersion=nAgt.substring(verOffset+5);else if(-1!=nAgt.indexOf("Trident")){jQuery.browser.msie=!0,jQuery.browser.name="Microsoft Internet Explorer";var start=nAgt.indexOf("rv:")+3,end=start+4;jQuery.browser.fullVersion=nAgt.substring(start,end)}else-1!=(verOffset=nAgt.indexOf("Edge"))?(jQuery.browser.edge=!0,jQuery.browser.name="Microsoft Edge",jQuery.browser.fullVersion=nAgt.substring(verOffset+5)):-1!=(verOffset=nAgt.indexOf("Chrome"))?(jQuery.browser.webkit=!0,jQuery.browser.chrome=!0,jQuery.browser.name="Chrome",jQuery.browser.fullVersion=nAgt.substring(verOffset+7)):-1<nAgt.indexOf("mozilla/5.0")&&-1<nAgt.indexOf("android ")&&-1<nAgt.indexOf("applewebkit")&&!(-1<nAgt.indexOf("chrome"))?(verOffset=nAgt.indexOf("Chrome"),jQuery.browser.webkit=!0,jQuery.browser.androidStock=!0,jQuery.browser.name="androidStock",jQuery.browser.fullVersion=nAgt.substring(verOffset+7)):-1!=(verOffset=nAgt.indexOf("Safari"))?(jQuery.browser.webkit=!0,jQuery.browser.safari=!0,jQuery.browser.name="Safari",jQuery.browser.fullVersion=nAgt.substring(verOffset+7),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8))):-1!=(verOffset=nAgt.indexOf("AppleWebkit"))?(jQuery.browser.webkit=!0,jQuery.browser.safari=!0,jQuery.browser.name="Safari",jQuery.browser.fullVersion=nAgt.substring(verOffset+7),-1!=(verOffset=nAgt.indexOf("Version"))&&(jQuery.browser.fullVersion=nAgt.substring(verOffset+8))):-1!=(verOffset=nAgt.indexOf("Firefox"))?(jQuery.browser.mozilla=!0,jQuery.browser.name="Firefox",jQuery.browser.fullVersion=nAgt.substring(verOffset+8)):(nameOffset=nAgt.lastIndexOf(" ")+1)<(verOffset=nAgt.lastIndexOf("/"))&&(jQuery.browser.name=nAgt.substring(nameOffset,verOffset),jQuery.browser.fullVersion=nAgt.substring(verOffset+1),jQuery.browser.name.toLowerCase()==jQuery.browser.name.toUpperCase()&&(jQuery.browser.name=navigator.appName));-1!=(ix=jQuery.browser.fullVersion.indexOf(";"))&&(jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,ix)),-1!=(ix=jQuery.browser.fullVersion.indexOf(" "))&&(jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,ix)),jQuery.browser.majorVersion=parseInt(""+jQuery.browser.fullVersion,10),isNaN(jQuery.browser.majorVersion)&&(jQuery.browser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.browser.majorVersion=parseInt(navigator.appVersion,10)),jQuery.browser.version=jQuery.browser.majorVersion,jQuery.browser.android=/Android/i.test(nAgt),jQuery.browser.blackberry=/BlackBerry|BB|PlayBook/i.test(nAgt),jQuery.browser.ios=/iPhone|iPad|iPod|webOS/i.test(nAgt),jQuery.browser.operaMobile=/Opera Mini/i.test(nAgt),jQuery.browser.windowsMobile=/IEMobile|Windows Phone/i.test(nAgt),jQuery.browser.kindle=/Kindle|Silk/i.test(nAgt),jQuery.browser.mobile=jQuery.browser.android||jQuery.browser.blackberry||jQuery.browser.ios||jQuery.browser.windowsMobile||jQuery.browser.operaMobile||jQuery.browser.kindle,jQuery.isMobile=jQuery.browser.mobile,jQuery.isTablet=jQuery.browser.mobile&&765<jQuery(window).width(),jQuery.isAndroidDefault=jQuery.browser.android&&!/chrome/i.test(nAgt),jQuery.mbBrowser=jQuery.browser,jQuery.browser.versionCompare=function(a,b){if("stringstring"!=typeof a+typeof b)return!1;for(var c=a.split("."),d=b.split("."),e=0,f=Math.max(c.length,d.length);f>e;e++){if(c[e]&&!d[e]&&0<parseInt(c[e])||parseInt(c[e])>parseInt(d[e]))return 1;if(d[e]&&!c[e]&&0<parseInt(d[e])||parseInt(c[e])<parseInt(d[e]))return-1}return 0},function(a){a.simpleSlider={defaults:{initialval:0,scale:100,orientation:"h",readonly:!1,callback:!1},events:{start:a.browser.mobile?"touchstart":"mousedown",end:a.browser.mobile?"touchend":"mouseup",move:a.browser.mobile?"touchmove":"mousemove"},init:function(b){return this.each(function(){var c=this,d=a(c);d.addClass("simpleSlider"),c.opt={},a.extend(c.opt,a.simpleSlider.defaults,b),a.extend(c.opt,d.data());var e="h"==c.opt.orientation?"horizontal":"vertical";e=a("<div/>").addClass("level").addClass(e),d.prepend(e),c.level=e,d.css({cursor:"default"}),"auto"==c.opt.scale&&(c.opt.scale=a(c).outerWidth()),d.updateSliderVal(),c.opt.readonly||(d.on(a.simpleSlider.events.start,function(b){a.browser.mobile&&(b=b.changedTouches[0]),c.canSlide=!0,d.updateSliderVal(b),"h"==c.opt.orientation?d.css({cursor:"col-resize"}):d.css({cursor:"row-resize"}),a.browser.mobile||(b.preventDefault(),b.stopPropagation())}),a(document).on(a.simpleSlider.events.move,function(b){a.browser.mobile&&(b=b.changedTouches[0]),c.canSlide&&(a(document).css({cursor:"default"}),d.updateSliderVal(b),a.browser.mobile||(b.preventDefault(),b.stopPropagation()))}).on(a.simpleSlider.events.end,function(){a(document).css({cursor:"auto"}),c.canSlide=!1,d.css({cursor:"auto"})}))})},updateSliderVal:function(b){var c=this.get(0);if(c.opt){c.opt.initialval="number"==typeof c.opt.initialval?c.opt.initialval:c.opt.initialval(c);var d=a(c).outerWidth(),e=a(c).outerHeight();c.x="object"==typeof b?b.clientX+document.body.scrollLeft-this.offset().left:"number"==typeof b?b*d/c.opt.scale:c.opt.initialval*d/c.opt.scale,c.y="object"==typeof b?b.clientY+document.body.scrollTop-this.offset().top:"number"==typeof b?(c.opt.scale-c.opt.initialval-b)*e/c.opt.scale:c.opt.initialval*e/c.opt.scale,c.y=this.outerHeight()-c.y,c.scaleX=c.x*c.opt.scale/d,c.scaleY=c.y*c.opt.scale/e,c.outOfRangeX=c.scaleX>c.opt.scale?c.scaleX-c.opt.scale:0>c.scaleX?c.scaleX:0,c.outOfRangeY=c.scaleY>c.opt.scale?c.scaleY-c.opt.scale:0>c.scaleY?c.scaleY:0,c.outOfRange="h"==c.opt.orientation?c.outOfRangeX:c.outOfRangeY,c.value="undefined"!=typeof b?"h"==c.opt.orientation?c.x>=this.outerWidth()?c.opt.scale:0>=c.x?0:c.scaleX:c.y>=this.outerHeight()?c.opt.scale:0>=c.y?0:c.scaleY:"h"==c.opt.orientation?c.scaleX:c.scaleY,"h"==c.opt.orientation?c.level.width(Math.floor(100*c.x/d)+"%"):c.level.height(Math.floor(100*c.y/e)),"function"==typeof c.opt.callback&&c.opt.callback(c)}}},a.fn.simpleSlider=a.simpleSlider.init,a.fn.updateSliderVal=a.simpleSlider.updateSliderVal}(jQuery),function(a){a.mbCookie={set:function(a,b,c,d){"object"==typeof b&&(b=JSON.stringify(b)),d=d?"; domain="+d:"";var e=new Date,f="";c>0&&(e.setTime(e.getTime()+864e5*c),f="; expires="+e.toGMTString()),document.cookie=a+"="+b+f+"; path=/"+d},get:function(a){a+="=";for(var b=document.cookie.split(";"),c=0;c<b.length;c++){for(var d=b[c];" "==d.charAt(0);)d=d.substring(1,d.length);if(0==d.indexOf(a))try{return JSON.parse(d.substring(a.length,d.length))}catch(e){return d.substring(a.length,d.length)}}return null},remove:function(b){a.mbCookie.set(b,"",-1)}},a.mbStorage={set:function(a,b){"object"==typeof b&&(b=JSON.stringify(b)),localStorage.setItem(a,b)},get:function(a){if(!localStorage[a])return null;try{return JSON.parse(localStorage[a])}catch(b){return localStorage[a]}},remove:function(a){a?localStorage.removeItem(a):localStorage.clear()}}}(jQuery);


//------------- DETAIL ADD - MINUS COUNT ORDER -------------//
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('data-min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('data-min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('data-max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('data-max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('data-min'));
    maxValue =  parseInt($(this).attr('data-max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    /*!
 * The Final Countdown for jQuery v2.2.0 (http://hilios.github.io/jQuery.countdown/)
 * Copyright (c) 2016 Edson Hilios
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
!function(a){"use strict";"function"==typeof define&&define.amd?define(["jquery"],a):a(jQuery)}(function(a){"use strict";function b(a){if(a instanceof Date)return a;if(String(a).match(g))return String(a).match(/^[0-9]*$/)&&(a=Number(a)),String(a).match(/\-/)&&(a=String(a).replace(/\-/g,"/")),new Date(a);throw new Error("Couldn't cast `"+a+"` to a date object.")}function c(a){var b=a.toString().replace(/([.?*+^$[\]\\(){}|-])/g,"\\$1");return new RegExp(b)}function d(a){return function(b){var d=b.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi);if(d)for(var f=0,g=d.length;f<g;++f){var h=d[f].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/),j=c(h[0]),k=h[1]||"",l=h[3]||"",m=null;h=h[2],i.hasOwnProperty(h)&&(m=i[h],m=Number(a[m])),null!==m&&("!"===k&&(m=e(l,m)),""===k&&m<10&&(m="0"+m.toString()),b=b.replace(j,m.toString()))}return b=b.replace(/%%/,"%")}}function e(a,b){var c="s",d="";return a&&(a=a.replace(/(:|;|\s)/gi,"").split(/\,/),1===a.length?c=a[0]:(d=a[0],c=a[1])),Math.abs(b)>1?c:d}var f=[],g=[],h={precision:100,elapse:!1,defer:!1};g.push(/^[0-9]*$/.source),g.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source),g.push(/[0-9]{4}([\/\-][0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source),g=new RegExp(g.join("|"));var i={Y:"years",m:"months",n:"daysToMonth",d:"daysToWeek",w:"weeks",W:"weeksToMonth",H:"hours",M:"minutes",S:"seconds",D:"totalDays",I:"totalHours",N:"totalMinutes",T:"totalSeconds"},j=function(b,c,d){this.el=b,this.$el=a(b),this.interval=null,this.offset={},this.options=a.extend({},h),this.firstTick=!0,this.instanceNumber=f.length,f.push(this),this.$el.data("countdown-instance",this.instanceNumber),d&&("function"==typeof d?(this.$el.on("update.countdown",d),this.$el.on("stoped.countdown",d),this.$el.on("finish.countdown",d)):this.options=a.extend({},h,d)),this.setFinalDate(c),this.options.defer===!1&&this.start()};a.extend(j.prototype,{start:function(){null!==this.interval&&clearInterval(this.interval);var a=this;this.update(),this.interval=setInterval(function(){a.update.call(a)},this.options.precision)},stop:function(){clearInterval(this.interval),this.interval=null,this.dispatchEvent("stoped")},toggle:function(){this.interval?this.stop():this.start()},pause:function(){this.stop()},resume:function(){this.start()},remove:function(){this.stop.call(this),f[this.instanceNumber]=null,delete this.$el.data().countdownInstance},setFinalDate:function(a){this.finalDate=b(a)},update:function(){if(0===this.$el.closest("html").length)return void this.remove();var a,b=new Date;return a=this.finalDate.getTime()-b.getTime(),a=Math.ceil(a/1e3),a=!this.options.elapse&&a<0?0:Math.abs(a),this.totalSecsLeft===a||this.firstTick?void(this.firstTick=!1):(this.totalSecsLeft=a,this.elapsed=b>=this.finalDate,this.offset={seconds:this.totalSecsLeft%60,minutes:Math.floor(this.totalSecsLeft/60)%60,hours:Math.floor(this.totalSecsLeft/60/60)%24,days:Math.floor(this.totalSecsLeft/60/60/24)%7,daysToWeek:Math.floor(this.totalSecsLeft/60/60/24)%7,daysToMonth:Math.floor(this.totalSecsLeft/60/60/24%30.4368),weeks:Math.floor(this.totalSecsLeft/60/60/24/7),weeksToMonth:Math.floor(this.totalSecsLeft/60/60/24/7)%4,months:Math.floor(this.totalSecsLeft/60/60/24/30.4368),years:Math.abs(this.finalDate.getFullYear()-b.getFullYear()),totalDays:Math.floor(this.totalSecsLeft/60/60/24),totalHours:Math.floor(this.totalSecsLeft/60/60),totalMinutes:Math.floor(this.totalSecsLeft/60),totalSeconds:this.totalSecsLeft},void(this.options.elapse||0!==this.totalSecsLeft?this.dispatchEvent("update"):(this.stop(),this.dispatchEvent("finish"))))},dispatchEvent:function(b){var c=a.Event(b+".countdown");c.finalDate=this.finalDate,c.elapsed=this.elapsed,c.offset=a.extend({},this.offset),c.strftime=d(this.offset),this.$el.trigger(c)}}),a.fn.countdown=function(){var b=Array.prototype.slice.call(arguments,0);return this.each(function(){var c=a(this).data("countdown-instance");if(void 0!==c){var d=f[c],e=b[0];j.prototype.hasOwnProperty(e)?d[e].apply(d,b.slice(1)):null===String(e).match(/^[$A-Z_][0-9A-Z_$]*$/i)?(d.setFinalDate.call(d,e),d.start()):a.error("Method %s does not exist on jQuery.countdown".replace(/\%s/gi,e))}else new j(this,b[0],b[1])})}});	

/*!
* jquery.counterup.js 1.0
*
* Copyright 2013, Benjamin Intal http://gambit.ph @bfintal
* Released under the GPL v2 License
*
* Date: Nov 26, 2013
*/(function(e){"use strict";e.fn.counterUp=function(t){var n=e.extend({time:400,delay:10},t);return this.each(function(){var t=e(this),r=n,i=function(){var e=[],n=r.time/r.delay,i=t.text(),s=/[0-9]+,[0-9]+/.test(i);i=i.replace(/,/g,"");var o=/^[0-9]+$/.test(i),u=/^[0-9]+\.[0-9]+$/.test(i),a=u?(i.split(".")[1]||[]).length:0;for(var f=n;f>=1;f--){var l=parseInt(i/n*f);u&&(l=parseFloat(i/n*f).toFixed(a));if(s)while(/(\d+)(\d{3})/.test(l.toString()))l=l.toString().replace(/(\d+)(\d{3})/,"$1,$2");e.unshift(l)}t.data("counterup-nums",e);t.text("0");var c=function(){t.text(t.data("counterup-nums").shift());if(t.data("counterup-nums").length)setTimeout(t.data("counterup-func"),r.delay);else{delete t.data("counterup-nums");t.data("counterup-nums",null);t.data("counterup-func",null)}};t.data("counterup-func",c);setTimeout(t.data("counterup-func"),r.delay)};t.waypoint(i,{offset:"100%",triggerOnce:!0})})}})(jQuery);
/*!
 * scrollup v2.4.1
 * Url: http://markgoodyear.com/labs/scrollup/
 * Copyright (c) Mark Goodyear — @markgdyr — http://markgoodyear.com
 * License: MIT
 */
!function(l,o,e){"use strict";l.fn.scrollUp=function(o){l.data(e.body,"scrollUp")||(l.data(e.body,"scrollUp",!0),l.fn.scrollUp.init(o))},l.fn.scrollUp.init=function(r){var s,t,c,i,n,a,d,p=l.fn.scrollUp.settings=l.extend({},l.fn.scrollUp.defaults,r),f=!1;switch(d=p.scrollTrigger?l(p.scrollTrigger):l("<a/>",{id:p.scrollName,href:"#top"}),p.scrollTitle&&d.attr("title",p.scrollTitle),d.appendTo("body"),p.scrollImg||p.scrollTrigger||d.html(p.scrollText),d.css({display:"none",position:"fixed",zIndex:p.zIndex}),p.activeOverlay&&l("<div/>",{id:p.scrollName+"-active"}).css({position:"absolute",top:p.scrollDistance+"px",width:"100%",borderTop:"1px dotted"+p.activeOverlay,zIndex:p.zIndex}).appendTo("body"),p.animation){case"fade":s="fadeIn",t="fadeOut",c=p.animationSpeed;break;case"slide":s="slideDown",t="slideUp",c=p.animationSpeed;break;default:s="show",t="hide",c=0}i="top"===p.scrollFrom?p.scrollDistance:l(e).height()-l(o).height()-p.scrollDistance,n=l(o).scroll(function(){l(o).scrollTop()>i?f||(d[s](c),f=!0):f&&(d[t](c),f=!1)}),p.scrollTarget?"number"==typeof p.scrollTarget?a=p.scrollTarget:"string"==typeof p.scrollTarget&&(a=Math.floor(l(p.scrollTarget).offset().top)):a=0,d.click(function(o){o.preventDefault(),l("html, body").animate({scrollTop:a},p.scrollSpeed,p.easingType)})},l.fn.scrollUp.defaults={scrollName:"scrollUp",scrollDistance:300,scrollFrom:"top",scrollSpeed:300,easingType:"linear",animation:"fade",animationSpeed:200,scrollTrigger:!1,scrollTarget:!1,scrollText:"Scroll to top",scrollTitle:!1,scrollImg:!1,activeOverlay:!1,zIndex:2147483647},l.fn.scrollUp.destroy=function(r){l.removeData(e.body,"scrollUp"),l("#"+l.fn.scrollUp.settings.scrollName).remove(),l("#"+l.fn.scrollUp.settings.scrollName+"-active").remove(),l.fn.jquery.split(".")[1]>=7?l(o).off("scroll",r):l(o).unbind("scroll",r)},l.scrollUp=l.fn.scrollUp}(jQuery,window,document);
	