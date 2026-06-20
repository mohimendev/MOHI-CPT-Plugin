


// Admin Js

( function () {

    // Portfolio copy button
    var portfolioBtn = document.getElementById( 'mohi-portfolio-copy-btn' );
    if ( portfolioBtn ) {
        portfolioBtn.addEventListener( 'click', function () {
            mohiHandleCopy( portfolioBtn, 'mohi-portfolio-sc' );
        } );
    }

    // Testimonial copy button
    var testimonialBtn = document.getElementById( 'mohi-testimonial-copy-btn' );
    if ( testimonialBtn ) {
        testimonialBtn.addEventListener( 'click', function () {
            mohiHandleCopy( testimonialBtn, 'mohi-testimonial-sc' );
        } );
    }

    function mohiHandleCopy( btn, targetId ) {
        var text = document.getElementById( targetId ).innerText;
        navigator.clipboard.writeText( text ).then( function () {
            var original = btn.innerText;
            btn.innerText = mohiCptAdmin.copied;
            btn.style.background  = '#46b450';
            btn.style.color       = '#fff';
            btn.style.borderColor = '#46b450';
            setTimeout( function () {
                btn.innerText     = original;
                btn.style.background  = '';
                btn.style.color       = '';
                btn.style.borderColor = '';
            }, 1500 );
        } );
    }

} )();