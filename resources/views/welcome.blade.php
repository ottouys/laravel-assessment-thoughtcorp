@extends('layout.default', [])
@section('title', 'Home Page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col" style="margin-top:100px;">
                <h1>Sitelinks</h1>
                <ul>
                    <li><a href="/results">Results</a></li>
                    <li><a href="/trip-summary">Trip Summary</a></li>
                    <li><a href="/passenger-details">Passenger Details</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection

