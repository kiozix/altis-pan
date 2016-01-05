@extends('app')

<aside class="fh5co-page-heading">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="fh5co-page-heading-lead">
                    {!! $streams->name !!}
                    <span class="fh5co-border"></span>
                </h1>
            </div>
        </div>
    </div>
</aside>

<div class="container">
    <div class="col-sm-8">
        <iframe src="http://player.twitch.tv/?channel={!! $streams->name !!}" frameborder="0" scrolling="no" height="478" width="820" allowfullscreen></iframe>
    </div>
    <div class="col-sm-4">
        <iframe src="http://www.twitch.tv/{!! $streams->name !!}/chat?popout=" class="stream__chat" frameborder="0" scrolling="no" height="478" width="350"></iframe>
    </div>
    <div class="col-sm-8 stream__content_indiv">
        <p>{!! $streams->content !!}</p>
    </div>
</div>