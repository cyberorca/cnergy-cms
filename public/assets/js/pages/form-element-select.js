let choices = document.querySelectorAll('.choices');
let initChoice;
for (let i = 0; i < choices.length; i++) {
    if (choices[i].classList.contains("multiple-remove")) {
        initChoice = new Choices(choices[i], {
            delimiter: ',',
            editItems: true,
            maxItemCount: -1,
            removeItemButton: true,
        });
    } else {
        initChoice = new Choices(choices[i]);
    }
}

var add_page_button = document.getElementById("add_page_button");
var other_page = document.getElementById("other_page");
var content_box = document.getElementById("content_box");
var card_content = document.getElementById("card_content");
var liveToast = document.getElementById("liveToast");
var id_news = document.getElementById("id_news") ? document.getElementById("id_news").value : null;
let index = 2;
add_page_button.addEventListener('click', function () {
    collapseElement(false, index);
    tinyMCEConfig(`${index}`)
    console.log(index);
    index++;
})

function textareaElement(page_no, other, edit) {
    let child = document.createElement("textarea");
    child.name = edit ? `content[${id_news ?? ''}][${other.id}]` : `content[]`
    child.rows = 10
    child.cols = 30
    child.classList.add("my-editor", "form-control", 'my-3', `editors${page_no}`)
    child.id = `#editor-${page_no}`

    return child;
}

function changeAllPageAfterDeleted() {
    const collapse = document.querySelectorAll(".text-collapse-news-pagination");
    index = 2;
    collapse.forEach((el) => {
        el.innerHTML = `Page ${index}`
        index++;
    })
}

const collapseLinkElement = (page_no, edit = false, other) => {
    let collapseBox = document.createElement('div');
    collapseBox.classList.add("d-flex", "w-100", "mt-3");

    let collapseLink = document.createElement('a');
    collapseLink.classList.add("bg-white", "py-3", "px-4", "pe-0", "collapse-news", "w-100")
    collapseLink.setAttribute("data-bs-toggle", "collapse");
    collapseLink.href = `#collapse-${page_no}`
    collapseLink.innerHTML = `
    <div class="d-flex justify-content-between align-items-center pe-3">
        <span class="h6 text-uppercase m-0 text-collapse-news-pagination">Page ${!edit ? page_no : page_no.split("-")[1]}</span>
        <i class="bi bi-chevron-down fs-6 mb-2" style="float:right"></i>
    </div>
    `

    let deleteCollapse = document.createElement("span")
    deleteCollapse.classList.add("btn", "icon", "btn-danger", "m-0", "py-1", "rounded-0", "d-flex", "align-items-center")
    deleteCollapse.innerHTML = `<i class="bi bi-trash-fill fs-6 mb-2"></i>`
    deleteCollapse.setAttribute("data-status-form", edit)
    deleteCollapse.setAttribute("data-id", !edit ? page_no : other.id)

    deleteCollapse.addEventListener('click', function () {
        const status = this.getAttribute("data-status-form") === "true" ? 1 : 0;
        const id = this.getAttribute("data-id");
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const element = this;
        if (status) {
            $.ajax({
                url: "/update/news/pagination/api/delete",
                type: 'POST',
                data: {
                    _token: token,
                    id: id,
                },
                success: function ({
                    message
                }) {
                    new Toastify({
                        text: message,
                        duration: 3000,
                        close: true,
                        gravity: "bottom",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast()
                    // liveToast.classList.remove("hide");
                    // liveToast.classList.add("show");
                    // liveToast.querySelector(".toast-body").innerHTML = message
                    document.querySelector(`#collapse-${page_no}`).remove();
                    element.parentElement.remove();
                    changeAllPageAfterDeleted();
                }
            });
        } else {
            Toastify({
                text: "Successfully deleted page",
                duration: 3000,
                close: true,
                gravity: "bottom",
                position: "right",
                backgroundColor: "#4fbe87",
            }).showToast()
            // liveToast.classList.remove("hide");
            // liveToast.classList.add("show");
            // liveToast.querySelector(".toast-body").innerHTML = "Successfully deleted page"
            document.querySelector(`#collapse-${page_no}`).remove();
            element.parentElement.remove();
            changeAllPageAfterDeleted();
        }
    })

    collapseBox.append(collapseLink)
    collapseBox.append(deleteCollapse)
    return collapseBox;
}

const collapseBodyElement = (page_no) => {
    let collapseBody = document.createElement('div');
    collapseBody.classList.add("collapse");
    collapseBody.id = `collapse-${page_no}`
    return collapseBody;
}

const newAddContent = (child, edit = false, other) => {
    const new_add_content = card_content.cloneNode(true);
    new_add_content.querySelector("#synopsis").previousElementSibling.remove();
    new_add_content.querySelector("#synopsis").remove();
    new_add_content.querySelector(".my-editor").remove();
    if (!edit) {
        new_add_content.querySelector(".mce-tinymce").remove();
    }
    new_add_content.querySelector(".card-header").remove();
    // new_add_content.querySelector(".card-header-text").innerHTML = `Page ${index + 1}`
    new_add_content.querySelector("#content_box").append(child);
    new_add_content.querySelector("#title").name = edit ? `title[${id_news ?? ''}][${other.id}]` : `title[]`
    new_add_content.querySelector("#title").value = edit ? `${other.title}` : ``
    return new_add_content;
}

function collapseElement(edit = false, page_no, ...other) {
    const textarea = textareaElement(page_no, other[0], edit);
    const collapseBody = collapseBodyElement(page_no)
    const new_add_content = newAddContent(textarea, edit, other[0]);
    const collapseLink = collapseLinkElement(page_no, edit, other[0]);

    if (edit) {
        const {
            content
        } = other[0];
        textarea.innerText = content
    }

    collapseBody.append(new_add_content);
    other_page.append(collapseLink);
    other_page.append(collapseBody);
}

function tinyMCEConfig(index_pages) {
    tinymce.EditorManager.execCommand('mceAddEditor', true, `editor-${index_pages}`);
    tinymce.init({
        selector: `textarea.editors${index_pages}`,
        themes: 'modern',
        height: 400,
        path_absolute: "/",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback: function (field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                'body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document
                .getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no"
            });
        }
    });
}

if (document.body.contains(document.getElementById("news_paginations"))) {
    const news_paginations = JSON.parse(document.getElementById("news_paginations").value);
    if(news_paginations.length){
        let page_count = 2;
        news_paginations.map((el, i) => {
            index = page_count;
            collapseElement(true, `${el.news_id}-${index}`, {
                content: el.content,
                title: el.title,
                id: el.id
            })
            tinyMCEConfig(`${el.news_id}-${index}`)
            page_count++;
        })
        index++;
    }
}
