<?php
/**
 * Register Globals - Column Animations
 */


// Prevent direct call
if ( !defined( 'WPINC' ) ) die;
if ( !class_exists( 'DX_TestPlugin' ) ) die;	


/**
 * Column Transitions
 */	

$test_plugin['column-transition'] = array (
	array(
		'name' => __( 'None', 'test_plugin_textdomain' ),
		'value' => ''
	),
	
	// Fade In
	
	array(
		'group_name' => sprintf( '-- %s --', __( 'Fade', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' =>  __( 'Fade In', 'test_plugin_textdomain' ),
				'value' => 'fade_in', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"0","opacity":"0","rotation":"0","rotationX":"0","rotationY":"0","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' => __( 'Fade Zoom In', 'test_plugin_textdomain' ), 
				'value' => 'fade_zoom_in', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"0","opacity":"0","rotation":"0","rotationX":"0","rotationY":"0","skewX":"0","skewY":"0","scaleX":"40","scaleY":"40"}'
			),
			array(
				'name' => __( 'Fade Zoom Out', 'test_plugin_textdomain' ),
				'value' => 'fade_zoom_out', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"0","opacity":"0","rotation":"0","rotationX":"0","rotationY":"0","skewX":"0","skewY":"0","scaleX":"140","scaleY":"140"}'
			),			
		
		)
	),
	
	// Slide In
	
	array(
		'group_name' => sprintf( '-- %s --', __( 'Slide In', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' =>  __( 'Slide in Left', 'test_plugin_textdomain' ),
				'value' => 'slide_in_left', 
				'data' => '{"transformOrigin":"right center","x":"200","y":"0","opacity":"0","rotation":"0","rotationX":"0","rotationY":"0","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),					
			array(
				'name' =>  __( 'Slide In Right', 'test_plugin_textdomain' ),
				'value' => 'slide_in_right', 
				'data' => '{"transformOrigin":"right center","x":"-200","y":"0","opacity":"0","rotation":"0","rotationX":"0","rotationY":"0","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Slide In Up', 'test_plugin_textdomain' ),
				'value' => 'slide_in_up', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"200","opacity":"0","rotation":"0","rotationX":"0","rotationY":"0","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Slide In Down', 'test_plugin_textdomain' ),
				'value' => 'slide_in_down', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"-200","opacity":"0","rotation":"0","rotationX":"0","rotationY":"0","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),				
		)
	),
	
	// Slide Skew In
	
	array(
		'group_name' => sprintf( '-- %s --', __( 'Slide Skew In', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' =>  __( 'Slide Skew In Left', 'test_plugin_textdomain' ),
				'value' => 'slide_skew_in_left', 
				'data' => '{"transformOrigin":"center center","x":"500","y":"0","opacity":"0","rotation":"0","rotationX":"0","rotationY":"5","skewX":"-5","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Slide Skew In Right', 'test_plugin_textdomain' ),
				'value' => 'slide_skew_in_right', 
				'data' => '{"transformOrigin":"center center","x":"-500","y":"0","opacity":"0","rotation":"0","rotationX":"0","rotationY":"5","skewX":"-5","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Slide Skew In Down', 'test_plugin_textdomain' ),
				'value' => 'slide_skew_in_down', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"-200","opacity":"0","rotation":"0","rotationX":"5","rotationY":"0","skewX":"0","skewY":"-5","scaleX":"100","scaleY":"100"}'
			),		
			
			array(
				'name' =>  __( 'Slide Skew In Up', 'test_plugin_textdomain' ),
				'value' => 'slide_skew_in_up', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"200","opacity":"0","rotation":"0","rotationX":"5","rotationY":"0","skewX":"0","skewY":"-5","scaleX":"100","scaleY":"100"}'
			),					
		)
	),			
	
	// Flip In
	
	array(
		'group_name' => sprintf( '-- %s --', __( 'Flip In', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' =>  __( 'Flip In Left', 'test_plugin_textdomain' ),
				'value' => 'flip_in_left', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"0","opacity":"0","rotation":"0","rotationX":"0","rotationY":"180","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Flip In Right', 'test_plugin_textdomain' ),
				'value' => 'flip_in_right', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"0","opacity":"0","rotation":"0","rotationX":"0","rotationY":"-180","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Flip In Left Up', 'test_plugin_textdomain' ),
				'value' => 'flip_in_left_up', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"100","opacity":"0","rotation":"0","rotationX":"0","rotationY":"180","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Flip In Right Up', 'test_plugin_textdomain' ),
				'value' => 'flip_in_right_up', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"100","opacity":"0","rotation":"0","rotationX":"0","rotationY":"-180","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),			
			array(
				'name' =>  __( 'Flip In Left Down', 'test_plugin_textdomain' ),
				'value' => 'flip_in_left_down', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"-100","opacity":"0","rotation":"0","rotationX":"0","rotationY":"180","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Flip In Right Down', 'test_plugin_textdomain' ),
				'value' => 'flip_in_right_down', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"-100","opacity":"0","rotation":"0","rotationX":"0","rotationY":"-180","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),			
		
		)
	),
	
	// Rotate In
	
	array(
		'group_name' => sprintf( '-- %s --', __( 'Rotate In', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' =>  __( 'Rotate In Left Top', 'test_plugin_textdomain' ),
				'value' => 'rotate_in_left_top', 
				'data' => '{"transformOrigin":"center -200%","x":"0","y":"0","opacity":"0","rotation":"20","rotationX":"0","rotationY":"-45","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Rotate In Right Top', 'test_plugin_textdomain' ),
				'value' => 'rotate_in_right_top', 
				'data' => '{"transformOrigin":"center -200%","x":"0","y":"0","opacity":"0","rotation":"-20","rotationX":"0","rotationY":"45","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),		
			array(
				'name' =>  __( 'Rotate In Left Bottom', 'test_plugin_textdomain' ),
				'value' => 'rotate_in_left_bottom', 
				'data' => '{"transformOrigin":"center 200%","x":"0","y":"0","opacity":"0","rotation":"20","rotationX":"0","rotationY":"-45","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Rotate In Right Bottom', 'test_plugin_textdomain' ),
				'value' => 'rotate_in_right_bottom', 
				'data' => '{"transformOrigin":"center 200%","x":"0","y":"0","opacity":"0","rotation":"-20","rotationX":"0","rotationY":"45","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Rotate In Left Top Big', 'test_plugin_textdomain' ),
				'value' => 'rotate_in_left_top_big', 
				'data' => '{"transformOrigin":"center -200%","x":"0","y":"0","opacity":"0","rotation":"90","rotationX":"0","rotationY":"-45","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),	
			array(
				'name' =>  __( 'Rotate In Right Top Big', 'test_plugin_textdomain' ),
				'value' => 'rotate_in_right_top_big', 
				'data' => '{"transformOrigin":"center -200%","x":"0","y":"0","opacity":"0","rotation":"-90","rotationX":"0","rotationY":"45","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Rotate In Left Bottom Big', 'test_plugin_textdomain' ),
				'value' => 'rotate_in_left_bottom_big', 
				'data' => '{"transformOrigin":"center 200%","x":"0","y":"0","opacity":"0","rotation":"90","rotationX":"0","rotationY":"-45","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),			
			array(
				'name' =>  __( 'Rotate In Right Bottom Big', 'test_plugin_textdomain' ),
				'value' => 'rotate_in_right_bottom_big', 
				'data' => '{"transformOrigin":"center 200%","x":"0","y":"0","opacity":"0","rotation":"-90","rotationX":"0","rotationY":"45","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),								
		)
	),	

	// Tilt In
	
	array(
		'group_name' => sprintf( '-- %s --', __( 'Tilt In', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' =>  __( 'Tilt In Up', 'test_plugin_textdomain' ),
				'value' => 'tilt_in_up', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"200","opacity":"0","rotation":"0","rotationX":"-45","rotationY":"0","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Tilt In Down', 'test_plugin_textdomain' ),
				'value' => 'tilt_in_down', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"-200","opacity":"0","rotation":"0","rotationX":"45","rotationY":"0","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Tilt In Right', 'test_plugin_textdomain' ),
				'value' => 'tilt_in_right', 
				'data' => '{"transformOrigin":"center center","x":"-200","y":"0","opacity":"0","rotation":"0","rotationX":"0","rotationY":"-45","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Tilt In Left', 'test_plugin_textdomain' ),
				'value' => 'tilt_in_left', 
				'data' => '{"transformOrigin":"center center","x":"200","y":"0","opacity":"0","rotation":"0","rotationX":"0","rotationY":"45","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),		
		)
	),
	
	// Turn In
	
	array(
		'group_name' => sprintf( '-- %s --', __( 'Turn In', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' =>  __( 'Turn in Bottom', 'test_plugin_textdomain' ),
				'value' => 'turn_in_bottom', 
				'data' => '{"transformOrigin":"center bottom","x":"0","y":"0","opacity":"0","rotation":"0","rotationX":"90","rotationY":"0","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),	
		
			array(
				'name' =>  __( 'Turn in Top', 'test_plugin_textdomain' ),
				'value' => 'turn_in_top', 
				'data' => '{"transformOrigin":"center top","x":"0","y":"0","opacity":"0","rotation":"0","rotationX":"-90","rotationY":"0","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),	
			
			array(
				'name' =>  __( 'Turn in Left', 'test_plugin_textdomain' ),
				'value' => 'turn_in_left', 
				'data' => '{"transformOrigin":"left top","x":"0","y":"0","opacity":"0","rotation":"0","rotationX":"0","rotationY":"90","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			
			array(
				'name' =>  __( 'Turn in Left Out', 'test_plugin_textdomain' ),
				'value' => 'turn_in_left_out', 
				'data' => '{"transformOrigin":"left top","x":"0","y":"0","opacity":"0","rotation":"0","rotationX":"0","rotationY":"-90","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),	
			
			array(
				'name' =>  __( 'Turn in Right', 'test_plugin_textdomain' ),
				'value' => 'turn_in_right', 
				'data' => '{"transformOrigin":"right top","x":"0","y":"0","opacity":"0","rotation":"0","rotationX":"0","rotationY":"-90","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),	
			
			array(
				'name' =>  __( 'Turn in Right Out', 'test_plugin_textdomain' ),
				'value' => 'turn_in_right_out', 
				'data' => '{"transformOrigin":"right top","x":"0","y":"0","opacity":"0","rotation":"0","rotationX":"0","rotationY":"90","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			)	
		)
		
	),	
	
	// Billboard In
	
	array(
		'group_name' => sprintf( '-- %s --', __( 'Billboard In', 'test_plugin_textdomain' ) ),		
		'group_data' => array(
			array(
				'name' =>  __( 'Billboard In Left', 'test_plugin_textdomain' ),
				'value' => 'billboard_in_left', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"0","opacity":"0","rotation":"-15","rotationX":"15","rotationY":"75","skewX":"0","skewY":"10","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Billboard In Right', 'test_plugin_textdomain' ),
				'value' => 'billboard_in_right', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"0","opacity":"0","rotation":"15","rotationX":"15","rotationY":"-75","skewX":"0","skewY":"-10","scaleX":"100","scaleY":"100"}'
			),
		)
	),
		
	// Spin
	
	array(
		'group_name' => sprintf( '-- %s --', __( 'Spin', 'test_plugin_textdomain' ) ),		
		'group_data' => array(
			array(
				'name' =>  __( 'Spin Left', 'test_plugin_textdomain' ),
				'value' => 'spin_left', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"0","opacity":"100","rotation":"0","rotationX":"0","rotationY":"360","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),
			array(
				'name' =>  __( 'Spin Right', 'test_plugin_textdomain' ),
				'value' => 'spin_right', 
				'data' => '{"transformOrigin":"center center","x":"0","y":"0","opacity":"100","rotation":"0","rotationX":"0","rotationY":"-360","skewX":"0","skewY":"0","scaleX":"100","scaleY":"100"}'
			),				
		
		)
	)

);


// Global Column Animation Filter
$test_plugin['column-transition'] = apply_filters( 'test_plugin_column_transition', $test_plugin['column-transition'] );


/**
 * Easings
 */	


$test_plugin['easing'] = array (
	array(
		'name' => __( 'Power0 linear', 'test_plugin_textdomain' ),
		'value' => 'easeNoneLinear'
	),
	array(
		'name' => __( 'Power1 easeIn', 'test_plugin_textdomain' ),
		'value' => 'easeInQuad'
	),
	array(
		'name' => __( 'Power1 easeOut', 'test_plugin_textdomain' ),
		'value' => 'easeOutQuad'
	),
	array(
		'name' => __( 'Power1 easeInOut', 'test_plugin_textdomain' ),
		'value' => 'easeInOutQuad'
	),
	array(
		'name' => __( 'Power2 easeIn', 'test_plugin_textdomain' ),
		'value' => 'easeInCubic'
	),
	array(
		'name' => __( 'Power2 easeOut', 'test_plugin_textdomain' ),
		'value' => 'easeOutCubic'
	),
	array(
		'name' => __( 'Power2 easeInOut', 'test_plugin_textdomain' ),
		'value' => 'easeInOutCubic'
	),
	array(
		'name' => __( 'Power3 easeIn', 'test_plugin_textdomain' ),
		'value' => 'easeInQuart'
	),
	array(
		'name' => __( 'Power3 easeOut', 'test_plugin_textdomain' ),
		'value' => 'easeOutQuart'
	),
	array(
		'name' => __( 'Power3 easeInOut', 'test_plugin_textdomain' ),
		'value' => 'easeInOutQuart'
	),
	array(
		'name' => __( 'Power4 easeIn', 'test_plugin_textdomain' ),
		'value' => 'easeInQuint'
	),
	array(
		'name' => __( 'Power4 easeOut', 'test_plugin_textdomain' ),
		'value' => 'easeOutQuint'
	),
	array(
		'name' => __( 'Power4 easeInOut', 'test_plugin_textdomain' ),
		'value' => 'easeInOutQuint'
	),
	array(
		'name' => __( 'Sine easeIn', 'test_plugin_textdomain' ),
		'value' => 'easeInSine'
	),
	array(
		'name' => __( 'Sine easeOut', 'test_plugin_textdomain' ),
		'value' => 'easeOutSine'
	),
	array(
		'name' => __( 'Sine easeInOut', 'test_plugin_textdomain' ),
		'value' => 'easeInOutSine'
	),
	array(
		'name' => __( 'Expo easeIn', 'test_plugin_textdomain' ),
		'value' => 'easeInExpo'
	),
	array(
		'name' => __( 'Expo easeOut', 'test_plugin_textdomain' ),
		'value' => 'easeOutExpo'
	),
	array(
		'name' => __( 'Expo easeInOut', 'test_plugin_textdomain' ),
		'value' => 'easeInOutExpo'
	),
	array(
		'name' => __( 'Circ easeIn', 'test_plugin_textdomain' ),
		'value' => 'easeInCirc'
	),
	array(
		'name' => __( 'Circ easeOut', 'test_plugin_textdomain' ),
		'value' => 'easeOutCirc'
	),
	array(
		'name' => __( 'Circ easeInOut', 'test_plugin_textdomain' ),
		'value' => 'easeInOutCirc'
	),
	array(
		'name' => __( 'Elastic easeIn', 'test_plugin_textdomain' ),
		'value' => 'easeInElastic'
	),
	array(
		'name' => __( 'Elastic easeOut', 'test_plugin_textdomain' ),
		'value' => 'easeOutElastic'
	),
	array(
		'name' => __( 'Elastic easeInOut', 'test_plugin_textdomain' ),
		'value' => 'easeInOutElastic'
	),
	array(
		'name' => __( 'Back easeIn', 'test_plugin_textdomain' ),
		'value' => 'easeInBack'
	),
	array(
		'name' => __( 'Back easeOut', 'test_plugin_textdomain' ),
		'value' => 'easeOutBack'
	),
	array(
		'name' => __( 'Back easeInOut', 'test_plugin_textdomain' ),
		'value' => 'easeInOutBack'
	),
	array(
		'name' => __( 'Bounce easeIn', 'test_plugin_textdomain' ),
		'value' => 'easeInBounce'
	),
	array(
		'name' => __( 'Bounce easeOut', 'test_plugin_textdomain' ),
		'value' => 'easeOutBounce'
	),
	array(
		'name' => __( 'Bounce easeInOut', 'test_plugin_textdomain' ),
		'value' => 'easeInOutBounce'
	)
);

// Global Column Animation Easing Filter
$test_plugin['easing'] = apply_filters( 'test_plugin_easing', $test_plugin['easing'] );
?>