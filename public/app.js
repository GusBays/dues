export class Toast {
    constructor() {
        const toastEl = document.querySelector(".toast");
        this.bootstrapToast = bootstrap.Toast.getOrCreateInstance(toastEl);
    }

    show(message) {
        const toastMessage = document.getElementById("toast-message");
        if (message) toastMessage.innerText = message;
        else toastMessage.innerText = "Ops, ocorreu um erro. Tente novamente.";
        this.bootstrapToast.show();
    }
}
