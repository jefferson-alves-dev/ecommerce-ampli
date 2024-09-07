# E-commerce Ampli

Este é um projeto simples de e-commerce, desenvolvido em PHP, com funcionalidades de gerenciamento de produtos, contas de usuários e pedidos, além de uma interface administrativa.

## Funcionalidades

- **Administração de Produtos**: Adicione, edite e remova produtos através de uma interface de administração.
- **Gestão de Pedidos**: Visualize, edite e remova pedidos feitos pelos usuários.
- **Sistema de Contas**: Gerencie as contas de administradores e usuários.
- **Upload de Imagens**: Funcionalidade para upload de imagens de produtos.
- **Página Inicial com Destaques**: Exibe produtos e novidades na página principal.

## Estrutura do Projeto

- **admin/**: Contém as páginas de administração, como adição, edição e exclusão de produtos e pedidos.
- **assets/**: Diretório com arquivos estáticos, como CSS, JavaScript e imagens.
  - `css/`: Estilos do site.
  - `js/`: Scripts de interação do site.
  - `imgs/`: Imagens estáticas usadas na interface.
- **index.php**: Página principal do site, responsável por exibir os produtos e novidades.
- **layouts/**: Contém o layout do cabeçalho e rodapé compartilhado entre as páginas.
  - `header.php`: Cabeçalho comum em todas as páginas.
  - `footer.php`: Rodapé comum em todas as páginas.
- **server/**: Contém o arquivo de conexão ao banco de dados.
  - `connection.php`: Configura a conexão com o banco de dados.
- **uploads/**: Pasta onde ficam armazenadas as imagens dos produtos enviados.

## Configuração do Banco de Dados

1. Crie um banco de dados no seu servidor MySQL.
2. Importe o arquivo `project_db.sql`:

   - Acesse o seu MySQL (usando phpMyAdmin, linha de comando ou outra interface) e execute o script `project_db.sql` para criar as tabelas necessárias.
   - Comando para importar via terminal:

     ```bash
     mysql -u username -p database_name < project_db.sql
     ```

     Substitua `username` pelo nome do usuário MySQL, e `database_name` pelo nome do banco de dados que você criou.

3. Abra o arquivo `server/connection.php` e atualize as credenciais de conexão com o banco de dados:

   ```php
   $host = "localhost";
   $user = "root";
   $pass = "";
   $db = "project_db";
   ```

4. Teste a conexão acessando o site no navegador. Se houver algum erro de conexão, verifique as credenciais no arquivo `connection.php`.
