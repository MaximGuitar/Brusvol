export default () => ({
	async init() {
		const STEPS = this.$root.querySelectorAll(".work-stages__elem");
		const CONTAINER = this.$root;
		const LINE = CONTAINER.querySelector('#ScrollLine');
		window.addEventListener('scroll', function () {
			let lineHeight = (-CONTAINER.getBoundingClientRect().top) + 400;
			STEPS.forEach(item => {
				let itemTop = item.getBoundingClientRect().top;
				LINE.style.transform = `translateY(${lineHeight}px)`;
				if (itemTop < 400) {
					item.classList.add('active');
				}
				else {
					item.classList.remove('active');
				}
			})
		});
	},
})
