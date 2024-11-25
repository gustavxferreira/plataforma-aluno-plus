import dayjs from "https://unpkg.com/dayjs@1.8.9/esm/index.js";

export function updateTable(data) {
    const table = document.getElementById("table-students");
    let tbody = table.querySelector("tbody");
    let tableHTML = "";
    tbody.innerHTML = ""
    data.forEach((student) => {
      tableHTML += `<tr>
      <td>${student.name}</td>
      <td>${student.email}</td>
      <td>${dayjs(student.birthdate).format("DD/MM/YYYY")}</td>
      <td><button type="button" onclick="viewEnrrolments(${student.id})" class="border border-0 text-info">Ver matriculas</button></td>
       <td><a href="alunos/editar/${student.id}"><button type="button" class="btn btn-dark btn-sm">Alterar</button></a></td>
      <tr>
      `;
    });
    tbody.innerHTML += tableHTML;
  }