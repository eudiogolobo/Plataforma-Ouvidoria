# Entendendo decisões arquiteturais e a estrutura do projeto

## Requisitos para rodar o projeto 

- Servidor Apache
- Banco de Dados MySQL

### Como rodar na minha máquina?

- Clone o projeto `git clone https://github.com/eudiogolobo/Plataforma-Ouvidoria` dentro do htdocs
- Ligue o Servidor Apache e MySQL
- Insira o arquivo SQL no banco de dados MySQL
- Pronto 🔥🔥

## Estrutura do Projeto

- `./configuration` : Responsável pelo arquivo da Classe de conexão ao banco de dados
- `./public` : Responsável pelas pastas públicas (`/css`, `/img`, `/Js`, `/json`)
   - `./public/css/animationSuccess.css` : Responsável pelo CSS que gera a animação de Check no modal de sucesso
    - `./public/Js/jsStart.js` : Responsável pelo arquivo Javascript que contêm as `functions` a serem utilizadas em todo o site
     - `./public/Js/cities_states.json` : Responsável pelo arquivo JSON que têm as informações de cidades por Estados
- `./vendor` : Contêm todos os arquivos para o funcinamento do [PHPMailer](https://github.com/PHPMailer/PHPMailer)
- `./views` : Responsável pelos arquivos de visualização
- `./views/layout` : Responsável pelos arquivos de visualização padrão `Header` e `Footer`
    - `./views/layout/layoutStart.php` : Responsável pelo arquivo que têm o `Header` e o começo da TAG HTML juntamento com `scripts` utilizados por ele mesmo
    - `./views/layout/layoutEnd.php` : Responsável pelo arquivo que têm o `Footer` e o final da TAG HTML
    - `./views/home.php` : Responsável pelo arquivo de visualização da página `Home` do site
    - `./views/ouvidoria.php` : Responsável pelo arquivo de visualização da página de `Abertura de Ouvidoria` do site
    - `./views/ouvidoriaListar.php` : Responsável pelo arquivo de visualização da página de `Minhas Ouvidorias Abertas`, onde você consegue ver as ouvidorias já abertas em sua conta
- `./Web` : Responsável pelos arquivos que se comunicam com o `Front-end`
    - `./Web/Auth` : Responsável pelo arquivo que têm a Classe Auth onde contêm as funções de `(Login)` e `(Logout) `
    - `./Web/Mail` : Responsável pelos arquivos `(EnviarCodigoVerificacao.php)` (Contêm a Classe `EnviarCodigoVerificacao` para gerar o código de verificação e chamar a função de envio de `EnviarEmail.php`) e `EnviarEmail.php`(Contêm a Classe que têm a função de se conectar ao servidor e enviar o e-mail);
    - `./Web/createOmbudsman.php` : Responsável por validar os anexos enviados e salvar os dados passados via AJAX na tabela `Ombudsman`, e salva também todos os arquivos anexados na tabela `Attachments`
    - `./Web/createUser.php` : Responsável por salvar os dados passados via AJAX na tabela `Users`, e já cria também um registro na tabela `email_confirmation` para a validação do e-mail cadastrado
    - `./Web/isLogged.php` : Responsável verificar se o usuário está realmente logado
    - `./Web/loadFilesOmbudsman.php` : Responsável pesquisar na tabela `attachments` todos os arquivos da ouvidoria passada por `ID`
    - `./Web/loadMyUser.php` : Responsável por pesquisar e trazer as informações do usuário logado
    - `./Web/login.php` : Responsável por verificar se o login que o usuário está tentando acessar é válido
    - `./Web/logout.php` : Responsável por destruir as sessões existentes
    - `./Web/reenviarCodigoVerificacao.php` : Responsável por reenviar o código de verificação para o e-mail do usuário já cadastrado anteriormente
    - `./Web/searchOmbudsman.php` : Responsável por pesquisar todos as ouvidorias abertas do usuário logado rebendo como parâmetro o texto digitado pelo usuário
    - `./Web/validarCodigoEmail.php` : Responsável por validar o código de verificação que o usuário está mandando para efetuar a ativação da conta dele
    - `./Web/verificaEmail.php` : Responsável por validar e-mail que o usuário está tentando cadastrar `(não pode existir dois e-mails iguais para dois usuário diferentes)`




