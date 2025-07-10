@extends('layouts.app')
@section('content')



    <section class="h-100 gradient-form" style="">
        <div class="container py-4 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-5">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col">
                                <div class="card-body p-md-5 mx-md-4">
                                    <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">

                                        @csrf
                                        @method('PUT')

                                        <h1 style="font-family: papyrus">Editing Transaction</h1>

                                        @if ($errors->any())
                                            <ul class="list-group">
                                                @foreach ($errors->all() as $error)
                                                    <li class="list-group-item list-group-item-danger my-1">
                                                        {{ $error }}</li>
                                                @endforeach

                                            </ul>
                                        @endif
                             
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="description">Description</label>
                                            <input type="string"  id="description" name="description" class="form-control" value="{{$transaction->description}}" />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11">Amount</label>
                                            <input type="number" id="amount" name="amount" class="form-control" placeholder="" value="{{$transaction->amount}}"/>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="happened_on">Date Made</label>
                                            <input type="DATE"  id="happened_on" name="happened_on" class="form-control" value="{{$transaction->happened_on}}" />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="happened_on">Type</label>
                                            <select id="type" class="form-control" name="type">
                                                @if($transaction->type === 1)
                                                    <option selected value="Income">Income</option>
                                                    <option value="Expenses">Expenses</option>
                                                @else 
                                                    <option  value="Income">Income</option>
                                                    <option selected value="Expenses">Expenses</option>
                                                @endif
                                            </select>
                                        </div>

                                        <input type="submit" class="btn btn-primary" value="Update">
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection
