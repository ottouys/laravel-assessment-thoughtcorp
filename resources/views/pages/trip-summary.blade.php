@extends('layout.default', [])
@section('title', 'Book with partner logo - justGO')

@php
    // Lets make sure we decode the Json data received
    $tripSummaryDecoded = json_decode($tripSummary);
@endphp

@if(isset($tripSummaryDecoded->status) && $tripSummaryDecoded->status == 1)
    @section('content')
    <div class="content-area">
        <div class="container-sm bg-white rounded-5 p-4 rounded-bottom-0">
            <img src="images/banner-book.svg" class="img-fluid d-block m-auto mb-3" />
            <h3 class="text-center mb-5">Book your trip</h3>
        </div>
        <div class="container-sm book-trip rounded-5 p-4">
            <form class="mb-4 mt-2">
                <ul class="fa-ul ms-4 mb-2">
                    <li>
                        <span class="fa-li"><i class="fa-solid fa-van-shuttle"></i></span><strong class="text-uppercase">Intercape</strong>
                    </li>
                </ul>
                @php
                    $departurelocation = explode(":", $tripSummaryDecoded->outbound_trip_summary->departure_place);
                    $destinationLocation = explode(":", $tripSummaryDecoded->outbound_trip_summary->arrival_place);
                    $departureDate = date('d.m.y', strtotime($tripSummaryDecoded->outbound_trip_summary->depature_date));
                    $priceArray = explode(" - ", $tripSummaryDecoded->outbound_trip_summary->depature_time);
                    $startTime = strtotime($priceArray[0]);
                    $endTime = strtotime($priceArray[1]);
                    $duration = $startTime - $endTime;
                    $hours = floor($duration / 3600);
                    $minutes = floor(($duration / 60) % 60);
                @endphp
                <div class="card border-0 bg-white rounded-3 mb-3">
                    <div class="card-header bg-transparent">
                        <div class="row">
                            <div class="col-8 align-self-center">
                                <ul class="fa-ul ms-3 float-end mb-0">
                                    <li><span class="fa-li"><i class="fa-regular fa-clock"></i></span><strong>DURATION</strong> {{ $hours . 'h' . $minutes . 'm' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">

                            <li>
                                <strong><span class="text-red">{{ $departureDate }}</span> <span class="text-black">DEPART</span></strong> {{ $departurelocation[0] }}<br>
                                <small class="text-uppercase">{{ $departurelocation[1] }}</small>
                            </li>
                            <li class="mt-3">
                                <strong><span class="text-red">{{ $departureDate }}</span> <span class="text-black">ARRIVE</span></strong> {{ $destinationLocation[0] }}<br>
                                <small class="text-uppercase">{{ $destinationLocation[1] }}</small>
                            </li>
                        </ul>
                    </div>
                </div>
                <small><strong class="text-orange text-uppercase">Special Price</strong></small>
                <p class="mb-0"><strong>{{ $tripSummaryDecoded->outbound_trip_summary->total_passengers }} x Passengers Departing</strong></p>
                <p id="initialPrice"><strong class="fs-1">R{{ $tripSummaryDecoded->grand_total_price }}</strong></p>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" data-ammount-change='9' id="funeral_cover">
                        <label class="form-check-label w-100" for="funeral_cover">
                            <small>Include insurance in my booking</small><strong class="float-end">R9.00  <i class="fas fa-question-circle text-orange" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="This travel insurance covers the passenger for R10,000 in case of accidental death, for a continuous period of 30 days from the 1st minute on the 1st day of travel. The premium is payable as a one-off and in advance before the traveller embarks on his/her travel."></i></strong>
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" data-ammount-change='5' id="sms_confirmation">
                        <label class="form-check-label w-100" for="sms_confirmation">
                            <small>Send me SMS confiration</small><strong class="float-end">R5.00 <i class="fas fa-question-circle opacity-0"></i></strong>
                        </label>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="search" class="btn btn-success btn-lg rounded-5 py-3">Book This Trip</button>
                </div>
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-secondary btn-lg rounded-circle  fs-1 px-3" style="line-height: 34px;"><i class="fas fa-times"></i></button>
                </div>
            </form>
        </div>
    </div>
    @endsection
@endif

