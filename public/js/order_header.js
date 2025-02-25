const header_bell = document.querySelector(".header_bell_icon");
const header_infomation_order = document.querySelector(
    ".header_infomation_order"
);
header_bell.addEventListener("click", () => {
    header_infomation_order.classList.toggle("display");
});
document.addEventListener("click", (event) => {
    if (
        !header_infomation_order.contains(event.target) &&
        !header_bell.contains(event.target)
    ) {
        header_infomation_order.classList.remove("display");
    }
});
