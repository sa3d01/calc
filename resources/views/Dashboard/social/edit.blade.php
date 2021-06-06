@extends('Dashboard.layouts.master')
@section('title', 'تعديل')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <div class="card-box">
                        <form method="POST" action="{{route('admin.social.updateSocial')}}" enctype="multipart/form-data" data-parsley-validate novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="facebook">facebook*</label>
                                <input type="url" name="facebook" class="form-control" id="facebook" value="{{$facebook}}">
                            </div>
                            <div class="form-group">
                                <label for="twitter">twitter*</label>
                                <input type="url" name="twitter" class="form-control" id="twitter" value="{{$twitter}}">
                            </div>
                            <div class="form-group">
                                <label for="snap">snap*</label>
                                <input type="url" name="snap" class="form-control" id="snap" value="{{$snap}}">
                            </div>
                            <div class="form-group">
                                <label for="instagram">instagram*</label>
                                <input type="url" name="instagram" class="form-control" id="instagram" value="{{$instagram}}">
                            </div>
                            <div class="form-group">
                                <label for="email">email*</label>
                                <input type="url" name="email" class="form-control" id="email" value="{{$email}}">
                            </div>
                            <div class="form-group text-right mb-0">
                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                    تعديل
                                </button>
                            </div>
                        </form>
                    </div>
                </div><!-- end col -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Validation js (Parsleyjs) -->
    <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>
    <!-- validation init -->
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
@endsection
