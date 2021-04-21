
const getFormData = () => new FormData( formContainer )

const postImage = async event =>
{
	const data = getFormData()

	const response = await fetch
	(
		"../php/upload_image.php",
		{
			method: "POST",
			body: data
		}
	)
	.then( response => response.json() )

	showMessage( response.status, response.className )
	insertImagesInToDOM()
}

formContainer.addEventListener( "submit", event => {

	event.preventDefault()

	postImage()

	formContainer.reset()
} )