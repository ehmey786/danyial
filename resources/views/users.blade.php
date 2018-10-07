<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tasks</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container">


    <h2>
        Users:
        <small>
            (Total Tasks:{{count($data['tasks'])}}) -
            <a data-toggle="modal" data-target="#myModal">Add new User</a> - <a href="{{url('/')}}"> Home</a>


        </small>
    </h2>



    <hr style="margin-bottom:35px;margin-top:35px;">

    <div class="content">
        <div class="table-responsive" style="min-height: 400px;">
            <table class="table">
                <thead>
                <tr>
                    {{--<th>Id</th>--}}
                    <th>Name</th>
                    <th>Email</th>
                    {{--<th>Account Name</th>--}}

                    {{--<th>Date of Inc</th>--}}
                    <th>Task</th>
                    <th>Created At</th>
                    {{--<th>Card</th>--}}
                    {{--<th>Phone #</th>--}}
                    <th>Action</th>


                </tr>
                </thead>
                <tbody>
                @if(count($data['tasks'])==0)
                    <tr>
                        <td colspan="3">NO DATA</td>
                    </tr>
                @else
                    @foreach($data['tasks'] as $group)
                        <tr>
                            {{--<td>{{$group->id}}</td>--}}
                            <td>{{$group->name}}</td>
                            <td>{{$group->email}}</td>
                            {{--<td>{{$group->a_name}}</td>--}}
                            <td><a href="{{url('user/'.$group->id.'/tasks')}}"><label class="label label-primary">Tasks : {{$group->tasks()->count()}} </label></a></td>
                            {{--<td>{{$group->date_inc}}</td>--}}
                            <td>{{$group->created_at}}</td>

                            {{--<td>{{$group->card}}</td>--}}
                            {{--<td>{{$group->phone}}</td>--}}
                            <td> <a href="{{url('user/'.$group->id.'/delete/')}}">Delete</a></td>




                        </tr>


                        <div id="edit_task_{{$group->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Task</h4>
                                    </div>
                                    <form action="{{url('edit_task/'.$group->id)}}" id="submit_{{$group->id}}"
                                          method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
<input value="{{$group->id}}" name="task_id" style="display:none">

                                            @csrf


                                            <div class="form-group">
                                                <label for="email">Remarks #</label>
                                                <input type="text" value="{{$group->remarks}}" class="form-control"
                                                       name="remarks" required>
                                            </div>









                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit"
                                                    class="btn btn-success">Save
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>


                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    @if(count($data['tasks'])!=0)
        {{$data['tasks']->links()}}
    @endif

</div>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{url('save_user')}}" id="submit" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="padding:20px;">

                        @csrf
                        <div class="col-lg-6 col-md-6 ">
                        <div class="form-group">
                            <label for="email">User Name:</label>
                            <input type="text" class="form-control" name="name" id="email" required>

                        </div>
                        </div>



                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>


                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Password:</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick=" " class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>


<form id="status_form" method="post" action="status_change">
    @csrf
    <input type="text" name="id" id="status_id" style="display:none;">
    <input type="text" name="status" id="status_val" style="display:none;"></form>

<script>
    function submit_form() {
        document.getElementById('submit').submit();
    }


    function changeStatus(val,id){

        document.getElementById('status_id').value=id;
        document.getElementById('status_val').value=val;
        document.getElementById('status_form').submit();
    }
</script>

<hr style="margin-bottom: 25px;">
<footer style="text-align: center;position: absolute;width: 100%;bottom: 15;">
    <p style="padding-bottom:18px;"> Powered by <span style="color:darkorange;"><b>Avast</b></span></p>
</footer>
</body>
</html>
