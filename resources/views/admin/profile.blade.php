@extends('layouts.detached', ['title' => 'Dasboard'])

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Profile</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card-box text-center">
                    <img src="{{asset('assets/images/users/user.jpg')}}" class="rounded-circle avatar-lg img-thumbnail"
                        alt="profile-image">

                    <h4 class="mb-0">{{ $user->name }}</h4>
                    <p class="text-muted">{{ $user->username }}</p>

                    <div class="text-left mt-3">
                        <h4 class="font-13 text-uppercase">About Me :</h4>
                        <p class="text-muted font-13 mb-3">
                            Hi I'm user from this app.
                        </p>
                        <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-1">{{ $user->name }}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-1 ">{{ $user->email }}</span></p>
                    </div>

                </div> <!-- end card-box -->

            </div> <!-- end col-->

            <div class="col-lg-8 col-xl-8">
                <div class="card-box">
                    <ul class="nav nav-pills navtab-bg nav-justified">
                        <li class="nav-item">
                            <a href="#settings" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                Settings
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="settings">
                            <form id="formchangepassword" class="async">
                                <h5 class="mb-2 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Security</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control send" id="password" name="password" placeholder="Enter password">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" class="form-control send" id="password_confirmation" id="password_confirmation" placeholder="Confirm password">
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="text-right">
                                    <button type="submit" class="ladda-button btn btn-primary waves-effect waves-light mt-2" data-style="zoom-in" id="btnchangepassword"><i class="mdi mdi-content-save"></i> Save</button>
                                </div>
                            </form>
                        </div>
                        <!-- end settings content-->

                    </div> <!-- end tab-content -->
                </div> <!-- end card-box-->

            </div> <!-- end col -->

        </div>
        <!-- end row-->

    </div> <!-- container -->
@endsection

@section('script-bottom')
    <script>
    $(document).on('submit','form.async',function(){
        event.preventDefault();
        // Form Login
        if ($(this).attr('id')=='formchangepassword') {
            sentData('{{ route('api.changepassword') }}', {'module': 'changepassword'})
        }
    });
    </script>
@endsection
