function fetchSearchResults(query) {
    fetch('/search?q=' + encodeURIComponent(query))
        .then(response => response.json())
        .then(data => {
            console.log(data); // Kiểm tra dữ liệu trả về từ API
            let resultsList = document.getElementById('search-results');
            resultsList.innerHTML = ''; // Xóa kết quả cũ

            if (data.length > 0) {
                // Hiển thị kết quả
                data.forEach(item => {
                    let li = document.createElement('li');
                    li.textContent = item.name; // Hiển thị tên món ăn
                    resultsList.appendChild(li);
                });
                resultsList.style.display = 'block'; // Hiển thị kết quả
            } else {
                resultsList.innerHTML = '<li>Không tìm thấy kết quả</li>'; // Nếu không có kết quả
                resultsList.style.display = 'block'; // Hiển thị kết quả
            }
        })
        .catch(error => {
            console.error('Lỗi khi tìm kiếm:', error);
        });
}
