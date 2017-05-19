@extends('app')

@section('title', 'Add Video')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2>Videos</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <th>Title</th>
                <th>Like</th>
                <th>Video</th>
                <th>Duration</th>
                <th>File Size</th>
                <th>Format</th>
                <th>Bit Rate</th>
                <th>Keywords</th>
                <th>Location</th>
                </thead>
                <tbody>
                    @foreach ($videos as $video)
                    <tr>
                        <td>{{$video->title}}</td>
                        <td>
                            @if($video->is_liked==1)
                            <div id="liked{{$video->id}}">
                                <i class="fa fa-thumbs-up fa-2x"></i>
                                <br>
                                <button class="btn btn-primary"
                                        onclick="dislike({{$video->id}})">
                                    Dislike
                                </button>
                            </div>
                            <div id="like{{$video->id}}" style="display: none">
                                <i class="fa fa-thumbs-o-up fa-2x"></i>
                                <br>
                                <button class="btn btn-primary"
                                        onclick="like({{$video->id}})">
                                    Like
                                </button>
                            </div>
                            @else
                            <div id="liked{{$video->id}}" style="display: none">
                                <i class="fa fa-thumbs-up fa-2x"></i>
                                <br>
                                <button class="btn btn-primary"
                                        onclick="dislike({{$video->id}})">
                                    Dislike
                                </button>
                            </div>
                            <div id="like{{$video->id}}">
                                <i class="fa fa-thumbs-o-up fa-2x"></i>
                                <br>
                                <button class="btn btn-primary"
                                        onclick="like({{$video->id}})">
                                    Like
                                </button>
                            </div>
                            @endif
                        </td>
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
                        <td>

                            <div class="form-group">
                                <label for="sel1">Select Keyword:</label>
                                <div class="alert alert-success" id="video{{$video->id}}" style="display: none">
                                    Tagged
                                </div>
                                <div class="alert alert-danger" id="errorVideo{{$video->id}}" style="display: none">
                                </div>
                                <select class="form-control" id="keywords{{$video->id}}">
                                    @foreach ($keywords as $keyword)
                                    <option value="{{$keyword->id}}" name="{{$keyword->name}}">{{$keyword->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="">
                                <button class="btn btn-primary" onclick="addKeyword({{$video->id}})">Add</button>
                                <ul id="assignedKeywords{{$video->id}}">
                                    @foreach ($video->keywords as $assignedKeyword)
                                    <li id="v{{$video->id}}k{{$assignedKeyword->id}}">
                                        {{$assignedKeyword->name}} 
                                        <i class="fa fa-close"
                                           style="color: red;cursor: pointer" 
                                           title="remove tag"
                                           onclick="removeKeyword({{$assignedKeyword->id}},{{$video->id}})"></i>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                        <td>

                            <div class="form-group">
                                <label for="sel1">Select Location:</label>
                                <div class="alert alert-success" id="lVideo{{$video->id}}" style="display: none">
                                    Tagged
                                </div>
                                <div class="alert alert-danger" id="lErrorVideo{{$video->id}}" style="display: none">
                                </div>
                                <select class="form-control" id="locations{{$video->id}}">
                                    @foreach ($locations as $location)
                                    <option value="{{$location->id}}" name="{{$location->name}}">{{$location->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-primary" onclick="addLocation({{$video->id}})">Add</button>
                            <div id="locationTag{{$video->id}}">
                                @if(isset($video->location_id))
                                {{$video->location->name}} 
                                <i class="fa fa-close"
                                   style="color: red;cursor: pointer" 
                                   title="remove location"
                                   onclick="removeLocation({{$video->id}})"></i>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>

    function like(videoId){
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
    url: "/videos/" + videoId + "/like",
            type:"POST",
            data: { _token : _token },
            success: function (result) {
            $("#like" + videoId).css("display", "none");
            $("#liked" + videoId).css("display", "block");
            }
    });
    }

    function dislike(videoId){
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
    url: "/videos/" + videoId + "/dislike",
            type:"POST",
            data: { _token : _token },
            success: function (result) {
            $("#like" + videoId).css("display", "block");
            $("#liked" + videoId).css("display", "none");
            }
    });
    }


    function addKeyword(videoId) {
    var e = document.getElementById("keywords" + videoId);
    var _token = $('meta[name="csrf-token"]').attr('content');
    keywordId = e.options[e.selectedIndex].value;
    var selectedName = $("#keywords" + videoId + " option:selected").attr('name');
    $.ajax({
    url: "/videos/" + videoId + "/keywords/" + keywordId + "/add",
            type:"POST",
            data: { _token : _token },
            success: function (result) {
            $("ul#assignedKeywords" + videoId).append('<li id="v' + videoId + 'k' + keywordId + '">' + selectedName + '<i class="fa fa-close" style = "color: red;cursor: pointer" onclick = "removeKeyword(' + keywordId + ',' + videoId + ')" > </i></li>');
            $("#video" + videoId).css("display", "block");
            $("#video" + videoId).fadeTo(2000, 500).slideUp(500, function(){
            $("#video" + videoId).slideUp(500);
            });
            },
            error:function(data){
            if (data.status == 400){
            $("#errorVideo" + videoId).empty();
            $("#errorVideo" + videoId).html("Already Tagged");
            $("#errorVideo" + videoId).fadeTo(2000, 500).slideUp(500, function(){
            $("#errorVideo" + videoId).slideUp(500);
            });
            }
            if (data.status == 404){
            $("#errorVideo" + videoId).empty();
            $("#errorVideo" + videoId).html("Keyword Not Found");
            $("#errorVideo" + videoId).fadeTo(2000, 500).slideUp(500, function(){
            $("#errorVideo" + videoId).slideUp(500);
            });
            }
            }
    });
    }

    function removeKeyword(keywordId, videoId){
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
    url: "/videos/" + videoId + "/keywords/" + keywordId + "/remove",
            type:"POST",
            data: { _token : _token },
            success: function (result) {
            $("ul li#v" + videoId + "k" + keywordId).css("display", "none");
            }
    });
    }

    function removeLocation(videoId){
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
    url: "/videos/" + videoId + "/location/remove",
            type:"POST",
            data: { _token : _token },
            success: function (result) {
            $("#locationTag" + videoId).css("display", "none");
            }
    });
    }

    function addLocation(videoId){
    var e = document.getElementById("locations" + videoId);
    var _token = $('meta[name="csrf-token"]').attr('content');
    locationId = e.options[e.selectedIndex].value;
    var selectedName = $("#locations" + videoId + " option:selected").attr('name');
    $.ajax({
    url: "/videos/" + videoId + "/locations/" + locationId + "/assign",
            type:"POST",
            data: { _token : _token },
            success: function (result) {
            $("#locationTag" + videoId).empty();
            $("#locationTag" + videoId).append(selectedName + '<i class="fa fa-close" style = "color: red;cursor: pointer" onclick = "removeLocation(' + videoId + ')" > </i>');
            $("#lVideo" + videoId).css("display", "block");
            $("#lVideo" + videoId).fadeTo(2000, 500).slideUp(500, function(){
            $("#lVideo" + videoId).slideUp(500);
            });
            },
            error:function(){
            $("#lErrorVideo" + videoId).empty();
            $("#lErrorVideo" + videoId).html("Location Not Found");
            $("#lErrorVideo" + videoId).fadeTo(2000, 500).slideUp(500, function(){
            $("#lErrorVideo" + videoId).slideUp(500);
            });
            }
    });
    }
</script>
@endsection