/* ==========================================================
 * metabox.js
 * http://enviragallery.com/
 * ==========================================================
 * Copyright 2014 Thomas Griffin.
 *
 * Licensed under the GPL License, Version 2.0 or later (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */
;(function($){
    $(function(){
        // Handle the meta icon helper.
        if ( 0 !== $('.envira-helper-needed').length ) {
            $('<div class="envira-meta-helper-overlay" />').prependTo('#envira-gallery');
        }
        $(document).on('click', '.envira-meta-icon', function(e){
            e.preventDefault();
            var $this     = $(this),
                container = $this.parent(),
                helper    = $this.next();
            if ( helper.is(':visible') ) {
                $('.envira-meta-helper-overlay').remove();
                container.removeClass('envira-helper-active');
            } else {
                if ( 0 === $('.envira-meta-helper-overlay').length ) {
                    $('<div class="envira-meta-helper-overlay" />').prependTo('#envira-gallery');
                }
                container.addClass('envira-helper-active');
            }
        });

        // Handle switching between different gallery types.
        $(document).on('change', 'input[name="_envira_gallery[type]"]:radio', function(e){
            var $this = $(this);
            $('.envira-gallery-type-spinner .envira-gallery-spinner').css({'display' : 'inline-block', 'margin-top' : '-1px'});

            // Prepare our data to be sent via Ajax.
            var change = {
                action:  'envira_gallery_change_type',
                post_id: envira_gallery_metabox.id,
                type:    $this.val(),
                nonce:   envira_gallery_metabox.change_nonce
            };

            // Process the Ajax response and output all the necessary data.
            $.post(
                envira_gallery_metabox.ajax,
                change,
                function(response) {
                    // Append the response data.
                    if ( 'default' == response.type ) {
                        $('#envira-gallery-main').html(response.html);
                        // enviraPlupload();
                    } else {
                        $('#envira-gallery-main').html(response.html);
                    }

                    // Fire an event to attach to.
                    $(document).trigger('enviraGalleryType', response);

                    // Remove the spinner.
                    $('.envira-gallery-type-spinner .envira-gallery-spinner').hide();
                },
                'json'
            );
        });

        // Open up the media manager modal.
        $(document).on('click', '.envira-media-library', function(e){
            e.preventDefault();

            // Show the modal.
            envira_main_frame = true;
            $('#envira-gallery-upload-ui').appendTo('body').show();
        });

        
        // Set a flag detecting whether the shift key is held or not
        // Used in the Mark image(s) as selected routine below
        var envira_shift_key_held = false;
        $(document).on( 'keyup keydown', function( e ) {
            envira_shift_key_held = e.shiftKey;
        } );

        // Mark image(s) as selected when clicked in the library view
        var envira_selected_attachment_id;
        $( '.envira-gallery-gallery' ).on( 'click', '.thumbnail, .check, .media-modal-icon', function( e ) {
            e.preventDefault();

            var attachment = $( this ).parent().parent();

            // If the image is already selected and in this Gallery, bail
            if ( $( attachment ).hasClass( 'envira-gallery-in-gallery' ) ) {
                return;
            }

            // Select or deselect image
            if ( $( attachment ).hasClass( 'selected' ) ) {
                // Deselect
                $( attachment ).removeClass( 'details selected' );

                // Remove from selection view
                $( 'div.selection-view ul li[data-attachment-id="' + $( attachment ).attr( 'data-attachment-id') + '"]' ).remove();

            } else {
                // Select
                $( attachment ).addClass( 'details selected' );

                // Add to selection view
                $( attachment ).clone().appendTo( $( 'div.selection-view ul' ) ).removeClass( 'details selected' );
                
                // If the shift key is pressed when the user clicked on an image, and we have an existing image selected,
                // select all images between this image and the previously selected image
                if( envira_shift_key_held === true && $( '.envira-gallery-gallery li.selected' ).not( '.envira-gallery-in-gallery').length > 1 ) {
                    // Shift key was held and we've selected a second image
                    
                    // Get previously selected image
                    var start_attachment = $( "li.attachment[data-attachment-id='" + envira_selected_attachment_id + "']");

                    // Iterate through each attachment until we reach the current attachment
                    var finished_selection = false;
                    while ( ! finished_selection ) {
                        start_attachment = $( start_attachment ).next();

                        // If this attachment is our current attachment, bail
                        if ( $( start_attachment ).data( 'attachment-id' ) === $( attachment ).data( 'attachment-id' ) ) {
                            finished_selection = true;
                        }

                        // Mark this attachment as selected
                        $( start_attachment ).addClass( 'details selected' );

                        // Add to selection view
                        $( start_attachment ).clone().appendTo( $( 'div.selection-view ul' ) ).removeClass( 'details selected' );
                    }
                    
                }

                // Update last selected attachment
                envira_selected_attachment_id = $( attachment ).data( 'attachment-id' );
            }

            // Update selected count
            var attachments_count = $( '.envira-gallery-gallery li.selected' ).not( '.envira-gallery-in-gallery').length;
            $( 'div.media-modal span.count span.number' ).text( attachments_count );

        });

        // Clear selected images in the active window when the clear button is clicked
        $( 'div.media-modal' ).on( 'click', 'a.clear-selection', function( e ) {
            // Get the addon that's active
            var envira_addon_active = $( '.media-router a.active' ).data( 'envira-gallery-content' );
            
            // Remove all selected attachments not already in this Envira Gallery, for this addon / core
            $( '#envira-gallery-' + envira_addon_active + ' li.selected' ).not( '.envira-gallery-in-gallery' ).removeClass( 'details selected' );

            // Remove all selected attachments from the selection view
            $( 'div.selection-view ul li' ).remove();
       
            // Reset count
            $( 'div.media-modal span.count span.number' ).text( '0' );
        } );

        // Load more images into the library view when the 'Load More Images from Library'
        // button is pressed
        $(document).on('click', 'a.envira-gallery-load-library', function(e){
            enviraLoadLibraryImages( $('a.envira-gallery-load-library').attr('data-envira-gallery-offset') );
        });

        // Load more images into the library view when the user scrolls to the bottom of the view
        // Honours any search term(s) specified
        $('.envira-gallery-gallery').bind('scroll', function() {
            if( $(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight ) {
                enviraLoadLibraryImages( $('a.envira-gallery-load-library').attr('data-envira-gallery-offset') );
            }
        });

        // Load images when the search term changes
        $(document).on('keyup keydown', '#envira-gallery-gallery-search', function() {
            delay(function() {
                enviraLoadLibraryImages( 0 );
            }); 
        });

        /**
        * Makes an AJAX call to get the next batch of images
        */
        function enviraLoadLibraryImages( offset ) {
            // Show spinner
            $('.media-toolbar-secondary span.envira-gallery-spinner').css('visibility','visible');

            // AJAX call to get next batch of images
            $.post(
                envira_gallery_metabox.ajax,
                {
                    action:  'envira_gallery_load_library',
                    offset:  offset,
                    post_id: envira_gallery_metabox.id,
                    search:  $('input#envira-gallery-gallery-search').val(),
                    nonce:   envira_gallery_metabox.load_gallery
                },
                function(response) {
                    // Update offset
                    $('a.envira-gallery-load-library').attr('data-envira-gallery-offset', ( Number(offset) + 20 ) );

                    // Hide spinner
                    $('.media-toolbar-secondary span.envira-gallery-spinner').css('visibility','hidden');

                    // Append the response data.
                    if ( offset === 0 ) {
                        // New search, so replace results
                        $('.envira-gallery-gallery').html( response.html );    
                    } else {
                        // Append to end of results
                        $('.envira-gallery-gallery').append( response.html );
                    }
                    
                },
                'json'
            );
        }

        // Process inserting media into the Gallery when the Insert button is pressed.
        $(document).on('click', '.envira-gallery-media-insert', function(e){
            e.preventDefault();
            var $this = $(this),
                text  = $(this).text(),
                data  = {
                    action: 'envira_gallery_insert_images',
                    nonce:   envira_gallery_metabox.insert_nonce,
                    post_id: envira_gallery_metabox.id,
                    images: {}
                },
                selected = false,
                insert_e = e;
            $this.text(envira_gallery_metabox.inserting);

            // Loop through tabs and store their data
            $( '.envira-gallery-media-frame .media-router a' ).each( function() {
                // Media Library Images
                if ( $( this ).data( 'envira-gallery-content' ) == 'select-images') {
                    $( '.envira-gallery-media-frame' ).find( '.attachment.selected:not(.envira-gallery-in-gallery)' ).each( function( i, el ){
                        data.images[i] = $( el ).attr( 'data-attachment-id' );
                        selected       = true;
                    });
                } else {
                    // Non-Media Library
                    // The modal tab container with the content we want
                    var addon_name = $( this ).data( 'envira-gallery-content' );
                    var modal_container = $( '#envira-gallery-' + addon_name );
                    
                    // Create object for this addon
                    data[ addon_name ] = {};

                    // Content in the container will be either form fields or a grid of attachments
                    if ( $( 'ul.attachments', $( modal_container ) ).length > 0 ) {
                        // Get selected items and store them in the object
                        $( modal_container ).find( '.attachment.selected' ).each( function( i, el ) {
                            data[ addon_name ][i] = $( el ).attr( 'data-attachment-id' );
                        });
                    } else {
                        // Form fields
                        // Iterate through form field rows
                        $( modal_container ).find( '.envira-gallery-form-fields' ).each(function(i, el) {
                            // Itereate through form fields in row
                            data[ addon_name ][ i ] = {};
                            $( 'input,select,textarea', $( this ) ).each( function( j ) {
                                data[ addon_name ][ i ][ $(this).attr('class') ] = $( this ).val();
                            } );
                        });
                    }

                }
            });

            // Send the ajax request with our data to be processed.
            $.post(
                envira_gallery_metabox.ajax,
                data,
                function(response){
                    // Set small delay before closing modal.
                    setTimeout(function(){
                        // Re-append modal to correct spot and revert text back to default.
                        append_and_hide(insert_e);
                        $this.text(text);

                        // If we have selected items, be sure to properly load first images back into view.
                        if ( selected ) {
                            $('.envira-gallery-load-library').attr('data-envira-gallery-offset', 0).addClass('has-search').trigger('click');
                        }
                    }, 500);
                },
                'json'
            );

        });

        // Change content areas and active menu states on media router click.
        $(document).on('click', '.envira-gallery-media-frame .media-menu-item', function(e){
            e.preventDefault();
            var $this       = $(this),
                old_content = $this.parent().find('.active').removeClass('active').data('envira-gallery-content'),
                new_content = $this.addClass('active').data('envira-gallery-content');
            $('#envira-gallery-' + old_content).hide();
            $('#envira-gallery-' + new_content).show();
        });

        // Make gallery items sortable.
        var gallery = $('#envira-gallery-output');

        // Use ajax to make the images sortable.
        gallery.sortable({
            containment: '#envira-gallery-output',
            items: 'li',
            cursor: 'move',
            forcePlaceholderSize: true,
            placeholder: 'dropzone',
            update: function(event, ui) {
                // Make ajax request to sort out items.
                var opts = {
                    url:      envira_gallery_metabox.ajax,
                    type:     'post',
                    async:    true,
                    cache:    false,
                    dataType: 'json',
                    data: {
                        action:  'envira_gallery_sort_images',
                        order:   gallery.sortable('toArray').toString(),
                        post_id: envira_gallery_metabox.id,
                        nonce:   envira_gallery_metabox.sort
                    },
                    success: function(response) {
                        return;
                    },
                    error: function(xhr, textStatus ,e) {
                        return;
                    }
                };
                $.ajax(opts);
            }
        });

        // Select / deselect images
        $('a.envira-gallery-images-delete').fadeOut();
        $('ul#envira-gallery-output').on('click', 'li.envira-gallery-image > img', function() {
            var gallery_item = $(this).parent();

            if ($(gallery_item).hasClass('selected')) {
                $(gallery_item).removeClass('selected');
            } else {
                $(gallery_item).addClass('selected');
            }
            
            // Show/hide 'Deleted Selected Images from Album' button depending on whether
            // any galleries have been selected
            if ($('ul#envira-gallery-output > li.selected').length > 0) {
                $('a.envira-gallery-images-delete').fadeIn();  
            } else {
                $('a.envira-gallery-images-delete').fadeOut();  
            }
        });

        // Delete multiple images from gallery
        $('a.envira-gallery-images-delete').click(function(e) {
            e.preventDefault();

            // Bail out if the user does not actually want to remove the image.
            var confirm_delete = confirm(envira_gallery_metabox.remove_multiple);
            if ( ! confirm_delete ) {
                return false;
            }

            // Build array of image attachment IDs
            var attach_ids = [];
            $('ul#envira-gallery-output > li.selected').each(function() {
                attach_ids.push($(this).attr('id'));
            });

            // Prepare our data to be sent via Ajax.
            var remove = {
                action:        'envira_gallery_remove_images',
                attachment_ids:attach_ids,
                post_id:       envira_gallery_metabox.id,
                nonce:         envira_gallery_metabox.remove_nonce
            };

            // Process the Ajax response and output all the necessary data.
            $.post(
                envira_gallery_metabox.ajax,
                remove,
                function(response) {
                    // Remove each image
                    $('ul#envira-gallery-output > li.selected').each(function() {
                        $(this).fadeOut('normal', function() {
                            $(this).remove();
                        });
                    });

                    // Hide Delete Button
                    $('a.envira-gallery-images-delete').fadeOut();

                    // Refresh the modal view to ensure no items are still checked if they have been removed.
                    $('.envira-gallery-load-library').attr('data-envira-gallery-offset', 0).addClass('has-search').trigger('click');
                },
                'json'
            );
        });

        // Process image removal from a gallery.
        $('#envira-gallery').on('click', '.envira-gallery-remove-image', function(e){
            e.preventDefault();

            // Bail out if the user does not actually want to remove the image.
            var confirm_delete = confirm(envira_gallery_metabox.remove);
            if ( ! confirm_delete )
                return;

            // Prepare our data to be sent via Ajax.
            var attach_id = $(this).parent().attr('id'),
                remove = {
                    action:        'envira_gallery_remove_image',
                    attachment_id: attach_id,
                    post_id:       envira_gallery_metabox.id,
                    nonce:         envira_gallery_metabox.remove_nonce
                };

            // Process the Ajax response and output all the necessary data.
            $.post(
                envira_gallery_metabox.ajax,
                remove,
                function(response) {
                    $('#' + attach_id).fadeOut('normal', function() {
                        $(this).remove();

                        // Refresh the modal view to ensure no items are still checked if they have been removed.
                        $('.envira-gallery-load-library').attr('data-envira-gallery-offset', 0).addClass('has-search').trigger('click');
                    });
                },
                'json'
            );
        });

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

        // Append spinner when importing a gallery.
        $('#envira-gallery-import-submit').on('click', function(e){
            $(this).next().css('display', 'inline-block');
            if ( $('#envira-config-import-gallery').val().length === 0 ) {
                e.preventDefault();
                $(this).next().hide();
                alert(envira_gallery_metabox.import);
            }
        });

        // Polling function for typing and other user centric items.
        var delay = (function() {
            var timer = 0;
            return function(callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();

        // Close the modal window on user action.
        var envira_main_frame = false;
        var append_and_hide = function(e){
            e.preventDefault();
            $('#envira-gallery-upload-ui').appendTo('#envira-gallery-upload-ui-wrapper').hide();
            enviraRefresh();
            envira_main_frame = false;
        };
        $(document).on('click', '#envira-gallery-upload-ui .media-modal-close, #envira-gallery-upload-ui .media-modal-backdrop', append_and_hide);
        $(document).on('keydown', function(e){
            if ( 27 == e.keyCode && envira_main_frame )
                append_and_hide(e);
        });

        // Function to refresh images in the gallery.
        function enviraRefresh(){
            var data = {
                action:  'envira_gallery_refresh',
                post_id: envira_gallery_metabox.id,
                nonce:   envira_gallery_metabox.refresh_nonce
            };

            $('.envira-media-library').after('<span class="spinner envira-gallery-spinner envira-gallery-spinner-refresh"></span>');
            $('.envira-gallery-spinner-refresh').css({'display' : 'inline-block', 'margin-top' : '-3px'});

            $.post(
                envira_gallery_metabox.ajax,
                data,
                function(res){
                    if ( res && res.success ) {
                        $('#envira-gallery-output').html(res.success);
                        $('#envira-gallery-output').find('.wp-editor-wrap').each(function(i, el){
                            var qt = $(el).find('.quicktags-toolbar');
                            if ( qt.length > 0 ) {
                                return;
                            }

                            var arr = $(el).attr('id').split('-'),
                                id  = arr.slice(4, -1).join('-');
                            quicktags({id: 'envira-gallery-caption-' + id, buttons: 'strong,em,link,ul,ol,li,close'});
                            QTags._buttonsInit(); // Force buttons to initialize.
                        });

                        // Trigger a custom event for 3rd party scripts.
                        $('#envira-gallery-output').trigger({ type: 'enviraRefreshed', html: res.success, id: envira_gallery_metabox.id });
                    }

                    // Remove the spinner.
                    $('.envira-gallery-spinner-refresh').fadeOut(300, function(){
                        $(this).remove();
                    });
                },
                'json'
            );
        }

        /**
        * Conditional Fields
        */
        $('input[data-envira-conditional], select[data-envira-conditional]').each(function() {
            enviraConditionalElement(this);
        });
        $('input[data-envira-conditional], select[data-envira-conditional]').change(function() {
            enviraConditionalElement(this);
        });
        function enviraConditionalElement(element) {
            // data-envira-conditional may have multiple element IDs specified
            var conditionalElements = $(element).data('envira-conditional').split(',');
            var displayElements = false;
            
            // Determine whether to display relational elements or not
            switch ($(element).attr('type')) {
                case 'checkbox':
                    displayElements = $(element).is(':checked');
                    break;
                default:
                    displayElements = (($(element).val() == '' || $(element).val() == 0) ? false : true);
                    break;
            } 
            
            // Show/hide elements
            for (var i = 0; i < conditionalElements.length; i++) {
                if (displayElements) {
                    $('#' + conditionalElements[i]).fadeIn(300);
                } else {
                    $('#' + conditionalElements[i]).fadeOut(300);
                }
            }
        }
    });
}(jQuery));