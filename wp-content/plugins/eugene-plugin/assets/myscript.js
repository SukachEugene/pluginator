
window.addEventListener("load", function(){

    PR.prettyPrint();

    // store tabs variables
    let tabs = this.document.querySelectorAll("ul.nav-tabs > li");

    for( i=0; i < tabs.length; i++) {
        tabs[i].addEventListener("click", switchTab);
    }

    function switchTab(event) {

        event.preventDefault();

        document.querySelector("ul.nav-tabs li.active").classList.remove("active");
        document.querySelector(".tab-pane.active").classList.remove("active");

        let clickedTab = event.currentTarget;
        let anchor = event.target;
        let activePaneID = anchor.getAttribute("href");

        clickedTab.classList.add('active');
        document.querySelector(activePaneID).classList.add("active");
        

    }

});


jQuery(document).ready(function($){

    $(document).on('click', '.js-image-upload', function(e){

        e.preventDefault();
        let $button = $(this);

        let file_frame = wp.media.frames.file_frame = wp.media({

            title: 'Select of Upload an Image',
            library: {
                type: 'image'
            },
            button: {
                text: 'Select Image'
            },
            multiple: false

        });

        file_frame.on('select', function(){

            let attachment = file_frame.state().get('selection').first().toJSON();

            $button.siblings('.image-upload').val(attachment.url);

        });

        file_frame.open();

    });

});