import { createStudents } from "../../../public/js/students/createStudents.js";

$("#student-create").on("submit", async function (e) {
  e.preventDefault();
  const form = new FormData(this);
  await createStudents(form);
});
