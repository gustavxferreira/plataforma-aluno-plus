import { LitElement, html } from "https://cdn.jsdelivr.net/npm/lit@3.2.1/+esm";
import { fetchCourses } from "../../public/js/courses/fetchCourses.js";

export class selectCourse extends LitElement {
  static properties = {
    courseArchived: { type: String },
    data: { type: Object },
    isLoading: { type: Boolean },
    showAllOption: { type: String },
  };
  createRenderRoot() {
    return this;
  }

  constructor() {
    super();
    this.courseArchived = "off";
    this.result = {};
    this.isLoading = true;
    this.showAllOption = "off";
  }

  async fetch() {
    try {
      let { data } = await fetchCourses();
      let response = Object.values(data);
      let dataFiltered;

      if (this.courseArchived === "on") {
        this.result = response;
      }

      if (this.courseArchived === "off") {
        dataFiltered = response.filter(
          (course) => course.date_archived === null
        );
        this.result = dataFiltered;
      }
    } catch (error) {
      console.error("Erro ao buscar os dados:", error);
    } finally {
      this.isLoading = false;
    }
  }

  async firstUpdated() {
    await this.fetch();
  }

  render() {
    return html`
      <select name="course_id" id="course-filter-id" class="border border-dark rounded">
        ${this.isLoading
          ? html`<option selected disabled>Carregando...</option>`
          : html`
              ${this.showAllOption === "on"
                ? html`<option value="all" selected>Todos Cursos</option>`
                : ""}
              ${this.result.map(
                (course) =>
                  html`<option value="${course.id}">${course.title}</option>`
              )}
            `}
      </select>
    `;
  }
}

customElements.define("select-course", selectCourse);
