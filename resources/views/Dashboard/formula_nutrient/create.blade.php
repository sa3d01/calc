@extends('Dashboard.layouts.master')
@section('title', 'Formula Nutrients')
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
                        <form method="POST" action="{{route('admin.formula_nutrient.store')}}" enctype="multipart/form-data" data-parsley-validate novalidate>
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="tube_feeding_id">tube feeding*</label>
                                <select name="tube_feeding_id" required class="form-control" id="tube_feeding_id">
                                    @foreach(\App\Models\DropDown::where('class','FormulaNutrients')->latest()->get() as $Classification)
                                        <option value="{{$Classification->id}}">{{$Classification->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="volume">volume*</label>
                                <input type="text" name="volume" required class="form-control" id="volume">
                            </div>
                            <div class="form-group">
                                <label for="k_cal">k_cal*</label>
                                <input type="text" name="k_cal" required class="form-control" id="k_cal">
                            </div>
                            <div class="form-group">
                                <label for="cho_g">cho_g*</label>
                                <input type="text" name="cho_g" required class="form-control" id="cho_g">
                            </div>
                            <div class="form-group">
                                <label for="protein_g">protein_g*</label>
                                <input type="text" name="protein_g" required class="form-control" id="protein_g">
                            </div>
                            <div class="form-group">
                                <label for="protein_g">protein_g*</label>
                                <input type="text" name="protein_g" required class="form-control" id="protein_g">
                            </div>
                            <div class="form-group">
                                <label for="fat_g">fat_g*</label>
                                <input type="text" name="fat_g" required class="form-control" id="fat_g">
                            </div>
                            <div class="form-group">
                                <label for="na_mg">na_mg*</label>
                                <input type="text" name="na_mg" required class="form-control" id="na_mg">
                            </div>
                            <div class="form-group">
                                <label for="k_mg">k_mg*</label>
                                <input type="text" name="k_mg" required class="form-control" id="k_mg">
                            </div>
                            <div class="form-group">
                                <label for="p_mg">p_mg*</label>
                                <input type="text" name="p_mg" required class="form-control" id="p_mg">
                            </div>
                            <div class="form-group">
                                <label for="fiber_g">fiber_g*</label>
                                <input type="text" name="fiber_g" required class="form-control" id="fiber_g">
                            </div>
                            <div class="form-group">
                                <label for="water_mL">water_mL*</label>
                                <input type="text" name="water_mL" required class="form-control" id="water_mL">
                            </div>
                            <div class="form-group">
                                <label for="mosm">mosm*</label>
                                <input type="text" name="mosm" required class="form-control" id="mosm">
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
