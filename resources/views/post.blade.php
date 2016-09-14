@extends('layouts.blog-post')

@section('content')
	<h1>{{ $post->title }}</h1>

        <!-- Author -->
        <p class="lead">by <a href="#">{{ $post->user->name }}</a></p>
        <hr>
        <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->diffForHumans() }}</p>
        <hr>

        <!-- Preview Image -->
        	<div class="col-sm-12">
        		<img class="img-responsive" src="{{ $post->photo->file }}" alt="">
        	</div>
        <hr>

        <!-- Post Content -->
        <p class="lead">{{ $post->body }}</p>
        <hr>

		@if(Session::has('comment_message'))
        	{{ session('comment_message') }}	
		@endif

        @if( Auth::check() )
            <!-- Blog Comments -->
            <div class="well">
               <h4>Leave a Comment:</h4>

               {!! Form::open(['method'=>'POST', 'action'=>'PostCommentController@store']) !!}
               		<input type="hidden" name="post_id" value="{{ $post->id }}">
    				<div class="form-group">
    					{!! Form::label('body', 'Body') !!}
    					{!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>4]) !!}
    				</div>
    				<div class="form-group">
    					{!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
    				</div>
               {!! Form::close() !!}
            
            </div>
         <hr>
        @endif
        
        @if( count($comments) > 0 )
            @foreach( $comments as $comment )
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" width="77" height="77" src="{{ Auth::user()->gravatar }}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $comment->email }} 
                            <small> {{ $comment->created_at->diffForHumans() }} </small>
                        </h4>
                        <p>{{ $comment->body }}</p>
                        
                        @foreach( $comment->replies as $reply)
                            @if( $reply->is_active == 1 )
                      
                        <!-- Nested Comment -->
                            <div id="nested-comment" class="media">
                                @if( count($comment->replies) > 0 )
                                    <a class="pull-left" href="#">
                                        <img class="media-object" width="55" height="55" src="{{ Auth::user()->gravatar }}" alt="">
                                    </a>
                                    <div class="media-body">{{ $reply->email }}
                                        <h4 class="media-heading">
                                            <small>{{ $reply->created_at->diffForHumans() }}</small>
                                        </h4>
                                        <p>{{ $reply->body }}</p>
                                    </div>
                            </div>
                                @endif
                            @endif
                        @endforeach
                        <div class="comment-reply-container">
                            <button class="toggle-reply btn btn-warning pull-right">Reply</button>
                            <div class="comment-reply">
                                {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                    <div class="form-group">
                                        {!! Form::label('body', 'Body') !!}
                                        {!! Form::textarea( 'body', null, ['class'=>'form-control', 'rows'=>3] ) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::submit('Answer', ['class'=>'btn btn-primary']) !!}
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>


                    <!-- End Nested Comment -->
                    </div>
                </div>
            @endforeach
        @endif
    @stop

	@section('widget')
		<h4>Blog Categories</h4>
        <div class="row">
            <div class="col-sm-6">
                <ul class="list-unstyled">
                	@foreach( $categories as $category )
                    	<li><a href="{{ route('admin.categories.index') }}">{{ $category->name }}</a></li>
                    @endforeach 
                </ul>
            </div>
        </div>
        <!-- /.row -->
	@stop





@section('scripts')
    <script>
        $('.toggle-reply').on('click', function(){
            $(this).next().slideToggle();
        });
    </script>
@stop