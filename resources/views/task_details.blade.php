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
        Task Assigned To:
        <small>

           {{$data['task_detail']->user->name}}




            - <a href="{{url('tasks')}}"> Back to
                All Tasks</a>


        </small>
    </h2>



    <hr style="margin-bottom:35px;margin-top:35px;">

    <div class="content">
        <div class="table-responsive" >
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



                </tr>
                </thead>
                <tbody>

                        <tr>
                            {{--<td>{{$group->id}}</td>--}}
                            <td>{{$data['task_detail']->_date}}</td>
                            <td>{{$data['task_detail']->zone}}</td>
                            {{--<td>{{$group->a_name}}</td>--}}
                            <td><a href="{{url('task_detail/'.$data['task_detail']->id)}}">{{$data['task_detail']->c_name}}</a></td>
                            {{--<td>{{$group->date_inc}}</td>--}}
                            <td>{{$data['task_detail']->p_name}}</td>
                            <td>{{$data['task_detail']->n_concern}}</td>
                            <td>{{$data['task_detail']->remarks}}</td>
                            {{--<td>{{$group->card}}</td>--}}
                            {{--<td>{{$group->phone}}</td>--}}




                        </tr>





                </tbody>
            </table>
        </div>


        <div class="panel panel-primary">
            <div class="panel-heading">Comments ({{$data['task_detail']->commentss()->count() }})</div>
            <div class="panel-body">@if($data['task_detail']->commentss()->count() == 0) No Comments @else

                @foreach($data['task_detail']->commentss as $comment)
                    <div style="background: #eeeeee;padding:10px; @if($loop->index ==1) margin-top:3px; @endif"><div><label>@if(Auth::user()->id == 1)<a href="{{url('user/'.$comment->user->id.'/tasks')}}">{{$comment->user->name}}</a> @else {{$comment->user->name}} @endif</label> - {{$comment->comment}}</div>
                     <div style="margin-top:8px;">{{$comment->created_at}}</div>
                    </div>
                    @endforeach
                @endif

            <hr>

                <form method="post" action="{{url('save_comment/'.$data['task_detail']->id)}}">
                    <input name="user_id" value="{{Auth::user()->id}}" style="display: none">
                    <input name="task_id" value="{{$data['task_detail']->id}}" style="display: none">
                    @csrf
                <textarea class="form-control" name="comment"></textarea>
                <button class="btn btn-primary" type="submit" style="margin-top:10px;">Save</button>
                </form>
            </div>
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
