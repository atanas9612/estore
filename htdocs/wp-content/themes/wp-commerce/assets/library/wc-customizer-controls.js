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

        obj.children('.switch_part').on('click', function(){
            var switchVal = $(this).attr('data-switch');
            obj.children('.switch_part').removeClass('selected');
            $(this).addClass('selected');
            obj.children('input').val(switchVal).change();
        });

    });

   
    /**
      * Function for repeater field
     */
    function wp_commerce_refresh_repeater_values(){
        $(".wc-repeater-field-control-wrap").each(function(){
            
            var values = []; 
            var $this = $(this);
            
            $this.find(".wc-repeater-field-control").each(function(){
            var valueToPush = {};   

            $(this).find('[data-name]').each(function(){
                var dataName = $(this).attr('data-name');
                var dataValue = $(this).val();
                valueToPush[dataName] = dataValue;
            });

            values.push(valueToPush);
            });

            $this.next('.wc-repeater-collector').val(JSON.stringify(values)).trigger('change');
        });
    }

    $('#customize-theme-controls').on('click','.wc-repeater-field-title',function(){
        $(this).next().slideToggle();
        $(this).closest('.wc-repeater-field-control').toggleClass('expanded');
    });

    $('#customize-theme-controls').on('click', '.wc-repeater-field-close', function(){
        $(this).closest('.wc-repeater-fields').slideUp();;
        $(this).closest('.wc-repeater-field-control').toggleClass('expanded');
    });

    $("body").on("click",'.wc-repeater-add-control-field', function(){

        var fLimit = $(this).parent().find('.field-limit').val();
        var fCount = $(this).parent().find('.field-count').val();
        if( fCount < fLimit ) {
            fCount++;
            $(this).parent().find('.field-count').val(fCount);
        } else {
            $(this).before('<span class="wc-limit-msg"><em>Only '+fLimit+' repeater field will be permitted.</em></span>');
            return;
        }

        var $this = $(this).parent();
        if(typeof $this != 'undefined') {

            var field = $this.find(".wc-repeater-field-control:first").clone();
            if(typeof field != 'undefined'){
                
                field.find("input[type='text'][data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });
                
                field.find(".wc-repeater-icon-list").each(function(){
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    $(this).prev('.wc-repeater-selected-icon').children('i').attr('class','').addClass(defaultValue);
                    
                    $(this).find('li').each(function(){
                        var icon_class = $(this).find('i').attr('class');
                        if(defaultValue == icon_class ){
                            $(this).addClass('icon-active');
                        }else{
                            $(this).removeClass('icon-active');
                        }
                    });
                });

                field.find(".attachment-media-view").each(function(){
                    var defaultValue = $(this).find('input[data-name]').attr('data-default');
                    $(this).find('input[data-name]').val(defaultValue);
                    if(defaultValue){
                        $(this).find(".thumbnail-image").html('<img src="'+defaultValue+'"/>').prev('.placeholder').addClass('hidden');
                    }else{
                        $(this).find(".thumbnail-image").html('').prev('.placeholder').removeClass('hidden');   
                    }
                });

                field.find('.wc-repeater-fields').show();

                $this.find('.wc-repeater-field-control-wrap').append(field);

                field.addClass('expanded').find('.wc-repeater-fields').show(); 
                $('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
                wp_commerce_refresh_repeater_values();
            }

        }
        return false;
     });
    
    $("#customize-theme-controls").on("click", ".wc-repeater-field-remove",function(){
        if( typeof  $(this).parent() != 'undefined'){
            $(this).closest('.wc-repeater-field-control').slideUp('normal', function(){
                $(this).remove();
                wp_commerce_refresh_repeater_values();
            });
        }
        return false;
    });

    $("#customize-theme-controls").on('keyup change', '[data-name]',function(){
        wp_commerce_refresh_repeater_values();
        return false;
    });

    /*Drag and drop to change order*/
    $(".wc-repeater-field-control-wrap").sortable({
        orientation: "vertical",
        update: function( event, ui ) {
            wp_commerce_refresh_repeater_values();
        }
    });

    $('body').on('click', '.wc-repeater-icon-list li', function(){
        var icon_class = $(this).find('i').attr('class');
        $(this).addClass('icon-active').siblings().removeClass('icon-active');
        $(this).parent('.wc-repeater-icon-list').prev('.wc-repeater-selected-icon').children('i').attr('class','').addClass(icon_class);
        $(this).parent('.wc-repeater-icon-list').next('input').val(icon_class).trigger('change');
        wp_commerce_refresh_repeater_values();
    });

    $('body').on('click', '.wc-repeater-selected-icon', function(){
        $(this).next().slideToggle();
    });


});