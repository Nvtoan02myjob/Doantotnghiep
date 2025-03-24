@extends('Layout')
@section('noidung')
    <div style="margin-top: 80px;" class="d-flex justify-content-center">
        <nav aria-label="breadcrumb" style="width: 90%;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="bi bi-house" style="margin-right: 5px;"></i>Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Giới thiệu</li>
        </ol>
        </nav>

    </div>
    <div class="about-banner">
        <h1>Giới thiệu</h1>
    </div>

    <div class="about-container">
        <div class="about-intro">
            <div class="about-intro-text">
                <p>"Koby Hot mang đến trải nghiệm ẩm thực mỹ cay đầy thú vị với các công thức độc quyền được chế biến từ những nguyên liệu tươi ngon nhất. Dù bạn yêu thích cay nhẹ hay cay nồng, Koby Hot sẽ làm bạn hài lòng với hương vị đặc trưng và đậm đà."</p>
            </div>
            <img src="../assets/img/about/th.jpg" alt="ảnh">
        </div>
    </div>
    <section class="vision-mission">
        <h2>Tầm Nhìn, Sứ Mệnh, Giá Trị Cốt Lõi</h2>
        <div class="vision-container">
            <div class="vision-box">
                <img src="assets/img/about/icon1.jpg" alt="Tầm Nhìn">
                <p>
                    Koby Hot hướng đến trở thành thương hiệu mì cay hàng đầu, mang đến trải nghiệm ẩm thực độc đáo,
                    đậm đà hương vị và chinh phục vị giác của mọi thực khách.
                </p>
            </div>
            <div class="vision-box">
                <img src="assets/img/about/icon2.jpg" alt="Sứ Mệnh">
                <p>
                    Cung cấp những tô mì cay thơm ngon, chất lượng với hương vị đặc trưng, đậm đà. Đảm bảo nguyên liệu tươi ngon, an toàn vệ sinh thực phẩm.
                </p>
            </div>
            <div class="vision-box">
                <img src="assets/img/about/icon3.jpg" alt="Giá Trị Cốt Lõi">
                <p>
                    Chất lượng hàng đầu – Cam kết nguyên liệu tươi sạch, đảm bảo an toàn và hương vị chuẩn chỉnh.
                    Đổi mới sáng tạo – Luôn cải tiến công thức, mang đến trải nghiệm hấp dẫn.
                </p>
            </div>
        </div>
    </section>

    <section class="why-choose-us">
        <h2>Tại sao chọn chúng tôi?</h2>
        <div class="food-banner">
            <img src="assets/img/about/foodbanner.jpg" alt="Món Ăn Phong Phú">
            <div class="overlay">
                <h3>Món Ăn Phong Phú Đa Dạng</h3>
                <p>Toekbokki - Kimbab - Cơm Trộn - Bokkum - Salad - Thịt Nướng - Gà Sốt - Canh - Lẩu - Miến/Mì - Mì Cay - Phở Mai Kéo Sợi</p>
            </div>
        </div>
    </section>

    <section class="features-section">
        <div class="feature-box">
            <div class="icon">✔</div>
            <h3>Hương Vị Độc Đáo, Đậm Đà Khó Cưỡng</h3>
            <p>
                Koby Hot mang đến những tô mì cay với hương vị đặc trưng, kết hợp hoàn hảo giữa vị cay nồng, nước dùng đậm đà và sợi mì dai ngon. Công thức chế biến riêng biệt giúp món ăn của chúng tôi khác biệt và hấp dẫn hơn.
            </p>
        </div>

        <div class="feature-box">
            <div class="icon">✔</div>
            <h3>Nguyên Liệu Tươi Ngon, An Toàn Vệ Sinh</h3>
            <p>
                Chúng tôi cam kết sử dụng nguyên liệu tươi sạch, nguồn gốc rõ ràng, đảm bảo an toàn vệ sinh thực phẩm. Từng nguyên liệu được chọn lọc kỹ càng để mang đến trải nghiệm ẩm thực tốt nhất cho khách hàng.
            </p>
        </div>

        <div class="feature-box">
            <div class="icon">✔</div>
            <h3>Nhiều Cấp Độ Cay – Thách Thức Mọi Vị Giác</h3>
            <p>
                Dù bạn là người yêu thích vị cay nhẹ hay đam mê chinh phục độ cay tối đa, Koby Hot luôn có cấp độ phù hợp cho bạn. Tùy chỉnh độ cay theo sở thích, giúp bạn có trải nghiệm tuyệt vời nhất.
            </p>
        </div>
    </section>

    <section class="team-section">
        <h2>Đội Ngũ Phát Triển</h2>
        <div class="team-grid">
            <div class="team-member">
                <img src="assets/img/about/avatar.jpg" alt="Nguyễn Văn Toàn">
                <h3>NGUYỄN VĂN TOÀN</h3>
                <p>- 22 tuổi -</p>
                <p>Là một người trẻ trong thế hệ GenZ nên tôi biết cần làm gì để những đứa con tinh thần của tôi phát triển nhất, đặc biệt là <b>KOBY HOT</b></p>
            </div>
            <div class="team-member">
                <img src="assets/img/about/avatar.jpg" alt="Nguyễn Văn Toàn">
                <h3>NGUYỄN VĂN TOÀN</h3>
                <p>- 22 tuổi -</p>
                <p>Là một người trẻ trong thế hệ GenZ nên tôi biết cần làm gì để những đứa con tinh thần của tôi phát triển nhất, đặc biệt là <b>KOBY HOT</b></p>
            </div>
            <div class="team-member">
                <img src="assets/img/about/avatar.jpg" alt="Nguyễn Văn Toàn">
                <h3>NGUYỄN VĂN TOÀN</h3>
                <p>- 22 tuổi -</p>
                <p>Là một người trẻ trong thế hệ GenZ nên tôi biết cần làm gì để những đứa con tinh thần của tôi phát triển nhất, đặc biệt là <b>KOBY HOT</b></p>
            </div>
            <div class="team-member">
                <img src="assets/img/about/avatar.jpg" alt="Nguyễn Văn Toàn">
                <h3>NGUYỄN VĂN TOÀN</h3>
                <p>- 22 tuổi -</p>
                <p>Là một người trẻ trong thế hệ GenZ nên tôi biết cần làm gì để những đứa con tinh thần của tôi phát triển nhất, đặc biệt là <b>KOBY HOT</b></p>
            </div>
            <div class="team-member">
                <img src="assets/img/about/avatar.jpg" alt="Nguyễn Văn Toàn">
                <h3>NGUYỄN VĂN TOÀN</h3>
                <p>- 22 tuổi -</p>
                <p>Là một người trẻ trong thế hệ GenZ nên tôi biết cần làm gì để những đứa con tinh thần của tôi phát triển nhất, đặc biệt là <b>KOBY HOT</b></p>
            </div>
            <div class="team-member">
                <img src="assets/img/about/avatar.jpg" alt="Nguyễn Văn Toàn">
                <h3>NGUYỄN VĂN TOÀN</h3>
                <p>- 22 tuổi -</p>
                <p>Là một người trẻ trong thế hệ GenZ nên tôi biết cần làm gì để những đứa con tinh thần của tôi phát triển nhất, đặc biệt là <b>KOBY HOT</b></p>
            </div>
        </div>
    </section>
@endsection
