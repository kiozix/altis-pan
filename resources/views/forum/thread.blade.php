@extends('app')

@section('content')
    <div class="container" style="margin-top: 50px">
        <h1 class="page-header pull-left"><i class="fa fa-pencil"></i> {{ $thread->name }}</h1>

        <ol class="breadcrumb pull-right where-am-i" style="margin-top: 35px">
            <li><a href="{{ route('forum') }}">Forum</a></li>
            <li><a href="{{ route('forum.show', $thread->forum->slug) }}">{{ $thread->forum->name }}</a></li>
            <li class="active">{{ $thread->name }}</li>
        </ol>

        <div class="clearfix"></div>
        
        <ul class="media-list forum">
            <li class="media well">
                <div class="pull-left user-info" href="#">
                    <img class="avatar img-circle img-thumbnail" src="{{ url($thread->user->avatar) ? asset('/img/user_default.png') : url($thread->user->avatar) }}" width="64" alt="Avatar - {{ $thread->user->name }}">
                    <strong><a href="#" style="color: #5d9cec;">{{ $thread->user->name }}</a></strong><br>
                    <div style="display: block;border-top: 1px solid #e9e9e9;">
                        <small>
                            @foreach($thread->user->tags as $tag)
                                {!! $tag !!}
                            @endforeach
                        </small>
                    </div>

                    <br>
                    <small class="btn-group btn-group-xs">
                        <a href="{{ route('forum.topic.like', $thread) }}" class="btn {{ $thread->liked ? 'btn-success' : 'btn-default' }}"><i class="fa fa-thumbs-o-up"></i></a>
                        <a href="{{ route('forum.topic.like', $thread) }}" class="btn btn-success">+{{ $thread->likes->count() }}</a>
                    </small>
                </div>
                <div class="media-body">
                    <div class="forum-post-panel btn-group btn-group-xs">
                        <a href="#" class="btn btn-default"><i class="fa fa-clock-o"></i> Posté {{ $thread->ago }}</a>
                    </div>
                    @if(\Auth::user())
                        @if(\Auth::user()->id == $thread->user_id)
                            <a href="#" class="btn btn-warning btn-xs pull-right" data-toggle="modal" data-target="#thread-edit"><i class="fa fa-cogs"></i></a>
                            <a href="{{ route('forum.thread.delete', $thread) }}" class="btn btn-danger btn-xs pull-right">Supprimer</a>
                        @elseif(\Auth::user()->rank >= 2)
                            <a href="#" class="btn btn-warning btn-xs pull-right" data-toggle="modal" data-target="#thread-edit"><i class="fa fa-cogs"></i></a>
                            <a href="{{ route('forum.thread.delete', $thread) }}" class="btn btn-danger btn-xs pull-right">Supprimer</a>
                        @endif
                    @endif

                    <div class="click2edit" id="thread-content" data-callback="{{ route('forum.thread.content', $thread) }}" data-csrf="{{ csrf_token() }}">
                        {!! $thread->content !!}
                    </div>
                    @if(\Auth::user())
                        @if(\Auth::user()->id == $thread->user_id)
                            <div class="clearfix"></div>
                            <div class="pull-right">
                                <button id="edit" class="btn btn-primary" onclick="edit()" type="button">Editer</button>
                                <button id="save" class="btn btn-default" onclick="save()" type="button">Sauvegarder</button>
                            </div>
                        @elseif(\Auth::user()->rank >= 2)
                            <div class="clearfix"></div>
                            <div class="pull-right">
                                <button id="edit" class="btn btn-primary" onclick="edit()" type="button">Editer</button>
                                <button id="save" class="btn btn-default" onclick="save()" type="button">Sauvegarder</button>
                            </div>
                        @endif
                    @endif
                </div>
            </li>
        </ul>

        <ul class="media-list forum">
            @foreach($posts as $post)
                <li class="media well">
                    <div class="pull-left user-info" href="#">
                        <img class="avatar img-circle img-thumbnail" src="{{ url($post->user->avatar) ? asset('/img/user_default.png') : url($post->user->avatar) }}" width="64" alt="Avatar - {{ $post->user->name }}">
                        <strong><a href="#" style="color: #5d9cec;">{{ $post->user->name }}</a></strong>
                        <div style="display: block;border-top: 1px solid #e9e9e9;">
                            <small>
                                @foreach($post->user->tags as $tag)
                                    {!! $tag !!}
                                @endforeach
                            </small>
                        </div>
                        <br>
                        <small class="btn-group btn-group-xs">
                            <a href="{{ route('forum.post.like', $post) }}" class="btn {{ $post->liked ? 'btn-success' : 'btn-default' }}"><i class="fa fa-thumbs-o-up"></i></a>
                            <strong class="btn btn-success">+{{ $post->likes->count() }}</strong>
                        </small>
                    </div>
                    <div class="media-body">
                        <div class="forum-post-panel btn-group btn-group-xs">
                            <a href="#" class="btn btn-default"><i class="fa fa-clock-o"></i> {{ $post->ago }}</a>
                        </div>
                        @if(\Auth::user())
                            @if(\Auth::user()->id == $post->user_id)
                                <a href="{{ route('forum.post', $post) }}" class="btn btn-danger btn-xs pull-right">Supprimer</a>
                            @elseif(\Auth::user()->rank >= 2)
                                <a href="{{ route('forum.post', $post) }}" class="btn btn-danger btn-xs pull-right">Supprimer</a>
                            @endif
                        @endif
                        {!! $post->content !!}
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="text-center">
            {!! $posts->render() !!}
        </div>
        <hr>
        <div class="well">
            @include('flash')
            <h3>Répondre</h3>
            @if($thread->lock)
                <div class="alert alert-warning">
                    Le sujet est vérouiller.
                </div>
            @else
                @if(\Auth::user())
                    <form action="{{ route('forum.thread.post', $thread->id) }}" method="post" id="postForm" onsubmit="return postForm()">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <textarea class="input-block-level" id="content" name="content" rows="18"></textarea>
                        <button type="submit" class="btn btn-success pull-right">Répondre</button>
                    </form>
                @else
                    <div class="alert alert-warning">
                        Veuillez vous connecter pour répondre à ce sujet.
                    </div>
                @endif
            @endif
        </div>
    </div>

    @if(\Auth::user())
        @if(\Auth::user()->id == $thread->user_id or \Auth::user()->rank >= 2)
            <div class="modal fade" id="thread-edit" tabindex="-1" role="dialog" aria-labelledby="ThreadEdit">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Editer</h4>
                        </div>
                        <form action="{{ route('forum.thread.update', $thread) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Titre</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Titre" value="{{ $thread->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="forum">Forum</label>
                                    <select name="forum" id="forum" class="form-control">
                                        @foreach($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                @foreach($category->forums as $forum)
                                                    <option value="{{ $forum->id }}" {{ $thread->forum_id == $forum->id ? 'selected' : '' }}>{{ $forum->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                @if(\Auth::user()->rank >= 2)
                                    <hr>
                                    <div class="form-group">
                                        <label for="sticky">Sticky</label>
                                        <select name="sticky" id="sticky" class="form-control">
                                            <option value="0" {{ $thread->sticky == 0 ? 'selected' : '' }}>Non</option>
                                            <option value="1" {{ $thread->sticky == 1 ? 'selected' : '' }}>Oui</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="lock">Vérouiller</label>
                                        <select name="lock" id="lock" class="form-control">
                                            <option value="0" {{ $thread->lock == 0 ? 'selected' : '' }}>Non</option>
                                            <option value="1" {{ $thread->lock == 1 ? 'selected' : '' }}>Oui</option>
                                        </select>
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-info">Sauvegarder</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#content').summernote({
                lang: 'fr-FR',
                height: "200px"
            });
        });
        var postForm = function () {
            var content = $('textarea[name="content"]').html($('#content').code());
        };

        var edit = function() {
            $('.click2edit').summernote({focus: true});
        };

        var save = function() {
            var click2edit = $('.click2edit');
            var makrup = click2edit.summernote('code');
            click2edit.summernote('destroy');

            var edit_content = document.getElementById("thread-content").innerHTML;

            $.ajax({
                method: "POST",
                url: click2edit.data('callback'),
                cache: false,
                data: {content: edit_content, _token: click2edit.data('csrf')},
                dataType: 'json',
                success: function(json) {
                    if (json.response == 'success') {
                        toastr["success"]("Le topic à bien été mis à jour.", "Réussie");
                    } else {
                        toastr["error"](json.response, "Erreur")
                    }
                }
            });
        };

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
@endsection