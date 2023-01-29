@extends('layout.default', [])
@section('title', 'Passenger Details - justGO')

@php

@endphp

@section('content')
    <div class="content-area">
        <div class="container-sm bg-white rounded-5 p-4">
            <img src="images/banner-book.svg" class="img-fluid d-block m-auto mb-3" />
            <h3 class="text-center">Passenger Details</h3>
            <p class="text-center"><strong class="text-uppercase">Primary Booking Contact:</strong></p>
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
            <form action="{{ route('passenger-details.submit') }}" name="passenger-details" method="post" id="passenger-details" class="mb-4">
                @csrf <!-- {{ csrf_field() }} -->
                <small class="mb-1 d-block">* Mandatory</small>
                <div class="mb-3">
                    <div class="input-group">
                        <select class="form-select w-auto" style="flex: initial;">
                            <option value="" selected>+27</option>
                            <option value="">+1</option>
                            <option value="">+233</option>
                            <option value="">+234</option>
                            <option value="">+236</option>
                            <option value="">+243</option>
                            <option value="">+250</option>
                            <option value="">+254</option>
                            <option value="">+255</option>
                            <option value="">+256</option>
                            <option value="">+258</option>
                            <option value="">+260</option>
                            <option value="">+263</option>
                            <option value="">+264</option>
                            <option value="">+265</option>
                            <option value="">+266</option>
                            <option value="">+267</option>
                            <option value="">+268</option>
                            <option value="">+44</option>
                            <option value="">+49</option>
                            <option value="">+91</option>
                        </select>
                        <input type="text" class="form-control" placeholder="Mobile Number *" name="mobile-number" value="{{ old('mobile-number') }}">
                    </div>
                    @error('mobile-number')
                        <div class="alert alert-danger" style="margin-top: 10px;">Mobile number is required.</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-text input-group-addon pe-0">
                            <i data-feather="mail"></i>
                        </div>
                        <input type="email" class="form-control border-start-0" placeholder="Email Address *" value="{{ old('email') }}" name="email">
                    </div>
                    @error('email')
                        <div class="alert alert-danger" style="margin-top: 10px;">The email field is required.</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="newsletter">
                        <label class="form-check-label" for="newsletter">
                            <small>Subscribe to our Newsletter</small>
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="funeral_cover">
                        <label class="form-check-label" for="funeral_cover">
                            <small>Call me, to receive more info on the justGO affordable funeral cover R10 000 for R40 for up to 6 family members</small>
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <p class="text-center"><strong class="text-uppercase">Passenger 1 - Adult</strong></p>
                </div>
                <div class="row mb-3">
                    <div class="input-group">
                        <select class="form-select w-auto" style="flex: initial;">
                            <option value="" selected>Mr</option>
                            <option value="">Mrs</option>
                            <option value="">Ms</option>
                        </select>
                        <input type="text" class="form-control" placeholder="First Name as per ID/Passport">
                    </div>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Surname Name as per ID/Passport">
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control border-end-0" name="date-birth"placeholder="Date of Birth">
                        <div class="input-group-text input-group-addon">
                            <i data-feather="calendar"></i>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="search" class="btn btn-success btn-lg rounded-5 py-3">Continue to Payment</button>
                </div>
            </form>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
    </div>
@endsection

