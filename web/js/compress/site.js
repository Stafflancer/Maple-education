$('.slick-arrow').click(function(){
    $('.myVideoClass').each(function(){
        this.contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*')
    });
});