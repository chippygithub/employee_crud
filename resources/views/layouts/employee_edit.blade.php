@extends('layouts.default')
@section('content')



        <!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Employee</h3>

                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    @if(session('status'))
                        <h6 class="alert alert-success"> {{session('status')}}</h6>
                    @endif


                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{url('employees/'.$employee->id)}}" method="post" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <div class="card-body">


                            <div class="form-group">
                                <label for="exampleInputName">Name</label>
                                <input type="text" class="form-control"  name="name" id="name" value="{{$employee->name}}" placeholder="Enter name" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" value="{{$employee->email}}" name="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Designation</label>
                                <select class="custom-select rounded-0" name="designation" id="exampleSelectRounded0" >
                                    <option value="">Select Designation</option>
                                    @foreach($designations as $designation)
                                        <option value="{{$designation->id}}" {{($employee->designation_id==$designation->id)? 'selected': '' }}>{{$designation->designation}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Remarks</label>
                                <textarea class="form-control" id="" name="remarks" placeholder="Remarks">{{$employee->remarks}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Upload Photo(maximum size 5mb)</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>


                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <!-- /.card -->


                <!-- /.card -->

            </div>
            <!--/.col (left) -->
            <!-- right column -->

            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection