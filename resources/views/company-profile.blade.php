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
        Company Detail: {{$data['company']->name}}
        <small>

            <a href="{{url('companies')}}"> Back to
                Companies</a>


        </small>
    </h2>
    <hr style="margin-bottom:35px;">


    <div class="content">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    {{--<th>Id</th>--}}
                    <th>Name</th>
                    <th>Account #</th>
                    <th>Account Name</th>
                    <th>Expiry</th>
                    <th>Issue Date</th>
                    {{--<th>Date of Inc</th>--}}
                    <th>Zone</th>
                    <th>Origin</th>
                    {{--<th>Card</th>--}}
                    {{--<th>Phone #</th>--}}
                    <th>Created At</th>
                    <th>Main Activity</th>

                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>


                <tr>
                    {{--<td>{{$group->id}}</td>--}}
                    <td>{{$data['company']->name}}</td>
                    <td>{{$data['company']->a_number}}</td>
                    <td>{{$data['company']->a_name}}</td>
                    <td>{{$data['company']->expiry}}</td>
                    <td>{{$data['company']->issue_date}}</td>
                    <td>{{$data['company']->zone}}</td>
                    <td>{{$data['company']->origin}}</td>
                    {{--<td>{{$group->card}}</td>--}}
                    {{--<td>{{$group->phone}}</td>--}}
                    <td>{{ \Carbon\Carbon::parse($data['company']->created_at)->format('M d, Y')}}</td>
                    <td>{{$data['company']->main_activity}}</td>

                        <small><a data-toggle="modal" data-target="#edit_company_{{$data['company']->id}}">Edit</a> - <a
                                    href="{{url('company/employees/'.$data['company']->id)}}">Employees</a> - <a
                                    href="{{url('company/files/'.$data['company']->id)}}">Files</a></small>
                    </td>
                </tr>


                <div id="edit_company_{{$data['company']->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Company</h4>
                            </div>
                            <form action="{{url('edit_company/'.$data['company']->id)}}"
                                  id="submit_{{$data['company']->id}}"
                                  method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="row" style="padding:20px;">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Name:</label>
                                                <input type="text" value="{{$data['company']->name}}"
                                                       class="form-control"
                                                       name="name"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Account Name</label>
                                                <input type="text" value="{{$data['company']->a_name}}"
                                                       class="form-control"
                                                       name="a_name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Origin</label>
                                                <input type="text" class="form-control"
                                                       value="{{$data['company']->origin}}"
                                                       name="origin"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Liscence Expiry</label>
                                                <input type="date" class="form-control"
                                                       value="{{$data['company']->lisc_expiry}}"
                                                       name="lisc_expiry"
                                                       required>
                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Zone</label>
                                                <input type="text" class="form-control"
                                                       value="{{$data['company']->zone}}"
                                                       name="zone" id="f_date"
                                                       required>
                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Lease Expiry</label>
                                                <input type="date" class="form-control"
                                                       value="{{$data['company']->lease_date}}"
                                                       name="lease_date" id="f_date"
                                                       required>
                                            </div>
                                        </div>



                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Expiry</label>
                                                <input type="date" value="{{$data['company']->expiry}}"
                                                       class="form-control"
                                                       name="expiry" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Date of Inc</label>
                                                <input type="date" class="form-control"
                                                       value="{{$data['company']->date_inc}}"
                                                       name="date_inc" id="f_date"
                                                       required>
                                            </div>

                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Establishment Card</label>
                                                <input type="text" class="form-control"
                                                       value="{{$data['company']->card}}"
                                                       name="card" id="f_date"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Establishment Card Date</label>
                                                <input type="date" class="form-control"
                                                       value="{{$data['company']->card_date}}"
                                                       name="card_date" id="f_date"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Issue Date</label>
                                                <input type="date" class="form-control"
                                                       value="{{$data['company']->issue_date}}"
                                                       name="issue_date"
                                                       required>
                                            </div>

                                        </div>


                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Phone #</label>
                                                <input type="text" class="form-control"
                                                       value="{{$data['company']->phone}}"
                                                       name="phone" id="f_date"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Account #</label>
                                                <input type="text" value="{{$data['company']->a_number}}"
                                                       class="form-control"
                                                       name="a_number" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email #</label>
                                                <input type="text" value="{{$data['company']->email}}"
                                                       class="form-control"
                                                       name="email" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="email">Financial Ending Date:</label>
                                                <input type="date" class="form-control"
                                                       value="{{$data['company']->fi_ending_date}}"
                                                       name="fi_ending_date" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 ">
                                            <div class="form-group">
                                                <label for="email">Address</label>
                                                <textarea type="text" class="form-control"
                                                          name="address"
                                                          required>{{$data['company']->address}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    @csrf


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


                </tbody>
            </table>

        </div>


        <div class="panel panel-default">
            <div class="panel-heading">More Info</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Labels</th>
                        <th>Values</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Date of Incorporation</td>

                        <td>{{$data['company']->date_inc}}</td>
                    </tr>
                    <tr>
                        <td>Establishment Card</td>

                        <td>{{$data['company']->card}}</td>
                    </tr>

                    <tr>
                        <td>Establishment Card Date</td>

                        <td>{{$data['company']->card_date}}</td>
                    </tr>


                    <tr>
                        <td>Phone #</td>

                        <td>{{$data['company']->phone}}</td>
                    </tr>

                    <tr>
                        <td>Email #</td>

                        <td>{{$data['company']->email}}</td>
                    </tr>

                    <tr>
                        <td>Address #</td>

                        <td>{{$data['company']->address}}</td>
                    </tr>
                    <tr>
                        <td>Vat Date</td>

                        <td>{{$data['company']->vat_date}}</td>
                    </tr>
                    <tr>
                        <td>Other Activity</td>

                        <td>{{$data['company']->other_activity}}</td>
                    </tr>
                    <tr>
                        <td> Financial Ending Date</td>
                        <td>{{$data['company']->fi_ending_date}}</td>
                    </tr>
                    <tr>
                        <td>Lease Expiry Date</td>
                        <td>{{$data['company']->lease_date}}</td>
                    </tr>
                    <tr>
                        <td> Liscence Expiry Date</td>
                        <td>{{$data['company']->lisc_expiry}}</td>
                    </tr>


                    <tr>
                        <td>Status</td>
                        <td><select class="form-control input-xs"
                                    onchange="changeStatus(this.value,{{$data['company']->id}})">
                                <option value="Active" @if($data['company']->status == "Active") selected @endif>Active
                                </option>
                                <option value="Deactive" @if($data['company']->status == "Deactive") selected @endif>
                                    InActive
                                </option>
                                <option value="Potential" @if($data['company']->status == "Potential") selected @endif>
                                    Potential
                                </option>
                            </select></td>
                        <td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">Share Holders
                <button data-toggle="modal" data-target="#shareHolder" class="btn btn-default btn-xs">Add Share Holder
                </button>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Dob</th>

                        <th style="white-space: nowrap">Passport Expiry</th>
                        <th style="white-space: nowrap">Visa Expiry</th>
                        <th>Email</th>
                        <th>Share</th>
                        <th>Position</th>
                        <th>Nationality</th>
                        <th style="white-space: nowrap">Previous Nationality
                        <th style="min-width:130px;">Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($data['company']->shareHolders) != 0)
                        @foreach($data['company']->shareHolders as $shareHolder)
                            <tr>


                                <td>{{$shareHolder->name}}</td>
                                <td>{{$shareHolder->contact}}</td>
                                <td>{{$shareHolder->dob}}</td>

                                <td>{{$shareHolder->passport_expiry}}</td>
                                <td>{{$shareHolder->visa_expiry}}</td>

                                <td>{{$shareHolder->email}}</td>

                                <td>{{$shareHolder->share}}</td>
                                <td>{{$shareHolder->position}}</td>
                                <td>{{$shareHolder->natoionality}}</td>
                                <td>{{$shareHolder->pre_natoionality}}</td>
                                <td><select class="form-control input-xs"
                                            onchange="changeShareholderStatus(this.value,{{$shareHolder->id}})">
                                        <option value="Active" @if($shareHolder->status == "Active") selected @endif>Active
                                        </option>
                                        <option value="InActive" @if($shareHolder->status == "InActive") selected @endif>
                                            InActive
                                        </option>

                                    </select></td>
                                <td><a href="{{url('delete/share-holder/'.$shareHolder->id)}}">Delete</a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>No Data</td>
                        </tr>
                    @endif


                    </tbody>
                </table>
                </div>
            </div>
        </div>


    </div>


</div>


<div id="shareHolder" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{url('save_sahre_holder')}}" id="submit" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Share Holder</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="padding:20px;">

                        @csrf
                        <div class="col-lg-12 col-md-12 ">
                            <div class="form-group">
                                <label for="email">Name:</label>
                                <input type="text" class="form-control" name="name" id="email" required>
                                <input type="text" style="display:none;" class="form-control"
                                       value="{{$data['company']->id}}" name="company_id"
                                       required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Nationality:</label>
                                <input type="text" class="form-control" name="natoionality" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Previous Nationality:</label>
                                <input type="text" class="form-control" name="pre_natoionality" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Phone:</label>
                                <input type="text" class="form-control" name="contact" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">DOB:</label>
                                <input type="date" class="form-control" name="dob" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Visa Expiry:</label>
                                <input type="date" class="form-control" name="visa_expiry" required>
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
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" name="email" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Position:</label>
                                <input type="text" class="form-control" name="position" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label for="email">Share:</label>
                                <input type="text" class="form-control" name="share" required>
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
<hr style="margin-bottom: 20px;">
<footer style="text-align: center;position: absolute;width: 100%;bottom: 15;">
    <p style="padding-bottom:18px;"> Powered by <span style="color:darkorange;"><b>Avast</b></span></p>
</footer>


<form id="status_form" method="post" action="{{url('status_change_company')}}">
    @csrf
    <input type="text" name="id" id="status_id" style="display:none;">
    <input type="text" name="status" id="status_val" style="display:none;"></form>


<form id="status_form_share" method="post" action="{{url('status_change_share')}}">
    @csrf
    <input type="text" name="id" id="status_share_id" style="display:none;">
    <input type="text" name="status" id="status_val_share" style="display:none;"></form>


<script>




    function submit_form() {
        document.getElementById('submit').submit();
    }


    function changeStatus(val,id){

        document.getElementById('status_id').value=id;
        document.getElementById('status_val').value=val;
        document.getElementById('status_form').submit();
    }

    function changeShareholderStatus(val,id){
        document.getElementById('status_share_id').value=id;
        document.getElementById('status_val_share').value=val;
        document.getElementById('status_form_share').submit();
    }


</script>

</body>
</html>
