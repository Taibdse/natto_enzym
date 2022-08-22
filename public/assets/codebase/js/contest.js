(function($, app) {

    var contestCls = function() {

        var vars = {};
        var ele = {};

        this.run = function() {
            this.init();
            this.bindEvents();
        };

        this.init = function() {
        };

        this.bindEvents = function() {
            selectTopic();

        };

        this.resize = function() {

        };

        function selectTopic() {
            alert('sdfsdf');            $('#frm-select-topic .topic-option').on('click', function () {

                var topicValue = $(this).attr('data-value');

                alert(topicValue);
            });
        }


    };


    $(document).ready(function() {
        var contestObj = new contestCls();
        contestObj.run();
        // On resize

        $(window).resize(function() {
            contestObj.resize();
        });
    });
}(jQuery, $.app));
