<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Groups</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>

        <div class="container">
            <h2>Notifications <small>(Total:{{$data['notifications_count']}})  - <a href="{{url('/')}}">Home</a></small> </h2>
            <hr>

            <div class="content">
                <table class="table">
                    <thead>
                    <tr>
                        {{--<th>Id</th>--}}
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($data['notifications'])==0)
                        <tr>
                            <td colspan="3">NO DATA</td>
                                 </tr>
                        @else
                    @foreach($data['notifications'] as $group)
                    <tr>
                        {{--<td>{{$group->id}}</td>--}}
                        <td>{{$group->desc}}</td>
                        <td>{{$group->created_at}}</td>
                        <td><a href="{{url('notification/delete/'.$group->id)}}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            @if(count($data['notifications'])!=0)
            {{$data['notifications']->links()}}
                @endif
        </div>











    </body>
</html>
