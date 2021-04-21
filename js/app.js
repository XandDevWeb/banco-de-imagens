const formContainer = document.querySelector("form")
const imagesContainer = document.querySelector( ".images" )

const showMessage = ( message, className ) =>
{
	const div = document.createElement( "div" )
	const text = document.createTextNode( message )

	div.classList.add( "message", className )
	div.appendChild( text )

	setTimeout( () => { div.remove() }, 1200 )

	formContainer.appendChild( div )
}

const createElement = ( elementName, arrAttributes ) =>
{
	const element = document.createElement( elementName )

	arrAttributes
		? arrAttributes.forEach( attribute => element.setAttribute( attribute.name, attribute.value ) )
		: false

	return element

}

const attributes =
{
	div: () => [{ name: "class", value: "image-container" }],
	img: code => [
		{ name: "src", value: `../php/show_image.php?selectimage=${code}` },
		{ name: "data-code", value: code }
	],
	trash: code => [
		{ name: "class", value: "trash" },
		{ name: "src", value: "../img/trash.svg" },
		{ name: "alt", value: "Excluir" },
		{ name: "data-code", value: code },
		{ name: "data-name", value: "trash" },
		{ name: "title", value: "Excluir" }
	],
	fullScreen: code => [
		{ name: "class", value: "full-screen" },
		{ name: "src", value: "../img/full-screen.svg" },
		{ name: "alt", value: "Ver maior" },
		{ name: "data-code", value: code },
		{ name: "title", value: "Tela Cheia" }
	]
}

const createImage = code =>
{
	const div = createElement( "div", attributes.div() )
	const span = createElement( "span" )

	const img = createElement( "img", attributes.img( code ) )
	const trash = createElement( "img", attributes.trash( code ) )
	const fullScreen = createElement( "img", attributes.fullScreen( code ) )

	const divOverride = createElement( "div", [{ name: "class", value: "override" }] )

	span.appendChild( trash )
	span.appendChild( fullScreen )

	div.appendChild( divOverride )
	div.appendChild( img )
	div.appendChild( span )

	return div
}

const clearImages = () =>
{
	const images = Array.from( document.querySelectorAll( ".images > div" ) )

	images
		? images.forEach( div => div.remove() )
		: false
}

// const cancelClick = event =>
// {
// 	event.preventDefaul()
// }

// imagesContainer.addEventListener( "click", cancelClick )