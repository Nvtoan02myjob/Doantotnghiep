const header_user_icon = document.querySelector(".header_user_icon");
const header_information_user = document.querySelector(
    ".header_information_user"
);
header_user_icon.addEventListener("click", () => {
    header_information_user.classList.toggle("display");
});
header_information_user.addEventListener("click", (event) => {
    event.stopPropagation();
});
document.addEventListener("click", (event) => {
    if (
        !header_information_user.contains(event.target) &&
        !header_user_icon.contains(event.target)
    ) {
        header_information_user.classList.remove("display");
    }
});
