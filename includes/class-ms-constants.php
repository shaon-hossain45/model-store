<?php
/**
 * Autoloader includes class for the plugin.
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://https://github.com/shaon-hossain45/
 * @since      1.0.0
 *
 * @package    Model_Store
 * @subpackage Model_Store/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * The core plugin includes class constants.
 *
 * This is used to define files load, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Model_Store
 * @subpackage Model_Store/includes
 * @author     Shaon Hossain <shaonhossain615@gmail.com>
 */
class MS_Constants {
	/**
	 * A container for all defined constants.
	 *
	 * @access public
	 * @static
	 *
	 * @var array.
	 */
	public static $set_constants = array();

	/**
	 * Checks if a "constant" has been set in constants Manager
	 * and has a truthy value (e.g. not null, not false, not 0, any string).
	 *
	 * @param string $name The name of the constant.
	 *
	 * @return bool
	 */
	public static function is_true( $name ) {
		return self::is_defined( $name ) && self::get_constant( $name );
	}

	/**
	 * Checks if a "constant" has been set in constants Manager, and if not,
	 * checks if the constant was defined with define( 'name', 'value ).
	 *
	 * @param string $name The name of the constant.
	 *
	 * @return bool
	 */
	public static function is_defined( $name ) {
		return array_key_exists( $name, self::$set_constants )
			? true
			: defined( $name );
	}

	/**
	 * Attempts to retrieve the "constant" from constants Manager, and if it hasn't been set,
	 * then attempts to get the constant with the constant() function. If that also hasn't
	 * been set, attempts to get a value from filters.
	 *
	 * @param string $name The name of the constant.
	 *
	 * @return mixed null if the constant does not exist or the value of the constant.
	 */
	public static function get_constant( $name ) {
		if ( array_key_exists( $name, self::$set_constants ) ) {
			return self::$set_constants[ $name ];
		}

		if ( defined( $name ) ) {
			return constant( $name );
		}
	}

	/**
	 * Sets the value of the "constant" within constants Manager.
	 *
	 * @param string $name The name of the constant.
	 * @param string $value The value of the constant.
	 */
	public static function set_constant( $name, $value ) {
		self::$set_constants[ $name ] = $value;
	}

	/**
	 * Will unset a "constant" from constants Manager if the constant exists.
	 *
	 * @param string $name The name of the constant.
	 *
	 * @return bool Whether the constant was removed.
	 */
	public static function clear_single_constant( $name ) {
		if ( ! array_key_exists( $name, self::$set_constants ) ) {
			return false;
		}

		unset( self::$set_constants[ $name ] );

		return true;
	}

	/**
	 * Resets all of the constants within constants Manager.
	 */
	public static function clear_constants() {
		self::$set_constants = array();
	}
}
