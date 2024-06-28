import forms_feedback_function from '/js-export-function/form_feedback.js';
document.addEventListener('DOMContentLoaded', function() {
    new MaskInput("[data-maska]");
    const forms_feedback = document?.querySelectorAll('.forms_feedback');
    forms_feedback.forEach(form => {
        const forma = form.querySelector('form');
        const btn_feedback = forma.querySelector('.btn');
        btn_feedback.addEventListener('click', function(e) {
            e.preventDefault();
            let append_data;
            if ( forma.getAttribute('data-form-name') || forma.getAttribute('data-form-slug') ){
                append_data = {
                    form_name: forma.getAttribute('data-form-name'),
                    form_slug: forma.getAttribute('data-form-slug'),
                    page: forma.getAttribute('data-page'),
                };
            }
            forms_feedback_function(forma, JSON.stringify(append_data), 5000);
        });
    });
})