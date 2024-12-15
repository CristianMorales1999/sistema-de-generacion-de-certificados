// Selección de elementos del modal
const modalRol = document.getElementById('modalRol');
const closeModalRol = document.getElementById('closeModalRol');
const roleInput = document.getElementById('roleInput');

// Variables para almacenar información relacionada con cada opción
const roles = {
  firma2: [],
  firma3: [],
  firma4: []
};

// Función para abrir el modal y asociarlo a la opción seleccionada
function openModal(option) {
  modalRol.dataset.target = option; // Almacena la opción activa
  modalRol.classList.remove('hidden');
  modalRol.classList.add('visible');
}

// Función para cerrar el modal
function closeModal() {
  modalRol.classList.add('hidden');
  modalRol.classList.remove('visible');
}

// Evento para cerrar el modal al hacer clic en "Cerrar"
closeModalRol.addEventListener('click', closeModal);

// Evento para cerrar el modal al hacer clic fuera de él
modalRol.addEventListener('click', (e) => {
  if (e.target === modalRol) closeModal();
});

// Evento para guardar el rol ingresado en la opción correspondiente
document.getElementById('addRoleForm').addEventListener('submit', (e) => {
  e.preventDefault(); // Evita recargar la página
  const target = modalRol.dataset.target;
  const newRole = roleInput.value.trim();

  if (newRole) {
    roles[target].push(newRole); // Guarda el rol en la opción activa
    alert(`Rol "${newRole}" guardado en ${target}`);
    roleInput.value = ''; // Limpia el campo de entrada
    closeModal();
  }
});

// Evento para cerrar el modal con la tecla "Esc"
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape' && modalRol.classList.contains('visible')) closeModal();
});
