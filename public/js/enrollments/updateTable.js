import dayjs from "https://unpkg.com/dayjs@1.8.9/esm/index.js";

function filterTable(data) {
  let courseFilter = $("#course-filter-id").val();
  const statusEnrollmentFilter = $("#status-enrollment-filter").val();

  $("#search-bar-id").val("");

  if (!courseFilter) {
    courseFilter = "all";
  }

  if (courseFilter === "all" && statusEnrollmentFilter === "all") {
    return data;
  }

  switch (statusEnrollmentFilter) {
    case "all":
      break;
    case "active":
      data = data.filter((item) => item.status === "active");
      break;
    case "inactive":
      data = data.filter((item) => item.status === "inactive");
      break;
    case "suspended":
      data = data.filter((item) => item.status === "suspended");
      break;
  }

  if (courseFilter != "all") {
    data = data.filter((item) => item.course_id === parseInt(courseFilter));
  }
  return data;
}

export function updateTable(data) {
  const table = document.getElementById("table-enrollments");
  let tbody = table.querySelector("tbody");
  let tableHTML = "";
  let dataFiltered;

  $("#apply-enrollment-filter")
    .off("click")
    .on("click", () => updateTable(data));

  dataFiltered = filterTable(data);

  if (dataFiltered.length <= 0) {
    tableHTML += `<tr> <td style="padding:20px;" colspan="7">Não há resultados</td></tr>`;
    tbody.innerHTML = tableHTML;
    return;
  }
  $('#result-quantity').html(`Quantidade de Resultados: ${dataFiltered.length}`)
  dataFiltered.forEach((enrollment) => {
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
        <td>${enrollment.name}</td>
        <td>${enrollment.email}</td>
        <td>${enrollment.title}</td>
        <td>${status}</td>
        <td><a href="matriculas/editar/${
          enrollment.id
        }"><button type="button" class="btn btn-dark btn-sm">Alterar</button></a></td>
        <tr>
        `;
  });

  tbody.innerHTML = tableHTML;
}
