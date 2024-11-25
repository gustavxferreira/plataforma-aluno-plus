import { api } from "../../../src/utils/api.js";
import {
  toastIdNotFound,
  toastErrorInServer,
  toastDelete,
} from "../toasts/toast.js";

export async function deleteEnrollments(id) {
  try {
    await api.delete(`/enrollments/${id}`);
    toastDelete();
  } catch (error) {
    if (error.response) {
      const status = error.response.status;
      if (status === 404) {
        console.error(error, "Id não encontrado");
        toastIdNotFound();
      } else {
        console.error("Erro inesperado", error);
        toastErrorInServer();
      }
    }
  }
}
