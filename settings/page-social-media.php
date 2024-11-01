<?php
function kwm_petfinder_settings_page_social_media()
{
?>
    <div class="wrap">
        <h1>KWM - Petfinder</h1>

        <form method="post" action="options.php">
            <?php settings_fields('kwm-petfinder-settings-group-social-media'); ?>
            <?php do_settings_sections('kwm-petfinder-settings-group-social-media'); ?>

            <fieldset name="general">
                <legend>Social Media Einstellungen</legend>

                <p>
                    Diese Funktion bedingt das Setzen von globalen Meta-Informationen welche sich die entsprechenden Plattformen dann holen.
                    Durch Plugins (z.B. Yoast SEO) kann es vorkommen das Konflikte bei den Meta-Informationen entstehen.
                    Daher bitte die Funktion nach dem Aktivieren testen und ggf. den Support kontaktieren.
                </p>

                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Teilen aktivieren</th>
                        <td><input type="checkbox" name="kw_pefinder_share_activate" value="1" <?php echo esc_attr(get_option('kw_pefinder_share_activate')) ? 'checked' : ''; ?> /></td>
                    </tr>
                </table>

                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Titel zum Teilen</th>
                        <td>
                            <input style="width: 100%;" type="text" name="kw_pefinder_share_title" value="<?php echo esc_attr(get_option('kw_pefinder_share_title')); ?>" />
                            <p>Folgende Platzhalter können verwendet werden: {name} ==> Tiername</p>
                        </td>
                    </tr>
                </table>

                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Verfügbare Netzwerke</th>
                        <td>
                            <select multiple name="kw_pefinder_share_platforms[]">
                                <option value="email" <?php if (in_array('email', get_option('kw_pefinder_share_platforms', []))) echo 'selected'; ?>>
                                    E-Mail
                                </option>
                                <option value="facebook" <?php if (in_array('facebook', get_option('kw_pefinder_share_platforms', []))) echo 'selected'; ?>>
                                    Facebook
                                </option>
                                <option value="linkedin" <?php if (in_array('linkedin', get_option('kw_pefinder_share_platforms', []))) echo 'selected'; ?>>
                                    Linkedin
                                </option>
                                <option value="pinterest" <?php if (in_array('pinterest', get_option('kw_pefinder_share_platforms', []))) echo 'selected'; ?>>
                                    Pinterest
                                </option>
                                <option value="telegram" <?php if (in_array('telegram', get_option('kw_pefinder_share_platforms', []))) echo 'selected'; ?>>
                                    Telegram
                                </option>
                                <option value="whatsapp" <?php if (in_array('whatsapp', get_option('kw_pefinder_share_platforms', []))) echo 'selected'; ?>>
                                    Whatsapp
                                </option>
                                <option value="x" <?php if (in_array('x', get_option('kw_pefinder_share_platforms', []))) echo 'selected'; ?>>
                                    X
                                </option>
                            </select>
                        </td>
                    </tr>
                </table>
            </fieldset>

            <?php submit_button(); ?>
        </form>
    </div>
<?php
}
