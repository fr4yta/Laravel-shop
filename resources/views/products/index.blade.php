@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="font-weight-bold mt-2"><i class="fa-solid fa-list"></i> List of products:</h1>
            </div>
            <div class="col-md-6">
                <a href="{{ route('products.create') }}" class="float-right"><button class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Add</button></a>
            </div>
            <div class="col-md-12">
                @include('helpers.flash-messages')
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Price</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->amount }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                @if($product->hasCategory())
                                    {{ $product->category->name }}
                                @else
                                    Brak
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}"><button class="btn btn-success btn-sm"><i class="fa-solid fa-eye"></i></button></a>
                                <a href="{{ route('products.edit', $product->id) }}"><button class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                <a href="#"><button class="btn btn-danger btn-sm delete" data-id="{{ $product->id }}"><i class="fa-solid fa-trash"></i></button></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 mt-3">
                <div class="pagination justify-content-end">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    const deleteUrl = "{{ url('products') }}/";
@endsection

@section('javascript-files')
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection
