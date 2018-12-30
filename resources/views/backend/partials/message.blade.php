@if (session('message'))
	<div class="alert alert-success">
	  {{ session('message') }}
	</div>
@elseif(session('trash-message'))
	<div class="alert alert-success">
	   <?php  list($message,$postId) = session('trash-message')  ?>
	   	{{ $message }}
	   	{!! Form::open(['method' => 'PUT' , 'route' => ['blog.restore' , $postId]]) !!}
	   	<button type="submit" class="btn btn-primary">Undo</button>
	   	{!! Form::close() !!}
	</div>
@endif
