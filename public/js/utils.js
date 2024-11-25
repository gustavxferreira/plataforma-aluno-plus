export function showSpinner() {
  document.querySelector(".loading-spinner-large").style.display = "flex";
}
export function hideSpinner() {
  document.querySelector(".loading-spinner-large").style.display = "none";
}

export function warningInputs(data) {
  let defaultColor = "#ced4da";
  const warningColor = "rgb(239, 68, 68)";
  let timeoutId;

  function loopWarning(data, color) {
    for (const field of data.fields) {
      const inputField = document.querySelector(`input[name="${field}"]`);

      if (inputField) {
        inputField.style.borderColor = color;

        let warningTextOnField = document.querySelector(
          `p[data-name="${field}"]`
        );

        if (!warningTextOnField) {
          warningTextOnField = document.createElement("p");
          warningTextOnField.setAttribute("data-name", field);
          warningTextOnField.classList.add("warning-about-field");
          warningTextOnField.classList.add("text-danger");
          inputField.insertAdjacentElement("afterend", warningTextOnField);
        }

        warningTextOnField.textContent = data.errors[field] || "";
      }
    }
  }

  loopWarning(data, warningColor);

  clearTimeout(timeoutId);
  timeoutId = setTimeout(() => {
    const warningTextsOnFields = document.querySelectorAll(
      ".warning-about-field"
    );
    warningTextsOnFields.forEach((text) => (text.textContent = "")); 
    for (const field of data.fields) {
      const inputField = document.querySelector(`input[name="${field}"]`);
      if (inputField) {
        inputField.style.borderColor = defaultColor; 
      }
    }
  }, 8000);
}

export function disableButton(element, loadingText = "Salvando...") {
  let item = document.getElementById(element);
  if (item) {
    item.disabled = true;
    item.textContent = loadingText;
  }
}

export function enableButton(element, defaultText = "Cadastrar") {
  let item = document.getElementById(element);
  if (item) {
    item.disabled = false;
    item.textContent = defaultText;
  }
}