<?php
$artwork_path = get_template_directory_uri() . '/dist-dsfr/artwork/';

get_header();
?>
<div class="fr-container">
	<div class="fr-my-7w fr-mt-md-12w fr-mb-md-10w fr-grid-row fr-grid-row--gutters fr-grid-row--middle fr-grid-row--center">
		<div class="fr-py-0 fr-col-12 fr-col-md-6">
			<h1><?php esc_html_e( 'Page non trouvée', 'wp-dsfr-theme' ); ?></h1>
			<p class="fr-text--sm fr-mb-3w"><?php esc_html_e( 'Erreur 404', 'wp-dsfr-theme' ); ?></p>
			<p class="fr-text--lead fr-mb-3w"><?php esc_html_e( 'La page que vous cherchez est introuvable. Excusez-nous pour la gène occasionnée.', 'wp-dsfr-theme' ); ?></p>
			<p class="fr-text--sm fr-mb-5w"><?php echo wp_kses_post( __( 'Si vous avez tapé l\'adresse web dans le navigateur, vérifiez qu\'elle est correcte. La page n’est peut-être plus disponible. <br>Dans ce cas, pour continuer votre visite vous pouvez consulter notre page d’accueil, ou effectuer une recherche avec notre moteur de recherche en haut de page. <br>Sinon contactez-nous pour que l’on puisse vous rediriger vers la bonne information.', 'wp-dsfr-theme' ) ); ?></p>
			<ul class="fr-btns-group fr-btns-group--inline-md">
				<li><a class="fr-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Page d\'accueil', 'wp-dsfr-theme' ); ?></a></li>
			</ul>
		</div>
		<div class="fr-col-12 fr-col-md-3 fr-col-offset-md-1 fr-px-6w fr-px-md-0 fr-py-0">
			<svg xmlns="http://www.w3.org/2000/svg" class="fr-responsive-img fr-artwork" aria-hidden="true" width="160" height="200" viewBox="0 0 160 200">
				<use class="fr-artwork-motif" href="<?php echo esc_url( $artwork_path . 'background/ovoid.svg#artwork-motif' ); ?>"></use>
				<use class="fr-artwork-background" href="<?php echo esc_url( $artwork_path . 'background/ovoid.svg#artwork-background' ); ?>"></use>
				<g transform="translate(40, 60)">
					<use class="fr-artwork-decorative" href="<?php echo esc_url( $artwork_path . 'pictograms/system/technical-error.svg#artwork-decorative' ); ?>"></use>
					<use class="fr-artwork-minor" href="<?php echo esc_url( $artwork_path . 'pictograms/system/technical-error.svg#artwork-minor' ); ?>"></use>
					<use class="fr-artwork-major" href="<?php echo esc_url( $artwork_path . 'pictograms/system/technical-error.svg#artwork-major' ); ?>"></use>
				</g>
			</svg>
		</div>
	</div>
</div>
<?php
get_footer();
