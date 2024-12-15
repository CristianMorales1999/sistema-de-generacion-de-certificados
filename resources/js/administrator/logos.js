// Datos de la tabla
const data = [
    {
        id: 1,
        nombre: 'Taller template',
        imagen: 'taller.png',
        estado: 'activo',
    },
    {
        id: 2,
        nombre: 'Ponencia template',
        imagen: 'ponencia.png',
        estado: 'activo',
    },
    {
        id: 3,
        nombre: 'Conferencia template',
        imagen: 'conferencia.png',
        estado: 'inactivo',
    },
];

// Configuración de paginación
let currentPage = 1;
const rowsPerPage = 10;

// Función para renderizar la tabla
function renderTable(dataSubset) {
    const tbody = document.querySelector('table tbody');
    tbody.innerHTML = ''; // Limpiar el contenido anterior

    if (dataSubset.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="no-data">Sin datos disponibles</td></tr>';
        return;
    }

    dataSubset.forEach((row) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><input type="checkbox" class="row-checkbox" data-id="${row.id}"></td>
            <td>${row.id}</td> <!-- Mostrar ID correctamente -->
            <td>${row.nombre}</td>
            <td><img src="../images/firmas/${row.imagen}" alt="Firma" style="width:50px; height:auto;"></td>
            <td>${row.estado}</td>
        `;
        tbody.appendChild(tr); // Añadir la fila al cuerpo de la tabla
    });
}

// Función para actualizar la información de paginación
function updatePaginationInfo(filteredDataLength = data.length) {
    const totalRows = filteredDataLength;
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
        checkboxes.forEach((checkbox) => (checkbox.checked = selectAllCheckbox.checked));
    });

    // Actualizar el estado del "Seleccionar todo"
    document.addEventListener('change', (e) => {
        if (e.target.classList.contains('row-checkbox')) {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            const allChecked = Array.from(checkboxes).every((checkbox) => checkbox.checked);
            selectAllCheckbox.checked = allChecked;
        }
    });

    // Búsqueda en tiempo real
    document.getElementById('search').addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const filteredData = data.filter((row) =>
            Object.values(row).some((val) => val.toString().toLowerCase().includes(searchTerm))
        );
        currentPage = 1; // Resetear a la primera página en cada búsqueda
        renderTable(filteredData.slice(0, rowsPerPage));
        updatePaginationInfo(filteredData.length);
    });
}

// Inicialización de la tabla
function initializeTable() {
    changePage(1); // Renderizar la primera página
    initEventListeners(); // Configurar eventos
}

// Llamada para inicializar
initializeTable();
