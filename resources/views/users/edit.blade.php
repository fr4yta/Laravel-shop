@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Edycja użytkownika: <b>{{ $user->name }}</b></h1><hr/>
                <form action="{{ route('users.update', $user->id) }}" method="post">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="city">City <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="address[city]" maxlength="255" value="@if($user->hasAddress()){{ $user->address->city }}@endif" required />
                        @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="zip_code">Zip_code <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control @error('zip_code') is-invalid @enderror" id="zip_code" name="address[zip_code]" maxlength="6" value="@if($user->hasAddress()){{ $user->address->zip_code }}@endif" required />
                        @error('zip_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="street">Street <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control @error('street') is-invalid @enderror" id="street" name="address[street]" maxlength="255" value="@if($user->hasAddress()){{ $user->address->street }}@endif" required />
                        @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="street_no">Street_no <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control @error('street_no') is-invalid @enderror" id="street_no" name="address[street_no]" maxlength="5" value="@if($user->hasAddress()){{ $user->address->street_no }}@endif" required />
                        @error('street_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="home_no">Home_no <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control @error('home_no') is-invalid @enderror" id="home_no" name="address[home_no]" maxlength="5" value="@if($user->hasAddress()){{ $user->address->home_no }}@endif" required />
                        @error('home_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary float-right px-5">Edytuj dane użytkownika</button>
                </form>
            </div>
        </div>
    </div>
@endsection
