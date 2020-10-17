jQuery(document).ready(function($){
    this.openOverlay = $('.read-more');
    this.closeOverlay = $('.close-btn');
    this.overlay = $('.background');

    this.openOverlay.on('click', (e)=> {
        const newsID = e.target.getAttribute('data-id');
        document.querySelector('.background').classList.add('visible');
        document.querySelector('.side-bar').classList.remove('visible');
        getResults(newsID);
    });
    this.closeOverlay.on('click', ()=>{
        document.querySelector('.background').classList.remove('visible');
        document.querySelector('.content').innerHTML = ''
    });

    function getResults(newsID){
        $.getJSON(eventData.root_url + '/wp-json/wp/v2/new/' + newsID, results => {
            document.querySelector('.content').innerHTML = ` 
                <div class="new-overlay">
                    <div class="new-date-circle">
                        <div class="month">${results.month}</div>
                        <div class="date">${results.day}</div>
                    </div>
                    <div class="new-title">${results.title.rendered}</div>
                    <div class="new-content-overlay">
                        ${results.content.rendered}
                    </div>
                </div>
            `
        })
    }
})