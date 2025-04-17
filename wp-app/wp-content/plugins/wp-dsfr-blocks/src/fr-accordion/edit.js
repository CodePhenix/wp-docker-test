import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';
import { useEffect } from '@wordpress/element';
import setDSFRBlockClassName from '../common/js/utils/setDSFRBlockClassName';
import uniqid from '../common/js/utils/uniqid';

export default function Edit( { setAttributes } ) {
	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		directInsert: false,
		templateLock: 'all',
		template: [ [ 'dsfr/fr-accordion-title' ], [ 'dsfr/fr-collapse' ] ],
	} );

	useEffect( () => {
		setAttributes( { id: uniqid( 'fr-collapse' ) } );
	}, [] ); // eslint-disable-line react-hooks/exhaustive-deps

	setDSFRBlockClassName( innerBlocksProps, 'fr-accordion' );

	return <div { ...innerBlocksProps } />;
}
