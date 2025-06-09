function detectExtencionZoneDrop( photo, modal_extHidden){

     let modal_extension= photo.split('.').pop().toLowerCase();

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
}

function detectExtencionChangeInput(file,hiddenInput){

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

const modal_date=document.getElementById('modal-category');
const btn_active_modal= document.querySelectorAll('.category-tilde-btn-edit');
const btn_exit_modal=document.querySelector('.modal-btn-exit');
const body=document.querySelector('body');
const modal_id=document.getElementById('modal-id');
const modal_submit_update=document.getElementById('model-submit-update');
const modal_form=document.getElementById('edit-category-form');
const modal_category=document.querySelector('.modal-category');
const modal_name=document.querySelector('.modal-name');



modal_submit_update.addEventListener('click',(event)=>{
    event.preventDefault();
    const input_text=document.querySelector('.modal-name');
    const input_file=document.getElementById('modal-input-file');


    if(confirm('¿Are you sure you want to submit the form?')) {
        modal_form.submit(); // Envía el formulario si el usuario confirma
    }
});

modal_name.addEventListener('blur',(event)=>{
    const item_name_selected=document.querySelector('.model-name');//esta mal
    const input=event.target.value;
    console.log(input.trim());
    if(input.trim()!=='' && input.length>1 && input.length<19 ){
        item_name_selected.textContent=input;
    }



});








btn_active_modal.forEach((element) => {
    element.addEventListener('click',(event)=>{

       // Abrir el modal
       modal_date.classList.replace('modal-category-no-selected', 'modal-category-selected');
       body.classList.replace('normal-body', 'modal-body');



       // Obtener la imagen dentro del elemento

        const get_img = element.parentElement.parentElement.children[1].firstElementChild.firstElementChild;
        const get_id=element.parentElement.parentElement.children[1].firstElementChild.lastElementChild;
        const get_ext=element.parentElement.parentElement.children[1].firstElementChild;
        const get_ext_complete=get_ext.lastElementChild.getAttribute('data-ext');
       const input_categorry=document.getElementById('extension-modal-category');
       input_categorry.value=get_ext_complete;
        const get_category=get_id.getAttribute('data-category');
       modal_id.value= parseInt(get_id.getAttribute('data-id')) || 0;

       modal_category.value=typeof get_category === "string"?get_category:'';

       // Obtener atributos de la imagen original
       const imgSrc = get_img.getAttribute('src');
       const imgAlt = get_img.getAttribute('alt');

       // Crear nueva imagen y asignar atributos
       const img = document.createElement('img');
       img.setAttribute('class','modal-img');
       img.setAttribute('src', imgSrc);
       img.setAttribute('alt', imgAlt);
       img.setAttribute('width', get_img.width);  // Copia el ancho de la imagen original
       img.setAttribute('height', get_img.height); // Copia la altura de la imagen original
      /*  img.setAttribute('class','model-overflow-hidden')//oculta lo que sobra */
        // Aplicar estilos para que la imagen no se salga del contenedor
        img.style.maxWidth = '100%';   // La imagen nunca será más ancha que el contenedor
        img.style.maxHeight = '100%';  // La imagen nunca será más alta que el contenedor

        img.style.height='100%';
        img.style.width='100%';
       // Obtener el contenedor donde se añadirá la imagen
       const categoryTileModal = document.querySelector('.category-tile-modal');
       /* const input_modal_extencion=document.querySelector('#extension-category');
       detectExtencionZoneDrop(img,input_modal_extencion); //terminar modal extencion */
        // Crear un fragmento para mejor rendimiento
       const fragment = document.createDocumentFragment();

       // Vaciar el contenedor antes de agregar la nueva imagen (opcional)
       categoryTileModal.innerHTML = '';
       const modal_span_name=document.createElement('span');
       modal_span_name.setAttribute('class','item-name model-name');
       modal_span_name.textContent=imgAlt;
       fragment.appendChild(modal_span_name);
/* class="item-name model-name" */

       fragment.appendChild(img);

       // Agregar la imagen al contenedor
       categoryTileModal.appendChild(fragment);

});
});
btn_exit_modal.addEventListener('click',()=>{

    modal_date.classList.replace('modal-category-selected','modal-category-no-selected');
    body.classList.replace( 'modal-body','normal-body');
});

//modal js para drag and  drop


function isImage(file) {
    if (!file) return false;

    const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
    const allowedExtensions = ['png', 'jpg', 'jpeg'];

    const fileTypeValid = allowedTypes.includes(file.type);
    const fileExtensionValid = allowedExtensions.includes(file.name.split('.').pop().toLowerCase());

    return fileTypeValid && fileExtensionValid;
}

const zone=document.getElementById('category-tile-modal-zone');
const fileInput = document.getElementById('modal-input-file');

fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0];

    if (!isImage(file)) {
        alert('Solo se permiten archivos de imagen PNG, JPG o JPEG.');
        return;
    }


    const modal_img=document.querySelector('.modal-img');

    // En lugar de FileReader, usamos un URL temporal
    const objectURL = URL.createObjectURL(file);
    modal_img.src = objectURL;
    modal_img.onload = () => URL.revokeObjectURL(objectURL);
    const inpuExtension=document.getElementById('extension-modal-category');
    detectExtencionZoneDrop( file.name, inpuExtension ); //ver
});
function handleFile(files) {
    if (!isImage(files[0])) {
        alert('Please select an image file.');
        return;
    }

    fileInput.files = files;
    const modal_img=document.querySelector('.modal-img');

    // En lugar de FileReader, usamos un URL temporal
    const objectURL = URL.createObjectURL(files[0]);
    modal_img.src = objectURL;
    modal_img.onload = () => URL.revokeObjectURL(objectURL);
/*     const input_modal_extencion=document.querySelector('#extension-modal-category');
 */
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
/*     const input_modal_extencion=document.querySelector('#extension-category');
 */    img.onload = () => URL.revokeObjectURL(objectURL);
    const fragment=document.createDocumentFragment();
    fragment.appendChild(img);
    div_dad.appendChild(fragment);
    /* detectExtencionZoneDrop(files[0].name,input_modal_extencion); */

}
function handleFile2(files,input, div_dad){
    if (!isImage(files[0])) {
        alert('Please select an image file.');
        return;
    }


    input.files = files;
    insertImg(div_dad ,files);

}




zone.addEventListener('dragenter',(event)=>{
//activar el elemento
});
zone.addEventListener('dragover',(event)=>{
event.preventDefault();
});
zone.addEventListener('drop',(event)=>{
event.preventDefault();
const files=event.dataTransfer.files;
if(files.length>0){
handleFile(files);
const inpuExtension=document.getElementById('extension-modal-category');

detectExtencionZoneDrop( files[0].name, inpuExtension ); //ver

}
});


const   modal_content=document.querySelector('.modal-category-selected-content');
modal_content.addEventListener('click',function (event){
    event.stopPropagation(); // Detiene la propagación del evento al div1

});


const modal_desactiv=document.getElementById('modal-category');
modal_desactiv.addEventListener('click',(event)=>{

    modal_date.classList.replace('modal-category-selected','modal-category-no-selected');
    body.classList.replace( 'modal-body','normal-body');

});

const delete_categoryAll=document.querySelectorAll('#delete-category');
console.log(delete_categoryAll);

delete_categoryAll.forEach((category) => {

    category.addEventListener('click', (event) => {
            event.preventDefault();

        if (confirm('Confirm that you want to remove the item')) {
            const form = event.target.closest('form'); // Busca el formulario más cercano al botón
            if (form) {
                form.submit();
            }
        }

    });

});


/* forEach(delete_categoryAll in category){

    category.addEventListener('click',()=>{

        if(confirm('Confirmas que quieres eliminar el item')){
            form_delete_category.submit();
        }

    });

}
 */

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
        const input_add_category=document.getElementById('extension-category');
        detectExtencionChangeInput(files[0],input_add_category);
        }
        });

    input.addEventListener('change',(event)=>{
    const file = event.target.files[0];
    if (!isImage(file)) {
        alert('Only PNG, JPG, or JPEG image files are allowed.');
        return;
    }
    console.log('Imagen válida:', file.name);
    insertImg(zona_dropeable,event.target.files);
    const input_add_category=document.getElementById('extension-category');
    detectExtencionChangeInput(file,input_add_category);
});
}
//zona add category
const zoneAddCategory=document.querySelector('.photo-add');
const  photoAdd=document.getElementById('file-upload');

addCategory(zoneAddCategory,photoAdd);


//codigo de datalist paara addd category

document.addEventListener("DOMContentLoaded", function () {
    fetch('/home/cooking/get-datalist-category') // Llamamos a la ruta en Laravel
        .then(response => response.json())
        .then(letrasOcupadas => {
            console.log("Letras ocupadas:", letrasOcupadas.letters);
            const datalist = document.getElementById("letters-list");
            const todasLasLetras = "ABCDEFGHIJKLMNOPQRSTUVWXYZ".split(""); // Todas las letras

            // Filtrar letras disponibles
            const letrasDisponibles = todasLasLetras.filter(l => !letrasOcupadas.letters.includes(l));

            // Agregar opciones al datalist
            letrasDisponibles.forEach(letra => {
                let option = document.createElement("option");
                option.value = letra;
                datalist.appendChild(option);
            });

            // Validar la entrada del usuario
            const inputLetter = document.getElementById("letter");
            const errorMessage = document.getElementById("error-message");

            inputLetter.addEventListener("input", function () {
                let letra = this.value.toUpperCase();

                if (letrasOcupadas.letters.includes(letra)) {
                    errorMessage.textContent = "⚠️ This letter is already registered. Try another.";
                    this.style.borderColor = "red";
                } else {
                    errorMessage.textContent = "";
                    this.style.borderColor = "";
                }
            });
        })
        .catch(error => console.error("Error getting letters occupied::", error));




});
