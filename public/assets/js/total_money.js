const total_element = document.querySelector(".total_price_cart");
const total_element_hidden = document.querySelector(".total_cart_hidden");
const checkAll = document.getElementById("checkAll");
const checkboxList = document.querySelectorAll('input[name="checkbox_data[]"]');
console.log(checkAll);

checkboxList.forEach((cb) => {
    cb.addEventListener("change", () => {
        let total = 0;
        checkboxList.forEach((cb2) => {
            if (cb2.checked) {
                total +=
                    parseInt(cb2.getAttribute("data-price")) *
                    parseInt(cb2.getAttribute("data-quantity"));
            }
        });

        total_element.textContent = total.toLocaleString() + " ";
        total_element_hidden.value = total;
    });
});
checkAll.addEventListener("change", () => {
    let total = 0;
    if (checkAll.checked) {
        checkboxList.forEach((cb3) => {
            total +=
                parseInt(cb3.getAttribute("data-price")) *
                parseInt(cb3.getAttribute("data-quantity"));

            total_element.textContent = total.toLocaleString() + " ";
            total_element_hidden.value = total;
        });
    }
});
