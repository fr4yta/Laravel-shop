@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ __('shop.product.edit_form.title') }}: <b>{{ $product->id }}</b></h1><hr/>
                <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="name">{{ __('shop.product.add_form.name') }} <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" maxlength="500" value="{{ $product->name }}" required />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('shop.product.add_form.description') }} <span class="text-danger font-weight-bold">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description" maxlength="1500" required>{{ $product->description }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="amount">{{ __('shop.product.add_form.amount') }} <span class="text-danger font-weight-bold">*</span></label>
                        <input type="number" min="0" class="form-control @error('amount') is-invalid @enderror" id="amount" placeholder="Enter amount..." name="amount" value="{{ $product->amount }}" required />
                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">{{ __('shop.product.add_form.price') }} <span class="text-danger font-weight-bold">*</span></label>
                        <input type="number" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Enter price..." name="price" value="{{ $product->price }}" required />
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="category_id">{{ __('shop.product.add_form.category') }}</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"@if($product->isSelectedCategory($category->id)) selected @endif>{{ $category->name }}</option>
                                @endforeach
                                <option value=""@if(is_null($product->category)) selected @endif>Brak</option>
                            </select>
                            @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">{{ __('shop.product.add_form.image') }}</label><br/>
                        @if($product->image_path == null)
                            <div class="alert alert-warning rounded">Brak zdjęcia.</div>
                        @else
                            <a href="{{ route('products.downloadImage', $product->id) }}"><img src="{{ asset('storage/' . $product->image_path) }}" alt="Product image" width="240px" height="240px" /></a>
                            {{-- <a href="{{ asset('storage/' . $product->image_path) }}" download="download"><button class="btn btn-sm btn-success" type="button">Pobierz obraz</button></a>--}}
                        @endif
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" />
                            <label class="custom-file-label" for="image">{{ __('shop.product.add_form.image_button') }}</label>
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right px-5">{{ __('shop.product.buttons.button_edit') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
