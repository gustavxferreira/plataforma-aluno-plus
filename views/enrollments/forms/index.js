import { fetchStudents } from "../../../public/js/students/fetchStudents.js";
import { createEnrollments } from "../../../public/js/enrollments/createEnrollments.js";
import { selectCourse } from "../../../src/components/selectCourse.js";
import { hideSpinner, showSpinner } from "../../../public/js/utils.js";
document.addEventListener("DOMContentLoaded", async () => {
  showSpinner()
  const { data } = await fetchStudents();
  let dataList = $('#student-email')
  data.forEach((student) => {
    dataList.append(`<option value="${student.id}">${student.email}</option>`)
  })
  hideSpinner()
});

$("#enrollment-create").on("submit", async function (e) {
  e.preventDefault();
  const form = new FormData(this);

  await createEnrollments(form);
});
