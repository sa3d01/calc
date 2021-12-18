@extends('Dashboard.layouts.master')
@section('title', 'Formula Nutrients')
@section('styles')
    <link href="{{asset('assets/libs/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables/select.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <a href="{{route('admin.formula_nutrient.create')}}">
                            <button type="button" class="btn btn-block btn-sm btn-success waves-effect waves-light">إضافة +</button>
                        </a>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th>tube feeding</th>
                                <th>volume</th>
                                <th>k_cal</th>
                                <th>cho_g</th>
                                <th>protein_g</th>
                                <th>fat_g</th>
                                <th>na_mg</th>
                                <th>k_mg</th>
                                <th>p_mg</th>
                                <th>fiber_g</th>
                                <th>water_mL</th>
                                <th>mosm</th>
                                <th>العمليات المتاحة</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                @if($row->tubeFeeding==null)
                                    @continue
                                @endif
                                <tr>
                                    <td>{{$row->tubeFeeding->name}}</td>
                                    <td>{{$row->volume}}</td>
                                    <td>{{$row->k_cal}}</td>
                                    <td>{{$row->cho_g}}</td>
                                    <td>{{$row->protein_g}}</td>
                                    <td>{{$row->fat_g}}</td>
                                    <td>{{$row->na_mg}}</td>
                                    <td>{{$row->k_mg}}</td>
                                    <td>{{$row->p_mg}}</td>
                                    <td>{{$row->fiber_g}}</td>
                                    <td>{{$row->water_mL}}</td>
                                    <td>{{$row->mosm}}</td>
                                    <td>
                                        <div class="button-list">
                                            <a href="{{route('admin.formula_nutrient.edit',$row->id)}}">
                                                <button class="btn btn-warning waves-effect waves-light"> <i class="fa fa-map-pin mr-1"></i> <span>تعديل</span> </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/libs/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/dataTables.select.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/vfs_fonts.js')}}"></script>
    <!-- third party js ends -->
    <!-- Datatables init -->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(document).on('click', '.ban', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "تأكيد عملية الحظر ؟",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'نعم !',
                cancelButtonText: 'ﻻ , الغى العملية!',
                closeOnConfirm: false,
                closeOnCancel: false,
                preConfirm: () => {
                    $("form[data-id='" + id + "']").submit();
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        });
        $(document).on('click', '.activate', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "تأكيد عملية التفعيل ؟",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'نعم !',
                cancelButtonText: 'ﻻ , الغى العملية!',
                closeOnConfirm: false,
                closeOnCancel: false,
                preConfirm: () => {
                    $("form[data-id='" + id + "']").submit();
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        });
    </script>
@endsection
