@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name..." name="name" maxlength="500" value="{{ old('name') }}" />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="3" name="description" maxlength="1500">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" min="0" class="form-control" id="amount" placeholder="Enter amount..." name="amount" value="{{ old('amount') }}" />
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" min="0" class="form-control" id="price" placeholder="Enter price..." name="price" value="{{ old('price') }}" />
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image" />
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right px-5">Send form</button>
                </form>
            </div>
        </div>
    </div>
@endsection
