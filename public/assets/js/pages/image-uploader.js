 var image_preview_result = document.getElementById("image_preview_result")
 var upload_image_button = document.getElementById("upload_image_button")

 var image_bank_modal = document.getElementById("image_bank_modal")
 var image_title = document.getElementById("image_title")
 upload_image_button.onchange = evt => {
     const [file] = upload_image_button.files
     if (file) {
         image_preview_result.src = URL.createObjectURL(file)
     }
 }

 function selectImage(){
    const imageSrc = this.parentElement.children[0].getAttribute("src");
    const imageTitle = this.parentElement.children[1].innerHTML;
    image_title.innerHTML = imageTitle;
    image_preview_result.src = imageSrc;
 }

 function addEventListeners() {
     var button_image_bank_modal_arr = document.querySelectorAll(".button_image_bank_modal")
     button_image_bank_modal_arr.forEach(item => {
        item.addEventListener('click', selectImage);
     })
 }

 addEventListeners();

 //  button_image_bank_modal.addEventListener('click', function () {
 //      const parent = this.parentNode;
 //      console.log(parent);
 //  })
