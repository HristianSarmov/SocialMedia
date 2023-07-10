import React from 'react';
import ReactDOM from 'react-dom';
import Image from './Image';
import deletePhoto from '../index';
import styles from './imagecss.module.css';
import ImageModal from './ImageModal';

class Gallery extends Image {
	constructor(props) {
		super(props);
		this.deletephoto = this.deletephoto.bind(this);
	}
	deletephoto(image_id, imageindex) {
		deletePhoto(this.props.obj, image_id, imageindex);
	}
	render() {
		let imagerow = [];
		for (let i = 0 ; i < this.props.obj.photos.length ; i++) {
			imagerow.push(
				<div class="col-12 col-sm-6 col-md-4">
					<div className={styles.imgcontainer}>
						<Image deletephoto={this.deletephoto} src={this.props.obj.photos[i]} imageindex={i}/>
					</div>
				</div>
			);
		}
		return (
			<div class="row">
				{imagerow}
			</div>
		);
	}
};

export default Gallery;
