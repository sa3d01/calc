@extends('Dashboard.layouts.master')
@section('title', $class)
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
                        <form method="POST" action="{{route('admin.'.$class.'.update',$row->id)}}" enctype="multipart/form-data" data-parsley-validate novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">الإسم*</label>
                                <input value="{{$row->name}}" type="text" name="name" required class="form-control" id="name">
                            </div>
                            @if($class==="ClinicalStatus")
                                <div class="form-group">
                                    <label for="stress_factor_from">stress factor from</label>
                                    <input value="{{$row->stress_factor_from}}" type="text" name="stress_factor_from" required class="form-control" id="stress_factor_from">
                                </div>
                                <div class="form-group">
                                    <label for="stress_factor_to">stress factor to</label>
                                    <input value="{{$row->stress_factor_to}}" type="text" name="stress_factor_to" required class="form-control" id="stress_factor_to">
                                </div>
                            @elseif($class=="Drug")
                                <div class="form-group">
                                    <label for="parent_id">Nutrient*</label>
                                    <select name="parent_id" required class="form-control" id="parent_id">
                                        @foreach(\App\Models\DropDown::where('class','Nutrient')->latest()->get() as $Classification)
                                            <option @if($row->parent_id==$Classification->id) selected @endif value="{{$Classification->id}}">{{$Classification->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if(count($nutrient_factors)==0)
                                    <div class="form-group">
                                        <label>nutrient factor 1</label>
                                        <input type="text" class="form-control" name="nutrient_factors[]">
                                        <input type="button" value="+" onClick="addInput();">
                                    </div>
                                @else
                                    @foreach($nutrient_factors as $nutrient_factor)
                                        <div class="form-group">
                                            <label>nutrient factor {{$loop->iteration}}</label>
                                            <input value="{{$nutrient_factor->result}}" type="text" class="form-control" name="nutrient_factors[]">
                                        </div>
                                    @endforeach
                                @endif
                            @elseif($class=="Factor")
                                <div class="form-group">
                                    <label for="parent_id">LapTest*</label>
                                    <select name="parent_id" required class="form-control" id="parent_id">
                                        @foreach(\App\Models\DropDown::where('class','LapTest')->latest()->get() as $Classification)
                                            <option @if($row->parent_id==$Classification->id) selected @endif value="{{$Classification->id}}">{{$Classification->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
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
    <script>
        function addInput(){
            var newdiv = document.createElement('div');
            newdiv.className = 'form-group';
            var new_id = $('input[name*="nutrient_factors"]').length +1;
            newdiv.innerHTML = "<label>nutrient factor "+new_id+"</label> <input type='text' class='form-control' name='nutrient_factors[]'>" +
                " <input type='button' value='-' onClick='removeInput(this);'>";
            document.getElementById('formulario').appendChild(newdiv);
        }

        function removeInput(btn){
            btn.parentNode.remove();
        }

    </script>
@endsection
