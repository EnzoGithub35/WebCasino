import './bootstrap';

const labels = document.querySelectorAll('.form-control label')
labels.forEach(label => {
label.innerHTML = label.innerText
.split('')
.map((letter, idx) => `<span style="transition-delay:${idx * 50}ms">${letter}</span>`)
.join('')
})






  const title = document.querySelector('.title');
  title.innerHTML = title.innerHTML.split('').map((letter, i) =>
    `<span style="transition-delay:${i * 40}ms; filter:hue-rotate(${i * 30}deg);">${letter}</span>`
  ).join('');



  