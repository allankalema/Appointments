
@extends('base')

@section('content')
<div class="container">
    <h1>Doctor Dashboard</h1>
    <p>Welcome, Dr. {{ auth()->user()->first_name }}!</p>
</div>
@endsection
