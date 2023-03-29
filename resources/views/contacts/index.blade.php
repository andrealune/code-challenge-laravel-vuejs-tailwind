@extends('layouts.default')
@section('content')

        <div class="container">
            <div class="row-auto mt-10 pl-5">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <a href="{{ route('create') }}"> Create Contact</a>
                </button>
                @if ($message = Session::get('success'))
                    <p class="text-sm text-green-600 mt-2 font-bold">{{ $message }}</p>
                @endif
            </div>
            
            <div class="flex flex-col">
              <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                  <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                                <tr class="table-success">
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">First name</th>
                                    <th scope="col" class="px-6 py-4">Last name</th>
                                    <th scope="col" class="px-6 py-4">Phone</th>
                                    <th scope="col" class="px-6 py-4">Email</th>
                                    <th scope="col" class="px-6 py-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$contactsData->isEmpty())
                                @foreach($contactsData as $data)
                                <tr>
                                    <th class="whitespace-nowrap px-6 py-4 font-medium">{{ $data->id }}</th>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $data->first_name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $data->last_name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $data->phone }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $data->email }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                                        <form action="{{ route('destroy',$data->id) }}" method="Post">
                                            <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ route('edit',$data->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">No records found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        
        {{ $contactsData->links('pagination::tailwind') }}
        
    </div>
@stop    