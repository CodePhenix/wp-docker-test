<?php
/**
 * Plugin Name: Guide de Style WordPress
 * Description: Un guide de style complet pour les développeurs
 * Version: 1.0.0
 * Author: Mikayil QUENUM
 * Text Domain: wp-style-guide
 */

// Empêcher l'accès direct
if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/class-style-extractor.php';

function wsg_add_menu_page() {
    add_menu_page(
        'Guide de Style',
        'Guide de Style',
        'edit_posts',
        'wp-style-guide',
        'wsg_display_style_guide',
        'dashicons-art',
        30
    );
}
add_action('admin_menu', 'wsg_add_menu_page');

function wsg_enqueue_assets() {
    if (isset($_GET['page']) && $_GET['page'] == 'wp-style-guide') {
        wp_enqueue_style('wsg-styles', plugin_dir_url(__FILE__) . 'assets/css/style-guide.css');
        wp_enqueue_script('wsg-scripts', plugin_dir_url(__FILE__) . 'assets/js/style-guide.js', array('jquery'), '1.0.0', true);
        
        // Charger les scripts spécifiques en fonction de l'onglet actif
        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'typography';
        
        if ($active_tab === 'theme-styles') {
            wp_enqueue_script('wsg-css-extractor', plugin_dir_url(__FILE__) . 'assets/js/css-extractor.js', array('jquery'), '1.0.0', true);
        }
    }
}
add_action('admin_enqueue_scripts', 'wsg_enqueue_assets');

function wsg_display_style_guide() {
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'typography';
    ?>
    <div class="wrap wsg-container">
        <h1>Guide de Style WordPress</h1>
        
        <h2 class="nav-tab-wrapper">
            <a href="?page=wp-style-guide&tab=typography" class="nav-tab <?php echo $active_tab == 'typography' ? 'nav-tab-active' : ''; ?>">Typographie</a>
            <a href="?page=wp-style-guide&tab=colors" class="nav-tab <?php echo $active_tab == 'colors' ? 'nav-tab-active' : ''; ?>">Couleurs</a>
            <a href="?page=wp-style-guide&tab=components" class="nav-tab <?php echo $active_tab == 'components' ? 'nav-tab-active' : ''; ?>">Composants UI</a>
            <a href="?page=wp-style-guide&tab=theme-styles" class="nav-tab <?php echo $active_tab == 'theme-styles' ? 'nav-tab-active' : ''; ?>">Styles du Thème</a>
        </h2>
        
        <div class="tab-content">
            <?php 
            switch ($active_tab) {
                case 'typography':
                    include plugin_dir_path(__FILE__) . 'templates/typography.php';
                    break;
                case 'colors':
                    include plugin_dir_path(__FILE__) . 'templates/colors.php';
                    break;
                case 'components':
                    include plugin_dir_path(__FILE__) . 'templates/components.php';
                    break;
                case 'theme-styles':
                    include plugin_dir_path(__FILE__) . 'templates/theme-styles.php';
                    break;
                case 'snippets':
                    include plugin_dir_path(__FILE__) . 'templates/code-snippets.php';
                    break;
                case 'blocks':
                    include plugin_dir_path(__FILE__) . 'templates/blocks.php';
                    break;
            }
            ?>
        </div>
    </div>
    <?php
}

// Ajout des styles pour l'admin
function wsg_add_admin_styles() {
    ?>
    <style>
        .wsg-container {
            max-width: 1200px;
        }
        
        /* Styles pour les sections de couleurs */
        .wsg-color-palette {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        
        .wsg-color-item {
            width: 200px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .color-preview {
            height: 100px;
            width: 100%;
        }
        
        .color-info {
            padding: 15px;
            background: #fff;
        }
        
        .color-info h4 {
            margin: 0 0 8px 0;
        }
        
        .color-value {
            display: inline-block;
            padding: 3px 6px;
            background: #f0f0f0;
            border-radius: 3px;
            font-size: 12px;
            margin-right: 5px;
        }
        
        /* Styles pour les snippets */
        .wsg-snippet-item {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            overflow: hidden;
        }
        
        .wsg-snippet-header {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
        }
        
        .wsg-snippet-header h3 {
            margin: 0 0 8px 0;
        }
        
        .wsg-snippet-header p {
            margin: 0;
            color: #666;
        }
        
        .wsg-snippet-preview {
            padding: 20px;
            background: #f9f9f9;
            border-bottom: 1px solid #eee;
        }
        
        .wsg-snippet-code-tabs {
            padding: 0;
        }
        
        .wsg-tabs {
            display: flex;
            border-bottom: 1px solid #eee;
        }
        
        .wsg-tab-button {
            padding: 10px 15px;
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            font-weight: 500;
        }
        
        .wsg-tab-button.active {
            border-bottom-color: #0073aa;
            color: #0073aa;
        }
        
        .wsg-tab-content {
            padding: 20px;
        }
        
        .wsg-tab-pane {
            display: none;
        }
        
        .wsg-tab-pane.active {
            display: block;
        }
        
        .wsg-tab-pane pre {
            margin: 0;
            background: #f5f5f5;
            padding: 15px;
            border-radius: 4px;
            overflow: auto;
            max-height: 300px;
        }
        
        .copy-snippet-button {
            margin-top: 10px;
            background: #f0f0f0;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .copy-snippet-button:hover {
            background: #e0e0e0;
        }
        
        /* Styles pour les variables CSS */
        .wsg-css-variables {
            margin-top: 20px;
        }
        
        .wsg-variable-group {
            margin-bottom: 30px;
        }
        
        .wsg-variable-list {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .wsg-variable-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-bottom: 1px solid #eee;
        }
        
        .wsg-variable-item:last-child {
            border-bottom: none;
        }
        
        .color-preview {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .variable-name {
            flex: 1;
            background: #f5f5f5;
            padding: 3px 6px;
            border-radius: 3px;
            margin-right: 15px;
            font-size: 12px;
        }
        
        .variable-value {
            background: #f0f0f0;
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 12px;
            margin-right: 10px;
        }
        
        /* Styles pour la typographie */
        .wsg-typography-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .wsg-typography-item {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            flex: 1;
            min-width: 250px;
        }
        
        .wsg-font-sizes {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .wsg-font-size-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }
        
        .wsg-font-size-item:last-child {
            border-bottom: none;
        }
        
        .wsg-font-size-item p {
            margin: 0;
            padding: 0;
            flex: 1;
        }
        
        .wsg-font-size-item code {
            margin-right: 10px;
        }
    </style>
    <?php
}
add_action('admin_head', 'wsg_add_admin_styles');

// Activation du plugin
register_activation_hook(__FILE__, 'wsg_activate');
function wsg_activate() {
    // Créer les répertoires nécessaires s'ils n'existent pas
    $upload_dir = wp_upload_dir();
    $style_guide_dir = $upload_dir['basedir'] . '/style-guide';
    
    if (!file_exists($style_guide_dir)) {
        wp_mkdir_p($style_guide_dir);
    }
    
    // Vous pourriez également initialiser une base de données ou des options ici
}

// Désactivation du plugin
register_deactivation_hook(__FILE__, 'wsg_deactivate');
function wsg_deactivate() {
    // Nettoyage des options ou des données temporaires
}