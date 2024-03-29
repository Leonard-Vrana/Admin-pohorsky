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

function selector() {
    var Select = function (t, i) {
        (this.target = null),
            (this.select = null),
            (this.display = null),
            (this.list = null),
            (this.options = []),
            (this.isLarge = !1),
            (this.value = null),
            (this.selected = null),
            (this.settings = null),
            (this.highlighted = null),
            (this.init = function () {
                switch (typeof t) {
                    case "object":
                        this.target = t;
                        break;
                    case "string":
                        this.target = document.querySelector(t);
                }
                (this.settings = this.getSettings(i)),
                    this.buildSelect(),
                    this.target.parentNode.replaceChild(
                        this.select,
                        this.target
                    ),
                    (this.target.style.display = "none"),
                    this.select.appendChild(this.target),
                    document.addEventListener(
                        "click",
                        this.handleClickOff.bind(this)
                    ),
                    this.positionList();
            }),
            (this.buildSelect = function () {
                (this.select = document.createElement("div")),
                    this.select.classList.add("select"),
                    this.select.setAttribute("tabindex", this.target.tabIndex),
                    this.select.addEventListener(
                        "keydown",
                        this.handleSelectKeydown.bind(this)
                    ),
                    (this.display = document.createElement("span")),
                    this.display.classList.add("value"),
                    this.display.addEventListener(
                        "click",
                        this.handleDisplayClick.bind(this)
                    ),
                    this.select.appendChild(this.display),
                    this.buildList(),
                    this.options.length &&
                        ((this.value =
                            this.options[
                                this.target.selectedIndex
                            ].getAttribute("data-value")),
                        (this.selected =
                            this.options[this.target.selectedIndex]),
                        (this.display.innerHTML = this.selected.innerHTML)),
                    (("auto" === this.settings.filtered &&
                        this.options.length >=
                            this.settings.filter_threshold) ||
                        this.settings.filtered === !0) &&
                        ((this.isLarge = !0),
                        this.select.classList.add("large"));
            }),
            (this.buildList = function () {
                (this.list = document.createElement("div")),
                    this.list.classList.add("list"),
                    this.list.setAttribute("tabindex", "-1"),
                    this.list.addEventListener(
                        "keydown",
                        this.handleListKeydown.bind(this)
                    ),
                    this.list.addEventListener(
                        "mouseenter",
                        function () {
                            this.options[this.highlighted].classList.remove(
                                "hovered"
                            );
                        }.bind(this)
                    ),
                    (this.highlighted = this.target.selectedIndex),
                    this.buildFilter(),
                    this.buildOptions(),
                    this.select.appendChild(this.list);
            }),
            (this.buildFilter = function () {
                var t = document.createElement("div");
                t.classList.add("filter"),
                    (this.filter = document.createElement("input")),
                    (this.filter.type = "text"),
                    this.filter.setAttribute(
                        "placeholder",
                        this.settings.filter_placeholder
                    ),
                    this.filter.addEventListener(
                        "keyup",
                        this.handleFilterKeyup.bind(this)
                    ),
                    t.appendChild(this.filter),
                    this.list.appendChild(t);
            }),
            (this.buildOptions = function () {
                for (
                    var t = document.createElement("ul"),
                        i = this.target.querySelectorAll("option"),
                        e = 0;
                    e < i.length;
                    e++
                ) {
                    var s = document.createElement("li");
                    s.setAttribute("data-value", i[e].value),
                        (s.innerHTML = i[e].innerHTML),
                        s.addEventListener(
                            "click",
                            this.handleOptionClick.bind(this)
                        ),
                        t.appendChild(s),
                        this.options.push(s);
                }
                this.list.appendChild(t);
            }),
            (this.toggleList = function () {
                this.list.classList.contains("open")
                    ? (this.list.classList.remove("open"),
                      this.options[this.highlighted].classList.remove(
                          "hovered"
                      ),
                      this.select.focus())
                    : (this.options[this.target.selectedIndex].classList.add(
                          "hovered"
                      ),
                      (this.highlighted = this.target.selectedIndex),
                      this.list.classList.add("open"),
                      this.list.focus());
            }),
            (this.positionList = function () {
                this.isLarge ||
                    (this.list.style.top =
                        "-" + this.selected.offsetTop + "px");
            }),
            (this.highlightOption = function (t) {
                var i = null;
                switch (t) {
                    case "up":
                        i =
                            this.highlighted - 1 < 0
                                ? this.highlighted
                                : this.highlighted - 1;
                        break;
                    case "down":
                        i =
                            this.highlighted + 1 > this.options.length - 1
                                ? this.highlighted
                                : this.highlighted + 1;
                        break;
                    default:
                        i = this.highlighted;
                }
                this.options[this.highlighted].classList.remove("hovered"),
                    this.options[i].classList.add("hovered"),
                    (this.highlighted = i);
            }),
            (this.clearFilter = function () {
                this.filter.value = "";
                for (var t = 0; t < this.options.length; t++)
                    this.options[t].style.display = "block";
            }),
            (this.closeList = function () {
                this.list.classList.remove("open"),
                    this.options[this.highlighted].classList.remove("hovered");
            }),
            (this.getSettings = function (t) {
                var i = {
                    filtered: "auto",
                    filter_threshold: 8,
                    filter_placeholder: "Filter options...",
                };
                for (var e in t) i[e] = t[e];
                return i;
            }),
            (this.handleSelectKeydown = function (t) {
                this.select === document.activeElement &&
                    32 == t.keyCode &&
                    this.toggleList();
            }),
            (this.handleDisplayClick = function (t) {
                this.list.classList.add("open"),
                    this.isLarge && this.filter.focus();
            }),
            (this.handleListKeydown = function (t) {
                if (this.list === document.activeElement)
                    switch (t.keyCode) {
                        case 38:
                            this.highlightOption("up");
                            break;
                        case 40:
                            this.highlightOption("down");
                            break;
                        case 13:
                            (this.target.value =
                                this.options[this.highlighted].getAttribute(
                                    "data-value"
                                )),
                                (this.selected =
                                    this.options[this.highlighted]),
                                (this.display.innerHTML =
                                    this.options[this.highlighted].innerHTML),
                                this.closeList(),
                                setTimeout(this.positionList.bind(this), 200),
                                this.select.focus();
                    }
            }),
            (this.handleFilterKeyup = function (t) {
                var i = this;
                this.options.filter(function (t) {
                    t.innerHTML
                        .substring(0, i.filter.value.length)
                        .toLowerCase() == i.filter.value.toLowerCase()
                        ? (t.style.display = "block")
                        : (t.style.display = "none");
                });
            }),
            (this.handleOptionClick = function (t) {
                (this.display.innerHTML = t.target.innerHTML),
                    (this.target.value = t.target.getAttribute("data-value")),
                    (this.value = this.target.value),
                    (this.selected = t.target),
                    this.closeList(),
                    this.clearFilter(),
                    setTimeout(this.positionList.bind(this), 200);
                this.target.dispatchEvent(new Event("change"));
            }),
            (this.handleClickOff = function (t) {
                this.select.contains(t.target) || this.closeList();
            }),
            this.init();
    };

    let selects = document.querySelectorAll(".autocomplete");
    selects.forEach(function (item) {
        new Select(item, { filter_placeholder: "Vybírejte z možností" });
    });
}

document.addEventListener("DOMContentLoaded", function (event) {
    accordeon();
    Modals();
    tinyMce();
    selector();
});
