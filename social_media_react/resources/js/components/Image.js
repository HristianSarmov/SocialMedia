import React from 'react';
import ReactDOM from 'react-dom';
import Gallery from './Gallery';
import styles from './imagecss.module.css';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faTrash } from '@fortawesome/free-solid-svg-icons'
import ImageModal from './ImageModal';

class Image extends React.Component {
	constructor(props) {
		super(props);
	}
	
	renderModal() {
		ReactDOM.render(<ImageModal ImageFile={"/content/"+this.props.src.ImageFile}/>, document.getElementById('modalspace'));
	}
	
	render() {
		const imgext = this.props.src.ImageFile.split('.').pop();
		if (imgext == 'png' || imgext == 'jpeg' || imgext == 'apng' || imgext == 'gif' || imgext == 'ico' ||
			imgext == 'svg' || imgext == 'cur' || imgext == 'jpg' || imgext == 'jfif' || imgext == 'pjpeg' || imgext == 'pjp') {
			if (document.getElementById('person').getAttribute("value") == document.getElementById("session").getAttribute('value')) {
				return (
					<div class="container2">
						<input type="image" src={"/content/"+this.props.src.ImageFile} className={styles.galleryimage} style={{objectFit: "contain"}} onClick={this.renderModal.bind(this)}/>

						<button onClick={this.props.deletephoto.bind(this,this.props.src.ImageID,this.props.imageindex)} className={styles.btn} style={{background: "transparent", border: "none"}}><FontAwesomeIcon icon={faTrash} /></button>
					</div>
				);
			}
			else {
				return (
					<div class="container2">
						<input type="image" src={"/content/"+this.props.src.ImageFile} className={styles.galleryimage} style={{objectFit: "contain"}} onClick={this.renderModal.bind(this)}/>
					</div>
				);
			}
		}
		else if (imgext == 'mp4' || imgext == 'webm' || imgext == 'ogg') {
			 if (document.getElementById('person').getAttribute("value") == document.getElementById("session").getAttribute('value')) {
				return (
					<div class="container2"  style={{position: "relative"}}>
						<button onClick={this.props.deletephoto.bind(this,this.props.src.ImageID,this.props.imageindex)} className={styles.btn} style={{background: "transparent", border: "none"}}><FontAwesomeIcon icon={faTrash} /></button>
						<video alt="No video found" controls className={styles.galleryimage}>
							<source src={"/content/"+this.props.src.ImageFile} type="video/mp4"/>
							<source src={"/content/"+this.props.src.ImageFile} type="video/webm"/>
							<source src={"/content/"+this.props.src.ImageFile} type="video/ogg"/>
						</video>
					</div>
				);
			}
			else {
				return (
					<div class="container2">
						<video alt="No video found" controls className={styles.galleryimage}>
							<source src={"/content/"+this.props.src.ImageFile} type="video/mp4"/>
							<source src={"/content/"+this.props.src.ImageFile} type="video/webm"/>
							<source src={"/content/"+this.props.src.ImageFile} type="video/ogg"/>
						</video>
					</div>
				);
			}
		}
		else if (imgext == 'mp3' || imgext == 'wav') {
			if (document.getElementById('person').getAttribute("value") == document.getElementById("session").getAttribute('value')) {
				return (
					<div class="container2">
						<audio class="d-block mx-auto" controls alt="No audio found" >
							<source src={"/content/"+this.props.src.ImageFile} type="audio/mp3" />
							<source src={"/content/"+this.props.src.ImageFile} type="audio/wav" />
						</audio>
						<button onClick={this.props.deletephoto.bind(this,this.props.src.ImageID,this.props.imageindex)} className={styles.btn} style={{background: "transparent", border: "none"}}><FontAwesomeIcon icon={faTrash} /></button>
					</div>
				);
			}
			else {
				return (
					<div class="container2">
						<audio class="d-block mx-auto" controls alt="No audio found" >
							<source src={"/content/"+this.props.src.ImageFile} type="audio/mp3" />
							<source src={"/content/"+this.props.src.ImageFile} type="audio/wav" />
						</audio>
					</div>
				);
			}
		}
	}
};

export default Image;