import { fetchStudents } from "../../public/js/students/fetchStudents.js";
import { updateTable } from "../../public/js/students/updateTable.js";
import { showSpinner, hideSpinner } from "../../public/js/utils.js";
import { searchInTable } from "../../src/components/searchInTable.js";
import { api } from "../../src/utils/api.js";
import dayjs from "https://unpkg.com/dayjs@1.8.9/esm/index.js";

document.addEventListener("DOMContentLoaded", async () => {
  showSpinner();
  const response = await fetchStudents();
  updateTable(response.data);
  hideSpinner();
});

window.viewEnrrolments = async (id) => {
  showSpinner()
  const table = $("#table-enrollments tbody");
  let tableHTML = "";
  table.empty();
  const { data } = await api.get(`/students/${id}`);
  
  if (data.enrollments.length <= 0) {
    tableHTML += `<tr> <td colspan="4">Este aluno ainda não tem matrículas</td></tr>`;
    table.html(tableHTML);
    hideSpinner()
    $(".modal").modal("show");
    return;
  }

  data.enrollments.forEach((enrollment) => {
    let status;
    switch (enrollment.status) {
      case "active":
        status = "<span class='text-success'>Ativo</span>";
        break;
      case "inactive":
        status = "<span class='text-danger'>Inativa</span>";
        break;
      case "suspended":
        status = "<span class='text-secondary'>Suspensa</span>";
        break;
    }
    tableHTML += ` 
      <tr>
        <td>${enrollment.enrollment_code}</td>
        <td>${dayjs(enrollment.enrollment_date).format("DD/MM/YYYY")}</td>
        <td>${enrollment.course.title}</td>
        <td>${status}</td>
      </tr>`;
  });

  table.html(tableHTML);
  hideSpinner()
  $(".modal").modal("show");
};
