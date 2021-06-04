@extends('user-auth::layouts.app-auth')

@section('title', 'Create a new account')

@section('content')

    @if(session()->has('error'))
        <div id="toast-error" class="error-alert-show toast align-items-center position-absolute top-0 end-0"
             role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session()->get('error') }}
                </div>
                <button type="button" onclick="dismissErrorToast();" class="btn-close me-2 m-auto"
                        data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div id="layoutAuthentication">
        <!-- Layout content-->
        <div id="layoutAuthentication_content">
            <!-- Main page content-->
            <main>
                <!-- Main content container-->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
                            <div class="card card-raised shadow-10 mt-5 mt-xl-10 mb-5">
                                <div class="card-body p-5">
                                    <!-- Auth header with logo image-->
                                    <div class="text-center">
                                        <h1 class="display-5 mb-0">Create New Account</h1>
                                        <div class="subheading-1 mb-5">to continue the app</div>
                                    </div>
                                    <!-- Register new account form-->
                                    <form action="{{route('userAuth.register')}}" method="POST">
                                        {{csrf_field()}}
                                        <div class="mb-4">
                                            <div class="form-group">
                                                <label for="exampleInputName1">Name</label>
                                                <input type="text" required class="form-control" name="name" id="exampleInputName1" placeholder="Enter your name">
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email">
                                                <small id="emailHelp" required class="form-text text-muted">We'll never share your email with anyone else.</small>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="form-group">
                                                <label for="phone">Phone Number</label>
                                                <input type="text" class="form-control" name="phone_number" id="phone" placeholder="Enter your phone number">
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" required class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter your password">
                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small fw-500 text-decoration-none" href="{{route('userAuth.login')}}">Sign in instead</a>
                                            <button type="submit" class="btn btn-primary">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

@endsection

