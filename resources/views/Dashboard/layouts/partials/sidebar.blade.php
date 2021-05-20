<div id="sidebar-menu">
    <ul class="metismenu" id="side-menu">
        <li class="menu-title">محتويات النظام</li>
        <li>
            <a href="{{route('admin.home')}}">
                <i class="mdi mdi-view-dashboard"></i>
                <span> الرئيسية </span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.user.index')}}">
                <i class="mdi mdi-human"></i>
                <span> إدارة المستخدمين </span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.notification.index')}}">
                <i class="mdi mdi-alert-octagram"></i>
                <span> إدارة الإشعارات الجماعية </span>
            </a>
        </li>

{{--        <li>--}}
{{--            <a href="{{route('admin.contact.index')}}">--}}
{{--                <i class="mdi mdi-mailbox"></i>--}}
{{--                <span> إدارة رسائل التواصل </span>--}}
{{--            </a>--}}
{{--        </li>--}}

{{--        <li>--}}
{{--            <a href="javascript: void(0);">--}}
{{--                <i class="mdi mdi-share-variant"></i>--}}
{{--                <span> المحتوى الطبى </span>--}}
{{--                <span class="menu-arrow"></span>--}}
{{--            </a>--}}
{{--            <ul class="nav-second-level nav" aria-expanded="false">--}}
{{--                <li>--}}
{{--                    <a href="javascript: void(0);" aria-expanded="false">Formula Content Of Nutrients--}}
{{--                        <span class="menu-arrow"></span>--}}
{{--                    </a>--}}
{{--                    <ul class="nav-third-level nav" aria-expanded="false">--}}
{{--                        <li>--}}
{{--                            <a href="{{route('admin.formula_content.classifications')}}">classifications</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="{{route('admin.formula_content.formula_nutrients')}}">tube feeding formula</a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}

        <li>
            <a href="javascript: void(0);">
                <i class="mdi mdi-share-variant"></i>
                <span> إعدادات أخرى </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level nav" aria-expanded="false">
                <li>
                    <a href="javascript: void(0);" aria-expanded="false">الصفحات
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-third-level nav" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.page.edit',['type'=>'about','for'=>'all'])}}">عن التطبيق</a>
                        </li>
                        <li>
                            <a href="{{route('admin.page.edit',['type'=>'terms','for'=>'all'])}}">الشروط والأحكام للمستخدم</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="{{route('admin.contact_type.index')}}">أنواع التواصل</a>
                </li>
                <li>
                    <a href="{{route('admin.slider.index')}}">الإعلانات</a>
                </li>
                <li>
                    <a href="{{route('admin.city.index')}}">المدن</a>
                </li>
            </ul>
        </li>
    </ul>

</div>
