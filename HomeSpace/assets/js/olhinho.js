// const { response } = require("express");

// Função que recolhe  o id do input e id do icon para fazer a função de mostra e não mostra senha
function mostrarSenha(inputId, iconId) {
    const senha = document.getElementById(inputId);
    const btnSenha = document.getElementById(iconId);
    if (senha.type === 'password') {
        senha.type = 'text';
        btnSenha.classList.replace('bi-eye-slash', 'bi-eye');
    } else {
        senha.type = 'password';
        btnSenha.classList.replace('bi-eye', 'bi-eye-slash');
    }
}

// Select do agente na página (agents.php)
document.addEventListener("DOMContentLoaded", function () {
    const campoBusca = document.getElementById("search");
    if (campoBusca) {
        campoBusca.addEventListener("keyup", function () {
            let filtro = this.value.toLowerCase();
            let cards = document.querySelectorAll(".agent-item");
            cards.forEach(function (card) {
                let texto = card.innerText.toLowerCase();
                if (texto.includes(filtro)) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            });
        });
    }
});

// Isso ativa os tooltips assim que a página(agents.php) carrega as informações no ícone
document.addEventListener("DOMContentLoaded", function () {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
});

// Ajax
// Search de imóveis - Pega o ID e faz o evento quando for clicado

const btnProcurar = document.getElementById("Btn_de_filtragem");

if (btnProcurar) {
    btnProcurar.addEventListener("click", function () {

        // Todos os ids em variável
        const localizacao = document.getElementById('localizacao').value;
        const tipo = document.getElementById('tipo').value;
        const preco = document.getElementById('preco').value;
        const idAgente = document.getElementById('idAgente').value;


        // Criamos um objeto para passar os valores em de um vez
        const formData = new FormData();
        formData.append('localizacao', localizacao);
        formData.append('tipo', tipo);
        formData.append('preco', preco);
        formData.append('Id_Do_Agente', idAgente);


        // para qual arquiva será enviados os dados
        fetch('../propriedades/buscar_imoveis.php', {
            method: 'POST',
            body: formData

        })

            .then(response => response.text())
            .then(dados => {
                document.getElementById('lista_imoveis').innerHTML = dados;
            });

    });
}



let paginaSelecionada = 1;
let tipologiaSelecionada = "any";

// ==================== REBIND DE EVENTOS (essencial após AJAX) ====================
function rebindFilters() {
    // Botões de tipologia (dentro do #resultado)
    const bedButtons = document.querySelectorAll("#resultado .bed-btn");
    bedButtons.forEach(button => {
        button.addEventListener("click", function () {
            tipologiaSelecionada = this.getAttribute("data-beds");
            console.log("Tipologia escolhida:", tipologiaSelecionada);
            bedButtons.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
        });
    });

    // Mantém o botão ativo correto (o servidor já manda com a classe)
    bedButtons.forEach(btn => {
        if (btn.getAttribute("data-beds") === tipologiaSelecionada) {
            btn.classList.add("active");
        } else {
            btn.classList.remove("active");
        }
    });

    // Botão "Procurar"
    const btnFiltragem = document.getElementById("btn_filtragem.php");
    if (btnFiltragem) {
        btnFiltragem.addEventListener("click", function () {
            paginaSelecionada = 1;
            enviarFiltragem();
        });
    }
}

// ==================== PAGINAÇÃO (clique em qualquer número ou seta) ====================
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("paginacao")) {
        e.preventDefault();                    // ← ESSENCIAL
        paginaSelecionada = e.target.getAttribute("data-page");
        console.log("Página clicada:", paginaSelecionada);
        enviarFiltragem();
    }
});

// ==================== AJAX ====================
function enviarFiltragem() {
    const localizacao = document.getElementById("localizacao").value;
    const tipo = document.getElementById("tipo").value;
    const acao = document.getElementById("acao").value;

    const formData = new FormData();
    formData.append('localizacao', localizacao);
    formData.append('tipo', tipo);
    formData.append('acao', acao);
    formData.append('tipologia', tipologiaSelecionada);
    formData.append('page', paginaSelecionada);

    fetch('../propriedades/btn_filtragem.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(dados => {
        document.getElementById("resultado").innerHTML = dados;
        rebindFilters();          // ← RECRIA os eventos
    })
    .catch(err => console.error("Erro AJAX:", err));
}

// ==================== INICIALIZA NA PRIMEIRA CARGA ====================
rebindFilters();
