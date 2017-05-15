<?php

Class SQL
{
	const HOST = 'localhost';
	const DB_NAME = 'blogpric_base';
	const USER = 'root';
	const PASSWORD = '';
	protected static $INSTANCE = NULL;
	
	public static function instance()
	{
		if ( self::$INSTANCE === NULL )
		{
			self::$INSTANCE = new PDO( 'mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME . ';charset=utf8', self::USER, self::PASSWORD );
			self::$INSTANCE -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		
		return self::$INSTANCE;
	}
	public static function __callStatic( $method, $args )
	{
		return call_user_func_array ( [ self::instance(), $method ], $args );
	}
	public static function P( $sql, $args = [] )
	{
		$stmt = self::instance() -> prepare( $sql );
		$stmt -> execute( $args );
		
		return $stmt;
	}
}