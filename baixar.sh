#!/bin/bash
# asterisco comenta em linguagem de terminal
# Cores
VERDE='\033[0;32m'
AZUL='\033[0;34m'
AMARELO='\033[1;33m'
VERMELHO='\033[0;31m'
NC='\033[0m'

echo -e "${AZUL}"
echo "                  ▒▓▓▓▓▒"
echo "                  ▒▓▓▓▓▒"
echo "                    ▓▒"
echo "                    ▓▓"
echo "            ▒▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▒"
echo "         ▓▓▓▓                ▓▓▓▓"
echo "        ▓▓▓                      ▒▓▓"
echo "      ▒▓                          ▓▒"
echo "    ▓▓▓▓                          ▓▓▓▓"
echo "   ▒▓▓▓       ▓▓▓        ▒▓▓▓      ▓▓▓▒"
echo "   ▓▓▓▓      ▓▓▓▓▓      ▓▒  ▓▓     ▓▓▓▓"
echo "   ▓▓▓▓       ▓▓▓                  ▓▓▓▓"
echo "   ▒▓▓▓                            ▓▓▓▓"
echo "      ▓▓        ▓▓      ▓▓        ▓▓"
echo "      ▓▓          ▓▓▓▓▓▓          ▓▓"
echo "       ▓▓▓                      ▓▓▓"
echo "        ▓▓▓▓▒▒   ░░░░░░   ▒▓▓▓▓▓"
echo "             ▒▓▓▓▓▓▓▓▓▓▓▓▓▓▓▒"
echo -e "${NC}"

echo -e "${AZUL}--- ATUALIZANDO AMBIENTE LOCAL ---${NC}\n"

# Se não tem Git, clona
if [ ! -d ".git" ]; then
    echo -e "${AMARELO}Repositório não encontrado localmente.${NC}"
    read -p "Qual seu usuário do Gitea? " user
    git clone http://IP_INTERNO:3000/$user/mindcore.git .
else
    # Se tem alterações locais, pergunta do Stash
    if [[ -n $(git status -s) ]]; then
        echo -e "${AMARELO}Você tem arquivos mexidos no PC.${NC}"
        read -p "Deseja salvar suas mudanças em um backup (stash) antes de baixar? (s/n): " opt
        if [[ "$opt" =~ ^[Ss]$ ]]; then
            git stash save "Backup automático $(date '+%H:%M')"
            echo "Mudanças guardadas."
        fi
    fi

    echo -e "${AZUL}Puxando novidades do Gitea...${NC}"
    git pull origin main
fi

echo -e "\n${VERDE}PC ATUALIZADO!${NC}"
git log -1 --oneline