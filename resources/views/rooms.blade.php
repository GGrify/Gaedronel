@extends('layout')

@section('css') {{asset("css/rooms.css")}} @endsection

@section('title') Gaedronel - Вільні кімнати @endsection

@section('heading') Кімнати @endsection


@section('content')
    @php
        if(isset($_GET['type']))
            $type = $_GET['type'];
            else $type = null;
        if(isset($_GET['capacity']))
            $capacity = $_GET['capacity'];
            else $capacity = null;

        if(isset($_GET['dateStart']))
            $dateStart = $_GET['dateStart'];
            else $dateStart = null;
        if(isset($_GET['dateEnd']))
            $dateEnd = $_GET['dateEnd'];
            else $dateEnd = null;
    @endphp
    <span class="selectedDate">@php echo ($dateStart == null || $dateEnd == null) ? '' : $dateStart . ' - ' . $dateEnd @endphp</span>

    <div class="wrapper">
        <div class="selectors">
            <div>
                <label for="typeRoom">Тип кімнати</label>
                <select name="" id="typeRoom" onchange="location.href=this.options[this.selectedIndex].value;">
                    <option @php echo ($type == null || 'all') ? 'selected="selected"' : '' @endphp value="{{request()->fullUrlWithQuery(['type' => ''])}}">Будь-який</option>
                    <option @php echo ($type == 'Econom') ? 'selected="selected"' : '' @endphp value="{{request()->fullUrlWithQuery(['type' => 'Econom'])}}">Економ</option>
                    <option @php echo ($type == 'Classic') ? 'selected="selected"' : '' @endphp value="{{request()->fullUrlWithQuery(['type' => 'Classic'])}}">Класік</option>
                    <option @php echo ($type == 'Luxury') ? 'selected="selected"' : '' @endphp value="{{request()->fullUrlWithQuery(['type' => 'Luxury'])}}">Люкс</option>
                </select>
            </div>

            <div>
                <label for="capacityRoom">Кількість людей</label>
                <select name="" id="capacityRoom" onchange="location.href=this.options[this.selectedIndex].value;">
                    <option value="{{request()->fullUrlWithQuery(['capacity' => ''])}}" @php echo ($capacity == null || 'all') ? 'selected="selected"' : '' @endphp>Будь-яка</option>
                    <option value="{{request()->fullUrlWithQuery(['capacity' => '1'])}}" @php echo ($capacity == 1) ? 'selected="selected"' : '' @endphp>1</option>
                    <option value="{{request()->fullUrlWithQuery(['capacity' => '2'])}}" @php echo ($capacity == 2) ? 'selected="selected"' : '' @endphp>2</option>
                    <option value="{{request()->fullUrlWithQuery(['capacity' => '3'])}}" @php echo ($capacity == 3) ? 'selected="selected"' : '' @endphp>3</option>
                    <option value="{{request()->fullUrlWithQuery(['capacity' => '4'])}}" @php echo ($capacity == 4) ? 'selected="selected"' : '' @endphp>4</option>
                </select>
            </div>
        </div>
        <div class="items">
            @foreach($rooms as $room)
                <div class="item">
                    <div class="imgs">
                        <img class="mainImg" src="images/{{$room->firstImg}}" alt="Room Foto">
                        <ul class="miniFoto">
                            <li>
                                <img class="miniFoto" src="images/{{$room->firstImg}}" alt="Room Foto">
                            </li>
                            <li>
                                <img class="miniFoto" src="images/{{$room->secondImg}}" alt="Room Foto">
                            </li>
                            <li>
                                <img class="miniFoto" src="images/{{$room->thirdImg}}" alt="Room Foto">
                            </li>
                        </ul>
                    </div>
                    <div class="information">
                        <div>
                            <h3>{{$room->type}}. {{$room->capacity}} чол.</h3>
                            <h4>{{$room->pricePerDay}}₴ / 1 день</h4>
                            <ul>
                                <li>
                                    <svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.8 18L14.4 13.2C13.4 12.45 12.15 12 10.8 12C9.45 12 8.2 12.45 7.2 13.2L10.8 18ZM10.8 0C6.75 0 3.01 1.34 0 3.6L1.8 6C4.3 4.12 7.42 3 10.8 3C14.18 3 17.3 4.12 19.8 6L21.6 3.6C18.59 1.34 14.85 0 10.8 0ZM10.8 6C8.1 6 5.61 6.89 3.6 8.4L5.4 10.8C6.9 9.67 8.77 9 10.8 9C12.83 9 14.7 9.67 16.2 10.8L18 8.4C15.99 6.89 13.5 6 10.8 6Z" fill="#2F242C"/>
                                    </svg>
                                    Wi-Fi
                                </li>
                                <li>
                                    <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 6.557V0H16V2H4V0H2V6.557C0.81 7.25 0 8.525 0 10V14C0 14.2652 0.105357 14.5196 0.292893 14.7071C0.48043 14.8946 0.734784 15 1 15H2V19H4V15H16V19H18V15H19C19.2652 15 19.5196 14.8946 19.7071 14.7071C19.8946 14.5196 20 14.2652 20 14V10C20 8.525 19.189 7.25 18 6.557ZM16 4V6H11V4H16ZM4 4H9V6H4V4ZM18 13H2V10C2 8.897 2.897 8 4 8H16C17.103 8 18 8.897 18 10V13Z" fill="#2F242C"/>
                                    </svg>
                                    Двуспальне ліжко
                                </li>
                                <li>
                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.9793 1.56542L15.6401 2.88325L14.3785 1.64181C13.8496 1.12129 13.2217 0.708395 12.5306 0.426692C11.8395 0.14499 11.0988 0 10.3507 0C9.60271 0 8.862 0.14499 8.17091 0.426692C7.47982 0.708395 6.85188 1.12129 6.32294 1.64181C6.30549 1.65894 6.2886 1.67641 6.27145 1.69374C5.67549 1.28058 4.97566 1.03645 4.24833 0.987996C3.521 0.939541 2.79412 1.08862 2.14701 1.41897C1.49991 1.74932 0.957445 2.24825 0.578826 2.86129C0.200208 3.47434 -1.80747e-05 4.17795 1.22378e-09 4.89534V17H1.63318V4.89534C1.63317 4.47446 1.75005 4.06158 1.9712 3.70133C2.19235 3.34108 2.50935 3.04716 2.88793 2.85134C3.26651 2.65553 3.69228 2.56527 4.11922 2.59031C4.54615 2.61536 4.95801 2.75476 5.31027 2.99345C4.74526 4.05273 4.53878 5.26191 4.72094 6.44476C4.9031 7.6276 5.46436 8.72228 6.32294 9.56926L7.58442 10.8107L6.36362 12.0121L7.38435 13.0166L18 2.5699L16.9793 1.56542ZM8.62552 9.56233L7.47775 8.43284C6.72318 7.6815 6.30141 6.66684 6.30455 5.61049C6.3077 4.55413 6.73551 3.54192 7.49453 2.79495C8.25356 2.04798 9.28213 1.62694 10.3556 1.62381C11.429 1.62068 12.4601 2.0357 13.2236 2.77823L14.3714 3.90778L8.62552 9.56233Z" fill="#2F242C"/>
                                    </svg>
                                    Душ
                                </li>
                            </ul>
                            <p>Дешевий та зручний варіант для швидних подорожей</p>
                        </div>
                        <a href="@php echo (isset($dateStart, $dateEnd)) ? "/booking?dateStart=$dateStart&dateEnd=$dateEnd&id=$room->id" : '/' @endphp">Забронювати</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="js/main.js"></script>
@endsection
