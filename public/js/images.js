$(document).ready(function(){
    $('img.viewable').css('cursor', 'pointer');
    $('img.viewable').click(function(){
        $('body').append('<div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255,255,255,0.75);" onclick="this.remove()"><div style="height: 100%; display: flex; justify-content: center;"><img src="'+$(this).attr('src')+'" style="max-width: 90%; max-height: 90%; margin: auto;"></div></div>');
    });
});
