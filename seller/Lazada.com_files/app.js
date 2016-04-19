/**
*   Application Logic
*/
'use strict';

(function(window, document, $, google) {

    var GoogleMap = function (address, config) {
        var that = this;

        that.myLatLong = config.lat_long;
        that.mapCenter = config.map_center;
        that.mapCanvas = config.map_canvas;
        that.title = config.title;
        that.contentString = '<div id="content">'+
                            '<div id="siteNotice">'+
                            '</div>'+
                            '<h1 id="firstHeading" class="firstHeading">'+ config.title +'</h1>'+
                            '<div id="bodyContent"'+
                           //config.content_string +
                            '</div>'+
                            '</div>';

        that.mapOptions = {
            center: that.mapCenter,
            zoom: 13,
            scrollwheel: false,
            draggable: true,
            disableDefaultUI: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        mapArray[address] = {};
        mapArray[address].map = new google.maps.Map(that.mapCanvas, that.mapOptions);
        mapArray[address].infowindow = new google.maps.InfoWindow({
            content: that.contentString,
            maxWidth: 300
        });
        mapArray[address].marker = new google.maps.Marker({
            position: that.myLatLong,
            map: mapArray[address].map,
            title: that.title
        });

        mapArray[address].map.set('styles', [{
                featureType: 'landscape',
                elementType: 'geometry',
                stylers: [
                    { hue: '#ffff00' },
                    { saturation: 30 },
                    { lightness: 10}
                ]}
            ]);

        google.maps.event.addListener(mapArray[address].marker, 'click', function () {
            mapArray[address].infowindow.open(mapArray[address].map, mapArray[address].marker);
        });
    },
    mapArray = [],
    mapObj = [];

    var players = window.players || undefined;

    function stopVideos () {
        if(typeof players !== 'undefined') {
            $.each(players, function(idx, player) {
                var player_state = player.getPlayerState();
                if(player_state === 1 || player_state === 3) {
                    player.stopVideo();
                }
            });
        }
    }

    function initVerticalTab() {
        $('.js-vertical-tab-content').hide();
        $('.js-vertical-tab-content:first').show();

        /* if in tab mode */
        $('.js-vertical-tab').on('click', function(event) {
            event.preventDefault();
            stopVideos();

            $('.js-vertical-tab-content').hide();
            var activeTab = $(this).attr('rel');
            $('#'+activeTab).show();

            $('.js-vertical-tab').removeClass('is-active');
            $(this).addClass('is-active');

            $('.js-vertical-tab-accordion-heading').removeClass('is-active');
            $('.js-vertical-tab-accordion-heading[rel^='+activeTab+']').addClass('is-active');
        });

        /* if in accordion mode */
        $('.js-vertical-tab-accordion-heading').on('click', function(event) {
            event.preventDefault();
            stopVideos();

            $('.js-vertical-tab-content').hide();
            var accordion_activeTab = $(this).attr('rel');
            $('#'+accordion_activeTab).show();

            $('.js-vertical-tab-accordion-heading').removeClass('is-active');
            $(this).addClass('is-active');

            $('.js-vertical-tab').removeClass('is-active');
            $('.js-vertical-tab[rel^='+accordion_activeTab+']').addClass('is-active');
        });
    }

    function initAccordionTabs() {
        var $accordionTabs = $('.accordion-tabs');
        var window_width = $(window).width();


        $accordionTabs.each(function(index) {
            $(this).children('li').first().children('a').addClass('is-active').next().addClass('is-open');
        });

        $accordionTabs.on('click', 'li > a', function(event) {

            var accordionTabs = $(this).closest('.accordion-tabs');
            if (!$(this).hasClass('is-active')) {
                event.preventDefault();
                accordionTabs.find('.is-open').removeClass('is-open');
                $(this).next().toggleClass('is-open');
                accordionTabs.find('.is-active').removeClass('is-active');
                $(this).addClass('is-active');
            } else {
                event.preventDefault();
                if(window_width > 1024) {
                    return false;
                }
                accordionTabs.find('.is-open').removeClass('is-open');
                accordionTabs.find('.is-active').removeClass('is-active');
            }
            if($('body').hasClass('contact_us_page') && window_width <= 1024) {
                var address = $(this).data('address'),
                    _top = typeof $('#map-tab-' + address).offset().top !== 'undefined' ? $('#map-tab-' + address).offset().top : 0;
                $('.contact_us_page').animate({scrollTop: _top});
            }
        });
    }

    function initDropdown() {
        $('.navbar li.dropdown').click(function (e) {
            e.stopPropagation();
            $('.navbar li > ul').not($(this).children('ul').toggle()).hide();
        });

        $(document.documentElement).on('click', function (e) {
            $('ul.dropdown-menu').hide();
        });
    }

    function initMobileLanguageDropdown() {
        var $mobileDropdown = $('.mobile_language_dropdown'),
            $toggleMenu = $mobileDropdown.find('.language_dropdown_toggle'),
            $mobileLanguageList = $mobileDropdown.find('.language_dropdown_list'),
            _openned = 'openned';

        $toggleMenu.on('click', function (e) {
            e.preventDefault();
            if ( $toggleMenu.hasClass(_openned)) {
                $mobileLanguageList.removeClass(_openned);
                $mobileLanguageList.hide();
            } else {
                $mobileLanguageList.addClass(_openned);
                $mobileLanguageList.show();
            }
            return false;
        });
    }

    function initSignUpForm() {
        var $document = $(document.documentElement);
        var formContent = $('#signupForm')[0];
        var $formClose = $('#formClose');
        var $signUpButton = $('.sign-up-now-button');
        var $submitBtn = $('.btn-submit');
        var isActiveForm = false;
        var isActiveFormClass = 'isActiveForm';

        function openForm() {
            isActiveForm = true;
            $('#signupForm').show();
            $('#signupForm').parent().find('.success').html('').hide();
            $('.overlay-inner').removeClass('short');
            $document.addClass(isActiveFormClass);
            $('body').css('overflow', 'hidden');


            $submitBtn
                .prop('disabled',false)
                .unbind('click',submitBtnHandler)
                .bind('click',submitBtnHandler);

        }

        function closeForm() {
            isActiveForm = false;
            $document.removeClass(isActiveFormClass);
            $('body').css('overflow', 'visible');
            cleanForm();
        }

        $signUpButton.on('click', function(e){
            e.preventDefault();
            e.stopPropagation();
            if (isActiveForm) {
                closeForm();
            } else {
                openForm();
            }
        });
        $formClose.on('click', closeForm);

        $('.overlay').on('click', function(e) {
            if (e.target === $('.overlay-inner h2')[0] ||
                e.target === $('.overlay-inner .sign-up-form')[0]) {
                return false;
            }

            if ($('.job-form-popup').length
                && !$(e.target).closest('.job-form-popup__content').length) {
                $('.job-form-popup').hide();
                $('body').css('overflow', 'visible');
                return false;
            }

            if (e.target !== formContent && !$.contains(formContent, e.target)) {
                closeForm();
            }
        })
    }

    function initHotPoint() {
        $('.hot-point','#svgout').each(function() {
            $(this).on('click', function () {
                $('path', '.country#' + this.id ).css('fill','#fff');
                $('#popup-' + this.id).addClass('show').fadeIn(500, function () {
                    cleanMap();
                });
                $('#overlay').addClass('overlayActive');
            });
            $(this).hover(function(e){
                $('path', '.country#' + this.id ).css('fill','#fff');
            }, function(){
                if($('.popup.show').length === 0) {
                    $('path', '.country#' + this.id ).css('fill','#f57224');
                }
            });
        });
        $('.country').each(function(index) {
            $(this).on('click', function () {
                if ($('popup.show').length === 0) {
                    $('#popup-' + this.id).addClass('show').fadeIn(500, function () {
                        cleanMap();
                    });
                    $('#overlay').addClass('overlayActive');
                    // Fill the selected country
                    $('.se-asia', this).css('fill', '#fff');
                }
            });
        });
    }

    function cleanMap() {
        $('body').on('click', function() {
            $('.popup').removeClass('show').fadeOut(500, function () {
                $('.se-asia').css('fill', '#f57224');
            });
            $('#overlay').removeClass();
            $('body').off('click');
        });
    }

    function initMenuTrigger() {
        var $document = $(document.documentElement);
        //var $menu = $('#menuMobile');
        var $menuClose = $('#menuMobileClose');
        var $menuTrigger = $('#menuMobileTrigger');
        var isActiveMenu = false;
        var isActiveMenuClass = 'isActiveMenu';

        function openMenu() {
            window.scrollTo(0, 0);
            isActiveMenu = true;
            $document.addClass(isActiveMenuClass);
        }

        function closeMenu() {
            window.scrollTo(0, 0);
            isActiveMenu = false;
            $document.removeClass(isActiveMenuClass);
        }


        $menuTrigger.on('touchstart', function(e){
            e.preventDefault();
            e.stopPropagation();
            if (isActiveMenu) {
                closeMenu();
            } else {
                openMenu();
            }
        });
        $menuClose.on('touchstart', closeMenu);
    }

    function initCollapsTab(bool) {
        if(bool) {
            $('#collapsible-panels').find('h3').off('click').on('click', function(e) {
                if (!$(this).hasClass('active')) {
                    e.preventDefault();
                    $('#collapsible-panels').find('h3').removeClass('active');
                    $(this).toggleClass('active');
                    $(this).parent().parent().find('p').hide();
                    $('.icon-sell-mobile').hide();

                    $($('span', $(this).parent())[2]).css('display','block');
                    $('.icons-sell-mobile', $(this).parent());
                    $(this).parent().find('p').show();
                    $('.icon-plus').removeClass('hor-line');
                    $(this).find('.icon-plus').addClass('hor-line');

                } else {
                    e.preventDefault();
                    $(this).toggleClass('active');
                    $(this).parent().parent().find('p').hide();
                    $('.icon-sell-mobile').hide();
                    $('.icon-plus').removeClass('hor-line');
                }
            });

        } else {
            $('#collapsible-panels h3').off('click');
        }
    }

    function checkCarousel(windowsize) {
        if (!$('.features-container').hasClass('carousel') && (windowsize < 768)) {
            $('.features-container').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true
            });
            $('.features-container').addClass('carousel');
        } else if ($('.features-container').hasClass('carousel') && (windowsize > 768)) {
            $('.features-container').unslick();
            $('.features-container').removeClass('carousel');
        }
    }

    function initMobile(){
        var windowsize = $(window).width();
        if (windowsize < 768) {
            initCollapsTab(true);
            checkCarousel(windowsize);
        } else {
            initCollapsTab(false);
            checkCarousel(windowsize);
        }
    }

    function submitBtnHandler(event) {

        event.preventDefault();

        submitHandler();

        return false;

    }

    function submitHandler () {

        var eInput=0,
            eTextarea=0,
            eSelect=0,
            form = $('#signupForm'),
            $formLine = form.find('.form-line'),
            $submitBtn = form.find('.btn-submit');

        form.find('.error').removeClass('error');

        $formLine.find('input').each(function(){
            var thisId = $(this).attr('id');
            var thisVal = $(this).val();
            var regex;

            if (thisVal==='' && thisId!=='website') {
                eInput=1;
                $('.signup-note').addClass('error');
                $(this).parent().addClass('error');
            } else {
                if (thisId==='email') {
                    regex = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
                    if (!regex.test(thisVal)) {
                        eInput=1;
                        $(this).parent().addClass('error');
                        $('.signup-note').addClass('error');
                    } else {
                        $(this).parent().removeClass('error');
                    }
                }

                if (thisId==='phone') {
                    regex = /^\+{0,1}[0-9]{6,13}$/;
                    if (!regex.test(thisVal)) {
                        eInput=1;
                        $(this).parent().addClass('error');
                        $('.signup-note').addClass('error');
                    } else {
                        $(this).parent().removeClass('error');
                    }
                }

                if (thisId==='website' && thisVal!=='') {
                    regex = /^(https?:\/\/)?([\w\.]+)\.([a-z]{2,6}\.?)(\/[\w\.]*)*\/?$/;
                    if (!regex.test(thisVal)) {
                        eInput=1;
                        $(this).parent().addClass('error');
                        $('.signup-note').addClass('error');
                    } else {
                        $(this).parent().removeClass('error');
                    }
                }

            }
        });

        $formLine.find('textarea').each(function(){
            if ($(this).val()==='') {
                eTextarea=1;
                $('.signup-note').addClass('error');
                $(this).parent().addClass('error');
            } else {
                $(this).parent().removeClass('error');
            }
        });

        $formLine.find('select').each(function(){
            if ($(this).val()==='') {
                eSelect=1;
                $('.signup-note').addClass('error');
                $(this).parent().parent().addClass('error');
            } else {
                $(this).parent().parent().removeClass('error');
            }
        });

        if (eInput===0 && eTextarea===0 && eSelect===0) {
            $submitBtn.prop('disabled',true);
            $('.signup-note').removeClass('error');
            form
                .unbind('submit')
                .bind('submit',function(e) {
                    e.preventDefault();
                     var postData = $(this).serializeArray();
                     var formURL = $(this).attr('action');
                     form.parent().find('.success').html('').hide();
                     form.parent().find('.errormess').html('').hide();
                     $.ajax({
                             url : formURL,
                             type: 'POST',
                             data : postData,
                             dataType: 'json',
                             success:function(data, textStatus, jqXHR)
                             {
                                 if (data.result)
                                 {
                                     form.trigger('reset');
                                     form.fadeOut();
                                     form.find('.error').removeClass('error');
                                     form.parent().find('.success').html(data.message).fadeIn();
                                     if (!form.hasClass('contact-form')) {
                                         $('.overlay-inner').addClass('short');
                                     }
                                 } else {
                                     form.parent().find('.errormess').html(data.message).fadeIn();
                                 }
                             }
                    });
                });
            form.submit();
        } else {
            return false;
        }

    }

    function initMapContactPage () {
        var mapConfig = {
            'group': {
                'lat_long': new google.maps.LatLng(1.27422, 103.84825),
                'map_center': new google.maps.LatLng(1.27422, 103.84825),
                'map_canvas': document.getElementById('map-group'),
                'title': 'Lazada Group'
                //'content_string': '<p>12 Prince Edward Road<br>Bestway Building, Podium B #06-08<br>SINGAPORE 079212</p>'
            },
            'indonesia': {
                'lat_long': new google.maps.LatLng(-6.24061, 106.84152),
                'map_center': new google.maps.LatLng(-6.24061, 106.84152),
                'map_canvas': document.getElementById('map-indonesia'),
                'title': 'Lazada Indonesia'
                //'content_string': '<p>12 Prince Edward Road<br>Bestway Building, Podium B #06-08<br>SINGAPORE 079212</p>'
            },
            'malaysia': {
                'lat_long': new google.maps.LatLng(3.14812, 101.71445),
                'map_center': new google.maps.LatLng(3.14812, 101.71445),
                'map_canvas': document.getElementById('map-malaysia'),
                'title': 'Lazada Malaysia'
                //'content_string': '<p>12 Prince Edward Road<br>Bestway Building, Podium B #06-08<br>SINGAPORE 079212</p>'
            },
            'thailand': {
                'lat_long': new google.maps.LatLng(13.72084, 100.58588),
                'map_center': new google.maps.LatLng(13.72084, 100.58588),
                'map_canvas': document.getElementById('map-thailand'),
                'title': 'Lazada Thailand'
                //'content_string': '<p>12 Prince Edward Road<br>Bestway Building, Podium B #06-08<br>SINGAPORE 079212</p>'
            },
            'sinagpore': {
                'lat_long': new google.maps.LatLng(1.27422, 103.84825),
                'map_center': new google.maps.LatLng(1.27422, 103.84825),
                'map_canvas': document.getElementById('map-sinagpore'),
                'title': 'Lazada Singapore'
                //'content_string': '<p>12 Prince Edward Road<br>Bestway Building, Podium B #06-08<br>SINGAPORE 079212</p>'
            },
            'vietnam': {
                'lat_long': new google.maps.LatLng(10.78417, 106.69649),
                'map_center': new google.maps.LatLng(10.78417, 106.69649),
                'map_canvas': document.getElementById('map-vietnam'),
                'title': 'Lazada Vietnam'
                //'content_string': '<p>12 Prince Edward Road<br>Bestway Building, Podium B #06-08<br>SINGAPORE 079212</p>'
            },
            'philippines': {
                'lat_long': new google.maps.LatLng(14.55482, 121.02028),
                'map_center': new google.maps.LatLng(14.55482, 121.02028),
                'map_canvas': document.getElementById('map-philippines'),
                'title': 'Lazada Philippines'
                //'content_string': '<p>12 Prince Edward Road<br>Bestway Building, Podium B #06-08<br>SINGAPORE 079212</p>'
            },
            'hong_kong': {
                'lat_long': new google.maps.LatLng(22.27529, 114.17161),
                'map_center': new google.maps.LatLng(22.27529, 114.17161),
                'map_canvas': document.getElementById('map-hong_kong'),
                'title': 'Lazada Hong Kong'
                //'content_string': '<p>12 Prince Edward Road<br>Bestway Building, Podium B #06-08<br>SINGAPORE 079212</p>'
            }
        };

        // mapObj['group'] = new googleMap('group', mapConfig['group']);

        $.each(mapConfig, function(add, config) {
            mapObj[add] = new GoogleMap(add, config);
        });

        // listen for last map loaded to trigger tabs
        google.maps.event.addListenerOnce(mapArray.hong_kong.map, 'idle', function(){
            $('.accordion-tabs').addClass('mapInitialized');
            $('.tab-content').addClass('is-close');
            $('.tab-link.is-active').next().removeClass('is-close').addClass('is-open');
        });
    }

    function handleScroll() {
        scrollTimer = null;
        var scrollTop = $(window).scrollTop();
        if(scrollTop > 100) {
            $('.navbar .logo').css({
                'visibility': 'visible',
                'opacity': 1
            });
        } else {
            $('.navbar .logo').css({
                'visibility': 'hidden',
                'opacity': 0
            });
        }
    }

    // function youtubeLoad() {
    //     if($('.youtube_tabs').length > 0) {
    //         $('.youtube_tabs').find('.video-wrapper').each(function(){
    //             var yID = $(this).data('youtube-id');
    //             $(this).html('<iframe src="//www.youtube.com/embed/'+yID+'" frameborder="0" allowfullscreen></iframe>');
    //         });
    //     }
    // }

    function cleanForm() {
        var $form = $('.sign-up-form');
        $form.find('.error').removeClass('error');
        $form.find('.success').html('').hide();
        $form.find('.errormess').html('').hide();
    }

    var scrollTimer = null;

    $(document).ready(function () {
        var options = {
            onkeyup: false,
            rules: {
                'firstName': 'required',
                'familyName': 'required',
                'email': {
                    required: true,
                    email: true
                },
                'education': 'required',
                'resume': 'required',
            },
            messages: {
                'firstName': 'Please enter your first name',
                'familyName': 'Please enter your last name',
                'email': 'Please enter a valid email address'
            },
            errorClass: 'invalid',
            errorElement: 'span',
            validClass: 'valid',
            submitHandler: function(form) {
                if ($(form).valid()) {
                    $('#job-form-confirmation').show();
                    $('body').css('overflow', 'hidden');
                }
            }
        };

        $('#formCareer').validate(options);

        $('#jobFormAccept').on('click', function() {

            if (typeof FormData === 'undefined') {
                $('#formCareer')[0].submit();
            }

            $('#preloader').show();
            $('body').css('overflow', 'hidden');
            $.ajax({
                url: location.href + '&ajax=1',
                type: "POST",
                data: new FormData($('#formCareer')[0]),
                processData: false,
                contentType: false
            })
            .success(function(data) {
                $('#preloader').hide();
                if (data.success === 'true') {
                    $('#job-form-success').show();
                    $('body').css('overflow', 'hidden');
                }
                else {
                    $('#job-form-error').show().find('.error').text(data.error.errorMessage);
                    $('body').css('overflow', 'hidden');
                }
            })
            .fail(function() {
                $('#preloader').hide();
                $('#job-form-error').show();
                $('body').css('overflow', 'hidden');
            });
        });
    });

    // document ready
    $(function(){
        var $document = $(document),
            $window = $(window),
            $body = $('body');

        initVerticalTab();
        initSignUpForm();
        initAccordionTabs();
        initDropdown();
        initMobileLanguageDropdown();
        initHotPoint();
        initMenuTrigger();

        $('.career__cites').slick({
            dots: true,
            arrows: false,
        });

        if ($body.hasClass('contact_us_page')) {
            initMapContactPage();
        }

        // close all overlay
        $document.on('click', function (e) {
            $('ul.dropdown-menu').hide();
        });

        // Execute on load
        initMobile();
        // Bind event listener
        $window.resize(initMobile);

        if ($body.hasClass('home_page') && $window.width() > 1024) {
            $window.scroll(function () {
                if (scrollTimer) {
                    clearTimeout(scrollTimer);
                }
                scrollTimer = setTimeout(handleScroll, 200);
            });
        }

        //Job Search
        var jobSearchContainer = $('.jobs-search'),
            jobSearchUrl = '/career/',
            jobTypes = {},
            jobList,
            promise;

        var currentPage = 0,
            perPage = 10,
            totalPages;

        var templates = {
            'nothing-found' : '<tr><td class="nothing-found" colspan="4">Nothing Found</td></tr>',
            'pagination-info' : 'Showing {{from}} - {{to}} of {{total}}',
            'job-row' : '<tr data-index="{{index}}"><td><a href="/career-description/?id={{id}}">{{title}}</a></td><td>{{location}}</td><td>{{department}}</td><td>{{type}}</td></tr>',

            render: function(template, data) {
                template = templates[template] || template;
                if (!data) {return template;}

                for(var item in data){
                    var re = '{{' + item + '}}';
                    template = template.replace(new RegExp(re, 'ig'), data[item]);
                }
                return template;
            }
        };

        if (jobSearchContainer.length) {
            if (location.hash) {
                $(window).scrollTop($('#jobs').offset().top);
            }

            promise = $.ajax({
                type: 'post',
                url: jobSearchUrl,
                data: {
                    do: 'applicationFormPredefinedInfos',
                    types: 'locations,verticals,employmentTypes'
                },
                dataType: 'json'
            });

            promise.done(function(data) {
                var countryList = [];
                $.each(data[0].result, function (idx, value) {
                    if(value.name){
                        value.name = value.name.split('-')[0];
                        if (value.name === 'Lazada South East Asia Pte. Ltd.') {
                            value.name = 'Singapore HQ';
                        }
                        else if (value.name === 'Russia') {
                            value.name = 'Russia Techhub';
                        }
                        else if (value.name === 'helloPay Singapore Pte Ltd') {
                            value.name = 'helloPay Singapore';
                        }
                        countryList.push(value);
                    }
                });
                fillSelect($('.job-search__locations'), countryList);
                fillSelect($('.job-search__categories'), data[1].result);
                data[2].result.forEach(function(item) {
                    jobTypes[item.value] = item.name;
                });

                $(window).trigger('hashchange');
            });

            $('.jobs-search-list__pagination').on('click', 'span', function(e) {
                var $elem = $(e.target);
                //closeJobs();
                if ($elem.hasClass('prev')) {showJobs(--currentPage);}
                else if ($elem.hasClass('next')) {showJobs(++currentPage);}
                else {showJobs($elem.data('page'));}
            });

            $('.jobs-search form').on('submit', function(e) {
                e.preventDefault();
                //closeJobs();
                var $form = $(e.target);

                /*if (false) {//$form.find('[name="keyword"]').val().trim() === "") {
                    $form.find('[name="keyword"]').addClass('error').focus();
                }
                else {
                    location.hash = $form.serialize();
                }*/

                location.hash = $form.serialize();
            });

            $(window).on('hashchange', function() {
                var $form = $('.jobs-search form');
                var params = {};

                location.hash.replace('#', '').split('&').forEach(function(item) {
                    var value = item.split('=');
                    params[value[0]] = value[1];
                });

                $form.find('[name="keyword"]').val(params['keyword']).removeClass('error');
                $form.find('[name="categoryId"]').val(params['categoryId'])
                $form.find('[name="locationId"]').val(params['locationId'])


                $('.jobs-search-list tbody').html('');
                $('.jobs-search-list__preloader').show();
                $('.jobs-search-list__pagination').addClass('hide');
                $('.jobs-search-list__title').text('Search Results');
                $('.jobs-search-list__pagination-info').text('');
                $.ajax({
                    type: 'post',
                    url: jobSearchUrl,
                    data: location.hash.replace('#', '') + '&do=careersiteJobSearch',
                    dataType: 'json'
                }).done(function(data) {
                    currentPage = 0;
                    jobList = data;
                    totalPages = Math.ceil(jobList.length / perPage) - 1;

                    showPagination();
                    showJobs(currentPage);
                });
            })

            /*$('.jobs-search-list table').on('click', 'tr', function(e) {
                var $elem = $(e.target).closest('tr'),
                    //$container = $('.job-search-list__content'),
                    //$description = $('.job-search-list__job-description'),
                    url = '/career-description/?id=' + jobList[$elem.data('index')].id;

                location.href = url;

                //if ($(window).width() < 768) {
                //    location.href = url;
                //} else {
                //    $elem.parent().find('.active').removeClass('active');
                //    $elem.addClass('active');
                //    $description.height($container.height() - 45);
                //    $description.find('.content').height($description.height() - 40).html(jobList[$elem.data('index')].publicDescription);
                //    $description.find('.apply-button').attr('href', url);
                //    //$description.find('.description-title').text(jobList[$elem.data('index')].name);
                //    $description.show();
                //}
            });*/

            /*$(window).on('orientationchange', function() {
                closeJobs();
            });

            $('.job-search-list__job-description div.close-icon').on('click', function(){
                closeJobs();
            });
            $('body').on('click', function(e) {
                if (!$(e.target).closest('.job-search-list__content').length
                    || $(e.target).hasClass('description-close')) {
                    $('.job-search-list__job-description').hide();
                    $('.job-search-list__content .active').removeClass('active');
                }
            });*/
        }

        /*function closeJobs () {
            $('.job-search-list__job-description').hide();
            $('.job-search-list__content .active').removeClass('active');
        }*/

        function showJobs(page) {
            if (page === undefined || !checkPage(page)) {return;}

            var jobs = $(document.createDocumentFragment()),
                from = page * perPage,
                to = ++page * perPage,
                item;

            to = (to > jobList.length) ? jobList.length : to;
            for (var i = from; i < to; i++) {
                item = jobList[i];
                jobs.append(templates.render('job-row', {
                    'id' : item.id,
                    'index' : i,
                    'title' : item.name,
                    'location' : item.locationName,
                    'department' : item.verticalName,
                    'type' : jobTypes[item.positionType]
                }));
            }
            $('.jobs-search-list__pagination-info').text(templates.render('pagination-info', { from: from + 1, to: to, total: jobList.length }));
            $('.jobs-search-list tbody').html(jobs);
        }

        function showPagination() {
            var pages = $(document.createDocumentFragment());
            if (totalPages > 0) {
                for (var i = 0; i <= totalPages; i++) {
                    pages.append('<span data-page="' + i + '">' + (i + 1) + '</span>')
                }
                $('.jobs-search-list__pagination')
                    .removeClass('hide')
                    .find('.pages')
                    .html(pages);
            }
            $('.jobs-search-list__preloader').hide();
            if (!jobList.length) {
                $('.jobs-search-list thead').hide();
                $('.jobs-search-list tbody').html(templates.render('nothing-found'));
            }
            else {
                $('.jobs-search-list thead').show();
            }
        }

        function fillSelect($select, data) {
            var options = $(document.createDocumentFragment());
            data.forEach(function(item) {
                $('<option />')
                    .text(item.name)
                    .attr('value', item.value)
                    .appendTo(options);
            });
            $select.append(options);
        }

        function checkPage(page) {
            if (page < 0) {
                currentPage = 0;
                return false;
            }
            else if (page > totalPages) {
                currentPage = totalPages;
                return false;
            }

            currentPage = page;
            $('.jobs-search-list__pagination span').removeClass('disabled');

            if (currentPage === 0) $('.jobs-search-list__pagination .prev').addClass('disabled');
            else if (currentPage === totalPages) $('.jobs-search-list__pagination .next').addClass('disabled');
            $('.jobs-search-list__pagination .pages span').eq(currentPage).addClass('disabled');

            return true;
        }


        //Media year filter

        if ($('.media-list').length) {
            $('.media-list__filter-year').on('change', function () {
                var $this = $(this);
                location.hash = $this.val();
            });

            $(window).on('hashchange', function() {
                mediaFilterHashChecking();
            });

            mediaFilterHashChecking();
        }

        function mediaFilterHashChecking() {
            var hash = location.hash.substr(1);
            var select = $('.media-list__filter-year');
            if (hash && hash === 'all') {
                $('.media-list__group').fadeIn(400);
                select.val('all');
            }
            else if (hash) {
                $('.media-list__group').hide();
                select.val(hash);
                $('.media-list__group[data-year="' + hash +'"]').fadeIn(400);
            }
        }
    });

    // window load
    // $(window).load(function() {
    //     youtubeLoad();
    // });
}(window, window.document, window.jQuery, window.google));

window.getCategory = function() {
    var category;
    if (document.location.href.indexOf('about') !== -1) {
        category = 'about';
    }
    else if (document.location.href.indexOf('sell') !== -1) {
        category = 'sell';
    }
    else {
        category = 'homepage';
    }
    return category;
};
