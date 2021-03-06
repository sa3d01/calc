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


        <li>
            <a href="javascript: void(0);">
                <i class="mdi mdi-share-variant"></i>
                <span> المحتوى الطبى </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level nav" aria-expanded="false">
                <li>
                    <a href="javascript: void(0);" aria-expanded="false">Nutrients
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-third-level nav" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.formula_content.classifications')}}">classifications</a>
                        </li>
                        <li>
                            <a href="{{route('admin.formula_content.formula_nutrients')}}">tube feeding formula</a>
                        </li>
                        <li>
                            <a href="{{route('admin.formula_nutrient.index')}}">formula nutrients</a>
                        </li>
                        <li>
                            <a href="{{route('admin.Nutrient.index')}}">nutrients</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" aria-expanded="false">Clinical Status
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-third-level nav" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.ClinicalStatus.index')}}">Clinical Status</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" aria-expanded="false">LapTest
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-third-level nav" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.Factor.index')}}">Factors</a>
                        </li>
                        <li>
                            <a href="{{route('admin.LapTest.index')}}">LapTest</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" aria-expanded="false"> Drugs
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-third-level nav" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.Drug.index')}}">drugs</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" aria-expanded="false"> RDA
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-third-level nav" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.RdaCategory.index')}}">RDA Categories</a>
                        </li>
                        <li>
                            <a href="{{route('admin.AgeCategory.index')}}">Age Categories</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

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
                        <li>
                            <a href="{{route('admin.social.edit')}}">روابط مواقع التواصل</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="{{route('admin.contact_type.index')}}">أنواع التواصل</a>
                </li>
                <li>
                    <a href="{{route('admin.contact.index')}}">رسائل التواصل </a>
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
