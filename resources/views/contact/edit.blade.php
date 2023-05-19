<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Contact') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-center">
                    <div class="w-full">
                        <h2 class="text-xl font-bold mb-4">Editar Contacto</h2>
                      
                        <form class="max-w-full" action="{{ route('contact.update', ["id" => $response->id]) }}" method="POST">
                            @csrf
                            @method("PUT")
                          <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Nombres</label>
                            <input type="text" name ="first_name" value="{{$response->first_name}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                          </div>
                      
                          <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Apellidos</label>
                            <input type="text" name="last_name" value="{{$response->last_name}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                          </div>
                      
                          <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                            <input type="text" name="phone" value="{{$response->phone}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                          </div>
                      
                          <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" value="{{$response->email}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                          </div>
                      
                          <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Guardar</button>
                        </form>
                      </div>
                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>