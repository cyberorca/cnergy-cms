var image_preview_result = document.getElementById("image_preview_result")
var image_preview_modal = document.getElementById("image_preview_modal")
var upload_image_button = document.getElementById("upload_image_button")
var image_list_parent = document.getElementById("image_list_parent")

var image_bank_modal = document.getElementById("image_bank_modal")
var image_bank_type = $("#image-bank").attr("aria-type");
var search_image_bank_input = document.getElementById("search_image_bank_input")
var search_image_bank_button = document.getElementById("search_image_bank_button")
let list = []
var upload_image_selected = document.getElementById("upload_image_selected")
var save_uploaded_image = document.getElementById("save_uploaded_image")

save_uploaded_image.addEventListener('click', async function () {
    var form = document.querySelectorAll("#form-upload-image input, #form-upload-image textarea");
    var fd = new FormData();
    form.forEach((el, i) => {
        const name = el.name;
        let value = el.value;
        if (name === 'image_input') {
            const file = el.files
            value = file[0]
        }
        fd.append(name, value);
    })
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fd.append('_token', token);
    const button = this;
    $(this).html(`
    <span class="spinner-border spinner-border-sm" role="status"
    aria-hidden="true"></span>
    Loading...
    `);
    $(this).attr("disabled", true)
    $.ajax({
        url: "/image-bank/api/create/",
        type: 'POST',
        data: fd,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function ({
            message,
            data: {
                image_slug
            }
        }) {
            //  console.log(message, image_slug);
            image_preview_result.src = `${path}/${image_slug}`;
            $(button).html(` <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-sm-block"><i class="bi bi-save"></i>&nbsp;&nbsp;Save
            Image</span>`);
            new Toastify({
                text: message,
                duration: 3000,
                close: true,
                gravity: "bottom",
                position: "right",
                backgroundColor: "#4fbe87",
            }).showToast()
            $(button).attr("disabled", false)
            $("#image-bank").modal("hide");
            form.forEach((el, i) => {
                el.value = "";
            })
            image_preview_modal.src = `${path.split('/storage').slice(0, -1)}/assets/images/preview-image.jpg`
        },
        error: function (err) {
            form.forEach((el, i) => {
                el.value = "";
            })
            image_preview_modal.src = `${path.split('/storage').slice(0, -1)}/assets/images/preview-image.jpg`
            new Toastify({
                text: err,
                duration: 3000,
                close: true,
                gravity: "bottom",
                position: "right",
                backgroundColor: "#ff0000",
            }).showToast()
        }
    });
})

let path = document.getElementById('path_image').value;

upload_image_button.onchange = evt => {
    const [file] = upload_image_button.files
    if (file) {
        upload_image_selected.value = null;
        image_preview_modal.src = URL.createObjectURL(file)
    }
}

if($(`.button-old-photo-news`).length > 0){
    var buttonsOldPhotoNews = document.querySelectorAll('.button-old-photo-news');
     buttonsOldPhotoNews.forEach((el, i) => {
         el.addEventListener('click', function(){
             const url = $(el).attr("url-data")
             image_preview_result.src = url;
             upload_image_selected.value = url;
         })
     })
 }
 

let selectedPhotoNews = [];
let index_photonews = 1;
if (image_bank_type == 'photonews') {
    $("#save_photo_news").click(function () {
        selectedPhotoNews.map((el, i) => {
            $("#other_page").append(cardPhotoNews(el, index_photonews))
            $(`.bi-trash`).click(function(){
                document.querySelector(`#imagephotonews-${index_photonews-1}`).remove();
            })
            $(`#button-photonews-selected-${index_photonews}`).click(function(){
                const url = $(this).attr("url-data")
                image_preview_result.src = url;
                upload_image_selected.value = url;
            })
            
            index_photonews++;
        })
        selectedPhotoNews = [];
    })
}

function deleteImage(){
    var buttonsOldPhotoNews2 = document.querySelectorAll('.bi-trash');
         buttonsOldPhotoNews2.forEach((el, i) => {
             el.addEventListener('click', function(){
                 const id = $(el).attr("id")
                 document.querySelector(`#imagephotonews-${id}`).remove();
             })
         })
}

$(`.bi-trash`).click(function(){
    deleteImage();
})

function selectImage() {
    if (image_bank_type == 'photonews') {
        const image = JSON.parse($(this).siblings('input').val());
        if(this.getAttribute("status-selected") === 'true'){
            this.innerHTML = `<i class="bi bi-plus-circle"></i>&nbsp;&nbsp;Select`
            this.setAttribute('status-selected', 'false')
            selectedPhotoNews = selectedPhotoNews.filter((el) => el.slug !== image.slug);
        } else {
            this.setAttribute('status-selected', 'true')
            selectedPhotoNews.push(image);
            this.innerHTML = `<i class="bi bi-dash-circle"></i>&nbsp;&nbsp;Deselect`
        }
        const status_selected = $("[status-selected=true]").length;
        if(status_selected <= 0){
            $("#save_photo_news").attr("disabled", true)
        } else {
            $("#save_photo_news").removeAttr("disabled")
        }
        this.classList.toggle('btn-warning')
        this.classList.toggle('btn-danger')
    } else {
        const imageSrc = this.parentElement.children[0].getAttribute("src");
        // const imageTitle = this.parentElement.children[1].innerHTML;
        //  image_title.innerHTML = imageTitle;
        image_preview_result.src = imageSrc;
        upload_image_selected.value = imageSrc;
        upload_image_button.value = null;
    }
    // console.log(selectedPhotoNews);
}

async function search() {
    const query = '?title=' + search_image_bank_input.value;
    image_list_parent.innerHTML = `<div class="spinner-border text-primary mt-3" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>`;
    const data = await fetchData(query);
    list = makeList(data);
    image_list_parent.innerHTML = list
    var button_image_bank_modal_arr = document.querySelectorAll(".button_image_bank_modal")
    button_image_bank_modal_arr.forEach(item => {
        item.addEventListener('click', selectImage);
    })
}

async function fetchData(query = '') {
    const url = `/image-bank/api/list/${query}`;
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const data = await fetch(url, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            method: 'get',
            credentials: "same-origin",
        })
        .then((data) => {
            return data.json()
            // window.location.href = redirect;
        })
        .catch(function (error) {
            console.log(error);
        });

    return data;
}


async function addEventListeners() {
    image_list_parent.innerHTML = `<div class="spinner-border text-primary mt-3" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>`;
    const data = await fetchData();
    list = makeList(data);
    image_list_parent.innerHTML = list

    var button_image_bank_modal_arr = document.querySelectorAll(".button_image_bank_modal")
    button_image_bank_modal_arr.forEach(item => {
        item.addEventListener('click', selectImage);
    })
    search_image_bank_button.addEventListener('click', search);
}

function makeList(data) {
    let imageList = '';
    data.map((el, i) => {
        const {
            title,
            slug,
            caption,
            copyright,
            keywords
        } = el;
        let str = `
           <div class="image-card border p-0 image-card border p-0 d-flex flex-column align-items-center">
               <img src="${path}/${slug}"
                   alt="" class="w-100 image_bank_modal">
               <p class="mx-2 font-14 mt-3 mb-1">${title}</p>
               <input type="hidden" data-key="data_image" value='${JSON.stringify(el)}' />
               <span class="mx-2 btn-warning font-14 w-100 button-action button_image_bank_modal" status-selected="false" ${image_bank_type !== "photonews" ? `data-bs-dismiss="modal"` : null}><i
                       class="bi bi-plus-circle"></i>&nbsp;&nbsp;Select</span>

           </div>`

        imageList += str;
    })

    return imageList;
}

addEventListeners();

//  button_image_bank_modal.addEventListener('click', function () {
//      const parent = this.parentNode;
//      console.log(parent);
//  })

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

const cardPhotoNews = (image, index) => {
    const { title, slug, caption, keywords, copyright, description } = image;
    return `<div class="card" id="imagephotonews-${+index}">
    <div class="card-header d-flex justify-content-between">
        <a data-bs-toggle="collapse" class="d-flex justify-content-between w-100" href="#photonews-${+index}" aria-expanded="false"
            aria-controls="collapseExample">
            <span class="h4 text-capitalize m-0">Image</span>
            <i class="bi bi-chevron-up pull-right fs-6 me-3"></i>
            <i class="bi bi-chevron-down pull-right fs-6 me-3"></i>
        </a>
        <i class="bi bi-trash pull-right text-danger fw-bold"></i> 
    </div>
    <div class="collapse show fade" id="photonews-${+index}">
        <div class="card-body d-flex flex-column gap-2">
            <div class="row">
                <div class="col-md-5 col-12">
                    <div class="form-group">
                        <div class="image-file-preview mt-3">
                            <img src="${path}/${slug}" alt="" srcset=""
                                id="image_preview_result">
                            <input type="hidden" name="photonews[${+index}][url]" value="${slug}" />
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-end gap-3 mt-3 flex-column">
                                <span url-data="${path}/${slug}" id="button-photonews-selected-${+index}" class="btn btn-light-secondary me-1 mb-1">Set as Main
                                    Image</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-12">
                    <div class="form-group">
                        <label for="caption" class="mb-2">Caption</label>
                        <input type="text" class="form-control" id="caption" name="photonews[${+index}][caption]"
                            placeholder="Enter Caption " required value="${caption}" />
                    </div>
                    <div class="form-group">
                        <label for="copyright" class="mb-2">Copyright</label>
                        <input type="text" class="form-control" id="copyright" name="photonews[${+index}][copyright]"
                            placeholder="Enter Copyright " required value="${copyright}"/>
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Keyword</label><br>
                        <input name="photonews[${+index}][keywords]" id="image_keywords" type="text" required
                            class="w-100 form-control" data-role="tagsinput" placeholder="Enter Keywords " value="${keywords}" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="image_description" class="form-label mb-2">Description</label>
                <textarea name="photonews[${+index}][description]" class="form-control" id="image_description" cols="30" rows="3" required
                    placeholder="Enter Description">${description}</textarea>
            </div>
        </div>
    </div>
</div>
`
}