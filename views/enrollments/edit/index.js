import { updateEnrollments } from "../../../public/js/enrollments/updateEnrollments.js";
import { deleteEnrollments } from "../../../public/js/enrollments/deleteEnrollments.js";
import { hideSpinner, showSpinner } from "../../../public/js/utils.js";
import { api } from "../../../src/utils/api.js";
import dayjs from "https://unpkg.com/dayjs@1.8.9/esm/index.js";

document.addEventListener("DOMContentLoaded", async () => {
  const url = window.location.pathname;
  const segments = url.split("/");
  const id = segments[segments.length - 1];

  try {
    showSpinner();
    const { data } = await api.get(`/enrollments/${id}`);
    const student = data.student;
    const course = data.course;

    $("#enrollment-id").val(data.id);
    $("#enrollment-code").val(data.enrollment_code);
    $("#edit-enrollment-date").val(data.enrollment_date);
    $("#edit-status").val(data.status);

    $("#student-name").val(student.name);
    $("#email").val(student.email);
    $("#birthdate").val(dayjs(student.birthdate).format("DD/MM/YYYY"));

    $("#course-title").val(course.title);
    $("#duration").val(course.duration);

    if (course.date_archived !== null) {
      document.getElementById("date-archived-status").checked = true;
    }
    hideSpinner();
  } catch (error) {
    if (error.response) {
      const status = error.response.status;
      if (status === 404) {
        window.location.href = "/not-found";
      }
    }
  }
});

$("#enrollment-edit").on("submit", async function (e) {
  e.preventDefault();
  const form = new FormData(this);
  const id = $("#enrollment-id").val();
  await updateEnrollments(id, form);
});

$("#delete-enrollment").on("click", async function (e) {
  const id = $("#enrollment-id").val();
  await deleteEnrollments(id);
  $(".modal").modal("hide");
  const formEnrollment = document.getElementById("enrollment-edit");
  formEnrollment.reset();
  setTimeout(() => {
    window.location.href = `/matriculas`;
  }, 1500);
});
