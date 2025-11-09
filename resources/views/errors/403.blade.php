@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-4 text-danger">403</h1>
    <p class="lead">Bu sayfaya erişim yetkiniz yok.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Ana Sayfaya Dön</a>
</div>
@endsection
