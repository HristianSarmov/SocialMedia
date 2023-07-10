import React from 'react';
import ReactDOM from 'react-dom';
import styles from './imagecss.module.css';

class ImageModal extends React.Component {
	constructor(props) {
		super(props);
	}
	
	closeModal() {
		ReactDOM.render("", document.getElementById('modalspace'));
	}
	
	render() {
		return(
			<div className={styles.imagemodal} onClick={this.closeModal.bind(this)}>
				<div class="modal-dialog modal-dialog-centered" style={{maxWidth: "100%"}}>
					<img src={this.props.ImageFile} style={{maxHeight: "100%", maxWidth: "100%", height: "auto", marginLeft: "auto", marginRight: "auto", minHeight: "400px"}}/>
				</div>
			</div>
		);
	}
}

export default ImageModal;