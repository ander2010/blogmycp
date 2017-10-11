/**
 * Created by ernest on 5/19/2017.
 */
jQuery( document ).ready( function($) {

    /* Editor Toggle Function */
    function fxPb_Editor_Toggle(){
        if( 'templates/page-builder.php' == $( '#page_template' ).val() ){
            $( '#postdivrich' ).hide();
            $( '#fx-page-builder' ).show();
        }
        else{
            $( '#postdivrich' ).show();
            $( '#fx-page-builder' ).hide();
        }
    }

    /* Toggle On Page Load */
    fxPb_Editor_Toggle();

    /* If user change page template drop down */
    $( "#page_template" ).change( function(e) {
        fxPb_Editor_Toggle();
    });

});