@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
  @if (false)
  @livewire ('sms-send')
  @endif

  @livewire ('named-sms')
@stop
