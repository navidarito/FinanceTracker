@extends('layouts.app')
@section('content')

<div class="container">
    <h1 class="text-center my-4">Transactions id is {{Auth::user()->id}}</h1>
    
    @if($transactions)
        <div class="alert alert-info text-center">
            No transactions found.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->description }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection