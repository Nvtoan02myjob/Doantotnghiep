@extends('Layout')
@section('noidung')
    <div class="container mt-5 p-4 bg-white shadow rounded">
        <h2 class="text-center text-color-main">Liên Hệ Với Chúng Tôi</h2>
        <p class="text-center">Chúng tôi rất mong nhận được phản hồi từ bạn! Cho dù bạn có thắc mắc về dịch vụ của chúng tôi, cần hỗ trợ về cách đặt món hay muốn chia sẻ phản hồi, nhóm của chúng tôi luôn sẵn sàng trợ giúp.</p>

        <div class="line">GỬI THÔNG TIN </div>

        <div class="row">
            <div class="col-md-6">
            <form action="" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Tên của bạn" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email của bạn" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="subject" placeholder="Tiêu đề" required>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="content" rows="4" placeholder="Nội dung" required></textarea>
                </div>
                <button type="submit" class="btn btn-main w-100">Gửi</button>
            </form>

        </div>

        <div class="col-md-6 text-center">
            <img src="../assets/img/logo.png" alt="Logo" class="mb-3" style="max-width: 150px;">
            <p><i class="bi bi-telephone"></i> Đường dây nóng: 0777-53-2928</p>
            <p><i class="bi bi-globe"></i> Trang web: <a href="https://dreamstealers.com" class="text-decoration-none text-primary">dreamstealers.com</a></p>
            <p><i class="bi bi-envelope"></i> Email: dreamstealers@gmailgmail.com</p>
            <p><i class="bi bi-geo-alt"></i> Địa chỉ: Đường 605, Hòa Tiến</p>
        </div>
    </div>

    <div class="line">ĐỊA CHỈ</div>

        <div class="mt-4 text-center">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3727.179697920444!2d108.17806219228882!3d15.94076849653172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142048a8f436921%3A0xd38bf340e4ea73ac!2zxJBUNjA1LCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1740576384048!5m2!1sen!2s"
                    width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    </br>
@endsection
