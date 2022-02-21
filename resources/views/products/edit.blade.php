@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('products.update', $product->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name..." name="name" maxlength="500" value="{{ $product->name }}" />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="3" name="description" maxlength="1500">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" min="0" class="form-control" id="amount" placeholder="Enter amount..." name="amount" value="{{ $product->amount }}" />
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" min="0" class="form-control" id="price" placeholder="Enter price..." name="price" value="{{ $product->price }}" />
                    </div>
                    <button type="submit" class="btn btn-primary float-right px-5">Update form</button>
                </form>
            </div>
        </div>
    </div>
@endsection
