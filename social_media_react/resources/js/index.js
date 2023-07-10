import ReactDOM from 'react-dom';
import App from './components/Emoji-textarea';
import Gallery from './components/Gallery';

function wait() {
	ReactDOM.render(
			<div class="d-flex justify-content-center">
			  <div class="spinner-border" role="status">
				<span class="sr-only">Loading...</span>
			  </div>
			</div>, document.getElementById('root'));
}

const deletePhoto = function (galleryobj, image_id, imageindex) {
	if (confirm("Are you sure you want to delete this image from it's post?")) {
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
			const obj = JSON.parse(this.responseText);
			if (obj.success) {
				galleryobj.photos.splice(imageindex,1);
				ReactDOM.render(<Gallery obj={galleryobj}/>, document.getElementById('root'));
			}
		};
		xhttp.open("GET", "/deletepicturefrompost/"+image_id);
		xhttp.send();
	}
}

export default deletePhoto;

if (document.getElementById('root')) {
	wait();
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const obj = JSON.parse(this.responseText);		
		ReactDOM.render(<Gallery obj={obj}/>, document.getElementById('root'));
	};
	xhttp.open("GET", "/getallphotos/"+document.getElementById("person").getAttribute("value"));
	xhttp.send();
	
}

if (document.getElementById("emojidiv")) {
	ReactDOM.render(<App />, document.getElementById("emojidiv"));
}
