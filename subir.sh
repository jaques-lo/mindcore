#!/bin/bash

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

echo -e "${AZUL}--- MINDCORE DEPLOY ---${NC}\n"

# Verifica alterações
if [[ -z $(git status -s) ]]; then
    echo -e "${AMARELO}Nenhuma alteração para subir.${NC}"
else
    git status -s
    echo ""
    read -p "Mensagem do commit: " msg
    [ -z "$msg" ] && msg="Update: $(date '+%d/%m/%Y %H:%M')"

    git add .
    git commit -m "$msg"
    
    echo -e "\n${AZUL}Enviando para o Gitea...${NC}"
    git push origin main
fi

# Sincroniza com a VM
echo -e "\n${AZUL}Sincronizando com a VM...${NC}"
rsync -avz --delete \
  --exclude '.git' \
  --exclude '*.sql' \
  --exclude '*.sh' \
  --exclude '*.md' \
  ./ mindcore@IP_INTERNO:/var/www/html/mindcore/

# Recarrega Nginx
echo -e "${AZUL}Recarregando Nginx...${NC}"
ssh mindcore@IP_INTERNO "sudo systemctl reload nginx"

echo -e "\n${VERDE}SUBIDA CONCLUÍDA COM SUCESSO!${NC}"