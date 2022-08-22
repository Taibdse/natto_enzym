(function ($, app) {

    var CommentCls = function () {
        // Class variables
        var vars = {};

        // Class elements
        var ele = {};

        this.run = function () {
            this.init();
            this.bindEvents();
        };

        this.init = function () {

        };

        this.bindEvents = function () {
            replyComment();
        };

        this.resize = function () {

        };

        var replyComment = function () {
            $(document).on('click', '.reply-comment', function (e) {

                var data = {};
                data.parent_id = $(this).attr('data-parent-id');
                data.current_id = $(this).attr('data-id');
                data.module = $(this).attr('data-module');
                data.module_item_id = $(this).attr('data-module_item_id');
                data.status = 4;

                var config = {
                    title: 'Mời nhập nội dung trả lời',
                    //text: "You won't be able to revert this!",
                    type: 'warning',
                    input: 'textarea',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Send'
                };

                Swal.fire(config).then((result) => {
                    if (result.value) {

                        data.content = result.value;

                        var _cb = function (res) {
                            if (res.code) {
                                Swal.fire('Good job!',
                                    'Trả lời thành công!',
                                    'success');

                                reloadDataTable();

                            }
                            else {
                                Swal.fire('Opps',
                                    'Trả lời thất bại!',
                                    'warning');
                            }
                        };

                        $.app.ajax(null, 'admin/cms/comment/reply', data, _cb, 'POST', '');
                    }

                });

            });
        }

    };


    $(document).ready(function () {
        var commentObj = new CommentCls();
        commentObj.run();
    });
}(jQuery, $.app));
