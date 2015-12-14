/**
* Handles media editing functionality, including displaying the
* modal editor window and saving changes to image metadata
*/
jQuery( document ).ready( function( $ ) {
	 // Vars to store previous and next attachment IDs when the modal editor is open
    var attachmentIDs = [];
        
    // Open up the media modal area for modifying gallery metadata when clicking the info icon
    $('#envira-gallery').on('click.enviraModify', '.envira-gallery-modify-image', function(e){
        e.preventDefault();
        var attach_id = $(this).parent().data('envira-gallery-image'),
            formfield = 'envira-gallery-meta-' + attach_id;
            
        // Get attachment IDs in order, so we can cycle through them using previous/next functionality
        attachmentIDs = [];
        $('ul#envira-gallery-output li').each(function() {
            attachmentIDs.push($(this).data('envira-gallery-image')); 
        });
        
        // Open modal
        openModal(attach_id, formfield);    
    });
    
    // Open modal when left or right button clicked
    $(document).on('click', 'button.left, button.right', function(e){
        e.preventDefault();
        
        // Close current modal
        closeModal();
        
        // Get attachment id and form field
        var attach_id = $(this).attr('data-attachment-id'),
            formfield = 'envira-gallery-meta-' + attach_id;
        
        // Open new modal
        openModal(attach_id, formfield);
    });
    
    // Open modal
    var modal;
    var openModal = function(attach_id, formfield) {
        
        // Show the modal.
        modal = $('#' + formfield).appendTo('body');
        $(modal).show();
        
        // Enable left and right navigation by default in the modal
        $('button.left', $(modal)).removeClass('disabled');
        $('button.right', $(modal)).removeClass('disabled');
        
        // Get index of this attachment in array
        // IE compatible
        var attachmentIDIndex = -1;
        for (var i = 0; i < attachmentIDs.length; i++) {
            if (attachmentIDs[i] == attach_id) {
                attachmentIDIndex = i;
                break;
            }
        }
        
        if (attachmentIDIndex == 0) {
            // At the start of the attachment list
            // Disable left button
            $('button.left', $(modal)).addClass('disabled');
            $('button.left', $(modal)).attr('data-attachment-id', '');
            
            // Enable right button, if we have more than one attachment
            if (attachmentIDs.length > 1) {
                $('button.right', $(modal)).removeClass('disabled');
                $('button.right', $(modal)).attr('data-attachment-id', attachmentIDs[(attachmentIDIndex+1)]);
            } else {
                $('button.right', $(modal)).addClass('disabled');
                $('button.right', $(modal)).attr('data-attachment-id', '');
            }
        } else if (attachmentIDIndex == (attachmentIDs.length - 1)) {
            // At the start of the attachment list
            // Enable left button
            $('button.left', $(modal)).removeClass('disabled');
            $('button.left', $(modal)).attr('data-attachment-id', attachmentIDs[(attachmentIDIndex-1)]);
            
            // Disable right button
            $('button.right', $(modal)).addClass('disabled');
            $('button.right', $(modal)).attr('data-attachment-id', '');
        } else {
            // Enable left and right buttons
            $('button.left', $(modal)).removeClass('disabled');
            $('button.left', $(modal)).attr('data-attachment-id', attachmentIDs[(attachmentIDIndex-1)]);
            $('button.right', $(modal)).removeClass('disabled');
            $('button.right', $(modal)).attr('data-attachment-id', attachmentIDs[(attachmentIDIndex+1)]);
        }
        
        // Close modal on close button or background click
        $(document).on('click.enviraIframe', '.media-modal-close, .media-modal-backdrop', function(e) {
            e.preventDefault();
            closeModal();
        });
        
        // Close modal on esc keypress
        $(document).on('keydown.enviraIframe', function(e) {
            if ( 27 == e.keyCode ) {
                closeModal();    
            }
        });
    }
    
    // Close modal
    var closeModal = function() {
        // Get modal
        var formfield = $(modal).attr('id');
        var formfieldArr = formfield.split('-');
        var attach_id = formfieldArr[(formfieldArr.length-1)];
            
        // Close modal
        $('#' + formfield).appendTo('#' + attach_id).hide();
        envira_main_frame = false;
        $(document).off('click.enviraLink');
    }
    
    /**
    * Link Search
    */
    // Search: Init
    var searchTimer;

    // Search: Hide query results by default to avoid border displaying
    $( 'div.media-modal-content div.query-results' ).hide();

    // Search: Run search on input keyup
    $( document ).on( 'keyup', 'div.media-modal-content input#wp-link-search', function() {
        var self = this;
        window.clearTimeout( searchTimer );
        searchTimer = window.setTimeout( function() {
            wpLink.searchInternalLinks.call( self );
        }, 500 );
    });

    // Search: Store URL when Page/Post clicked from search results
    $( document ).on( 'click', 'div.media-modal-content div.query-results li', function(e) {
        // Get url from hidden field
        var url = $( 'input[type=hidden]', $(this) ).val();
        
        // Get modal
        var formfield = $(modal).attr( 'id' );
        var formfieldArr = formfield.split( '-' );
        var attach_id = formfieldArr[ ( formfieldArr.length-1 ) ];
        
        // Update URL field
        $( 'input#envira-gallery-link-' + attach_id ).val( url );

        // Clear results and hide
        $( this ).parent().html( '' ).parent().hide();
    });
    
    // Search: Hide results when clearing results
    $( 'div.media-modal-content input#wp-link-search' ).change( function() {
        if ( $(this).val() == '' ) {
            $( '.query-results ul' ).html( '' );
        }  
    } );
    // Search: Hide when cross clicked in search
    $( document ).on( 'click', 'div.media-modal-content input#wp-link-search', function() {
        var self = this;
        window.clearTimeout( searchTimer );
        searchTimer = window.setTimeout( function() {
            if ( $( self ).val() == '' ) {
                $( '.query-results ul' ).html( '' ).parent().hide();
            }
        }, 500 );
    });
          
    // Save the gallery metadata.
    $(document).on('click', '.envira-gallery-meta-submit', function(e){
        e.preventDefault();
        var $this     = $(this),
            default_t = $this.text(),
            attach_id = $this.data('envira-gallery-item'),
            formfield = 'envira-gallery-meta-' + attach_id,
            meta      = {},
            spinner   = $('span.settings-save-status span.spinner'),
            saved     = $('span.settings-save-status span.saved');

        // Change submit button = Saving
        // Display saving spinner
        $this.text(envira_gallery_metabox.saving);
        $this.attr('disabled','disabled');
        $(spinner).show();

        // Add the title since it is a special field.
        meta.caption = $('#envira-gallery-meta-table-' + attach_id).find('textarea[name="_envira_gallery[meta_caption]"]').val();

        // Get all meta fields and values.
        $('#envira-gallery-meta-table-' + attach_id).find(':input').not('.ed_button').each(function(i, el){
            if ( $(this).data('envira-meta') ) {
                meta[$(this).data('envira-meta')] = $(this).val();
            
                // Checkbox: check to see if checked to determine value
                if ( $(this).attr('type') == 'checkbox' ) {
                    if ( $(this).attr('checked') ) {
                        meta[$(this).data('envira-meta')] = $(this).val();
                    } else {
                        meta[$(this).data('envira-meta')] = 0;
                    }   
                }
            }
        });

        // Prepare the data to be sent.
        var data = {
            action:    'envira_gallery_save_meta',
            nonce:     envira_gallery_metabox.save_nonce,
            attach_id: attach_id,
            post_id:   envira_gallery_metabox.id,
            meta:      meta
        };

        $.post(
            envira_gallery_metabox.ajax,
            data,
            function(res){
                // Hide spinner, show saved text, revert button back to default state
                $this.text(default_t);
                $this.attr('disabled',false);
                $(spinner).fadeOut('slow', function() {
                    $(saved).fadeIn('fast', function() {
                        setTimeout(function(){
                            $(saved).fadeOut('slow');
                        }, 500);    
                    });    
                });
            },
            'json'
        );
    });
} );