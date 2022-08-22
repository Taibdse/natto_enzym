(function ($, app) {

    var BannerCls = function () {
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
            initForm();
        };

        this.resize = function () {

        };

        var initForm = function () {
            $('select[name=type]').on('change', function (e) {
                var $this = $(this);
                let positon = $this.val();
                let width = $this.find('option[value='+ positon +']').attr('data-width');
                let height =  $this.find('option[value='+ positon +']').attr('data-height');
                $('.btn-crop-image').attr('data-size', width + ',' + height);
                $('.label-size').text('(' + width + ' x ' + height + ')');
            });
        };

    };


    $(document).ready(function () {
        var bannerObj = new BannerCls();
        bannerObj.run();

    });
}(jQuery, $.app));
