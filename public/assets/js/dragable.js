const accordion_list = document.getElementById('accordion-list');

let dragStartIndex;
const listItems = [];

const spaceElement = document.createElement("div");
spaceElement.classList.add("space-element");

function dragStart(e) {
    e.dataTransfer.setData("from_element", this.getAttribute("data-id"));
    dragStartIndex = +getIndexChildren(this);
}

function dragEnter() {
    this.appendChild(spaceElement);
}

function dragLeave() {}

function dragOver(e) {
    e.preventDefault();
}

function dragEnd(e) {
    e.preventDefault();
    accordion_list.querySelector(".space-element").remove();
}

function dragDrop(el) {
    el.preventDefault();
    const index = getIndexChildren(this);
    swapItems(dragStartIndex, index, this, +this.getAttribute("data-parent"), el);
    this.classList.remove('over');
    this.classList.remove('drag_over');
}

function getIndexChildren(element) {
    return Array.from(
        element.parentElement.querySelectorAll(":scope .draggable")
    ).indexOf(element);
}

function getParentId(el){
    return +el.parentElement.getAttribute("data-id");
}

function swapItems(fromIndex, toIndex, el, parent_id = null, event) {
    const parent = el.parentNode;
    const childrens = parent.querySelectorAll(":scope .draggable"); 
    
    let itemOne = childrens[fromIndex];
    let itemTwo = childrens[toIndex];
    let itemTwoSibling = itemTwo.nextSibling === itemTwo ? itemTwo : itemTwo.nextSibling;
    const element_id = event.dataTransfer.getData("from_element");
    console.log("fromIndex", fromIndex);
        console.log("itemTwo", itemTwo);
        console.log("parent_id", parent_id);
        console.log("itemTwoSibling", itemTwoSibling);
        console.log("data transfer", event.dataTransfer.getData("from_element"));
    if(parent_id){
    } else {
    }
    // parent.insertBefore(itemOne, itemTwoSibling);
    parent.insertBefore(document.querySelector(`[data-id="${element_id}"]`), itemTwoSibling);
}

function addEventListeners() {
    const draggables = document.querySelectorAll('.draggable');

    draggables.forEach(item => {
        listItems.push(item);
        item.addEventListener('dragstart', dragStart);
        item.addEventListener('dragover', dragOver);
        item.addEventListener('drop', dragDrop);
        item.addEventListener('dragenter', dragEnter);
        item.addEventListener('dragleave', dragLeave);
        item.addEventListener('dragend', dragEnd);
    });
}

addEventListeners();
