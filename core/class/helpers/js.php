<?php

class js extends asset {
	public static $type = 'js';

	static public function add () {
		parent::add( self::$type, (array)func_get_args() );
	}

	public static function minify ( $new_file = 'minify' ) {
		return parent::minify( $new_file, self::$type );
	}

	public static function get () {
		return parent::get( self::$type );
	}
}