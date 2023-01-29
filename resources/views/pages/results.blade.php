@extends('layout.default', [])
@section('title', 'Results - justGO')

@php
    // Lets make sure we decode the Json data received
    $resultsDecoded = json_decode($results);
@endphp

@if(isset($resultsDecoded->status) && $resultsDecoded->status == 1)
    @section('content')
        <div class="content-area">
            <div class="container-sm bg-white rounded-5 p-4">
                <img src="images/banner-book.svg" class="img-fluid d-block m-auto mb-3" />
                <h3 class="text-center">Select your trip</h3>
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#departure_trip_pane" type="button" role="tab" aria-controls="departure_trip_pane" aria-selected="true">Departure Trip</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#return_trip_pane" type="button" role="tab" aria-controls="return_trip_pane" aria-selected="false">Return Trip</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="departure_trip_pane" role="tabpanel" aria-labelledby="departure_trip" tabindex="0">
                        <div class="row mt-3 g-1">
                            @if(isset($resultsDecoded->outbound_results_count) && !empty($resultsDecoded->outbound_results_count))
                                <div class="col-7 align-self-center">
                                    <ul class="fa-ul fa-ul list-inline ms-0 mb-0">
                                        <li class="list-inline-item ms-4"><a href="#" class="text-black-50"><span class="fa-li"><i class="fa-solid fa-van-shuttle"></i></span><small>{{ $resultsDecoded->outbound_results_count . ' Results' }}</small></a></li>
                                    </ul>
                                </div>
                            @endif

                            <div class="col-5">
                                <select class="form-select">
                                    <option value="">Sort By</option>
                                    <option value="cheapest">Cheapest</option>
                                    <option value="ealierst">Earliest Departure</option>
                                    <option value="latest">Latest Departure</option>
                                    <option value="leaststops">Least Stops</option>
                                    <option value="fastest">Fastest</option>
                                </select>
                            </div>
                        </div>
                        <ul class="results-list" id="accordionResult">
                            @if(isset($resultsDecoded->outbound_results) && !empty($resultsDecoded->outbound_results))
                                @foreach($resultsDecoded->outbound_results as $key => $departureTrip)
                                    <li class="accordion-item mt-3">
                                        <strong class="text-uppercase">{{ $departureTrip->provider }}</strong>
                                        <div class="bg-grey">
                                            <div class="row g-0">
                                                <div class="col-3 bordered border-end border-light">
                                                    <div class="p-2">
                                                        @if(!empty($departureTrip->carrier_logo))
                                                            <img src="{{ $departureTrip->carrier_logo }}" class="img-fluid m-auto d-block carrier-logo" />
                                                        @else
                                                            <img src="images/carrier_logos/mbtransport-logo.png" class="img-fluid m-auto d-block carrier-logo" />
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-5 bordered border-end border-light">
                                                    <div class="p-2">
                                                        <ul class="fa-ul ms-3">
                                                            <li><span class="fa-li"><i class="fa-regular fa-clock"></i></span><strong>DURATION</strong> {{ $departureTrip->journeyDuration }}</li>
                                                        </ul>
                                                        <span class="d-block mt-1">{{ $departureTrip->availableSeats }} Seats Available</span>
                                                        <div class="mt-1">
                                                            <div class="rating-box">
                                                                <div class="rating" style="width:80%;"></div>
                                                            </div>
                                                            <small class="text-uppercase text-nowrap mt-1">(21) Reviews</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-center">
                                                    <div class="p-1 d-table h-100 w-100">
                                                        <div class="d-table-cell align-middle">
                                                            <strong class="text-uppercase text-orange">{{ $departureTrip->classType }}</strong>
                                                            <h6 class="mb-0">R{{ $departureTrip->price }}</h6>
                                                            <small class="text-uppercase">per person</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapse_{{ $key }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionResult">
                                                <div class="row g-0">
                                                    <div class="col-8 bordered border-end border-top border-light">
                                                        <div class="p-2">
                                                            <ul class="fa-ul ms-3">
                                                                @php
                                                                    $departurelocation = explode(":", $departureTrip->departureLocationDescription);
                                                                    $destinationLocation = explode(":", $departureTrip->destinationLocationDescription);


                                                                @endphp
                                                                <li>
                                                                    <span class="fa-li"><i class="fa-solid fa-van-shuttle"></i></span><strong>DEPART</strong> {{ $departureTrip->departureLocation }} <span class="text-uppercase">{{ $departureTrip->depature_time }}</span><br>
                                                                    <small class="text-uppercase">{{ $departurelocation[1] }}</small>
                                                                </li>
                                                                <li>
                                                                    <span class="fa-li"><i class="fa-solid fa-van-shuttle"></i></span><strong>ARRIVE</strong> {{ $departureTrip->destinationLocation }} <span class="text-uppercase">{{ $departureTrip->arrival_time }}</span><br>
                                                                    <small class="text-uppercase">{{ $destinationLocation[1] }}</small>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="accordion-button text-center d-block collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $key }}" aria-expanded="true" aria-controls="collapse_{{ $key }}">
                                                <i class="fas fa-caret-down"></i>
                                            </button>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="d-grid">
                            <button type="button" class="btn btn-link btn-sm text-black-50 mb-3"><small>Load more results</small></button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="return_trip_pane" role="tabpanel" aria-labelledby="return_trip" tabindex="0">
                        <div class="row mt-3 g-1">
                            <div class="col-7 align-self-center">
                                <ul class="fa-ul fa-ul list-inline ms-0 mb-0">
                                    <li class="list-inline-item ms-4"><a href="#" class="text-black-50"><span class="fa-li"><i class="fa-solid fa-van-shuttle"></i></span><small>10 Results</small></a></li>
                                    <li class="list-inline-item ms-4"><a href="#" class="text-black-50"><span class="fa-li"><i class="fa-solid fa-van-shuttle"></i></span><small>15 Results</small></a></li>
                                </ul>
                            </div>
                            <div class="col-5">
                                <select class="form-select">
                                    <option value="">Sort By</option>
                                    <option value="cheapest">Cheapest</option>
                                    <option value="ealierst">Earliest Departure</option>
                                    <option value="latest">Latest Departure</option>
                                    <option value="leaststops">Least Stops</option>
                                    <option value="fastest">Fastest</option>
                                </select>
                            </div>
                        </div>
                        <ul class="results-list" id="accordionResult">
                            <li class="accordion-item mt-3">
                                <strong class="text-uppercase">MBTransport</strong>
                                <div class="bg-grey">
                                    <div class="row g-0">
                                        <div class="col-3 bordered border-end border-light">
                                            <div class="p-2">
                                                <img src="images/carrier_logos/mbtransport-logo.png" class="img-fluid m-auto d-block carrier-logo" />
                                            </div>
                                        </div>
                                        <div class="col-5 bordered border-end border-light">
                                            <div class="p-2">
                                                <ul class="fa-ul ms-3">
                                                    <li><span class="fa-li"><i class="fa-regular fa-clock"></i></span><strong>DURATION</strong> 21h00m</li>
                                                </ul>
                                                <span class="d-block mt-1">4 Seats Available</span>
                                                <div class="mt-1">
                                                    <div class="rating-box">
                                                        <div class="rating" style="width:80%;"></div>
                                                    </div>
                                                    <small class="text-uppercase text-nowrap mt-1">(21) Reviews</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 text-center">
                                            <div class="p-1 d-table h-100 w-100">
                                                <div class="d-table-cell align-middle">
                                                    <strong class="text-uppercase text-orange">Adult Lux</strong>
                                                    <h6 class="mb-0">R299.00</h6>
                                                    <small class="text-uppercase">per person</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="result_collapse_01" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionResult">
                                        <div class="row g-0">
                                            <div class="col-8 bordered border-end border-top border-light">
                                                <div class="p-2">
                                                    <ul class="fa-ul ms-3">
                                                        <li>
                                                            <span class="fa-li"><i class="fa-solid fa-van-shuttle"></i></span><strong>DEPART</strong> Pretoria 07:00 AM<br>
                                                            <small class="text-uppercase">City Train Staion, Smith Street</small>
                                                        </li>
                                                        <li>
                                                            <span class="fa-li"><i class="fa-solid fa-van-shuttle"></i></span><strong>ARRIVE</strong> Harare 09:00 AM<br>
                                                            <small class="text-uppercase">Platform 1, West End Street, City Centre</small>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="accordion-button text-center d-block collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#result_collapse_01" aria-expanded="true" aria-controls="result_collapse_01">
                                        <i class="fas fa-caret-down"></i>
                                    </button>
                                </div>
                            </li>
                        </ul>
                        <div class="d-grid">
                            <button type="button" class="btn btn-link btn-sm text-black-50 mb-3"><small>Load more results</small></button>
                        </div>
                    </div>
                </div>
                <div class="d-gridx text-center">
                    <button type="search" class="btn btn-success btn-lg rounded-5 py-3 px-4">Back to Search</button>
                </div>
            </div>
        </div>
    @endsection
@else
    <p>No Data exists</p>
@endif


