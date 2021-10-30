
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row flex ml-64 mt-2 space-x-5">
        <button class="my-4 ">
            <a href=" {{ route('todos.create') }}" role="button" class="px-4 py-3 rounded text-white font-semibold bg-blue-600">Ajouter une todos</a>
        </button>
        <button class="my-4">
            @if (Route::currentRouteName() == 'todos.index')
            <a href=" {{ Route('todos.undone') }}" role="button" class="px-4 py-3 rounded bg-yellow-400 font-semibold">Voir les todos ouvertes</a>
        </button>
        <button class="my-4">
            <a href=" {{ route('todos.done')}} " role="button" class="rounded bg-pink-700 px-4 py-3 font-semibold text-white">Voir les todos terminées</a>
            @elseif (Route::currentRouteName() == 'todos.done')
            <a href=" {{ Route('todos.index') }}" role="button" class="px-4 py-3 rounded bg-red-700 text-white font-semibold">Voir toutes  les todos </a>
        </button>
        <button class="my-4">
            <a href=" {{ route('todos.undone')}} " role="button" class="rounded bg-green-600 px-4 py-3 font-semibold text-white">Voir les todos ouvertes</a>
            @elseif (Route::currentRouteName() == 'todos.undone')
            <a href=" {{ Route('todos.index') }}" role="button" class="px-4 py-3 rounded bg-red-700 text-white font-semibold">Voir toutes les todos</a>
        </button>
        <button class="my-4">
            <a href=" {{ route('todos.done')}} " role="button" class="rounded bg-indigo-600 px-4 py-3 font-semibold text-white">Voir les todos ouvertes</a>
            @endif
        </button>
    </div>
</div>
@foreach ($datas as $data) 
<div class="my-12">
    <div class="  text-xl mx-36 mt-6   {{ $data->done ? 'bg-blue-100' : 'bg-indigo-500' }}  bg-blue-200  rounded">
        <div class="flex">
            <div class="w-1/2 px-6 pt-6">
                <p>
                    <strong>
                        <span class="bg-black px-2 text-white font-semibold mx-2 rounded">
                            #{{ $data->id}}
                        </span>
                    </strong>
<small>
        créée {{ $data->created_at->from() }} 

                </p>
                <details>
                    <summary>
                        <strong class="p-2"> {{ $data->name }} @if($data->done)<span class="bg-green-500 mx-6 pb-2   px-2 rounded-xl"> done</span>@endif </strong> 
                    </summary>
                <p>{{ $data->description }}</p>
                </details>
                
            </div>
            <div class="w-1/2 grid justify-items-end space-x-4 pt-6 my-2">
                <div class="flex space-x-4">

                 {{-- button affected to --}}
                  <div class="group inline-block lg:ml-36">
                          <button id="dropdownMenuButton"class="outline-none focus:outline-none border px-3 py-2 bg-pink-500 text-white rounded-sm flex items-center min-w-32">
                                <span class="pr-1 font-semibold flex-1">Affecter a</span>
                                              <span>
                                                <svg
                                                  class="fill-current h-4 w-4 transform group-hover:-rotate-180
                                                  transition duration-150 ease-in-out"
                                                  xmlns="http://www.w3.org/2000/svg"
                                                  viewBox="0 0 20 20"
                                                >
                                                  <path
                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                                  />
                                                </svg>
                                              </span>
                                            </button>
                                            {{-- <ul class="bg-white border rounded-sm transform scale-0 group-hover:scale-100 absolute transition duration-150 ease-in-out origin-top min-w-32">
                                                    @foreach ($users as $user )
                                                    <li class="rounded-sm px-3 py-1 hover:bg-gray-100"><a href="/todos/{{ $datas->id }}/affectedTo/{{ $user->id }}">{{ $user->name }}</a></li>
                                                    @endforeach
                                                  </ul> --}}
                                          </div>
                                          
                                          <style>
                                            .group:hover .group-hover\:scale-100 { transform: scale(1) }
                                            .group:hover .group-hover\:-rotate-180 { transform: rotate(180deg) }
                                            .scale-0 { transform: scale(0) }
                                            .min-w-32 { min-width: 8rem }
                                          </style>
                            
                                        <div>
                                    </div>     
                @if ($data->done == 0)
                <div>
                    <form action="{{route('todos.makedone', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class=" px-8 py-1 rounded  bg-red-600 text-white " > Done</button>
                    </form>
                </div>
                @else
                <div >
                    <form action="{{ route('todos.makeundone', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class=" px-6 py-1 rounded bg-indigo-600 text-white" >undone</button>
                    </form>
                </div>
                @endif
                {{-- button editer une todo  --}}
                <a href=" {{ route('todos.edit', $data->id) }}  " class=" px-4 py-1  rounded mb-6 bg-yellow-300 text-white"> Editer</a>
                {{-- button effacer --}}
                <form action="{{ route('todos.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-1 mr-3 mb-6 rounded bg-pink-400 text-white"> Effacer</button>
                </form>
            </div>
        </div>
        </div>
    </div>
  
</div>
@endforeach 
<div class="mx-36 my-6">
    {{ $datas->links() }}
</div>
@endsection
