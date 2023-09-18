@extends('layout.authMain')

@section('content')

    <style>
        .logonH1{
            font-size: 25px;
            margin-bottom: 21px;
            color: #0067ff;
            text-align: center;
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <img src="{{asset('Images/site-info/logo.png')}}">
            <h1 class="logonH1">Welcome To School Web</h1>
        </div>
    </div>

    @if($message = Session::get('success'))

        <div class="alert alert-info">
            {{ $message }}
        </div>

    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form action="{{ route('sample.validate_login') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" name="email" class="form-control" placeholder="Email" />
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" />
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="d-grid mx-auto">
                            <button type="subit" class="btn btn-dark btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection('content')
