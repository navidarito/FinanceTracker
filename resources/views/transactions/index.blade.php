@extends('layouts.app')
@section('content')

<div class="container">
    <h1 class="text-center my-4" style="font-family: Papyrus">Transactions</h1>
    
    @if($transactions->isEmpty())
        {{-- Display a message when there are no transactions --}}
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

         {{--  <canvas id="myChartPie"  ></canvas> --}}

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

   
        
        <table class="table table-striped rounded-3" style="  border-radius: 6px;overflow: hidden;" >
            <thead >
                {{--  <tr style="font-family:Times New Roman;font-size: 25px">
                    <td class="bg-success"colspan="2"  align="center">Total Incomes:</td>
                    <td class="bg-success" align="left">{{$totalIncome}}$</td>
                    <td class="bg-danger" align="center">Total Expenses:</td>
                    <td class="bg-danger" align="left">{{$totalExpenses}}$</td>
                 </tr>
                 <tr style="font-family:Times New Roman;font-size: 25px" class="table-info">
                    <td colspan="3" align="center" style="font-family:	Times New Roman ">NET INCOME:</td>
                    <td colspan="2" align="left">{{ $totalIncome - $totalExpenses}}$</td>
                 </tr>  --}}

                <tr>
               
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Type</th>
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