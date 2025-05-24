@extends('admin.layout.admin_master')

@section('title')
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>{{ site_settings()->site_name }}</title>
@endsection

@section('content')
    <div class="content">
        <div class="card">
            <div class="container">
             @livewire('pos')
             </div>
        </div>
    </div>
@endsection
