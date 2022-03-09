@include('aPanel.asstes.header')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Skills</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../index/index.html">Home</a></li>
                        <li class="breadcrumb-item active">Skills</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <div class="container">
        @if ($errors->any())
        @foreach ($errors->all() as $error )
        {{$error}}
        @endforeach
        @endif
        @if(Session::has('done'))
        {{Session::get('done')}}
        @endif
        <form method="post" action="{{route('admin.skills.store')}}">
            @csrf
            <div class="card card-danger" style="max-width: 800px;">
                <div class="card-header">
                    <h3 class="card-title">Add Skill</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="skillName">Name</label>
                                <input type="text" required minlength="3" name="name" class="form-control" id="skillName">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="skillRate">Percentage <small>type in %</small></label>
                                <input type="number" required minlength="2" name="number" class="form-control" id="skillRate">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="skillCategories">Skill Category</label>
                                <select class="form-control" name="category_id" id="skillCategories">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-danger" name="skillAddSubmit">add skill</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@include('aPanel.asstes.footer')
