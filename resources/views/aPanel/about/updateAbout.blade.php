@include('aPanel.asstes.header')
<section class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2 class="text-secondary">Update About Details</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../index/index.php">Home</a></li>
                        <li class="breadcrumb-item active">Update About</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">General Elements</h3>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    {{$error}}
                    @endforeach
                </div>
                @endif
                @if (Session::has('done'))
                <div class="alert alert-success">
                    {{Session::get('done')}}
                </div>
                @endif
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" action="{{route('admin.about.update')}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{$about->name}}" name="name" class="form-control" placeholder="Enter ...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Age</label>
                                    <input required type="text" value="{{$about->age}}" name="age" class="form-control" placeholder="Enter ...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Job Title</label>
                                    <input required type="text" value="{{$about->title}}" name="title" class="form-control" placeholder="Enter ...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>From</label>
                                    <input required type="text" value="{{$about->from}}" name="from" class="form-control" placeholder="Enter ...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Lives in</label>
                                    <input required type="text" value="{{$about->live_in}}" name="live_in" class="form-control" placeholder="Enter ...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="imgUpdate">Img</label>
                                        <input type="hidden" name="oldImage" value="{{$about->image}}">
                                        <input type="file" name="image" class="form-control-file" id="imgUpdate">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="imgUpdate">Gender</label>
                                        <input required type="text" name="gender" value="{{$about->gender}}" class="form-control" id="gender">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea required name="description" class="form-control" rows="3" placeholder="Enter ...">{{$about->description}}</textarea>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="updateAboutSubmit" class="btn btn-warning">Update Details</button>
                    <button type="submit" class="btn btn-default float-right">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
@include('aPanel.asstes.footer')
