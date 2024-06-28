export default (MinVal = 0, MaxVal = 500, Step = 1, SubmitForm = false,StartMin = 0, StartMax = 500) => ({
    FirstVal: 0,
    Secondval: 0,
    async init() {
        noUiSlider.create(this.$refs.slider, {
            range: {
                'min': MinVal,
                'max': MaxVal
            },
            start: [StartMin, StartMax],
            step: Step,
            connect: true,
            behaviour: 'tap-drag',
            format: {
                from: function (value) {
                    return parseInt(value);
                },
                to: function (value) {
                    return parseInt(value);
                }
            },
        });
        if (SubmitForm) {
            this.$refs.slider.noUiSlider.on('change', (values, handle) => {
                const form = document.querySelector('.main-catalog');
                form.dispatchEvent(new Event('pag'));
            });
        }

        this.$refs.slider.noUiSlider.on('update', (values, handle) => {
            let params = (this.$refs.slider.noUiSlider.get());
            this.FirstVal = params[0];
            this.Secondval = params[1];
        });
    },
});