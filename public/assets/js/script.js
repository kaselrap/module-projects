(function ($) {

    function column(col, offsetModule) {
        return '<div class="col-md-'+  col +' module" data-column="'+ col +'" ' +
            'data-offset-module="'+ offsetModule +'">\n' +
            '<div class="control">\n' +
            '                <a href="#" class="remove-block"><i class="fas fa-trash"></i></a>\n'+
            '                <a href="#" class="edit-module"><i class="fa fa-cog"></i></a>\n' +
            '                <a href="#" class="move-module"><i class="fa fa-bars"></i></a>\n' +
            '            </div>'+
            '                    <div class="none">\n' +
            '                        <a href="#" id="addModule"><i class="fa fa-plus"></i></a>\n' +
            '                    </div>\n' +
            '                </div>';
    }

    $('.column').each(function () {
        $(this).on('click', function () {
            let block = $(document).find('.block:not(.fill)').first();
            let row = parseInt(block.attr('data-row'));
            let col = parseInt($(this).attr('data-column'));
            row += col;
            if ( row <= 12 && !block.hasClass('fill') ) {
                block.attr('data-row', row);
                block.append(column(col, parseInt(block.children().length + 1)));
                if ( row == 12 ) {
                    block.addClass('fill');
                }
            }
        });
    });
    $(document).on('click', '.remove-block', function () {
        let block = $(this).parent().parent().parent();
        let module = $(this).parent().parent();
        let row = parseInt(block.attr('data-row'));
        let col = parseInt(module.attr('data-column'));
        if ( row != 0 ) {
            row-=col;
            block.attr('data-row', row);
            if( block.hasClass('fill') ) {
                block.removeClass('fill');
            }
        }
        module.remove();
    });

    function addBlock() {
        let project = $('#project');
        project.append('<div class="row block" data-row="0" ' +
            'data-offset-block="' + parseInt($(document).find('.block').length + 1)  + '">\n' +
            '            </div>');
    }
    $('#addSection').on('click', function (e) {
        e.preventDefault();
        addBlock();
        sortableActivate();
    });

    function sortableActivate() {
        $(document).find('.block').each(function () {
            $( this ).sortable({
                revert: true,
                handle: '.move-module',
                update: function (event, ui) {
                    $(this).children().each(function (index) {
                        if ( $(this).attr('data-offset-module') != (index + 1) ) {
                            $(this).attr('data-offset-module', (index + 1));
                        }
                    });
                }
            });
        });
    }
    sortableActivate();

    function addModule() {
        $(document).find('.add-module').each(function () {
            $(this).on('click', function (e) {
                e.preventDefault();
                openModal();
            });
        });
    }

    function openModal() {
        $('body').addClass('modal');
    }
    function closeModal() {
        $(document).on('click', '.overlay, .close-modal', function() {
            $('body').removeClass('modal');
        });
    }
    closeModal();
    addModule();
})(jQuery);

(function ($) {

    var data = {};

    data.project = {

    };



})(jQuery);