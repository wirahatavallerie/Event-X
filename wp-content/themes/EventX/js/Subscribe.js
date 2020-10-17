jQuery(document).ready(function($){
    this.emailField = $('.newsletter');
    this.subscribeButton = $('.subscribe-btn');

    this.subscribeButton.on('click', ()=>{
        if(!this.emailField.val()){
            alert('Fill your e-mail first');
        }else{
            var subscriberData = {
                'content': this.emailField.val(),
                'status': 'publish'
            }
            $.ajax({
                beforeSend: (xhr) => {
                    xhr.setRequestHeader('X-WP-Nonce', eventData.nonce)
                },
                url: eventData.root_url + '/wp-json/wp/v2/subscriber/',
                method: 'POST',
                data: subscriberData,
                success: (res) => {
                    alert('Thanks for subscribe')
                },
                error: (err) => {
                    alert('Sorry, subscribing error')
                }
            })
        }
    });
});