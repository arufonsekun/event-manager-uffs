@extends('layouts.app')

@section('content')

    <base-header>
    </base-header>

    <main>
        <p> {{ csrf_token() }} </p>
    </main>

@endsection