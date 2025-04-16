document.querySelectorAll(".toggle-details").forEach((button) => {
    button.addEventListener("click", function () {
        let detailsRow = this.closest("tr").nextElementSibling;
        if (
            detailsRow.style.display === "none" ||
            detailsRow.style.display === ""
        ) {
            detailsRow.style.display = "table-row";
            this.textContent = "Thu gọn";
        } else {
            detailsRow.style.display = "none";
            this.textContent = "Xem chi tiết";
        }
    });
});
