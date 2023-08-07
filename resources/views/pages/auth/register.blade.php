@extends('layout.default')

@section('title')
    login
@endsection


@section('title')
    register
@endsection


@section('content')
    <form action="{{ url('register') }}" method="POST">
        @csrf
        <h1>register</h1>
        <p>create new account</p>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input class="form-control" type="text" name="name" placeholder="Enter name" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Enter email" required />
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Enter password" required />
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm password</label>
            <input class="form-control" type="password" name="password_confirmation" placeholder="Enter password"
                required />
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>

    @include('components.errors')
    @include('components.status')
@endsection
