$(document).ready(function () {
    // $( "#meta-title" ).change(function() {
    //     console.log('dfjshfjdh');
    // });
    $.seoPreview({
        google_div: "#seopreview-google",
        facebook_div: "#seopreview-facebook",
        metadata: {
            title: $('#meta-title'),
            desc: $('#meta-desc'),
            url: {
                full_url: $.app.vars.url
            }
        },
        google: {
            show: true,
            date: false
        },
        facebook: {
            show: true,
            featured_image:  $('#meta-url')
        }
    });
});
