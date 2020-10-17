window.onload = ()=>{
    document.querySelector('.bar-btn').addEventListener('click', () =>{
        document.querySelector('.side-bar').classList.add('visible');
    });

    document.querySelector('.close-btn-sidebar').addEventListener('click', () => {
        document.querySelector('.side-bar').classList.remove('visible');
    });
}

// jQuery(document).ready(function($){
//     this.openSidebar = $('.sidebar');
//     this.closeSidebar = $('.close-btn-sidebar');
//     this.sidebar = $('.side-bar');

//     this.openSidebar.on('click', () =>{
//        this.sidebar.classList.add('visible');
//     });

//     document.querySelector('.close-btn-sidebar').addEventListener('click', () => {
//         document.querySelector('.side-bar').classList.remove('visible');
//     });
// })