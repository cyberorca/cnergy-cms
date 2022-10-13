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
let index = 1;
add_page_button.addEventListener('click', function () {
    let child = document.createElement("textarea");
    child.name = "content"
    child.rows = 10
    child.cols = 30
    child.classList.add("my-editor", "form-control")
    child.id = `#editor-${index}`
    // other_page.append(child)
    other_page.append(child)
    
    tinymce.init({
        selector: `textarea#editor-${index}`,
        themes: 'modern',
        height: 200,
    });
})
