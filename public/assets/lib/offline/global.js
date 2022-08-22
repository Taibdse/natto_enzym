/*
Theme by: WebThemez.com
Note: Please use our back link in your site
*/
$( function() {
// Add background image
		$.backstretch('images/road2.jpg');
		
        //var endDate = "2016-09-30 15:03:25";

        $('.countdown.simple').countdown({ date: endDate });

        $('.countdown.styled').countdown({
          date: endDate,
          render: function(data) {
            $(this.el).html("<div>" + this.leadingZeros(data.days, 2) + " <span>ngày</span></div><div>"
                + this.leadingZeros(data.hours, 2) + " <span>giờ</span></div><div>"
                + this.leadingZeros(data.min, 2) + " <span>phút</span></div><div>"
                + this.leadingZeros(data.sec, 2) + " <span>giây</span></div>");
          }
        });

        $('.countdown.callback').countdown({
          date: +(new Date) + 10000,
          render: function(data) {
            $(this.el).text(this.leadingZeros(data.sec, 2) + " sec");
          },
          onEnd: function() {
            $(this.el).addClass('ended');
          }
        }).on("click", function() {
          $(this).removeClass('ended').data('countdown').update(+(new Date) + 10000).start();
        });
		
		
		
      });
   