const stars = document.querySelectorAll(".item_star_feedback_i");
const quantity_star = document.getElementById("quantity_star");
console.log(quantity_star);
// console.log(stars[1]);
var count_quantity_star;
stars.forEach((star, index) => {
    star.addEventListener("click", () => {
        count_quantity_star = 0;
        stars.forEach((s) => s.classList.remove("yellow"));

        for (let i = 0; i <= index; i++) {
            stars[i].classList.add("yellow");
            count_quantity_star++;
        }
        quantity_star.value = count_quantity_star;
    });
});

const textarea_feedback = document.getElementById("textarea_feedback");
const error_content_feedback = document.querySelector(
    ".error_content_feedback"
);
const error_star = document.querySelector(".error_star");

document.getElementById("feedbackForm").addEventListener("submit", (e) => {
    var form_check = true;
    error_content_feedback.innerHTML = "";
    error_star.innerHTML = "";

    if (textarea_feedback.value.length < 10) {
        error_content_feedback.innerHTML = `<div class="alert alert-danger" role="alert">
                                            Thông tin quá ngắn
                                            </div>`;
        form_check = false;
    }
    const hasYellowStar = Array.from(stars).some((star) =>
        star.classList.contains("yellow")
    );
    if (!hasYellowStar) {
        error_star.innerHTML = `<div class="alert alert-danger" role="alert">
                                            Bạn vui lòng chọn số sao đánh giá
                                            </div>`;
        form_check = false;
    }

    if (!form_check) {
        e.preventDefault();
    }
});
