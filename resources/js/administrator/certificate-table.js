// Datos de la tabla
const data = [ 
    { id: 1, code: 'A001', titular: 'Juan Pérez', group: 'Ventas', date: '2023-01-01', status: 'Activo' },
    { id: 2, code: 'A002', titular: 'María Gómez', group: 'TI', date: '2023-02-15', status: 'Inactivo' },
    { id: 3, code: 'A003', titular: 'Carlos López', group: 'Finanzas', date: '2023-03-20', status: 'Activo' },
    { id: 4, code: 'A004', titular: 'Ana Martínez', group: 'Recursos Humanos', date: '2023-04-10', status: 'Activo' },
    { id: 5, code: 'A005', titular: 'Luis Ramírez', group: 'Logística', date: '2023-05-05', status: 'Inactivo' },
    { id: 6, code: 'A006', titular: 'Laura Fernández', group: 'Marketing', date: '2023-06-18', status: 'Activo' },
    { id: 7, code: 'A007', titular: 'Pedro Sánchez', group: 'Ventas', date: '2023-07-12', status: 'Activo' },
    { id: 8, code: 'A008', titular: 'Sofía Castro', group: 'TI', date: '2023-08-23', status: 'Inactivo' },
    { id: 9, code: 'A009', titular: 'Jorge Díaz', group: 'Finanzas', date: '2023-09-14', status: 'Activo' },
    { id: 10, code: 'A010', titular: 'Isabel Torres', group: 'Recursos Humanos', date: '2023-10-01', status: 'Activo' },

  ];
  
  // Configuración de paginación
  let currentPage = 1;
  const rowsPerPage = 10;
  
  // Función para renderizar la tabla
  function renderTable(dataSubset) {
    const tbody = document.querySelector('table tbody');
    tbody.innerHTML = ''; // Limpiar el contenido anterior
  
    dataSubset.forEach((row, index) => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td><input type="checkbox" class="row-checkbox" data-id="${row.id}"></td>
        <td>${row.id}</td>
        <td>${row.code}</td>
        <td>${row.titular}</td>
        <td>${row.group}</td>
        <td>${row.date}</td>
        <td>${row.status}</td>
      `;
      tbody.appendChild(tr);
    });
  }
  
  // Función para actualizar la información de paginación
  function updatePaginationInfo() {
    const totalRows = data.length;
    const startRow = (currentPage - 1) * rowsPerPage + 1;
    const endRow = Math.min(currentPage * rowsPerPage, totalRows);
  
    document.getElementById('rows-info').textContent = `${startRow}-${endRow} de ${totalRows}`;
    document.getElementById('prev-page').disabled = currentPage === 1;
    document.getElementById('next-page').disabled = currentPage * rowsPerPage >= totalRows;
  }
  
  // Función para manejar el cambio de página
  function changePage(newPage) {
    currentPage = newPage;
    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;
  
    const dataSubset = data.slice(start, end);
    renderTable(dataSubset);
    updatePaginationInfo();
  }
  
  // Función para inicializar eventos
  function initEventListeners() {
    // Botones de paginación
    document.getElementById('prev-page').addEventListener('click', () => {
      if (currentPage > 1) {
        changePage(currentPage - 1);
      }
    });
  
    document.getElementById('next-page').addEventListener('click', () => {
      if (currentPage * rowsPerPage < data.length) {
        changePage(currentPage + 1);
      }
    });
  
    // Seleccionar todos los checkboxes
    const selectAllCheckbox = document.getElementById('select-all');
    selectAllCheckbox.addEventListener('change', () => {
      const checkboxes = document.querySelectorAll('.row-checkbox');
      checkboxes.forEach(checkbox => (checkbox.checked = selectAllCheckbox.checked));
    });
  
    // Actualizar el estado del "Seleccionar todo"
    document.addEventListener('change', e => {
      if (e.target.classList.contains('row-checkbox')) {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
        selectAllCheckbox.checked = allChecked;
      }
    });
  
    // Búsqueda en tiempo real
    document.getElementById('search').addEventListener('input', e => {
      const searchTerm = e.target.value.toLowerCase();
      const filteredData = data.filter(row =>
        Object.values(row).some(val => val.toString().toLowerCase().includes(searchTerm))
      );
      currentPage = 1; // Resetear a la primera página en cada búsqueda
      changePage(1);
      renderTable(filteredData.slice(0, rowsPerPage));
      updatePaginationInfo();
    });
  }
  
  // Inicialización de la tabla
  function initializeTable() {
    changePage(1); // Renderizar la primera página
    initEventListeners(); // Configurar eventos
  }
  
  // Llamada para inicializar
  initializeTable();
  