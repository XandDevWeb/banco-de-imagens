<?php

require_once 'connection.php';

/**
 * class ShowImage
 * responsável por entregar as imagens
 */
class ShowImage
{
	private $table = null;
	private $query = null;
	private $where = null;
	private $con = null;
	
	function __construct( $tb )
	{
		$this->table = $tb;

		$connection = new Connection( 'workimages' );
		$this->con = $connection->getConnection();
	}

	private function setQueryWhere( $wr )
	{
		$this->query = "DELETE FROM $this->table WHERE code = '$wr'";
	}

	public function selectImage( $wr )
	{
		$this->setQueryWhere( $wr );

		$response = mysqli_query( $this->con, $this->query );

		$return = $response
			? array( 'status' => 'success', 'body' => 'apagada' )
			: array( 'status' => 'fail', 'body' => 'falha ao apagar' );

		echo json_encode( $return );

	}
}

$showImages = new ShowImage( 'images' );

$showImages->selectImage( $_GET['code'] );


?>