let s1 = document.getElementById('s1');
let s2 = document.getElementById('s2');
let s3 = document.getElementById('s3');
let s4 = document.getElementById('s4');
let s5 = document.getElementById('s5');

let p1 = document.getElementById('p1');
let p2 = document.getElementById('p2');
let p3 = document.getElementById('p3');
let p4 = document.getElementById('p4');
let p5 = document.getElementById('p5');

p1.addEventListener('input', () => {
    addSellingPrice(p1, s1);
})
p2.addEventListener('input', () => {
    addSellingPrice(p2, s2);
})
p3.addEventListener('input', () => {
    addSellingPrice(p3, s3);
})
p4.addEventListener('input', () => {
    addSellingPrice(p4, s4);
})
p5.addEventListener('input', () => {
    addSellingPrice(p5, s5);
})

function addSellingPrice(p, s) {
    s.value = parseInt(p.value) + 2500;
}