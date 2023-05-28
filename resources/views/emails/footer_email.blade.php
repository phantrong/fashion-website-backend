<div>Nếu bạn không biết gì về email này, vui lòng bỏ qua.</div>
<div>Vì đây là địa chỉ email chỉ dùng để gửi nên chúng tôi không thể trả lời trực tiếp.</div>
<div>　</div>
<div>=======================</div>
<div>Hệ thống trang web Thuê Phòng Trọ TTH</div>
<div>Email liên hệ :</div>
<div>【{{ config('services.mail_contact') }}】</div>
<div>Trang chủ :</div>
<div>
    【<a href="{{ config('services.link_service_front_user') }}">
        {{ config('services.link_service_front_user') }}
    </a>】
</div>
@if (isset($isAdmin))
    <div>Trang chủ Admin :</div>
    <div>
        【<a href="{{ config('services.link_service_front_admin') }}">
            {{ config('services.link_service_front_admin') }}
        </a>】
    </div>
@endif
<div>=======================</div>
<div>　</div>
