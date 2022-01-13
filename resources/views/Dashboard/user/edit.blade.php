@extends('Dashboard.layouts.master')
@section('title', 'تعديل user')
@section('styles')
    <link href="{{asset('assets/libs/dropify/dist/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
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
                        <form method="POST" action="{{route('admin.user.update',$row->id)}}" enctype="multipart/form-data" data-parsley-validate novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">الإسم*</label>
                                <input value="{{$row->name}}" type="text" name="name" required class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="phone">phone*</label>
                                <input value="{{$row->phone}}" type="text" name="phone" required class="form-control" id="phone">
                            </div>
                            <div class="form-group">
                                <label for="email">email*</label>
                                <input value="{{$row->email}}" type="text" name="email" required class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="pass1">كلمة المرور*</label>
                                <input id="pass1" type="password" name="password" placeholder="Password"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="passWord2">تأكيد كلمة المرور *</label>
                                <input data-parsley-equalto="#pass1" type="password"
                                       placeholder="Password" class="form-control" id="passWord2">
                            </div>
                            <div class="form-group">
                                <label for="parent_id">City*</label>
                                <select name="city_id" required class="form-control" id="city_id">
                                    @foreach(\App\Models\DropDown::where('class','City')->latest()->get() as $city)
                                        <option @if($row->city_id==$city->id) selected @endif  value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
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
    <script src="{{asset('assets/libs/dropify/dist/js/dropify.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();
            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });
            // Used events
            var drEvent = $('#input-file-events').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });
            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });
            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });
            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>

    <!-- Validation js (Parsleyjs) -->
    <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>
    <!-- validation init -->
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
@endsection
