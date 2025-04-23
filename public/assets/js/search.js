document.getElementById('header_from_search').addEventListener('keyup', function() {
    let query = this.value;

    // Nếu chuỗi tìm kiếm có ít nhất 3 ký tự
    if (query.length > 2) {
        fetch('/search?query=' + query) // Gửi yêu cầu tìm kiếm đến route /search
            .then(response => response.json())
            .then(data => {
                let resultsContainer = document.getElementById('search-results');
                resultsContainer.innerHTML = ''; // Xóa kết quả trước đó

                if (data.length > 0) {
                    resultsContainer.style.display = 'block'; // Hiện danh sách kết quả

                    data.forEach(item => {
                        let li = document.createElement('li');
                        // Tạo nội dung hiển thị bao gồm tên, ảnh và giá
                        li.innerHTML = `
                            <div style="display: flex; align-items: center; padding: 8px;">
                                <img src="${item.img}" alt="${item.name}" style="width: 50px; height: 50px; margin-right: 10px;">
                                <div>
                                    <strong>${item.name}</strong><br>
                                    <span>${item.price} VND</span>
                                </div>
                            </div>
                        `;
                        resultsContainer.appendChild(li);

                        // Thêm sự kiện click vào kết quả tìm kiếm
                        li.addEventListener('click', function() {
                            window.location.href = '/detail/' + item.id; // Điều hướng đến trang chi tiết của món ăn
                        });
                    });
                } else {
                    resultsContainer.style.display = 'none'; // Ẩn nếu không có kết quả
                }
            })
            .catch(error => console.error('Error:', error));
    } else {
        document.getElementById('search-results').style.display = 'none'; // Ẩn khi không có ký tự tìm kiếm
    }
});
