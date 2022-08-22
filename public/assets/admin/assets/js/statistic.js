(function ($, app) {

    var HomeCls = function () {
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
            initLineChart();
            initPieChart();
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

        var initLineChart = function () {
            Highcharts.chart('cnt-line-chart', {

                title: {
                    text: textChart.statistic_chart
                },

                subtitle: {
                    text: ''
                },

                yAxis: {
                    title: {
                        text: textChart.amount
                    }
                },

                xAxis: {
                    categories: $xItems
                },

                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },

                plotOptions: {
                    /*series: {
                        label: {
                            connectorAllowed: false
                        },
                        pointStart: 2010
                    }*/
                },

                series: [{
                    name: textChart.amount_contest,
                    data: $contestCount,
                }, {
                    name: textChart.number_subscriber,
                    data: $userCount
                }, {
                    name: textChart.votes,
                    data: $voteCount
                }, {
                    name: textChart.shares,
                    data: $shareCount
                }],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }

            });
            Highcharts.setOptions({
                colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                        radialGradient: {
                            cx: 0.5,
                            cy: 0.3,
                            r: 0.7
                        },
                        stops: [
                            [0, color],
                            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                })
            });
        }();
        var initPieChart = function () {
            Highcharts.chart('cnt-pie-chart', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: textChart.access_source
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Share',
                    data: $pieData
                }]
            });

        }();

    };


    $(document).ready(function () {
        var homeObj = new HomeCls();
        homeObj.run();

        // On resize
        $(window).resize(function() {

        });
    });
}(jQuery, $.app));
