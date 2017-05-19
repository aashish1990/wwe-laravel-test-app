@extends('app')

@section('title', 'Add Video')

@section('content')

<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <h2>Videos</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <th>Title</th>
                <th>Video</th>
                <th>Duration</th>
                <th>File Size</th>
                <th>Format</th>
                <th>Bit Rate</th>
                </thead>
                <tbody>
                    @foreach ($videos as $video)
                    <tr>
                        <td>{{$video->title}}</td>
                        <td>
                            <video width="200"
                                   controls>
                                <source src="/{{$video->url}}" type="video/mp4">
                                Your browser does not support HTML5 video.
                            </video>
                        </td>
                        <td></td>
                        <td></td>
                        <td>MP4</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection