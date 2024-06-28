export default () => ({
    PaginateCheck(e) {
        e.preventDefault();
        try {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            var parsedURL = new URL(e.target.href);
            var pageValue = parsedURL?.searchParams.get("page") || 1;

            this.$refs.pageStorage.value = pageValue;
            var form = document.getElementById('main-catalog');
            const customEvent = new CustomEvent('pag');
            if (form) {
                form.dispatchEvent(customEvent);
            } else {
                console.error('Форма не найдена');
            }

        } catch (error) {
            console.log(error);
        }
    }
});

