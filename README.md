# 🧠 MindCore — Sistema de Monitoramento de Bem-Estar no Trabalho

> Projeto Técnico — Técnico em Informática | ETEP 2025  
> Turma 472 · Disciplina de Projetos

---

## 👥 Equipe

| Nome | Função |
|---|---|
| Lorenzo Jaques | Desenvolvimento back-end, infraestrutura e deploy |
| Lavínia Lopes | Desenvolvimento e documentação |
| Vinicios Karpinski | Desenvolvimento e documentação |

**Professora Orientadora:** Camila Werminghoff  
**Professor Coorientador:** Leandro Pires de Oliveira

---

## 📋 Sobre o projeto

O **MindCore** é um sistema web de monitoramento contínuo da saúde mental no ambiente de trabalho. Por meio de um formulário anônimo e rápido, colaboradores registram diariamente como estão se sentindo em relação a **humor**, **estresse** e **sono**. Os dados coletados são exibidos em um dashboard administrativo com médias e histórico, permitindo que gestores identifiquem precocemente sinais de sofrimento psicológico e adotem medidas preventivas.

O projeto está alinhado às atualizações da **NR-1**, que passou a considerar os riscos psicossociais como parte da segurança e saúde ocupacional.

---

## ❓ Problema

> *"De que forma a negligência na coleta de dados sobre saúde mental dos colaboradores influencia os níveis de desempenho organizacional?"*

A ausência de ferramentas de monitoramento dificulta a identificação precoce de sofrimento psicológico, assédio e esgotamento profissional. Gestores sem dados concretos não conseguem agir preventivamente, o que aumenta afastamentos, queda de produtividade e rotatividade.

---

## 💡 Hipótese

O monitoramento contínuo da saúde mental por meio de feedbacks periódicos permitirá identificar precocemente problemas psicológicos, melhorando o bem-estar e o desempenho dos colaboradores.

---

## 🎯 Objetivo

Investigar como a ausência de dados sobre saúde mental dos colaboradores influencia o desempenho organizacional, propondo o desenvolvimento de um sistema de monitoramento contínuo para melhoria do bem-estar e da produtividade.

---

## 🛠️ Tecnologias utilizadas

| Camada | Tecnologia |
|---|---|
| Front-end | HTML, CSS, JavaScript |
| Back-end | PHP |
| Banco de dados | PostgreSQL |
| Servidor web | Nginx |
| Infraestrutura | Proxmox VM, Linux (Debian) |
| Rede privada | Tailscale |
| Deploy | rsync + SSH |
| Versionamento | Git + Gitea (privado) + GitHub |

---

## ⚙️ Como rodar localmente

### Pré-requisitos
- PHP 8+
- PostgreSQL
- Nginx ou Apache

### Configuração

```bash
# 1. Clone o repositório
git clone https://github.com/jaques-lo/mindcore.git
cd mindcore

# 2. Configure as variáveis de ambiente
cp .env.example .env
nano .env

# 3. Configure o banco de dados
cp config/database.example.php config/database.php

# 4. Importe a estrutura do banco
psql -U seu_usuario -d seu_banco -f database.sql
```

### Variáveis do `.env`

```
DB_HOST=localhost
DB_PORT=5432
DB_NAME=nome_do_banco
DB_USER=usuario
DB_PASS=senha
```

---

## 🖥️ Funcionalidades

- **Formulário anônimo** — colaboradores respondem em menos de 1 minuto
- **Sliders interativos** — avaliação de humor, estresse e sono de 0 a 10
- **Dashboard administrativo** — médias gerais e histórico completo de respostas
- **Indicadores visuais** — badges coloridos por nível (bom, médio, ruim)
- **API REST** — endpoint para salvar respostas via `POST` em JSON

---

## 📁 Estrutura do projeto

```
mindcore/
├── index.php          # Formulário de bem-estar
├── admin.php          # Dashboard administrativo
├── api/
│   └── salvar.php     # API REST para salvar respostas
├── config/
│   ├── database.php         # Conexão com o banco (não versionado)
│   └── database.example.php # Modelo de configuração
├── assets/
│   ├── css/
│   └── js/
├── .env.example       # Modelo de variáveis de ambiente
├── .gitignore
├── subir.sh           # Script de deploy para a VM
└── baixar.sh          # Script de sincronização local
```

---

## 🔒 Segurança

- Credenciais do banco gerenciadas via variáveis de ambiente (`.env`)
- Formulário com respostas **100% anônimas** — nenhum dado pessoal é coletado
- Validação e sanitização dos dados na API antes de inserir no banco

---

## 👨‍💻 Desenvolvido por

**Lorenzo Jaques** · São Leopoldo, RS  
📬 [lorenzo.j.sprenger@gmail.com](mailto:lorenzo.j.sprenger@gmail.com)  
🔗 [linkedin.com/in/lorenzo-jaques](https://www.linkedin.com/in/lorenzo-jaques/)

---

> Projeto desenvolvido como Trabalho de Conclusão de Curso Técnico em Informática  
> Escola Técnica Estadual Portão (ETEP) · 2025
