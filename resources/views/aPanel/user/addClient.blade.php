@include('aPanel.asstes.header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 px-2">
            <div class="col-sm-6">
                <h2 class="text-secondary">Add Product</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="../index/index.php">Home</a></li>
                    <li class="breadcrumb-item active">Add Product</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container">
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
    <div class="card card-success">
        <div class="card-header bg-dark">
            <h3 class="card-title">Add Client Data</h3>
        </div>
        <div class="card-body">
            <form action="{{route('admin.client.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="imgUpdate">Image    </label>
                            <input type="file" name="image" class="form-control-file" id="imgUpdate">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Discription</label>
                            <input type="text" name="discription" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="addCate" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>

    </div>
</div>
@include('aPanel.asstes.footer')
