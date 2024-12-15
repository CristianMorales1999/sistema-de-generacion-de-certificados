// Datos de la tabla
const data = [
    {
        groupName: 'Taller de DevOps',
        certificateType: 'Participantes',
        description: 'Capacitación sobre prácticas de integración y despliegue continuo',
        startDate: '05/11/2024',
        endDate: '07/11/2024',
        certificateGenerator: 'Christian Morales',
        groupCreator: 'Oscar Juárez',
        signatories: ['Luis Gómez', 'Sofía Torres', 'Ana María', 'Roberto López'],
        template: 'DevOps.jpg',
    },
    {
        groupName: 'Curso de React.js',
        certificateType: 'Egresados',
        description: 'Curso intensivo de desarrollo web con React.js',
        startDate: '15/09/2024',
        endDate: '30/09/2024',
        certificateGenerator: 'Laura Herrera',
        groupCreator: 'María Pérez',
        signatories: ['David Ruiz', 'Claudia Rodríguez', 'Raúl Martínez', 'Ana María'],
        template: 'React.jpg',
    },
    {
        groupName: 'Seminario de Seguridad Cibernética',
        certificateType: 'Asistentes',
        description: 'Evento organizado en colaboración con CiberSegura LATAM',
        startDate: '20/08/2024',
        endDate: '22/08/2024',
        certificateGenerator: 'Christian Morales',
        groupCreator: 'Oscar Juárez',
        signatories: ['Carolina Díaz', 'Miguel Chávez', 'Juliana Vargas', 'Luis Sánchez'],
        template: 'Ciberseguridad.jpg',
    },
    {
        groupName: 'Workshop de UX/UI Design',
        certificateType: 'Certificado de Participación',
        description: 'Taller práctico sobre diseño centrado en el usuario',
        startDate: '01/07/2024',
        endDate: '03/07/2024',
        certificateGenerator: 'Laura Herrera',
        groupCreator: 'Oscar Juárez',
        signatories: ['Andrea Campos', 'Carlos Rojas', 'María Paz', 'Luis Sánchez'],
        template: 'UXUI.jpg',
    },
    {
        groupName: 'Diplomado en Ciencia de Datos',
        certificateType: 'Certificado de Egreso',
        description: 'Diplomado avanzado en análisis de datos y machine learning',
        startDate: '01/01/2024',
        endDate: '30/06/2024',
        certificateGenerator: 'Laura Herrera',
        groupCreator: 'Oscar Juárez',
        signatories: ['Liz Robles', 'Julio Vázquez', 'Ana María', 'Roberto López'],
        template: 'DataScience.jpg',
    },
    {
        groupName: 'Hackathon Innovación 2024',
        certificateType: 'Ganadores',
        description: 'Evento anual de innovación tecnológica',
        startDate: '18/10/2024',
        endDate: '20/10/2024',
        certificateGenerator: 'Christian Morales',
        groupCreator: 'María Pérez',
        signatories: ['Luis Gómez', 'Carlos Rojas', 'Claudia Rodríguez', 'David Ruiz'],
        template: 'Hackathon.jpg',
    },
    {
        groupName: 'Programa de Liderazgo Ágil',
        certificateType: 'Certificado de Participación',
        description: 'Programa intensivo en liderazgo y metodologías ágiles',
        startDate: '01/02/2024',
        endDate: '28/02/2024',
        certificateGenerator: 'Laura Herrera',
        groupCreator: 'Oscar Juárez',
        signatories: ['Juliana Vargas', 'Roberto López', 'Carolina Díaz', 'Miguel Chávez'],
        template: 'Liderazgo.jpg',
    },
    {
        groupName: 'Taller de Metodologías Ágiles',
        certificateType: 'Participantes',
        description: 'Introducción práctica a metodologías como Scrum y Kanban',
        startDate: '15/05/2024',
        endDate: '17/05/2024',
        certificateGenerator: 'Christian Morales',
        groupCreator: 'María Pérez',
        signatories: ['Sofía Torres', 'Luis Sánchez', 'Raúl Martínez', 'Andrea Campos'],
        template: 'Agiles.jpg',
    },
    {
        groupName: 'Bootcamp de Full-Stack Development',
        certificateType: 'Certificado de Finalización',
        description: 'Entrenamiento intensivo en tecnologías frontend y backend',
        startDate: '10/03/2024',
        endDate: '10/06/2024',
        certificateGenerator: 'Laura Herrera',
        groupCreator: 'Oscar Juárez',
        signatories: ['Carlos Rojas', 'Claudia Rodríguez', 'David Ruiz', 'Andrea Campos'],
        template: 'FullStack.jpg',
    },
    {
        groupName: 'Seminario de Inteligencia Artificial',
        certificateType: 'Asistentes',
        description: 'Introducción a la IA aplicada en diversos sectores',
        startDate: '25/09/2024',
        endDate: '27/09/2024',
        certificateGenerator: 'Christian Morales',
        groupCreator: 'María Pérez',
        signatories: ['Ana María', 'Roberto López', 'Liz Robles', 'Carolina Díaz'],
        template: 'IA.jpg',
    }
    // Más datos aquí...
];

// Configuración de paginación
let currentPage = 1;
const rowsPerPage = 10;

// Renderizar tabla
function renderTable(dataSubset) {
    const tbody = document.querySelector('table tbody');
    tbody.innerHTML = ''; // Limpiar contenido anterior

    dataSubset.forEach((row, index) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><input type="checkbox" class="row-checkbox" data-id="${index}"></td>
            <td>${row.groupName}</td>
            <td>${row.certificateType}</td>
            <td>${row.description}</td>
            <td>${row.startDate}</td>
            <td>${row.endDate}</td>
            <td>${row.certificateGenerator}</td>
            <td>${row.groupCreator}</td>
            <td>${row.signatories[0]}</td>
            <td>${row.signatories[1]}</td>
            <td>${row.signatories[2]}</td>
            <td>${row.signatories[3]}</td>
            <td>${row.template}</td>
        `;
        tbody.appendChild(tr);
    });
}

// Paginación
function updatePaginationInfo() {
    const totalRows = data.length;
    const startRow = (currentPage - 1) * rowsPerPage + 1;
    const endRow = Math.min(currentPage * rowsPerPage, totalRows);

    document.getElementById('rows-info').textContent = `${startRow}-${endRow} de ${totalRows}`;
    document.getElementById('prev-page').disabled = currentPage === 1;
    document.getElementById('next-page').disabled = currentPage * rowsPerPage >= totalRows;
}

function changePage(newPage) {
    currentPage = newPage;
    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    renderTable(data.slice(start, end));
    updatePaginationInfo();
}

// Inicialización
function initEventListeners() {
    document.getElementById('prev-page').addEventListener('click', () => {
        if (currentPage > 1) changePage(currentPage - 1);
    });

    document.getElementById('next-page').addEventListener('click', () => {
        if (currentPage * rowsPerPage < data.length) changePage(currentPage + 1);
    });

    document.getElementById('select-all').addEventListener('change', (e) => {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        checkboxes.forEach(checkbox => (checkbox.checked = e.target.checked));
    });

    document.getElementById('search').addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const filteredData = data.filter(row =>
            Object.values(row).some(val =>
                val.toString().toLowerCase().includes(searchTerm)
            )
        );
        currentPage = 1;
        renderTable(filteredData.slice(0, rowsPerPage));
        updatePaginationInfo();
    });
}

// Inicializar tabla
function initializeTable() {
    changePage(1);
    initEventListeners();
}

initializeTable();
