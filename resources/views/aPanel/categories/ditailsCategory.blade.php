@include('aPanel.asstes.header')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Category Jobs</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="../index/index.html">Home</a></li>
                    <li class="breadcrumb-item active">Category Jobs</li>
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
        <div class="card-header bg-dark">
            <h3 class="card-title">Category Jobs ( {{$category->categoryName}} )</h3>
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

                    </tr>
                </thead>
                <tbody>

                    @foreach($category->job as $job)
                    <tr>
                        <td>{{$job['id']}}</td>
                        <td>{{$job['jobTitle']}}</td>
                        <td>{{$job['jobContent']}}</td>
                        <td>
                            <img src="{{asset('images/'.$job['jobImage'])}}" width="50px" alt="">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('aPanel.asstes.footer')
