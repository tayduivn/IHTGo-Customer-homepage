@extends('layouts.customer')
@section('content')
<div class="body-wrap">
    <div class="topHeight"></div>
    <div class="container margin-auto news-body">
        <div class="row center-text">
            <h2 style="margin: -1.5%;"><span style="font-size: 24px; text-transform:uppercase; color:#e50303;"><strong>Đơn hàng</strong></span></h2>
        </div>
        <div class="h50px"></div>
        <div class=" form-search-order ">
            <div class="form-inline ">
                <div class="form-group">
                    <label>Ngày bắt đầu: </label>
                    <input type="date" /></li>
                </div>
                <div class="form-group ">
                    <label>Ngày kết thúc: </label>
                    <input type="date" /></li>
                </div>
                <div class="form-group" style="margin-left:1em">
                    <button type="button" class="btn btn-danger">Tìm</button>
                </div>
                <div class="form-group" style="float: right;"> <label class="">Tổng tiền:<span id='total-price'> {{ number_format($sum_order)}} VNĐ</span> </label></div>
            </div>

        </div>
    </div>
    <div class="h50px"></div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <ul class="nav nav-pills tab-order">
                <li class="active"><a data-toggle="pill" href="#home">Tất cả ({{count($order)}})</a></li>
                <li><a data-toggle="pill" onclick="totalPrice(1);"  href="#menu1">Chờ ({{count($order_watting)}})</a></li>
                <li><a data-toggle="pill" onclick="totalPrice(2);" href="#menu2">Chưa giao ({{count($order_no_delivery)}})</a></li>
                <li><a data-toggle="pill" onclick="totalPrice(3);" href="#menu3">Đang giao ({{count($order_beging_delivery)}})</a></li>
                <li><a data-toggle="pill" onclick="totalPrice(4);" href="#menu4">Đã hoàn thành ({{count($order_done_delivery)}})</a></li>
                <li><a data-toggle="pill" onclick="totalPrice(5);" href="#menu5">Khách hủy ({{count($order_customer_cancel)}})</a></li>
                <li><a data-toggle="pill" onclick="totalPrice(6);" href="#menu6">IHTGo hủy ({{count($order_iht_cancel)}})</a></li>
                <li><a data-toggle="pill" onclick="totalPrice(7);" href="#menu7">Không thành công ({{count($order_fail)}})</a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên đơn hàng</th>
                                <th>Loại xe</th>
                                <th>Trạng thái</th>
                                <th>Thanh toán</th>
                                <th>Địa chỉ gửi</th>
                                <th>Địa chỉ nhận</th>
                                <th>Ngày tạo</th>
                                <th>Thanh toán</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $o)
                            <tr>
                                <td><a href="{!! url('chi-tiet-don-hang'); !!}"> #{{$o->code}}</a></td>
                                <td>{{$o->name}} </td>
                                <td>{{$o->car_type}}</td>
                                <!-- Trạng thái đơn hàng -->
                                @if($o->status==1)
                                <td>Chờ </td>
                                @elseif($o->status==2)
                                <td>Chưa giao </td>
                                @elseif($o->status==3)
                                <td>Đang giao </td>
                                @elseif($o->status==4)
                                <td>Đã hoàn thành</td>
                                @elseif($o->status==5)
                                <td>Khách hủy </td>
                                @elseif($o->status==6)
                                <td>IHTGo hủy </td>
                                @elseif($o->status==7)
                                <td>Không thành công </td>
                                @endif

                                <!-- Trạng thái đơn hang -->
                                @if($o->is_payment==0)
                                <td>Chưa thanh toán </td>
                                @elseif($o->is_payment==1)
                                <td>Đã thanh toán </td>
                                @elseif($o->is_payment==2)
                                <td>Ghi nợ </td>
                                @endif

                                <td>{{$o->sender_district_name}},{{$o->sender_province_name}} </td>
                                <td>{{$o->receive_district_name}},{{$o->receive_province_name}}</td>
                                <td>{{$o->created_at}}</td>
                                <!-- Phương thức thanh toán -->
                                @if($o->payment_type=='1')
                                <td>Tiền mặt </td>
                                @elseif($o->payment_type=='2')
                                <td>Theo tháng </td>
                                @else
                                <td>Phương thức khác </td>
                                @endif

                                <td>{{number_format($o->total_price).' VNĐ'}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="menu1" class="tab-pane fade in">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên đơn hàng</th>
                                <th>Loại xe</th>
                                <th>Trạng thái</th>
                                <th>Thanh toán</th>
                                <th>Địa chỉ gửi</th>
                                <th>Địa chỉ nhận</th>
                                <th>Ngày tạo</th>
                                <th>Thanh toán</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order_watting as $o)
                            <tr>
                                <td><a href="{!! url('chi-tiet-don-hang'); !!}"> #{{$o->code}}</a></td>
                                <td>{{$o->name}}</td>
                                <td>{{$o->car_type}}</td>
                                <!-- Trạng thái đơn hàng -->
                                @if($o->status==1)
                                <td>Chờ </td>
                                @elseif($o->status==2)
                                <td>Chưa giao </td>
                                @elseif($o->status==3)
                                <td>Đang giao </td>
                                @elseif($o->status==4)
                                <td>Đã hoàn thành</td>
                                @elseif($o->status==5)
                                <td>Khách hủy </td>
                                @elseif($o->status==6)
                                <td>IHTGo hủy </td>
                                @elseif($o->status==7)
                                <td>Không thành công </td>
                                @endif

                                <!-- Trạng thái đơn hang -->
                                @if($o->is_payment==0)
                                <td>Chưa thanh toán </td>
                                @elseif($o->is_payment==1)
                                <td>Đã thanh toán </td>
                                @elseif($o->is_payment==2)
                                <td>Ghi nợ </td>
                                @endif

                                <td>{{$o->sender_district_name}},{{$o->sender_province_name}} </td>
                                <td>{{$o->receive_district_name}},{{$o->receive_province_name}}</td>
                                <td>{{$o->created_at}}</td>
                                <!-- Phương thức thanh toán -->
                                @if($o->payment_type=='1')
                                <td>Tiền mặt </td>
                                @elseif($o->payment_type=='2')
                                <td>Theo tháng </td>
                                @else
                                <td>Phương thức khác </td>
                                @endif

                                <td>{{number_format($o->total_price).' VNĐ'}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="menu2" class="tab-pane fade in ">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên đơn hàng</th>
                                <th>Loại xe</th>
                                <th>Trạng thái</th>
                                <th>Thanh toán</th>
                                <th>Địa chỉ gửi</th>
                                <th>Địa chỉ nhận</th>
                                <th>Ngày tạo</th>
                                <th>Thanh toán</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order_no_delivery as $o)
                            <tr>
                                <td><a href="{!! url('chi-tiet-don-hang'); !!}"> #{{$o->code}}</a></td>
                                <td>{{$o->name}}</td>
                                <td>{{$o->car_type}}</td>
                                <!-- Trạng thái đơn hàng -->
                                @if($o->status==1)
                                <td>Chờ </td>
                                @elseif($o->status==2)
                                <td>Chưa giao </td>
                                @elseif($o->status==3)
                                <td>Đang giao </td>
                                @elseif($o->status==4)
                                <td>Đã hoàn thành</td>
                                @elseif($o->status==5)
                                <td>Khách hủy </td>
                                @elseif($o->status==6)
                                <td>IHTGo hủy </td>
                                @elseif($o->status==7)
                                <td>Không thành công </td>
                                @endif

                                <!-- Trạng thái đơn hang -->
                                @if($o->is_payment==0)
                                <td>Chưa thanh toán </td>
                                @elseif($o->is_payment==1)
                                <td>Đã thanh toán </td>
                                @elseif($o->is_payment==2)
                                <td>Ghi nợ </td>
                                @endif

                                <td>{{$o->sender_district_name}},{{$o->sender_province_name}} </td>
                                <td>{{$o->receive_district_name}},{{$o->receive_province_name}}</td>
                                <td>{{$o->created_at}}</td>
                                <!-- Phương thức thanh toán -->
                                @if($o->payment_type=='1')
                                <td>Tiền mặt </td>
                                @elseif($o->payment_type=='2')
                                <td>Theo tháng </td>
                                @else
                                <td>Phương thức khác </td>
                                @endif

                                <td>{{number_format($o->total_price).' VNĐ'}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="menu3" class="tab-pane fade in ">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên đơn hàng</th>
                                <th>Loại xe</th>
                                <th>Trạng thái</th>
                                <th>Thanh toán</th>
                                <th>Địa chỉ gửi</th>
                                <th>Địa chỉ nhận</th>
                                <th>Ngày tạo</th>
                                <th>Thanh toán</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order_beging_delivery as $o)
                            <tr>
                                <td><a href="{!! url('chi-tiet-don-hang'); !!}"> #{{$o->code}}</a></td>
                                <td>{{$o->name}}</td>
                                <td>{{$o->car_type}}</td>
                                <!-- Trạng thái đơn hàng -->
                                @if($o->status==1)
                                <td>Chờ </td>
                                @elseif($o->status==2)
                                <td>Chưa giao </td>
                                @elseif($o->status==3)
                                <td>Đang giao </td>
                                @elseif($o->status==4)
                                <td>Đã hoàn thành</td>
                                @elseif($o->status==5)
                                <td>Khách hủy </td>
                                @elseif($o->status==6)
                                <td>IHTGo hủy </td>
                                @elseif($o->status==7)
                                <td>Không thành công </td>
                                @endif

                                <!-- Trạng thái đơn hang -->
                                @if($o->is_payment==0)
                                <td>Chưa thanh toán </td>
                                @elseif($o->is_payment==1)
                                <td>Đã thanh toán </td>
                                @elseif($o->is_payment==2)
                                <td>Ghi nợ </td>
                                @endif

                                <td>{{$o->sender_district_name}},{{$o->sender_province_name}} </td>
                                <td>{{$o->receive_district_name}},{{$o->receive_province_name}}</td>
                                <td>{{$o->created_at}}</td>
                                <!-- Phương thức thanh toán -->
                                @if($o->payment_type=='1')
                                <td>Tiền mặt </td>
                                @elseif($o->payment_type=='2')
                                <td>Theo tháng </td>
                                @else
                                <td>Phương thức khác </td>
                                @endif

                                <td>{{number_format($o->total_price).' VNĐ'}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="menu4" class="tab-pane fade in ">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên đơn hàng</th>
                                <th>Loại xe</th>
                                <th>Trạng thái</th>
                                <th>Thanh toán</th>
                                <th>Địa chỉ gửi</th>
                                <th>Địa chỉ nhận</th>
                                <th>Ngày tạo</th>
                                <th>Thanh toán</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order_done_delivery as $o)
                            <tr>
                                <td><a href="{!! url('chi-tiet-don-hang'); !!}"> #{{$o->code}}</a></td>
                                <td>{{$o->name}}</td>
                                <td>{{$o->car_type}}</td>
                                <!-- Trạng thái đơn hàng -->
                                @if($o->status==1)
                                <td>Chờ </td>
                                @elseif($o->status==2)
                                <td>Chưa giao </td>
                                @elseif($o->status==3)
                                <td>Đang giao </td>
                                @elseif($o->status==4)
                                <td>Đã hoàn thành</td>
                                @elseif($o->status==5)
                                <td>Khách hủy </td>
                                @elseif($o->status==6)
                                <td>IHTGo hủy </td>
                                @elseif($o->status==7)
                                <td>Không thành công </td>
                                @endif

                                <!-- Trạng thái đơn hang -->
                                @if($o->is_payment==0)
                                <td>Chưa thanh toán </td>
                                @elseif($o->is_payment==1)
                                <td>Đã thanh toán </td>
                                @elseif($o->is_payment==2)
                                <td>Ghi nợ </td>
                                @endif

                                <td>{{$o->sender_district_name}},{{$o->sender_province_name}} </td>
                                <td>{{$o->receive_district_name}},{{$o->receive_province_name}}</td>
                                <td>{{$o->created_at}}</td>
                                <!-- Phương thức thanh toán -->
                                @if($o->payment_type=='1')
                                <td>Tiền mặt </td>
                                @elseif($o->payment_type=='2')
                                <td>Theo tháng </td>
                                @else
                                <td>Phương thức khác </td>
                                @endif

                                <td>{{number_format($o->total_price).' VNĐ'}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="menu5" class="tab-pane fade in ">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên đơn hàng</th>
                                <th>Loại xe</th>
                                <th>Trạng thái</th>
                                <th>Thanh toán</th>
                                <th>Địa chỉ gửi</th>
                                <th>Địa chỉ nhận</th>
                                <th>Ngày tạo</th>
                                <th>Thanh toán</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order_customer_cancel as $o)
                            <tr>
                                <td><a href="{!! url('chi-tiet-don-hang'); !!}"> #{{$o->code}}</a></td>
                                <td>{{$o->name}}</td>
                                <td>{{$o->car_type}}</td>
                                <!-- Trạng thái đơn hàng -->
                                @if($o->status==1)
                                <td>Chờ </td>
                                @elseif($o->status==2)
                                <td>Chưa giao </td>
                                @elseif($o->status==3)
                                <td>Đang giao </td>
                                @elseif($o->status==4)
                                <td>Đã hoàn thành</td>
                                @elseif($o->status==5)
                                <td>Khách hủy </td>
                                @elseif($o->status==6)
                                <td>IHTGo hủy </td>
                                @elseif($o->status==7)
                                <td>Không thành công </td>
                                @endif

                                <!-- Trạng thái đơn hang -->
                                @if($o->is_payment==0)
                                <td>Chưa thanh toán </td>
                                @elseif($o->is_payment==1)
                                <td>Đã thanh toán </td>
                                @elseif($o->is_payment==2)
                                <td>Ghi nợ </td>
                                @endif

                                <td>{{$o->sender_district_name}},{{$o->sender_province_name}} </td>
                                <td>{{$o->receive_district_name}},{{$o->receive_province_name}}</td>
                                <td>{{$o->created_at}}</td>
                                <!-- Phương thức thanh toán -->
                                @if($o->payment_type=='1')
                                <td>Tiền mặt </td>
                                @elseif($o->payment_type=='2')
                                <td>Theo tháng </td>
                                @else
                                <td>Phương thức khác </td>
                                @endif

                                <td>{{number_format($o->total_price).' VNĐ'}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="menu6" class="tab-pane fade in ">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên đơn hàng</th>
                                <th>Loại xe</th>
                                <th>Trạng thái</th>
                                <th>Thanh toán</th>
                                <th>Địa chỉ gửi</th>
                                <th>Địa chỉ nhận</th>
                                <th>Ngày tạo</th>
                                <th>Thanh toán</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order_iht_cancel as $o)
                            <tr>
                                <td><a href="{!! url('chi-tiet-don-hang'); !!}"> #{{$o->code}}</a></td>
                                <td>{{$o->name}}</td>
                                <td>{{$o->car_type}}</td>
                                <!-- Trạng thái đơn hàng -->
                                @if($o->status==1)
                                <td>Chờ </td>
                                @elseif($o->status==2)
                                <td>Chưa giao </td>
                                @elseif($o->status==3)
                                <td>Đang giao </td>
                                @elseif($o->status==4)
                                <td>Đã hoàn thành</td>
                                @elseif($o->status==5)
                                <td>Khách hủy </td>
                                @elseif($o->status==6)
                                <td>IHTGo hủy </td>
                                @elseif($o->status==7)
                                <td>Không thành công </td>
                                @endif

                                <!-- Trạng thái đơn hang -->
                                @if($o->is_payment==0)
                                <td>Chưa thanh toán </td>
                                @elseif($o->is_payment==1)
                                <td>Đã thanh toán </td>
                                @elseif($o->is_payment==2)
                                <td>Ghi nợ </td>
                                @endif

                                <td>{{$o->sender_district_name}},{{$o->sender_province_name}} </td>
                                <td>{{$o->receive_district_name}},{{$o->receive_province_name}}</td>
                                <td>{{$o->created_at}}</td>
                                <!-- Phương thức thanh toán -->
                                @if($o->payment_type=='1')
                                <td>Tiền mặt </td>
                                @elseif($o->payment_type=='2')
                                <td>Theo tháng </td>
                                @else
                                <td>Phương thức khác </td>
                                @endif

                                <td>{{number_format($o->total_price).' VNĐ'}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="menu7" class="tab-pane fade in ">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên đơn hàng</th>
                                <th>Loại xe</th>
                                <th>Trạng thái</th>
                                <th>Thanh toán</th>
                                <th>Địa chỉ gửi</th>
                                <th>Địa chỉ nhận</th>
                                <th>Ngày tạo</th>
                                <th>Thanh toán</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order_fail as $o)
                            <tr>
                                <td><a href="{!! url('chi-tiet-don-hang'); !!}"> #{{$o->code}}</a></td>
                                <td>{{$o->name}}</td>
                                <td>{{$o->car_type}}</td>
                                <!-- Trạng thái đơn hàng -->
                                @if($o->status==1)
                                <td>Chờ </td>
                                @elseif($o->status==2)
                                <td>Chưa giao </td>
                                @elseif($o->status==3)
                                <td>Đang giao </td>
                                @elseif($o->status==4)
                                <td>Đã hoàn thành</td>
                                @elseif($o->status==5)
                                <td>Khách hủy </td>
                                @elseif($o->status==6)
                                <td>IHTGo hủy </td>
                                @elseif($o->status==7)
                                <td>Không thành công </td>
                                @endif

                                <!-- Trạng thái đơn hang -->
                                @if($o->is_payment==0)
                                <td>Chưa thanh toán </td>
                                @elseif($o->is_payment==1)
                                <td>Đã thanh toán </td>
                                @elseif($o->is_payment==2)
                                <td>Ghi nợ </td>
                                @endif

                                <td>{{$o->sender_district_name}},{{$o->sender_province_name}} </td>
                                <td>{{$o->receive_district_name}},{{$o->receive_province_name}}</td>
                                <td>{{$o->created_at}}</td>
                                <!-- Phương thức thanh toán -->
                                @if($o->payment_type=='1')
                                <td>Tiền mặt </td>
                                @elseif($o->payment_type=='2')
                                <td>Theo tháng </td>
                                @else
                                <td>Phương thức khác </td>
                                @endif

                                <td>{{number_format($o->total_price).' VNĐ'}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
<script>
    function totalPrice(id) {
       console.log(id);
       $('#total-price').empty();
       $('#total-price').html(id);
    }
</script>
@endsection