import { createCourses } from "../../../public/js/courses/createCourses.js";

$("#course-create").on("submit", async function (e) {
  e.preventDefault();
  const form = new FormData(this);
  await createCourses(form);
});
