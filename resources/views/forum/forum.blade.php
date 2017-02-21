@extends('app')

@section('content')
    <div class="container" style="margin-top: 35px">
        <div class="page-header page-heading">
            @include('flash')
            <h1 class="pull-left">{{ $forum->name }}</h1>

            <ol class="breadcrumb pull-right where-am-i">
                <li><a href="{{ route('forum') }}">Forum</a></li>
                <li class="active">{{ $forum->name }}</li>
            </ol>

            <div class="clearfix"></div>
        </div>
        <p class="pull-left">{{ $forum->description }}</p>

        @if(\Auth::user() && \App\Forum::canPost($forum->id, \Auth::user()) == true)
            <a href="{{ route('forum.thread.create') }}?forum={{ $forum->id }}" class="btn btn-success pull-right">Nouveau sujet</a>
        @endif

        <table class="table forum table-striped">
            <thead>
            <tr>
                <th class="cell-stat"></th>
                <th>Sujets</th>
                <th class="cell-stat text-center hidden-xs hidden-sm">Réponses</th>
                <th class="cell-stat-2x hidden-xs hidden-sm">Dernière Réponse</th>
            </tr>
            </thead>
            <tbody>
                @foreach($stickys as $sticky)
                    <tr>
                        <td class="text-center"><i class="fa fa-thumb-tack fa-2x text-primary"></i></td>
                        <td>
                            <h4><a href="{{ route('forum.thread', $sticky->id) }}">{{ $sticky->name }}</a><br><small>par {{ $sticky->user->name }}</small></h4>
                        </td>
                        <td class="text-center hidden-xs hidden-sm"><a href="#">{{ $sticky->posts->count() }}</a></td>
                        <td class="hidden-xs hidden-sm">
                            @if($sticky->posts != '[]')
                                par <a href="#">{{ $sticky->posts->reverse()->first()->user->name }}</a><br><small><i class="fa fa-clock-o"></i> {{ $sticky->posts->reverse()->first()->ago }}</small>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @foreach($threads as $thread)
                    <tr>
                        <td class="text-center"><i class="fa {{ $thread->lock ? 'fa fa-lock' : 'fa-circle-o' }} fa-2x text-primary"></i></td>
                        <td>
                            <h4><a href="{{ route('forum.thread', $thread->id) }}">{{ $thread->name }}</a><br><small>par {{ $thread->user->name }}</small></h4>
                        </td>
                        <td class="text-center hidden-xs hidden-sm"><a href="#">{{ $thread->posts->count() }}</a></td>
                        <td class="hidden-xs hidden-sm">
                            @if($thread->posts != '[]')
                                par <a href="#">{{ $thread->posts->reverse()->first()->user->name }}</a><br><small><i class="fa fa-clock-o"></i> {{ $thread->posts->reverse()->first()->ago }}</small>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {!! $threads->render() !!}
        </div>
    </div>
@endsection