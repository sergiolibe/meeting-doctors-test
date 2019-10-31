<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Meeting Doctors - Test</title>

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

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    Test
                </div>
                @if (isset($file))
                    <h6>
                        <strong>
                            (There is a Xml File already uploaded)
                        </strong>
                    </h6>
                    <br>
                    <br>
                    <br>
                @endif
                <p>Please, upload the XML File, if there is one</p>
                <form class="form" action="{{route('uploadXml')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-cotrol-file">
                        <input class="" type="file" name="fileXml" id="" accept=".xml" required>
                    </div>
                    <div class="form-control-sm">
                        <button class="btn btn-primary" type="submit">Upload</button>
                    </div>
                </form>

                <br>
                @if (isset($uploadResponse))
                    {!!$uploadResponse!!}
                @endif

                <p><a href="{{route('showOutputFiles')}}">Show Output Csv Files</a></p>
            </div>
        </div>
    </body>
</html>
