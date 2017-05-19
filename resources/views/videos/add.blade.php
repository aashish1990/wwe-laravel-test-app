@extends('app')

@section('title', 'Add Video')

@section('content')

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <h2>Add Video</h2>
        @if($errors->any())
        <div class="alert alert-danger">
            {{$errors->first()}}
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('saveVideo') }}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="title" class="form-control" name="title" id="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="title">Upload your file:</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <input type="hidden" value="{{ csrf_token() }}" name="_token">
            <input type="submit"  class="btn btn-primary" value="Submit" name="submit">
        </form>
    </div>
</div>


@endsection