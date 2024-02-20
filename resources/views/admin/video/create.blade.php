@extends('layouts.backend.master')

@section('title', 'Create Video')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <x-card.card title="{{ $series->name }}">
                    <form action="{{ route('admin.videos.store', $series->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-form.input type="text" title="Video Name" name="name" value="" placeholder="Input video name" />
                        <x-form.input type="text" title="Video Code" name="video_code" value="" placeholder="Input video code" />
                        <x-form.input type="text" title="Web Link" name="web_link" value="{{ $web_link }}" placeholder="Input web link" />
                        <div class="row">
                            <div class="col-6">
                                <x-form.input type="number" title="Video Episode" name="episode" value="" placeholder="Input video episode" />
                            </div>
                            <div class="col-6">
                                <x-form.input type="time" title="Video Duration" name="duration" value="" placeholder="Input video duration" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="video_file">Video File:</label>
                            <input type="file" name="video_file" accept="video/*" class="form-control-file" required>
                        </div>
                        <div class="form-group">
                            <label for="pdf_file">PDF File:</label>
                            <input type="file" name="pdf_file" accept="application/pdf" class="form-control-file" required>
                        </div>
                        <x-form.checkbox title="Intro">
                            <label class="form-check form-check-inline">
                                <input class="form-check-input @error('intro') is-invalid @enderror" type="checkbox" name="intro" value="1">
                                <span class="form-check-label">Make this an intro video</span>
                            </label>
                        </x-form.checkbox>
                        <x-button.button-save title="Save" icon="save" class="btn btn-primary" />
                        <x-button.button-link class="btn btn-dark text-white" title="Go Back" icon="arrow-left" url="{{ route('admin.series.index') }}">
                        </x-button.button-link>
                    </form>
                </x-card.card>
            </div>
        </div>
    </div>
@endsection
