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
	private $fields = null;
	private $con = null;
	
	function __construct( $tb )
	{
		$this->table = $tb;

		$connection = new Connection( 'workimages' );
		$this->con = $connection->getConnection();
	}

	private function setQuery()
	{
		$this->query = "SELECT $this->fields FROM $this->table";
	}

	private function setQueryWhere( $wr )
	{
		$this->query = "SELECT $this->fields FROM $this->table WHERE code = '$wr'";
	}

	public function selectCodes( $arrFields )
	{
		$this->fields = implode( ',', $arrFields );
		$this->setQuery();

		$response = mysqli_query( $this->con, $this->query );

		$arrCodes = array();

		while ( $codeObject = mysqli_fetch_array( $response ) ) {

		 	array_push($arrCodes, $codeObject[ $this->fields ]);
		 }

		echo json_encode( $arrCodes );

	}

	public function selectImage( $wr, $arrFields )
	{
		$this->fields = implode( ',', $arrFields );
		$this->setQueryWhere( $wr );

		$response = mysqli_query( $this->con, $this->query );
		$imgObject = mysqli_fetch_object( $response );
		$image = $imgObject->image;

		Header( "Content-type: image/jpg" );
		echo $image;
	}
}

$showImages = new ShowImage( 'images' );

if ( isset( $_GET['selectcodes'] ) )
{
	$showImages->selectCodes( array('code') );
}

if ( isset( $_GET['selectimage'] ) )
{
	$showImages->selectImage( $_GET['selectimage'], array('image') );
}


?>