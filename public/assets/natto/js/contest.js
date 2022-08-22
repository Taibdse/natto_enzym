
(function($, app) {

    var ContestCls = function() {

        var vars = {};
        var ele = {};

        this.run = function() {
            this.init();
            this.bindEvents();
        };

        this.init = function() {
            vars.id = 0;
            vars.results = 0;
            vars.stickers = {};
            vars.currentSticker = null;
            vars.cropper = null;
            ele.slideKol = '.swiper-contest';
        };

        this.bindEvents = function() {

            initTab();
            initSliderTemp();
            // initSlideKol();
            initTip();
            eventHandle();
            submitFormInfo();

        };

        this.resize = function() {

        };

        var submitFormInfo = function () {
            $('.js-btn-submit').click(function () {
                var data = $(this).closest('form').serializeArray();
                stage.fire('click');
                stage.fire('touchend');

                var _cb = function (res) {
                    if(res.code){
                        $('#successModal').modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false
                        });
                    }
                };

                $.app.ajax(this, 'contest', data, _cb, 'POST', '.alert-submit');
            });
        };

        var initSlideKol = function() {
            if (window.innerWidth < 991) {
                var swiper = new Swiper(ele.slideKol, {
                    spaceBetween: 10,
                    slidesPerView: 1,
                    loop: false,
                    navigation: {
                        nextEl: '.kol-next',
                        prevEl: '.kol-prev',
                    },
                });
            }

        };

        var initTip = function() {
            $('.btn-tip').click(function(){
                $('.contest_tip').show();
                $('html, body').animate({
                    scrollTop: $(".contest_tip").offset().top
                },100);
            })

        };

        var initTab = function() {

            $('.swiper-kol .swiper-slide').click(function(){
                var tab_id = $(this).attr('data-tab');
                $('.swiper-kol .swiper-slide').removeClass('current');
                $('.tab_template').removeClass('current');
                $(this).addClass('current');
                $("#"+tab_id).addClass('current');
            })

            if (window.innerWidth > 992) {
                $('.swiper-kol .swiper-slide').click(function(){
                    $('.contest_content').addClass('show');
                    $('html, body').animate({
                        scrollTop: $("#contest_edit").offset().top
                    },100);
                })
            }
            if (window.innerWidth < 991) {
                $('.swiper-kol .swiper-slide').click(function(){
                    var kolSelected = $(this).attr('data-tab');
                    window.location.href =  $.app.vars.url + 'pages/contest_mobile?kol=' + kolSelected;
                });
            }
            $('.poster-sticker').click(function(){
                let htmlSt = "";
                for (let i = 1; i < 58; i++) {
                    htmlSt += "<div class='item'>"
                        +"<div class='element'><img  src='"+ $.app.vars.url + 'assets/oppo/images/sticker/sticker' + [i] + '.png' +"' ></div>"
                        +"</div>"
                }
                document.getElementById('list_stick').innerHTML = htmlSt;
                $('.slider-element').slick('refresh');
            })
            let htmlLi = "";
            for (let i = 1; i < 101; i++) {
                htmlLi += "<li><img src=\""+ $.app.vars.url + 'assets/oppo/images/gallery/image' + [i] + '.jpg' +"\" alt=''></li>";
            }
            document.getElementById('addPhoto').innerHTML = htmlLi;


        };

        var initSliderTemp = function() {

            $('.slider-temp').slick({
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                vertical: true,
                infinite:true,
                centerMode: true,
                focusOnSelect: true,
                centerPadding: '130px',
                verticalSwiping: true,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            vertical: false,
                            verticalSwiping: false,
                            centerPadding: '100px',
                        }
                    }


                ]
            });
            $('.slider-temp .item').click(function(e) {
                e.preventDefault();
                var currentIndex = $(this).attr('data-slick-index');
                console.log(currentIndex);
                $('.slider-temp').slick('slickGoTo', currentIndex, true);
            });

            $('.slider-photo').slick({
                slidesToShow: 3,
                arrows: true,
                dots: false,
                vertical: true,
                infinite:false,
                verticalSwiping: true,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            vertical: false,
                            verticalSwiping: false,
                            slidesToShow: 1,
                        }
                    }


                ]
            });

            $('.slider-element').slick({
                slidesToShow: 5,
                slidesToScroll: 5,
                arrows: true,
                dots: false,
                vertical: true,
                verticalSwiping: true,
                infinite:false,
                loop: false,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            vertical: false,
                            verticalSwiping: false,
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    }


                ]
            });
            if($(window).width() > 991){
                $('.slider-element').on('wheel', (function(e) {
                    e.preventDefault();
                    if (e.originalEvent.deltaY < 0) {
                        $(this).slick('slickPrev');
                    } else {
                        $(this).slick('slickNext');
                    }
                }));
            }
        };

        ///////////// Konva area /////////////////
        function loadImages(sources, callback) {
            var assetDir = '';
            var images = {};
            var loadedImages = 0;
            var numImages = 0;
            for (var src in sources) {
                numImages++;
            }
            for (var src in sources) {
                images[src] = new Image();
                images[src].onload = function () {
                    if (++loadedImages >= numImages) {
                        callback(images);
                    }
                };
                images[src].src = assetDir + sources[src];
            }
        }

        function drawBackground(background, beachImg) {
            //background.clear();
            //var context = background.getContext();
            //context.drawImage(beachImg, 0, 0, containerWidth, containerWidth);
            //background.add(beachImg);
            //background.draw();

            var back = new Konva.Image({
                image: beachImg
            });
            background.add(back);
            background.draw();
        }

        function drawBgColor(color) {
            background.clear();
            var rect = new Konva.Rect({
                x: 0,
                y: 0,
                width: containerWidth,
                height: containerHeight,
                fill: color,
            });
            background.add(rect);
            background.draw();
        }

        function initStage(containerWidth,  containerHeight) {

            stage.width(containerWidth);
            stage.height(containerHeight);

            stage.add(background);
            stage.add(stickerLayer);
            stage.add(imageLayer);
            stage.add(textLayer);

        }

        function addSticker(imageObject,
                            xPos,
                            yPos,
                            width,
                            height,
                            draggable = true,
                            changeAble = true,
                            selected = false,
                            roundImage = false,
                            isBlackWhite = false)
        {
            var x = xPos/widthOrigin*containerWidth;
            var y = yPos/heightOrigin*containerHeight;
            var widthRatio = width/widthOrigin*containerWidth;
            var heightRatio = height/heightOrigin*containerHeight;

            var stickerId = (Math.floor(Math.random() * 999e5));
            var sticker = new Konva.Image({
                image: imageObject,
                x: x,
                y: y,
                width: widthRatio,
                height: heightRatio,
                draggable: draggable,
                id: 'sticker_' + stickerId,
            });

            vars.stickers[stickerId] = sticker;
            vars.stickers[stickerId].roundImage = roundImage;

            var tr = new Konva.Transformer({
                node: sticker,
                keepRatio: true,
            });

            stickerLayer.add(tr);
            tr.hide();

            var imageObjectDelete = new Image();
            imageObjectDelete.src = iconList.delete;
            var deleteButton = new Konva.Image({
                image: imageObjectDelete,
                width: 20,
                height: 20,
            });
            tr.add(deleteButton);

            if (changeAble) {
                var imageObjectEdit = new Image();
                imageObjectEdit.src = iconList.edit;
                var editButton = new Konva.Image({
                    image: imageObjectEdit,
                    width: 20,
                    height: 20,
                    id: 'edit_' + stickerId
                });
                tr.add(editButton);
                var editPos = editButton.position().x;
            }

            var deletePos = deleteButton.position().x;

            function updatePos() {
                if ((tr.position().x <= 0 || tr.position().y <= 0) && (tr.position().x + tr.width() >= stage.width())) {
                    deleteButton.position({x: deletePos - 25, y: deletePos + tr.height() - 25});
                }
                else if (tr.position().x <= 0 && ( tr.position().y + tr.height() >= stage.height() )) {
                    deleteButton.position({x: deletePos + tr.width() + 5, y: 5});
                }
                else if (tr.position().x <= 0 || tr.position().y <= 0) {
                    deleteButton.position({x: deletePos + tr.width() + 5, y: deletePos + tr.height() - 25});
                }
                else if ((tr.position().x + tr.width() >= stage.width() && (tr.position().y + tr.height() >= stage.height()))) {
                    deleteButton.position({x: deletePos - 25, y: deletePos + 5});
                }
                else if (tr.position().x + tr.width() >= stage.width()) {
                    deleteButton.position({x: deletePos - 25, y: deletePos + tr.height() - 25});
                }
                else {
                    deleteButton.position({x: deletePos + tr.width() - 25, y: -30});
                }

                if (changeAble) {
                    if ((tr.position().x <= 30 || tr.position().y <= 30) && (tr.position().x + tr.width() >= stage.width() - 30)) {
                        editButton.position({x: editPos - 25, y: editPos + tr.height() - 25});
                    }
                    else if (tr.position().x <= 30 && ( tr.position().y + tr.height() >= stage.height() )) {
                        editButton.position({x: editPos + tr.width() + 5, y: 5});
                    }
                    else if (tr.position().x <= 30 || tr.position().y <= 30) {
                        editButton.position({x: editPos + tr.width() + 5, y: editPos + tr.height() - 25});
                    }
                    else if ((tr.position().x + tr.width() >= stage.width() - 30 && (tr.position().y + tr.height() >= stage.height()))) {
                        editButton.position({x: editPos - 25, y: editPos + 5});
                    }
                    else if (tr.position().x + tr.width() >= stage.width() - 30) {
                        editButton.position({x: editPos - 25, y: editPos + tr.height() - 25});
                    }
                    else {
                        editButton.position({x: editPos + tr.width() - 25, y: -30});
                    }
                }
            }
            updatePos();
            sticker.on('transform', updatePos);

            stickerLayer.draw();

            deleteButton.on('click touchend', () => {
                let option = confirm('Bạn chắc chắn muốn xóa thành phần này?');
                if (option) {
                    tr.destroy();
                    sticker.destroy();
                    stickerLayer.draw();
                }
            });
            deleteButton.on('mouseover', function () {
                document.body.style.cursor = 'pointer';
            });
            deleteButton.on('mouseout', function () {
                document.body.style.cursor = 'default';
            });

            if (changeAble) {
                editButton.on('mouseover', function () {
                    document.body.style.cursor = 'pointer';
                });
                editButton.on('mouseout', function () {
                    document.body.style.cursor = 'default';
                });

                editButton.on('click touchend', function () {

                    $('.upload_pr .alert-success').css('display', 'none');
                    var editId = editButton.id().replace('edit_', '');
                    vars.currentSticker = vars.stickers[editId];

                    //$.app.upload.uploadImage(null, cbEditSticker);
                    $('#photoModal').show().modal();


                    $('.js-list-photo li').unbind('click').on('click tap', function () {
                        var src = $(this).find('img').attr('src');

                        // Init crop modal
                        $.modal.close();

                        initCropModal(src);
                    });

                    // Upload image
                    $('#photoModal .btn-upload').unbind('click').on('click tap', function () {
                        var _cb = function(res){
                            if(res.code) {
                                initCropModal(res.data.resize_link);
                            }
                        };

                        $.app.upload.uploadImage('.upload_pr', _cb);
                    });

                    function initCropModal(imageSrc) {
                        $('#cropModal').show().modal();
                        if (vars.cropper){
                            vars.cropper.destroy();
                        }
                        setTimeout(function () {
                            var ratio = vars.currentSticker.width() / vars.currentSticker.height();
                            if (vars.currentSticker.roundImage) {
                                ratio = 1;
                            }

                            $('#cropModal .crop-area').css({
                                width: $('#cropModal').width() - 30,
                                height: ($('#cropModal').width() - 30) / ratio ,
                            });

                            vars.cropper = new Croppie($('#cropModal .crop-area').get()[0], {
                                boundary: {
                                    width: $('#cropModal .crop-area').width(),
                                    height: $('#cropModal .crop-area').height()
                                },
                                viewport: {
                                    width: $('#cropModal .crop-area').width() - 50 ,
                                    height: $('#cropModal .crop-area').height() - 50 / ratio,
                                    type: vars.currentSticker.roundImage ? 'circle' : 'square'
                                },
                                showZoomer:true,
                            });

                            vars.cropper.bind({
                                url: imageSrc,
                            });
                        }, 1000);
                    }

                    // Insert cropped image to sticker
                    $('#cropModal .btn-insert-crop').unbind('click').on('click tap', function () {
                        vars.cropper.result({
                            type: 'base64',
                            size: 'viewport',
                            format: 'png',
                            quality: 1,
                            circle: vars.currentSticker.roundImage,
                        }).then(function(data) {
                            var image = new Image();
                            image.src = data;

                            image.onload = function () {
                                vars.currentSticker.image(image);

                                if (isBlackWhite) {
                                    vars.currentSticker.clearCache();
                                    vars.currentSticker.cache();
                                    vars.currentSticker.filters([Konva.Filters.Grayscale]);
                                }

                                vars.currentSticker.getLayer().draw();
                            };

                            $.modal.close();
                        });
                    });
                });

                deleteButton.hide();
            }

            if (! changeAble && ! draggable) {
                deleteButton.hide();
            }

            sticker.on('dragstart', function () {
                //this.moveToTop();
                stickerLayer.draw();
            });
            /*
             * check if sticker is in the right spot and
             * snap into place if it is
             */
            sticker.on('dragmove', function () {
                updatePos();
            });

            // make sticker glow on mouseover
            sticker.on('mouseover', function () {
                stickerLayer.draw();
                document.body.style.cursor = 'pointer';
            });

            // return sticker on mouseout
            sticker.on('mouseout', function () {
                stickerLayer.draw();
                document.body.style.cursor = 'default';
            });

            sticker.on('dragmove', function () {
                document.body.style.cursor = 'pointer';
            });

            sticker.on('click touchend', function (e) {
                updatePos();
                //this.moveToTop();

                if (! changeAble && ! draggable) {
                    tr.hide();
                }
                else {
                    tr.show();
                    tr.moveToTop();
                }

                if (changeAble) {
                    tr.resizeEnabled(false);
                    tr.rotateEnabled(false);
                    stickerLayer.draw();
                }

                stickerLayer.draw();
            });

            stage.on('click touchend', function (e) {
                if (e.target._id !== sticker._id) {
                    tr.hide();
                    stickerLayer.draw();
                }
            });

            if (selected) {
                stage.fire('click');
                stage.fire('touchend');
                sticker.fire('click');
                sticker.fire('touchend');
            }

            stickerLayer.add(sticker);
            stickerLayer.draw();
        }

        function addText(text, xPos, yPos,
                         fontSize = 20,
                         fontFamily = '',
                         color,
                         fontStyle = 'normal',
                         lineHeight = 1,
                         widthBox = 200,
                         rotation = 0,
                         draggable = false,
                         selected= false) {
            var textNode = new Konva.Text({
                text: text,
                x: xPos/widthOrigin*containerWidth,
                y: yPos/heightOrigin*containerHeight,
                fontSize: fontSize/widthOrigin*containerWidth,
                fontStyle: fontStyle,
                draggable: draggable,
                width: widthBox,
                fontFamily: fontFamily,
                lineHeight: lineHeight,
                fill: color,
                id: 'text_' + (Math.floor(Math.random() * 999e5)),
                rotation: rotation,
            });
            textLayer.add(textNode);

            if (fontFamily) {
                textNode.fontFamily(fontFamily);
                textLayer.draw();
            }

            if (color) {
                textNode.fill(color);
                textLayer.draw();
            }

            if (rotation) {
                textNode.rotation(rotation);
                textLayer.draw();
            }

            var tr = new Konva.Transformer({
                node: textNode,
                keepRatio: true,
                enabledAnchors: ['middle-left', 'middle-right'],
                // set minimum width of text
                boundBoxFunc: function (oldBox, newBox) {
                    newBox.width = Math.max(30, newBox.width);
                    return newBox;
                },
            });

            var imageObjectDelete = new Image();
            imageObjectDelete.src = iconList.delete;
            var deleteButton = new Konva.Image({
                image: imageObjectDelete,
                width: 20,
                height: 20,
            });
            tr.add(deleteButton);

            function updatePos() {
                if (tr.position().x + tr.width() >= stage.width()) {
                    deleteButton.position({x: tr.findOne('.middle-left').position().x - 30, y: tr.findOne('.middle-left').position().y - 15});
                }
                else {
                    deleteButton.position({x: tr.findOne('.middle-right').position().x + 10, y: tr.findOne('.middle-right').position().y - 15});
                }
            }
            updatePos();

            textNode.on('transform', function () {
                // reset scale, so only with is changing by transformer
                textNode.setAttrs({
                    width: textNode.width() * textNode.scaleX(),
                    scaleX: 1,
                });

                updatePos();
            });

            deleteButton.on('mouseover', function () {
                document.body.style.cursor = 'pointer';
            });

            deleteButton.on('mouseout', function () {
                document.body.style.cursor = 'default';
            });

            deleteButton.on('click tap', () => {
                tr.destroy();
                textNode.destroy();
                textLayer.draw();
            });

            textNode.on('click tap', function () {

                $('input[name=poster-textNode]').val(this.id());

                // Get current fontfamily
                var firstFontFamily = this.fontFamily();
                $('#input-font').val(firstFontFamily);

                // Get current color
                var firstFontColor = this.fill();
                $('#favcolor').val(firstFontColor);

                // Get current fontsize
                var firstFontSize = this.fontSize();
                firstFontSize = parseInt(firstFontSize);
                var checked = $('#input-fontsize option[value='+firstFontSize+']').length;
                if (checked) {
                    $('#input-fontsize').val(firstFontSize);
                }else {
                    $('#input-fontsize').append('<option value="'+firstFontSize+'">'+firstFontSize+'</option>');
                    $('#input-fontsize').val(firstFontSize);
                }

                $('.js-tab-element li a').removeClass('active');
                $('.js-tab-element li a[href="#text"]').addClass('active');
                $('.js-tab-content .tab-pane').removeClass('show active');
                $('.js-tab-content #text').addClass('show active');

                textLayer.add(tr);
                tr.show();
                textLayer.draw();
            });

            textNode.on('dragmove', function () {
                updatePos();
            });

            stage.on('click tap', function (e) {
                if (e.target._id !== textNode._id) {
                    tr.hide();
                    textLayer.draw();
                }
            });

            textNode.on('click tap', function () {
                $('.poster-action').find('.poster-delete').attr('data-id', this.id());
                $('.poster-action').find('.poster-edit').attr('data-id', this.id());
                $('.poster-action').show();
            });

            if (selected) {
                stage.fire('click');
                textNode.fire('click');
            }

            textLayer.draw();

            textNode.on('dblclick dbltap', () => {
                // hide text node and transformer:
                textNode.hide();
                tr.hide();
                textLayer.draw();

                // create textarea over canvas with absolute position
                // first we need to find position for textarea
                // how to find it?

                // at first lets find position of text node relative to the stage:
                var textPosition = textNode.absolutePosition();

                // then lets find position of stage container on the page:
                var stageBox = stage.container().getBoundingClientRect();

                // so position of textarea will be the sum of positions above:
                var areaPosition = {
                    x: textPosition.x,
                    y: textPosition.y,
                };

                // create textarea and style it
                var textarea = document.createElement('textarea');
                var $container = $('#container');
                $container.append(textarea);

                // var textarea = document.createElement('textarea');
                // var container = document.getElementById('container').childNodes[0];
                // container.appendChild(textarea);

                // apply many styles to match text on canvas as close as possible
                // remember that text rendering on canvas and on the textarea can be different
                // and sometimes it is hard to make it 100% the same. But we will try...
                textarea.value = textNode.text();
                textarea.style.position = 'absolute';
                textarea.style.top = areaPosition.y + parseFloat($container.css('paddingTop')) + 'px';
                textarea.style.left = areaPosition.x + parseFloat($container.css('paddingLeft')) + 'px';
                textarea.style.width = textNode.width() - textNode.padding() * 2 + 'px';
                textarea.style.height = textNode.height() - textNode.padding() * 2 + 5 + 'px';
                textarea.style.fontSize = textNode.fontSize() + 'px';
                textarea.style.border = 'none';
                textarea.style.padding = '0px';
                textarea.style.margin = '0px';
                textarea.style.overflow = 'hidden';
                textarea.style.background = 'none';
                textarea.style.outline = 'none';
                textarea.style.resize = 'none';
                textarea.style.lineHeight = textNode.lineHeight();
                textarea.style.fontFamily = textNode.fontFamily();
                textarea.style.transformOrigin = 'left top';
                textarea.style.textAlign = textNode.align();
                textarea.style.color = textNode.fill();
                rotation = textNode.rotation();
                var transform = '';
                if (rotation) {
                    transform += 'rotateZ(' + rotation + 'deg)';
                }

                var px = 0;
                // also we need to slightly move textarea on firefox
                // because it jumps a bit
                var isFirefox =
                    navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
                if (isFirefox) {
                    px += 2 + Math.round(textNode.fontSize() / 20);
                }
                transform += 'translateY(-' + px + 'px)';

                textarea.style.transform = transform;

                // reset height
                textarea.style.height = 'auto';
                // after browsers resized it we can set actual value
                textarea.style.height = textarea.scrollHeight + 3 + 'px';

                textarea.focus();

                function removeTextarea() {
                    textarea.parentNode.removeChild(textarea);
                    window.removeEventListener('click', handleOutsideClick);
                    textNode.show();
                    tr.show();
                    tr.forceUpdate();
                    textLayer.draw();
                }

                function setTextareaWidth(newWidth) {
                    if (!newWidth) {
                        // set width for placeholder
                        newWidth = textNode.placeholder.length * textNode.fontSize();
                    }
                    // some extra fixes on different browsers
                    var isSafari = /^((?!chrome|android).)*safari/i.test(
                        navigator.userAgent
                    );
                    var isFirefox =
                        navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
                    if (isSafari || isFirefox) {
                        newWidth = Math.ceil(newWidth);
                    }

                    var isEdge =
                        document.documentMode || /Edge/.test(navigator.userAgent);
                    if (isEdge) {
                        newWidth += 1;
                    }
                    textarea.style.width = newWidth + 'px';
                }

                textarea.addEventListener('keydown', function (e) {
                    // hide on enter
                    // but don't hide on shift + enter
                    if (e.keyCode === 13 && !e.shiftKey) {
                        textNode.text(textarea.value);
                        removeTextarea();
                    }
                    // on esc do not set value back to node
                    if (e.keyCode === 27) {
                        removeTextarea();
                    }
                });



                textarea.addEventListener('keydown', function (e) {
                    scale = textNode.getAbsoluteScale().x;
                    setTextareaWidth(textNode.width() * scale);
                    textarea.style.height = 'auto';
                    textarea.style.height = textarea.scrollHeight + textNode.fontSize() + 'px';
                });

                function handleOutsideClick(e) {
                    if (e.target !== textarea) {
                        textNode.text(textarea.value);
                        removeTextarea();
                    }
                }
                setTimeout(() => {
                    window.addEventListener('click', handleOutsideClick);
                });
            });
        }

        function initTemplate(templateName) {
            var template = window[templateName];

            widthOrigin = template.originSize[0];
            heightOrigin = template.originSize[1];

            var image = new Image();
            image.src = template.background;
            image.width = containerWidth;
            image.height = containerHeight;

            image.onload = function () {
                drawBackground(
                    background,
                    image
                );
            };

            // Init sitcker
            vars.templateImages = {};
            var loadedImages = 0;
            var totalImages = 0;
            $.each(template.sticker, function(link, attr){
                totalImages++;
            });
            $.each(template.sticker, function(link, attr){
                var image = new Image();
                image.onload = function () {
                    if (++loadedImages >= totalImages) {
                        addSickerTemplate(template);
                    }
                };
                image.src = link;

                vars.templateImages[link] = image;
            });

            // Init Text
            $.each(template.text, function(idx, textObj){
                addText(textObj.text,
                    textObj.position[0],
                    textObj.position[1],
                    textObj.size,
                    textObj.font,
                    textObj.color,
                    textObj.style,
                    textObj.lineHeight,
                    textObj.box_size,
                    textObj.rotation,
                    textObj.draggable,
                );
            });
        }

        function addSickerTemplate(template) {
            $.each(template.sticker, function(link, attr){
                addSticker(vars.templateImages[link],
                    attr.position[0],
                    attr.position[1],
                    attr.size[0],
                    attr.size[1],
                    attr.draggable,
                    attr.changeable,
                    false,
                    attr.round,
                    template.isBlackWhite,
                );
            });
        }


        function download(file, text) {
            var element = document.createElement('a');
            element.setAttribute('href', text);
            element.setAttribute('download', file);
            document.body.appendChild(element);
            element.click();
            document.body.removeChild(element);
        }

        // Event

        var eventHandle = function () {
            // Init first template mobile
            if (typeof initKOL !== 'undefined' && initKOL) {
                let template = initKOL + '_template_1';
                templateInited = true;
                initStage(containerWidth, containerWidth);
                initTemplate(template);
            }

            // Click on KOL
            $('.js-swiper-slide').click(function () {
                var cate = $(this).attr('data-category');
                var kolName = $(this).attr('data-tab');

                var template = kolName + '_template_1';

                $('#infoForm').find('input[name=category]').val(cate);

                $('.js-tab-element li a').removeClass('active');
                $('.js-tab-element li a[href="#temp"]').addClass('active');
                $('.js-tab-content .tab-pane').removeClass('show active');
                $('.js-tab-content #temp').addClass('show active');

                if (templateInited) {
                    var option = confirm('Bạn có chắc muốn thay đổi Template đang chỉnh sửa');
                    if (option) {
                        //stage.destroy();
                        textLayer.destroyChildren();
                        textLayer.draw();

                        stickerLayer.destroyChildren();
                        stickerLayer.draw();

                        //stage.destroyChildren();
                        initStage(containerWidth, containerWidth);
                        initTemplate(template);
                    }
                    return false;
                }
                //templateInited = true;
                //initStage(containerWidth, containerWidth);
                //initTemplate(template);

            });

            // Click on template
            $('.js-tab-template .blockTem').click(function () {
                var template = $(this).data('template');

                if (templateInited) {
                    var option = confirm('Bạn có chắc thay đổi Template');
                    if (option) {
                        //stage.destroy();
                        textLayer.destroyChildren();
                        textLayer.draw();

                        stickerLayer.destroyChildren();
                        stickerLayer.draw();

                        //stage.destroyChildren();
                        initStage(containerWidth, containerWidth);
                        initTemplate(template);
                    }
                    return false;
                }
                templateInited = true;
                initStage(containerWidth, containerWidth);
                initTemplate(template);
            });

            // Click on tab sticker
            $('.poster-sticker').on('click touchend', function () {

                if (!templateInited) {
                    alert("Bạn cần chọn một Template trước!");
                    return false;
                }
            });

            // Click on item sticker
            $(document).on( 'click tap', '#element .item', function(){
                    var $image = $(this).find('img');
                    let src = $image.attr('src');
                    var realWidth, realHeight;

                    $("<img>").attr("src", $($image).attr("src")).one('load', function(){
                        realWidth = this.width;
                        realHeight = this.height;
                    });

                    // .load(function(){
                    //     var realWidth = this.width;
                    //     var realHeight = this.height;
                    //     alert("Original width=" + realWidth + ", " + "Original height=" + realHeight);
                    // });

                    var image = new Image();
                    image.src = src;

                    image.onload = function () {
                        addSticker(image, 60, 60, realWidth/2, realHeight/2, true, false, true, false, false);
                    };
            } );



            // Click on text
            $('.poster-text').on('click', function () {

                if (!templateInited) {
                    alert("Bạn cần chọn một Template trước!");
                    return false;
                }

                var text = 'Lorem Ipsum';
                addText(text,
                    20,
                    20,
                    70,
                    'Tahoma',
                    '#000',
                    'Normal',
                    1,
                    300,
                    true,
                    true,
                    true,
                );
            });

            // Font Family change
            $('#input-font').change(function () {
                var textNodeId = $('input[name=poster-textNode]').val();
                var textNode = stage.find('#' + textNodeId);
                var cusFontFamily = $(this).val();
                textNode.fontFamily(cusFontFamily);
                textLayer.draw();
            });

            // Font Size change
            $('#input-fontsize').change(function () {
                var textNodeId = $('input[name=poster-textNode]').val();
                var textNode = stage.find('#' + textNodeId);
                var cusFontSize = $(this).val();
                textNode.fontSize(cusFontSize);
                textLayer.draw();
            });

            // Font Color change
            $('#favcolor').change(function () {
                var textNodeId = $('input[name=poster-textNode]').val();
                var textNode = stage.find('#' + textNodeId);
                var cusFontColor = $(this).val();
                textNode.fill(cusFontColor);
                textLayer.draw();
            });

            // Click on delete button template
            $('.js-contest-head .btn-del').on('click touchend', function () {
                if (templateInited) {
                    var option = confirm('Bạn có chắc chắn muốn xóa template hiện tại?');
                    if (option) {
                        //stage.destroy();
                        textLayer.destroyChildren();
                        textLayer.draw();

                        stickerLayer.destroyChildren();
                        stickerLayer.draw();

                        background.destroyChildren();
                        background.draw();
                        templateInited = false;
                        alert('Template đã được xóa thành công!');
                    }
                    return false;
                }
                else {
                    alert('Template của bạn chưa được tạo!');
                    return false;
                }
            });

            // Click on download button
            $('.js-download-button').click(function () {

                if (! templateInited) {
                    alert('Template của bạn chưa được tạo!');
                    return false;
                }

                stage.fire('click');
                stage.fire('touchend');

                var imageSrc = toImage();
                var timeStamp = (new Date()).getTime();
                fileName = 'oppo-reno3-' + timeStamp + '.png';
                download(fileName, imageSrc);
            });

            // $('.js-tab-template .blockTem').click(function () {
            //     $('.slick-active').attr('data-slick-index', $(this).parent().attr('data-slick-index'));
            //     $('.slick-active').attr('aria-hidden', $(this).parent().attr('aria-hidden'));
            //     $('.slick-active').attr('tabindex', $(this).parent().attr('tabindex'));
            //
            //     $('.slider-temp .slick-slide').removeClass('slick-current slick-active slick-center');
            //
            //     $(this).parent().addClass('slick-current slick-active slick-center');
            //     $(this).parent().attr('data-slick-index', 0);
            //     $(this).parent().attr('aria-hidden', false);
            //     $(this).parent().attr('tabindex', 0);
            // });

        };

        //////////// End Konva ///////////////////

        var mapMobileAction = function(desktopAction) {
            if (window.isMobile) {
                switch(desktopAction) {
                    case 'click':
                        // code block
                        return 'touchend';
                        break;
                }
            }

            return desktopAction;
        }
    };


    $(document).ready(function() {
        var contestObj = new ContestCls();
        contestObj.run();

        // On resize
        $(window).resize(function() {
            contestObj.resize();
        });
    });
}(jQuery, $.app));

