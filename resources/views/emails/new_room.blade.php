<div>Xin chào bạn,</div>
<div>　</div>
<div>Đây là thư gửi từ hệ thống Thuê Phòng Trọ TTH</div>
<div>Bạn đã hoặc đang sử dụng hệ thống của chúng tôi. Hiện tại có trọ/chung cư mini mới có thể bạn sẽ quan tâm.</div>
<div>　</div>
<div>Nội dung trọ mới: </div>
<div>Tiêu đề: {{ $room->title }}</div>
<div>Loại: {{ $room->roomType->name }}</div>
<div>Giá: {{ $room->is_negotiate ? 'Giá thương lượng' : number_format($room->cost) . ',000 VNĐ' }}</div>
<div>Diện tích: {{ $room->acreage . 'm2' }}</div>
<div>Địa chỉ:
    {{ $room->province->name . ', ' . $room->district->name . ', ' . $room->ward->name . ', ' . $room->address_detail ?? '' }}
</div>
<div>　</div>
<div>＜Liên kết chi tiết＞</div>
<div><a href="{{ config('services.link_service_front_user') . '/room/detail/' . $room->id }}">Xem tại đây</a></div>
<div>　</div>
@include('emails.footer_email')
