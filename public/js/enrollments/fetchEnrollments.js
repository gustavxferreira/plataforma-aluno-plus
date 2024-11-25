import { api } from "../../../src/utils/api.js";
import { toastErrorInServer } from "../toasts/toast.js";

export async function fetchEnrollments() {
  try {
    const response = await api.get("/enrollments");
    return response;
  } catch (error) {
    console.error(error);
    toastErrorInServer();
  }
}
