(function ($) {
    "use strict";
    $.app = new function () {
        this.vars = {};
        this.posting = false;
        var interval = null;
        var tmpHtml = null;
        var instance = this;

        this.init = function (args) {
            //Set vars
            for (var i in args) {
                if (args.hasOwnProperty(i)) {
                    instance.vars[i] = args[i];
                }
            }

            // Another init for class
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $.app.vars.token
                }
            });

            this.facebook.init();
            window.isMobile = function () {
                var check = false;
                (function (a) {
                    if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true;
                })(navigator.userAgent || navigator.vendor || window.opera);
                return check;
            };
        };

        this.ajax = function (obj, url, formData, callback, method, alertClass, allowDuplicate) {
            if($.app.posting && !allowDuplicate) return false;

            var $button = $(obj);
            var $alert = alertClass ? $(alertClass) : $button.parent().closest('alert');
            method = method || "POST";

            $.app.tmpHtml = obj ? $button.html() : null;
            $button.html('<img style="width:20px" src="' + $.app.vars.url + 'assets/lib/images/loading.gif"/>');

            //$alert.addClass('alert').addClass('hidden').addClass('text-left').removeClass('alert-danger').removeClass('alert-success');
            $alert.addClass('text-left').removeClass('alert-danger').removeClass('alert-success');

            $.app.posting = true;
            $.ajax({
                type: method,
                url: url.indexOf($.app.vars.url) > -1 ? url : $.app.vars.url + url,
                data: formData,
                success: function (data) {
                    $.app.posting = false;
                    $alert.removeClass('hidden').html(data.message);
                    if (data.code) {
                        $alert.addClass('alert-success');
                    } else {
                        $alert.addClass('alert-danger');
                    }

                    $button.html($.app.tmpHtml);

                    if (typeof callback === 'function') {
                        callback(data);
                    }
                },
                statusCode: {
                    400: function (response) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: response.responseJSON.message,
                        });
                    },
                    403: function (response) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: response.responseJSON.message,
                        });
                    },
                    404: function (response) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: response.responseJSON.message,
                        });
                    }
                },
                error: function () {
                    $.app.posting = false;
                    $button.html($.app.tmpHtml);
                    $alert.removeClass('hidden').addClass('alert-danger').html('<strong>Th??ng b??o:</strong> L???i khi x??? l?? d??? li???u. B???n vui l??ng th??? l???i.');
                },
                done: function () {
                    $.app.posting = false;
                }
            });
        };

        this.checkLogin = function (redirectTo, callback) {
            $.app.cookie.setCookie('fbRedirect', redirectTo ? redirectTo : window.location.href);
            $.app.cookie.setCookie('fbCallback', callback ? callback.name : null);

            var _cb = function (res) {
                // Logged in, can continue
                if (res.code !== 2) {
                    //$('#loginModal').close();
                    //$.app.checkProfile();
                    if (callback) {
                        callback(res);
                    } else {
                        if (redirectTo) {
                            window.location.href = redirectTo;
                        }
                    }
                }

                // Logged out, login again
                if (res.code === 2) {
                    // Check login
                    $('#loginModal').modal({});
                    $('#loginModal .form').removeClass('hidden');
                    $('#loginModal .process').addClass('hidden');
                    $('#loginModal .redirect_link').unbind('click').bind('click', function () {
                        window.location.href = res.data.login_url;
                        return false;
                    });

                    $('.btn-fb, .btn-fblogin-modal').unbind('click').bind('click', function () {
                        var $agent = window.navigator.userAgent;
                        if ($agent.indexOf('SamsungBrowser') > -1 || window.isMobile()) {
                            window.location.href = res.data.login_url;
                            return false;
                        } else {
                            var _cbLogin = function (resLogin) {
                                $.modal.close();
                                //$.app.checkProfile();
                                if (callback) {
                                    callback(resLogin);
                                } else {
                                    if (redirectTo) {
                                        window.location.href = redirectTo;
                                    }
                                }
                            };

                            $.app.facebook.login(_cbLogin);
                            return false;
                        }
                    });

                    $('.btn-gg').unbind('click').bind('click', function () {
                        window.location.href = $.app.vars.url + 'auth/google';
                        return false;
                    });
                }
            };

            $.app.ajax(null, 'facebook/checkLogin', {
                redirect: redirectTo
            }, _cb, 'get', '.alert-none');
            return false;
        };

        this.checkProfile = function() {
            // Not have to check profile
            $.app.processCallback();
            return false;

            var _cb = function(res){
                // Must update profile
                if(res.code && res.user && !res.user.mobile){
                    $('#profile .form-title').html('Ch??o ' + res.user.name);
                    $('#profile input[name=name]').val(res.user.name);
                    $('#profile input[name=email]').val(res.user.email);
                    $('#profile').modal({});
                } else {
                    $.app.processCallback();
                }
            };

            $.app.ajax(null, 'contest/checkUser', {}, _cb, 'get', '.alert-none');
        };

        this.submitProfile = function(btn, formClass) {
            var _cb = function(res){
                if(res.code){
                    $.app.processCallback();
                }
            };

            $.app.ajax(btn, 'member/update', $(formClass).serialize(), _cb, 'POST', '.alert-profile');
            return false;
        };

        this.processCallback = function () {
            var callback = $.app.cookie.getCookie('fbCallback');
            var redirectTo = $.app.cookie.getCookie('fbRedirect');

            if (callback) {
                callback();
            } else {
                if (redirectTo) {
                    window.location.href = redirectTo;
                }
            }
        };

        // Modal functions
        this.modal = new function () {
            this.show = function (html) {
                $('#sysModal').modal({});
                $('#sysModal .body').html(html);
            };

            this.contentModal = function (obj) {
                var $modal = $('#sysModal');
                var $obj = $(obj);

                $modal.modal({});
                $modal.find('.modal-title').html($obj.data('title'));

                var _cb = function (data) {
                    if (data.code) {
                        $modal.find('.modal-body').html(data.data);
                    }
                };

                $.app.ajax(null, $obj.data('content-ajax'), {}, _cb, 'GET', '');
                return false;
            };

            this.videoModal = function (obj) {
                //alert($.app.vars.url);
            };
        };

        // Facebook SDK functions
        this.facebook = new function () {
            this.init = function () {
                window.fbAsyncInit = function () {
                    FB.init({
                        appId: $.app.vars.facebook_appid,
                        xfbml: true,
                        cookie: true,
                        version: 'v2.9'
                    });
                };

                (function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=" + $.app.vars.facebook_appid;
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            };

            this.login = function (callback) {
                FB.login(function (response) {
                    if (response) {
                        if (response.authResponse && response.status === 'connected') {
                            var accessToken = response.authResponse.accessToken;

                            $('#loginModal .form').addClass('hidden');
                            $('#loginModal .process').removeClass('hidden');

                            $.ajax({
                                type: 'GET',
                                url: $.app.vars.url + 'facebook/login',
                                data: {accessToken: accessToken},
                                success: function (data) {
                                    if (data.code === 1) {
                                        if (callback) {
                                            callback(data);
                                        }
                                    } else {
                                        Swal.fire({
                                            type: 'error',
                                            title: 'Oops...',
                                            html: data.message,
                                            //footer: '<a href>Why do I have this issue?</a>'
                                        });

                                        $.modal.close();
                                    }
                                }
                            });

                        } else {
                            // Response error!!!
                        }
                    }
                    //}, {scope: 'email,user_link'});
                }, {
                    scope: 'email'
                });
            };

            this.share = function (shareLink, callback, redirectLink, forceRedirect) {
                if (window.isMobile() || forceRedirect) {
                    window.location.href = $.app.facebook.getShareLink(shareLink, $.app.vars.contest_hastag, $.app.vars.contest_quote, redirectLink);
                } else {
                    FB.getLoginStatus(function (response) {
                        if (response.authResponse) {
                            FB.ui({
                                method: 'share',
                                href: shareLink,
                                mobile_iframe: false,
                                display: 'iframe',
                                quote: $.app.vars.contest_quote,
                                hashtag: $.app.vars.contest_hastag
                            }, function (response) {
                                if (response) {
                                    if ((response.error_message && $(window).outerWidth() < 768) || !response.error_message) {
                                        if (callback) {
                                            callback();
                                        }
                                    }
                                }
                            });
                        } else {
                            $.app.facebook.login(null);
                        }
                    });
                }
            };

            this.getShareLink = function (shareLink, $hastag, $quote, redirectLink) {
                return 'https://www.facebook.com/sharer.php?' +
                    'u=' + encodeURIComponent(shareLink) +
                    '&app_id=' + $.app.vars.facebook_appid +
                    '&hashtag=' + encodeURIComponent($hastag) +
                    '&quote=' + encodeURIComponent($quote) +
                    (window.isMobile() ? '&display=touch' : '&display=page') +
                    '&redirect_uri=' + encodeURIComponent(redirectLink ? redirectLink : $.app.vars.url)
            };

            this.send = function (sendLink) {
                var _cb = function (data) {
                    FB.getLoginStatus(function (response) {
                        if (response.authResponse) {
                            FB.ui({
                                method: 'send',
                                link: sendLink,
                            });
                        }
                    });
                };

                $.app.checkLogin(null, _cb);
                return false;
            };
        };

        // Submit function
        this.contest = new function () {
            this.submitId = null;
            this.modal = $('#voteModal');

            this.vote = function (submitId) {
                $.app.contest.submitId = submitId;

                var _cb = function (data) {
                    $('#voteModal').modal({});
                    $('#voteModal .modal-title').html('X??c nh???n Vote');

                    // End vote time
                    if (data.code === 3) {
                        $('#voteModal .alert-message').removeClass('hidden').html('???? h???t th???i gian Vote cho b??i thi');
                        $('#voteModal .alert-captcha').addClass('hidden');
                    } else {
                        $('#voteModal .alert-message').addClass('hidden');
                        $('#voteModal .alert-captcha').removeClass('hidden');
                        $('.alert-notify').addClass('hidden');

                        // Init vote form
                        var _cbCatpcha = function (captchaRespondCode) {
                            if (captchaRespondCode !== "") {
                                $('#voteModal .alert-message').removeClass('hidden').html('??ang x??? l??...');
                                $('#voteModal .alert-captcha').addClass('hidden');

                                var _cbVote = function (resVote) {
                                    $('#voteModal .alert-message').html(resVote.message);

                                    if (resVote.code) {
                                        $('.contest-votes-' + $.app.contest.submitId).html(resVote.count);
                                        $('.contest-ranks-' + $.app.contest.submitId).html(resVote.countRanks);
                                        var totalVotes = $('.js-total-votes .number').attr('data-number');
                                        totalVotes = ++totalVotes;
                                        $('.js-total-votes .number').text(totalVotes);
                                        $('.js-total-votes .number').attr('data-number', totalVotes);

                                        $('.alert-notify').removeClass('hidden');
                                    } else {

                                    }
                                };

                                $.app.ajax(null, 'contest/vote', {
                                    id: $.app.contest.submitId,
                                    'g-recaptcha-response': captchaRespondCode
                                }, _cbVote, 'get', '');
                            }
                        };

                        _cbCatpcha('1');
                        //$.app.recaptcha.init('recaptchaVote', _cbCatpcha);
                    }
                };

                // Check login => If not, redirect to facebook => Back to site to vote
                //$.app.checkLogin($.app.vars.url + 'contest/' + submitId + '?vote=' + submitId + '&', _cb);
                var $href = window.location.href;
                $href = ($href.indexOf('?') >= 0) ? ($href + '&') : ($href + '?');

                $.app.checkLogin($href + 'vote=' + submitId + '&', _cb);
                return false;
            };

            this.share = function (submitId, contestCreate = false) {
                $.app.contest.submitId = submitId;

                // Contest details link
                var shareLink = $.app.vars.url
                    + 'contest/'
                    + submitId
                    + '?utm_medium=user_share&utm_source=facebook&utm_campaign='
                    + $.app.vars.contest_campaign;

                // Link go to current page and show Share form
                var $currentUrl = window.location.href;
                $currentUrl = ($currentUrl.indexOf('?') >= 0) ? ($currentUrl + '&') : ($currentUrl + '?');
                $currentUrl += 'share=' + submitId + '&';

                var _cb = function (data) {
                    var _cbShare = function () {
                        $.app.contest.shareForm($.app.contest.submitId, contestCreate);
                    };

                    $.app.facebook.share(shareLink, _cbShare, $currentUrl);
                };

                // Check login, if not => redirect to facebook login => Redirect to share page
                var $redirectShare = $.app.facebook.getShareLink(shareLink, $.app.vars.contest_hastag, $.app.vars.contest_quote, $currentUrl);

                $.app.checkLogin($redirectShare, _cb);
                return false;
            };

            this.shareForm = function (submitId, contestCreate = false) {
                $('#voteModal').modal({});
                $('#voteModal .modal-title').html('X??c nh???n Share');
                $('#voteModal .alert-captcha').addClass('hidden');
                $('#voteModal .alert-message').removeClass('hidden').html('??ang x??? l??...');

                var _cbShare = function (resShare) {
                    $('#voteModal .alert-message').html(resShare.message);

                    if (resShare.code) {
                        if (contestCreate) {
                            $('#successShareModal').modal({
                                escapeClose: false,
                                clickClose: false,
                                showClose: false
                            });
                        }
                        else {
                            $('.contest-shares-' + submitId).html(resShare.count);
                            $('.contest-ranks-' + submitId).html(resShare.countRanks);

                            $('#voteModal').modal('hide');
                            $('#thanksModal').modal({});
                        }
                    }
                };

                $.app.ajax(null, 'contest/share', {
                    id: submitId
                }, _cbShare, 'get', '');
            };

            this.showDetails = function (contestId) {
                var _cbDetails = function (res) {
                    if (res.code) {
                        $('#contestModal').modal({});
                        $('#contestModal .user_name').html(res.data.user_name);
                        $('#contestModal .detail-name').html(res.data.title);
                        $('#contestModal .detail-eat').html(res.data.user_name);
                        $('#contestModal .recipe-des').html(res.data.introtext);
                        $('#contestModal .cook-method').html(res.data.fulltext);
                        $('#contestModal .shares-count').html(res.data.shares);
                        $('#contestModal .votes-count').html(res.data.votes);
                        $('#contestModal .detail-rank-num').html(res.data.ranks);

                        $('#contestModal .btn-contest .number-votes').text(res.data.votes);
                        $('#contestModal .btn-contest .number-shares').text(res.data.shares);
                            $('#contestModal .btn-print').attr('href', $.app.vars.url + 'contest/' + res.data.id + '?print=1');

                        $('#contestModal .image_full').parent().addClass('d-none');
                        $('#contestModal .image_' + res.data.image_type).removeClass('d-none');
                        $('#contestModal .image_full').attr('src', $.app.vars.url + res.data.image_full);

                        var imageThumb = res.data.image_full.split(',');
                        // console.log("kokokooo",imageThumb);
                        var htmlSlide = '';
                        for (var j in imageThumb) {
                            if (imageThumb[j]) {
                                htmlSlide += `<div class="swiper-slide"><img src="${ $.app.vars.url + imageThumb[j] }" alt=""></div>`;
                            }
                        }
                        $('#contestModal  .swiper-container  .swiper-wrapper').html(htmlSlide);
                        homeObj.initSwipDetails();

                        if (!res.data.image_type) {
                            $('#contestModal .user-cts').addClass('user-cts-custom');
                        }

                        $('#contestModal .btn-share').unbind('click').bind('click', function () {
                            $.app.contest.share(res.data.id);
                            return false;
                        });

                        $('#contestModal .btn-vote').unbind('click').bind('click', function () {
                            $.app.contest.vote(res.data.id);
                            return false;
                        });

                    }
                };

                $.app.ajax(null, 'contest/' + contestId, {}, _cbDetails, 'GET', '.alert-forms');
                return false;
            };
        };

        this.recaptcha = new function () {
            this.object = null;

            this.init = function (initDivId, verifyCallback) {
                if ($.app.recaptcha.object !== null) {
                    grecaptcha.reset($.app.recaptcha.object);
                } else {
                    setTimeout(function () {
                        $.app.recaptcha.object = grecaptcha.render(initDivId, {
                            'sitekey': $.app.vars.captcha_sitekey,
                            'theme': 'light',
                            'callback': verifyCallback
                        });
                    }, 1000);
                }
            }
        };

        this.cookie = new function () {
            this.domain = '';

            this.getCookie = function (name, defaultValue) {
                var nameEQ = name + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
                }

                return null;
            };

            this.setCookie = function (name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            };

            this.deleteCookie = function (name) {
                document.cookie = name + '=; Max-Age=-99999999;';
            }
        };

        this.countdown = new function () {
            this.countDownSeconds = function (seconds, updateTo, redirectTo) {
                var timeleft = 0;
                var downloadTimer = setInterval(function () {
                    $(updateTo).html('<span style="color:red">' + (seconds - timeleft) + 's</span>');
                    if ((seconds - timeleft) <= 0) {
                        clearInterval(downloadTimer);
                        if (redirectTo) {
                            window.location.href = redirectTo;
                        }
                    }
                    timeleft++;
                }, 1000);
            };
        };

        this.upload = new function () {
            this.fileTypes = ['jpg', 'jpeg', 'png', 'pdf', 'heic'];
            this.fileSizeMax = 10; // Limit size x MB
            this.fileSizeMin = 0; // Limit size x MB
            this.uploadMultiple = false;

            this.initForm = function (name) {

                let nameUpload = 'name="upload-file"';
                let multiple = '';

                if (this.uploadMultiple) {
                    nameUpload = 'upload-file[]';
                    multiple = 'multiple';
                }

                if (!$('#ajaxUploadForm' + name).length) {
                    $('body').append('<form id="ajaxUploadForm' + name + '" action="process.php" class="hidden" method="post" enctype="multipart/form-data">\n' +
                        '        <input name="'+ nameUpload +'" '+ multiple +' id="upload-file" type="file"  />\n' +
                        '    </form>');
                }

                return $('#ajaxUploadForm' + name);
            };

            this.initUpload = function (formName, submitUrl, progressClass, callback, obj) {
                submitUrl = submitUrl || 'media/uploadImage';
                var $uploadForm = $.app.upload.initForm(formName);
                var isUploadMultiple = this.uploadMultiple;

                $(progressClass).html('<div id="progress-wrp"><div class="progress-bar"></div ><div class="status">0%</div></div>').hide();

                $uploadForm.find('#upload-file').unbind('change').bind('change', function () {
                    var formData = new FormData();
                    if (! isUploadMultiple) {
                        var file = $uploadForm.find('#upload-file').get(0).files[0];

                        // Check file type and extension
                        if (file) {
                            var extension = file.name.split('.').pop().toLowerCase(),
                                isSuccess = $.app.upload.fileTypes ? ($.app.upload.fileTypes.indexOf(extension) > -1) : true,
                                fileSize = parseFloat(file.size / 1024 / 1024),
                                isLimitSize = fileSize > $.app.upload.fileSizeMax || fileSize < $.app.upload.fileSizeMin;

                            if (!isSuccess) { //no
                                $(progressClass).show().html('<div class="alert alert-danger" style="padding:2px; margin:0px;">Ki???u file kh??ng h???p l???, h??? th???ng ch??? ch???p nh???n c??c file: ' + $.app.upload.fileTypes.join(', ') + '</div>');
                                return false;
                            }

                            if (isLimitSize) { //no
                                $(progressClass).show().html('<div class="alert alert-danger" style="padding:2px; margin:0px;">Dung l?????ng ???nh kh??ng h???p l???, dung l?????ng ???nh ph???i n???m trong kho???ng: ' + $.app.upload.fileSizeMin + 'MB ?????n '+$.app.upload.fileSizeMax+'MB </div>');
                                return false;
                            }

                            if (isSuccess) { //yes
                                var reader = new FileReader();
                                reader.onload = function (e) {

                                };
                                //reader.readAsDataURL(file);
                            }
                        }

                        formData.append('upload-file', file);
                    }
                    else {
                        var files = $uploadForm.find('#upload-file').get(0).files;

                        // Check file type and extension
                        if (files.length) {

                            var isSuccess = false;

                            $.each(files, function (index, file) {
                                var extension = file.name.split('.').pop().toLowerCase(),
                                    fileSize = parseFloat(file.size / 1024 / 1024),
                                    isLimitSize = fileSize > $.app.upload.fileSizeMax || fileSize < $.app.upload.fileSizeMin;

                                isSuccess = $.app.upload.fileTypes ? ($.app.upload.fileTypes.indexOf(extension) > -1) : true;

                                if (!isSuccess) { //no
                                    $(progressClass).show().html('<div class="alert alert-danger" style="padding:2px; margin:0px;">Ki???u file kh??ng h???p l???, h??? th???ng ch??? ch???p nh???n c??c file: ' + $.app.upload.fileTypes.join(', ') + '</div>');
                                    return false;
                                }

                                if (isLimitSize) { //no
                                    $(progressClass).show().html('<div class="alert alert-danger" style="padding:2px; margin:0px;">Dung l?????ng ???nh kh??ng h???p l???, dung l?????ng ???nh ph???i n???m trong kho???ng: ' + $.app.upload.fileSizeMin + 'MB ?????n '+$.app.upload.fileSizeMax+'MB </div>');
                                    return false;
                                }
                            });

                            if (isSuccess) { //yes
                                var reader = new FileReader();
                                reader.onload = function (e) {

                                };
                                //reader.readAsDataURL(file);
                            }
                        }
                        $.each(files, function (index, file) {
                            formData.append('upload-file[]', file);
                        });
                    }

                    $.ajax({
                        url: $.app.vars.url + submitUrl,
                        type: 'POST',
                        contentType: false,
                        cache: false,
                        processData: false,
                        data: formData,
                        mimeType: "multipart/form-data",
                        xhr: function () {
                            $(progressClass).show();

                            //upload Progress
                            var xhr = $.ajaxSettings.xhr();
                            if (xhr.upload) {
                                xhr.upload.addEventListener('progress', function (event) {
                                    var percent = 0;
                                    var position = event.loaded || event.position;
                                    var total = event.total;
                                    if (event.lengthComputable) {
                                        percent = Math.ceil(position / total * 100);
                                    }

                                    //update progressbar
                                    $("#progress-wrp .progress-bar").css("width", +percent + "%");
                                    $("#progress-wrp .status").text(percent + "%");
                                }, true);
                            }
                            return xhr;
                        },
                        success: function (res) {
                            res = $.parseJSON(res);

                            //Do something success-ish
                            if (!res.code) {
                                $(progressClass).show().html('<div class="alert alert-danger" style="padding:2px; margin:0px;">' + res.message + '</div>');
                            } else {
                                $(progressClass).show().html('<div class="alert alert-success" style="padding:2px; margin:0px;">' + res.message + '</div>');
                            }

                            if (callback) {
                                callback(res);
                            }

                            $(obj).html('<i class="fa fa-upload"></i> ?????i ???nh kh??c');
                        }
                    });

                    return false;
                });

                $uploadForm.find('#upload-file').val('');
                $uploadForm.find('#upload-file').trigger('click');
            };

            this.uploadFile = function (progressClass, callback) {
                $.app.upload.fileTypes = ['psd', 'ai'];

                this.initUpload('FileForm', 'media/uploadFile', progressClass, callback);
                return false;
            };

            this.uploadVideo = function (progressClass, callback) {
                $.app.upload.fileTypes = ['mp4', 'mov', 'avi'];
                $.app.upload.fileSizeMax = 200;
                $.app.upload.fileSizeMin = 0;

                this.initUpload('FileForm', 'media/uploadVideo', progressClass, callback);
                return false;
            };

            this.uploadImage = function (progressClass, callback) {
                $.app.upload.fileTypes = ['jpg', 'jpeg', 'png'];

                this.initUpload('Image2Form', 'media/uploadImage', progressClass, callback);
                return false;
            };

            this.uploadImageMultiple = function (progressClass, callback) {
                $.app.upload.fileTypes = ['jpg', 'jpeg', 'png'];
                this.uploadMultiple = true;

                this.initUpload('Image2Form', 'media/uploadImageMultiple', progressClass, callback);
                return false;
            };

            this.uploadAdmin = function (progressClass, callback, resize) {
                $.app.upload.fileTypes = false;
                $.app.upload.fileSizeMax = 200;
                $.app.upload.fileSizeMin = 0;

                this.initUpload('Image2Form', 'media/admin/upload?resize=' + resize, progressClass, callback);
                return false;
            };
        };

        this.news = new function () {
            this.pages = {};
            this.loadMore = function (btn, url, appendClass, page, replaceClass) {
                if(page) {
                    $.app.news.pages[encodeURI(url)] = page;
                } else {
                    if ($.app.news.pages[encodeURI(url)]) {
                        $.app.news.pages[encodeURI(url)]++;
                    } else {
                        $.app.news.pages[encodeURI(url)] = 2;
                    }
                }

                $(btn).show();
                var _cb = function(res){
                    if(res.code){
                        if(appendClass){
                            $(appendClass).append(res.data);
                        }
                        if(replaceClass){
                            $(replaceClass).html(res.data);
                        }

                    }else{
                        if(replaceClass){
                            $(replaceClass).html(res.data);
                            $(btn).hide();

                        } else {
                            $(btn).html('Kh??ng c?? th??m d??? li???u!').attr('onclick', 'return false;');
                        }
                    }
                };

                $.app.ajax(btn, url + '&page=' + $.app.news.pages[encodeURI(url)], {}, _cb, 'GET', null);
                return false;
            };
        };

        this.cart = new function () {
            this.init = function () {
                $('.btn-buy-now').unbind('click').bind('click', function () {
                    var _cb = function(res){
                        if (!res.code) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: res.message,
                            });
                            return false;
                        }

                        Swal.fire({
                            title: 'Gi??? h??ng',
                            icon: 'info',
                            html: res.data.html,
                            showCloseButton: true,
                            showCancelButton: false,
                            focusConfirm: false,
                            reverseButtons: true,
                            confirmButtonText:
                                '?????t mua <i class="fa fa-arrow-right"></i>',
                            cancelButtonText:
                                '<i class="fa fa-close"></i> ????ng l???i',
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = $.app.vars.url + 'cart';
                            }
                        });

                        $.app.cart.init();
                    };

                    $.app.ajax(this, 'cart', {id: $(this).data('id'), action: $(this).data('action'), qty: $($(this).data('qty')).val(), attr: $($(this).data('attr')).serialize()}, _cb, 'POST');
                });

                $('.popup-action').unbind('click').bind('click', function () {
                    var $action = $(this).data('action');
                    if ($action === 'remove' && !confirm('B???n c?? ch???c ch???n mu???n x??a?')){
                        return false;
                    }

                    var _cb = function(res){
                        $('.cart-content-products').html(res.data.html);
                        $('.cart-total').html(res.data.total);
                        $.app.cart.init();
                    };

                    $.app.ajax(this, 'cart', {id: $(this).data('id'), action: $(this).data('action'), attr: $($(this).data('attr')).serialize()}, _cb, 'POST');
                });
            };
        };

        this.comment = new function () {
            this.page = 1;
            this.rating = 0;
            this.module = 1;
            this.moduleItemId = 1;

            this.init = function () {
                var $commentBlock = $('.comments-block');
                $.app.comment.rating = $commentBlock.data('rating');
                $.app.comment.module = $commentBlock.data('module');
                $.app.comment.moduleItemId = $commentBlock.data('module-item-id');

                var _cb = function(res){
                    if(res.code){
                        $commentBlock.html(res.data);
                        $.app.comment.initCommentForm();
                    }
                };

                $.app.ajax(null, 'comments', {
                        module: $.app.comment.module,
                        module_item_id: $.app.comment.moduleItemId,
                        rating: $.app.comment.rating,
                    }, _cb, 'GET');
                return false;
            };

            this.initCommentForm = function () {
                // Click submit rating & comment
                $('#btn-review-send').unbind('click').bind('click', function () {
                    var $content = $('#rate-content').val();
                    if (!$content) {
                        alert('B???n vui l??ng nh???p n???i dung B??nh lu???n!');
                        return false;
                    }

                    $('.comment-form textarea[name=content]').val( $content );
                    $('.comment-form input[name=parent_id]').val( 0 );
                    $('.comment-form .rating-stars').show();
                    $('#commentForm').modal();
                });

                // Click reply
                $('.btn-comment-reply').unbind('click').bind('click', function () {
                    var $id= $(this).data('id');
                    $('.comment-reply-form-' + $id).toggleClass('d-none');
                });

                // Click send reply
                $('.btn-comment-reply-send').unbind('click').bind('click', function () {
                    var $id= $(this).data('id');
                    var $parentId= $(this).data('parentid');
                    var $content = $('.comment-reply-content-' + $id).val();
                    if (!$content) {
                        alert('B???n vui l??ng nh???p n???i dung B??nh lu???n!');
                        return false;
                    }

                    $('.comment-form textarea[name=content]').val( $content );
                    $('.comment-form input[name=parent_id]').val( $parentId );
                    $('.comment-form .rating-stars').hide();
                    $('#commentForm').modal();
                });

                // Click send comment
                $('.btn-submit-comment').unbind('click').bind('click', function () {
                    var _cb = function(res){
                        if(res.code){
                            $('.comment-form .form-group').hide();
                        }
                    };

                    $.app.ajax(this, 'comments', $('.comment-form').serialize(), _cb, 'POST', '.alert-comment');
                    return false;
                });

                // Click like
                $('.btn-like-comment').unbind('click').bind('click', function () {
                    var $id = $(this).data('id');

                    var _cb = function(res){
                        if(res.code){
                            $('.like-comment-' + $id).html(res.data);
                        }
                    };

                    $.app.ajax(this, 'comments/like', {id: $id}, _cb, 'POST', '.alert-like');
                    return false;
                });

                $('.btn-view-more-comment').on('click', function () {
                    $.app.comment.page++;

                    var _cb = function(res){
                        if(res.code){
                            $('#rate-reviews').append(res.data);
                            $.app.comment.initCommentForm();
                        }
                    };

                    $.app.ajax(this, 'comments', {module: $.app.comment.module, module_item_id: $.app.comment.moduleItemId, page: $.app.comment.page}, _cb, 'GET');
                    return false;
                });
            };
        };

        this.utils = new function () {
            this.numberFormat = function (amount, decimalCount = 0, decimal = ",", thousands = ".") {
                try {
                    decimalCount = Math.abs(decimalCount);
                    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

                    const negativeSign = amount < 0 ? "-" : "";

                    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
                    let j = (i.length > 3) ? i.length % 3 : 0;

                    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
                } catch (e) {
                    console.log(e)
                }
            };
        };

        this.alert = new function () {
            this.error = function (message) {
                Swal.fire({
                    type: 'error',
                    title: 'Th??ng b??o',
                    allowOutsideClick: false,
                    text: message,
                });
            };

            this.info = function (message) {
                Swal.fire({
                    type: 'info',
                    allowOutsideClick: false,
                    text: message,
                });
            };

            this.confirm = function (message, callback) {
                Swal.fire({
                    text: message,
                    type: 'question',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#999',
                    confirmButtonText: 'C??',
                    cancelButtonText: 'Kh??ng',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.value) {
                        if(callback) {
                            callback();
                        }
                    }
                })
            };

            this.redirect = function (message, url) {
                Swal.fire({
                    icon: 'error',
                    title: 'Th??ng b??o',
                    allowOutsideClick: false,
                    text: message,
                    onClose: () => {
                        window.location.href = url;
                    }
                });
            };

            this.download = function (message, url) {
                Swal.fire({
                    icon: 'info',
                    title: 'Th??ng b??o',
                    allowOutsideClick: false,
                    showCloseButton: true,
                    confirmButtonText: 'Download',
                    text: message,
                    onClose: () => {
                        return false
                    }
                }).then((result) => {
                    if (result.value) {
                        window.location.href = url;
                    }
                });
            };

            this.loading = function (message) {
                Swal.fire({
                    type: 'info',
                    allowOutsideClick: false,
                    text: message,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                });
            };
        };
    };
})(jQuery);

(function ($) {
    "use strict";
    $.ui = {};

    $.ui.common = new function () {
        this.init = function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    $('.scrollup').fadeIn();
                } else {
                    $('.scrollup').fadeOut();
                }
            });

            $('.scrollup').click(function () {
                $("html, body").animate({
                    scrollTop: 0
                }, 600);
                return false;
            });
        }
    };

    $.ui.homepage = new function () {
        this.init = function () {
            //$.ui.common.scrollTo();

            $('#expand_tab').click(function () {
                $('.trending-wrapper').removeClass('show');
                $('.menu-mb').toggleClass('act');
                $(this).closest('li').toggleClass('active');
            })
            $('#topnews_menu').click(function () {
                $('.menu-mb').removeClass('act');
                $('.trending-wrapper').toggleClass('show');
                $('#expand_tab').closest('li').removeClass('active');
            })
            $('.expand-icon').click(function () {
                $(this).toggleClass('visibilityToggle expandToggle');
                $('.kmli-menu-expand-wrapper').toggleClass('visibilityToggle');
            });
        };
    };

    // Menu
    $.ui.menu = new function () {
        this.init = function () {
            var navContainer = $('.mainMenu__navCont'),
                navToggle = $('.nav-toggle'),
                overlay =$("<div class='overlay'></div> ");
            navToggle.on('click', function(e) {
                overlay.toggle();
                var $this = $(this);
                e.preventDefault();
                $this.toggleClass('is-active');
                navContainer.slideToggle(250);
            });
            $( "body" ).prepend(overlay);
            overlay.click(function(){
                navToggle.trigger('click');
                // $(this).toggle();
            })
        }
    }
    // search
    $.ui.search = new function () {
        this.init = function () {
            var overlay2 =$("<div class='overlay'></div> ");
            $('.btn_search').click(function (e) {
                overlay2.toggle();
                e.preventDefault();
                $(this).parents('.search_drop').find('.form_search').toggleClass('open')
            })
            $(document).click(function (event) {
                // Check if clicked outside target
                if (!($(event.target).closest(".search_drop").length)) {
                    // Hide target
                    $(".form_search").removeClass('open');

                }
            });
        };
    }


    // Video
    $.ui.video = new function () {
        this.init = function () {
            $(window).scroll(function() {
                var myVideo = document.getElementById("video");
                var top_of_element = $("#video").offset().top;
                var bottom_of_element = $("#video").offset().top + $("#video").outerHeight();
                var bottom_of_screen = $(window).scrollTop() + $(window).height();
                var top_of_screen = $(window).scrollTop();
                if((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element)){
                    // The element is visible, trigger play click event
                    myVideo.play();
                    $( ".overlay-video" ).css("visibility","hidden");
                }
                else {
                    // The element is not visible, trigger pause click event
                    myVideo.pause();
                    $( ".overlay-video" ).css("visibility","visible");
                }
            });

            // fake pause video
            var vi = document.getElementById("video");
            $( ".overlay-video" ).css("visibility","visible");
            vi.pause();
            var check = false;
            var status_sound = vi ? vi.muted : 0;
            console.log(status_sound);
            $( ".control-video" ).click(function() {
                if(check){
                    vi.pause();
                    $( ".overlay-video" ).css("visibility","visible");
                    check = false;
                }else{
                    vi.play();
                    $( ".overlay-video" ).css("visibility","hidden");
                    check = true;
                }
            });
            $( ".sound" ).click(function() {
                if(status_sound){
                    vi.muted = false;
                    status_sound = false;
                    $( ".sound" ).removeClass('muted');
                }else{
                    vi.muted = true;
                    status_sound = true;
                    $( ".sound" ).addClass('muted');
                }
            });
        }
    }

    $.modalClose = new function() {
        this.init = function () {
            $('.jquery-modal.blocker.current').off();
        };
    };
    $.ui.matchHeight = new function() {
        this.init = function() {
            $('.quiz-title').matchHeight();
        }
    };
    $.ui.popup = new function(){
        this.init = function(){
            $('.buy-cta a, .show-popup-store a, .store-list a').click(function(e){
                e.preventDefault();
                $("#popupproduct").modal({
                    fadeDuration: 300
                });
            })
            // $('.banner-top a, .popup-notify').click(function(e){
            //     e.preventDefault();
            //     $("#notify").modal({
            //         fadeDuration: 300
            //     });
            // })
        }
    }

    $(window).resize(function () {
    });

    // On ready
    $(document).ready(function () {

        $('.user-support').click(function(event) {
            $('.social-button-content').slideToggle();
        });

        $('.social-button-content').slideToggle();
    });

    // On ready stage change
    document.onreadystatechange = function(){
        //$.ui.loading.set_ele_readystage();
    }
})(jQuery);
