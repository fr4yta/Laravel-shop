@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="font-weight-bold mt-2"><i class="fa-solid fa-list"></i> List of orders:</h1>
            </div>
            <div class="col-md-12">
                @include('helpers.flash-messages')
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Ilość</th>
                        <th scope="col">Cena [PLN]</th>
                        <th scope="col">Status zamówienia</th>
                        <th scope="col">Produkty</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->price }} [PLN]</td>
                            <td>{{ $order->payment->status }}</td>
                            <td>
                                <ul>
                                @foreach($order->products as $product)
                                    <li>{{ $product->name }}</li>
                                @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 mt-3">
                <div class="pagination justify-content-end">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
