<?php
/**
 * Theme options dependency class.
 *
 * @package the7\Options
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Options_Fields_Dependency', false ) ) :

	/**
	 * Theme options dependency class.
	 */
	class Presscore_Options_Fields_Dependency {

		/**
		 * @var array
		 */
		protected $dependencies = array();

		/**
		 * Store dependencies.
		 *
		 * @param string $id
		 * @param array $dep
		 */
		public function set( $id, $dep ) {
			// AND.
			foreach ( $dep as &$and_parts ) {
				// OR.
				foreach ( $and_parts as &$or_part ) {
					$or_part = $this->prepare_dependency( $or_part );
				}
			}

			$this->dependencies[ $id ] = $dep;
		}

		/**
		 * Return dependency array.
		 *
		 * @param string $id
		 *
		 * @return array|null
		 */
		public function get( $id ) {
			if ( isset( $this->dependencies[ $id ] ) ) {
				return $this->dependencies[ $id ];
			}

			return null;
		}

		/**
		 * Return all stored dependencies.
		 *
		 * @return array
		 */
		public function get_all() {
			return $this->dependencies;
		}

		/**
		 * Reduce dependency to understandable values.
		 *
		 * @param array $dependency
		 *
		 * @return array
		 */
		protected function prepare_dependency( $dependency ) {
			// Dependency from theme option value.
			if ( isset( $dependency['option'], $dependency['operator'], $dependency['value'] ) ) {
				$option_value = of_get_option( $dependency['option'] );
				if ( $dependency['operator'] === '!=' ) {
					$result = ( $option_value != $dependency['value'] );
				} else {
					$result = ( $option_value == $dependency['value'] );
				}

				return array(
					'bool_value' => $result,
				);
			}

			return $dependency;
		}
	}

endif;

if ( ! function_exists( 'optionsframework_fields_dependency' ) ) :

	/**
	 * Returns object with stored options dependencies.
	 * 
	 * @since 3.0.0
	 * 
	 * @return Presscore_Options_Fields_Dependency
	 */
	function optionsframework_fields_dependency() {
		static $dep_obj = null;

		if ( null === $dep_obj ) {
			$dep_obj = new Presscore_Options_Fields_Dependency();
		}

		return $dep_obj;
	}

endif;
