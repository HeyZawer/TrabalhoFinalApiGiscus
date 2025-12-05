# Projeto Final – Wiki Interativa com Sistema de Usuários (Giscus API + PHP)
Este repositório faz parte de um projeto acadêmico desenvolvido na disciplina de Programação Web, durante o curso de Ciência da Computação.
O objetivo é construir a base de uma Wiki interativa, onde usuários podem acessar páginas, visualizar conteúdos de personagens e interagir através de comentários, usando uma estrutura inspirada em comunidades reais.

---
# O projeto combina:
* PHP para autenticação e gerenciamento de usuários
* MySQL (PDO) para persistência de dados
* HTML/CSS/JS para interface da Wiki
* Recursos visuais e páginas individuais de conteúdo
* Estrutura pensada para futuras integrações com sistemas de discussão como Giscus/Disqus
---
# Visão Geral do Projeto

**A proposta é criar uma Wiki onde usuários podem:**

* Navegar entre páginas temáticas (Wiki Page)
* Visualizar informações e artes de personagens
* Interagir através de uma área inspirada em comentários (futuro Giscus API)
* Criar conta, logar e participar da comunidade
* Administradores têm permissões especiais (como editar usuários)
---

# Funcionalidades Implementadas
| **Categoria** | **Detalhes** |
| :--- | :--- |
| **Login e Autenticação** | Sistema completo de login, sessão, hash seguro e validação |
| **Verificação de Permissões** | Bloqueio de acesso não autorizado e página de “Sem Permissão” |
| **Cadastro de Usuários** | Formulário funcional com validação |
| **Edição e Exclusão de Usuários** | Arquivos dedicados a manipulação administrativa |
| **Wiki Page** | Página para exibição de conteúdo com imagens e scripts próprios | 
| **Dashboard** |	Área restrita do usuário, com interface estilizada | 
| **Estrutura Visual** | Pastas de imagem, CSS e JS dedicadas |
---
# Estrutura do Projeto
```
TRABALHOFINAL/
├── css/
│   ├── style.css           # Estilo geral do site e dashboard
│   └── style_wiki.css      # Estilo exclusivo da página Wiki
│
├── img/
│   ├── banner.png
│   ├── Blade.png
│   ├── Cipher.png
│   ├── DanHeng.png
│   ├── JingYuan.png
│   ├── NoiteEterna.png
│   ├── Phainon.png
│   └── logo.png            # Logo usado no header ou login
│
├── js/
│   ├── script.js           # JS geral do site
│   └── wiki_script.js      # Comportamentos específicos da Wiki Page
│
├── autentica.php           # Sistema de login + validação
├── banco_de_dados.php      # Conexão PDO com o MySQL
├── cadastro_usuario.php    # Cadastro de novos usuários
├── editar_usuario.php      # Edição pelo admin
├── excluir_usuario.php     # Exclusão pelo admin
├── gera_hash.php           # Auxiliar para gerar hash para criação de admin via banco de dados
├── index.php               # Tela de login e Cadastro
├── logout.php              # Saída segura de sessão
├── markdown.php            # Markdown para transformar ** em textos em negrito e itálico
├── sem_permissao.php       # Tela exibida quando o usuário tenta acessar algo negado
├── verifica_sessao.php     # Função usada em todas as páginas restritas
└── wiki_page.php           # Página principal de conteúdo da Wiki
```

# Como Executar
1. Coloque o projeto no seu servidor local
   
XAMPP → htdocs/

2. Configure o Banco de Dados

Crie o banco e tabela:
```sql
CREATE DATABASE banco_de_dados;
USE banco_de_dados;

CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    nivel_acesso VARCHAR(50) NOT NULL DEFAULT 'user',
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insira o Usuário administrador (Caso queira uma senha mais segura, apenas acesse a página /gera_hash inserindo sua própria senha e ela virá criptografada pra você)
-- Usuário administrador (senha: 123456):

INSERT INTO usuarios (nome, email, senha, nivel_acesso) VALUES (
 'Admin',
 'admin@email.com',
 '$2y$10$.uUS04ZucAMdNUzcOF4FkOnW8Vrj4h.RBLs5mXZ6nr6ELQ0FEmE66',
 'admin'
);
```
---
# Previsões para o futuro
O projeto não está completamente finalizado, o escopo ainda não foi completamente concluído e por falta de tempo ele estará sendo lançado com bem menos funcionalidades que o previsto e com APIs que obrigam o usuário a ter uma conta no github para que a comunidade realmente exista, o planejamento para o futuro inclui:

* Segunda aba de personagens totalmente funcional, agora podendo receber as informações para a construção do personagem e informações importantes sobre suas habilidades e história
* Uma aba de comentários exclusiva para cada sessão e não uma global que sirva para o site inteiro, feita com uma API própria ou uma que não exija contas externas
* Capacidade dos administradores deletarem comentários que soarem ofensivos para ajudar na manutenção da comunidade
* Reforço na segurança visto que informações cruciais estão sendo armazenadas em cookies e não em sessões
* Uma quantidade maior de abas que incluem os melhores equipamentos para cada personagem e um pouco mais da história
* Novas abas para outras wikis no painel principal, tornando a comunidade não só sobre apenas um jogo
