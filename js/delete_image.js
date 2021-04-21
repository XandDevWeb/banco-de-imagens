
const getImageFullScreen = code =>
{
	const image = document.querySelector(`.images div [data-code="${code}"]`)

	if ( image.requestFullscreen )
	{
	    image.requestFullscreen();
	}
	else if ( image.webkitRequestFullscreen )
	{
		image.webkitRequestFullscreen();
	}
	else if ( image.msRequestFullscreen )
	{
	    image.msRequestFullscreen();
	}
}

const deleteImage = async event =>
{
	const dataCode = event.target.dataset.code
	const trashClicked = dataCode && event.target.dataset.name === "trash"

	if ( trashClicked )
	{
		const response = await fetch( `../php/delete_image.php?code=${dataCode}` )
			.then( response => response.json() )

		showMessage( response.body, response.status )
		insertImagesInToDOM()
	}
	else
	{

		getImageFullScreen( dataCode )
	}
}

imagesContainer.addEventListener( "click", deleteImage )