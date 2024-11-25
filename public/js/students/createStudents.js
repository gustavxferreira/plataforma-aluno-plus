import { api } from "../../../src/utils/api.js";
import {
  toastFieldsWarning,
  toastIdNotFound,
  toastConflict,
  toastErrorInServer,
  toastCadastration,
} from "../toasts/toast.js";
import { disableButton, enableButton, warningInputs } from "../utils.js";

export async function createStudents(form) {
  try {
    disableButton("button-create-student");
    await api.post("/students", form);
    toastCadastration();
    const formCourse = document.getElementById("student-create");

    formCourse.reset();
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
    enableButton("button-create-student");
  }
}
