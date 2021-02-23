<!doctype html>
<html lang="<?php echo get_locale(); ?>">
<head>
    <title><?php echo wp_get_document_title(); ?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <nav>
        <div class="js-menu nav-menu">
            <div class="nav-menu--box">
                <ul class="nav-menu--box-pages">
                    <?php foreach (get_header_menu_array('primary') as $item) : ?>
                        <?php
                        if ($item['title_menu'] == get_the_title()) {
                            $class_active = 'active';
                        } else {
                            $class_active = '';
                        }
                        ?>
                        <li <?php echo (!empty($class_active)) ? 'class="' . $class_active . '"' : ''; ?> >
                            <a href="<?php echo $item['url']; ?>">
                                <?php echo strtoupper($item['title_menu']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <ul class="nav-menu--box-sections">
                    <li><a class="anchor-link" data-value="" href="/case-studies">CASE STUDIES</a></li>
                    <li><a class="anchor-link" data-value="2" href="#">INSIGHTS</a></li>
                    <li><a class="anchor-link" data-value="" href="#">CAREERS</a></li>
                    <li><a class="anchor-link" data-value="5" href="#">CONTACT</a></li>
                </ul>
            </div>
            <div class="nav-menu--box-address">
                <?php $contacts = get_field('contacts.header', 'option'); ?>
                <?php if($contacts) : ?>
                    <p><?php echo $contacts['city']; ?></p>
                    <ul class="contacts">
                        <li><?php echo $contacts['address']; ?></li>
                        <li><a href="mail:<?php echo $contacts['email']; ?>" title="mail"><?php echo $contacts['email']; ?></a></li>
                        <li><a href="tel:<?php echo preg_replace("/[^,.0-9]/", '', $contacts['phone_number']); ?>" title="<?php echo $contacts['phone_number']; ?>"><?php echo $contacts['phone_number']; ?></a></li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <div class="spinner-wrapper">
            <?php $logo = get_field('logo.header', 'option'); ?>
            <?php if(!empty($logo)) : ?>
                <div class="header__logo">
                    <a class="header__logo-top" href="<?php echo home_url(); ?>" title="branding">
                        <img class="logo" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
                    </a>
                </div>
            <?php endif; ?>
            <div class="spinner">
                <span class="spinner-line diagonal part-1"></span>
                <span class="spinner-line horizontal"></span>
                <span class="spinner-line diagonal part-2"></span>
            </div>
        </div>
    </nav>
</header>

<?php # TODO: code here ?>
