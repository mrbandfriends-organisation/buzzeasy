<?php
    use Roots\Sage\Extras;
    use Roots\Sage\Utils;


    // CONTENT
    $twitter_url   = ( !empty(get_field("twitter_url", "option")) ) ? get_field("twitter_url", "option") : null;
    $facebook_url  = ( !empty(get_field("facebook_url", "option")) ) ? get_field("facebook_url", "option") : null;
    $linkedin_url  = ( !empty(get_field("linkedin_url", "option")) ) ? get_field("linkedin_url", "option") : null;

    $networks = [
        [
            "icon" => "twitter",
            "link" => $twitter_url,
        ],
        [
            "icon" => "facebook",
            "link" => $facebook_url
        ],
        [
            "icon" => "linkedin",
            "link" => $linkedin_url
        ]
    ];


    // MODIFIERS
    $modifier = ( !empty($modifier) ) ? $modifier : null;
    $networks = ( !empty($networks) ) ? $networks : null;

    $networks_array = array_filter( $networks, function($network) {
        return !empty($network['link']);
    });
?>

<?php if ( !empty($networks_array)): ?>
    <ul class="social-menu <?= esc_attr($modifier); ?>">
        <?php foreach ($networks_array as $network): ?>
            <?php
                // CONTENT
                $icon = ( !empty($network['icon']) ) ? $network['icon'] : null;
                $link = ( !empty($network['link']) ) ? $network['link'] : null;
            ?>
            <?php if( !empty($icon) && !empty($link) ) : ?>
                <li class="social-menu__item">
                    <a class="social-menu__link" href="<?= esc_url($link); ?>" <?= Extras\link_open_new_tab_attrs(); ?>>
                        <?php if( !empty($icon) ) : ?>
                            <?= Utils\ob_load_template_part("templates/partials/shared/icon", array(
                                "icon"       => $icon,
                                "classnames" => "social-menu__icon" . " " . "social-menu__icon--" . $icon
                            )); ?>

                            <span class="vh">
                                <?= get_bloginfo("name") . " " . esc_html( ucfirst($icon) ); ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
