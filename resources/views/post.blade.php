@extends('layouts.blog-post')

@section('content')
	<h1 class="text-center">{{ $post->title }}</h1>
    <br>
        <!-- Author -->
        <div class="row">
            <p class="col-sm-6 col-xs-12 text-center"><span class="glyphicon glyphicon-time"></span><small> Posted by {{ $post->user->name }}</small></p>
            <p class="col-sm-6 col-xs-12 text-center "><span class="glyphicon glyphicon-time"></span><small> Posted on {{ $post->created_at->diffForHumans() }}</small></p>
        </div>        
        <!-- Preview Image -->
    	<div class="col-sm-12 col-xs-12 blog-image"><br>
    		<img class="col-sm-12 col-xs-12 " src="{{ $post->photo->file }}" alt="image">
    	</div>

        <!-- Post Content -->
        <div class="post-content">
            <p class="lead">{{ $post->body }}</p>
        </div>
        
        
        @if(Session::has('comment_message'))
            <div class="col-sm-10 col-sm-offset-1 col-xs-12 message-confirm">
                <p>{{ session('comment_message') }}</p> 
            </div>  
        @endif


        @if( Auth::check() )
            <!-- Blog Comments -->
            <div class="well well-comment">
               <h4>Leave a Comment:</h4>

               {!! Form::open(['method'=>'POST', 'action'=>'PostCommentController@store']) !!}
               		<input type="hidden" name="post_id" value="{{ $post->id }}">
    				<div class="form-group">
    					{!! Form::label('body', 'Content') !!}
    					{!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>4]) !!}
    				</div>
    				<div class="form-group">
    					{!! Form::submit('Leave Comment', ['class'=>'btn btn-primary']) !!}
    				</div>
               {!! Form::close() !!}
            
            </div>
         <hr>
        @endif
        
        @if( count($comments) > 0 )
            @foreach( $comments as $comment )
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" width="57" height="57" src="{{ Auth::user()->gravatar }}" alt="">
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
                                        <img class="media-object" width="45" height="45" src="{{ Auth::user()->gravatar }}" alt="">
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

	




@section('scripts')
    <script>
        $('.toggle-reply').on('click', function(){
            $(this).next().slideToggle();
        });
    </script>
@stop