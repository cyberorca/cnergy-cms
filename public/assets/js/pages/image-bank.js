// var image_preview = document.getElementById("image_preview")
// var image_input = document.getElementById("image_input")
// var multiple_image = document.getElementById("multiple_image")
// var image_selected = document.getElementById("image_selected")

// let arrImageSelected = [];
// var arrImageSelectedString = '';
// let index = 0;
// // image_input.onchange = async evt => {
// //     const files = image_input.files;
// //     if (files.length > 0) {
// //         for (let i = 0; i < files.length; i++) {
// //             if (!files[i].type.match("image")) continue;
// //             const imgReader = new FileReader();
// //             await imgReader.addEventListener("load", function (event) {
// //                 const imgFile = event.target;
// //                 const div = document.createElement('div');
// //                 const element = `
// //                             <div class="d-flex flex-column align-items-center">
// //                                 <div class="image-bank-box" data-index="${index}">
// //                                     <input type="hidden" class="form-control mt-3" name="image_input[][url]" id="image_selected" value="${imgFile.result}"/>
// //                                     <input type="hidden" class="form-control mt-3" name="image_input[][name]" id="image_selected_name" value="${files[i].name}"/>
// //                                     <img src="${imgFile.result}" alt="" srcset="">
// //                                     <div class="image-bank-delete-box">
// //                                         <i class="bi bi-x-circle-fill fs-1 mb-5 me-4"></i>
// //                                     </div>
// //                                 </div>
// //                                 <span class="button_image_bank_box my-1" id="button_image_bank_box">Remove File</span>
// //                             </div>
// //                             `;
// //                 div.innerHTML = element;
// //                 multiple_image.appendChild(div);
// //                 arrImageSelected.push({
// //                     id: index,
// //                     image: imgFile.result,
// //                 });
// //                 index++;
// //                 div.querySelector("#button_image_bank_box").addEventListener('click', function(){
// //                     const id = div.querySelector(".image-bank-box").getAttribute('data-index');
// //                     const array = [...arrImageSelected.filter((el) => +el.id !== +id)];
// //                     arrImageSelected = [...array] ?? [];
// //                     div.remove();
// //                 })
// //                 div.querySelector(".image-bank-delete-box").addEventListener('click', function(){
// //                     const id = div.querySelector(".image-bank-box").getAttribute('data-index');
// //                     const array = [...arrImageSelected.filter((el) => +el.id !== +id)];
// //                     arrImageSelected = [...array] ?? [];
// //                     div.remove();
// //                 })
// //             });
// //             imgReader.readAsDataURL(files[i]);
// //             // imgReader.readAsBinaryString(files[i]);
// //         }
// //     }
// // }
// Dropzone.options.myDropzone = {
//     autoQueue: false,
//     addRemoveLinks: true,
//     maxFiles: 100,
//     dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"><i class="fa fa-caret-right text-danger"></i> Drop files <span class="font-xs">to upload</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (Or Click)</h4></span>',
//     dictResponseError: 'Error uploading file!',
//     headers: {
//         'X-CSRF-TOKEN': $('metameta[name="csrf-token"]').attr('content')
//     },
//     init: function () {
//         this.on("addedfile", function (file) {
//             file.previewElement.addEventListener("click", function () {
//                 myDropzone.removeFile(file);
//             });
//         });
//     }
// };

