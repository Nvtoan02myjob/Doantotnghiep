const checkboxAll = document.getElementById("checkAll");
const checkboxs = document.querySelectorAll("input[name='checkbox_data[]']");

checkboxAll.addEventListener("change", () => {
    var checkbox_status = checkboxAll.checked;
    checkboxs.forEach((element) => {
        element.checked = checkbox_status;
    });
});

checkboxs.forEach((element) => {
    element.addEventListener("change", () => {
        var isCheckboxs =
            checkboxs.length ===
            document.querySelectorAll("input[name='checkbox_data[]']:checked")
                .length;
        checkboxAll.checked = isCheckboxs;
    });
});
