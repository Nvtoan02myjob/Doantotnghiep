@extends('layout')
@section('noidung')
@if(session('has_table'))
    <input type="hidden" name="" id="notification_table_exist"value="{{session('has_table')}}">
@endif

<div style="margin-top: 80px;" class="d-flex justify-content-center">
    <nav aria-label="breadcrumb" style="width: 90%;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/"><i class="bi bi-house" style="margin-right: 5px;"></i>Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Bàn</li>
      </ol>
    </nav>

</div>
<div class="d-flex justify-content-center" style="margin-top: 100px;">
    <div class="table_main">
        <h5>Danh sách bàn</h5>
        <hr style="border: 1px solid var(--color-main); margin-bottom: 0;">
        <ul class="list_table col-sm-12 d-flex">
            @foreach($tables as $table_item)
                <li class="table_box col-sm-3 d-flex justify-content-center">
                    <div class="table_item" data-table="{{ $table_item->status }}">
                        <div class="table_number">
                            <div class="table_number_show">
                                B{{ $table_item->id }}
                            </div>
                        </div>
                        <div class="table_status d-flex justify-content-center">
                            <button class="table_status_main">{{ $table_item->status == 0 ? "Bàn trống":"Bàn bận" }}</button>

                        </div>
                        <div class="table_data">
                            <p>Xem thêm <i class="bi bi-chevron-double-down"></i></p> 

                            <div class="table_seeMore">
                                <p class="table_seeMore_id">Bàn số: <span class="value_color">{{ $table_item->id }}</span></p>
                                <p class="table_seeMore_status">Trạng thái: <span class="value_color">{{ $table_item->status == 0 ? "Bàn trống":"Bàn bận" }}</span></p>
                                <p class="table_seeMore_quantiyPerson">Số lượng người: <span class="value_color">{{ $table_item->quantity_person }}</span></p>
                               
                                <a href="{{ route('add_sessionTableId', ['id'=> $table_item->id]) }}" class="table_seeMore_select">Chọn bàn</a>
                            </div>
                        </div>
                    
                    </div>
                </li>
            @endforeach
            
            
        </ul>
    </div>
</div>
@endsection