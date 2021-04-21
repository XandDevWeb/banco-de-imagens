<?php

/**
 * A conexão com a base de dados 'workimage'
 * será feita a partir deste arquivo.
 */
class Connection
{
	private $host = 'localhost';
	private $user = 'root';
	private $password = '';
	private $dataBase = null;

	private $connection = null;

	public function __construct( $db )
	{
		$this->setDataBase( $db );
		$this->start();
	}

	private function setDataBase ( $dataBaseName )
	{
		$this->dataBase = $dataBaseName;
	}

	public function getConnection ()
	{
		return $this->connection;
	}

	private function start ()
	{
		$this->connection =
			mysqli_connect(
				$this->host,
				$this->user,
				$this->password,
				$this->dataBase
			);

		if ( !$this->connection )
			die('Error on database connection.');

		return $this->connection;
	}

	public function stop ()
	{
		mysqli_close( $this->connection );
	}
}

?>