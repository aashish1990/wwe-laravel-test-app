@extends('app')

@section('title', 'Metadata')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1>Metadata</h1>        
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-lg-offset-1">
        <h2>Keywords</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <th>ID</th>
                <th>Name</th>
                </thead>
                <tbody>
                    @foreach ($keywords as $keyword)
                    <tr>
                        <td>{{$keyword->id}}</td>
                        <td>{{$keyword->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-4 col-lg-offset-1">
        <h2>Locations</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <th>ID</th>
                <th>Name</th>
                </thead>
                <tbody>
                    @foreach ($locations as $location)
                    <tr>
                        <td>{{$location->id}}</td>
                        <td>{{$location->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection