#!/usr/bin/env bash

# Sécuriser le script : 
# -e : stoppe si erreur
# -u : stoppe si variable non définie
# -o pipefail : stoppe si une commande dans un pipe échoue
set -euo pipefail

# Start timer
start_time=$(date +%s)

# Load env variables
if [ -f ".env" ]; then
  export $(grep -v '^#' .env | xargs)
else
  echo "Fichier .env manquant."
  exit 1
fi

# Create local folder if needed
mkdir -p "$LOCAL_DUMP_DIR" "$LOCAL_UPLOADS_DIR" "$LOCAL_PLUGINS_DIR"

# Dump db
# echo "🛠️ Lancement du script de dump..."
# ./export.sh

# if [ $? -eq 0 ]; then
#   echo "✅ Dump de la base de données effectué."
# else
#   echo "❌ Erreur lors du dump de la base de données."
#   exit 1
# fi

# Sync "uploads" folder
echo "📂 Synchronisation du dossier dumps..."
rsync -avz -e "ssh -p $SSH_PORT" "$SSH_USER@$SSH_HOST:$REMOTE_PATH_DUMPS/" "$LOCAL_DUMP_DIR/"
echo "✅ Dumps synchronisés."

# Sync "uploads" folder
echo "📂 Synchronisation du dossier uploads..."
rsync -avz -e "ssh -p $SSH_PORT" "$SSH_USER@$SSH_HOST:$REMOTE_PATH_UPLOADS/" "$LOCAL_UPLOADS_DIR/"
echo "✅ Uploads synchronisés."

# Sync "plugins" folder
echo "📂 Synchronisation du dossier plugins..."
rsync -avz -e "ssh -p $SSH_PORT" "$SSH_USER@$SSH_HOST:$REMOTE_PATH_PLUGINS/" "$LOCAL_PLUGINS_DIR/"
echo "✅ Plugins synchronisés."

# End timer
end_time=$(date +%s)
elapsed=$(( end_time - start_time ))

echo "🎉 Synchronisation terminée."
