<div class="menubar-wrapper menubar-theme">
    <nav id="sidebar">
        <ul class="list-unstyled menu-categories" id="accordionExample">

            <li class="menu main-single-menu">
                <a href="{{ route('admin/Dashboard') }}" aria-expanded="true" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-home"></i>
                        <span>หน้าหลัก</span>
                    </div>
                </a>
            </li>


            <li class="menu main-single-menu">
                <a href="#a1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-user-alt"></i>
                        <span> ระบบสมาชิก </span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="a1" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin/MemberRegister') }}"> รายการสมาชิก </a>
                    </li>


                </ul>
            </li>


            <li class="menu main-single-menu">
                <a href="#a7" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-newspaper"></i>
                        <span> ออกบิล </span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="a4" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin/bill/create') }}"> สร้างบิล </a>
                    </li>
                    <li>
                        <a href="{{ route('admin/bill/list') }}"> รายการบิล </a>
                    </li>

                </ul>
            </li>
            <li class="menu main-single-menu">
                <a href="#a8" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-user-cog"></i>
                        <span> การตั้งค่าระบบทั่วไป </span>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="a6" data-parent="#accordionExample">


                    <li>
                        <a href="{{ route('admin/AdminData') }}"> กำหนดสิทธิ์ผู้ใช้งาน </a>
                    </li>

                    {{-- <li>
                        <a href="#"> เปลี่ยนแปลงรหัสผ่าน </a>
                    </li> --}}
                </ul>
            </li>
        </ul>
    </nav>
</div>
