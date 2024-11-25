import { deleteStudents } from "../../../public/js/students/deleteStudents.js";
import { updateStudents } from "../../../public/js/students/updateStudents.js";
import { hideSpinner, showSpinner } from "../../../public/js/utils.js";
import { api } from "../../../src/utils/api.js";

document.addEventListener("DOMContentLoaded", async () => {
  const url = window.location.pathname;
  const segments = url.split("/"); 
  const id = segments[segments.length - 1];
  
  try {
    showSpinner()
    const { data } = await api.get(`/students/${id}`)

    $('#student-id').val(data.id)
    $("#edit_name").val(data.name)
    $("#edit_email").val(data.email)
    $("#edit_birthdate").val(data.birthdate)
    
    hideSpinner()
  }
  catch(error){
    if(error.response){
     const status = error.response.status 
     if(status === 404){
      window.location.href = '/not-found'
     }
    }
  }
});

$("#student-edit").on("submit", async function (e) {
  e.preventDefault();
  const form = new FormData(this);
  const id = $('#student-id').val()
  await updateStudents(id, form);
});

$("#delete-course").on("click", async function (e) {
  
  const id = $('#student-id').val()
  await deleteStudents(id);
  $(".modal").modal("hide");
  const formStudent = document.getElementById("student-edit");
  formStudent.reset();
  setTimeout(() => {
    window.location.href = `/alunos`;
  }, 1500);
});