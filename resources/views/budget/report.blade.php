@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center my-4" style="font-family: Papyrus">Report </h1>

        <div class="container mb-4">

            <div class="row align-items-center ">
                <div class="col ">
                    <form action="{{route('budget.report')}}" class="form-inline" method="POST">
                        @csrf
                        @method('POST')
                        <div class="input-group ">
                            <label class="inlineFormInput col-auto m-1" style="font-size: 25px" for="start_date" >Start
                                Date </label>
                            <div data-mdb-input-init class="col-auto m-1">

                                <input type="DATE" id="start_date" name="start_date" class="form-control"
                                    value="{{old('start_date')}}"/>
                            </div>
                            <label class="inlineFormInput col-auto m-1" style="font-size: 25px" for="end_date"  >End Date</label>

                            <div data-mdb-input-init class="col-auto m-1" >

                                <input type="DATE" id="end_date" name="end_date" class="form-control"
                                    value="{{old('end_date')}}" />
                            </div>

                             <label class="form-label  m-1" for="category_id"  style="font-size: 25px" >Category</label>

                            <div data-mdb-input-init class="form-outline col-auto m-1">
                                           
                                            <select id="category_id" class="form-control" name="category_id">
                                                @foreach ($categories as $category )
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                      
                                            </select>
                            </div>
                        
                            <div data-mdb-input-init class="col-auto m-1">
                                <input type="submit" class="btn btn-primary" value="Search">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        @if ($report===0)
   
            <div class="alert alert-info text-center">

                Nothing here.
            </div>

        @else

         <h1 class="text-center my-4" style="font-family: Papyrus">{{$category_name}} Budget </h1>

            <div class="container d-flex flex-row justify-content-between " style=" height: 250px;padding: 10px; margin:10px; border-radius: 10px">
        
      

        <div class="card text-black bg-light mb-3" style="">
  
            <div class="card-body">
                <h5 class="card-title" style="font-family:cursive;font-size:25px">Remaining Funds for {{$category_name}} Budget</h5>
                <p class="card-text"  style="font-family:cursive;font-size:100px">{{ $totalBudget-$totalExpenses+$totalIncome}}$</p>
            </div>
        </div>



          <div class="card text-black bg-light mb-3" style="">
  
            <div class="card-body">
                <h5 class="card-title" style="font-family:cursive;font-size:25px">Total Budget</h5>
                <p class="card-text"  style="font-family:cursive;font-size:100px">{{ $totalBudget}}$</p>
            </div>
        </div>

        <div class="card text-black bg-success mb-3" style="">
  
            <div class="card-body">
                <h5 class="card-title" style="font-family:cursive;font-size:25px">Total Incomes</h5>
                <p class="card-text"  style="font-family:cursive;font-size:100px">{{ $totalIncome}}$</p>
            </div>
        </div>

        <div class="card text-black bg-danger mb-3" style="">
  
            <div class="card-body">
                <h5 class="card-title" style="font-family:cursive;font-size:25px">Total Expenses</h5>
                <p class="card-text"  style="font-family:cursive;font-size:100px">{{ $totalExpenses}}$</p>
            </div>
        </div>
        
        </div>

        <h1 class="text-center my-4" style="font-family: Papyrus">Budgets </h1>

        <table class="table table-striped" style="border-radius: 6px;overflow: hidden;">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Create Date</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    
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
                   
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h1 class="text-center my-4" style="font-family: Papyrus">Transactions </h1>

            <table class="table table-striped rounded-3" style="  border-radius: 6px;overflow: hidden;" >
            <thead >


                <tr>
               
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Type</th>
         
            
                </tr>
            </thead>
            <tbody>
                @foreach($transaction as $transaction)
                    <tr>
                  
                        <td>{{ $transaction->description }}</td>
                        <td>{{ $transaction->amount }}$</td>
                        <td>{{ $transaction->happened_on }}</td>
                        @if($transaction->type === 1)
                            <td>Income</td>
                        @else
                            <td>Expenses</td>
                        @endif
                  
              
                    </tr>
                @endforeach
            </tbody>
        </table>


        
        @endif

    </div>
@endsection
