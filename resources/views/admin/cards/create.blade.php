@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{route('admin.cards.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.cards.form')

            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
@endsection
