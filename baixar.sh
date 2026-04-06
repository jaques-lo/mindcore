#!/bin/bash

# Cores
VERDE='\033[0;32m'
AZUL='\033[0;34m'
AMARELO='\033[1;33m'
VERMELHO='\033[0;31m'
ROXO='\033[0;35m'
NC='\033[0m' # No Color

echo ""
echo -e "${AZUL}"
#!/bin/bash

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
# Verifica se o repositório já existe
if [ ! -d ".git" ]; then
    echo -e "${VERMELHO}Repositório não encontrado!${NC}"
    echo "Clonando do Gitea..."
    echo ""
    
    # Pede o usuário do Gitea
    read -p "Usuário do Gitea" gitea_user
    gitea_user=${gitea_user:}
    
    # Clona o repositório
    git clone http://IP_INTERNO:3000/$gitea_user/mindcore.git .
    
    if [ $? -eq 0 ]; then
        echo -e "${VERDE}Repositório clonado com sucesso!${NC}"
    else
        echo -e "${VERMELHO}Erro ao clonar repositório!${NC}"
        echo "Verifique se o repositório existe: http://IP_INTERNO:3000/$gitea_user/mindcore"
        exit 1
    fi
else
    # Verifica se tem alterações locais
    if [[ -n $(git status -s) ]]; then
        echo -e "${AZUL}Você tem alterações locais não commitadas!${NC}"
        echo ""
        echo -e "Alterações locais:"
        git status -s
        echo ""
        read -p "Deseja guardar as suas alterações (stash) antes de baixar? (s/N): " stash_opt
        
        if [[ "$stash_opt" =~ ^[Ss]$ ]]; then
            git stash save "Backup antes do pull - $(date '+%d/%m/%Y %H:%M')"
            echo -e "Alterações guardadas!"
            echo ""
        fi
    fi
    
    # Puxa as atualizações do Gitea
    echo -e "${AZUL}Baixando atualizações do Gitea...${NC}"
    git pull origin main
    
    if [ $? -eq 0 ]; then
        echo -e "Código atualizado com sucesso!"
    else
        echo -e "Erro ao atualizar!"
        exit 1
    fi
fi

echo ""
echo -e "Sincronizando com a VM..."
rsync -avz --delete \
  --exclude '.git' \
  --exclude '*.sql' \
  --exclude '*.sh' \
  --exclude '*.md' \
  ./ mindcore@IP_INTERNO:/var/www/html/mindcore/

# Recarrega Nginx
echo -e "Recarregando Nginx na VM..."
ssh mindcore@IP_INTERNO "sudo systemctl reload nginx"

echo ""
echo -e "ATUALIZAÇÃO CONCLUÍDA!"
echo ""
echo -e "Status atual"
git log -1 --oneline
echo ""
