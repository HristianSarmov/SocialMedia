import React, { useState } from "react";
import ReactDom, { render } from "react-dom";
import Picker, { SKIN_TONE_MEDIUM_DARK } from "emoji-picker-react";

const App = () => {

  const emojiButtonSpan = document.getElementById("currentpost");
  const onEmojiClick = (event, emojiObject) => {
	  
	if (document.getElementById("action").getAttribute("value") == "comment") {
		document.getElementById("commentText"+emojiButtonSpan.getAttribute("value")).value += emojiObject.emoji;
	}
	else if (document.getElementById("action").getAttribute("value") == "updatecaption") {
		document.getElementById("addnewpostcaption"+emojiButtonSpan.getAttribute("value")).value += emojiObject.emoji;
	}
	else if (document.getElementById("action").getAttribute("value") == "newcaption") {
		document.getElementById("addnewpostcaption"+document.getElementById("session").getAttribute("value")).value += emojiObject.emoji;
	}
  };
  
  const observer = new MutationObserver(function() {
	
	ReactDom.render(
	<div class="fade" id="emojiModal" data-backdrop="false" tabindex="-1" aria-labelledby="emojiModalLabel" aria-hidden="true"  style={{position: "fixed", bottom: 0, right: 0, zIndex: 1050}}>
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="emojiModalLabel">Emojis</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
				<Picker
				  onEmojiClick={onEmojiClick}
				  disableAutoFocus={true}
				  skinTone={SKIN_TONE_MEDIUM_DARK}
				  groupNames={{ smileys_people: "PEOPLE" }}
				  native
				/>
			</div>
		</div>
	</div>
	  , document.getElementById("emojidiv"));
  });

  observer.observe(emojiButtonSpan, {characterData: false, childList: false, attributes: true});
};

export default App;
