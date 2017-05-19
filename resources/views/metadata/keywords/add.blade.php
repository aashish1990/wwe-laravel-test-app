@extends('app')

@section('title', 'Add Keyword')

@section('content')

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <h2>Add Keyword</h2>
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
        <form action="{{ route('saveKeyword') }}" method="post">
            <div class="form-group">
                <label for="name">Keyword Name:</label>
                <input type="name" class="form-control" name="keyword_name" id="title" value="{{ old('keyword_name') }}">
            </div>
            <input type="hidden" value="{{ csrf_token() }}" name="_token">
            <input type="submit"  class="btn btn-primary" value="Submit" name="submit">
        </form>
    </div>
</div>


@endsection