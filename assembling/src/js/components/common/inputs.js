const checkField = element => {
	if (element.value == '' || element.value == '+7 (___) ___-__-__') 
		element.parentNode.classList.remove('active');
	else 
		element.parentNode.classList.add('active');
}
const focusInput = () => {
	document.querySelectorAll('.field').forEach(elem => {
		elem.onclick = event => {
			const target = event.currentTarget || event.target;
			target.querySelector('.field__input').focus();
		}

		elem.querySelectorAll('.field__input').forEach(element => {
			checkField(element);

			element.addEventListener('focus', () => {
				element.parentNode.classList.add('active');
			})
			element.addEventListener('focusout', () => {
				checkField(element);
			})
		})
	})
}
focusInput()



const mask = () => $('input[type="tel"]').mask("+7 (999) 999-99-99");
mask()

export { focusInput, mask }