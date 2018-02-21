## Desafio Técnico

### Stacks Utilizadas
- PHP 7
- Laravel 5.5
- MySQL
- Docker

### Executando o Projeto

Possuindo o docker instalado em sua maquina, juntamente com o docker compose. Para executar o projeto será necessário apenas rodar o comando:

    docker-compose up -d

### Sobre o Projeto

O padrão adotado na arquitetura do projeto foi seguindo as padronizações do framework Laravel, cuja se baseia no MVC. 
Aplicação possui algumas rotas de integração através de uma API. Segue abaixo as lista de rotas com suas considerações:

    POST /api/buyers
 Está rota tem como função criar novos compradores para que possam efetuar pagamentos para o derivado cliente.

    POST api/cards/token
Passando como parâmetro via json o **buyer_id**, a função desta rota e gerar o token, que será vinculado ao **Buyer**,  para encriptação dos dados do mesmo, para segurança das informações que serão vinculadas, como por exemplo o número do cartão de credito e seu número verificador.

    POST api/cards/validate
 Com token gerado, há possibilidade de validar o número do cartão de credito, sabendo sua bandeira e juntamente obtendo a logo da bandeira que é vinculada ao determinado número do cartão informado.

    POST api/payments/creditcard
  Com todos seus dados devidamente preenchidos e o cartão de credito validado, utilize esta rota caso o comprador escolha a opção de pagamento através do cartão de credito, com isso encriptando as informações do cartão como numero e código verificador. Com os dados enviados esta rota lhe retornará todas as informações referente ao pagamento, caso queira abstrair estas informações e utiliza-las posteriormente.

    POST api/payments/boleto
 Caso o comprador selecione o pagamento através do boleto. Possuindo as informações de pagamento, utilize esta rota como tal. O mesmo será processado e ira lhe retornar as informações de pagamento juntamente com o número do boleto.


    GET api/payments/status?payment=:id_pagamento
 Utilize esta rota quando necessitar de obter o status referente ao pagamento desejado, passando como parâmetro o id do pagamento que obteve na ultima requisição de pagamento pelo cartão de credito ou através do boleto.
