@extends('layouts.front', ['action' => 'admin'])

@section('banner')

    @include('admin.partials.siteStats')

@endsection

@section('content')

<table class="table table-striped table-hover">
    <thead>
    <th>Username</th>
    <th>Email</th>
    <th>Date Joined</th>
    <th>Role</th>
    <th>Action</th>
    </thead>
    @foreach ($users as $user)
    <tr class="justify-content-center">
        <td>
            <a href="{{route('user.show', $user->id)}}"><h4 style="margin: -5px;"> {{$user->name}} </h4></a>
        </td>
        <td> {{$user->email}} </td>
        <td> {{$user->created_at}} </td>
        <td> {{$user->role}} </td>
        <td>
            <button class="btn btn-success">Edit</button>
            <button class="btn btn-danger">Block</button>
        </td>

    </tr>
    @endforeach
</table>

@endsection
