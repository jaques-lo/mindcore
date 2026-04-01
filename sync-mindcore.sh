#!/bin/bash
echo "🚀 Sincronizando MindCore para VM..."

# Sincroniza arquivos
rsync -avz --delete \
  --exclude '.git' \
  --exclude '*.sql' \
  --exclude 'sync-mindcore.sh' \
  --exclude 'subir.sh' \
  ~/Documentos/etepmostra-projetos/mindcore-vm/ \
  mindcore@IP_INTERNO:/var/www/html/mindcore/

# Recarrega Nginx na VM
ssh mindcore@IP_INTERNO "sudo systemctl reload nginx"

echo "✅ Sincronização concluída!"
