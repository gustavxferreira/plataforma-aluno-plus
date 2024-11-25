import { api } from "../../../src/utils/api.js";
import { toastErrorInServer } from "../toasts/toast.js";

export async function fetchStudents() {
  try {
    const response = await api.get("/students");
    return response;
  } catch (error) {
    console.error(error);
    toastErrorInServer();
  }
}
