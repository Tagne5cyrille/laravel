@extends('layouts.app')


@section('content')
    <div class="ml-32 my-7 text-xl">
        <h4 class=" text-3xl font-semibold">Modification de la todo<span class="text-white px-2 rounded mx-2 bg-black">#{{$todo->id}}</span></h4>
    </div>
    <div class="mx-32">
        <form action=" {{ route('todos.update', $todo->id )}}" method="POST" class="border space-y-2 rounded p-6">
            @csrf
            @method('put')
                <label for="name">Titre</label><br>
                <div class="w-full">
                    <input type="text" name="name" id="name" class="border pr-96 py-2 " value=" {{ old('name', $todo->name )  }}  ">
                </div>
                <p>entrer le titre de votre todo</p>
                <label for="description">Description</label><br>
                <div class="w-full ">
                    <input type="text" name="description" id="description" class="border pr-96 py-2" value=" {{ old('description', $todo->description ) }} ">
                </div>
               
           <div>
               <input type="checkbox" name="done" id="done" {{ $todo->done ? 'checked' : ''}} value=1 >
               <label for="done">done ?</label>
           </div>
           <button type="submit" class="px-6 bg-blue-600 text-white border shadow font-semiblod text-xl text-center rounded py-2 hover:bg-white hover:text-indigo-400">  Ajoutez</button>
            </form>
    </div>
@endsection