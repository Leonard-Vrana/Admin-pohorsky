import "./bootstrap";
import { create } from "@iconfu/svg-inject";
SVGInject(document.querySelectorAll("img.svginject"));

function accordeon() {
    const accordeons = document.querySelectorAll(".accordeon");
    accordeons.forEach((item) => {
        let click = item.querySelector(".click");
        if (click) {
            click.addEventListener("click", () => {
                let content = item.querySelector(".content");
                if (content) {
                    content.classList.toggle("hidden");
                }
            });
        }
    });
}

function Modals() {
    let modals = document.querySelectorAll(".modal");
    let backgroundModal = document.getElementById("bgModal");
    modals.forEach(function (item) {
        let dataset = item.dataset;
        let modalName = item.getAttribute("data-name");
        let getModal = document.getElementById(modalName);
        if (getModal) {
            item.addEventListener("click", function () {
                getModal.classList.add("openModal");
                if (dataset) {
                    if (item.getAttribute("data-pricetext")) {
                        getModal.querySelector(".priceText").innerHTML =
                            item.getAttribute("data-pricetext");
                    }
                    for (let key in dataset) {
                        // console.log(dataset[key]);
                        if (key === "name") {
                        } else {
                            let getElement = getModal.querySelector("." + key);
                            if (getElement) {
                                getElement.value = dataset[key];
                            }
                        }
                    }
                }
                if (backgroundModal) {
                    backgroundModal.classList.add("openBG");
                }
                open = 1;
            });
            if (backgroundModal) {
                backgroundModal.addEventListener("click", function () {
                    backgroundModal.classList.remove("openBG");
                    getModal.classList.remove("openModal");
                });
            }
        }
    });
}

function tinyMce() {
    if (document.getElementById("textareaContent")) {
        tinymce.init({
            selector: "textarea",
            skin: "oxide-dark",
            content_css: "dark",
            plugins:
                "searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount charmap quickbars code",
            imagetools_cors_hosts: ["picsum.photos"],
            menubar: "file edit view insert tools table help",
            toolbar:
                "undo redo | blocks| bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | removeformat",
            tinycomments_mode: "embedded",
            tinycomments_author: "Author name",
            entity_encoding: "raw",
            mergetags_list: [
                { value: "First.Name", title: "First Name" },
                { value: "Email", title: "Email" },
            ],
        });
    }
}

document.addEventListener("DOMContentLoaded", function (event) {
    accordeon();
    Modals();
    tinyMce();
});
