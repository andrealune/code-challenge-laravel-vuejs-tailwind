@extends('layouts.default')
@section('content')
    <div class="bg-blue-200 min-h-screen flex items-center">
   <div class="w-full">
     <h2 class="text-center text-blue-400 font-bold text-2xl uppercase mb-10">Edit Contact</h2>

     <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2">   
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6">
                    <a class="" href="{{ route('index') }}"> Back</a>
        </button>
       <form action="{{ route('update',$contact->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
         <div class="mb-5">
           <label for="name" class="block mb-2 font-bold text-gray-600">First Name</label>
           <input type="text" name="first_name" class="border border-gray-300 shadow p-3 w-full rounded mb-" placeholder="First Name" value="{{ $contact->first_name }}">
           @error('first_name')
           <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
           @enderror
         </div>

         <div class="mb-5">
           <label for="name" class="block mb-2 font-bold text-gray-600">Last Name</label>
           <input type="text" name="last_name" class="border border-gray-300 shadow p-3 w-full rounded mb-" placeholder="Last Name" value="{{ $contact->last_name }}">
           @error('last_name')
           <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
           @enderror
         </div>

         <div class="mb-5">
           <label for="name" class="block mb-2 font-bold text-gray-600">Phone</label>
           <input type="text" name="phone" class="border border-gray-300 shadow p-3 w-full rounded mb-" placeholder="Phone" value="{{ $contact->phone }}">
           @error('phone')
           <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
           @enderror
         </div>

         <div class="mb-5">
           <label for="name" class="block mb-2 font-bold text-gray-600">Email</label>
           <input type="text" name="email" class="border border-gray-300 shadow p-3 w-full rounded mb-" placeholder="Email" value="{{ $contact->email }}">
           @error('email')
           <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
           @enderror
         </div>

         <button class="block w-full bg-blue-500 text-white font-bold p-4 rounded-lg" type="submit">Submit</button>
       </form>
     </div>
   </div>
</div>
    
@stop    