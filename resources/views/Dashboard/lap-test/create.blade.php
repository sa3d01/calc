@extends('Dashboard.layouts.master')
@section('title', 'lap test')
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
                        <form method="POST" id="formulario" action="{{route('admin.LapTest.store')}}" enctype="multipart/form-data" data-parsley-validate novalidate>
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="factor_id">Factor*</label>
                                <select name="factor_id" required class="form-control" id="factor_id">
                                    @foreach(\App\Models\DropDown::where('class','Factor')->latest()->get() as $Classification)
                                        <option value="{{$Classification->id}}">{{$Classification->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="result">result*</label>
                                <input type="text" name="result" required class="form-control" id="result">
                            </div>
                            <div class="form-group">
                                <label for="stress_factor_from">up</label>
                                <input type="text" name="up" required class="form-control" id="up">
                            </div>
                            <div class="form-group">
                                <label for="down">down</label>
                                <input type="text" name="down" required class="form-control" id="down">
                            </div>

                            <div class="form-group text-right mb-0">
                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                    تأكيد
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
    <!-- Validation js (Parsleyjs) -->
    <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>
    <!-- validation init -->
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
@endsection
