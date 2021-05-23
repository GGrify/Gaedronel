@extends('layout')

@section('css') {{asset("css/booking.css")}} @endsection

@section('title') Gaedronel - Бронювання @endsection

@section('heading') Бронювання @endsection


@section('content')
    @php $days = floor(abs(strtotime($_GET['dateStart']) - strtotime($_GET['dateEnd'])) / 86400) + 1;
        $price = $days * $room->pricePerDay;
    @endphp

    <div class="wrapper">
        <form class="form" action="/success" method="POST">
            @csrf
            <input type="hidden" name="price" value="@php echo $price @endphp">
            <input type="hidden" name="idRoom" value="@php echo $room->id @endphp">
            <input type="hidden" name="dateStart" value="@php echo $_GET['dateStart'] @endphp">
            <input type="hidden" name="dateEnd" value="@php echo $_GET['dateEnd'] @endphp">

            <label for="name">Прізвище та Ім’я</label>
            <input  id="name" name="name" type="text" placeholder="Іванович Іван" required>

            <label for="email">Почта</label>
            <input id="email" name="email" type="email" placeholder="ivan@gmail.com" required>

            <label for="phone">Телефон</label>
            <input id="phone" name="phone" type="number" placeholder="+38 055 123 45 78" required>

            <label for="card">Номер карти</label>
            <input id="card" name="card" type="number" placeholder="123456789884621" required   >

            <button type="submit">Забронювати</button>

        </form>
        <div class="info">
            <div class="details">
                <span>Тип:</span>
                <span>{{ $room->type }}. {{ $room->capacity }}чол.</span>
                <span>Термін:</span>
                <span>@php echo $_GET['dateStart'].' - '.$_GET['dateEnd'] @endphp</span>
                <span>Сума:</span>
                <span>@php echo $price @endphp₴</span>
            </div>
            <p class="generalInfo">Наш оператор зателефонує вам для підтвердження замовленя.</p>
        </div>
    </div>
@endsection
