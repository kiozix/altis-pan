@extends('app')

@section('content')
    <div class="container" style="margin-top: 35px">
        <div class="page-header page-heading">
            <h1 class="pull-left">Nouveau Sujet</h1>
            <div class="clearfix"></div>
        </div>

        <div class="well">
            @include('flash')
            <form action="{{ route('forum.thread.store') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="name">Titre</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Titre" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="forum">Forum</label>
                        <select name="forum" id="forum" class="form-control">
                            @foreach($categories as $category)
                                <optgroup label="{{ $category->name }}">
                                    @foreach($category->forums as $forum)
                                        @if(\Auth::user())
                                            @if($forum->moderator_post == null && $forum->support_post == null && $forum->cop_post == null && $forum->medic_post == null && $forum->gang_post == null)
                                                @include('forum._create')
                                            @elseif(\Auth::user()->rank == 3)
                                                @include('forum._create')
                                            @else
                                                @if($forum->moderator_post == true && \Auth::user()->rank == 2)
                                                    @include('forum._create')
                                                @elseif($forum->support_post == true && \Auth::user()->rank == 1)
                                                    @include('forum._create')
                                                @elseif($player != null && $forum->cop_post == true || $player != null && $forum->medic_post == true || $player != null && $forum->gang_post)
                                                    @if($forum->cop_post == true && $player->coplevel != 0)
                                                        @include('forum._create')
                                                    @elseif($forum->medic_post == true && $player->mediclevel != 0)
                                                        @include('forum._create')
                                                    @elseif(\App\Http\Controllers\PlayersController::inGang($player->playerid, $forum->gang_post) == true)
                                                        @include('forum._create')
                                                    @endif
                                                @endif
                                            @endif
                                        @else
                                            @if($forum->moderator_post == null && $forum->support_post == null && $forum->cop_post == null && $forum->medic_post == null && $forum->gang_post == null)
                                                @include('forum._create')
                                            @endif
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                <div class="form-group">
                    <br>
                    <textarea name="content" id="content">{!! old('content') !!}</textarea>
                </div>

                <div class="form-group pull-right">
                    <button type="submit" class="btn btn-success">Créer le sujet</button>
                </div>
            </form>
        </div>
    </div>
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
        }
    </script>
@endsection