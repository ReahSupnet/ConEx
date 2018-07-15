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
    <th>Status</th>
    <th>Action</th>
    </thead>
    @foreach ($users as $user)
    <tr class="justify-content-center">
        <td>
            <a href="{{route('user.show', $user->id)}}"><h4 style="margin: -5px;"> {{$user->name}} </h4></a>
        </td>
        <td> {{$user->email}} </td>
        <td> {{$user->created_at}} </td>
        <td> {{$user->printRole()}} </td>
        <td id="status_{{$user->id}}"> {{$user->printStatus()}} </td>
        <td>
            {{--<button class="btn btn-success" onclick="window.location.href ='{{route('user.update')}}'">Edit</button>--}}
            <button class="btn btn-danger" onclick="banUser({{$user->id}})">Ban</button>
        </td>

    </tr>
    @endforeach
</table>

@endsection
