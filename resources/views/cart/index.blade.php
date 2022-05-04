@extends('layouts.app')

@section('css-file')
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="cart_section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="cart_container">
                                @include('helpers.flash-messages')
                                <div class="cart_title"><i class="fa fa-shopping-bag"></i> Koszyk<small> (<b>{{ $cart->getItems()->count() }}</b> przedmiot/y) </small></div>
                                @if (session('warning'))
                                    <div class="alert alert-danger">
                                        <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{ session('warning') }}
                                    </div>
                                @endif
                                <form action="{{ route('orders.store') }}" method="post">
                                    @csrf
                                    <div class="cart_items">
                                        <ul class="cart_list">
                                            @foreach($cart->getItems() as $item)
                                                <li class="cart_item clearfix">
                                                    <div class="cart_item_image"><img src="{{ $item->getImage() }}" alt="Zdjęcie produktu" class="img-fluid"/></div>
                                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                                        <div class="cart_item_name cart_info_col">
                                                            <div class="cart_item_title">Nazwa</div>
                                                            <div class="cart_item_text">{{ $item->getName() }}</div>
                                                        </div>
                                                        <div class="cart_item_quantity cart_info_col">
                                                            <div class="cart_item_title">Ilość [szt.]</div>
                                                            <div class="cart_item_text">{{ $item->getQuantity() }}</div>
                                                        </div>
                                                        <div class="cart_item_price cart_info_col">
                                                            <div class="cart_item_title">Cena [PLN]</div>
                                                            <div class="cart_item_text">{{ $item->getPrice() }}</div>
                                                        </div>
                                                        <div class="cart_item_total cart_info_col">
                                                            <div class="cart_item_title">Całość [PLN]</div>
                                                            <div class="cart_item_text">{{ $item->getSum() }}</div>
                                                        </div>
                                                        <div class="cart_item_total cart_info_col">
                                                            <div class="cart_item_title">Usuń z koszyka</div>
                                                            <div class="cart_item_text">
                                                                <button type="button" class="btn btn-danger btn-sm delete mr-4" data-id="{{ $item->getProductid() }}"><i class="fa-solid fa-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="order_total">
                                        <div class="order_total_content text-md-right">
                                            <div class="order_total_title">Całkowita wartość koszyka [PLN]:</div>
                                            <div class="order_total_amount"><b>{{ $cart->getSum() }}</b></div>
                                        </div>
                                    </div>
                                    <div class="cart_buttons">
                                        <a href="/"><button type="button" class="button cart_button_clear"><i class="fa fa-backward-fast"></i> Wróć do sklepu</button></a>
                                        <button type="submit" class="button cart_button_checkout"@if(!$cart->hasItems()) disabled @endif><i class="fa fa-credit-card"></i> Zapłać</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    const deleteUrl = "{{ url('cart') }}/";
@endsection

@section('javascript-files')
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection
