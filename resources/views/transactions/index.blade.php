@extends('layouts.app')
@section('content')

<div class="container">
    <h1 class="text-center my-4" style="font-family: Papyrus">Transactions</h1>
    
    @if($transactions->isEmpty())
       
        <div class="alert alert-info text-center">
     
            No transactions found.
        </div>
    @else

    <div class="container d-flex flex-row justify-content-between " style=" height: 250px;padding: 10px; margin:10px; border-radius: 10px">
        
      

        <div class="card text-black bg-light mb-3" style="">
  
            <div class="card-body">
                <h5 class="card-title" style="font-family:cursive;font-size:25px">Net Worth</h5>
                <p class="card-text"  style="font-family:cursive;font-size:100px">{{ $totalIncome - $totalExpenses}}$</p>
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

       

            <div class="bg-white" style="padding-bottom:25px ; border-radius: 10px">
  
         
                <canvas id="myChartPie"  ></canvas>
     
        </div>
       
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
    const ctx = document.getElementById('myChart');
    const ctxPie = document.getElementById('myChartPie');
 

    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Income', 'Expenses'],
            datasets: [{
                label: 'Transactions',
                data: [{{$totalIncome}}, {{$totalExpenses}}],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        }
    });

    </script>

        <div class="container mb-4">

            <div class="row align-items-center ">
                <div class="col-md-8 ">
                    <form action="{{route('transaction.filter')}}" class="form-inline" method="GET">
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

   
        
        <table class="table table-striped rounded-3" style="  border-radius: 6px;overflow: hidden;" >
            <thead >


                <tr>
               
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                  
                        <td>{{ $transaction->description }}</td>
                        <td>{{ $transaction->amount }}$</td>
                        <td>{{ $transaction->happened_on }}</td>
                        @if($transaction->type === 1)
                            <td>Income</td>
                        @else
                            <td>Expenses</td>
                        @endif
                        <td>{{$transaction->category_name}}</td>
                        <td class="d-flex flex-row  justify-content-center"  >
                            <form action="{{route('transaction.edit', $transaction->id)}}" method="GET">
                                @csrf
                                @method('GET')
                                <input type="submit" class="btn btn-success" value="Edit" style="margin-right:10px">
                            </form>

                            <form action="{{route('transaction.destroy', $transaction->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger" style="margin:auto" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection