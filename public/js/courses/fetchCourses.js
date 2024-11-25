import { api } from "../../../src/utils/api.js";
import { toastErrorInServer } from "../toasts/toast.js";

export async function fetchCourses() {
  try {
    const response = await api.get("/courses");
    return response;
  } catch (error) {
    console.error(error);
    toastErrorInServer();
  }
}
