// Asegúrate de que el script esté conectado al DOM correctamente.
document.addEventListener("DOMContentLoaded", () => {
    // Crear el gráfico interactivo con Chart.js
    const ctx = document.getElementById("certificadosChart").getContext("2d");
  
    // Configuración de datos y estilo del gráfico
    const certificadosChart = new Chart(ctx, {
      type: "line", // Tipo de gráfico
      data: {
        labels: ["Ene 2024", "Feb 2024", "Mar 2024", "Abr 2024", "May 2024", "Jun 2024", "Jul 2024"],
        datasets: [
          {
            label: "Certificados",
            data: [100, 200, 300, 440, 380, 410, 390], // Valores del gráfico
            borderColor: "#7F59F8", // Color de la línea
            fill: false, // Sin relleno debajo de la línea
            tension: 0.3, // Suavidad de la curva
          },
        ],
      },
      options: {
        responsive: true, // El gráfico se adapta al tamaño del contenedor
        plugins: {
          legend: {
            display: false, // Oculta la leyenda
          },
        },
      },
    });
  });
  