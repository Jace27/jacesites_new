let pages = $('.tab_page');
if (pages.length > 1){
    for (let i = 1; i < pages.length; i++) {
        $(pages[i]).css('display', 'none');
    }
}

$('.tabs_header_page').click(function(e){
    for (let i = 0; i < pages.length; i++){
        if (pages[i].id.substring(5, pages[i].id.length) == e.target.id.substring(7, e.target.id.length)){
            $(pages[i]).css('display', 'block');
        } else {
            $(pages[i]).css('display', 'none');
        }
    }
    let headers = $('.tabs_header_page');
    for (let i = 0; i < headers.length; i++){
        if (headers[i].id == e.target.id){
            headers[i].style.fontWeight = '900';
        } else {
            headers[i].style.fontWeight = '500';
        }
    }
});