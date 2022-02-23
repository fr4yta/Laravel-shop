@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Podgląd przedmiotu: <b>{{ $product->id }}</b></h1><hr/>
                <div class="form-group">
                    <label for="name">{{ __('shop.product.add_form.name') }} <span class="text-danger font-weight-bold">*</span></label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name..." name="name" maxlength="500" value="{{ $product->name }}" readonly />
                </div>
                <div class="form-group">
                    <label for="description">{{ __('shop.product.add_form.description') }} <span class="text-danger font-weight-bold">*</span></label>
                    <textarea class="form-control" id="description" rows="3" name="description" maxlength="1500" readonly>{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="amount">{{ __('shop.product.add_form.amount') }} <span class="text-danger font-weight-bold">*</span></label>
                    <input type="number" min="0" class="form-control" id="amount" placeholder="Enter amount..." name="amount" value="{{ $product->amount }}" readonly />
                </div>
                <div class="form-group">
                    <label for="price">{{ __('shop.product.add_form.price') }} <span class="text-danger font-weight-bold">*</span></label>
                    <input type="number" step="0.01" min="0" class="form-control" id="price" placeholder="Enter price..." name="price" value="{{ $product->price }}" readonly />
                </div>
                <div class="form-group">
                    <label for="image">{{ __('shop.product.add_form.image') }}</label>
                    @if($product->image_path == null)
                        <div class="alert alert-warning rounded">Brak zdjęcia.</div>
                    @else
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product image" width="240px" height="240px" />
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
