import { removeItemsByPrefixes } from "./utils.js";

export async function unauthorizedRedirect() {
    await axios.get('/logout');
    await removeItemsByPrefixes(['session', 'autoSavedSql', 'showThisQueryObject', 'showThisQuery']);
    alert("Sua Sessão expirou, faça login novamente!")
    window.location.href = '/login';
}