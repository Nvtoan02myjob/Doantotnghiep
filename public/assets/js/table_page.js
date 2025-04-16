const table_items = document.querySelectorAll(".table_item");

table_items.forEach((table_item) => {
    let status = Number(table_item.getAttribute("data-table"));
    if (status === 1) {
        table_item.classList.add("disabled-background");
    }
});

//
const table_seeMores = document.querySelectorAll(".table_seeMore");
const table_datas = document.querySelectorAll(".table_data");
for (let i = 0; i < table_datas.length; i++) {
    for (let j = 0; j < table_seeMores.length; j++) {
        if (i == j) {
            table_datas[i].addEventListener("click", () => {
                table_seeMores[j].classList.toggle("display");
            });
        }
    }
}
table_seeMores.forEach((table_seeMore) => {
    table_seeMore.addEventListener("click", (event) => {
        event.stopPropagation();
    });
});

document.addEventListener("click", (event) => {
    table_seeMores.forEach((seeMore, i) => {
        if (
            !seeMore.contains(event.target) &&
            !table_datas[i].contains(event.target)
        ) {
            seeMore.classList.remove("display");
        }
    });
});

const notification_table_exist = document.getElementById(
    "notification_table_exist"
);
// console.log(notification_table_exist);
if (notification_table_exist) {
    alert(notification_table_exist.value);
}
