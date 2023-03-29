@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit Contact') }}
                        <div class="d-flex justify-content-end">

                            <a class="btn btn-primary" href="{{route('contact.index')}}">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{route('contact.update',$contact->id)}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{$contact->first_name}}"
                                       id="first_name" name="first_name">
                                @error('first_name')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{$contact->last_name}}"
                                       id="last_name" name="last_name">
                                @error('last_name')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{$contact->phone}}"
                                       name="phone">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{$contact->email}}"
                                       name="email">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
