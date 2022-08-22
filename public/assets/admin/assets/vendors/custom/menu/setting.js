$(document).ready(function() {
    $('.sortable').nestedSortable({
        forcePlaceholderSize: true,
        items: 'li',
        handle: '.item-handle',
        placeholder: 'menu-highlight',
        listType: 'ul',
        maxLevels: 3,
        cancel: "a,button,.ct-item",
        opacity: .6,
        stop: function( event, ui ) {
            updateTree();
        }
    });

    $('.btn-add-item, .btn-add-select-item').click(function(e) {
        e.preventDefault();

        var id = 'item_' + Math.random();

        if ( $(this).hasClass('btn-add-item') ) {
            var name = $('#name-li').val();
            var link = $('#link-li').val();
        }else{
            var $select = $(this).closest('.row-base').find('select');
            var $val = $select.val();

            var name = $('option[value='+$val+']', $select).data('title');
            var link = $('option[value='+$val+']', $select).data('link');
        }

        if (!name) return;

        var elm = '<li id="' + id + '">' +
            '<div class="item-handle">' +
                '<span class="item-title">' + name + '</span>' +
                '<div class="item-control">' +
                    '<span class="item-type">Trang</span>' +
                    '<button type="button" name="" id="" class="btn item-edit"><span></span></button>' +
                '</div>' +
            '</div>' +
            '<div class="ct-item">' +
                '<div action="#">' +
                    '<div class="form-group mb-2">' +
                        '<p class="mb-2">Nhãn điều hướng</p>' +
                        '<input type="text" name="label['+id+']" value="'+name+'" class="form-control" placeholder="Title..." >' +
                    '</div>' +
                    '<div class="form-group mb-2">' +
                        '<p class="mb-2">Link</p>' +
                        '<input type="text" name="link['+id+']" value="'+link+'" class="form-control" placeholder="Link..." >' +
                    '</div>' +
                    '<div class="cl-group">' +
                        '<a class="red act-delete" href="#">Xóa</a>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '</li>';
        $('.menu-list').append(elm);

        bindItemActions();
        updateTree();
    });

    function bindItemActions() {
        $('.item-edit').unbind('click').bind('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('active');
            $(this).parent().parent().next().slideToggle("fast");
        });

        $('.act-delete').unbind('click').bind('click', function(e) {
            e.preventDefault();
            let conf = confirm('Bạn có muốn xóa menu này?');
            if (conf) {
                $(this).closest('li').remove();
            }
        });
    }

    function updateTree(){
        $('textarea[name=tree]').val($(".sortable").nestedSortable("serialize"));
        console.log($(".sortable").nestedSortable("serialize"));
    }

    bindItemActions();
    updateTree();

    /*$('.btn-submit').click(function() {
        var sortedIDs = $(".sortable").sortable("serialize");
        console.log(sortedIDs);
        updateTree();
    });*/

    // init select
    $('.select-custom').select2();
});