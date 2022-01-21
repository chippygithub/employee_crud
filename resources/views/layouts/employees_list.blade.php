@extends('layouts.default')
@section('content')


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Employee List</h1>
            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <!-- /.card -->

                <div class="card">

                    @if(session('status'))
                        <h6 class="alert alert-success"> {{session('status')}}</h6>
                        @endif

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Designation</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($datas as $data)


                            <tr>
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}
                                </td>
                                <td>{{$data->designation}}</td>
                                <td>{{$data->remarks}}</td>
                                <td>
                                    <a href="{{url('employees/'.$data->id)}}" class="btn btn-info">View</a>
                                    <a href="{{url('employees/'.$data->id)}}" class="btn btn-primary">edit</a>

                                    <form action="{{url('employees/'.$data->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ml-1 float-left">Delete</button>
                                    </form>


                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Designation</th>
                                 <th>Remarks</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection

