@extends('layouts.app')
@section('content')

    <div class="container">
        <h1 class="text-center my-4" style="font-family: Papyrus">Budgets </h1>

        

        

        

        @if ($budgets->isEmpty())
            {{-- Display a message when there are no budgets --}}
            <div class="alert alert-info text-center">
                No budgets found.
            </div>
        @else


        <div class="container d-flex flex-row justify-content-between " style=" height: 250px;padding: 10px; margin:10px; border-radius: 10px">
        
      

        <div class="card text-black bg-light mb-3" style="">
  
            <div class="card-body">
                <h5 class="card-title" style="font-family:cursive;font-size:25px">Net Worth </h5>
                <p class="card-text"  style="font-family:cursive;font-size:100px">{{ $totalBudget-$totalExpenses}}$</p>
            </div>
        </div>

          <div class="card text-black bg-success mb-3" style="">
  
            <div class="card-body">
                <h5 class="card-title" style="font-family:cursive;font-size:25px">Total Budget</h5>
                <p class="card-text"  style="font-family:cursive;font-size:100px">{{ $totalBudget}}$</p>
            </div>
        </div>

        <div class="card text-black bg-danger mb-3" style="">
  
            <div class="card-body">
                <h5 class="card-title" style="font-family:cursive;font-size:25px">Total Expenses</h5>
                <p class="card-text"  style="font-family:cursive;font-size:100px">{{ $totalExpenses}}$</p>
            </div>
        </div>
        
        </div>
<div class="container mb-4">

            <div class="row align-items-center ">
                <div class="col-md-8 ">
                    <form action="{{route('budget.filter')}}" class="form-inline  " method="GET">
                        @csrf
                        @method('GET')
                        <div class="input-group ">
                            <label class="inlineFormInput col-auto m-1" style="font-size: 25px" for="start_date">Start Date</label>
                            <div data-mdb-input-init class="col-auto m-1">

                                <input type="DATE" id="start_date" name="start_date" class="form-control"
                                    value="{{ date('Y-m-d H:i:s') }}" />
                            </div>
                            <label class="inlineFormInput col-auto m-1" style="font-size: 25px" for="end_date">End Date</label>

                            <div data-mdb-input-init class="col-auto m-1">

                                <input type="DATE" id="end_date" name="end_date" class="form-control"
                                    value="{{ date('Y-m-d H:i:s') }}" />
                            </div>

                            <div data-mdb-input-init class="col-auto m-1">
                                <input type="submit" class="btn btn-primary" value="Search">
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
            <table class="table table-striped" style="border-radius: 6px;overflow: hidden;">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Create Date</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($budgets as $budget)
                        <tr>
                            <td>{{ $budget->description }}</td>
                            <td>{{ $budget->amount }}$</td>
                            <td>{{ $budget->created_at }}</td>
                            <td>{{ $budget->start_date }}</td>
                            <td>{{ $budget->end_date }}</td>
                            <td>{{ $budget->category_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    @endsection
