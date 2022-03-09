@include('aPanel.asstes.header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 px-2">
            <div class="col-sm-6">
                <h2 class="text-secondary">View Users</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="../index/index.php">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="card-title">User list</h3>
                    <div class="card-tools">
                        <form action="{{route('admin.user.search')}}" method="POST">
                            @csrf
                            <div class="input-group input-group-sm">
                                <input type="text" name="search" class="form-control" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>User Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->firstName .' ' . $user->lastName}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->role->name}}</td>
                                <td>
                                    <a href="#editUserModal{{$user->id}}" class="edit" data-toggle="modal" title="Edit">
                                        <!-- <i class="fas fa-pen-square float-right"></i> -->

                                        <i class="text-warning  fas fa-pen-square fa-2x" data-toggle="tooltip"></i>
                                    </a>

                                    <a href="#deleteUserModal{{$user->id}}" class="delete ml-2" data-toggle="modal">
                                        <i class="text-dark fas fa-trash fa-2x" data-toggle="tooltip" title="Delete"></i>
                                    </a>
                                    @if ($user->userStatus)
                                    <a href="#blockstatuUserModalUserModal{{$user->id}}" class="delete ml-2" data-toggle="modal">
                                        <i class="text-danger fas fas fa-ban fa-2x" data-toggle="tooltip" title="Block"></i>
                                    </a>
                                    @endif
                                    @if (!$user->userStatus)
                                    <a href="#statuUserModal{{$user->id}}" class="delete ml-2" data-toggle="modal">
                                        <i class="text-primary fas fas fa-check-circle fa-2x" data-toggle="tooltip" title="Block"></i>
                                    </a>
                                    @endif

                                </td>
                                <!-- Edit Modal HTML -->
                                <div id="editUserModal{{$user->id}}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{route('admin.user.update',[$user->id])}}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Update User Info</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input type="text" name="firstName" value="{{$user->firstName . $user->lastName}}" disabled class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="text" name="email" value="{{$user->email}}" disabled class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Phone</label>
                                                                <input type="text" name="phone" value="{{$user->phone}}" disabled class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>User Type</label>
                                                                <select class="form-control" required name="roleId">
                                                                    <option selected value="{{$user->role->id}}">{{$user->role->name}}</option>
                                                                    @foreach ($roles as $role)
                                                                    @if ($user->role->id != $role->id)
                                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                                <!-- <input type="text" name="phone" value="{{$user->phone}}" disabled class="form-control" required> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                    <input type="submit" class="btn btn-info" value="update">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delete Modal HTML -->
                                <div id="deleteUserModal{{$user->id}}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{route('admin.user.delete',[$user->id])}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete User</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete these Records?</p>
                                                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                    <input type="submit" class="btn btn-danger" value="Delete">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Modal HTML -->
                                <div id="statuUserModal{{$user->id}}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{route('admin.user.active',[$user->id])}}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">active User</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Choose if the user is active or unactive?</p>
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
    </div>
</div>
@include('aPanel.asstes.footer')
