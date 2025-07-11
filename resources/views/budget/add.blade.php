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
                                    <form action="{{ route('budget.store') }}" method="POST">

                                        @csrf
                                        @method('POST')

                                        <h1 style="font-family: papyrus">Creating a Budget</h1>

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
                                            <input type="text"  id="description" name="description" class="form-control" />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11">Amount</label>
                                            <input type="number" id="amount" name="amount" class="form-control" placeholder="" value="{{ old('amount')}}"/>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="start_date">Start Date</label>
                                            <input type="DATE"  id="start_date" name="start_date" class="form-control" value="{{date('Y-m-d H:i:s')}}" />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="end_date">End Date</label>
                                            <input type="DATE"  id="end_date" name="end_date" class="form-control" value="{{date('Y-m-d H:i:s')}}" />
                                        </div>



                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="category_id">Category</label>
                                            <select id="category_id" class="form-control" name="category_id">
                                                @foreach ($categories as $category )
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                      
                                            </select>
                                        </div>

                                        <input type="submit" class="btn btn-primary" value="Save">
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
