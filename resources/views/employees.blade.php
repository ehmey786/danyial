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

                Company: {{$data['company']->name}} - <small>(Total Employees: {{count($data['count_employees'])}}) - <a data-toggle="modal" data-target="#myModal">Add new</a> - <small>
                        <a href="{{url('group/companies/'.$data['company']->group->id)}}">Back to group ({{$data['company']->group->name}})</a></small></small>

            </h2>
            <hr>

            <div class="content">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Capital</th>
                        <th>Document</th>
                        <th>Financial End Date</th>
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
                        <td>{{$group->id}}</td>
                        <td>{{$group->name}}</td>
                        <td>{{$group->email}}</td>

                        <td>{{$group->website}}</td>
                        <td>{{$group->capital}}</td>
                        <td>
                            @if(file_exists( public_path() . '/documents/' . $group->id . '.png'))
                                <a href="{{asset('documents/' . $group->id . '.png')}}" download>Download</a>
                            @else
                                No Document
                            @endif
                        </td>
                        <td>{{$group->fi_end_date}}</td>
                        <td>{{$group->created_at}}</td>
                        <td>
                            <small><a href="{{url('employee/delete/'.$group->id)}}" >Delete</a> - <a   data-toggle="modal" data-target="#addDocument_{{$group->id}}">Add Document</a></small>
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
                                        If you have already uploaded document then your previous document will be replaced.
                                    </p>

                                    <form action="{{url('update_document/'.$group->id)}}" id="submit_{{$group->id}}" method="post"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">Documents:</label>
                                            <input type="file" class="form-control" name="file" required>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="submit_form_file({{$group->id}})" class="btn btn-success"  >Save</button>
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
                        <form action="{{url('save_employee')}}" id="submit" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="email">Name*:</label>
                                <input type="text" class="form-control"name="name" id="name" required>
                                <input type="text" style="display:none;" class="form-control"name="company_id" value="{{$data['company']->id}}"  required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email*:</label>
                                <input type="text" class="form-control"name="email" id="email" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Website:</label>
                                <input type="text" class="form-control"name="website" id="website" >
                            </div>

                            <div class="form-group">
                                <label for="email">Capital*:</label>
                                <input type="text" class="form-control"name="capital" id="capital"  required>
                            </div>

                            <div class="form-group">
                                <label for="email">Documents:</label>
                                <input type="file" class="form-control" name="file" >
                            </div>

                            <div class="form-group">
                                <label for="email">Financial Date*:</label>
                                <input type="date" class="form-control"name="fi_end_date" id="f_date" required>

                            </div>


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="submit_form()" class="btn btn-success"  >Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>



<script>

    function submit_form_file(id){
        document.getElementById('submit_'+id).submit();
    }


    function submit_form(){
        if(document.getElementById("f_date").value!="" && document.getElementById("name").value!="" && document.getElementById("email").value!="" && document.getElementById("capital").value!=""){
            document.getElementById('submit').submit();
        }
        else{
            alert('Fill all feilds');
        }
            }
</script>



    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>
