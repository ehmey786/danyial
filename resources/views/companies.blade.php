<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Companies</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container">


    <h2>
        Companies:
        <small>
            (Total Companies:{{count($data['companies'])}}) -
            <a data-toggle="modal" data-target="#myModal">Add new Company</a> - <a href="{{url('/')}}">
                Home</a>


        </small>
    </h2>
    <hr style="margin-bottom:35px;">


    <form method="get" action="{{url('companies')}}" enctype="multipart/form-data">

        <div class="input-group">
            <input type="text" name="search_input" class="form-control" placeholder="Search By Name or Zone or Origin">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
            </div>
        </div>
    </form>
    <hr style="margin-bottom:35px;margin-top:35px;">

    <div class="content">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    {{--<th>Id</th>--}}
                    <th>Name</th>
                    <th>Account #</th>
                    {{--<th>Account Name</th>--}}
                    <th>Expiry</th>
                    {{--<th>Date of Inc</th>--}}
                    <th>Zone</th>
                    <th>Origin</th>
                    {{--<th>Card</th>--}}
                    {{--<th>Phone #</th>--}}
                    <th>Created At</th>
                    <th>Files</th>
                    <th>Employees</th>
                    <th>Main Activity</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @if(count($data['companies'])==0)
                    <tr>
                        <td colspan="3">NO DATA</td>
                    </tr>
                @else
                    @foreach($data['companies'] as $group)
                        <tr>
                            {{--<td>{{$group->id}}</td>--}}
                            <td><a href="{{url('company-profile/'.$group->id)}}">{{$group->name}}</a></td>
                            <td>{{$group->a_number}}</td>
                            {{--<td>{{$group->a_name}}</td>--}}
                            <td>{{$group->expiry}}</td>
                            {{--<td>{{$group->date_inc}}</td>--}}
                            <td>{{$group->zone}}</td>
                            <td>{{$group->origin}}</td>
                            {{--<td>{{$group->card}}</td>--}}
                            {{--<td>{{$group->phone}}</td>--}}
                            <td>{{ \Carbon\Carbon::parse($group->created_at)->format('M d, Y')}}</td>

                            <td>{{count($group->files)}}</td>
                            <td>{{count($group->employees)}}</td>
                            <td>{{$group->main_activity}}</td>
                            <td>
                                <small><a data-toggle="modal" data-target="#edit_company_{{$group->id}}">Edit</a> - <a
                                            href="{{url('company/delete/'.$group->id)}}">Delete</a> - <a
                                            href="{{url('company/employees/'.$group->id)}}">Employees</a> - <a
                                            href="{{url('company/files/'.$group->id)}}">Files</a></small>
                            </td>
                        </tr>


                        <div id="edit_company_{{$group->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Company</h4>
                                    </div>
                                    <form action="{{url('edit_company/'.$group->id)}}" id="submit_{{$group->id}}"
                                          method="post" enctype="multipart/form-data">
                                        <div class="modal-body">


                                            @csrf
                                            <div class="form-group">
                                                <label for="email">Name:</label>
                                                <input type="text" value="{{$group->name}}" class="form-control"
                                                       name="name"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Vat Date:</label>
                                                <input type="date" value="{{$group->vat_date}}" class="form-control"
                                                       name="vat_date"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label for="email">Account #</label>
                                                <input type="text" value="{{$group->a_number}}" class="form-control"
                                                       name="a_number" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Account Name</label>
                                                <input type="text" value="{{$group->a_name}}" class="form-control"
                                                       name="a_name" required>
                                            </div>


                                            <div class="form-group">
                                                <label for="email">Expiry</label>
                                                <input type="text" value="{{$group->expiry}}" class="form-control"
                                                       name="expiry" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Date of Inc</label>
                                                <input type="date" class="form-control" value="{{$group->date_inc}}"
                                                       name="date_inc" id="f_date"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label for="email">Origin</label>
                                                <input type="text" class="form-control" value="{{$group->origin}}"
                                                       name="origin" id="f_date"
                                                       required>
                                            </div>


                                            <div class="form-group">
                                                <label for="email">Card</label>
                                                <input type="text" class="form-control" value="{{$group->card}}"
                                                       name="card" id="f_date"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Phone #</label>
                                                <input type="text" class="form-control" value="{{$group->phone}}"
                                                       name="phone" id="f_date"
                                                       required>
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
    @if(count($data['companies'])!=0)
        {{$data['companies']->links()}}
    @endif

</div>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{url('save_company')}}" id="submit" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Company</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="padding:20px;">

                        @csrf
                        <div class="col-lg-6 col-md-6 ">
                        <div class="form-group">
                            <label for="email">Name:</label>
                            <input type="text" class="form-control" name="name" id="email" required>
                            <input type="text" style="display:none;" class="form-control" name="group_id"
                                   value="{{$data['group']->id}}" required>
                        </div>
                        </div>




                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Vat Date:</label>
                                <input type="text" class="form-control" name="vat_date" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Account #:</label>
                                <input type="text" class="form-control" name="a_number" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Phone:</label>
                                <input type="text" class="form-control" name="phone" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Card:</label>
                                <input type="text" class="form-control" name="card" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Origin:</label>
                                <input type="text" class="form-control" name="origin" required>
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
                                <label for="email">License No:</label>
                                <input type="text" class="form-control" name="lic_no" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Issue Date:</label>
                                <input type="date" class="form-control" name="issue_date" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Date of Incorporation:</label>
                                <input type="date" class="form-control" name="date_inc" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Expiry:</label>
                                <input type="date" class="form-control" name="expiry" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Main Activity:</label>
                                <input type="text" class="form-control" name="main_activity" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Other Activity:</label>
                                <input type="text" class="form-control" name="other_activity" required>
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


<script>
    function submit_form() {
        document.getElementById('submit').submit();
    }
</script>


</body>
</html>
