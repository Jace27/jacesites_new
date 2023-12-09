$('.header').on("click", function(event){
    elem = event.currentTarget.parentNode.lastElementChild;
    if(elem.style.display != "block"){
        elem.style.display = "block";
        event.currentTarget.style.backgroundImage = "url('/images/system/light_arrow_open.gif')";
    } else {
        elem.style.display = "none";
        event.currentTarget.style.backgroundImage = "url('/images/system/light_arrow_shut.gif')";
    }
    localStorage.setItem('menu', $('#menu').html());
});
