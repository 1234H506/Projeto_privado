// 'Search' de busca 
// 'Search' de busca 
// 'Search' de busca 

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('[data-search]').forEach(input => {

        const container = document.querySelector(input.dataset.target);
        const itemSelector = input.dataset.item;

        input.addEventListener('keyup', function () {
            const termo = this.value.toLowerCase();
            const items = container.querySelectorAll(itemSelector);

            items.forEach(item => {
                const texto = item.innerText.toLowerCase();
                item.style.display = texto.includes(termo) ? '' : 'none';
            });
        });
    });

});


// Seleção de datas que não permite dias futuros 
document.addEventListener('DOMContentLoaded', function () {

    const receberInputData = document.getElementById("inputDataRegistro");

    //  VERIFICAÇÃO ESSENCIAL
    if (receberInputData) {
        const data = new Date().toISOString().split('T')[0];
        receberInputData.setAttribute('max', data);
    }

});



// Pode selecionar só datas futuras (a partir de amanhã)
document.addEventListener('DOMContentLoaded', function () {

    const receberInputData = document.getElementById("inputData");

    if (receberInputData) {

        const hoje = new Date();
        
        // Adiciona 1 dia
        hoje.setDate(hoje.getDate() + 1);

        // Formata para YYYY-MM-DD
        const amanha = hoje.toISOString().split('T')[0];

        receberInputData.setAttribute('min', amanha);
    }

});

