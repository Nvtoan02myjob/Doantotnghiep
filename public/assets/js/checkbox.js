const checkboxAll = document.getElementById("checkAll");
const checkboxs = document.querySelectorAll("input[name='checkbox_data[]']");
checkboxAll.addEventListener("change", () => {
    var checkbox_status = checkboxAll.checked;
    checkboxs.forEach((element) => {
        element.checked = checkbox_status;
    });
    updateDisplay();
});

checkboxs.forEach((element) => {
    element.addEventListener("change", () => {
        var isCheckboxs =
            checkboxs.length ===
            document.querySelectorAll("input[name='checkbox_data[]']:checked")
                .length;
        checkboxAll.checked = isCheckboxs;
        updateDisplay();
    });
});
//
const button_submit_order = document.getElementById("button_submit_order");
const header_total = document.querySelector(".header_total");
console.log(header_total);
function updateDisplay() {
    let check_checkbox = true;
    checkboxs.forEach((element2) => {
        if (element2.checked) {
            check_checkbox = false;
        }
    });

    if (check_checkbox) {
        header_total.classList.add("d-none");
        header_total.classList.remove("d-flex");
    } else {
        header_total.classList.remove("d-none");
        header_total.classList.add("d-flex");
    }
}
updateDisplay();
