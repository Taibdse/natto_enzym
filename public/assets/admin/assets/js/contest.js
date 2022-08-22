(function ($, app) {

    var ContestCls = function () {
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
        };

        this.bindEvents = function () {
            KTBootstrapSelect.init();
            KTBootstrapDaterangepicker.init();
        };

        this.resize = function () {

        };

        var KTBootstrapSelect = function () {

            // Private functions
            var demos = function () {
                // minimum setup
                $('.kt-selectpicker').selectpicker();
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();
        // Class definition

        var KTBootstrapDaterangepicker = function () {

            // Private functions
            var demos = function () {
                // minimum setup
                $('#kt_daterangepicker_1, #kt_daterangepicker_1_modal').daterangepicker({
                    buttonClasses: ' btn',
                    applyClass: 'btn-primary',
                    cancelClass: 'btn-secondary',
                    locale: {
                        format: 'YYYY/MM/DD'
                    }
                });
            }

            return {
                // public functions
                init: function() {
                    demos();
                    //validationDemos();
                }
            };
        }();
    };


    $(document).ready(function () {
        var contestObj = new ContestCls();
        contestObj.run();

    });
}(jQuery, $.app));
