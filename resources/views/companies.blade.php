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
            <h2>Group: {{$data['group']->name}} <small>(Total Companies:{{count($data['companies'])}}) - <a data-toggle="modal" data-target="#myModal">Add new Company</a> - <a href="{{url('groups')}}">Back to Groups</a></small> </h2>
            <hr>

            <div class="content">
                <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        {{--<th>Id</th>--}}
                        <th>Name</th>
                        <th>Account #</th>
                        <th>Account Name</th>
                        <th>Date of Inc </th>
                        <th>Origin </th>
                        <th>Card </th>
                        <th>Phone # </th>
                        <th>Created At</th>
                        <th>Files</th>
                        <th>Employees</th>
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
                        <td>{{$group->name}}</td>
                        <td>{{$group->a_number}}</td>
                        <td>{{$group->a_name}}</td>
                        <td>{{$group->date_inc}}</td>
                        <td>{{$group->origin}}</td>
                        <td>{{$group->card}}</td>
                        <td>{{$group->phone}}</td>
                        <td>{{ \Carbon\Carbon::parse($group->created_at)->format('M d, Y')}}</td>

                        <td>{{count($group->files)}}</td>
                        <td>{{count($group->employees)}}</td>
                        <td><small><a href="{{url('company/delete/'.$group->id)}}" >Delete</a> - <a href="{{url('company/employees/'.$group->id)}}">Employees</a>  - <a href="{{url('company/files/'.$group->id)}}">Files</a></small></td>
                    </tr>
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
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Company</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('save_company')}}" id="submit" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Name:</label>
                                <input type="text" class="form-control"name="name" id="email" required>
                                <input type="text" style="display:none;" class="form-control"name="group_id" value="{{$data['group']->id}}"  required>
                            </div>

                            <div class="form-group">
                                <label for="email">Account Name:</label>
                                <input type="text"  class="form-control"name="a_name"  required>
                            </div>


                            <div class="form-group">
                                <label for="email">Account #:</label>
                                <input type="text"   class="form-control"name="a_number"   required>
                            </div>


                            <div class="form-group">
                                <label for="email">Phone:</label>
                                <input type="text"   class="form-control"name="phone"   required>
                            </div>


                            <div class="form-group">
                                <label for="email">Card:</label>
                                <input type="text"  class="form-control"name="card"  required>
                            </div>

                            <div class="form-group">
                                <label for="email">Origin:</label>
                                <input type="text"   class="form-control"name="origin"   required>
                            </div>

                            <div class="form-group">
                                <label for="email">Date of Incorporation:</label>
                                <input type="date"  class="form-control"name="date_inc"   required>
                            </div>


                            <div class="form-group">
                                <label for="email">Expiry:</label>
                                <input type="date"  class="form-control"name="expiry"   required>
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
