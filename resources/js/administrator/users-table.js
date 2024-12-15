// Datos de la tabla
const data = [
    {
        id: 1,
        nombre: 'Juan',
        apellidos: 'Pérez',
        correo: 'juan.perez@example.com',
        area: 'Marketing',
        cargo: 'Director',
        firma: 'firma1.png',
        contacto: '909011234',
        sexo: 'Masculino'
    },
    {
        id: 2,
        nombre: 'María',
        apellidos: 'Gómez',
        correo: 'maria.gomez@example.com',
        area: 'TI',
        cargo: 'Desarrolladora',
        firma: 'firma2.png',
        contacto: '989895678',
        sexo: 'Femenino'
    },
    {
        id: 3,
        nombre: 'Carlos',
        apellidos: 'López',
        correo: 'carlos.lopez@example.com',
        area: 'Finanzas',
        cargo: 'Contador',
        firma: 'firma3.png',
        contacto: '918398765',
        sexo: 'Masculino'
    },
    {
        id: 4,
        nombre: 'Ana',
        apellidos: 'Ramírez',
        correo: 'ana.ramirez@example.com',
        area: 'Recursos Humanos',
        cargo: 'Coordinadora',
        firma: 'firma4.png',
        contacto: '912345678',
        sexo: 'Femenino'
    },
    {
        id: 5,
        nombre: 'Luis',
        apellidos: 'Torres',
        correo: 'luis.torres@example.com',
        area: 'Logística',
        cargo: 'Encargado de Proyectos',
        firma: 'firma5.png',
        contacto: '901234567',
        sexo: 'Masculino'
    },
    {
        id: 6,
        nombre: 'Sofía',
        apellidos: 'Mendoza',
        correo: 'sofia.mendoza@example.com',
        area: 'Marketing',
        cargo: 'Diseñadora Gráfica',
        firma: 'firma6.png',
        contacto: '923456789',
        sexo: 'Femenino'
    },
    {
        id: 7,
        nombre: 'Pedro',
        apellidos: 'Castro',
        correo: 'pedro.castro@example.com',
        area: 'TI',
        cargo: 'Administrador de Sistemas',
        firma: 'firma7.png',
        contacto: '934567890',
        sexo: 'Masculino'
    },
    {
        id: 8,
        nombre: 'Lucía',
        apellidos: 'Vega',
        correo: 'lucia.vega@example.com',
        area: 'Finanzas',
        cargo: 'Analista Financiera',
        firma: 'firma8.png',
        contacto: '945678901',
        sexo: 'Femenino'
    },
    {
        id: 9,
        nombre: 'Diego',
        apellidos: 'Paredes',
        correo: 'diego.paredes@example.com',
        area: 'Eventos',
        cargo: 'Organizador',
        firma: 'firma9.png',
        contacto: '956789012',
        sexo: 'Masculino'
    },
    {
        id: 10,
        nombre: 'Valeria',
        apellidos: 'Ruiz',
        correo: 'valeria.ruiz@example.com',
        area: 'Comunicación',
        cargo: 'Relaciones Públicas',
        firma: 'firma10.png',
        contacto: '967890123',
        sexo: 'Femenino'
    }
    
];

// Configuración de paginación
let currentPage = 1;
const rowsPerPage = 10;

// Función para renderizar la tabla
function renderTable(dataSubset) {
    const tbody = document.querySelector('table tbody');
    tbody.innerHTML = ''; // Limpiar el contenido anterior

    dataSubset.forEach(row => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><input type="checkbox" class="row-checkbox" data-id="${row.id}"></td>
            <td>${row.nombre}</td>
            <td>${row.apellidos}</td>
            <td>${row.correo}</td>
            <td>${row.area}</td>
            <td>${row.cargo}</td>
            <td><img src="../images/firmas/${row.firma}" alt="Firma" style="width:50px; height:auto;"></td>
            <td>${row.contacto}</td>
            <td>${row.sexo}</td>
        `;
        tbody.appendChild(tr);
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
