<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
    </head>
    <body class="antialiased">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-5">
                    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                        <h1>Welcome {{$data->name}}</h1>
                    </div>
                    <br>
                    <form action="{{route('twit')}}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="twit your thoughts"
                            name="twit" value="{{old('text')}}">
                            <span class="text-danger">@error('twit') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-primary" type="submit">Twit</button>
                        </div>
                    </form>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary" onclick="window.location.href='/logout';">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>
