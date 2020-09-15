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
                    <th scope="col">@sortablelink('id', 'Id')</th>
                    <th scope="col">Title ru</th>
                    <th scope="col">@sortablelink('is_locked', 'isLocked')</th>
                    <th scope="col">@sortablelink('active', 'Active')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($cards as $card)
                    <tr>
                        <th scope="row">{{$card->id}}</th>
                        <td>{{optional($card->getContent('ru'))->title}}</td>
                        <td>{{ $card->is_locked === 1 ? 'yes' : 'no'}}</td>
                        <td>{{$card->active === 1 ? 'yes' : 'no'}}</td>
                        <td><a class="btn btn-primary"
                               href="{{route('admin.cards.edit',['card'=> $card->id])}}">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$cards->appends(\Request::except('page'))->render()}}
        </div>
    </div>
@endsection
