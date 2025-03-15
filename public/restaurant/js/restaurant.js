const btn_burger=document.querySelector('.buttons-burger');
const hr_burger=document.querySelector('.burger-hr');
const container_burger=document.querySelector('.container-burger-menu');
const spans=document.querySelectorAll('.line');


function active_burger(event) {
  let target = event.target;
  /* console.log(target) */
  // Si el evento es disparado por un span, acceder al padre
  if (target.tagName === 'SPAN') {
    event.stopPropagation();
    target = target.parentElement; // Cambiar el target al padre (button)
    console.log(target)
  }

  // Verificar si el target ahora es un button
  if (target.tagName === 'BUTTON') {
    if (target.getAttribute('data-active') === 'false') {
      hr_burger.classList.replace("burger-hr", "burger-hr-active");
      container_burger.classList.replace('container-burger-menu', 'container-burger-menu-active');
      target.setAttribute('data-active', 'true');
    } else if (target.getAttribute('data-active') === 'true') {
      hr_burger.classList.replace("burger-hr-active", "burger-hr");
      container_burger.classList.replace('container-burger-menu-active', 'container-burger-menu');
      target.setAttribute('data-active', 'false');
    }
  }
}



  spans.forEach((span)=>{
    span.addEventListener('click',active_burger);
  })
  btn_burger.addEventListener('click',active_burger);
  













