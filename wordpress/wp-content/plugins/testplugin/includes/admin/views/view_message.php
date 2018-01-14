<?php
/**
 * Message template view
 */


// Prevent direct call
if ( !defined( 'WPINC' ) ) die;
if ( !class_exists( 'DX_TestPlugin' ) ) die;
 
?>

<div id="result" class="<?php echo $class; ?>">
	<?php echo $content; ?>
</div>