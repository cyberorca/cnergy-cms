var txtarea = document.querySelectorAll('.code-inventory');
var nav = document.querySelectorAll('.nav-link-inventory');

txtarea.forEach((el, i) => {
    CodeMirror.fromTextArea(el, {
        lineNumbers: true,  
        matchBrackets: true,
        indentUnit: 4,
        indentWithTabs: true,
        tabSize: 4,
        lineWrapping: true,
    });
})

nav.forEach((el, i) => {
    el.addEventListener('click', function(){
        CodeMirror.refresh();
    })
})
