// Configurações globais de fonte (podem ficar fora do fetch)
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// 1. Fazemos a chamada para o seu servidor Node.js
fetch('http://localhost:3000/dados-grafico')
  .then(response => response.json()) // Converte a resposta para JSON (a lista de números)
  .then(dadosVindosDoBanco => {
    
    // 2. Agora que temos os dados, criamos o gráfico
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        // As labels devem bater com a ordem que o SQL retorna (Arrendamento, Venda, etc.)
        labels: ["Arrendamento", "Compras","Vendas"], 
        datasets: [{
          data: dadosVindosDoBanco, // <--- Aqui entram os números do banco! [ex: 10, 5]
          backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
          hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });

  })
  .catch(error => {
    console.error('Erro ao carregar os dados do gráfico:', error);
  });