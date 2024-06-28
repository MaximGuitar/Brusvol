export default () => ({
    async init() {
        const table = this.$refs.tableWrapper.querySelector('table');
        if (!table) return;
        const lastRow = table.rows[table.rows.length - 1];
        if (!lastRow) return;

        const lastCell = lastRow.cells[lastRow.cells.length - 1];
        const keyprice = this.$refs.tableWrapper.dataset.keyprice;
        const roofprice = this.$refs.tableWrapper.dataset.roofprice;
        const material = this.$refs.tableWrapper.dataset.material;
        const CurUrl = window.location.href;
        let HTML = `
        <span class="TablePrice">${'от '+ number_format(keyprice, 0, '', ' ') + ' ₽'}</span>
        <div data-micromodal-trigger="callbackModal"  class="submit_btn btn btn--arrow-right btn--transparent"  onclick="window.cardFormData(event)" data-form-action="Консультация о покупке" data-cur-material="${material}" data-cur-complect="Под ключ" data-cur-price="${keyprice}" data-form-title="Консультация о покупке"  data-current-url="${CurUrl}">
        <span class="text">
            Хочу этот дом
        </span>
        <svg class="arrow">
            <use xlink:href="/wp-content/themes/assembling/static/images/sprite.svg#btn-right-arrow"></use>
        </svg>
        </div>`;
        if (lastCell) lastCell.innerHTML = HTML;

        const prevLastCell = lastRow.cells[lastRow.cells.length - 2];
        HTML = `
        <span class="TablePrice">${'от '+ number_format(roofprice, 0, '', ' ') + ' ₽'}</span>
        <div onclick="window.cardFormData(event)" data-form-action="Консультация о покупке" data-cur-material="${material}" data-cur-complect="Под крышу" data-cur-price="${roofprice}" data-form-title="Консультация о покупке"  data-current-url="${window.location.href}" class="submit_btn btn btn--arrow-right btn--transparent">
        <span class="text">
            Хочу этот дом
        </span>
        <svg class="arrow">
            <use xlink:href="/wp-content/themes/assembling/static/images/sprite.svg#btn-right-arrow"></use>
        </svg>
        </div>`;
        if (prevLastCell) prevLastCell.innerHTML = HTML;
    },
})
