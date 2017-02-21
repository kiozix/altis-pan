@extends('app')

@section('content')
    <div class="container" style="margin-top: 35px">
        <div class="page-header page-heading">
            <h1 class="pull-left">Forum</h1>
            <div class="clearfix"></div>
        </div>
        <p class="lead">Vous pourrez ici vous raprochez encore plus de la communauté {{ env('SITE_NAME', 'AltisPan') }}</p>

        @foreach($categories as $category)
            <table class="table forum table-striped">
                <thead>
                    <tr>
                        <th class="cell-stat"></th>
                        <th>
                            <h3>{{ $category->name }}</h3>
                        </th>
                        <th class="cell-stat text-center hidden-xs hidden-sm">Sujets</th>
                        <th class="cell-stat-2x hidden-xs hidden-sm">Dernier Sujet</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category->forums->sortBy('order') as $forum)
                        @if(\Auth::user())
                            @if($forum->moderator_see == null && $forum->support_see == null && $forum->cop_see == null && $forum->medic_see == null && $forum->gang_see == null)
                                @include('forum._index')
                            @elseif(\Auth::user()->rank == 3)
                                @include('forum._index')
                            @else
                                @if($forum->moderator_see == true && \Auth::user()->rank == 2)
                                    @include('forum._index')
                                @elseif($forum->support_see == true && \Auth::user()->rank == 1)
                                    @include('forum._index')
                                @elseif($player != null && $forum->cop_see == true || $player != null && $forum->medic_see == true || $player != null && $forum->gang_see)
                                    @if($forum->cop_see == true && $player->coplevel != 0)
                                        @include('forum._index')
                                    @elseif($forum->medic_see == true && $player->mediclevel != 0)
                                        @include('forum._index')
                                    @elseif(\App\Http\Controllers\PlayersController::inGang($player->playerid, $forum->gang_see) == true)
                                        @include('forum._index')
                                    @endif
                                @endif
                            @endif
                        @else
                            @if($forum->moderator_see == null && $forum->support_see == null && $forum->cop_see == null && $forum->medic_see == null && $forum->gang_see == null)
                                @include('forum._index')
                            @endif
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
@endsection