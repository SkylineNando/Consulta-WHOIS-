# Consulta WHOIS

Bem-vindo à documentação do projeto **Consulta WHOIS**, hospedado no GitHub pelo usuário [Skylinenando](https://github.com/Skylinenando). Este projeto permite consultar informações detalhadas de WHOIS sobre domínios ou IPs, utilizando a API JSONWhois.

---

## Índice
1. [Instalação](#instalação)
2. [Configuração da API](#configuração-da-api)
3. [Como o Código Funciona](#como-o-código-funciona)
4. [Informações Retornadas](#informações-retornadas)
5. [Execução do Projeto](#execução-do-projeto)

---

## Instalação

### Pré-requisitos
Para executar o projeto, você precisa:
- **PHP 7.4+**
- **Composer** (para gerenciar dependências)
- **Servidor Web** (Apache, Nginx, etc.)
- **Conexão com a Internet** (para acessar a API JSONWhois)

### Passos para Instalação
1. **Clone o repositório**
   ```bash
   git clone https://github.com/Skylinenando/consulta-whois.git
   cd consulta-whois
   ```

2. **Instale as dependências**
   Use o Composer para instalar a biblioteca Unirest:
   ```bash
   composer require mashape/unirest-php
   ```

3. **Configure as permissões**
   Garanta que o diretório do projeto tenha permissões adequadas:
   ```bash
   chmod -R 755 consulta-whois
   ```

4. **Suba o servidor local**
   Em um ambiente de desenvolvimento, utilize o servidor embutido do PHP:
   ```bash
   php -S localhost:8000
   ```

---

## Configuração da API

Este projeto utiliza a API **JSONWhois** para consultar informações WHOIS. Para que funcione corretamente, você precisará de uma chave de API válida.

### Como Obter a Chave de API
1. Acesse o site [JSONWhois](https://jsonwhoisapi.com/).
2. Crie uma conta e faça o login.
3. Vá até a seção **API Keys**.
4. Copie sua chave de API.

### Configuração no Código
1. Abra o arquivo principal do projeto (`index.php`).
2. Encontre a seguinte linha:
   ```php
   "Authorization" => "Token 2oroIPRSEKt0Ao1wGNenug" // Sua chave da API
   ```
3. Substitua `"2oroIPRSEKt0Ao1wGNenug"` pela sua chave de API.

---

## Como o Código Funciona

O código PHP realiza os seguintes passos:

1. **Recebimento do Domínio/IP**
   - O usuário insere um domínio ou IP no formulário HTML.
   - O domínio/IP é validado para garantir que seja um endereço válido.

2. **Chamada à API JSONWhois**
   - O código monta uma requisição HTTP para a API JSONWhois, utilizando a biblioteca **Unirest**.
   - A API retorna informações WHOIS detalhadas sobre o domínio ou IP fornecido.

3. **Processamento dos Dados**
   - Se a resposta da API for bem-sucedida, os dados são organizados para exibição.
   - Em caso de erro, uma mensagem é exibida ao usuário.

4. **Exibição dos Resultados**
   - As informações WHOIS são apresentadas ao usuário de forma estruturada, destacando detalhes como data de criação, expiração, servidores DNS, e mais.

---

## Informações Retornadas

A API JSONWhois pode retornar diversas informações. Aqui estão os principais dados que este projeto exibe:

### Informações Básicas
- **Domínio:** O nome do domínio consultado.
- **Data de Criação:** Quando o domínio foi registrado pela primeira vez.
- **Data de Expiração:** Quando o registro do domínio expirará.
- **Última Atualização:** A última vez que o domínio foi atualizado.
- **DNSSEC:** Indica se o DNS do domínio possui extensões de segurança habilitadas.
- **Registrado:** Um indicador booleano de registro do domínio.

### Servidores DNS
- Exibe a lista de servidores de nome (nameservers) associados ao domínio.

---

## Execução do Projeto

1. Suba o servidor local ou hospede o projeto em um servidor web.
2. Acesse o projeto no navegador:
   ```
   http://localhost:8000
   ```
3. Digite um domínio ou IP no formulário e clique em **Consultar WHOIS**.
4. Os resultados serão exibidos na tela em formato legível.

---

Se você tiver dúvidas ou encontrar problemas, por favor, abra uma [issue](https://github.com/Skylinenando/consulta-whois/issues) no repositório do GitHub.
