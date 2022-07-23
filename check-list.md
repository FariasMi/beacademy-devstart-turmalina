## Índice

-   [Descrição Projeto Empresarial](#projeto-empresarial)
-   [Requisitos](#requisitos)
-   [Cadastro de Usuários](#cadastro-de-usuários)
-   [Cadastro de Produtos](#cadastro-de-produtos)
-   [Cadastro de Pedidos](#cadastro-de-pedidos)
-   [Checkout](#checkout)
-   [Atualização de status do Pagamento](#atualização-de-status-do-pagamento)

# Projeto Empresarial

Criar um **CHECKOUT** para uma **PLATAFORMA** de **VENDAS ONLINE**

Este checkout será criado em PHP, utilizando a Framework Laravel

_O contexto deste projeto é mínimo no que diz respeito a operações de e-commerce e foca na efetivação do pagamento, portanto questões como logística, descontos e afins não serão levados em consideração na descrição e execução do projeto._

## Requisitos

-   [X] Banco de dados Mysql
-   [X] Autenticação e Cadastro de Usuários
-   [X] Cadastro de Produtos
-   [ ] Cadastro de Pedidos
-   [ ] Checkout
-   [X] Api de **Paylivre** para efetivação dos pagamentos (anexar documentação)
-   [ ] Criação de testes unitários para todas as regras de negócio

## Regras de negócio -------------------------------

### Cadastro de Usuários

Deverá possuir 2 tipos de cadastro. Um “Administrador” que será responsável por realizar o cadastro de produtos na plataforma, também poderá visualizar e gerenciar os pedidos de todos os usuários. Para o usuário “Padrão” este poderá apenas escolher os produtos desejados e realizar a compra na plataforma, em sua área restrita poderá ver os próprios pedidos.

Os dados básicos de cadastro de usuários são:

-   [X] Nome
-   [X] E-mail
-   [X] Telefone
-   [X] Endereço
-   [ ] Data de nascimento
-   [X] CPF

### Cadastro de Produtos

Para o cadastro de produtos, deverá ser possível cadastrar as seguintes informações

-   [X] Nome do produto
-   [X] Descrição do produto
-   [X] Quantidade
-   [ ] Preço de custo
-   [X] Preço de venda
-   [ ] Foto principal

### Cadastro de Pedidos

O cadastro de pedidos ocorrerá durante o processo de checkout, uma vez que o cliente selecinar os produtos que deseja adquirir e realizar o pagamento. Será importante registrar para o Cadastro de Pedidos os **produtos que foram adquiridos**, o **cliente que comprou** assim como o **status do pagamento**.

### Checkout

Durante o checkout, o cliente deverá selecionar os produtos que deseja adquirir e definir a forma de pagamento - para efetivação de pagamento utilizaremos a solução da Paylivre. Após realizar o pagamento, o cliente deverá ser informado sobre o status do seu pagamento: sendo **Aprovado**, **Recusado** ou **Processando**.

### Atualização de status do pagamento

O sistema deverá possuir uma rotina para monitorar os pagamentos que estiverem sendo processados. Utilizaremos o serviço de webhook da Paylivre.

**Notificações**

-   [ ] O cliente recebe um e-mail toda vez que um novo pedido é realizado
-   [ ] O cliente recebe um e-mail toda vez que algum pedido sofre alteração de status
