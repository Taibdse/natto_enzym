var vue_app = new Vue({
    data: {
        curentVideo: 1,
        disabled: 'disableTab',
        videos:[],
        btnTest: false,
        formData: {
            name: '',
            email: '',
            mobile: '',
            day: null,
            month: null,
            year: null,
            gender: null,
        },
        errors: {
            message: null,
            code: null,
        },
        quetions:[],

        answer:[],
        score: '',


    },
    methods: {
        getFullUrl: function (path) {
            return url + '/' + path;
        },
        onEnd: function () {
            if(this.curentVideo <5){
                this.curentVideo ++;
            }
        },
        showBtn: function () {
            this.btnTest = true;
        },

        getVideoList() {
            axios.get(this.getFullUrl('/course/getVideos')).then(res => {
                this.videos = res.data.data;
            });

        },
        getQuetions() {
            axios.get(this.getFullUrl('/course/getQuestions')).then(res => {
                this.quetions = res.data.data;
                //console.log(this.quetions);
            });

        },
        showFail(){
            $("#popup-result-fail").modal({
                fadeDuration: 100
            });
        },
        showPass(){
            $("#popup-result-pass").modal({
                fadeDuration: 100
            });
        },

        postAnswer(){
            if(this.answer.includes(null) == true || this.answer.includes(undefined) == true || this.answer.length < this.quetions.length){
                alert('Bạn chưa trả lời hết các câu hỏi')
            }else{
                axios({
                    url: this.getFullUrl('/course/checkResult'),
                    method: 'post',
                    data: this.answer
                })
                .then(res => {
                    //console.log(res.data);
                    if (res.data.code === 2) {
                        $.app.alert.info(res.data.message);
                        return;
                    }
                    this.score = res.data.data;
                    if(res.data.data.scores < 80){
                        this.showFail()
                    } else{
                        this.showPass()
                    }
                })
                .catch(error => {
                    //console.log(error);
                });

            }

        },



        async submitForm() {

            this.formData.day = this.$refs.selectDay.value;
            this.formData.month = this.$refs.selectMonth.value;
            this.formData.year = this.$refs.selectYear.value;

            var response = await axios.post(this.getFullUrl('course/updateUser'), this.formData);
            if (response.data.code && response.data.data) {
                $.modal.close();
                $('#video-rule, .section-rule').removeClass('invisible ');

            }
            else {
                this.errors.code = response.data.code;
                this.errors.message = response.data.message;
            }
        },

    },
    created() {
        this.getVideoList();
        this.getQuetions();

    },


})
