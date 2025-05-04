function attachSearchListener(inputId, resultId, backdropId) {
    const input = document.getElementById(inputId);
    const resultBox = document.getElementById(resultId);
    const backdrop = document.getElementById(backdropId);

    input.addEventListener("input", function () {
        const keyword = this.value.trim();
        if (keyword.length < 2) {
            resultBox.style.display = "none";
            backdrop.style.display = "none";
            return;
        }

        fetch(`/api/search?q=${encodeURIComponent(keyword)}`)
            .then((response) => response.json())
            .then((data) => {
                resultBox.innerHTML = "";
                if (data.length === 0) {
                    resultBox.innerHTML =
                        '<li class="list-group-item text-muted">Không tìm thấy món ăn</li>';
                } else {
                    data.forEach((dish) => {
                        const li = document.createElement("li");
                        li.className = "list-group-item";
                        li.innerHTML = `
                            <a href="/detail/${
                                dish.id
                            }" class="d-flex align-items-center text-decoration-none text-dark">
                                <img src="assets/${dish.img}" alt="${
                            dish.name
                        }" class="me-2" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                <div>
                                    <div class="fw-bold">${dish.name}</div>
                                    <div class="text-muted">${Number(
                                        dish.price
                                    ).toLocaleString()} đ</div>
                                </div>
                            </a>
                        `;
                        resultBox.appendChild(li);
                    });
                }
                resultBox.style.display = "block";
                backdrop.style.display = "block";
            });
    });

    document.addEventListener("click", function (e) {
        if (!input.contains(e.target) && !resultBox.contains(e.target)) {
            resultBox.style.display = "none";
            backdrop.style.display = "none";
        }
    });
}

attachSearchListener("header_from_search", "search-results", "searchBackdrop");
