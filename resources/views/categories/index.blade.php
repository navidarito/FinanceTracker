@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center my-4" style="font-family: Papyrus">Categories </h1>



        @if ($categories->isEmpty())
            {{-- Display a message when there are no budgets --}}
            <div class="alert alert-info text-center">
                No categories found.
            </div>
        @else
            <table class="table table-striped" style=" border-radius: 6px;overflow: hidden;">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Name</th>
                   
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td align="center">{{ $category->id }}</td>
                            <td align="center">{{ $category->name }}</td>
        
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    @endsection
