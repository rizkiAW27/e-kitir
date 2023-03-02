const pencet = document.querySelector('.pencet');
const pop = document.querySelector('.pop');
pencet = addEventListener('click', function(){
    pop.classList.toggle('status');
    pop.innerHTML = "sukses ";
    function muncul(){
        pop.classList.toggle('status');
        pop.innerHTML = 'sukses';
    }
    setTimeout(muncul, 3000);
});