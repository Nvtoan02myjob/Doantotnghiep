const search_icon = document.querySelector(".header_search_icon");
const form_search = document.querySelector(".form_search");
search_icon.addEventListener("click", () => {
    form_search.classList.toggle("display");
});
document.addEventListener("click", (event) => {
    if (
        !form_search.contains(event.target) &&
        !search_icon.contains(event.target)
    ) {
        form_search.classList.remove("display");
    }
});
