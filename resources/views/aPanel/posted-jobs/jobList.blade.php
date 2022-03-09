@include('aPanel.asstes.header')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Posted Jobs</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="../index/index.html">Home</a></li>
                    <li class="breadcrumb-item active">Posted Jobs</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container">

    <div class="col-10 mx-auto card p-2 mb-3">
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            {{$error}}
            @endforeach
        </div>
        @endif
        @if (Session::has('done'))
        <div class="alert alert-success">
            {{Session::get('done')}}
        </div>
        @endif
        <div class="card-header">
            <h3 class="card-title">Posted Jobs Full List</h3>
        </div>
        <!-- /.card-header -->

        <div class=" card-body p-0">
            <!-- <div class="alert alert-success" role="alert">
                                </div> -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Job Title</th>
                        <th>Job Content</th>
                        <th>Job Image</th>
                        <th>Publisher user</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach($jobs as $job)
                    <tr>
                        <td>{{$job['id']}}</td>
                        <td>{{$job['jobTitle']}}</td>
                        <td>{{$job['jobContent']}}</td>
                        <td>
                            <img src="{{asset('images/'.$job['jobImage'])}}" width="50px" alt="">
                        </td>
                        <td>{{$job->user->email}}</td>
                        <td style="width: 180px;">
                            <a href="#deleteJobModal{{$job['id']}}" class="delete ml-2" data-toggle="modal">
                                <i class="text-dark fas fa-trash fa-2x" data-toggle="tooltip" title="Delete"></i>
                            </a>
                            @if ($job->jobStatus)
                            <a href="#statuJobModal{{$job->id}}" class="delete ml-2" data-toggle="modal">
                                <i class="text-danger fas fas fa-ban fa-2x" data-toggle="tooltip" title="Block"></i>
                            </a>
                            @endif
                            @if (!$job->jobStatus)
                            <a href="#statuJobModal{{$job->id}}" class="delete ml-2" data-toggle="modal">
                                <i class="text-primary fas fas fa-check fa-2x" data-toggle="tooltip" title="Block"></i>
                            </a>
                            @endif
                        </td>
                        <!-- Delete Modal HTML -->
                        <div id="deleteJobModal{{$job['id']}}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="post" action="{{route('admin.postedJobs.delete',[$job->id])}}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete Job</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete these Records?</p>
                                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                            <input type="submit" name="deleteSkillSubmit" class="btn btn-danger" value="Delete">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Status Modal HTML -->
                        <div id="statuJobModal{{$job->id}}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{route('admin.postedJobs.status',[$job->id])}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title">active Job</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Choose if the Job is active or unactive?</p>
                                            <Select name="activation" class="form-control">
                                                <option value=1>active</option>
                                                <option value=0>block</option>
                                            </Select>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                            <input type="submit" class="btn btn-warning" value="Submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('aPanel.asstes.footer')
