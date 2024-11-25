import { api } from "../../../src/utils/api.js";
import {
  toastFieldsWarning,
  toastIdNotFound,
  toastConflict,
  toastErrorInServer,
  toastCadastration,
} from "../toasts/toast.js";
import { disableButton, enableButton, warningInputs } from "../utils.js";

export async function createEnrollments(formData) {
  try {
    disableButton("button-create-enrollment");
    await api.post("/enrollments", formData);
    toastCadastration();
    const formEnrollment = document.getElementById("enrollment-create");
    
    formEnrollment.reset();
    setTimeout(() => {
      window.location.href = `/matriculas`;
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
    }
  } finally {
    enableButton("button-create-enrollment");
  }
}


