@extends('base')

@section('content')
<div class="container">
    <h1>Patient Dashboard</h1>
    <p>Welcome, {{ auth()->user()->first_name }}!</p>
</div>
@endsection
