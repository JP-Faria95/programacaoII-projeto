❗ Seja bem vindo.

✔️ Este é um projeto Web de nível Iniciante com objetivo de criar um sistema de controle de Categorias e Produtos, permitindo o gerenciamento de informações como nome, estoque, valor e status de ativo ou inativo.

💻 Para o desenvolvido desse sistema, foram utilizadas as linguagens de programação PHP e JavaScript para programar o back-end e o front-end, respectivamente.

📝 Recursos auxiliares: Para tornar a aplicação mais dinâmica e visualmente mais agradável, os recursos a seguir foram utilizados:

. Bootstrap em sua versão 3.4.1

. Jquery em sua versão 3.6.0

🛠️ Funcionalidades da aplicação: O sistema permite a existência de dois tipos de usuários, os administradores e os comuns. Os Administradores, cadastrados no banco de dados como 'TIPO_USER' = 1,
tem uma visualização e funcionalidades diferentes em relação à dos usuários comuns.
  
. Um administrador pode: Cadastrar uma nova categoria ou Editar uma já existente, informando 'Nome' e 'Status' (Ativa ou Inativa) bem como Excluir uma categoria da página.
É possível visualizar todas as categorias existentes (mesmo as inativas) ou visualizar os produtos de uma categoria específica.
Assim como as categorias, podem ser Adicionado novos produtos ou Editado os já existentes, informando nome do produto, estoque, valor, status e a qual categoria ele pertence, e até mesmo Excluir um produto.
Por fim, é possível visualizar os vínculos criados pelos usuários comuns com os produtos cadastrados, tendo a possibilidade de excluir um vínculo quando necessário.

. Os usuários comuns: Podem visualizar apenas as categorias atualmente ativas e também visualizar os produtos contidos em categorias específicas, desde que também estejam ativos. A visualização permite que o usuário
saiba o estoque e o valor de cada produto da categoria escolhida, facilitando a escolha. Os produtos podem ser adicionados em um carrinho de compras, e para tal, basta que o usuário informe a quantidade do produto
que deseja comprar. Por fim, é possível visualizar o carrinho de compras, que detalha ao usuário cada produto escolhido, bem como as quantidades, a data em que o produto foi adicionado, o preço por unidade do produto
e o valor total para cada produto. Ao escolher prosseguir com a compra dos produtos, o usuário então visualiza o valor total e pode escolher finalizar a compra.

💻 Para executar este projeto localmente, você deverá:
1) Clone o repositório através do comando "git clone https://github.com/JP-Faria95/programacaoII-projeto.git".
2) Utilizando um programa de ambiente de desenvolvimento web local (utilizei o Laragon na versão V8.4.0), transfira o repositório clonado para a pasta raíz do servidor web.
3) Inicie o ambiente web local, e acesse o phpMyAdmin com suas credenciais.
4) Crie um banco de dados para utilizar no projeto e execute os scripts do arquivo 'tabelas.sql'.
5) Configure o arquivo 'conexao.php' com as credenciais do seu banco de dados local (host,user,senha,nome do banco).
6) Agora você conseguirá acessar a aplicação através do link 'localhost/programacaoII-projeto/index.php'.
7) Dica: Para acessar como um usuário administrador e conferir as funcionalidades, adicione a variável '?admin_teste=true' no final da url.

🧩 Ao desenvolver este projeto, busquei aprofundar meus conhecimentos e habilidades nos recursos de front-end amplamente utilizados como:

. DataTables para construção de tabelas dinâmicas de registros trazidos do back-end

. Modais para trazer fluidez à página e melhorando a experiência do usuário

. Divs e Classes CSS para garantir estruturação, validação e padronização visual para o usuário

. Plugins de selectpicker para aperfeiçoar a utilização de formulários na página

. Jquery que permitiu uma manipulação facilitada dos objetos e eventos no código

👨‍💻 Como estudante, acredito que este projeto tenha agregado para desenvolver minhas habilidades em programação ao atribuir novos conceitos e concretizar aqueles conhecidos previamente.    
