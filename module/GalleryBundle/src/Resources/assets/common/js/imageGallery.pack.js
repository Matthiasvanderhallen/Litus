/*! imageGallery v1.1.5 | Copyright (c) 2011 Kristof Mariën */
(function(c){var i={zIndex:1E3,backgroundOpacity:0.9,fadeSpeed:200,thumbSize:100,thumbOpacity:0.5,thumbOpacityActive:0.9,thumbFadeSpeed:200,thumbScrollSpeed:500,thumbScrollTransition:"swing",imagePadding:20,imageFadeSpeed:500,imageFadeTransition:"swing",playInterval:5E3,backgroundColor:"#000000",timerBarHeight:2,timerBarColor:"#ffffff",timerBarOpacity:0.5,closeText:"Close",previousText:"Previous",playText:"Play",pauzeText:"Pauze",nextText:"Next",imageSelector:"a.imageGallery",canPlay:!0,showThumbBar:!0,
preloadImages:!0},g={init:function(a){a=c.extend(i,a);return this.each(function(){var b=c(this);b.data("iG")||(b.find(a.imageSelector).unbind("click.iG").bind("click.iG",_open).data("iG",{container:b}),b.data("iG",{options:a}))})},open:function(a){var b=c(this).data("iG").options;void 0===a?c(this).find(b.imageSelector+":first").click():a.click();return this},close:function(){_close();return this},destroy:function(){return this.each(function(){_close();c(this).unbind("click.iG").removedata("iG")})},
nextImage:function(){_next();return this},previousImage:function(){_previous();return this},play:function(){_play();return this},pauze:function(){_pauze();return this}};c.fn.imageGallery=function(a){if(g[a])return g[a].apply(this,Array.prototype.slice.call(arguments,1));if("object"===typeof a||!a)return g.init.apply(this,arguments);c.error("Method "+a+" does not exist on jQuery.imageGallery")};_open=function(a){a.preventDefault();var a=c(this).data("iG").container,b=a.data("iG").options;_create(a,
b);var d=c(this);setTimeout(function(){_openImage(d)},b.fadeSpeed)};_create=function(a,b){0<c("#container-iG").length&&c("#container-iG").data("iG").container==a||(_close(),c("body").append(imageGallery=c("<div>",{id:"container-iG"})),c(document).bind("keydown.iG",_keyDown),c(window).bind("resize.iG",_position),imageGallery.css({zIndex:b.zIndex}).append(background=c("<div>",{"class":"background-iG"}).css({opacity:b.backgroundOpacity,background:b.backgroundColor}),controls=c("<div>",{"class":"controls-iG"}),
loading=c("<div>",{"class":"loading-iG"}).append(throbber=c("<div>",{"class":"throbber-iG"})).css({zIndex:b.zIndex+10})).data("iG",{options:b,container:a}),controls.append(viewControls=c("<div>",{"class":"viewControls-iG"}),closeControl=c("<div>",{"class":"button-iG closeControl-iG"}).html("x"+(0<b.closeText.length?" "+b.closeText:"")).unbind("click.iG").bind("click.iG",_close)),viewControls.append(previousControl=c("<div>",{"class":"button-iG previousControl-iG"}).append(c("<span>",{"class":"image"}),
b.previousText).unbind("click.iG").bind("click.iG",_previous),playControl=c("<div>",{"class":"button-iG playControl-iG startStopControl-iG"}).append(c("<span>",{"class":"image"}),c("<span>",{"class":"text"}).html(b.playText)).unbind("click.iG").bind("click.iG",_startStop),nextControl=c("<div>",{"class":"button-iG nextControl-iG"}).append(b.nextText,c("<span>",{"class":"image"})).unbind("click.iG").bind("click.iG",_next)),b.canPlay||playControl.remove(),_positionControls(),b.showThumbBar&&_createThumbBar(a,
b),imageGallery.fadeOut(0).fadeIn(b.fadeSpeed),_showLoading())};_createThumbBar=function(a,b){c("#container-iG").append(thumbBar=c("<div>",{"class":"thumbBar-iG"}));thumbBar.css({height:b.thumbSize}).append(scrollLeft=c("<div>",{"class":"scrollLeft-iG scroll-iG button-iG"}),thumbContainer=c("<div>",{"class":"thumbs-iG"}),scrollRight=c("<div>",{"class":"scrollRight-iG scroll-iG button-iG"}));scrollLeft.css({height:b.thumbSize}).append(c("<div>",{"class":"image"})).bind("click.iG",_thumbsScrollLeft);
scrollRight.css({height:b.thumbSize}).append(c("<div>",{"class":"image"})).bind("click.iG",_thumbsScrollRight);thumbContainer.css({height:b.thumbSize}).append(thumbs=c("<ul>"));var d=3;a.find(b.imageSelector).each(function(){thumbs.append(thumb=c("<li>").data("iG",{image:c(this)}));thumb.html(c("<img>",{src:c(this).find("img").attr("src")}).css({maxWidth:b.thumbSize,maxHeight:b.thumbSize}));d+=b.thumbSize+3});thumbs.width(d).find("li").css({opacity:b.thumbOpacity,width:b.thumbSize,height:b.thumbSize}).mouseover(function(){c(this).hasClass("activeThumb-iG")||
c(this).stop().fadeTo(b.thumbFadeSpeed,b.thumbOpacityActive)}).mouseout(function(){c(this).hasClass("activeThumb-iG")||c(this).stop().fadeTo(b.thumbFadeSpeed,b.thumbOpacity)}).click(function(){_pauze();_openImage(c(this).data("iG").image)})};_thumbsScrollLeft=function(){var a=c("#container-iG").data("iG").options,b=c("#container-iG .thumbs-iG"),d=_calculateThumbBarLeft(b.find("ul").position().left+2*(b.width()/3));b.find("ul").stop().animate({left:d},a.thumbScrollSpeed,a.thumbScrollTransition)};_thumbsScrollRight=
function(){var a=c("#container-iG").data("iG").options,b=c("#container-iG .thumbs-iG"),d=_calculateThumbBarLeft(b.find("ul").position().left-2*(b.width()/3));b.find("ul").stop().animate({left:d},a.thumbScrollSpeed,a.thumbScrollTransition)};_openImage=function(a){if(!a||0==a.length)c.error("The given image was not valid for jQuery.imageGallery");else{var b=c("#container-iG"),d=b.data("iG").options;b.data("iG").current=a;b.find(".image-iG").addClass("previous-iG");b.append(imageHolder=c("<img>",{"class":"image-iG",
src:a.attr("href")}).hide().css({zIndex:d.zIndex+5}));_showLoading();imageHolder.load(function(){_hideLoading();var f=c(this);f.unbind("load");if(0<b.find(".previous-iG").length){var e=b.find(".playBar-iG");0<e.length&&e.fadeOut(d.imageFadeSpeed);b.find(".previous-iG").fadeOut(d.imageFadeSpeed,function(){c(this).remove();f.fadeIn(d.imageFadeSpeed,d.imageFadeTransition);_position();0<e.length&&_startPlayBar()})}else f.fadeIn(d.imageFadeSpeed,d.imageFadeTransition),_position();if(d.preloadImages){var g=
a.next(d.imageSelector),h=a.prev(d.imageSelector);g&&c("<img>",{src:g.attr("href")});h&&c("<img>",{src:h.attr("href")})}});0==a.next(d.imageSelector).length?b.find(".nextControl-iG").addClass("button-disabled-iG"):b.find(".nextControl-iG").removeClass("button-disabled-iG");0==a.prev(d.imageSelector).length?b.find(".previousControl-iG").addClass("button-disabled-iG"):b.find(".previousControl-iG").removeClass("button-disabled-iG");if(d.showThumbBar){var f=b.find(".thumbs-iG"),e=b.data("iG").current;
f.find("ul li").removeClass("activeThumb-iG").stop().fadeTo(d.thumbFadeSpeed,d.thumbOpacity);void 0!=e&&(e=c(f.find("ul li").get(e.index())).addClass("activeThumb-iG").stop().fadeTo(d.thumbFadeSpeed,d.thumbOpacityActive),e=_calculateThumbBarLeft(f.width()/2-e.position().left-d.thumbSize/2),f.find("ul").stop().animate({left:e},d.thumbScrollSpeed,d.thumbScrollTransition))}}};_next=function(){_pauze();var a=c("#container-iG"),b=a.data("iG").options,a=a.data("iG").current.next(b.imageSelector);0<a.length&&
_openImage(a)};_previous=function(){_pauze();var a=c("#container-iG"),b=a.data("iG").options,a=a.data("iG").current.prev(b.imageSelector);0<a.length&&_openImage(a)};_loop=function(){var a=c("#container-iG"),b=a.data("iG").options,d=a.data("iG").current.next(b.imageSelector);0<d.length?_openImage(d):_openImage(a.data("iG").container.find(b.imageSelector).first())};_startStop=function(){c("#container-iG .startStopControl-iG").hasClass("playControl-iG")?_play():_pauze()};_play=function(){var a=c("#container-iG"),
b=a.data("iG").options;if(b.canPlay)a.find(".playControl-iG").removeClass("playControl-iG").addClass("pauzeControl-iG").find(".text").html(b.pauzeText),_positionControls(),a.data("iG").playTimer=setInterval(_loop,b.playInterval),a.append(playBar=c("<div>",{"class":"playBar-iG"}).css({height:b.timerBarHeight})),playBar.append(progress=c("<div>").css({height:b.timerBarHeight,width:0,background:b.timerBarColor,opacity:b.timerBarOpacity})),_startPlayBar()};_pauze=function(){var a=c("#container-iG"),b=
a.data("iG").options;a.find(".pauzeControl-iG").removeClass("pauzeControl-iG").addClass("playControl-iG").find(".text").html(b.playText);a.find(".playBar-iG").remove();_positionControls();clearInterval(a.data("iG").playTimer)};_startPlayBar=function(){var a=c("#container-iG"),b=a.data("iG").options,d=a.find(".playBar-iG"),a=d.find("div");_positionPlayBar();d.show();a.width(0).css("percWidth",0).stop().animate({percWidth:1},{duration:b.playInterval,easing:"swing",step:function(a){c(this).width(a*d.width())}})};
_keyDown=function(a){switch(a.keyCode){case 27:a.preventDefault();_close();break;case 39:a.preventDefault();_next();break;case 37:a.preventDefault();_previous();break;case 32:a.preventDefault(),_startStop()}};_showLoading=function(){clearInterval(c("#container-iG").data("iG").loadingTimer);c("#container-iG").data("iG").loadingTimer=setInterval(_animateLoading,70);_position();c("#container-iG .loading-iG").stop().fadeIn(100)};_hideLoading=function(){c("#container-iG .loading-iG").stop().fadeOut(100);
clearInterval(c("#container-iG").data("iG").loadingTimer)};_animateLoading=function(){var a=c("#container-iG .loading-iG");a.is(":visible")?a.find(".throbber-iG").css({top:(a.find(".throbber-iG").position().top-40)%480}):clearInterval(c("#container-iG").data("iG").loadingTimer)};_position=function(){var a=c("#container-iG").data("iG").options;c("#container-iG .loading-iG").css({top:(c(window).height()-a.thumbSize)/2-20,left:c(window).width()/2-20});var b=c("#container-iG .image-iG");0<b.length&&(b.css({maxHeight:c(window).height()-
a.thumbSize-29-2*a.imagePadding,maxWidth:c(window).width()-2*a.imagePadding}),b.css({top:(c(window).height()-a.thumbSize-29)/2-b.height()/2+29,left:c(window).width()/2-b.width()/2}),_positionPlayBar());a.showThumbBar&&_positionThumbBar()};_positionControls=function(){var a=c("#container-iG .viewControls-iG"),b=0;a.find("div").each(function(){b+=c(this).outerWidth()});a.width(b+1)};_positionPlayBar=function(){var a=c("#container-iG"),b=a.data("iG").options,d=a.find(".playBar-iG"),a=a.find(".image-iG");
0<d.length&&d.css({top:(c(window).height()-b.thumbSize-29)/2-a.height()/2+29-b.timerBarHeight,left:c(window).width()/2-a.width()/2,width:a.width()})};_positionThumbBar=function(){var a=c("#container-iG").find(".thumbs-iG");if(a.find("ul").width()<a.width()){c("#container-iG .scrollLeft-iG").hide();c("#container-iG .scrollRight-iG").hide();var b=a.width()/2-a.find("ul").width()/2}else c("#container-iG .scrollLeft-iG").show(),c("#container-iG .scrollRight-iG").show(),b=_calculateThumbBarLeft(a.find("ul").position().left);
a.find("ul").stop().css({left:b})};_calculateThumbBarLeft=function(a){var b=c("#container-iG .thumbs-iG");if(b.find("ul").width()<b.width())a=b.width()/2-b.find("ul").width()/2;else{if(0<a)return 0;if(a<-b.find("ul").width()+b.width())return-b.find("ul").width()+b.width()}return a};_close=function(){var a=c("#container-iG");if(0!=a.length){var b=a.data("iG").options;c(document).unbind("keydown.iG");c(window).unbind("resize.iG");clearInterval(a.data("iG").loadingTimer);clearInterval(a.data("iG").playTimer);
a.fadeOut(b.fadeSpeed,function(){c(this).remove()})}}})(jQuery);