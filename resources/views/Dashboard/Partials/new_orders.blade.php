<div class="row">
    <div class="col-xl-12">
        <div class="card-box">
{{--            <div class="dropdown float-right">--}}
{{--                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">--}}
{{--                    <i class="mdi mdi-dots-vertical"></i>--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu dropdown-menu-right">--}}
{{--                    <a href="{{route('admin.contact.index')}}" class="dropdown-item">المزيد</a>--}}
{{--                </div>--}}
{{--            </div>--}}
            <h4 class="header-title mb-3">رسائل تواصل الأعضاء</h4>
            <div class="inbox-widget">
                @foreach(\App\Models\Contact::all() as $contact)
                    <div class="inbox-item">
                        <a  style='cursor: pointer' data-toggle='modal' data-target='#sendMessageModal-{{$contact->id}}'>
                            <div class="inbox-item-img"><img style="height: 100%;width: 100%" src="{{$contact->user->image}}" class="rounded-circle" alt="{{$contact->user->name}}"></div>
                            <h5 class="inbox-item-author mt-0 mb-1">{{$contact->user->name}}</h5>
                            <p class="inbox-item-text">{{$contact->message}}</p>
                            <p class="inbox-item-date">{{\Carbon\Carbon::parse($contact->created_at)->diffForHumans()}}</p>
                        </a>
                    </div>
                    <div class="modal fade" id="sendMessageModal-{{$contact->id}}" tabindex="-1" role="dialog" aria-labelledby="sendMessageModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h5 class="modal-title w-100 font-weight-bold">قم بإرسالة خاصة الى هذا المستخدم</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-allbody mx-3">
                                    <form enctype="multipart/form-data" method="POST" action="{{ route('admin.notification.send-single-notification',$contact->id) }}">
                                        @csrf
                                        <div class="md-form mb-5">
                                            <textarea required class="form-control" name="note"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    إرسال
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </div><!-- end col -->

{{--    <div class="col-xl-8">--}}
{{--        <div class="card-box">--}}
{{--            <h4 class="header-title mt-0 mb-3">آخر الطلبات</h4>--}}
{{--            <div class="table-responsive">--}}
{{--                <table class="table table-hover mb-0">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>#</th>--}}
{{--                        <th>المستخدم</th>--}}
{{--                        <th>تاريخ الطلب</th>--}}
{{--                        <th>تاريخ الإستلام</th>--}}
{{--                        <th>حالة الطلب</th>--}}
{{--                        <th>مزود الخدمة</th>--}}
{{--                        <th>المزيد</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach(\App\Models\Order::latest()->take(7)->get() as $last_order)--}}
{{--                    <tr>--}}
{{--                        <td>{{$last_order->id}}</td>--}}
{{--                        <td>{{$last_order->user->name}}</td>--}}
{{--                        <td>{{\Carbon\Carbon::parse($last_order->created_at)->format('Y-M-d')}}</td>--}}
{{--                        <td>{{\Carbon\Carbon::parse($last_order->deliver_at)->format('Y-M-d')}}</td>--}}
{{--                        <td><span class="badge @if($last_order->status=='rejected') badge-danger @elseif($last_order->status=='completed') badge-success @elseif($last_order->status=='new') badge-primary @elseif($last_order->status=='in_progress') badge-purple @else badge-warning @endif">{{$last_order->getStatusArabic()}}</span></td>--}}
{{--                        <td>{{$last_order->provider->name}}</td>--}}
{{--                        <td>--}}
{{--                            <a href="{{route('admin.order.show',$last_order->id)}}">--}}
{{--                                 <i class="fa fa-eye mr-1"></i> <span>عرض</span>--}}
{{--                            </a>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div><!-- end col -->--}}

</div>
