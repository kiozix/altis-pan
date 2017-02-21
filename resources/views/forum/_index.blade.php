<tr>
    <td class="text-center"><i class="{{ $forum->icon }} fa-2x text-primary"></i></td>
    <td>
        <h4><a href="{{ route('forum.show', $forum->slug) }}">{{ $forum->name }}</a><br><small>{{ $forum->description }}</small></h4>
    </td>
    <td class="text-center hidden-xs hidden-sm"><a href="#">{{ $forum->threads->count() }}</a></td>
    <td class="hidden-xs hidden-sm">
        @if($forum->threads != '[]')
            par <a href="{{ route('forum.thread', $forum->threads->reverse()->first()->id) }}">{{ $forum->threads->reverse()->first()->user->name }}</a><br><small><i class="fa fa-clock-o"></i> {{ $forum->threads->reverse()->first()->ago }}</small>
        @endif
    </td>
</tr>