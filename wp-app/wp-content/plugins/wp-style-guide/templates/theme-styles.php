<?php
// templates/theme-styles.php

$style_extractor = new WSG_Style_Extractor();

$colors = $style_extractor->get_theme_colors_from_json();

$typography = $style_extractor->get_theme_typography_from_json();
?>

<div class="wsg-theme-styles">
    <h2>Styles du thème actif</h2>
    
    <div class="wsg-section">
        <h3>Palette de couleurs</h3>
        <button id="refresh-theme-styles" class="button">Rafraîchir les styles</button>
        <div class="wsg-color-palette">
            <?php foreach ($colors as $name => $color) : ?>
                <div class="wsg-color-item">
                    <div class="color-preview" style="background-color: <?php echo esc_attr($color); ?>"></div>
                    <div class="color-info">
                        <h4><?php echo esc_html(ucfirst(str_replace('_', ' ', $name))); ?></h4>
                        <code class="color-value"><?php echo esc_html($color); ?></code>
                        <button class="copy-button" data-copy="<?php echo esc_attr($color); ?>">
                            <span class="dashicons dashicons-clipboard"></span>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div class="wsg-section">
        <h3>Typographie</h3>
        <h4>Familles de polices</h4>
        
        <div class="wsg-typography-info">
            <?php if (!empty($typography['font_families'])) : ?>
                <?php foreach ($typography['font_families'] as $font) : ?>
                    <div class="wsg-typography-item">
                        <h5><?php echo esc_html($font['name']); ?></h5>
                        <p style="font-family: <?php echo esc_attr($font['fontFamily']); ?>">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                        <code><?php echo esc_html($font['fontFamily']); ?></code>
                        <button class="copy-button" data-copy="font-family: <?php echo esc_attr($font['fontFamily']); ?>;">
                            <span class="dashicons dashicons-clipboard"></span>
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Aucune famille de police définie dans theme.json</p>
            <?php endif; ?>
        </div>
        
        <div class="wsg-font-sizes">
            <h4>Tailles de police</h4>
            <?php if (!empty($typography['font_sizes'])) : ?>
                <?php foreach ($typography['font_sizes'] as $font_size) : ?>
                    <div class="wsg-font-size-item">
                        <p style="font-size: <?php echo esc_attr($font_size['size']); ?>">
                            <?php echo esc_html($font_size['name']); ?> (<?php echo esc_html($font_size['slug']); ?>)
                        </p>
                        <code><?php echo esc_html($font_size['size']); ?></code>
                        <button class="copy-button" data-copy="font-size: <?php echo esc_attr($font_size['size']); ?>;">
                            <span class="dashicons dashicons-clipboard"></span>
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Aucune taille de police définie dans theme.json</p>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="wsg-section">
        <h3>Variables CSS personnalisées</h3>
        <div id="css-variables-container">
            <p>Chargement des variables CSS...</p>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function($) {
    $('#refresh-theme-styles').on('click', function() {
        location.reload(true); // Force le rechargement en ignorant le cache
    });
});
</script>