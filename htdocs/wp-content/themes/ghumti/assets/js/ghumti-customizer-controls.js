( function( api ) {

    api.sectionConstructor['upsell'] = api.Section.extend( {

        // No events for this type of section.
        attachEvents: function () {},

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    } );

} )( wp.customize );

jQuery(document).ready(function($) {

    "use strict";

    /**
     * Script for switch option
     */
    $('.switch_options').each(function() {
        //This object
        var obj = $(this);

        var switchPart = obj.children('.switch_part').attr('data-switch');
        var input = obj.children('input'); //cache the element where we must set the value
        var input_val = obj.children('input').val(); //cache the element where we must set the value

        obj.children('.switch_part.'+input_val).addClass('selected');
        obj.children('.switch_part').on('click', function(){
            var switchVal = $(this).attr('data-switch');
            obj.children('.switch_part').removeClass('selected');
            $(this).addClass('selected');
            $(input).val(switchVal).change(); //Finally change the value to 1
        });

    });

    /**
     * Radio Image control in customizer
     */
    // Use buttonset() for radio images.
    $( '.customize-control-radio-image .buttonset' ).buttonset();

    // Handles setting the new value in the customizer.
    $( '.customize-control-radio-image input:radio' ).change(
        function() {

            // Get the name of the setting.
            var setting = $( this ).attr( 'data-customize-setting-link' );

            // Get the value of the currently-checked radio input.
            var image = $( this ).val();

            // Set the new value.
            wp.customize( setting, function( obj ) {

                obj.set( image );
            } );
        }
    );

    /**
      * Function for repeater field
     */
    function ghumti_refresh_repeater_values(){
        $(".ghumti-repeater-field-control-wrap").each(function(){
            
            var values = []; 
            var $this = $(this);
            
            $this.find(".ghumti-repeater-field-control").each(function(){
            var valueToPush = {};   

            $(this).find('[data-name]').each(function(){
                var dataName = $(this).attr('data-name');
                var dataValue = $(this).val();
                valueToPush[dataName] = dataValue;
            });

            values.push(valueToPush);
            });

            $this.next('.ghumti-repeater-collector').val(JSON.stringify(values)).trigger('change');
        });
    }

    $('#customize-theme-controls').on('click','.ghumti-repeater-field-title',function(){
        $(this).next().slideToggle();
        $(this).closest('.ghumti-repeater-field-control').toggleClass('expanded');
    });

    $('#customize-theme-controls').on('click', '.ghumti-repeater-field-close', function(){
        $(this).closest('.ghumti-repeater-fields').slideUp();;
        $(this).closest('.ghumti-repeater-field-control').toggleClass('expanded');
    });

    $("body").on("click",'.ghumti-repeater-add-control-field', function(){

        var fLimit = $(this).parent().find('.field-limit').val();
        var fCount = $(this).parent().find('.field-count').val();
        if( fCount < fLimit ) {
            fCount++;
            $(this).parent().find('.field-count').val(fCount);
        } else {
            $(this).before('<span class="ghumti-limit-msg">Only '+fLimit+' repeater field will be permitted.</span>');
            return;
        }

        var $this = $(this).parent();
        if(typeof $this != 'undefined') {

            var field = $this.find(".ghumti-repeater-field-control:first").clone();
            if(typeof field != 'undefined'){
                
                field.find("input[type='text'][data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });
                
                field.find(".ghumti-repeater-icon-list").each(function(){
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    $(this).prev('.ghumti-repeater-selected-icon').children('i').attr('class','').addClass(defaultValue);
                    
                    $(this).find('li').each(function(){
                        var icon_class = $(this).find('i').attr('class');
                        if(defaultValue == icon_class ){
                            $(this).addClass('icon-active');
                        }else{
                            $(this).removeClass('icon-active');
                        }
                    });
                });

                field.find('.ghumti-repeater-fields').show();

                $this.find('.ghumti-repeater-field-control-wrap').append(field);

                field.addClass('expanded').find('.ghumti-repeater-fields').show(); 
                $('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
                ghumti_refresh_repeater_values();
            }

        }
        return false;
     });
    
    $("#customize-theme-controls").on("click", ".ghumti-repeater-field-remove",function(){
        if( typeof  $(this).parent() != 'undefined'){
            $(this).closest('.ghumti-repeater-field-control').slideUp('normal', function(){
                $(this).remove();
                ghumti_refresh_repeater_values();
            });
        }
        return false;
    });

    $("#customize-theme-controls").on('keyup change', '[data-name]',function(){
        ghumti_refresh_repeater_values();
        return false;
    });

    /*Drag and drop to change order*/
    $(".ghumti-repeater-field-control-wrap").sortable({
        orientation: "vertical",
        update: function( event, ui ) {
            ghumti_refresh_repeater_values();
        }
    });

    $('body').on('click', '.ghumti-repeater-icon-list li', function(){
        var icon_class = $(this).find('i').attr('class');
        $(this).addClass('icon-active').siblings().removeClass('icon-active');
        $(this).parent('.ghumti-repeater-icon-list').prev('.ghumti-repeater-selected-icon').children('i').attr('class','').addClass(icon_class);
        $(this).parent('.ghumti-repeater-icon-list').next('input').val(icon_class).trigger('change');
        ghumti_refresh_repeater_values();
    });

    $('body').on('click', '.ghumti-repeater-selected-icon', function(){
        $(this).next().slideToggle();
    });

    /**
     * MultiCheck box Control JS
     */
    $( 'body' ).on( 'change', '.customize-control-checkbox-multiple input[type="checkbox"]' , function() {

        var new_checkbox_values = $( this ).parents( '.customize-control-checkbox-multiple' ).find( 'input[type="checkbox"]:checked' ).map(function(){
            return $( this ).val();
        }).get().join( ',' );

        $( this ).parents( '.customize-control-checkbox-multiple' ).find( 'input[type="hidden"]' ).val( new_checkbox_values ).trigger( 'change' );
        
    });
    
});