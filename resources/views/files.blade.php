<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$data['company']->name}} - Files</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container">
    <h2>Company: {{$data['company']->name}}
        <small>(Total Files:{{count($data['files'])}}) - <a data-toggle="modal" data-target="#myModal">Add new</a> - <small>
                <a href="{{url('group/companies/'.$data['company']->group->id)}}">Back to group ({{$data['company']->group->name}})</a></small></small>
    </h2>
    <hr>

    <div class="content">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">File Record:</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            {{--<th>Id</th>--}}
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($data['files'])==0)
                            <tr>
                                <td colspan="3">NO DATA</td>
                            </tr>
                        @else
                            @foreach($data['files'] as $group)
                                <tr>
                                    {{--<td>{{$group->id}}</td>--}}
                                    <td><a href="{{asset($group->name)}}" download>{{$group->name}}</a></td>
                                    <td>{{$group->created_at}}</td>


                                    <td><a href="{{url('file/delete/'.$group->id)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                    @if(count($data['files'])!=0)
                        {{$data['files']->links()}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add File</h4>
            </div>

            <div class="modal-body">
                <form action="{{url('save_file')}}" id="submit" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="email">Name:</label>
                        <input type="text" class="form-control" name="name" required>
                        <input type="file" class="form-control" name="file" required>
                        <input type="text" style="display:none;" class="form-control" name="company_id"
                               value="{{$data['company']->id}}" required>
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
    function submit_form() {
        document.getElementById('submit').submit();
    }
</script>


</body>
</html>
