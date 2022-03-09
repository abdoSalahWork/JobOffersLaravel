@include('aPanel.asstes.header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 px-2">
            <div class="col-sm-6">
                <h2 class="text-secondary">Add Categories</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('categories.index')}}">View Page Category</a></li>
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
            <h3 class="card-title">Add Category Data</h3>
        </div>
        <div class="card-body">
            <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="categoryName" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="categoryDesc" class="form-control" placeholder="Enter ...">
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
