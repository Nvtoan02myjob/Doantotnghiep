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
let my_bank = {
    BANK_ID: "Vietcombank",
    ACCOUNT_NO: "1019653251",
};
const order_price = document.getElementById("order_price");
const order_content = document.getElementById("order_content");
const button_datas = document.querySelectorAll(".button_data");
const td_data = document.querySelector(".open_td_qr_payment");
const order_img_qr = document.querySelector(".order_img_qr");

button_datas.forEach((item) => {
    item.addEventListener("click", (event) => {
        let price = item.getAttribute("data-price");
        let content = item.getAttribute("data-content");
        let data_order_item = item.getAttribute("data-order-item");
        let data_list_detail = item.getAttribute("data-list-detail");
        let QR = `https://img.vietqr.io/image/${my_bank.BANK_ID}-${my_bank.ACCOUNT_NO}-compact2.png?amount=${price}&addInfo=CKNH${content}`;
        event.preventDefault();

        return (window.location.href = `/admin/payment_transfer?QR=${QR}&price=${price}&content=${content}&data_order_item=${data_order_item}&data_list_detail=${data_list_detail}`);
    });
});
