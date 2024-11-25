import { fetchEnrollments } from "../../public/js/enrollments/fetchEnrollments.js";
import { updateTable } from "../../public/js/enrollments/updateTable.js";
import { showSpinner, hideSpinner } from  "../../public/js/utils.js";
import { searchInTable } from "../../src/components/searchInTable.js"
import { selectCourse } from "../../src/components/selectCourse.js";
document.addEventListener("DOMContentLoaded", async () => {
  showSpinner();
  const response = await fetchEnrollments();
  updateTable(response.data);
  hideSpinner();
});
