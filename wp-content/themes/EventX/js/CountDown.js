jQuery(document).ready(function($){
    $.getJSON(eventData.root_url + '/wp-json/event/v1/event-date-place/', result => {
        $eventID = result[0].ID;
        $.getJSON(eventData.root_url + '/wp-json/wp/v2/event-date/' + $eventID, results => {
            var countDownDate = new Date(results.date_event).getTime();
        
            var x = setInterval(function(){
                var now = new Date().getTime();
        
                var distance = countDownDate - now;
        
                var days = Math.floor(distance/ (1000 * 60 * 60 * 24));
                var hours = Math.floor(distance % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
                var minutes = Math.floor(distance % (1000 * 60 * 60) / (1000 * 60));
                var seconds = Math.floor(distance % (1000 * 60) / (1000));
        
                document.querySelector('.day').innerHTML = `<span class="date-desc">D</span>${days}`
                document.querySelector('.hour').innerHTML = `<span class="date-desc">H</span>${hours}`
                document.querySelector('.minute').innerHTML = `<span class="date-desc">M</span>${minutes}`
                document.querySelector('.second').innerHTML = `<span class="date-desc">S</span>${seconds}`
        
                if(distance < 0){
                    clearInterval(x);
                    alert('event was expired');
                }
            }, 1000)
        })
    })
})