<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$data['employee']->name}} - Dependents</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


</head>
<body>

<div class="container">
    <h2>

        Employee: {{$data['employee']->name}} -
        <small>(Total Dependents: {{count($data['dependents'])}}) - <a data-toggle="modal" data-target="#dependent">Add
                new Dependent</a> -
            <small>
                <a href="{{url('company/employees/'.$data['employee']->company->id)}}">Back to Employees
                   </a></small>
        </small>

    </h2>
    <hr>

    <div class="content">
        <table class="table">
            <thead>
            <tr>
                {{--<th>Id</th>--}}
                <th>Dependent Name</th>
                <th>Relation</th>
                <th>Passport Expiry</th>
                <th>Visa Expiry</th>
                <th>Document</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if(count($data['dependents'])==0)
                <tr>
                    <td colspan="3">NO DATA</td>
                </tr>
            @else
                @foreach($data['dependents'] as $group)
                    <tr>
                        {{--<td>{{$group->id}}</td>--}}
                        <td>{{$group->name}}</td>
                        <td>{{$group->relation}}</td>

                        <td>{{$group->passport_expiry}}</td>
                        <td>{{$group->visa_expiry_expiry}}</td>
                        <td>
                                <a class="label label-primary" href="{{asset('files/' . $group->document)}}" download><i class="glyphicon glyphicon-download-alt"></i></a>
                        </td>
                        <td>{{$group->created_at}}</td>
                        <td>
                            <small> <a
                                        href="{{url('dependent/delete/'.$group->id)}}">Delete</a>
                            </small>
                        </td>
                    </tr>


                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    @if(count($data['dependents'])!=0)
        {{$data['dependents']->links()}}
    @endif







</div>



<script>

    function submit_form_file(id) {
        document.getElementById('submit_' + id).submit();
    }


    function submit_form() {
        if (document.getElementById("f_date").value != "" && document.getElementById("name").value != "" && document.getElementById("email").value != "" && document.getElementById("capital").value != "") {
            document.getElementById('submit').submit();
        }
        else {
            alert('Fill all feilds');
        }
    }
</script>



<div id="dependent" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{url('save_dependent')}}"  method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Dependent</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="padding:20px;">

                        @csrf
                        <div class="col-lg-12 col-md-12 ">
                            <div class="form-group">
                                <label for="email">Name:</label>
                                <input type="text" class="form-control" name="name" id="email" required>
                                <input type="text" style="display:none;" class="form-control" value="{{$data['employee']->id}}"name="employee_id"
                                       required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 ">
                            <div class="form-group">
                                <label for="email">Relation:</label>
                                <input type="text" class="form-control" name="relation" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Passport Expiry:</label>
                                <input type="date" class="form-control" name="passport_expiry" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Visa Expiry:</label>
                                <input type="date" class="form-control" name="visa_expiry_expiry" required>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 ">
                            <div class="form-group">
                                <label for="email">Document:</label>
                                <input type="file" class="form-control" name="document" required>
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

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>
