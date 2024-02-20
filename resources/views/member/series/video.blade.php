@extends('layouts.backend.master')

@section('title')
    {{ $series->name }}
@endsection

@section('content')
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <x-card.card title="Eps {{ $video->episode }} : {{ $video->name }}">
                    <video width="100%" height="auto" controls>
                        <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </x-card.card>
            </div>
            <div class="col-6">
                <x-card.card title="Episode - {{ $video->episode }} {{ $video->name }}">
                    <div class="list-group list-group-flush">
                        @foreach ($videos as $data)
                            <a href="{{ route('series.video', [$series->slug, $data->episode]) }}"
                                class="list-group-item list-group-item-action {{ request()->segment(3) == $data->episode ? 'active' : '' }}"
                                aria-current="true">
                                Eps - {{ $data->episode }} {{ $data->name }}
                                <span class="badge bg-{{ $data->intro == 1 ? 'azure' : 'red' }} ml-1">
                                    {{ $data->intro == 1 ? 'free' : 'pro' }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </x-card.card>
            </div>
            <div class="col-6">
                <div class="card rounded-lg">
                    <div class="card-body">
                        <h3 class="card-title">{{ $series->name }}</h3>
                        @foreach ($series->tags as $tag)
                            <span class="badge bg-{{ $tag->color }}">{{ $tag->name }}</span>
                        @endforeach
                        <p class="text-muted">{{ $series->description }}</p>
                        <p class="text-muted">{{ $series->videos->count() }} Episodes </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
