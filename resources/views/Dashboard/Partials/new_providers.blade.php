<div class="row">
    @foreach(\App\Models\User::whereType('USER')->get() as $user)
    <div class="col-xl-3 col-md-6">
        <div class="card-box widget-user">
            <div>
                <div class="avatar-lg float-left mr-3">
                    <img src="{{$user->image}}" class="img-fluid rounded-circle" alt="user">
                </div>
                <div class="wid-u-info">
                    <h5 class="mt-0">{{$user->name}}</h5>
                    <p class="text-muted mb-1 font-13 text-truncate">{{$user->email}}</p>
                    <small class="text-warning"><b>{{$user->city->name}}</b></small>
                </div>
            </div>
        </div>
    </div><!-- end col -->

    @endforeach

</div>
<!-- end row -->
