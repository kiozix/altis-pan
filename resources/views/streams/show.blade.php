@extends('app')

<aside class="fh5co-page-heading">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="fh5co-page-heading-lead">
                    {{ $streams->name }}
                    <span class="fh5co-border"></span>
                </h1>
            </div>
        </div>
    </div>
</aside>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe src="http://player.twitch.tv/?channel={{ $streams->name }}" frameborder="0" scrolling="no"  class="embed-responsive-item" allowfullscreen></iframe>
            </div>
        </div>

        <div class="col-md-4">
            <iframe src="http://www.twitch.tv/{{ $streams->name }}}/chat?popout=" frameborder="0" scrolling="no"  height="420" width="350"></iframe>
        </div>
        <div class="col-md-8">
            <br>
            <a href="{{ $streams->tips }}" target="_blank" class="btn btn-info"><i class="fa fa-ticket"></i> Faire un tips</a>
            <hr>
            <p class="stream-text">{{ $streams->content }}</p>
        </div>
    </div>
</div>