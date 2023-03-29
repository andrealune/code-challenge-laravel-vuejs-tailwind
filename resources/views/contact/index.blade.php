@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Contact') }}
                        <div class="d-flex justify-content-end">

                            <a class="btn btn-primary" href="{{route('contact.create')}}">Add</a>
                        </div>
                    </div>

                    <div class="card-body">


                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">SN</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($contacts as $contact)
                                <tr>
                                    <th scope="row">{{$loop->index+1}}</th>
                                    <td>{{$contact->first_name}}</td>
                                    <td>{{$contact->last_name}}</td>
                                    <td>{{$contact->phone ?? '-------'}} </td>
                                    <td>{{$contact->email ?? '-------'}}</td>
                                    <td>
                                        <a href="{{route('contact.edit',$contact->id)}}"
                                           class="btn btn-primary">Edit</a>
                                        @if(auth()->user()->is_admin)
                                            <a href="{{route('contact.delete',$contact->id)}}" class="btn btn-danger">Delete</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    No Data Found
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
