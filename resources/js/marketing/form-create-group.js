// Selección de elementos
const modal = document.getElementById('modal');
const openModalButton = document.getElementById('openModalButton');

// Función para abrir el modal
openModalButton.addEventListener('click', () => {
  modal.classList.remove('hidden');
  modal.classList.add('visible');
});

// Función para cerrar el modal cuando se hace clic fuera del contenido
modal.addEventListener('click', (e) => {
  if (e.target === modal) {
    modal.classList.add('hidden');
    modal.classList.remove('visible');
  }
});

// Opcional: Cerrar el modal presionando la tecla "Esc"
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape' && modal.classList.contains('visible')) {
    modal.classList.add('hidden');
    modal.classList.remove('visible');
  }
});
