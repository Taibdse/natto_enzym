(function ($, app) {

    var adminCls = function () {
        // Class variables
        var vars = {};

        // Class elements
        var ele = {};

        this.run = function () {
            this.init();
            this.bindEvents();
        };

        this.init = function () {
            vars.id = 0;
            vars.currentUrl = window.location.href.split('?')[0];
            vars.listIdChecked = []

            ele.filterForm = $('.filterForm');
            ele.tableContent = $('.table-content');
            ele.massButtons = $('.mass-buttons');

            ele.formData = $('.formData');
        };

        this.bindEvents = function () {
            initDataTable();
            initForm();
            viewLog();
            sendEmail();
        };

        this.resize = function () {

        };

        var initDataTable = function () {
            // Click delete icon on table
            $('.btn-delete').unbind('click').bind('click', function (e) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        var _cb = function (data) {
                            if(data.code){
                                Swal.fire({
                                    type: 'success',
                                    text: data.message,
                                }).then((result) => {
                                    if (result.value) {

                                    }
                                });

                                reloadDataTable();
                            }
                        };

                        $.app.ajax(this, $(this).attr('href'), {_method: 'DELETE'}, _cb, 'DELETE');
                    }
                });

                e.preventDefault();
            });

            $('#btn-remove-list').unbind('click').bind('click', function (e) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        var _cb = function (data) {
                            if(data.code){
                                Swal.fire({
                                    type: 'success',
                                    text: data.message,
                                }).then((result) => {
                                    if (result.value) {
                                    }
                                });
                                vars.listIdChecked = []
                                $("#btn-remove-list").css("display", "none")
                                $("#btn-status-list").css("display", "none")
                                reloadDataTable();
                            }
                        };
                        let dataDelete = vars.listIdChecked.join(",")
                        $.app.ajax(this, vars.currentUrl+'/remove-list/'+dataDelete, {_method: 'DELETE'}, _cb, 'DELETE');
                    }
                });

                e.preventDefault();
            });

            // Check all items in table
            $('.checkbox-all').unbind('click').bind('click', function () {
                $(this).closest('table')
                    .find('tbody .checkbox-item')
                    .prop('checked', $(this).prop('checked'))
                    .trigger('change');
            });

            // On select row
            $('.checkbox-item').unbind('change').bind('change', function () {
                if($(this).prop('checked')){
                    $(this).closest('tr').addClass('table-success');

                    let check = vars.listIdChecked.indexOf($(this).attr('value'))
                    if (check == -1) {
                        vars.listIdChecked.push($(this).attr('value'));
                    }

                }else{
                    $(this).closest('tr').removeClass('table-success');

                    let i = vars.listIdChecked.indexOf($(this).attr('value'))
                    if (i != -1) {
                        vars.listIdChecked.splice(i,1);
                    }
                }
                if(vars.listIdChecked.length > 0) {
                    $("#btn-remove-list").css("display", "inline-flex")
                    $("#btn-status-list").css("display", "inline-flex")

                } else {
                    $("#btn-remove-list").css("display", "none")
                    $("#btn-status-list").css("display", "none")
                }
                return false;
            });

            // Click on Display select box
            $('.table-limit', ele.tableContent).unbind('change').bind('change', function () {
                $('input[name=_limit]', ele.filterForm).val(this.value);
                ele.filterForm.trigger('submit');
                return false;
            });

            // Click on search icon
            $('.btn-search', ele.filterForm).on('click', function () {
                $('input[name=page]', ele.filterForm).val(1);
                return false;
            });

            // Generate header sort
            $('thead th', ele.tableContent).slice(1).unbind('click').bind('click', function () {
                var $field = $(this).data('field');
                var $orderBy = $('input[name=_order_by]', ele.filterForm).val();
                var $orderType = $('input[name=_order_type]', ele.filterForm).val();

                if ($field) {
                    $('input[name=_order_by]', ele.filterForm).val($field);
                    $('input[name=_order_type]', ele.filterForm).val($orderType === 'DESC' ? 'ASC' : 'DESC');
                    ele.filterForm.trigger('submit');
                }

                return false;
            });

            // Auto append order by icon
            $.each($('thead th', ele.tableContent), function (index, obj) {
                var $field = $(this).data('field');
                var $orderBy = $('input[name=_order_by]', ele.filterForm).val();
                var $orderType = $('input[name=_order_type]', ele.filterForm).val();

                if ($field && $orderBy === $field) {
                    if($orderType === 'DESC'){
                        $(obj).append(' <i class="flaticon2-arrow-up"></i>');
                    }else{
                        $(obj).append(' <i class="flaticon2-arrow-down"></i>');
                    }
                }
            });

            // Click on status button
            $('.btn-status-group a').unbind('click').bind('click', function () {
                let $field = $(this).data('field');
                let $value = $(this).data('value');
                let $id = $(this).data('id');
                let $action = $(this).data('action');

                var _cb = function (res) {
                    if(res.code){
                        reloadDataTable();
                    }
                };

                $.app.ajax(this, vars.currentUrl, {action: $action, id: $id, field: $field, value: $value}, _cb, 'GET', '.none');
            });

            //Click on list status button
            $('.btn-status-list a').unbind('click').bind('click', function () {
                let $field = $(this).data('field');
                let $value = $(this).data('value');
                let $id = vars.listIdChecked.join(",");
                let $action = $(this).data('action');

                var _cb = function (res) {
                    if(res.code){
                        vars.listIdChecked = []
                        $("#btn-remove-list").css("display", "none")
                        $("#btn-status-list").css("display", "none")
                        reloadDataTable();
                    }
                };

                $.app.ajax(this, vars.currentUrl, {action: $action, id: $id, field: $field, value: $value}, _cb, 'GET', '.none');
            });

            // Click on status button
            $('.btn-status-group .option').unbind('click').bind('click', function () {
                let $field = $(this).data('field');
                let $value = $(this).data('value');
                let $id = $(this).data('id');
                let $action = $(this).data('action');

                var _cb = function (res) {
                    if(res.code){
                        reloadDataTable();
                    }
                };

                $.app.ajax(this, vars.currentUrl, {action: $action, id: $id, field: $field, value: $value}, _cb, 'GET', '.none');
            });

            // Click on ordering button
            $('.btn-order-group a').unbind('click').bind('click', function () {
                let $field = $(this).data('field');
                let $value = $(this).data('value');
                let $id = $(this).data('id');
                let $action = $(this).data('action');

                var _cb = function (res) {
                    if(res.code){
                        reloadDataTable();
                    }
                };

                $.app.ajax(this, vars.currentUrl, {action: $action, id: $id, field: $field, value: $value}, _cb, 'GET', '.none');
            });
        };

        var reloadDataTable = function () {
            var _cb = function (res) {
                if(res.code){
                    ele.tableContent.html(res.data);
                    initDataTable();
                }
            };

            $.app.ajax(null, vars.currentUrl, ele.filterForm.serialize(), _cb, 'GET', '.none');
        };

        var initForm = function () {
            // Init editor
            for(var i=1; i<=5; i++){
                if($('#editor' + i).length){
                    CKEDITOR.replace( 'editor' + i );
                }
            }

            // Disable button when submit
            ele.formData.on('submit', function () {
                $('.btn-submit').attr('disabled', true);
            });

            // Trigger button save or apply
            $('.btn-submit').on('click', function () {
                $('input[name=_action]', ele.formData).val( $(this).data('action') );

                if (ele.formData[0].checkValidity()){
                    $('.btn-submit').attr('disabled', true);
                    ele.formData[0].submit();
                    return false;
                }

                //return false;
            });

            // Trigger open media button
            $('.btn-media', ele.formData).on('click', function () {
                // Reload media popup
                mediaPage = 0;
                loadAdminMediaMore();

                mediaInsertType = $(this).data('type');
                mediaInsertTo = $(this).data('value');
                mediaPreviewTo = $(this).data('preview');

                $('#mediaModal').modal('show');
                return false;
            });

            // Trigger open embeded button
            $('.btn-embeded', ele.formData).on('click', function () {
                mediaInsertType = $(this).data('type');
                mediaInsertTo = $(this).data('value');

                $('#embededModal').modal('show');
                return false;
            });

            // Trigger crop image button
            $('.btn-crop-image').on('click', function (e) {
                var size = $(this).attr('data-size');
                cropRatio = size ? size.split(',') : [800,600];
                cropUpdatePreviewTo = $(this).data('preview');
                cropUpdateValueTo = $(this).data('value');

                // Destroy cropper
                $('#crop_image_input').val('');

                //$('#cropModal #crop_image_input').trigger('click');
                setTimeout(function () {
                    $('#cropModal').modal('show');
                }, 1000);
            });

            $('.select2Multiple').select2({});
            $('.select2Single').select2({});
        };

        var viewLog = function () {
            $(".view-log").click(function () {
                let id = $(this).attr('id')
                let table = $(this).attr('target')

                const TYPE_DELETE = 0;
                const TYPE_CREATE = 1;
                const TYPE_UPDATE = 2;

                var _cb = function (data) {
                    if(data.code){
                        var html = '';
                        console.log(data.data.data);
                        $.each(data.data.data, function( index, value ) {
                            let type = '';
                            if(value.action == TYPE_DELETE)
                                type = 'Xoá';
                            else if(value.action == TYPE_CREATE)
                                type = 'Tạo mới';
                            else if(value.action == TYPE_UPDATE)
                                type = 'Sửa';

                            html += '<tr><th scope="row">'+(index+1)+'</th><td>'+value.type_changes+'</td><td>'+value.before+'</td><td>'+value.after+'</td><td>'+value.updated_at+'</td><td>'+type+'</td><td>'+value.user.email+'</td></tr>';
                        });

                        $("#data-log").html(html)
                        $("#logModal").modal()
                    }
                };

                $.app.ajax(this, 'admin/system/log-admin', {id: id, table: table}, _cb, 'GET', '.none');
            })
        };

        var sendEmail = function () {
            $(document).on('click', '.send-mail', function (e) {
                e.preventDefault();
                var $this = $(this);
                var data = {};
                data.type = $this.data('type');
                data.id = $this.data('id');
                data.target = $this.data('target');
                data.url = $this.data('url');

                var config = {
                    title: 'Bạn có chắc muốn gửi mail?',
                    //text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                };

                if (data.type === 'invalid') {
                    config.input = 'textarea';
                    config.title = 'Mời nhập lý do';
                }

                Swal.fire(config).then((result) => {
                    if (result.value) {

                        if (data.type === 'invalid') {
                            data.reason = result.value;
                        }

                        var _cb = function (res) {

                            if (res.code) {
                                Swal.fire('Good job!',
                                    'Gửi mail thành công!',
                                    'success');
                                console.log(res.data);


                                let html = `
                                    <tr>
                                        <td>${ res.data.created_at }</td>
                                        <td>${ res.data.user.name }</td>
                                        <td>${ res.data.logType[res.data.action] }</td>
                                        <td>${ res.data.type_changes }</td>
                                    </tr>
                                `;

                                $('.tbl-logs-mail tbody').prepend(html);

                                if (! $this.find('i').length) {
                                    $this.append(' <i style="font-size: 13px" class="la la-check"></i>');
                                }

                                reloadDataTable();

                            }
                            else {
                                Swal.fire('Opps',
                                    'Gửi mail thất bại',
                                    'warning');
                            }
                        };

                        $.app.ajax($this, data.url, data, _cb, 'GET', '');
                    }

                });
            });
        };
    };


    $(document).ready(function () {
        var adminObj = new adminCls();
        adminObj.run();

        // On resize
        $(window).resize(function() {

        });

        //Count comment
        var _cbComment = function (res) {
            if(res.code){

                if (res.data.comment_draft > 0) {
                    $('.comment-counter').show();
                    $('.comment-counter').html(res.data.comment_draft);
                }

                if (res.data.contact_draft > 0) {
                    $('.contact-counter').show();
                    $('.contact-counter').html(res.data.contact_draft);
                }

                if (res.data.contest_draft > 0) {
                    $('.contest-counter').show();
                    $('.contest-counter').html(res.data.contest_draft);
                }

                if (res.data.order_draft > 0) {
                    $('.order-counter').show();
                    $('.order-counter').html(res.data.order_draft);
                }


            }
        };

        $.app.ajax(null, 'admin/menu/counter', {}, _cbComment, 'GET', '.none');

    });
}(jQuery, $.app));
