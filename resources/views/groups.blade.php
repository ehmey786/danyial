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
            <h2>Groups <small>(Total:{{count($data['groups'])}}) - <a data-toggle="modal" data-target="#myModal">Add new</a></small> </h2>
            <hr>

            <div class="content">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Companies</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($data['groups'])==0)
                        <tr>
                            <td colspan="3">NO DATA</td>
                                 </tr>
                        @else
                    @foreach($data['groups'] as $group)
                    <tr>
                        <td>{{$group->id}}</td>
                        <td><a href="{{url('group/companies/'.$group->id)}}">{{$group->name}}</a></td>
                        <td>{{$group->created_at}}</td>

                        <td>{{count($group->companies)}}</td>
                        <td><a href="{{url('group/delete/'.$group->id)}}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            @if(count($data['groups'])!=0)
            {{$data['groups']->links()}}
                @endif
        </div>



        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Group</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('save_group')}}" id="submit" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Name:</label>
                                <input type="text" class="form-control"name="name" id="email" required>
                            </div>



                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="submit_form()" class="btn btn-success" data-dismiss="modal">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>



<script>
    function submit_form(){
        document.getElementById('submit').submit();    }
</script>



    </body>
</html>
