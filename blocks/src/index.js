/**
 * Blocks
 *
 * All blocks related JavaScript files should be imported here.
 * You can create a new block folder in this dir and include code
 * for that block here as well.
 *
 * All blocks should be included here since this is the file that
 * Webpack is compiling as the input file.
 */

// Recaps
import './recaps/index.js';

// Spoiler
import './spoiler/block.js';

// Disable fullscreen editor
const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' );

if ( isFullscreenMode ) {
    wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' );
}
