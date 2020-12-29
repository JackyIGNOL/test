document.addEventListener("DOMContentLoaded",function(){
    //mon script commence ici
    var nav = document.querySelector("nav");
    
    window.addEventListener('scroll',function(){
        /* console.log(window.scrollY); */
        if (window.scrollY < 373) {
            nav.classList.add("bgtransparent");
            nav.classList.remove("bgwhite");
        }
        if (window.scrollY > 373) {
            nav.classList.remove("bgtransparent");
            nav.classList.add("bgwhite");
        }
    })
    
    //mon script s'arrete ici
})