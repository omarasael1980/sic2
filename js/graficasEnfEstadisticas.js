// Gráfica de barras o pie

var graficaMontoDisponible = document.getElementById('graficaDisponible').getContext('2d');
var graficaCategoria = document.getElementById('graficoCategoria').getContext('2d');
//var graficaCategorias= document.getElementById('graficaCategorias').getContext('2d');
//graficaBarras(graficaGrupos,(grupos.map(grupo=>grupo.grupo)), (grupos.map(grupo=>grupo.cantidad)), "Casos por Grupo",'pie');
graficaBarras(graficaCategoria,(categorias.map(cat=>cat.categoriaMedica)), (categorias.map(cat=>cat.cantidad)), "Casos por Categoría",'bar');
graficaBarras(graficaMontoDisponible,(disponible.map(m=>m.titulo)), (disponible.map(m=>m.cantidad)), "Seguimiento del monto del seguro escolar",'pie');
function graficaBarras(elemento, etiquetas, datos, titulo,tipo){
var myChart = new Chart(elemento, {
    type: tipo, 
    data: {
        
        labels: etiquetas,
        datasets: [{
            label: titulo,
            data: datos,
           
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(0, 128, 128, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(184, 141, 141, 0.2)',
                'rgba(60, 144, 136, 0.2)',
                'rgba(241, 224, 90, 0.2)',
                'rgba(235, 64, 52, 0.2)',
                'rgba(170, 68, 101, 0.2)',
                'rgba(255, 127, 14, 0.2)'
            
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(0, 128, 128, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(184, 141, 141, 1)',
                'rgba(60, 144, 136, 1)',
                'rgba(241, 224, 90, 1)',
                'rgba(235, 64, 52, 1)',
                'rgba(170, 68, 101, 1)',
                'rgba(255, 127, 14, 1)'
           
            ],
            borderWidth: 1
        }]
    },
    options: {
        
        responsive: true,
        plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: true,
              text: titulo
            }
    }
    }
});
}