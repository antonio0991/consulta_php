<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "usuario", "senha", "nome_banco");

// Verificação de erros na conexão
if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}

// Consulta SQL com JOIN nas tabelas necessárias
$sql = "SELECT banco.nome, convenio.verba, contrato.codigo, contrato.data_inclusao, contrato.valor, contrato.prazo
        FROM Tb_contrato contrato, Tb_convenio convenio, Tb_banco banco, Tb_convenio_servico servico
        WHERE banco.codigo = convenio.banco
          AND convenio.codigo = servico.convenio
          AND convenio.codigo = contrato.convenio_servico";

// Execução da consulta e armazenamento dos resultados em uma variável
$resultado = $conn->query($sql);

// Verificação de erros na execução da consulta
if ($resultado === false) {
  die("Falha na consulta: " . $conn->error);
}

// Exibição dos resultados em uma tabela HTML
echo "<table>";
echo "<tr><th>Nome do banco</th><th>Verba</th><th>Código do contrato</th><th>Data de inclusão</th><th>Valor</th><th>Prazo</th></tr>";
while ($row = $resultado->fetch_assoc()) {
  echo "<tr><td>" . $row["nome"] . "</td><td>" . $row["verba"] . "</td><td>" . $row["codigo"] . "</td><td>" . $row["data_inclusao"] . "</td><td>" . $row["valor"] . "</td><td>" . $row["prazo"] . "</td></tr>";
}
echo "</table>";

// Fechamento da conexão com o banco de dados
$conn->close();
?>