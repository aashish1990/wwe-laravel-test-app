<html>
    <head>
        <title>@yield('title') - WWE</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/videos">WWE</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="/videos">Videos</a></li>
                    <li><a href="/videos/add">Add video</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="/metadata">Metadata
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/metadata">List All</a></li>
                            <li><a href="/metadata/keywords/add">Add Keywords</a></li>
                            <li><a href="/metadata/locations/add">Add Locations</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>