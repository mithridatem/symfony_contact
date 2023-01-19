//récupération input
const test = document.querySelector('#contact_prenomContact');
//récupération button
const bt = document.querySelector('#contact_show');
//boolean change
let active = true;
 bt.addEventListener('click', ()=>{
    if(active){
        test.type = 'text';
        bt.textContent = 'hide';
        active = false;
    }
    else{
        test.type = 'password';
        bt.textContent = 'show';
        active = true;
    }
 });
