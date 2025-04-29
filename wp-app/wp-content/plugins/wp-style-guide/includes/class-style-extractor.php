<?php
// includes/class-style-extractor.php

class WSG_Style_Extractor {
    
    /**
     * Récupère les couleurs principales du thème actif
     */
    // public function get_theme_colors() {
    //     $colors = array();
        
    //     // Récupération des couleurs de personnalisation du thème
    //     $colors['primary'] = get_theme_mod('primary_color', '#0073aa');
    //     $colors['secondary'] = get_theme_mod('secondary_color', '#23282d');
    //     $colors['accent'] = get_theme_mod('accent_color', '#00a0d2');
    //     $colors['background'] = get_theme_mod('background_color', '#ffffff');
    //     $colors['text'] = get_theme_mod('text_color', '#23282d');
        
    //     // Récupération des couleurs supplémentaires pour les thèmes compatibles avec l'éditeur de blocs
    //     if (current_theme_supports('editor-color-palette')) {
    //         $theme_json = $this->get_theme_json_data();
    //         if ($theme_json && isset($theme_json['settings']['color']['palette'])) {
    //             foreach ($theme_json['settings']['color']['palette'] as $color) {
    //                 $colors[$color['slug']] = $color['color'];
    //             }
    //         }
    //     }
        
    //     return $colors;
    // }
    
    /**
     * Récupère les polices utilisées par le thème
     */
    public function get_theme_json_data() {
        // Chemin vers le theme.json
        $theme_json_path = get_stylesheet_directory() . '/theme.json';

        if (file_exists($theme_json_path)) {
            $theme_json_content = file_get_contents($theme_json_path);
            $theme_json_data = json_decode($theme_json_content, true);
        } else {
            $theme_json_data = false;
        }

        return $theme_json_data;
    }

    public function get_theme_typography_from_json() {
        $typography = array(
            'font_families' => array(),
            'font_sizes' => array()
        );
        
        $theme_data = $this->get_theme_json_data();
        
        if ($theme_data) {
            // Récupérer les tailles de police
            if (isset($theme_data['settings']['typography']['fontSizes'])) {
                $typography['font_sizes'] = $theme_data['settings']['typography']['fontSizes'];
            }
            
            // Récupérer les familles de polices
            if (isset($theme_data['settings']['typography']['fontFamilies'])) {
                foreach ($theme_data['settings']['typography']['fontFamilies'] as $fontFamily) {
                    $typography['font_families'][] = array(
                        'name' => $fontFamily['name'],
                        'slug' => $fontFamily['slug'],
                        'fontFamily' => $fontFamily['fontFamily']
                    );
                }
            }
        }
        
        return $typography;
    }
    
    /**
     * Récupère les variables CSS personnalisées
     */
    public function get_css_variables() {
        // Cette fonction nécessite JavaScript pour extraire les variables CSS en temps réel
        // Nous retournerons un indicateur pour que le JS sache qu'il doit extraire ces données
        return 'js-extract-required';
    }

    /**
     * Force une lecture directe du fichier theme.json
     */
    public function get_theme_colors_from_json() {
        $colors = array();
        
        $theme_data = $this->get_theme_json_data();
        
        if ($theme_data) {
            if ($theme_data && isset($theme_data['settings']['color']['palette'])) {
                foreach ($theme_data['settings']['color']['palette'] as $color) {
                    // Stocker directement la valeur de la couleur, pas un tableau
                    $colors[$color['slug']] = $color['color'];
                }
            }
        }
        
        return $colors;
    }
}