@extends('app')

@section('title', 'Liked Videos')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2>Liked Videos</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <th>Title</th>
                <th>Video</th>
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
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection