<?php
    /* HUBSPOT FORM TEMPLATE
    *
    * Base hubspot form template,
    * you may want to keep this file dumb
    * by passing the required data in.
    *
    * Define required variables
    *
    * $form_id               = $hubspot_form_id;
    * $redirect_url          = $hubspot_form_download['url'];
    * $inline_message        = 'Thank you. Your download will open in a new tab.
    * If you have pop up blocker active ensure you allow popups on this website.';
    * $open_in_new_tab       =  true;
    * $submit_button_class   =  ' ';
    */
?>

<?php if ( defined( 'HUBSPOT_PORTAL_ID' ) && !empty( HUBSPOT_PORTAL_ID ) && !empty( $form_id ) ): ?>

<?php
    $open_in_new_tab = ( !empty( $open_in_new_tab ) ) ? "true" : "false"; // note we use string values as these values are passed into JS below
?>

<div class="js-hubspot-form js-hubspot-form-<?php echo esc_attr( $form_id ); ?>">
    <noscript>
        <p>Please contact us directly on: <?php echo esc_html( get_field('sales_telephone', 'option') );?></p>
    </noscript>

    Form loading...
</div>


<script>
    <?php
    /**
     * Push all Hubspot form configuration into a global array.
     * In app.js we then async load the Hubspot Forms API library file
     * and - when loaded - initialise the forms contained within the array
     *
     * This avoids Hubspot blocking rendering and allows other important page
     * information to render. This is good practice as it's unlikely people will
     * immediately begin to fill out a form immediately upon landing on a page.
     * As a result we want to render page content before the JS.
     */

    $inline_message = ( !empty( $inline_message ) ) ? $inline_message : "Thank you for completing this form.";


    ?>
    HUBSPOTFORMS.push({

        <?php if ( !empty( $redirect_url ) ): ?>
        redirectUrl: '<?php echo esc_js( $redirect_url );?>',
        <?php endif; ?>

        <?php if ( !empty( $inline_message ) && empty( $redirect_url ) ): // Hubspot doesn't allow "inline_message" if we supply a "redirect_url" because... ?>
        inlineMessage: '<?php echo esc_js( $inline_message );?>',
        <?php endif; ?>

        <?php if ( !empty( $submit_button_class ) ): ?>
        submitButtonClass: '<?php echo esc_js( $submit_button_class );?>',
        <?php endif; ?>

        css: '', // disable default hubspot styles
        portalId: '<?php echo esc_js( HUBSPOT_PORTAL_ID ); ?>',
        formId: '<?php echo esc_js( trim( $form_id ) ); ?>',
        target: '.js-hubspot-form-<?php echo esc_js( $form_id ); ?>',

        onFormSubmit: function() {
            if (ga) {

                ga('send', 'event', {
                    eventCategory: 'Form',
                    eventAction: 'Submit',
                    eventLabel: '<?php echo esc_js( trim( $form_id ) ); ?>',
                    transport: 'beacon'
                });
            }
        }
    });
</script>
<?php endif; ?>
