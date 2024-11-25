import { fetchCourses } from "../../public/js/courses/fetchCourses.js";
import { updateTable } from "../../public/js/courses/updateTable.js";
import { showSpinner, hideSpinner } from  "../../public/js/utils.js";
import { searchInTable } from "../../src/components/searchInTable.js"
document.addEventListener("DOMContentLoaded", async () => {
  showSpinner();
  const response = await fetchCourses();
  updateTable(response.data);
  hideSpinner();
});
