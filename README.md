# Api-nomes
Api de busca de nomes pelo site do IBGE
INTEGRANTES - Hellen Novaes e Vinicius stegani 

Este projeto utiliza a API do IBGE para buscar a frequência de nomes registrados no Brasil. O usuário pode pesquisar por qualquer nome e aplicar filtros opcionais de frequência mínima e máxima. Os resultados são exibidos diretamente na página, dentro de uma caixa estilizada.

Como Funciona
O usuário digita um nome e aplica filtros opcionais:

Exemplo: "hellen", frequência mínima: 100, frequência máxima: 3000.

O formulário envia os dados para o servidor:

O servidor consulta a API do IBGE com o nome informado.

Se a API retornar resultados, o servidor filtra os dados com base nos critérios definidos (frequência mínima e máxima).

Os resultados são exibidos na página:

Os dados aparecem em uma caixa estilizada, com o período e a frequência para o nome pesquisado.

Caso queira testar , Digite um nome no campo de busca, deixe em branco e clique em "Buscar". ira retornar ( Nenhum resultado encontrado para os filtros aplicados.)

Se ao digitar um nome e uma frequência e nada for retornado significa que não possui esse nome nesse ano.

Ao digitar uma frequência minima digite numeros de valor acima de 100 , possui mais chances de ser encontrado .
