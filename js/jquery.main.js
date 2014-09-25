function detectmob(){ 
	if( navigator.userAgent.match(/Android/i)
		|| navigator.userAgent.match(/webOS/i)
		|| navigator.userAgent.match(/iPhone/i)
		|| navigator.userAgent.match(/iPad/i)
		|| navigator.userAgent.match(/iPod/i)
		|| navigator.userAgent.match(/BlackBerry/i)
		|| navigator.userAgent.match(/Windows Phone/i)
	){
		return true;
	}
	else {
		return false;
	}
}

if ( !detectmob() ) {
	$(function(){
		initNiceScroll();
		initPopup();
		initFirstPageHeight();
		initScrollTo();
		initSameHeight();
		initCustomFileInput();
		randomBackground();
	});

	$(window).load(function(){
		initTechnologyWidth();
		// initCaseFixed();
		//initWaypoints();
		initBackgroundResize();
	});
}
else {
	$(function(){
		initPopup();
		initFirstPageHeight();
		mobileRandomBackground();
		initScrollTo();
		initSameHeight();
		initCustomFileInput();
	});

	$(window).load(function(){
		// initTechnologyWidth();
		// initCaseFixed();
		//initWaypoints();
		// initBackgroundResize();
		initNiceScrollMobile();

	});
}

function initCustomFileInput() {
	$('.custom-file').on('change', function() {
		$('.custom-file').each(function() {
			$('.add-resume').find('.remove').remove();
			var name = this.value;
			reWin = /.*\\(.*)/;
			var fileTitle = name.replace(reWin, "$1");
			reUnix = /.*\/(.*)/;
			fileTitle = fileTitle.replace(reUnix, "$1");
			$(this).closest('.add-resume').addClass('uploaded').find('.name').html(fileTitle).after('<span class="remove"></span>');
		});
	});

	$('.add-resume').on('click', '.remove', function () {
		$(this).closest('.add-resume').removeClass('uploaded').find('.name').html('');
		$(this).closest('.add-resume').find('.custom-file').val("");
		$(this).remove();
	});
}

// background stretching
function initBackgroundResize() {
		var holder = document.getElementById('bg');
		var flag = $('.first-page');
		if(holder && flag.length>0) {
				var images = holder.getElementsByTagName('img');
				for(var i = 0; i < images.length; i++) {
						BackgroundStretcher.stretchImage(images[i]);
				}
				BackgroundStretcher.setBgHolder(holder);
				
				// handle font resize
				jQuery(window).bind('fontresize', function(e){
						BackgroundStretcher.resizeAll();
				});
		}
}

function initFirstPageHeight() {
	var newHeight = $(window).height() - $('#header').outerHeight();
	var firstPageHeight = $('.first-page').height();
	if ( newHeight < firstPageHeight) {
		newHeight = firstPageHeight + 50;
	}
	$('.first-page').height(newHeight);
}

function initNiceScroll() {
	$('body').niceScroll({
		cursoropacitymax: 0.5,
		mousescrollstep: 20,
		scrollspeed: 40
	});

	$('.technology-section').niceScroll({
		cursorcolor: '#ffffff',
		cursorborder: 'none',
		cursoropacitymin: 0.76,
		cursoropacitymax: 0.76,
		autohidemode: false,
		touchbehavior: true,
		railvalign: 'top',
		mousescrollstep: 15
	});
}
function initNiceScrollMobile() {
	$('.technology-section').niceScroll({
		cursorcolor: '#ffffff',
		cursorborder: 'none',
		cursoropacitymin: 0.76,
		cursoropacitymax: 0.76,
		autohidemode: false,
		railvalign: 'top'
	});
}

function initScrollTo() {
	$('#nav').on('click', 'a', function(){
		var path = $(this).attr('href');
		var destination = $(path).offset().top - 50;
		$('html, body').animate({scrollTop: destination + "px"}, 1000);
		return false;
	});
}

function initTechnologyWidth() {
	var section = $('.technology-section');
	if(section.length>0){
var items = section.find('.item');
	var newWidth = 0;
	var selector = section.find('.frame');
	var frameOffsetTop = section.offset().top + 100;
	var frameOffsetLeft = section.offset().left;
	$.each(items, function() {
		newWidth+= $(this).outerWidth();
	});
	
	selector.width(newWidth + 120);
	selector.height(selector.height());

	$.each(items, function() {
		var item = $(this),
			leftPosition = item.position().left,
			info = item.find('.info');
		item.data('info-block', info);
		if (leftPosition > 970) {
			info.hide();
		}
	});

	section.scrollLeft(0);
	items.find('.technology-header').css({'opacity': 0});
	$('#wrapper').append('<div class="heading-box"></div>');
	var headingBox = $('.heading-box');
	var m2 = $('.technology-page').find('.m2');
	items.clone().appendTo($('.heading-box'));
	headingBox.find('.info').remove();
	headingBox.find('.btn').remove();
	headingBox.find('.technology-header').css({'opacity': 1});
	headingBox.css({'position':'absolute', 'top':frameOffsetTop, 'left':frameOffsetLeft}).width(9999);
	
	section.on('scroll', function(){
		var leftScroll = $(this).scrollLeft();
		var bgp = ((leftScroll * 100)/newWidth).toFixed(3);
		headingBox.css({'margin-left': -leftScroll})
		m2.css({'background-position' :  bgp + '% 148px'});

		$.each(items, function() {
			var item = $(this),
				leftPosition = item.position().left,
				info = item.data('info-block');
			if(leftScroll-200 > leftPosition || leftScroll+800 <leftPosition){
				info.fadeOut(300);
			}
			else if (leftScroll+800 > leftPosition) {
				info.fadeIn(400);
			}
		});

	});

	}	
	
}

function initWaypoints() {
	var navigationItems = $('#nav').find('li');
	var pageIndex = $('.page' + $('.page').index());
	function clearNav() {
		navigationItems.removeClass('active');
	}
	function reduceHeader() {
		$('#header').animate({opacity:0}, 0, function(){
			$(this).animate({opacity:1}, 300);
			$('#wrapper').addClass('header-small');
			$('#bg').fadeOut(200);
		});
	}
	function enlargeHeader() {
		$('#header').animate({opacity:0}, 300, function(){
			$('#wrapper').removeClass('header-small');
			$(this).animate({opacity:1}, 0);
			$('#bg').fadeIn(200);
		});
	}
	$('.page').waypoint( function(direction) {
			clearNav();
			var currentIndex = $(this).index();
			if (currentIndex == 0 && direction == 'up'){
				clearNav();
			}
			else if (direction == 'down') {
				navigationItems.eq(currentIndex).addClass('active');
			}
			else if (direction == 'up') {
				navigationItems.eq(currentIndex - 1).addClass('active');
			}
		}, {
			offset: 70,
		}
	);
	$.each($('.page'), function(){
		$(this).attr('id', function(){
			return "pageId" + ($(this).index() + 1);
		});
	});
	$('#pageId1').waypoint( function(direction) {
			if (direction == 'down') {
				reduceHeader();
			}
			else {
				enlargeHeader();
			}
		   
		}, {
			offset: 70
		}
	);
}

function initCaseFixed() {
//    var offsetOriginal = $('.case-info').offset();
	var selector = $('.case-info');
	var parentSelector = selector.parent();
	var offsetOriginal = selector.offset();
	var offsetReset = selector.removeAttr("style").offset();
	var deltaHeight = parentSelector.height() - selector.height();
	var deltaOffset = parentSelector.offset().top + deltaHeight - 80;
	// $(window).on('resize', function(){
	//     offsetReset = selector.removeAttr("style").offset();
	//     selector.css({
	//         'position': 'fixed',
	//             'top' : '80px',
	//             'left' : offsetReset.left
	//     });
	//     if(selector.height() > $(window).height()){
	//         selector.removeAttr("style");
	//     }
	// });

	$(document).scroll(function () {
		var y = $(this).scrollTop();
		if (offsetOriginal.top < y && y < deltaOffset) {
			selector.css({
				'position': 'fixed',
				'left' : offsetReset.left,
				'top' : 80
			});
		}
		else if (selector.offset().top <= offsetOriginal.top ) {
			selector.offset({ top : offsetOriginal.top, left: offsetReset.left }).css({'position': 'static'});
		}
		else if (y > deltaOffset) {
			selector.css({
				'position':'absolute',
				'top':'auto',
				'left':'auto',
				'right':0,
				'bottom':40
			});
		}
		
	   if(selector.height() > $(window).height()){
		   selector.removeAttr("style");
	   }
	});
}

// align blocks height
function initSameHeight() {
	jQuery('.four-columns').sameHeight({
		elements: '.col-heading',
		flexible: true,
		multiLine: true,
		useMinHeight: true
	});

	jQuery('.three-columns').sameHeight({
		elements: '.col-heading',
		flexible: true,
		multiLine: true,
		useMinHeight: true
	});
}

function initPopup() {
	$('.inline').colorbox();
}

function getRandomInt(min, max){
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function randomBackground() {
	if($('.first-page').length>0){
		var image =  $('#bg').find('img');
	var random = getRandomInt(1, 5);
	var randomImage = ("images/backgrounds/bg-body" + random + ".jpg").toString();
	var smallImage = ("url(images/backgrounds/bg-body" + random + ".jpg)").toString();
	var firstPage = $('.first-page');
	var offsetTop = firstPage.height();
	var header = $('#header');
	var flag = true;
	var win = $(window);
	image.attr('src', randomImage);
	function refreshPosition(){
		offsetTop = firstPage.height();
		var scrollTop = win.scrollTop();
		if (flag && scrollTop > offsetTop ){
			flag = false;
			header.css({
				'background-image': smallImage,
				'background-position': '50% -400px',
				'background-size': 'cover'
			});
		}
		else if(!flag && scrollTop <= offsetTop) {
			flag = true;
			header.css({
				'background-image': 'none'
			});
		}
	}
	win.on('load', function(){
		refreshPosition();
		win.on('scroll', refreshPosition);
	});
	win.on('resize', refreshPosition);
	}
	
}

function mobileRandomBackground() {
	var random = getRandomInt(1, 5);
	var image = ("url(images/backgrounds/bg-body" + random + ".jpg)").toString();
	var firstPage = $('.first-page');
	var offsetTop = firstPage.height();
	var flag = true;
	var win = $(window);
	$('body').css({
		'background-image': image
	});
	win.on('load', function(){
		offsetTop = firstPage.height();
		if ( $('#wrapper').hasClass('header-small') ){
			$('.header-small #header').css({
				'background-image': image,
				'background-position': '50% -400px',
				'background-size': 'cover'
			});
		}
		win.on('scroll', function() {
			var scrollTop = win.scrollTop();
			if (flag && scrollTop > offsetTop && $('#wrapper').hasClass('header-small') ){
				flag = false;
				$('.header-small #header').css({
					'background-image': image,
					'background-position': '50% -400px',
					'background-size': 'cover'
				});
			}
			else if(!flag && scrollTop <= offsetTop){
				flag = true;
				$('#header').css({
					'background-image': 'none'
				});
			}
		})
	});
	win.on('resize orientationchange', function(){
		offsetTop = firstPage.height();
	});
}

// background stretch module
(function(){
		var isTouchDevice = (/MSIE 10.*Touch/.test(navigator.userAgent)) || ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch;
		BackgroundStretcher = {
				images: [],
				holders: [],
				viewWidth: 0,
				viewHeight: 0,
				ieFastMode: true,
				stretchBy: isTouchDevice ? 'page' : 'window',
				init: function(){
						this.addHandlers();
						this.resizeAll();
						return this;
				},
				stretchImage: function(origImg) {
						// wrap image and apply smoothing
						var obj = this.prepareImage(origImg);
						
						// handle onload
						var img = new Image();
						img.onload = this.bind(function(){
								obj.iRatio = img.width / img.height;
								this.resizeImage(obj);
						});
						img.src = origImg.src;
						this.images.push(obj);
				},
				prepareImage: function(img) {
						var wrapper = document.createElement('span');
						img.parentNode.insertBefore(wrapper, img);
						wrapper.appendChild(img);
				
						if(/MSIE (6|7|8)/.test(navigator.userAgent) && img.tagName.toLowerCase() === 'img') {
								wrapper.style.position = 'absolute';
								wrapper.style.display = 'block';
								wrapper.style.zoom = 1;
								if(this.ieFastMode) {
										img.style.display = 'none';
										wrapper.style.filter = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'+img.src+'", sizingMethod="scale")'; // enable smoothing in IE6
										return wrapper;
								} else {
										img.style.msInterpolationMode = 'bicubic'; // IE7 smooth fix
										return img;
								}
						} else {
								return img;
						}
				},
				setBgHolder: function(obj) {
						if(this.stretchBy === 'window' || this.stretchBy === 'page') {
								this.holders.push(obj);
								this.resizeAll();
						}
				},
				resizeImage: function(obj) {
						if(obj.iRatio) {
								// calculate dimensions
								var dimensions = this.getProportion({
										ratio: obj.iRatio,
										maskWidth: this.viewWidth,
										maskHeight: this.viewHeight
								});
								// apply new styles
								obj.style.width = dimensions.width + 'px';
								obj.style.height = dimensions.height + 'px';
								obj.style.top = dimensions.top + 'px';
								obj.style.left = dimensions.left +'px';
						}
				},
				resizeHolder: function(obj) {
						obj.style.width = this.viewWidth+'px';
						obj.style.height = this.viewHeight+'px';
				},
				getProportion: function(data) {
						// calculate element coords to fit in mask
						var ratio = data.ratio || (data.elementWidth / data.elementHeight);
						var slideWidth = data.maskWidth, slideHeight = slideWidth / ratio;
						if(slideHeight < data.maskHeight) {
								slideHeight = data.maskHeight;
								slideWidth = slideHeight * ratio;
						}
						return {
								width: slideWidth,
								height: slideHeight,
								top: (data.maskHeight - slideHeight) / 2,
								left: (data.maskWidth - slideWidth) / 2
						}
				},
				resizeAll: function() {
						// crop holder width by window size
						for(var i = 0; i < this.holders.length; i++) {
								this.holders[i].style.width = '100%'; 
						}
						
						// delay required for IE to handle resize
						clearTimeout(this.resizeTimer);
						this.resizeTimer = setTimeout(this.bind(function(){
								// hide background holders
								for(var i = 0; i < this.holders.length; i++) {
										this.holders[i].style.display = 'none';
								}
								
								// calculate real page dimensions with hidden background blocks
								if(typeof this.stretchBy === 'string') {
										// resize by window or page dimensions
										if(this.stretchBy === 'window' || this.stretchBy === 'page') {
												this.viewWidth = this.stretchFunctions[this.stretchBy].width();
												this.viewHeight = this.stretchFunctions[this.stretchBy].height();
										}
										// resize by element dimensions (by id)
										else {
												var maskObject = document.getElementById(this.stretchBy);
												this.viewWidth = maskObject ? maskObject.offsetWidth : 0;
												this.viewHeight = maskObject ? maskObject.offsetHeight : 0;
										}
								} else {
										this.viewWidth = this.stretchBy.offsetWidth;
										this.viewHeight = this.stretchBy.offsetHeight;
								}
								
								// show and resize all background holders
								for(i = 0; i < this.holders.length; i++) {
										this.holders[i].style.display = 'block';
										this.resizeHolder(this.holders[i]);
								}
								for(i = 0; i < this.images.length; i++) {
										this.resizeImage(this.images[i]);
								}
						}),10);
				},
				addHandlers: function() {
						var handler = this.bind(this.resizeAll);
						if (window.addEventListener) {
								window.addEventListener('load', handler, false);
								window.addEventListener('resize', handler, false);
								window.addEventListener('orientationchange', handler, false);
						} else if (window.attachEvent) {
								window.attachEvent('onload', handler);
								window.attachEvent('onresize', handler);
						}
				},
				stretchFunctions: {
						window: {
								width: function() {
										return typeof window.innerWidth === 'number' ? window.innerWidth : document.documentElement.clientWidth;
								},
								height: function() {
										return typeof window.innerHeight === 'number' ? window.innerHeight : document.documentElement.clientHeight;
								}
						},
						page: {
								width: function() {
										return !document.body ? 0 : Math.max(
												Math.max(document.body.clientWidth, document.documentElement.clientWidth),
												Math.max(document.body.offsetWidth, document.body.scrollWidth)
										);
								},
								height: function() {
										return !document.body ? 0 : Math.max(
												Math.max(document.body.clientHeight, document.documentElement.clientHeight),
												Math.max(document.body.offsetHeight, document.body.scrollHeight)
										);
								}
						}
				},
				bind: function(fn, scope, args) {
						var newScope = scope || this;
						return function() {
								return fn.apply(newScope, args || arguments);
						}
				}
		}.init();
}());

/*
 * jQuery SameHeight plugin
 */
;(function($){
	$.fn.sameHeight = function(opt) {
		var options = $.extend({
			skipClass: 'same-height-ignore',
			leftEdgeClass: 'same-height-left',
			rightEdgeClass: 'same-height-right',
			elements: '>*',
			flexible: false,
			multiLine: false,
			useMinHeight: false,
			biggestHeight: false
		},opt);
		return this.each(function(){
			var holder = $(this), postResizeTimer, ignoreResize;
			var elements = holder.find(options.elements).not('.' + options.skipClass);
			if(!elements.length) return;

			// resize handler
			function doResize() {
				elements.css(options.useMinHeight && supportMinHeight ? 'minHeight' : 'height', '');
				if(options.multiLine) {
					// resize elements row by row
					resizeElementsByRows(elements, options);
				} else {
					// resize elements by holder
					resizeElements(elements, holder, options);
				}
			}
			doResize();

			// handle flexible layout / font resize
			var delayedResizeHandler = function() {
				if(!ignoreResize) {
					ignoreResize = true;
					doResize();
					clearTimeout(postResizeTimer);
					postResizeTimer = setTimeout(function() {
						doResize();
						setTimeout(function(){
							ignoreResize = false;
						}, 10);
					}, 100);
				}
			};

			// handle flexible/responsive layout
			if(options.flexible) {
				$(window).bind('resize orientationchange fontresize', delayedResizeHandler);
			}

			// handle complete page load including images and fonts
			$(window).bind('load', delayedResizeHandler);
		});
	};

	// detect css min-height support
	var supportMinHeight = typeof document.documentElement.style.maxHeight !== 'undefined';

	// get elements by rows
	function resizeElementsByRows(boxes, options) {
		var currentRow = $(), maxHeight, maxCalcHeight = 0, firstOffset = boxes.eq(0).offset().top;
		boxes.each(function(ind){
			var curItem = $(this);
			if(curItem.offset().top === firstOffset) {
				currentRow = currentRow.add(this);
			} else {
				maxHeight = getMaxHeight(currentRow);
				maxCalcHeight = Math.max(maxCalcHeight, resizeElements(currentRow, maxHeight, options));
				currentRow = curItem;
				firstOffset = curItem.offset().top;
			}
		});
		if(currentRow.length) {
			maxHeight = getMaxHeight(currentRow);
			maxCalcHeight = Math.max(maxCalcHeight, resizeElements(currentRow, maxHeight, options));
		}
		if(options.biggestHeight) {
			boxes.css(options.useMinHeight && supportMinHeight ? 'minHeight' : 'height', maxCalcHeight);
		}
	}

	// calculate max element height
	function getMaxHeight(boxes) {
		var maxHeight = 0;
		boxes.each(function(){
			maxHeight = Math.max(maxHeight, $(this).outerHeight());
		});
		return maxHeight;
	}

	// resize helper function
	function resizeElements(boxes, parent, options) {
		var calcHeight;
		var parentHeight = typeof parent === 'number' ? parent : parent.height();
		boxes.removeClass(options.leftEdgeClass).removeClass(options.rightEdgeClass).each(function(i){
			var element = $(this);
			var depthDiffHeight = 0;
			var isBorderBox = element.css('boxSizing') === 'border-box';

			if(typeof parent !== 'number') {
				element.parents().each(function(){
					var tmpParent = $(this);
					if(parent.is(this)) {
						return false;
					} else {
						depthDiffHeight += tmpParent.outerHeight() - tmpParent.height();
					}
				});
			}
			calcHeight = parentHeight - depthDiffHeight;
			calcHeight -= isBorderBox ? 0 : element.outerHeight() - element.height();

			if(calcHeight > 0) {
				element.css(options.useMinHeight && supportMinHeight ? 'minHeight' : 'height', calcHeight);
			}
		});
		boxes.filter(':first').addClass(options.leftEdgeClass);
		boxes.filter(':last').addClass(options.rightEdgeClass);
		return calcHeight;
	}
}(jQuery));

/*
 * jQuery FontResize Event
 */
jQuery.onFontResize = (function($) {
	$(function() {
		var randomID = 'font-resize-frame-' + Math.floor(Math.random() * 1000);
		var resizeFrame = $('<iframe>').attr('id', randomID).addClass('font-resize-helper');

		// required styles
		resizeFrame.css({
			width: '100em',
			height: '10px',
			position: 'absolute',
			borderWidth: 0,
			top: '-9999px',
			left: '-9999px'
		}).appendTo('body');

		// use native IE resize event if possible
		if (window.attachEvent && !window.addEventListener) {
			resizeFrame.bind('resize', function () {
				$.onFontResize.trigger(resizeFrame[0].offsetWidth / 100);
			});
		}
		// use script inside the iframe to detect resize for other browsers
		else {
			var doc = resizeFrame[0].contentWindow.document;
			doc.open();
			doc.write('<scri' + 'pt>window.onload = function(){var em = parent.jQuery("#' + randomID + '")[0];window.onresize = function(){if(parent.jQuery.onFontResize){parent.jQuery.onFontResize.trigger(em.offsetWidth / 100);}}};</scri' + 'pt>');
			doc.close();
		}
		jQuery.onFontResize.initialSize = resizeFrame[0].offsetWidth / 100;
	});
	return {
		// public method, so it can be called from within the iframe
		trigger: function (em) {
			$(window).trigger("fontresize", [em]);
		}
	};
}(jQuery));

/*
 * Browser platform detection
 */
PlatformDetect = (function(){
	var detectModules = {};
	return {
		options: {
			cssPath: 'css/'
		},
		addModule: function(obj) {
			detectModules[obj.type] = obj;
		},
		addRule: function(rule) {
			if(this.matchRule(rule)) {
				this.applyRule(rule);
				return true;
			}
		},
		matchRule: function(rule) {
			return detectModules[rule.type].matchRule(rule);
		},
		applyRule: function(rule) {
			var head = document.getElementsByTagName('head')[0], fragment, cssText;
			if(rule.css) {
				cssText = '<link rel="stylesheet" href="' + this.options.cssPath + rule.css + '" />';
				if(head) {
					fragment = document.createElement('div');
					fragment.innerHTML = cssText;
					head.appendChild(fragment.childNodes[0]);
				} else {
					document.write(cssText);
				}
			}
			
			if(rule.meta) {
				if(head) {
					fragment = document.createElement('div');
					fragment.innerHTML = rule.meta;
					head.appendChild(fragment.childNodes[0]);
				} else {
					document.write(rule.meta);
				}
			}
		},
		matchVersions: function(host, target) {
			target = target.toString();
			host = host.toString();

			var majorVersionMatch = parseInt(target, 10) === parseInt(host, 10);
			var minorVersionMatch = (host.length > target.length ? host.indexOf(target) : target.indexOf(host)) === 0;

			return majorVersionMatch && minorVersionMatch;
		}
	};
}());

// All Mobile detection
PlatformDetect.addModule({
	type: 'allmobile',
	uaMatch: function(str) {
		if(!this.ua) {
			this.ua = navigator.userAgent.toLowerCase();
		}
		return this.ua.indexOf(str.toLowerCase()) != -1;
	},
	matchRule: function(rule) {
		return this.uaMatch('mobi') || this.uaMatch('midp') || this.uaMatch('ppc') || this.uaMatch('webos') || this.uaMatch('android') || this.uaMatch('phone os') || this.uaMatch('touch');
	}
});

// iPhone detection
PlatformDetect.addModule({
	type: 'iphone',
	parseUserAgent: function() {
		var match = /(iPhone|iPod).*OS ([0-9_]*) .*/.exec(navigator.userAgent);
		if(match) {
			return {
				retina: window.devicePixelRatio > 1,
				version: match[2].replace(/_/g, '.')
			};
		}
	},
	matchRule: function(rule) {
		this.matchData = this.matchData || this.parseUserAgent();
		if(this.matchData) {
			var matchVersion = rule.version ? PlatformDetect.matchVersions(this.matchData.version, rule.version) : true;
			var matchDevice = rule.deviceType ? (rule.deviceType === 'retina' && this.matchData.retina) || (rule.deviceType === 'noretina' && !this.matchData.retina) : true;
			return matchVersion && matchDevice;
		}
	}
});

// iPad detection
PlatformDetect.addModule({
	type: 'ipad',
	parseUserAgent: function() {
		var match = /(iPad).*OS ([0-9_]*) .*/.exec(navigator.userAgent);
		if(match) {
			return {
				retina: window.devicePixelRatio > 1,
				version: match[2].replace(/_/g, '.')
			};
		}
	},
	matchRule: function(rule) {
		this.matchData = this.matchData || this.parseUserAgent();
		if(this.matchData) {
			var matchVersion = rule.version ? PlatformDetect.matchVersions(this.matchData.version, rule.version) : true;
			var matchDevice = rule.deviceType ? (rule.deviceType === 'retina' && this.matchData.retina) || (rule.deviceType === 'noretina' && !this.matchData.retina) : true;
			return matchVersion && matchDevice;
		}
	}
});

// Android detection
PlatformDetect.addModule({
	type: 'android',
	parseUserAgent: function() {
		var match = /(Android) ([0-9.]*).*/.exec(navigator.userAgent);
		if(match) {
			return {
				deviceType: navigator.userAgent.indexOf('Mobile') > 0 ? 'mobile' : 'tablet',
				version: match[2]
			};
		}
	},
	matchRule: function(rule) {
		this.matchData = this.matchData || this.parseUserAgent();
		if(this.matchData) {
			var matchVersion = rule.version ? PlatformDetect.matchVersions(this.matchData.version, rule.version) : true;
			var matchDevice = rule.deviceType ? rule.deviceType === this.matchData.deviceType : true;
			return matchVersion && matchDevice;
		}
	}
});

// Windows Phone detection
PlatformDetect.addModule({
	type: 'winphone',
	parseUserAgent: function() {
		var match = /(Windows Phone OS) ([0-9.]*).*/.exec(navigator.userAgent);
		if(match) {
			return {
				version: match[2]
			};
		}
		if(/MSIE 10.*Touch/.test(navigator.userAgent)) {
			return {
				version: 8
			};
		}
	},
	matchRule: function(rule) {
		this.matchData = this.matchData || this.parseUserAgent();
		if(this.matchData) {
			return rule.version ? PlatformDetect.matchVersions(this.matchData.version, rule.version) : true;
		}
	}
});

// Blackberry detection
PlatformDetect.addModule({
	type: 'blackberry',
	parseUserAgent: function() {
		var match = /(BlackBerry).*Version\/([0-9.]*).*/.exec(navigator.userAgent);
		if(match) {
			return {
				version: match[2]
			};
		}
	},
	matchRule: function(rule) {
		this.matchData = this.matchData || this.parseUserAgent();
		if(this.matchData) {
			return rule.version ? PlatformDetect.matchVersions(this.matchData.version, rule.version) : true;
		}
	}
});
// custom checkbox
jcf.lib.domReady(function(){
	jcf.customForms.replaceAll();
});

// Detect rules
PlatformDetect.addRule({type: 'allmobile', css: 'allmobile.css'});
PlatformDetect.addRule({type: 'iphone', css: 'iphone.css'});
PlatformDetect.addRule({type: 'ipad', css: 'ipad.css'});
PlatformDetect.addRule({type: 'android', css: 'android.css'});
PlatformDetect.addRule({type: 'blackberry', css: 'blackberry.css'});
PlatformDetect.addRule({type: 'winphone', css: 'winphone.css'});