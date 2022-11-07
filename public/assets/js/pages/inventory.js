var txtarea = document.querySelectorAll('.CodeMirror');

txtarea.forEach((el, i) => {
    CodeMirror.fromTextArea(el, {
        mode: "javascript",
        lineNumbers: true,
        theme: 'dracula'
    });
})
