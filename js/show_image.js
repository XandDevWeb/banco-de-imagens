
const getCodes = async () =>
{
	const response = await fetch( "../php/show_image.php?selectcodes" )
	.then( response => response.json() )

	return response
}

const insertImagesInToDOM = async () =>
{
	const codes = await getCodes()
	clearImages()

	codes
		.forEach( code => imagesContainer.appendChild( createImage( code ) ) )
}

window.addEventListener( "load", insertImagesInToDOM )