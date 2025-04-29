#!/bin/bash

# Variables à personnaliser selon votre configuration
WP_ROOT="wp-app"
WP_USER="www-data"
WP_GROUP="www-data"

# Définir les permissions correctes
find ${WP_ROOT} -exec chown ${WP_USER}:${WP_GROUP} {} \;
find ${WP_ROOT} -type d -exec chmod 755 {} \;
find ${WP_ROOT} -type f -exec chmod 644 {} \;

# Rendre certains dossiers inscriptibles
chmod -R 775 ${WP_ROOT}/wp-content/uploads
chmod -R 775 ${WP_ROOT}/wp-content/upgrade
chmod -R 775 ${WP_ROOT}/wp-content/plugins
chmod -R 775 ${WP_ROOT}/wp-content/themes

# Ajoutez ici d'autres dossiers personnalisés qui nécessitent des permissions spéciales
# chmod -R 775 ${WP_ROOT}/wp-content/votre-dossier-custom

echo "Permissions WordPress corrigées avec succès."