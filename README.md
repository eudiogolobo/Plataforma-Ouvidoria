# Ouvidoria Online
[![licence mit](https://img.shields.io/badge/licence-MIT-blue.svg)](./LICENSE)

Projeto realizado à partir do desafio proposto pela empresa [Web Brain](https://www.webbrain.com.br/), visando projetar e programar uma plataforma de ouvidoria online para uma "prefeitura". Na parte de cadastro me inspirei na [Amazon Web Service](https://aws.amazon.com/pt/ses/), com etapas e tudo mais...

## Sobre o Projeto
A [estrutura e organização](./STRUCTURE) do projeto está de maneira clara e objetiva explicando tudo em forma de comentários e exemplificações.


## Desafio Proposto
A prefeitura deseja implementar uma plataforma de ouvidoria online que permitirá aos cidadãos registrar reclamações, sugestões ou denúncias, facilitando a comunicação entre a população e a administração municipal. Este projeto visa testar suas habilidades de programação full-stack utilizando tecnologias específicas.
### Tecnologias Requeridas
- Frontend: Bootstrap, jQuery
- Backend: PHP puro
- Database: MySQL
- Controle de Versão: GIT

### Requerimentos do Projeto

#### 1. Página Inicial
- Informações gerais sobre como usar a ouvidoria.
- Opção para login/cadastro.
  
#### 2. Cadastro e Login
- Formulário de cadastro com validação:
  - Campos: nome completo, data de nascimento, e-mail, telefone, whatsapp, senha e confirmação da senha, cidade e estado.
  - Todos os campos são obrigatórios.
  - A pessoa deve ter mais de 18 anos.
  - Verificação de e-mail válido.
  - Máscaras para números de telefone e WhatsApp.
  - O estado seleciona as cidades disponíveis via carregamento dinâmico.
  - Salvar dados no banco de dados com proteção contra SQL Injection.
- Envio de código de validação para o e-mail cadastrado.
- Login com criação de sessão em PHP.
  
#### 3. Abertura de Ouvidoria
- Somente após login.
- Formulário para registro de nova ouvidoria:
  - Campos: descrição do caso, tipo de serviço afetado, anexos (1 ou mais).
  - Todos os campos são obrigatórios.
  - Anexos salvos em base64 no banco de dados.
- Validação do formulário com jQuery antes da submissão.
  
#### 4. Listagem de Ouvidorias
- Visualização de ouvidorias abertas pelo usuário logado.
  
#### 5. Segurança
- Proteção contra principais vulnerabilidades web (SQL Injection, XSS, etc.).
- Senhas armazenadas de forma segura.

#### 6. Documentação e Código
- Código fonte bem organizado e comentado.
- Documentação clara do projeto.

 Entrega
- O projeto completo deve ser postado no GitHub, incluindo o arquivo SQL para a criação do banco de dados.
- Prazo de entrega: 30 dias a partir da data de hoje.

### Notas Importantes
- É imperativo que o desenvolvimento seja individual, sem ajuda direta de outras pessoas, utilizando apenas recursos e conhecimento obtidos por pesquisa independente.
- Qualquer criatividade adicional que adicione valor ao projeto sem desviar totalmente do objetivo será valorizada.
- A comunicação entre frontend (jQuery) e backend (PHP) deve ser realizada via AJAX.

#### Critérios de Avaliação
- Funcionalidade: o sistema funciona conforme o solicitado.
- Segurança: implementação de práticas de segurança adequadas.
- Organização e clareza do código.
- Cumprimento das orientações e prazos especificados.
- Qualidade da interface de usuário.
- Documentação: clareza e completude.


## License/Licença do Projeto

- [MIT](./LICENSE)

## Agradecimentos
> Obrigado à você que está lendo e, a [Web Brain](https://www.webbrain.com.br/) pelo desafio!



