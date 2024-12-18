document.addEventListener('DOMContentLoaded', function() {
  // Verifica si hay datos del certificado pasados desde la sesión
  const certificateData = window.certificateData;

  if (certificateData) {
      const code = Object.keys(certificateData)[0];

      // Asignar los datos al modal
      document.getElementById("firstName").textContent = certificateData[code].firstName;
      document.getElementById("lastName").textContent = certificateData[code].lastName;
      document.getElementById("certification").textContent = `Certificación por: ${certificateData[code].certification}`;
      document.getElementById("issueDate").textContent = `Fecha de emisión: ${certificateData[code].issueDate}`;

      // Mostrar el modal
      document.getElementById("modal").classList.remove("hidden");
  }

  // Cerrar el modal cuando se haga clic en el botón de cerrar
  document.getElementById("close-modal").addEventListener("click", function() {
      document.getElementById("modal").classList.add("hidden");
  });
});
