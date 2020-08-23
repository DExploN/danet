@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-start mb-3">
            <a href="{{route('admin.cards.create')}}" class="btn btn-success">
                Create
            </a>
        </div>
        <div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Title ru</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($cards as $card)
                    <tr>
                        <th scope="row">{{$card->id}}</th>
                        <td>{{optional($card->getContent('ru'))->title}}</td>
                        <td><a class="btn btn-primary"
                               href="{{route('admin.cards.edit',['card'=> $card->id])}}">Edit</a></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            {{$cards->links()}}
        </div>
    </div>
@endsection
