import AirDatepicker from 'air-datepicker';
import 'air-datepicker/air-datepicker';

export default () => ({
    async init() {

        new AirDatepicker('#cardCallbackData', {
            position: 'top center',
            timepicker: true,
            // inline:true
        });
    },
})
