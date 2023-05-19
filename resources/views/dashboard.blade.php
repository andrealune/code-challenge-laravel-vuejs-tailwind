<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full">
                    <h2 class="text-xl font-bold mb-4 text-center mt-4">Lista de Contactos</h2>
                  
                    <table class="min-w-full border border-gray-200">
                      <thead>
                        <tr>
                          <th class="py-2 px-4 bg-gray-100 border-b">Editar</th>
                          <th class="py-2 px-4 bg-gray-100 border-b">Nombres</th>
                          <th class="py-2 px-4 bg-gray-100 border-b">Apellidos</th>
                          <th class="py-2 px-4 bg-gray-100 border-b">Teléfono</th>
                          <th class="py-2 px-4 bg-gray-100 border-b">Email</th>
                          @if ( \auth()->user()->role_id === 1)
                          <th class="py-2 px-4 bg-gray-100 border-b">Borrar</th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                    @foreach ($responses as $response)
                        <tr>
                          <td class="py-2 px-4 border-b text-center"><button class="text-blue-600 hover:text-blue-800">
                            <a href="{{ route('contact.edit', ['id' => $response->id]) }}">Editar</a></button></td>
                          <td class="py-2 px-4 border-b text-center">{{$response->first_name}}</td>
                          <td class="py-2 px-4 border-b text-center">{{$response->last_name}}</td>
                          <td class="py-2 px-4 border-b text-center">{{$response->email}}</td>
                          <td class="py-2 px-4 border-b text-center">{{$response->phone}}</td>
                          @if ( \auth()->user()->role_id === 1)
                          <td class="py-2 px-4 border-b text-center">
                        <form method="POST" action="{{ route('contact.destroy', ['id' => $response->id]) }}">
                            @csrf
                            @method('DELETE')
                        
                            <button type="submit" class="text-red-600 hover:text-red-800">Borrar</button>
                        </form></td>
                        @endif
                        </tr>  
                    @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
