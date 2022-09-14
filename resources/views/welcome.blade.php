@extends('layouts.default')

@section('title', 'Welcome Page')

@section('content')
    <h1>This is Welcome</h1>
@endsection

@push('javascript')
    <script>
        $(document).ready(function () {
            alert('This is Welcome');
        });
    </script>
@endpush
