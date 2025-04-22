const search_icon = document.querySelector(".header_search_icon");
const form_search = document.querySelector(".form_search");
search_icon.addEventListener("click", (event) => {
    event.stopPropagation();
    form_search.classList.toggle("display");
});
form_search.addEventListener("click", (event) => {
    event.stopPropagation();
});

document.addEventListener("click", (event) => {
    if (
        !form_search.contains(event.target) &&
        !search_icon.contains(event.target)
    ) {
        form_search.classList.remove("display");
    }
});

//mobile
const search_icon2 = document.querySelector(".header_search_icon_2");
const form_search2 = document.querySelector(".form_search_2");
search_icon2.addEventListener("click", (event) => {
    event.stopPropagation();
    form_search2.classList.toggle("display");
});
form_search2.addEventListener("click", (event) => {
    event.stopPropagation();
});

document.addEventListener("click", (event) => {
    if (
        !form_search2.contains(event.target) &&
        !search_icon2.contains(event.target)
    ) {
        form_search2.classList.remove("display");
    }
});
