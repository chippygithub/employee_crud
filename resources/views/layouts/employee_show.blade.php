@extends('layouts.default')
@section('content')





    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{asset('uploads/employees/'.($employee[0]->image==null ? 'default_user_pic.png':$employee[0]->image ))}}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{$employee[0]->name}}</h3>

                            <p class="text-muted text-center">{{$employee[0]->designation}}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email id:</b> <a class="float-middle">{{$employee[0]->email}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Remarks:</b> <a class="float-middle">{{$employee[0]->remarks}}</a>
                                </li>

                            </ul>

                            <a href="{{url('employees/'.$employee[0]->id.'/edit')}}" class="btn btn-primary btn-block"><b>Edit</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <!-- /.card -->
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>





@endsection;