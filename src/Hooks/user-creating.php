<?php

add_action('switch_theme', 'deactivateRstTheme');
function deactivateRstTheme()
{
    remove_role('customer_role');
}

add_action('after_switch_theme', 'activateRstTheme');
function activateRstTheme()
{
    add_role('customer_role', 'Customer user',
        [
            'read'                   => true,
            'edit_posts'             => true,
            'edit_pages'             => true,
            'edit_others_posts'      => true,
            'edit_others_pages'      => true,
            'delete_pages'           => true,
            'delete_others_pages'    => true,
            'delete_others_posts'    => true,
            'publish_pages'          => true,
            'upload_files'           => true,
            'edit_files'             => true,
            'manage_categories'      => true,
            'edit_published_pages'   => true,
            'delete_published_pages' => true,
            'delete_private_posts'   => true,
            'edit_private_posts'     => true,
            'read_private_posts'     => true,
            'delete_private_pages'   => true,
            'edit_private_pages'     => true,
            'manage_links'           => true,
            'read_private_pages'     => true,
            'edit_published_posts'   => true,
            'publish_posts'          => true,
            'delete_published_posts' => true,
            'delete_posts'           => true,
            'edit_dashboard'         => true,

            'manage_options'     => false,
            'import'             => false,
            'upload_plugins'     => false,
            'upload_themes'      => false,
            'upgrade_network'    => false,
            'setup_network'      => false,
            'activate_plugins'   => false,
            'create_users'       => false,
            'delete_plugins'     => false,
            'delete_themes'      => false,
            'delete_users'       => false,
            'edit_plugins'       => false,
            'edit_theme_options' => false,
            'edit_themes'        => false,
            'edit_users'         => false,
            'export'             => false,
            'install_plugins'    => false,
            'install_themes'     => false,
            'list_users'         => false,
            'promote_users'      => false,
            'remove_users'       => false,
            'switch_themes'      => false,
        ]
    );

    $randomPassword = wp_generate_password(12);

    $userId = wp_create_user('client', $randomPassword, 'test@test.com');

    if (is_wp_error($userId)) {
        $txt = 'The user was not created. Error: ' . $userId->get_error_message();

        file_put_contents(get_template_directory() . "/credsError.txt", $txt) or die("Unable to open file!");

        wp_mail(get_option('admin_email'), 'User creation', 'The user was not created. Error: ' . $userId->get_error_message());
    } else {

        $user = new WP_User($userId);
        $user->set_role('customer_role');
        $txt = 'User was created. User id: ' . $userId . ' User name: client. User password: ' . $randomPassword . ' User email: test@test.com';

        file_put_contents(get_template_directory() . "/creds.txt", $txt) or die("Unable to open file!");

        wp_mail(get_option('admin_email'), 'User creation', 'User was created. User id: ' . $userId . ' User name: client. User password: ' . $randomPassword . ' User email: test@test.com');
    }

}
