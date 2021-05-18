@extends('Dashboard.layouts.master')
@section('title', 'بيانات مستخدم')
@section('styles')
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card-box">
                        <h4 class="header-title mt-0 mb-3">البيانات الرئيسية</h4>
                        <img class="card-img-top img-fluid" style="max-height: 400px" src="{{$user->image}}" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">{{$user->name}}</h4>
                            <p class="card-text">ID : {{$user->id}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>البريد : </strong><span>{{$user->email}}</span></li>
                            <li class="list-group-item"><strong>المدينة : </strong><span>{{$user->city->name}}</span></li>
                            <li class="list-group-item"><strong>تاريخ الانضمام : </strong><span>{{$user->created_at}}</span></li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
