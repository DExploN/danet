@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{route('admin.cards.update',['card'=>$card->id])}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <h1 class="h3">Update</h1>
            <div class="row form-group">
                <div class="col">
                    <img class="card-img" src="{{$card->imageUrl}}"/>
                </div>
            </div>
            @include('admin.cards.form')

            <button type="submit" class="btn btn-success">Update</button>
            <button type="submit" form="remove-form" class="btn btn-danger">Delete</button>
        </form>
        <form id="remove-form" action="{{route('admin.cards.destroy',['card'=>$card->id])}}" method="POST">
            @method('DELETE')
            @csrf
        </form>
    </div>
@endsection
