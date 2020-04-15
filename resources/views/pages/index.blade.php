@extends('layout.app')
@section('content')
    <router-view name="issueList"></router-view>
    <router-view name="clientList"></router-view>
@endsection
