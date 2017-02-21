@extends('admin.app')

@section('page-info')
    <h3>Forum</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="text-right">
            <a href="{{ route('admin.forum.category.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp; Ajouter une catégorie</a>
            <br><br>
        </div>

        <div class="container">
            @include('flash')
        </div>

        @foreach($categories as $category)
            <div class="panel panel-default category">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 55%" class="h4" id="name-{{ $category->id }}">{{ $category->name }}</th>
                            <th class="h4 text-center hidden-xs hidden-sm">Topics</th>
                            <th class="h4 text-center hidden-xs hidden-sm">Derniers Sujet</th>
                            <th class="h4 hidden-xs hidden-sm">Actions</th>
                            <th class="h4 hidden-xs hidden-sm">
                                <a href="{{ route('admin.forum.create') }}?category={{ $category->id }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></a>
                                <a href="{{ route('admin.forum.category.edit', $category) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('admin.forum.category.delete', $category) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category->forums->sortBy('order') as $forum)
                            <tr>
                                <td>
                                    <h4><a href="{{ route('forum.show', $forum->slug) }}" target="_blank"><strong>{{ $forum->name }}</strong></a></h4>
                                    <div class="text-muted">{{ $forum->description }}</div>
                                </td>
                                <td class="text-muted text-center hidden-xs hidden-sm">
                                    <strong>{{ $forum->threads->count() }}</strong>
                                </td>
                                <td class="text-muted text-center hidden-xs hidden-sm">
                                    @if($forum->threads != '[]')
                                        <a href="{{ route('forum.thread', $forum->threads->reverse()->first()->id) }}" target="_blank">{{ $forum->threads->reverse()->first()->user->name }}</a>
                                        <br>
                                        <small>{{ $forum->threads->reverse()->first()->ago }}</small>
                                    @endif
                                </td>
                                <td class="hidden-xs hidden-sm">
                                    <a href="{{ route('admin.forum.edit', $forum) }}" class="btn btn-pill-left btn-primary">Editer</a>
                                    <a href="{{ route('admin.forum.delete', $forum->id) }}" class="btn btn-pill-right btn-danger">Supprimer</a>
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
@endsection