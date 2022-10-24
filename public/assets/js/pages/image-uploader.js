 var image_preview_result = document.getElementById("image_preview_result")
 var upload_image_button = document.getElementById("upload_image_button")
 var image_list_parent = document.getElementById("image_list_parent")

 var image_bank_modal = document.getElementById("image_bank_modal")
//  var image_title = document.getElementById("image_title")

 var search_image_bank_input = document.getElementById("search_image_bank_input")
 var search_image_bank_button = document.getElementById("search_image_bank_button")
 let list = []
 var upload_image_selected = document.getElementById("upload_image_selected")

 let path = document.getElementById('path_image').value;

 upload_image_button.onchange = evt => {
     const [file] = upload_image_button.files
     if (file) {
          upload_image_selected.value = null;
         image_preview_result.src = URL.createObjectURL(file)
     }
 }

 function selectImage() {
     const imageSrc = this.parentElement.children[0].getAttribute("src");
     const imageTitle = this.parentElement.children[1].innerHTML;
    //  image_title.innerHTML = imageTitle;
     image_preview_result.src = imageSrc;
     upload_image_selected.value = imageSrc;
     upload_image_button.value = null;
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
             caption
         } = el;
         let str = `
            <div class="image-card border p-0 image-card border p-0 d-flex flex-column align-items-center">
                <img src="${path}/${slug}"
                    alt="" class="w-100 image_bank_modal">
                <p class="mx-2 font-14 mt-3 mb-1">${title}</p>
                <span class="mx-2 btn-warning font-14 w-100 button-action button_image_bank_modal" data-bs-dismiss="modal"><i
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
