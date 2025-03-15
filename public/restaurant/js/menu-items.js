try {
  


const btn_active_modal= document.querySelectorAll('.items-tilde-btn-edit');
const btn_exit_modal=document.querySelector('.modal-btn-exit');
const modal_desactiv=document.getElementById('modal-category');
const modal_date=document.getElementById('modal-category');
const body=document.querySelector('body');
const  modal_content=document.querySelector('.modal-category-selected-content');

btn_exit_modal.addEventListener('click',()=>{

    modal_date.classList.replace('modal-category-selected','modal-category-no-selected');
    body.classList.replace( 'modal-body','normal-body');
});

modal_desactiv.addEventListener('click',(event)=>{
    console.log("desactivando modal");
    modal_date.classList.replace('modal-category-selected','modal-category-no-selected');
    body.classList.replace( 'modal-body','normal-body');

});
btn_active_modal.forEach((element) => {
    element.addEventListener('click',(event)=>{
       console.log('activando modal');
       // Abrir el modal
       modal_date.classList.replace('modal-category-no-selected', 'modal-category-selected');
       body.classList.replace('normal-body', 'modal-body');
       const modal_number=document.getElementById('modal-number');
      const zone_modal=document.getElementById('category-tile-modal-zone');
      const modal_input_file=document.getElementById('modal-file-upload');
      addCategory(zone_modal, modal_input_file);
      const number=element.parentElement.parentElement.parentElement.parentElement.querySelector(".description").textContent;
      const get_number=number.replace(/\D/g,'');
      console.log(get_number);
      modal_number.value=get_number;
      const title=element.parentElement.parentElement.parentElement.parentElement.querySelector('.menu-item-title');
      const description=element.parentElement.parentElement.parentElement.parentElement.querySelector(".menu-item-details");
      const price=element.parentElement.parentElement.parentElement.querySelector('.menu-item-price').textContent;
      const input_title=document.getElementById('modal-title');
      input_title.value=title.textContent;
      const input_description=document.getElementById('modal-description');
      input_description.value=description.textContent;
      const get_price=price.split('$').pop();
      const input_price=document.getElementById('modal-price');
      input_price.value=get_price;
      console.log(get_price);
       // Obtener la imagen dentro del elemento
      const get_img = element.parentElement.parentElement.querySelector('.img-responsive');
      const get_id=element.parentElement.querySelector('#form-delete-category').querySelector('input[name="id"]');
      const input_id=document.getElementById('item-selected-id');
      const modal_extHidden=document.querySelector('#modal-extHidden');
      const src=get_img.src;
      const  modal_extension=src.split('.').pop().toLowerCase();
      switch(modal_extension){
          case 'jpg':
              modal_extHidden.value=2;
            break;
          case 'jpeg':
              modal_extHidden.value=1;
            break;
          case 'png':
              modal_extHidden.value=3;

            break;
          default:
             modal_extHidden.value=4;
            break;
      }

      
      
      input_id.value=0;
      const div_section_content=document.querySelector('.section-item-form');
      div_section_content.innerHTML="";
      const h3=document.createElement('h3');
      const p=document.createElement('p');
      h3.textContent=title.textContent; 
      p.textContent=description.textContent;
       input_id.value=get_id.value;
      /*  h3.textContent=
       p.textContent= */
      const fragment2=document.createDocumentFragment();
      
      fragment2.appendChild(h3);
      fragment2.appendChild(p);
      div_section_content.appendChild(fragment2);
       
      
      
      
       /*   
        const get_id=element.parentElement.parentElement.children[1].firstElementChild.lastElementChild;

        const get_category=get_id.getAttribute('data-category');
       modal_id.value= parseInt(get_id.getAttribute('data-id')) || 0;
       
       modal_category.value=typeof get_category === "string"?get_category:''; */
       
       // Obtener atributos de la imagen original
        const imgSrc = get_img.getAttribute('src');
       const imgAlt = get_img.getAttribute('alt'); 

       // Crear nueva imagen y asignar atributos
       const img = document.createElement('img');
       img.setAttribute('class','modal-img');
       img.setAttribute('src', imgSrc);
       img.setAttribute('alt', imgAlt); 
       img.setAttribute('width', get_img.width);   // Copia el ancho de la imagen original
       img.setAttribute('height', get_img.height);  // Copia la altura de la imagen original
       img.setAttribute('class','model-overflow-hidden')//oculta lo que sobra */
        // Aplicar estilos para que la imagen no se salga del contenedor
       img.style.maxWidth = '100%';  // La imagen nunca será más ancha que el contenedor
       img.style.maxHeight = '100%';  // La imagen nunca será más alta que el contenedor
         
      /*   img.style.height='100%';
        img.style.width='100%'; */
       // Obtener el contenedor donde se añadirá la imagen
       const categoryTileModal = document.querySelector('.category-tile-modal');

        // Crear un fragmento para mejor rendimiento
       const fragment = document.createDocumentFragment();
  
       // Vaciar el contenedor antes de agregar la nueva imagen (opcional)
       categoryTileModal.innerHTML = '';
      /*  const modal_span_name=document.createElement('span');
       modal_span_name.setAttribute('class','item-name model-name');
       modal_span_name.textContent=imgAlt; */ 
       /* fragment.appendChild(modal_span_name);  */
      /* class="item-name model-name"*/
       
       fragment.appendChild(img);

       // Agregar la imagen al contenedor
       categoryTileModal.appendChild(fragment);


});
});

modal_content.addEventListener('click',function (event){
    event.stopPropagation(); // Detiene la propagación del evento al div1
   
});
const delete_categoryAll=document.querySelectorAll('#delete-item');
console.log(delete_categoryAll);

delete_categoryAll.forEach((category) => {

    category.addEventListener('click', (event) => {
            event.preventDefault();
                
        if (confirm('Confirmas que quieres eliminar el item')) {
            const form = event.target.closest('form'); // Busca el formulario más cercano al botón
            if (form) {
                form.submit();
            }
        }

    });

});

function isImage(file) {
  if (!file) return false;

  const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
  const allowedExtensions = ['png', 'jpg', 'jpeg'];

  const fileTypeValid = allowedTypes.includes(file.type);
  const fileExtensionValid = allowedExtensions.includes(file.name.split('.').pop().toLowerCase());

  return fileTypeValid && fileExtensionValid;
}
function handleFile2(files,input, div_dad){
  if (!isImage(files[0])) {
      alert('Por favor, selecciona un archivo de imagen. Que tenga extension .png .jpg .jpeg');
      return;
  }
 

  input.files = files;
  insertImg(div_dad ,files);

}
function insertImg(div_dad, files){
  div_dad.innerHTML='';
  const img = document.createElement('img');
  // En lugar de FileReader, usamos un URL temporal
  const objectURL = URL.createObjectURL(files[0]);
  img.src = objectURL;
  img.style.maxWidth = '100%';   // La imagen nunca será más ancha que el contenedor
  img.style.maxHeight = '100%';
  img.style.height='200px';
  img.style.width='200px';
  img.onload = () => URL.revokeObjectURL(objectURL);
  const fragment=document.createDocumentFragment();
  fragment.appendChild(img);
  div_dad.appendChild(fragment);
}


function addCategory(zona_dropeable, input){


  zona_dropeable.addEventListener('dragenter',(event)=>{
      //activar el elemento
      });
      zona_dropeable.addEventListener('dragover',(event)=>{
      event.preventDefault();
      });
      zona_dropeable.addEventListener('drop',(event)=>{
      event.preventDefault();
      const files=event.dataTransfer.files;
      if(files.length>0){
        
      handleFile2(files,input, zona_dropeable);
      let hiddenInput = document.getElementById('extHidden');
      let file=files[0];

  if (file) {
    let ext = file.name.split('.').pop().toLowerCase(); // Obtener extensión en minúsculas
    switch (ext) {
      case 'jpeg':
        hiddenInput.value = 1;
        break;
      case 'jpg':
        hiddenInput.value = 2;
        break;
      case 'png':
        hiddenInput.value = 3;
        break;
      default:
        hiddenInput.value = 4; // No permitido o desconocido
        break;
    }
  }


      }
      });

  input.addEventListener('change',(event)=>{
  const file = event.target.files[0];
  if (!isImage(file)) {
      alert('Solo se permiten archivos de imagen PNG, JPG o JPEG.');
      return;
  }
  let hiddenInput = document.getElementById('extHidden');

  if (file) {
    let ext = file.name.split('.').pop().toLowerCase(); // Obtener extensión en minúsculas
    switch (ext) {
      case 'jpeg':
        hiddenInput.value = 1;
        break;
      case 'jpg':
        hiddenInput.value = 2;
        break;
      case 'png':
        hiddenInput.value = 3;
        break;
      default:
        hiddenInput.value = 4; // No permitido o desconocido
        break;
    }
  }




  console.log('Imagen válida:', file.name);
  insertImg(zona_dropeable,event.target.files);
});
}




//zona add category
const zoneAddCategory=document.querySelector('.photo-add');
const  photoAdd=document.getElementById('file-upload');

addCategory(zoneAddCategory,photoAdd);

} 
catch (error) {
  console.info('Js not loading, please login to load js')
  console.log(error);
}
