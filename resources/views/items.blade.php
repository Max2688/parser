<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        img{
            max-width: 100%;
        }

        .container{
            max-width:1170px;
            width: 100%;
            margin-right: auto;
            margin-left: auto;
        }

        .flex {
            display: flex;
            flex-wrap: wrap;
        }
        .item-width{
            -ms-flex: 0 0 33%;
            flex: 0 0 33%;
            max-width: 31%;
        }
        .content-between{
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="flex content-between">

            @foreach( $news as $new)
                <div class="item-width">
                    <div>
                        <p><strong>{!! $new->title !!}</strong></p>
                    </div>
                    <div>
                        <img src="{{$new->image}}" title=""/>
                    </div>
                    <div>
                        {!! $new->short_desc !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
