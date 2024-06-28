export default (perPage = 1, between = 0) => ({
    swiper: null,
    init() {
        this.swiper = new Swiper(this.$refs.CatalogSwiper, {

            slidesPerView: perPage,
            loop: true,
            spaceBetween: between,

            navigation: {
                prevEl: this.$refs.prev,
                nextEl: this.$refs.next,
            },

            pagination: {
                el: this.$refs.pag,
            },
        });

    },
    SlideTo(slide = 0) {
        this.swiper.slideTo(slide, 500, true)
    }

});