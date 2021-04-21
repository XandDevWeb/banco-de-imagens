<?php

/**
 * class Upload
 * responsável por fazer os uploads das imagens
 */
require_once 'connection.php';

class Upload
{
	private $table = null;
	private $fields = null;
	private $values = null;
	private $query = null;
	private $con = null;
	
	function __construct( $tb )
	{
		$this->table = $tb;
		$connection = new Connection( 'workimages' );
		$this->con = $connection->getConnection();
	}

	private function setQuery ()
	{
		$this->query =
			"INSERT INTO $this->table ( $this->fields ) VALUES ( '$this->values' )";
	}

	public function insert ( $arrFields, $arrValues )
	{
		$this->fields = implode( ',', $arrFields );
		$this->values = implode( ',', $arrValues );
		$this->setQuery();

		mysqli_query( $this->con, $this->query );
	}

}

if( !isset( $_FILES['image'] ) )
{
	echo json_encode( array( 'status' => 'tipo nao aceito', 'className' => 'fail') );
	die( "" );
}

$imageSize = $_FILES['image']['size'];
$imageTmpName = $_FILES['image']['tmp_name'];
$imageType = $_FILES['image']['type'];

$typeIsNotAcepted = $imageType != 'image/jpeg' && $imageType != 'image/png' && $imageType != 'image/gif';
if ( $typeIsNotAcepted )
{
	echo json_encode( array( 'status' => 'tipo nao aceito', 'className' => 'fail') );
	die( "" );
}

if ( !$imageTmpName )
{
	echo json_encode( array( 'status' => 'falha', 'className' => 'fail') );
	die( "" );
}

$fileOpened = fopen( $imageTmpName, "rb" );
$image = fread( $fileOpened, $imageSize );
$image = addslashes( $image );
fclose( $fileOpened );

$fields = array( 'image' );
$values = array( $image );

$upload = new Upload( 'images' );
$upload->insert( $fields, $values );

echo json_encode( array( 'status' => 'sucesso', 'className' => 'success') );

?>