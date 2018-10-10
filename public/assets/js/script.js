(function ($) {

    function column(col, offsetModule) {
        return '<div class="col-md-'+  col +' module" data-column="'+ col +'" ' +
            'data-offset-module="'+ offsetModule +'">\n' +
            '<div class="control">\n' +
            '                <a href="#" class="remove-block"><i class="fas fa-trash"></i></a>\n'+
            '                <a href="#" class="move-module"><i class="fa fa-bars"></i></a>\n' +
            '            </div>'+
            '                    <div class="none">\n' +
            '                        <a href="#" class="add-module"><i class="fa fa-plus"></i></a>\n' +
            '                    </div>\n' +
            '                </div>';
    }

    $(document).off('click', '.column').on('click', '.column', function (e) {
        e.preventDefault()
        let block = $(document).find('.block:not(.fill)').first();
        let row = parseInt(block.attr('data-row'));
        let col = parseInt($(this).attr('data-column'));
        row += col;
        if ( row <= 12 && !block.hasClass('fill') ) {
            block.attr('data-row', row);
            block.append(column(col, parseInt(block.children().length)));
            if ( row == 12 ) {
                block.addClass('fill');
            }
        }
        addModule();
    });

    $(document).off('click', '.remove-block').on('click', '.remove-block', function (e) {
        e.preventDefault();
        let block = $(this).parent().parent().parent();
        let module = $(this).parent().parent();
        let row = parseInt(block.attr('data-row'));
        let col = parseInt(module.attr('data-column'));
        if ( row != 0 ) {
            row-=col;
            block.attr('data-row', row);
            module.nextAll().each(function () {
                let offset = $(this).attr('data-offset-module') - 2;
                $(this).attr('data-offset-module', offset);
            });
            if( block.hasClass('fill') ) {
                block.removeClass('fill');
            }
        }
        module.remove();
    });

    function addBlock() {
        let project = $('#project');
        let offsetBlock = parseInt($(document).find('.block').length + 1);
        project.append('<div class="row block" data-row="0" ' +
            'data-offset-block="' + offsetBlock  + '">\n' +
            '<i id="removeSection" class="fas fa-times remove-section"> </i>' +
            '            </div>');
    }
    $(document).off('.click', '#addSection').on('click', '#addSection', function (e) {
        e.preventDefault();
        addBlock();
        sortableActivate();
    });

    $(document).off('.click', '#removeSection').on('click', '#removeSection', function () {
        $(this).parent().nextAll().each(function () {
            let offset = $(this).attr('data-offset-block') - 1;
            $(this).attr('data-offset-block', offset);
        });
        $(this).parent().remove();
    });

    function sortableActivate() {
        $(document).find('.block').each(function () {
            $( this ).sortable({
                revert: true,
                handle: '.move-module',
                update: function (event, ui) {
                    $(this).children().each(function (index) {
                        if ( $(this).attr('data-offset-module') != (index) ) {
                            $(this).attr('data-offset-module', (index));
                        }
                    });
                }
            });
        });
    }
    sortableActivate();

    function addModule() {
        $(document).off('click', '.add-module').on('click', '.add-module', function (e) {
            e.preventDefault();
            $(this).parent().parent().addClass('active-module');
            openModal();
            selectModalMenu();
        });
    }
    function openModal() {
        $('body').addClass('modal');
    }
    function closeModalWindow() {
        $(document).on('click', '.overlay, .close-modal', function() {
            $('body').removeClass('modal');
            defaultModalMenuValues();
        });
        $(document).on('click', '.close-window-images', function() {
            $('body').removeClass('images');
        });
    }
    closeModalWindow();
    function selectModalMenu() {
        if( $('body').hasClass('modal') ) {
            modalMenu($('select.select-module').val());
            $('select.select-module').on('change', function () {
                modalMenu($(this).val());
            });
            $(document).off('click', '.add-module-button').on('click', '.add-module-button', function (e) {
                e.preventDefault();
                insertModule();
                $('.close-modal').click();
            });
        }
    }
    function defaultModalMenuValues() {
        $('select.select-module').val('slider');
        modalMenu('slider');
    }
    selectModalMenu();
    function modalMenu(moduleName) {
        switch (moduleName) {
            case 'slider' :
                insertSlider();
                break;

            case 'video' :
                insertVideo();
                break;

            case 'gallery' :
                insertGallery();
                break;

            case 'article' :
                insertArticle();
                break;

            case 'quiz' :
                insertQuiz();
                break;

            case 'logotype' :
                insertLogotype();
                break;

            case 'html' :
                insertHtmlCode();
                break;

            default:
                insertSlider();
        }
    }

    function insertSlider() {
        $('.modal-module').empty();
        // let images = getListImages([1,2,3,8]);
        $('.modal-module').append('<div class="slider"> ' +
            '                         <a href="#" class="choose-images">Choose Images</a>' +
            '                       <div class="row">' +
            '                         <div class="col-md-8 list-images get-data">' +
            '                             ' +
            '                         </div>' +
            '                         <div class="col-md-4 list-option">\n' +
                                '        <p><span>Number of items:</span><input type="number" name="numberOfItems" value="1" placeholder="Number of items"></p>\n' +
                                '        <p><span>Margin for items</span><input type="number" name="margin" value="0" placeholder="Margin for items"></p>\n' +
                                '        <p><span>Items in center?</span><input type="checkbox" name="center" value="false"></p>\n' +
                                '        <p><span>Auto width item?</span><input type="checkbox" name="autoWidth" value="false"></p>\n' +
                                '        <p><span>Loop slider?</span><input type="checkbox" name="loop" value="true" checked></p>\n' +
                                '        <p><span>Autoplay slider?</span><input type="checkbox" name="autoplay" value="true" checked></p>\n' +
                                '        <p><span>Pause when hover slider?</span><input type="checkbox" name="autoplayHoverPause" value="true" checked></p>\n' +
                                '        <p><span>Speed slider?</span><input type="number" name="sliderSpeed" value="5000"></p>\n' +
                                '        <p><span>Slider speed animation?</span><input type="number" name="sliderSpeedAnimation" value="600"></p>\n' +
                                '        <p><span>Navigation?</span><input type="checkbox" name="navigation" value="false"></p>\n' +
                                '        <p><span>Pagination?</span><input type="checkbox" name="pagination" value="false"></p>\n' +
                                '    </div>' +
        '                           </div>' +
            ' </div>');
        chooseImages('slider');

    }
    function chooseImages(module) {
        $(document).off('click', '.choose-images').on('click', '.choose-images', function (e) {
            e.preventDefault();
            $('body').addClass('images');
            $.ajax({
                url: 'function.php',
                type: "POST",
                data: {functionname: 'getAllImages'},
                success: function(src){

                    let objects = JSON.parse(src);
                    let listImages = $('.window-images').find('.list-images');
                    listImages
                        .empty();
                    $.each(objects, function (key, value) {
                        if ( !value.src_preview ) {
                            listImages
                                .append('' +
                                    ' <div class="image col-md-2" data-id="'+ value.id +'" data-active="false">\n' +
                                    '      <div class="image-inner">\n' +
                                    '           <i class="fas fa-check-circle check"></i>\n' +
                                    '               <img src="' + value.src + '" alt="' + value.alt + '">' +
                                    '      </div>\n' +
                                    '</div>' +
                                    '');
                        } else {
                            listImages
                                .append('' +
                                    ' <div class="image col-md-2" data-id="'+ value.id +'" data-active="false">\n' +
                                    '      <div class="image-inner">\n' +
                                    '           <i class="fas fa-check-circle check"></i>\n' +
                                    '               <img src="' + value.src_preview + '" alt="' + value.alt + '">' +
                                    '      </div>\n' +
                                    '</div>' +
                                    '');
                        }

                    });
                    chooseActiveImages();
                    addImagesToModule($('.modal-module .' + module + ' > .row > .list-images'));
                }
            });

        });
    }
    function chooseImage(click) {
        $(document).off('click', click).on('click', click, function (e) {
            e.preventDefault();
            let self = $(this);
            if ( !$(this).hasClass('fill') ) {
                $(this).addClass('active');
                $('body').addClass('images');
                $.ajax({
                    url: 'function.php',
                    type: "POST",
                    data: {functionname: 'getAllImages'},
                    success: function(src){

                        let objects = JSON.parse(src);
                        let listImages = $('.window-images').find('.list-images');
                        listImages
                            .empty();
                        $.each(objects, function (key, value) {
                            if ( !value.src_preview ) {
                                listImages
                                    .append('' +
                                        ' <div class="image col-md-2" data-id="'+ value.id +'" data-active="false">\n' +
                                        '      <div class="image-inner">\n' +
                                        '           <i class="fas fa-check-circle check"></i>\n' +
                                        '               <img src="' + value.src + '" alt="' + value.alt + '">' +
                                        '      </div>\n' +
                                        '</div>' +
                                        '');
                            } else {
                                listImages
                                    .append('' +
                                        ' <div class="image col-md-2" data-id="'+ value.id +'" data-active="false">\n' +
                                        '      <div class="image-inner">\n' +
                                        '           <i class="fas fa-check-circle check"></i>\n' +
                                        '               <img src="' + value.src_preview + '" alt="' + value.alt + '">' +
                                        '      </div>\n' +
                                        '</div>' +
                                        '');
                            }
                        });
                        chooseActiveImage();
                        if ( self.hasClass('logotype-block') ) {
                            addImageToBlock(self);
                        } else {
                            addImagesToInput(self);
                        }
                    }
                });
            }
        });
    }
    function chooseActiveImages() {
        $(document).find('.select-images .image').each(function () {
            $(this).off('click').on('click', function () {
                ($(this).hasClass('active')) ?
                    $(this).removeClass('active') &&
                    $(this).attr('data-active', false)
                    :
                    $(this).addClass('active') &&
                    $(this).attr('data-active', true)
                ;
            });
        });
    }
    chooseActiveImages();
    function chooseActiveImage() {
        $(document).find('.select-images .image').each(function () {
            $(this).off('click').on('click', function () {
                $('.select-images .image').removeClass('active').attr('data-active','false');
                ($(this).hasClass('active')) ?
                    $(this).removeClass('active') &&
                    $(this).attr('data-active', false)
                    :
                    $(this).addClass('active') &&
                    $(this).attr('data-active', true)
                ;
            });
        });
    }
    function removeActiveImageEventListener() {
        $(document).find('.select-images .image').each(function () {
            $(this).off('click');
        });
    }
    function addImageToBlock(block) {
        $(document).off('click', '.add-images-to-module').on('click', '.add-images-to-module', function (e) {
            e.preventDefault();
            removeActiveImageEventListener();
            let choosenImage = $('.add-images-to-module').next().find('.image.active');
            let json = [];
            json.push(
                {
                    id: choosenImage.attr('data-id'),
                    src: choosenImage.find('img').attr('src'),
                    alt: choosenImage.find('img').attr('alt')
                }
            );
            block.find('.photos').remove();
            block.empty();
            block.append('<img src="'+ choosenImage.find('img').attr('src') +'">');
            block.attr('data-json', JSON.stringify(json));
            block.removeClass('active');
            $('body').removeClass('images');
            $(document).off('click', '.add-images-to-module');
        });
    }
    function addImagesToInput(input) {
        $(document).off('click', '.add-images-to-module').on('click', '.add-images-to-module', function (e) {
            e.preventDefault();
            removeActiveImageEventListener();
            let choosenImage = $('.add-images-to-module').next().find('.image.active');
            let json = [];
            json.push(
                {
                    id: choosenImage.attr('data-id'),
                    src: choosenImage.find('img').attr('src'),
                    alt: choosenImage.find('img').attr('alt')
                }
            );
            if ( !input.hasClass('fill') ) {
                input.val(choosenImage.find('img').attr('src'));

                input.attr('data-json', JSON.stringify(json));
                input.removeClass('active');
                input.addClass('fill');
            }
            $('body').removeClass('images');
            $(document).off('click', '.add-images-to-module');
        });
    }
    function addImagesToModule(module) {
        $(document).off('click', '.add-images-to-module').on('click', '.add-images-to-module', function (e) {
            e.preventDefault();
            let choosenImages = $('.add-images-to-module').next().find('.image[data-active="true"]');
            let json = [];
            if ( typeof module.attr('data-json') !== typeof undefined && module.attr('data-json') !== false ) {
                json = JSON.parse(module.attr('data-json'));
            }
            choosenImages.each(function (index, elem) {
                json.push(
                    {
                        id: index,
                        idImage: $(this).attr('data-id'),
                        src: $(this).find('img').attr('src'),
                        alt: $(this).find('img').attr('alt')
                    }
                );

                module.append('<div class="image" data-id="' + index + '"> ' +
                    '   <i class="remove-image fas fa-times"></i>' +
                    '   <img src="' + $(this).find('img').attr('src') + '" alt="' + $(this).find('img').attr('alt') + '">' +
                    ' </div>');
            });
            removeActiveImageEventListener();
            module.attr('data-json', JSON.stringify(json));
            removeImageFromModule();
            $('body').removeClass('images');
            $(document).off('click', '.add-images-to-module');
        });
    }
    function removeImageFromModule() {
        $(document).on('click', '.modal-module .remove-image', function () {
            let image = $(this).parent(),
                moduleJson = image.parent().attr('data-json'),
                imageId = image.attr('data-id');

            if ( typeof moduleJson !== typeof undefined && moduleJson !== false ) {
                moduleJson = JSON.parse(moduleJson);
                moduleJson.splice(imageId, 1);
                image.parent().attr('data-json', JSON.stringify(moduleJson));
                image.remove();
            }
        });
    }
    function insertVideo() {
        $('.modal-module').empty();
        $('.modal-module').append('<div class="video"> ' +
            '                           <textarea name="videoIframe" placeholder="Type in here your iframe"></textarea>' +
            ' </div>');

    }
    function insertGallery() {
        $('.modal-module').empty();
        $('.modal-module').append('<div class="gallery"> ' +
            '                         <a href="#" class="choose-images">Choose Images</a>' +
            '                       <div class="row">' +
            '                         <div class="col-md-12 list-images get-data">' +
            '                             ' +
            '                         </div>' +
            '                           </div>' +
            ' </div>');
        chooseImages('gallery');
    }
    function insertArticle() {
        $('.modal-module').empty();
        $('.modal-module').append('<div class="article"> ' +
            '<div id="editor">' +
            '        <p></p>' +
            '    </div>' +
            ' </div>');
        initEditor();
    }
    function insertQuiz() {
        $('.modal-module').empty();
        $('.modal-module').append('<div class="quiz"  data-type="text">' +
            '<div class="row">' +
                '<div class="col-md-8">\n' +
            '            <p>Question</p>\n' +
            '            <p class="question">\n' +
            '                <input type="text" name="question">\n' +
            '            </p>\n' +
            '            <div class="answers">\n' +
            '                <p>Poll options</p>\n' +
            '                <div class="answers-list">\n' +
            '                    <p class="answer">\n' +
            '                        <input type="text" name="answer[]">\n' +
            '                        <i class="fas fa-times remove-answer"></i>\n' +
            '                    </p>\n' +
            '                    <p class="answer">\n' +
            '                        <input type="text" name="answer[]">\n' +
            '                        <i class="fas fa-times remove-answer"></i>\n' +
            '                    </p>\n' +
            '                </div>\n' +
            '                <p class="add-an-option">\n' +
            '                    <input type="button" name="add-option" value="Add an option">\n' +
            '                </p>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="switcher col-md-4">\n' +
            '            <div class="switcher-inner">\n' +
            '                <a href="#" class="text-quiz active" data-type="text">Text</a>\n' +
            '                <a href="#" class="image-quiz" data-type="image">Image</a>\n' +
            '            </div>\n' +
            '        </div>' +
            '   </div>' +
            '</div>');
        initQuiz();
    }
    function insertLogotype() {
        $('.modal-module').empty();
        $('.modal-module').append('<div class="logotype"> ' +
            '<div class="logotype-block">\n' +
            '        <i class="fas fa-camera photos"></i>\n' +
            '    </div>' +
            ' </div>');
        chooseImage('.logotype-block');
    }
    function insertHtmlCode() {
        $('.modal-module').empty();
        $('.modal-module').append('<div class="html"> ' +
            '<textarea name="htmlCode" placeholder="Type in here your code"></textarea>' +
            ' </div>');

    }

    function insertModule() {
        let module = $('.modal-module').children();
        let moduleName = module.attr('class');
        let activeModule = $('.active-module');
        let json = {};
        switch (moduleName) {
            case 'slider' :
                json.slider = {};
                json.slider.optionList = {};
                json.slider.listImages = JSON.parse($('.modal-module .slider .list-images').attr('data-json'));
                let sliderOption = module.find('.list-option input');

                sliderOption.each(function () {
                    json.slider.optionList[$(this).attr('name')] = $(this).val();
                });
                json.slider = JSON.stringify(json.slider);
                activeModule
                    .removeClass('active-module')
                    .find('.none')
                    .attr('class','module-block')
                    .attr('data-module', moduleName)
                    .addClass(moduleName)
                    .attr('data-image-src',json.slider)
                    .html(moduleName);
                break;

            case 'video' :
                json.frame = {};

                json.frame.iframe = $('.modal-module textarea[name=videoIframe]').val();
                json.frame = JSON.stringify(json.frame);
                activeModule
                    .removeClass('active-module')
                    .find('.none')
                    .attr('class','module-block')
                    .attr('data-module', moduleName)
                    .addClass(moduleName)
                    .attr('data-iframe',json.frame)
                    .html(moduleName);
                break;

            case 'gallery' :
                json.gallery = {};
                json.gallery.listImages = JSON.parse($('.modal-module .gallery .list-images').attr('data-json'));
                json.gallery = JSON.stringify(json.gallery);
                activeModule
                    .removeClass('active-module')
                    .find('.none')
                    .attr('class','module-block')
                    .attr('data-module', moduleName)
                    .addClass(moduleName)
                    .attr('data-image-src',json.gallery)
                    .html(moduleName);
                break;

            case 'article' :
                json.article = {};
                json.article.html = $('#editor .ql-editor').html();
                json.article = JSON.stringify(json.article);

                activeModule
                    .removeClass('active-module')
                    .find('.none')
                    .attr('class','module-block')
                    .attr('data-module', moduleName)
                    .addClass(moduleName)
                    .attr('data-html',json.article)
                    .html(moduleName);
                break;

            case 'quiz' :
                json.quiz = {};
                json.quiz.answersList = {};
                json.quiz.type = $('.modal-module .quiz').attr('data-type');
                json.quiz.question = $('.modal-module .quiz .question input').val();
                let answers = module.find('.answer input');
                if (json.quiz.type === 'image') {
                    answers.each(function (index) {
                        json.quiz.answersList[index] = $(this).val();
                    });
                } else {
                    answers.each(function (index) {
                        json.quiz.answersList[index] = $(this).val();
                    });
                }

                json.quiz = JSON.stringify(json.quiz);
                activeModule
                    .removeClass('active-module')
                    .find('.none')
                    .attr('class','module-block')
                    .attr('data-module', moduleName)
                    .addClass(moduleName)
                    .attr('data-quiz',json.quiz)
                    .html(moduleName);
                break;

            case 'logotype' :
                json.logotype = {};
                json.logotype = $('.logotype-block').attr('data-json');
                activeModule
                    .removeClass('active-module')
                    .find('.none')
                    .attr('class','module-block')
                    .attr('data-module', moduleName)
                    .addClass(moduleName)
                    .attr('data-logotype',json.logotype)
                    .html(moduleName);
                break;

            case 'html' :
                json.html = {};

                json.html.code = $('.modal-module textarea[name=htmlCode]').val();
                json.html = JSON.stringify(json.html);
                activeModule
                    .removeClass('active-module')
                    .find('.none')
                    .attr('class','module-block')
                    .attr('data-module', moduleName)
                    .addClass(moduleName)
                    .attr('data-html',json.html)
                    .html(moduleName);
                break;

            default:
        }

        defaultModalMenuValues();
    }
    function uploadImages() {
        $('.ajax-uploader-inner').on('click', function() {
            let self = $(this);

            $('.ajax-file').click();
            $('.ajax-file').on('change', function (e) {
                let fd = new FormData();
                let filesLength = $('#ajax-file')[0].files.length;
                for (let i = 0; i < filesLength; i++) {
                    $('.file-list').append('<li class="ajax-image-upload loading file-'+ i +'" data-id="'+ i +'"></li>');
                    fd.append('files[]', $('#ajax-file')[0].files[i]);
                }
                if (!self.hasClass('uploaded')) {
                    $.ajax({
                        url: "upload_images.php",
                        type: "POST",
                        data: fd,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (src) {
                            let json = JSON.parse(src);
                            for (let i = 0; i < filesLength; i++) {
                                $('.window-images').find('.list-images').append('<div class="image col-md-2" data-id="'+ json[i].id +'">\n' +
                                    '                            <div class="image-inner">\n' +
                                    '                                <i class="fas fa-check-circle check"></i>\n' +
                                    '                                <img src="' + json[i].src + '" alt="'+ json[i].alt +'">\n' +
                                    '                            </div>\n' +
                                    '                        </div>');
                                $('.file-list').remove();
                            }

                            $('#ajax-file').val('');
                            $('#ajax-file').off('change');
                            removeActiveImageEventListener();
                            chooseActiveImages();
                        }
                    });
                }
            });
        });
    }
    uploadImages();
    function initEditor() {
        let toolbarOptions = [
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
            [{ 'font': [] }],

            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],

            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction

            ['image'],

            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'align': [] }],

            ['clean']                                         // remove formatting button
        ];
        let quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions
            }
        });
    }
    function initQuiz() {
        quizAddAnOption();
        removeAnOption();
        changeSwitcher();
        chooseImage('.answer input.image');
    }
    function quizAddAnOption() {
        let button = $(document).find('.add-an-option');
        let answersList = $(document).find('.answers-list');
        button.on('click', function () {
            let type = $('.quiz').attr('data-type');
            if(type === 'image') {
                answersList.append('<p class="answer">\n' +
                    '                    <input class="image" type="text" name="answer[]" readonly="readonly">' +
                    '                    <i class="fas fa-times remove-answer"></i>' +
                    '                    <i class="fas fa-camera photos"></i>' +
                    '                </p>');
            } else {
                answersList.append('<p class="answer">\n' +
                    '                    <input type="text" name="answer[]">\n' +
                    '                    <i class="fas fa-times remove-answer"></i>\n' +
                    '                </p>');
            }
            removeAnOption();
        });
    }
    function removeAnOption() {
        let button = document.querySelectorAll('.remove-answer');
        button.forEach(function (element, index) {
            element.addEventListener('click', function () {
                this.parentNode.remove();
            });
        });
    }
    function changeSwitcher() {
        let switcher = $(document).find('.switcher .switcher-inner a');

        switcher.on('click', function (e) {
            switcher.removeClass('active')
            e.preventDefault();
            ($(this).hasClass('active')) ?
                $(this).removeClass('active')
                :
                $(this).addClass('active');
            let type = $(this).attr('data-type');
            let typeOld = $('.quiz').attr('data-type');
            if ( type === 'image' ) {
                $('.quiz')
                    .attr('data-type', type)
                    .find('.answer')
                    .append('<i class="fas fa-camera photos"></i>')
                    .find('input[type='+typeOld+']')
                    .val('')
                    .addClass(type)
                    .attr('readonly', 'readonly');
            } else {
                $('.quiz')
                    .attr('data-type', type)
                    .find('.answer input')
                    .removeClass('image')
                    .removeAttr('readonly')
                    .siblings('.photos')
                    .remove();
            }
        });
    }
    initQuiz();
})(jQuery);

//input is checked
(function ($) {
    $(document).on('change', 'input[type=checkbox]', function () {
        $(this).is(':checked')? $(this).val('true') :  $(this).val('false');
    });
})(jQuery);

//Save to database

(function ($) {
    $(document).off('click', '.save-project').on('click', '.save-project', function () {
        var jsonProject = [];
        jsonProject.push(
            {name: $('.project-name input').val()}
        );
        $(document).find('.project .block').each(function (index) {
            var module          = $(this).children('.module'),
                moduleColumn    = null,
                offsetModule    = null,
                moduleName      = null;
            jsonProject.push(
                {
                    blockId: index,
                    module: []
                }
            );
            $.each(module, function (ind) {
                moduleColumn    = $(this).attr('data-column');
                offsetModule    = $(this).attr('data-offset-module');
                moduleName      = $(this).find('.module-block').attr('data-module');
                var self = $(this);
                switch (moduleName) {
                    case 'slider' :
                        let slider = JSON.parse(self.find('.module-block').attr('data-image-src'));
                        jsonProject[index + 1].module.push(
                            {
                                column: moduleColumn,
                                name: moduleName,
                                offset: offsetModule,
                                optionList: slider.optionList,
                                imageList: slider.listImages
                            }
                        );
                        break;

                    case 'video' :
                        let video = JSON.parse(self.find('.module-block').attr('data-iframe'));
                        jsonProject[index + 1].module.push(
                            {
                                column: moduleColumn,
                                name: moduleName,
                                offset: offsetModule,
                                iframe: video.iframe
                            }
                        );
                        break;

                    case 'gallery' :
                        let gallery = JSON.parse(self.find('.module-block').attr('data-image-src'));
                        jsonProject[index + 1].module.push(
                            {
                                column: moduleColumn,
                                name: moduleName,
                                offset: offsetModule,
                                imageList: gallery.listImages
                            }
                        );
                        break;

                    case 'article' :
                        let article = JSON.parse(self.find('.module-block').attr('data-html'));
                        jsonProject[index + 1].module.push(
                            {
                                column: moduleColumn,
                                name: moduleName,
                                offset: offsetModule,
                                article: article.html
                            }
                        );
                        break;

                    case 'quiz' :
                        let quiz = JSON.parse(self.find('.module-block').attr('data-quiz'));
                        jsonProject[index + 1].module.push(
                            {
                                column: moduleColumn,
                                name: moduleName,
                                offset: offsetModule,
                                question: quiz.question,
                                answers: quiz.answersList,
                                typeQuiz: quiz.type
                            }
                        );
                        break;

                    case 'logotype' :
                        let logotype = JSON.parse(self.find('.module-block').attr('data-logotype'));
                        jsonProject[index + 1].module.push(
                            {
                                column: moduleColumn,
                                name: moduleName,
                                offset: offsetModule,
                                logotype: logotype
                            }
                        );
                        break;

                    case 'html' :
                        let html = JSON.parse(self.find('.module-block').attr('data-html'));
                        jsonProject[index + 1].module.push(
                            {
                                column: moduleColumn,
                                name: moduleName,
                                offset: offsetModule,
                                html: html.code
                            }
                        );
                        break;

                    default:

                }
            });
        });
        $.ajax({
            url: 'saveToDB.php',
            type: "POST",
            data: {
                data: JSON.stringify(jsonProject)
            },
            beforeSend: function( ) {
                $('.overlay').css({'display' : 'block'}).html('<div class="spinner"></div>');
            },
            success: function (data) {
                if ( data === 'success' ) {
                    window.location.href = '/';
                } else {
                    $('.overlay')
                        .html('<div style="' +
                            'position: absolute;' +
                            'top: 50%;' +
                            'left: 50%;' +
                            'transform: translate(-50%, -50%);' +
                            'color: red; ' +
                            'font-size: 27px;' +
                            'text-transform: uppercase;">'+ data +'</div>');
                    setTimeout(function () {
                        $('.overlay').fadeOut(1000);

                    }, 1000);
                }
            }
        });
    });
})(jQuery);
//Init some library for front-end visible cool
(function ($) {
    //Owl carousel
    function init() {
        const gallery = baguetteBox.run('.gallery .gallery-inner');
        const slider = baguetteBox.run('.slider .slider-inner');
        stOwlCarousel('.owl-carousel');
    }
    function stOwlCarousel(className) {
        var sliders = $(className);
        if ( sliders.length ) {
            sliders.each(function () {
                var slider = $(this),
                    sliderItemsNumbers = slider.children().length,
                    numberOfItems = 1,
                    margin = 0,
                    center = false,
                    autoWidth = false,
                    loop = false,
                    autoplay = false,
                    autoplayHoverPause = false,
                    sliderSpeed = 5000,
                    sliderSpeedAnimation = 600,
                    animateInClass = false,
                    animateOutClass = false,
                    navigation = false,
                    pagination = false;

                if (typeof slider.data('number-of-items') !== 'undefined' && slider.data('number-of-items') !== false) {
                    numberOfItems = slider.data('number-of-items');
                }
                if (typeof slider.data('margin') !== 'undefined' && slider.data('margin') !== false) {
                    margin = slider.data('margin');
                }
                if (slider.data('center') === true) {
                    center = true;
                }
                if (slider.data('auto-width') === true) {
                    autoWidth = true;
                }
                if (slider.data('loop') === true) {
                    loop = true;
                }
                if (slider.data('autoplay') === true) {
                    autoplay = true;
                }
                if (slider.data('autoplay-hover-pause') === true) {
                    autoplayHoverPause = true;
                }
                if (typeof slider.data('slider-speed') !== 'undefined' && slider.data('slider-speed') !== false) {
                    sliderSpeed = parseInt(slider.data('slider-speed'));
                }
                if (typeof slider.data('slider-speed-animation') !== 'undefined' && slider.data('slider-speed-animation') !== false) {
                    sliderSpeedAnimation = slider.data('slider-speed-animation');
                }
                if (typeof slider.data('slider-animate-in') !== 'undefined' && slider.data('slider-animate-in') !== false) {
                    animateInClass = slider.data('slider-animate-in');
                }
                if (typeof slider.data('slider-animate-out') !== 'undefined' && slider.data('slider-animate-out') !== false) {
                    animateOutClass = slider.data('slider-animate-out');
                }
                if (slider.data('navigation') === true) {
                    navigation = true;
                }
                if (slider.data('pagination') === true) {
                    pagination = true;
                }
                if (sliderItemsNumbers <= 1) {
                    loop       = false;
                    autoplay   = false;
                    navigation = false;
                    pagination = false;
                }
                var responsiveNumberOfItems1 = 1,
                    responsiveNumberOfItems2 = 2,
                    responsiveNumberOfItems3 = 3;
                if (numberOfItems < 3) {
                    responsiveNumberOfItems2 = numberOfItems;
                    responsiveNumberOfItems3 = numberOfItems;
                }
                slider.owlCarousel({
                    items: numberOfItems,
                    loop: loop,
                    autoplay: autoplay,
                    autoplayHoverPause: autoplayHoverPause,
                    autoplayTimeout: sliderSpeed,
                    smartSpeed: sliderSpeedAnimation,
                    margin: margin,
                    center: center,
                    autoWidth: autoWidth,
                    animateInClass : animateInClass,
                    animateOut : animateOutClass,
                    dots: pagination,
                    nav: navigation,
                    navText: ['<span class="fas fa-angle-left"></span>','<span class="fas fa-angle-right"></span>'],
                    responsive: {
                        0: {
                            items: responsiveNumberOfItems1,
                            margin: 0,
                            center: false,
                            autoWidth: false
                        },
                        680: {
                            items: responsiveNumberOfItems2
                        },
                        768: {
                            items: responsiveNumberOfItems3
                        },
                        1024: {
                            items: numberOfItems
                        }
                    }
                });
            });
        }
    }
    init();
})(jQuery);
//Quiz script
(function ($) {
    $(document).off('click', '.quiz .answer a').on('click', '.quiz-box:not(.answered) .answer a', function (e) {
        e.preventDefault();
        let countVoted = parseInt($(this).parent().attr('data-number-vote')),
            vote = 0,
            answerId = $(this).parent().attr('data-answer-id');
        countVoted += 1
        $(this).parent().attr('data-number-vote', countVoted);
        $(this).parents('.quiz').addClass('answered');
        let sumVoted = 0;
        $(this).parent().parent().children().each(function () {
            sumVoted += Number($(this).attr('data-number-vote'));
        });
        $(this).parent().parent().children().each(function () {
            vote = Number($(this).attr('data-number-vote'));
            $(this).find('.percent').text(Math.round(vote*100/sumVoted) + '%');
        });
        $(this).parent().addClass('active');
        $.ajax({
            url: 'function.php',
            type: "POST",
            data: {
                functionname: 'quizAnswered',
                id:answerId,
                vote: countVoted
            },
            success: function(data) {
            }

        });
    });
})(jQuery);

//Remove project
(function ($) {
    $(document).off('click', '.remove-project').on('click', '.remove-project', function (e) {
        e.preventDefault();
        let projectId = $(this).attr('data-id-project');
        // $(this).parents('.project').remove();
        $.ajax({
            url: 'function.php',
            type: "POST",
            data: {
                functionname: 'deleteProject',
                id:projectId
            },
            success: function(data) {
                console.log(data);
            }

        });
    });
})(jQuery);