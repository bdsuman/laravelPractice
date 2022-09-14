@extends('layouts.default')

@section('title', 'About Us')

@section('content')
    <h1>This is About Us</h1>
@endsection

@push('javascript')
    <script>
        $(document).ready(function () {
            alert('This is About Us');
        });
    </script>
@endpush
