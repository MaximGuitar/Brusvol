export default (perPage = 1, between = 30, speed = 900) => ({
    async init() {
        if (window.innerWidth <=600) {
            // const { default: Swiper } = await import("../libs/swiper-bundle.min");
            new Swiper(this.$refs.swiper, {
                slidesPerView: perPage,
                loop: true,
                spaceBetween: between,

                navigation: {
                    prevEl: this.$refs.prev,
                    nextEl: this.$refs.next,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                    },
                    1201: {
                        slidesPerView: 2,
                    },
                },
                pagination: {
                    el: this.$refs.pag,
                },
            });
        }
    },
});