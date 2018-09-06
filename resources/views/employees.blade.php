<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$data['company']->name}} - Employees</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


</head>
<body>

<div class="container">
    <h2>

        Company: {{$data['company']->name}} -
        <small>(Total Employees: {{count($data['count_employees'])}}) - <a data-toggle="modal" data-target="#myModal">Add
                new</a> -
            <small>
                <a href="{{url('companies')}}">Back to Companies
                   </a></small>
        </small>

    </h2>
    <hr>

    <div class="content">
        <table class="table">
            <thead>
            <tr>
                {{--<th>Id</th>--}}
                <th>Name</th>
                <th>Contact</th>
                <th>Designation</th>
                <th>Nationality</th>
                <th>Document</th>
                <th>Visa Expiry Date</th>
                <th>Passport Expiry Date</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if(count($data['employees'])==0)
                <tr>
                    <td colspan="3">NO DATA</td>
                </tr>
            @else
                @foreach($data['employees'] as $group)
                    <tr>
                        {{--<td>{{$group->id}}</td>--}}
                        <td>{{$group->name}}</td>
                        <td>{{$group->email}}</td>

                        <td>{{$group->website}}</td>
                        <td>{{$group->capital}}</td>
                        <td>
                            @if( $group->image_1 != null)
                                <a class="label label-primary" title="VISA" href="{{asset('documents/' . $group->image_1)}}" download><i class="glyphicon glyphicon-download-alt"></i></a>
                            @endif
                                @if($group->image_2 != null)
                                <a class="label label-primary" title="PASSPORT"href="{{asset('documents/' . $group->image_2)}}" download><i class="glyphicon glyphicon-download-alt"></i></a>
                                @endif
                                    @if($group->image_3 != null)
                                <a class="label label-primary"title="EMIRATES ID" href="{{asset('documents/' .$group->image_3)}}" download><i class="glyphicon glyphicon-download-alt"></i></a>
                                @endif
                                    @if($group->image_4 != null)
                                <a class="label label-primary" title="OTHER"href="{{asset('documents/' . $group->image_4)}}" download><i class="glyphicon glyphicon-download-alt"></i></a>
                                @endif

                                @if($group->image_1 == null && $group->image_2 == null && $group->image_3 == null && $group->image_4 == null )

                                No Document
                            @endif
                        </td>
                        <td>{{$group->fi_end_date}}</td>
                        <td>{{$group->passport_expiry_date}}</td>
                        <td>{{$group->created_at}}</td>
                        <td>
                            <small> <a
                                        href="{{url('employee/delete/'.$group->id)}}">Delete</a> - <a
                                        data-toggle="modal" data-target="#addDocument_{{$group->id}}">Add Document</a> - <a href="{{url('employee/dependents/'.$group->id)}}">  Dependents</a>
                            </small>
                        </td>
                    </tr>






                    <div id="addDocument_{{$group->id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add Document</h4>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        If you have already uploaded document then your previous document will be
                                        replaced. And only images will work fine...
                                    </p>

                                    <form action="{{url('update_document/'.$group->id)}}" id="submit_{{$group->id}}"
                                          method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">VISA:</label>
                                            <input type="file" class="form-control" name="file" >
                                        </div>

                                        <div class="form-group">
                                            <label for="email">PASSPORT:</label>
                                            <input type="file" class="form-control" name="file2" >
                                        </div>

                                        <div class="form-group">
                                            <label for="email">EMIRATES ID:</label>
                                            <input type="file" class="form-control" name="file3" >
                                        </div>

                                        <div class="form-group">
                                            <label for="email">OTHER:</label>
                                            <input type="file" class="form-control" name="file4" >
                                        </div>

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="submit_form_file({{$group->id}})"
                                            class="btn btn-success">Save
                                    </button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>





                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    @if(count($data['employees'])!=0)
        {{$data['employees']->links()}}
    @endif







</div>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Employee</h4>
            </div>
            <div class="modal-body">
                <form action="{{url('save_employee')}}" id="submit" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="email">Name*:</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                        <input type="text" style="display:none;" class="form-control" name="company_id"
                               value="{{$data['company']->id}}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Contact*:</label>
                        <input type="text" class="form-control" name="email" id="email" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Designation:</label>
                        <input type="text" class="form-control" name="website" id="website">
                    </div>

                    <div class="form-group">
                        <label for="email">Nationality*:</label>
                        <input type="text" class="form-control" name="capital" id="capital" required>
                    </div>


                    <div class="form-group">
                        <label for="email">Visa Expiry Date*:</label>
                        <input type="date" class="form-control" name="fi_end_date" id="f_date" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Passport Expiry Date*:</label>
                        <input type="date" class="form-control" name="passport_expiry" id="passport_expiry" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="submit_form()" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
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



<div id="shareHolder" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{url('save_dependent')}}" id="submit" method="post">
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
                                <input type="text" style="display:none;" class="form-control" value="{{$data['company']->id}}"name="employee"
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
