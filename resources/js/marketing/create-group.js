/* *************** POR REVISAR *************** */

  // =================== MANEJO DEL MODAL ===================

// Selección de elementos del modal
const openModalButton = document.getElementById("open-modal");
const modal = document.getElementById("modal");
const closeModalButton = document.getElementById("close-modal");

// Abrir el modal
openModalButton.addEventListener("click", (event) => {
  event.preventDefault(); // Evita la acción predeterminada del enlace
  modal.classList.remove("hidden");
  modal.classList.add("visible");
});

// Cerrar el modal
closeModalButton.addEventListener("click", () => {
  modal.classList.remove("visible");
  modal.classList.add("hidden");
});

// Cerrar el modal al hacer clic fuera de él
window.addEventListener("click", (event) => {
  if (event.target === modal) {
    modal.classList.remove("visible");
    modal.classList.add("hidden");
  }
});
 
// =================== CÓDIGO EXISTENTE PARA LA TABLA ===================
const data = [
  { id: 1, name: 'Anderson Abat', email: 'abat@unitru.edu.pe', area: 'MKT' },
  { id: 2, name: 'Anthony Osorio', email: 'anthony@unitru.edu.pe', area: 'TI' },
  { id: 3, name: 'Luciana Huertas', email: 'luciana.huertas@unitru.edu.pe', area: 'RRHH' },
  { id: 4, name: 'Javier Paredes', email: 'paredes.javier@unitru.edu.pe', area: 'FINANZAS' },
  { id: 5, name: 'María Alegría', email: 'maria.alegria@unitru.edu.pe', area: 'LOGÍSTICA' },
  { id: 6, name: 'César Chacón', email: 'cesar.chacon@unitru.edu.pe', area: 'TI' },
  { id: 7, name: 'Daniela Quispe', email: 'dani.quispe@unitru.edu.pe', area: 'PLANIFICACIÓN' },
  { id: 8, name: 'Jorge Huamán', email: 'jorge.huaman@unitru.edu.pe', area: 'OPERACIONES' },
  { id: 9, name: 'Sofía Gonzales', email: 'sofia.gonzales@unitru.edu.pe', area: 'MKT' },
  { id: 10, name: 'Alonso Salazar', email: 'alonso.salazar@unitru.edu.pe', area: 'TI' },
  { id: 11, name: 'Carla Ramos', email: 'carla.ramos@unitru.edu.pe', area: 'LOGÍSTICA' },
  { id: 12, name: 'Manuel Gutiérrez', email: 'manuel.gutierrez@unitru.edu.pe', area: 'RRHH' },
  { id: 13, name: 'Valeria Uceda', email: 'valeria.uceda@unitru.edu.pe', area: 'FINANZAS' },
  { id: 14, name: 'Pedro Vilca', email: 'pedro.vilca@unitru.edu.pe', area: 'OPERACIONES' },
  { id: 15, name: 'Gabriela Ponce', email: 'gabriela.ponce@unitru.edu.pe', area: 'MKT' },
  { id: 16, name: 'Ricardo Alvarado', email: 'ricardo.alvarado@unitru.edu.pe', area: 'TI' },
  { id: 17, name: 'Fernanda Ortiz', email: 'fernanda.ortiz@unitru.edu.pe', area: 'RRHH' },
  { id: 18, name: 'Hugo Fernández', email: 'hugo.fernandez@unitru.edu.pe', area: 'FINANZAS' },
  { id: 19, name: 'Andrea Meza', email: 'andrea.meza@unitru.edu.pe', area: 'PLANIFICACIÓN' },
  { id: 20, name: 'Cristian Oliva', email: 'cristian.oliva@unitru.edu.pe', area: 'LOGÍSTICA' },

  // Añade más datos aquí
];

let currentPage = 1;
const rowsPerPage = 10;

// Función para renderizar la tabla
function renderTable() {
  const tbody = document.querySelector("table tbody");
  tbody.innerHTML = "";

  const start = (currentPage - 1) * rowsPerPage;
  const end = start + rowsPerPage;
  const rows = data.slice(start, end);

  rows.forEach((row, index) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td><input type="checkbox" class="row-checkbox" data-id="${row.id}"></td>
      <td>${start + index + 1}</td>
      <td>${row.name}</td>
      <td>${row.email}</td>
      <td>${row.area}</td>
    `;
    tbody.appendChild(tr);
  });

  // Actualizar información de filas visibles
  document.getElementById("rows-info").textContent = `${start + 1}-${Math.min(
    end,
    data.length
  )} de ${data.length}`;
  document.getElementById("prev-page").disabled = currentPage === 1;
  document.getElementById("next-page").disabled = end >= data.length;

  // Lógica para seleccionar todos los checkboxes
  const selectAllCheckbox = document.getElementById("select-all");
  const rowCheckboxes = document.querySelectorAll(".row-checkbox");
  selectAllCheckbox.checked = false;

  selectAllCheckbox.addEventListener("change", () => {
    rowCheckboxes.forEach((checkbox) => {
      checkbox.checked = selectAllCheckbox.checked;
    });
  });
}

// Evento para manejar cambios en los checkboxes individuales
document.addEventListener("change", (e) => {
  if (e.target.classList.contains("row-checkbox")) {
    const rowCheckboxes = document.querySelectorAll(".row-checkbox");
    const selectAllCheckbox = document.getElementById("select-all");
    const allChecked = Array.from(rowCheckboxes).every(
      (checkbox) => checkbox.checked
    );
    selectAllCheckbox.checked = allChecked;
  }
});

// Navegación entre páginas
document.getElementById("prev-page").addEventListener("click", () => {
  currentPage--;
  renderTable();
});

document.getElementById("next-page").addEventListener("click", () => {
  currentPage++;
  renderTable();
});

// Búsqueda en tiempo real
document.getElementById("search").addEventListener("input", (e) => {
  const term = e.target.value.toLowerCase();
  const filteredData = data.filter((row) =>
    Object.values(row)
      .some((val) => val.toString().toLowerCase().includes(term))
  );

  // Renderizar tabla con los datos filtrados
  const tbody = document.querySelector("table tbody");
  tbody.innerHTML = "";

  filteredData.forEach((row, index) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td><input type="checkbox" class="row-checkbox" data-id="${row.id}"></td>
      <td>${index + 1}</td>
      <td>${row.name}</td>
      <td>${row.email}</td>
      <td>${row.area}</td>
    `;
    tbody.appendChild(tr);
  });

  document.getElementById(
    "rows-info"
  ).textContent = `Mostrando ${filteredData.length} resultados`;
});

// Inicializar la tabla
renderTable();

// =================== EVENTOS PARA INPUT DE TEXTO ===================
const textInput = document.querySelector(".text-input");

textInput.addEventListener("focus", () => {
  console.log("El campo de texto está enfocado");
});

textInput.addEventListener("blur", () => {
  console.log("El campo de texto perdió el enfoque");
});

// =================== EVENTOS PARA FECHAS ===================
// Esperar a que el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
  // Inicializar Flatpickr en el campo con id="datepicker"
  flatpickr("#datepicker", {
    enableTime: false, // Deshabilitar la selección de hora
    dateFormat: "Y-m-d", // Formato de la fecha (Año-Mes-Día)
    locale: "es", // Configuración regional en español
    altInput: true, // Campo de texto con formato alternativo
    altFormat: "F j, Y", // Mostrar formato legible (ejemplo: Enero 13, 2024)
    minDate: "today", // Fecha mínima, solo permite desde hoy en adelante
    maxDate: "2024-12-31", // Fecha máxima opcional
  });

  // Agregar funcionalidad de limpiar formulario
  document.getElementById("limpiar").addEventListener("click", function () {
    document.getElementById("datepicker").value = ""; // Limpiar el campo de fecha
    document.getElementById("nombre").value = ""; // Limpiar el campo de nombre
    document.getElementById("tipo").value = ""; // Limpiar el campo de tipo
    document.getElementById("descripcion").value = ""; // Limpiar la descripción
  });

  // Agregar funcionalidad de guardar (ejemplo básico)
  document.getElementById("guardar").addEventListener("click", function () {
    const fechaSeleccionada = document.getElementById("datepicker").value;
    const nombre = document.getElementById("nombre").value;
    const tipo = document.getElementById("tipo").value;
    const descripcion = document.getElementById("descripcion").value;

    if (!fechaSeleccionada || !nombre || !tipo || !descripcion) {
      alert("Por favor, completa todos los campos antes de guardar.");
      return;
    }

    // Ejemplo de guardar la información (puedes integrar con backend aquí)
    alert(`Datos guardados:\n- Fecha: ${fechaSeleccionada}\n- Nombre: ${nombre}\n- Tipo: ${tipo}\n- Descripción: ${descripcion}`);
  });
});
