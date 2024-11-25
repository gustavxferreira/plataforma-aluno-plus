import { api } from "../../../src/utils/api.js";

import {
  toastFieldsWarning,
  toastIdNotFound,
  toastConflict,
  toastErrorInServer,
  updateToast,
} from "../toasts/toast.js";

import { disableButton, enableButton, warningInputs } from "../utils.js";
export async function updateStudents(id, form) {
  try {
    const formData = {};

    form.forEach((value, key) => {
      formData[key] = value;
    });
    
    disableButton("button-edit-student");
    await api.put(`/students/${id}`, formData);
    updateToast();
    const formStudent = document.getElementById("student-edit");

    formStudent.reset();
    setTimeout(() => {
      window.location.href = `/alunos`;
    }, 1500);
  } catch (error) {
    if (error.response) {
      const status = error.response.status;
      if (status === 400) {
        const errorData = error.response.data;
        console.error("Campos invalidos", error);
        toastFieldsWarning();
        warningInputs(errorData);
      } else if (status === 404) {
        toastIdNotFound();
      } else if (status === 409) {
        toastConflict();
      } else {
        console.error("Erro interno", error);
        toastErrorInServer();
      }
    } else {
      console.error("Erro interno", error);
      toastErrorInServer();
    }
  } finally {
    enableButton('button-edit-student')
  }
}
