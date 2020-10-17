
jQuery(document).ready(function($){
    $('.slider-img').on('mouseenter', (e) => {
        var divSlider = $(e.target).parent('div.slider-img');
        var id = divSlider.attr('data-id')
        
        $.getJSON(eventData.root_url + '/wp-json/wp/v2/slider/' + id , results => {
                var music = new Audio(results.slider_media.url);
                music.play()
                $('.slider-img').on('mouseout', () => {
                    music.pause()
                })
            });
            
    });

})