// assets/js/css-extractor.js

(function($) {
    'use strict';
    
    const CSSExtractor = {
        
        init: function() {
            this.extractCSSVariables();
            this.setupCopyButtons();
        },
        
        extractCSSVariables: function() {
            const variables = {};
            const rootStyles = getComputedStyle(document.documentElement);
            
            // Prendre toutes les propriétés et filtrer les variables CSS
            for (const prop of rootStyles) {
                if (prop.startsWith('--')) {
                    variables[prop] = rootStyles.getPropertyValue(prop).trim();
                }
            }
            
            // Afficher les variables dans le DOM
            this.displayCSSVariables(variables);
        },
        
        displayCSSVariables: function(variables) {
            const container = $('#css-variables-container');
            
            if (!container.length) return;
            
            let html = '<div class="wsg-css-variables">';
            
            // Regrouper par préfixes courants
            const groups = this.groupVariablesByPrefix(variables);
            
            // Créer les sections de variables
            for (const [prefix, vars] of Object.entries(groups)) {
                html += `<div class="wsg-variable-group">
                    <h3>${this.formatPrefixTitle(prefix)}</h3>
                    <div class="wsg-variable-list">`;
                
                for (const [name, value] of Object.entries(vars)) {
                    const colorPreview = this.isColorValue(value) ? 
                        `<span class="color-preview" style="background-color: ${value}"></span>` : '';
                    
                    html += `<div class="wsg-variable-item">
                        ${colorPreview}
                        <code class="variable-name">${name}</code>
                        <code class="variable-value">${value}</code>
                        <button class="copy-button" data-copy="${name}: ${value}">
                            <span class="dashicons dashicons-clipboard"></span>
                        </button>
                    </div>`;
                }
                
                html += `</div></div>`;
            }
            
            html += '</div>';
            container.html(html);
        },
        
        groupVariablesByPrefix: function(variables) {
            const groups = {
                'color': {},
                'spacing': {},
                'typography': {},
                'other': {}
            };
            
            for (const [name, value] of Object.entries(variables)) {
                // Déterminer le groupe en fonction du nom de la variable
                let group = 'other';
                
                if (name.includes('color') || this.isColorValue(value)) {
                    group = 'color';
                } else if (name.includes('spacing') || name.includes('margin') || name.includes('padding')) {
                    group = 'spacing';
                } else if (name.includes('font') || name.includes('text') || name.includes('line-height')) {
                    group = 'typography';
                }
                
                groups[group][name] = value;
            }
            
            return groups;
        },
        
        formatPrefixTitle: function(prefix) {
            // Convertir 'color' en 'Couleurs', etc.
            const titles = {
                'color': 'Couleurs',
                'spacing': 'Espacement',
                'typography': 'Typographie',
                'other': 'Autres variables'
            };
            
            return titles[prefix] || prefix;
        },
        
        isColorValue: function(value) {
            // Vérifier si la valeur est une couleur (hex, rgb, etc.)
            return /^(#|rgb|rgba|hsl|hsla)/.test(value);
        },
        
        setupCopyButtons: function() {
            $(document).on('click', '.copy-button', function() {
                const textToCopy = $(this).data('copy');
                navigator.clipboard.writeText(textToCopy).then(() => {
                    // Feedback visuel
                    const originalIcon = $(this).find('.dashicons').attr('class');
                    $(this).find('.dashicons').attr('class', 'dashicons dashicons-yes');
                    
                    setTimeout(() => {
                        $(this).find('.dashicons').attr('class', originalIcon);
                    }, 1500);
                });
            });
        }
    };
    
    $(document).ready(function() {
        CSSExtractor.init();
    });
    
})(jQuery);