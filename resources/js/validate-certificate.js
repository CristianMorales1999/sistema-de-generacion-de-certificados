// Simulador de búsqueda en la base de datos
const mockDatabase = {
  "D2I4-2ED3-283F-27SA": {
    firstName: "Juan",
    lastName: "Pérez",
    certification: "Desarrollo Web",
    issueDate: "2024-11-23",
  },
};

const searchBox = document.getElementById("search");
const statusMessage = document.getElementById("statusMessage");
const modal = document.getElementById("modal");
const closeModalButton = document.getElementById("close-modal");

// Detalles del modal
const firstNameField = document.getElementById("firstName");
const lastNameField = document.getElementById("lastName");
const certificationField = document.getElementById("certification");
const issueDateField = document.getElementById("issueDate");

// Validar código de certificado
searchBox.addEventListener("keyup", (e) => {
  if (e.key === "Enter") {
    e.preventDefault(); // Evita la recarga de página
    const code = searchBox.value.trim();
    const data = mockDatabase[code];

    if (data) {
      // Certificado encontrado
      statusMessage.textContent = "Certificado encontrado";
      statusMessage.className = "status-message status-found";

      const detailsLink = document.createElement("span");
      detailsLink.textContent = "Ver detalles de certificado";
      detailsLink.className = "action-link";
      detailsLink.addEventListener("click", () => openModal(data));

      // Reemplazar cualquier mensaje anterior con el nuevo
      statusMessage.innerHTML = ""; // Limpia contenido previo
      statusMessage.appendChild(
        document.createTextNode("Certificado encontrado")
      );
      statusMessage.appendChild(detailsLink);
    } else {
      // Certificado no encontrado
      statusMessage.textContent = "Certificado no existe";
      statusMessage.className = "status-message status-not-found";
    }
  }
});

// Abrir modal con datos
function openModal(data) {
  firstNameField.textContent = data.firstName;
  lastNameField.textContent = data.lastName;
  certificationField.textContent = `Certificación por: ${data.certification}`;
  issueDateField.textContent = `Fecha de emisión: ${data.issueDate}`;

  modal.classList.remove("hidden");
}

// Cerrar modal
closeModalButton.addEventListener("click", () => {
  modal.classList.add("hidden");
});
