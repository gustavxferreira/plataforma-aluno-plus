document.addEventListener("DOMContentLoaded", () => {
  localStorage.removeItem('session');
  localStorage.removeItem('autoSavedSql');
  localStorage.removeItem('showThisQueryObject');
  localStorage.removeItem('showThisQuery');
})

document.querySelector('#login-form').addEventListener('submit', async function (e) {
    e.preventDefault();
  
    try {
      const formData = new FormData(this);
      
      const response = await fetch('api/generate-token', {
        method: 'POST',
        body: formData
      });
  
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
  
      const data = await response.json();
      localStorage.setItem('session', data);
  
      window.location.href = '/';
    } catch (error) {
   
    }
  })

  