@extends('layouts.app')

@section('content')
<div class="mx-36 my-6  ">
    <div class="border rounded p-2">
        <h1 class="text-xl">Création d'une nouvelle todo</h1>
    </div>
    <div>
    <form action="{{ Route('todos.store') }}" method="POST" class="border space-y-2 rounded p-6">
        @csrf
            <label for="name">Titre</label><br>
            <div class="w-full ">
                <input type="text" name="name" id="name" class="border pr-96 py-2 ">
            </div>
            <p>entrer le titre de votre todo</p>
            <label for="description">Description</label><br>
            <div class="w-full ">
                <input type="text" name="description" id="description" class="border pr-96 py-2">
            </div>
            <button type="submit" class="px-6 bg-blue-600 text-white border shadow font-semiblod text-xl text-center rounded py-2 hover:bg-white hover:text-indigo-400">  Ajoutez</button>
        </form>
    </div>
</div>
@endsection