import { LitElement, html } from "https://cdn.jsdelivr.net/npm/lit@3.2.1/+esm";

export class searchInTable extends LitElement {
  static properties = {
    value: { type: String },
    // id da tabela
    table: { type: String },
    columns: { type: Array },
  };
  createRenderRoot() {
    return this;
  }

  constructor() {
    super();
    this.value = "";
    this.table = "";
    this.columns = [];
  }

  handleSearch(event) {
    if (!this.table || !this.columns) {
      console.error("Is waited element name of table and columns index");
      return;
    }

    const table = $(`#${this.table} tbody tr`);

    const columnsTable = this.columns;
    this.value = event.target.value.toLowerCase();

    let processedText = this.value;

    table.each(function () {
      let row = $(this);

      let matchFound = false;

      columnsTable.forEach(function (lineTable) {
        let tableTd = row
          .find(`td:nth-child(${lineTable})`)
          .text()
          .trim()
          .toLowerCase();
        if (tableTd.includes(processedText)) {
          matchFound = true;
        }
      });

      if (matchFound) {
        row.show();
      } else {
        row.hide();
      }
    });
  }

  render() {
    return html` <div class="input-icons">
      <input
        class="mb-2 border border-dark rounded"
        style="padding: 3px;"
        type="text"
        .value="${this.value}"
        @input="${this.handleSearch}"
        placeholder="Pesquisar..."
      />
    </div>`;
  }
}

customElements.define("search-bar", searchInTable);
