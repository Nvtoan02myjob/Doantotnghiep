function updateTimeElapsed() {
    const elements = document.querySelectorAll(".time-elapsed");

    elements.forEach((el) => {
        const startTime = new Date(el.dataset.start);
        const now = new Date();

        const diffMs = now - startTime;
        const totalSeconds = Math.floor(diffMs / 1000);
        const hours = Math.floor(totalSeconds / 3600);
        const minutes = Math.floor((totalSeconds % 3600) / 60);
        const seconds = totalSeconds % 60;

        el.textContent = `${hours} giờ ${minutes} phút ${seconds} giây`;
    });
}

updateTimeElapsed();
setInterval(updateTimeElapsed, 1000);

function checkDishForCustomer() {
    const checkbox_employees = document.querySelectorAll(".checkbox_employee");

    checkbox_employees.forEach((child) => {
        const id = child.dataset.id;
        const savedValue = localStorage.getItem(id);

        if (savedValue === "1") {
            child.checked = true;
        } else {
            child.checked = false;
        }

        child.addEventListener("change", () => {
            if (child.checked) {
                localStorage.setItem(id, 1);
            } else {
                localStorage.setItem(id, 0);
            }
        });
    });
}

document.addEventListener("DOMContentLoaded", checkDishForCustomer);
