<?php

require('env.php');

class DB
{
	protected static $db;
	protected static $table;
	private static $instance;
	private static $query;

	public static function init()
	{
		$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET . ';';
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false,
		];

		try
		{
			self::$db = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $options);
		}

		catch(\PDOException $e)
		{
			throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}

		if(is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public static function table($name)
	{
		self::init();
		self::$table = $name;

		if(is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function select()
	{
		self::$query = 'SELECT * FROM ' . self::$table;
		return $this;
	}

	public function get()
	{
		return self::$db->query(self::$query);
	}
}