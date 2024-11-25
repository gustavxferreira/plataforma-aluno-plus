import dayjs from "https://unpkg.com/dayjs@1.8.9/esm/index.js";

export function updateTable(data) {
  const table = document.getElementById("table-courses");
  let tbody = table.querySelector("tbody");
  let tableHTML = "";

  data.forEach((course) => {
    let status =
      course.date_archived === null
        ? "<span class='text-success'>Ativo</span>"
        : `<span class='text-secondary'>Arquivado em ${dayjs(course.date_archived).format("DD/MM/YYYY")}</span>`;

    tableHTML += `<tr>
      <td>${course.title}</td>
      <td>${course.duration}</td>
      <td>${status}</td>
      <td><a href="cursos/editar/${course.id}"><button type="button" class="btn btn-dark btn-sm">Alterar</button></a></td>
      <tr>
      `;
  });
  tbody.innerHTML = tableHTML;
}
