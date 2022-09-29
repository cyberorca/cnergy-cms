const accordion_list = document.getElementById('accordion-list');
const button_save = document.getElementById('button-save-order');

let dragStartIndex;
const listItems = [];
const orderedMenu = [];

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
    swapItems(dragStartIndex, index, this, el);
    this.classList.remove('over');
    this.classList.remove('drag_over');
}

function getIndexChildren(element) {
    return Array.from(
        element.parentElement.querySelectorAll(":scope .draggable")
    ).indexOf(element);
}

function getParentId(el) {
    return +el.parentElement.getAttribute("data-id");
}

function swapItems(fromIndex, toIndex, el, event) {
    const parent = el.parentNode;
    const childrens = parent.querySelectorAll(":scope .draggable");

    // let itemOne = childrens[fromIndex];
    let itemTwo = childrens[toIndex];
    let itemTwoSibling = itemTwo.nextSibling === itemTwo ? itemTwo : itemTwo.nextSibling;

    const element_id = event.dataTransfer.getData("from_element");
    const orderedItem = document.querySelector(`[data-id="${element_id}"]`);

    button_save.classList.remove("d-none")
    parent.insertBefore(orderedItem, itemTwoSibling);
    if (parent_id = orderedItem.parentElement.children[0].getAttribute("data-parent")) {
        orderedItem.setAttribute("data-parent", parent_id);
    }
}

// console.log("fromIndex", fromIndex);
// console.log("itemTwo", itemTwo);
// console.log("parent_id", parent_id);
// console.log("itemTwoSibling", itemTwoSibling);
// console.log("data transfer", event.dataTransfer.getData("from_element"));

let parentChoosen = [];
let count = 0;
let indexParent = 0;

async function onSaveOrderMenu(e) {
    e.preventDefault();
    const draggables = document.querySelectorAll('.draggable');
    draggables.forEach((item, index) => {
        const id = item.getAttribute("data-id");
        const parent_id = item.getAttribute("data-parent");
        orderedMenu.push({
            'id': +id,
            // 'el': item,
            'order': checkHasParent(+parent_id, index),
            'parent_id': parent_id === '' ? null : +parent_id,
        })

    })
    const res = await updateOrderedMenu(orderedMenu);
    console.log(res);
    parentChoosen = [];
    count = 0;
    indexParent = 0;
}

async function updateOrderedMenu(ordered_menu) {
    const url = '/front-end-menu/order/update/';
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const data = await fetch(url, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            method: 'post',
            credentials: "same-origin",
            body: JSON.stringify({
                data: ordered_menu
            })
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


function checkHasParent(parent_id, index) {
    if (parent_id) {
        const found = parentChoosen.filter((el, i) => {
            if (el.parent_id == parent_id) {
                indexParent = i;
                return true
            }
            return false;
        })
        if (found.length !== 0) {
            count = found[0].count + 1;
            parentChoosen[indexParent] = {
                'parent_id': parent_id,
                'count': count
            }
            return count;
        } else {
            parentChoosen.push({
                'parent_id': parent_id,
                'count': count
            })
            return count;
        }
    }
    return index - count;
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

    button_save.addEventListener('click', onSaveOrderMenu)
}

addEventListeners();
