<div id="post{{ $post -> PostID }}" class="post border-radius-5">

		<table style="width: 100%;">
			<tbody>
				<tr>
					<td>
						<img src="{{ asset('content/'.$post -> ProfilePic) }}" class='listprofilephoto'>
					</td>
					<td>
						<b style="font-size: 20px;">{{ $post -> FirstName }} {{ $post -> LastName }}</b>
						<br>
						<a href="/profile/{{ $post -> Username }}" style="font-size: 17px; text-decoration: none; color: black;">{{ $post -> Username }}</a>
					</td>
					<td>
						<div>
							<a>{{ $post -> DateAndTime }}</a>&nbsp&nbsp&nbsp
							@if ($post -> isLiked == "Not Liked")
								<button type="button" class="btn btn-primary" id="LikeButton{{ $post -> PostID }}" onClick='clicklike("{{ $post -> PostID }}");'><i class="fa fa-thumbs-up fa-2x"></i></button>
							@else 
								<button type="button" class="btn btn-primary active" id="LikeButton{{ $post -> PostID }}" onClick='clicklike("{{ $post -> PostID }}");'><i class="fa fa-thumbs-up fa-2x"></i></button>
							@endif
							<input type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapselikes{{ $post -> PostID }}" id="ShowLikesButton{{ $post -> PostID }}" value='Show Likes' onClick='clicklikes("#ShowLikesButton{{ $post -> PostID }}", "{{ $post -> PostID }}", "collapselikes{{ $post -> PostID }}"); jQuery(this).toggleClass("active");'>
							<button type="button" id="commentButton{{ $post -> PostID }}" class="btn btn-primary" data-toggle="collapse" data-target="#comment{{ $post -> PostID }}" onClick="jQuery(this).toggleClass('active');"><i class="fa fa-comment fa-2x" aria-hidden="true"></i></button>
							<input type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapsecomments{{ $post -> PostID }}" id="ShowCommentsButton{{ $post -> PostID }}" value="Show Comments" onClick='clickcomments("#ShowCommentsButton{{ $post -> PostID }}", "{{ $post -> PostID }}", "collapsecomments{{ $post -> PostID }}", {{ session() -> get("PersonID") }}, "{{ $post -> PersonID }}"); jQuery(this).toggleClass("active");'>
						</div>
					</td>
					@if ($post -> PersonID == session() -> get('PersonID'))
						<td class="float-right">
							<button class="btn-transparent" onclick="deletepost('{{ $post -> PostID }}');"><i class="fa fa-trash fa-2x text-danger" aria-hidden="true"></i></button>
						</td>
					@endif
				</tr>
			</tbody>
		</table>
		<a id='postCaption{{ $post -> PostID }}' style="font-size: 20px;">{{ $post -> Caption }}</a>
		@if ($post -> PersonID == session() -> get('PersonID'))
			<button class="btn-transparent" onclick="document.getElementById('updateCaption' + {{ $post -> PostID }}).style.display='block'"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></button>
		@endif
		<br>
		<div id="carouselExampleControls{{ $post -> PostID }}" class="carousel slide" data-ride="carousel" style="height: 200px;">
		  <div class="carousel-inner" style="height: 200px;">
			@if (isset($post->Images[0]))
			  <div id="carouselitem{{ $post -> Images[0] -> ImageID}}" class="carousel-item active" style="height: 200px;">
			@else
			  <div class="carousel-item active" style="height: 200px;">
			@endif
			  @if (isset($post->Images[0]))
			    <div class="numbertext">1 / {{ count($post -> Images) }}</div>
				@if (pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'png' ||
					 pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'jpeg' ||
					 pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'apng' ||
					 pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'gif' ||
					 pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'ico' ||
					 pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'svg' ||
					 pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'cur' ||
					 pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'jpg' ||
					 pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'jfif' ||
					 pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'pjpeg' ||
					 pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'pjp')
					<img src="{{ asset('/content/'.$post->Images[0]->ImageFile) }}" class="d-block mx-auto" alt="No image found"  style="max-height: 100%; max-width: 100%; height:auto;">
				@elseif (pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'mp4' ||
						 pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'webm' ||
						 pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'ogg')
					<video class="d-block mx-auto" alt="No video found" controls  style="max-height: 100%; max-width: 100%; height:auto;">
						<source src="{{ asset('/content/'.$post->Images[0]->ImageFile) }}">
					</video>
				@elseif (pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'mp3' ||
						 pathinfo('/content/'.$post->Images[0]->ImageFile, PATHINFO_EXTENSION) == 'wav')
					<audio src="{{ asset('/content/'.$post->Images[0]->ImageFile) }}" controls class="d-block mx-auto" alt="No audio found"></audio>
			    @endif
			  @else
				<img src="{{ asset('/content/noimage.png') }}" class="d-block mx-auto" alt="No image found"  style="max-height: 100%; max-width: 100%; height:auto;">
			  @endif
			  @if ($post -> PersonID == session() -> get('PersonID'))
				<button class='plus' onclick="document.getElementById('exampleModal').style.display='block'"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>
				@if (isset($post->Images[0]))
					<button class='trash btn-transparent' onclick="deleteFromPost('{{ $post->Images[0]->ImageID }}', 'carouselitem{{ $post -> Images[0] -> ImageID}}');"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
				@endif
			  @endif
			</div>
			@for ($ImageFile = 1 ; $ImageFile < count($post -> Images) ; $ImageFile++)
				<div id="carouselitem{{ $post -> Images[$ImageFile] -> ImageID}}" class="carousel-item" style="height:200px;">
				  <div class="numbertext">{{ $ImageFile+1 }} / {{ count($post -> Images) }}</div>
				  @if (pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'png' ||
					 pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'jpeg' ||
					 pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'apng' ||
					 pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'gif' ||
					 pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'ico' ||
					 pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'svg' ||
					 pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'cur' ||
					 pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'jpg' ||
					 pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'jfif' ||
					 pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'pjpeg' ||
					 pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'pjp')
					
					<img src="{{ asset('/content/'.$post->Images[$ImageFile]->ImageFile) ?? asset('/content/noimage.png') }}" class="d-block mx-auto" alt="No image found"  style="max-height: 100%; max-width: 100%; height:auto;">
				  @elseif (pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'mp4' ||
						 pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'webm' ||
						 pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'ogg')
					<video width="320" height="240" class="d-block mx-auto" controls  style="max-height: 100%; max-width: 100%; height:auto;">
						<source src="{{ asset('/content/'.$post->Images[$ImageFile]->ImageFile) ?? asset('/content/noimage.png') }}" type="video/mp4">
						<source src="{{ asset('/content/'.$post->Images[$ImageFile]->ImageFile) ?? asset('/content/noimage.png') }}" type="video/webm">
						<source src="{{ asset('/content/'.$post->Images[$ImageFile]->ImageFile) ?? asset('/content/noimage.png') }}" type="video/ogg">
						Your browser does not support the video tag.
					</video>
				  @elseif (pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'mp3' ||
						 pathinfo('/content/'.$post->Images[$ImageFile]->ImageFile, PATHINFO_EXTENSION) == 'wav')
					<audio class="d-block mx-auto" controls>
						<source src="{{ asset('/content/'.$post->Images[$ImageFile]->ImageFile) ?? asset('/content/noimage.png') }}" type="audio/mp3">
						<source src="{{ asset('/content/'.$post->Images[$ImageFile]->ImageFile) ?? asset('/content/noimage.png') }}" type="audio/wav">
					</audio>
				  @endif
				  @if ($post -> PersonID == session() -> get('PersonID'))
					<button class="plus" onclick="document.getElementById('exampleModal').style.display='block'"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>
					<button class='trash btn-transparent' onclick="deleteFromPost('{{ $post->Images[$ImageFile]->ImageID }}', 'carouselitem{{ $post -> Images[$ImageFile] -> ImageID}}');"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
				  @endif
				</div>
			@endfor
		  </div>
		  <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls{{ $post -> PostID }}" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden"></span>
		  </button>
		  <button class="carousel-control-next" type="button" data-target="#carouselExampleControls{{ $post -> PostID }}" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden"></span>
		  </button>
			<div id="exampleModal" class="modal1">
			  <span onclick="document.getElementById('exampleModal').style.display='none'" class="close1" title="Close Modal">&times;</span>
			  <form class="modal-content1" action="/addimagestopost/{{ $post -> PostID }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="container1">
				  <h2 style="float: left;">Add images to the post</h2>
				  <br>
				  <input class="float-left" id="addimagesinput{{ $post -> PostID }}" name="addimagesinput{{ $post -> PostID }}[]" type="file" accept="image/*, video/*, audio/*" multiple>
				  <br><br>
				  <div class="clearfix1 float-right">
					<button type="button" class="btn btn-secondary" onclick="document.getElementById('exampleModal').style.display='none'">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				  </div>
				</div>			  
		      </form>
			</div>
		</div>
			
		<div class="collapse mt-1" id="collapselikes{{ $post -> PostID }}">
			
		</div>
		<div class="collapse" id="comment{{ $post -> PostID }}">
			<div class="card card-body bg-primary">
				<div class="input-group flex-nowrap">
					<span class="input-group-text" id="addon-wrapping"><i class="fa fa-comment" aria-hidden="true"></i></span>
					<textarea id="commentText{{ $post -> PostID }}" required type="text" class="form-control" placeholder="Comment" aria-label="Username" aria-describedby="addon-wrapping"></textarea>&nbsp
					<button class="btn-transparent" data-toggle="modal" data-target="#emojiModal" onclick="openemojilist('{{ $post -> PostID }}'); opencommentemojilist();"><i class="fa fa-smile-o fa-2x" aria-hidden="true"></i></button>
					<button class="btn btn-primary" onclick="clickcomment('{{ $post -> PostID }}', '{{ $post -> PersonID }}', '{{ session() -> get('PersonID') }}');">Comment</button>
				</div>
			</div>
		</div>
		<div class="collapse" id="collapsecomments{{ $post -> PostID }}">
			
		</div>
		<div id="updateCaption{{ $post -> PostID }}" class="modal1">
		  <span onclick="document.getElementById('updateCaption{{ $post -> PostID }}').style.display='none'" class="close1" title="Close Modal">&times;</span>
		  <div class="modal-content1" style="height: 37%;">
			@csrf
			<div class="container1">
			  <h2 class="float-left">Update this post's caption</h2>
			  <br><br>
			  <div class="form-floating">
				<div class="input-group flex-nowrap">
				  <textarea class="float-left form-control mb-3" placeholder="Caption" id="addnewpostcaption{{ $post -> PostID }}" name="addnewpostcaption{{ session() -> get('PersonID') }}"></textarea>
				  <button class="btn-transparent" data-toggle="modal" data-target="#emojiModal" onclick="openemojilist('{{ $post -> PostID }}'); openupdatecaptionemojilist();"><i class="fa fa-smile-o fa-2x" aria-hidden="true"></i></button>
				</div>
			  </div>
			  <br>
			  <div class="clearfix1 float-right">
				<button type="button" class="btn btn-secondary" onclick="document.getElementById('updateCaption{{ $post -> PostID }}').style.display='none'">Close</button>
				<button type="button" class="btn btn-primary" onclick="updateCaption('{{ $post -> PostID }}')">Add</button>
			  </div>
			</div>			  
		  </div>
		</div>
	</div>
			  