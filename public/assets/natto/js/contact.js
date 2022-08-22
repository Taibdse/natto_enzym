const vm = new Vue({
    el: '#app',
    data: {
        formData: {
            name: '',
            email: '',
            mobile: '',
            day: null,
            month: null,
            year: null,
            gender: null,
        },
    },
    methods: {
        submitForm: function () {

            var $contactForm = $('#contactForm');
            this.formData.day = $contactForm.find('select[name=day]').val();
            this.formData.month = $contactForm.find('select[name=month]').val();
            this.formData.year = $contactForm.find('select[name=year]').val();

            var _cb = function (res) {
                if (res.code) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Xin cảm ơn',
                        text: 'Bạn đã đăng ký thành công! Chúng tôi sẽ liên hệ tư vấn trong thời gian sớm nhất.',
                    });
                }
            };

            $.app.ajax(null, 'contact', this.formData, _cb, 'POST', '.alert-form');
        },
    },
});
