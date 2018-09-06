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
        Tasks:
        <small>
            (Total Tasks:{{count($data['tasks'])}}) -
            <a data-toggle="modal" data-target="#myModal">Add new Task</a> - <a href="{{url('companies')}}"> Back to
                Companies</a>


        </small>
    </h2>



    <hr style="margin-bottom:35px;margin-top:35px;">

    <div class="content">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    {{--<th>Id</th>--}}
                    <th>Date</th>
                    <th>Zone</th>
                    {{--<th>Account Name</th>--}}
                    <th>Company Name</th>
                    {{--<th>Date of Inc</th>--}}
                    <th>Process Name</th>
                    <th>Name of Concern</th>
                    {{--<th>Card</th>--}}
                    {{--<th>Phone #</th>--}}
                    <th>Remarks</th>
                    <th>Comment</th>
                    <th>Status</th>
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
                            <td>{{$group->_date}}</td>
                            <td>{{$group->zone}}</td>
                            {{--<td>{{$group->a_name}}</td>--}}
                            <td>{{$group->c_name}}</td>
                            {{--<td>{{$group->date_inc}}</td>--}}
                            <td>{{$group->p_name}}</td>
                            <td>{{$group->n_concern}}</td>
                            <td>{{$group->remarks}}</td>
                            {{--<td>{{$group->card}}</td>--}}
                            {{--<td>{{$group->phone}}</td>--}}
                            <td>{{ $group->comments}}</td>

                            <td>
                                <select class="form-control input-xs" onchange="changeStatus(this.value,{{$group->id}})">
                                    <option value="pending" @if($group->status == "pending") selected @endif>Pending</option>
                                    <option value="done" @if($group->status == "done") selected @endif>Done</option>
                                    <option value="not_done" @if($group->status == "not_done") selected @endif>Not Done</option>
                                </select>
                            </td>

                            <td>
                                <small>
                                    <a data-toggle="modal" data-target="#edit_task_{{$group->id}}">Edit</a> -
                                    <a href="{{url('task_delete/'.$group->id)}}">Delete</a> </small>
                            </td>
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
            <form action="{{url('save_task')}}" id="submit" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Task</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="padding:20px;">

                        @csrf
                        <div class="col-lg-6 col-md-6 ">
                        <div class="form-group">
                            <label for="email">Company Name:</label>
                            <input type="text" class="form-control" name="c_name" id="email" required>

                        </div>
                        </div>



                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Date :</label>
                                <input type="date" class="form-control" name="_date" required>
                            </div>
                        </div>


                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Process Name:</label>
                                <input type="text" class="form-control" name="p_name" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Name of Concern:</label>
                                <input type="text" class="form-control" name="n_concern" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Zone:</label>
                                <input type="text" class="form-control" name="zone" required>
                            </div>
                        </div>


                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Status:</label>
                                <select class="form-control" name="status">
                                    <option value="pending">Pending</option>
                                    <option value="done">Done</option>
                                    <option value="not_done">Not Done</option>
                                </select>

                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 ">
                            <div class="form-group">
                                <label for="email">Comments:</label>
                                <textarea type="text" class="form-control" name="comments" ></textarea>
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


</body>
</html>
