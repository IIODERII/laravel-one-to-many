import "./bootstrap";
import "~resources/scss/app.scss";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**", "../fonts/**"]);

const buttons = document.querySelectorAll(".cancel-button");

buttons.forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();
        const dataTitle = button.getAttribute("data-item-title");
        const modal = new bootstrap.Modal("#deleteModal");
        modal.show();

        const title = document.querySelector("#modal-item-title");
        title.textContent = dataTitle;

        const dataId = button.getAttribute("data-form-id");

        const confirm = document.querySelector(".confirm-cancel");
        confirm.addEventListener("click", (e) => {
            document.querySelector("#delete-form-" + dataId).submit();
        });
    });
});

const previewImage = document.getElementById("image");
previewImage.addEventListener("change", (event) => {
    const ofReader = new FileReader();
    ofReader.readAsDataURL(previewImage.files[0]);

    ofReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
});
