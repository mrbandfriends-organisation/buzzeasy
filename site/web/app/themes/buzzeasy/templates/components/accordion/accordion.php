<?php
    use Roots\Sage\Utils;


    // CONTENT
    $accordions       = ( !empty($accordions) ) ? $accordions : [];
    $section_heading  = ( !empty($section_heading) ) ? $section_heading : 'Accordion for the ' . get_the_title() . ' page';

    // MODIFIER
    $modifier         = ( !empty($modifier) ) ? $modifier : null;
    $band             = ( !empty($band) ) ? $band : null;
    $heading_modifier = ( !empty($heading_modifier) ) ? $heading_modifier : 'vh';
?>


<?php if( !empty($accordions) ) : ?>
    <section class="accordion-section <?= esc_attr($band); ?>">
        <h2 class="<?= esc_attr($heading_modifier); ?>">
            <?= esc_html($section_heading); ?>
        </h2>
        <div class="accordion-container">


            <dl class="mrb-accordion js-mrb-accordion <?= esc_attr($modifier); ?>">
                <?php foreach ($accordions as $accordion): ?>
                    <?php
                        $heading  = ( !empty($accordion['accordion_panel_heading']) ) ? $accordion['accordion_panel_heading'] : null;
                        $content  = ( !empty($accordion['accordion_panel_content']) ) ? $accordion['accordion_panel_content'] : null;
                    ?>
                    <?php if( !empty($heading) && !empty($content) ) : ?>
                        <dt>
                            <button class="mrb-accordion__header js-accordion-header">
                                <div class="mrb-accordion__header-inner js-accordion-header-inner">
                                    <?php if( !empty($heading) ) : ?>
                                        <div class="mrb-accordion__header-title heading--bravo">
                                            <?= esc_html($heading); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="mrb-accordion__header-icon">
                                        <svg class="accordion-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60.196 60.196">
                                            <circle class="accordion-icon__circle" cx="30.098" cy="30.098" r="30.098"/>
                                            <path class="accordion-icon__cross accordion-icon__cross--horizontal" d="M12.205 29.713h35.787v.77H12.205z"/>
                                            <path class="accordion-icon__cross accordion-icon__cross--verticle" d="M29.712 12.205h.77v35.787h-.77z"/>
                                        </svg>

                                    </div>
                                </div>
                            </button>
                        </dt>
                        <?php if( !empty($content) ) : ?>
                            <dd class="mrb-accordion__panel js-accordion-panel">
                                <div class="mrb-accordion__panel-inner text-module js-accordion-panel-inner">
                                    <h3>
                                        <?= esc_html($content); ?>
                                    </h3>
                                </div>
                            </dd>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php endforeach; ?>
            </dl>


        </div>
    </section>
<?php endif; ?>
