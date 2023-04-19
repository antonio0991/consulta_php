SELECT
  b.nome AS nome_banco,
  c.verba AS verba,
  MIN(cont.data_inclusao) AS data_contrato_antigo,
  MAX(cont.data_inclusao) AS data_contrato_novo,
  SUM(cont.valor) AS soma_valor_contratos
FROM
  Tb_contrato cont
WHERE
  cont.convenio_servico = cs.codigo
  AND cs.convenio = c.codigo
  AND c.banco = b.codigo
GROUP BY
  b.nome,
  c.verba