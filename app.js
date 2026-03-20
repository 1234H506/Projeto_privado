const express = require('express');
const mysql = require('mysql2');
const cors = require('cors');
const app = express();

app.use(cors({
    origin: '*', // Permite qualquer origem (ideal para fase de teste)
    methods: ['GET', 'POST'],
    allowedHeaders: ['Content-Type']
}));

// Configurar a conexão
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'homespace'
});

// Teste a conexão
connection.connect(err => {
    if (err) throw err;
    console.log("Conectado ao MySQL!");
});

// Criando o caminho para os dados
app.get('/dados-grafico', (req, res) => {
    const sql = `
        SELECT a.Servicos, COUNT(i.ID_Imoveis) AS total
        FROM imoveis i, agentes a
        WHERE i.Agentes_ID_Agentes = a.ID_Agentes
        GROUP BY a.Servicos
        ORDER BY a.Servicos ASC;
    `;

    connection.query(sql, (err, results) => {
        if (err) {
            return res.status(500).send(err);
        }
        
        // Transformando a tabela do banco em uma lista simples: [55, 30, 15]
        const valores = results.map(linha => linha.total);
        
        // Enviando para o navegador
        res.json(valores);
    });
});

// Iniciar o servidor na porta 3000
app.listen(3000, () => {
    console.log("Servidor rodando em http://localhost:3000");
});