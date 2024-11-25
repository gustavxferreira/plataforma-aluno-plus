import { updateCourses } from "../../../public/js/courses/updateCourses.js";
import { hideSpinner, showSpinner } from "../../../public/js/utils.js";
import { api } from "../../../src/utils/api.js";

document.addEventListener("DOMContentLoaded", async () => {
  const url = window.location.pathname;
  const segments = url.split("/"); 
  const id = segments[segments.length - 1];
  
  try {
    showSpinner()
    const { data } = await api.get(`/courses/${id}`)

    $('#course-id').val(data.id)
    $("#edit_title").val(data.title)
    $("#edit_duration").val(data.duration)
    $("#edit_description").val(data.description)
    
    if(data.date_archived !== null){
      document.getElementById('date-archived-status').checked = true
    }
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

$("#course-edit").on("submit", async function (e) {
  e.preventDefault();
  const form = new FormData(this);
  const id = $('#course-id').val()
  await updateCourses(id, form);
});