<?php
function kwm_petfinder_settings_page_general()
{
?>
    <div class="wrap">
        <h1>KWM - Petfinder</h1>

        <div class="infos">
            Support zu diesem Plugin erhalten Sie hier <a href="https://helpcenter.kw-management.de/portal/de/kb/articles/installation-des-wordpress-plugins/" target="_blank">https://helpcenter.kw-management.de</a> und weitere Informationen finden Sie auf unserer Homepage <a href="https://www.pet-man.eu" target="_blank">https://www.pet-man.eu</a>
        </div>

        <form method="post" action="options.php">
            <?php settings_fields('kwm-petfinder-settings-group-general'); ?>
            <?php do_settings_sections('kwm-petfinder-settings-group-general'); ?>

            <fieldset name="general">
                <legend>Allgemeine Einstellungen</legend>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Kunden-ID*</th>
                        <td><input style="width: 100%;" type="text" name="kw_pefinder_customer_id" value="<?php echo esc_attr(get_option('kw_pefinder_customer_id')); ?>" required /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">API-Key*</th>
                        <td><input style="width: 100%;" type="text" name="kw_pefinder_api_key" value="<?php echo esc_attr(get_option('kw_pefinder_api_key')); ?>" required /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">URL zum Formular Adoptantenanfrage</th>
                        <td><input style="width: 100%;" type="text" name="kw_pefinder_external_contact_url" value="<?php echo esc_attr(get_option('kw_pefinder_external_contact_url')); ?>" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">URL zum Formular Patenschaftsanfrage</th>
                        <td><input style="width: 100%;" type="text" name="kw_pefinder_external_sponsor_contact_url" value="<?php echo esc_attr(get_option('kw_pefinder_external_sponsor_contact_url')); ?>" /></td>
                    </tr>

                    <tr>
                        <th>Kontaktbutton nur für eingeloggte User anzeigen</th>
                        <td>
                            <input type="checkbox" name="kw_pefinder_contact_only_loggedin" value="1" <?php if (esc_attr(get_option('kw_pefinder_contact_only_loggedin')) === '1') echo 'checked' ?> />
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Offset für Autoscroll</th>
                        <td>
                            <input style="width: 100%;" type="text" name="kw_pefinder_scroll_offset" value="<?php echo esc_attr(get_option('kw_pefinder_scroll_offset')); ?>" />
                            Negativer Wert für Position über der App und positiv für darunter
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Alle Daten bei Deinstallation löschen</th>
                        <td>
                            <input type="checkbox" name="kw_pefinder_delete_data_on_deinstallation" value="1" <?php if (esc_attr(get_option('kw_pefinder_delete_data_on_deinstallation')) === '1') echo 'checked' ?> />
                        </td>
                    </tr>
                </table>
            </fieldset>

            <?php submit_button(); ?>
        </form>
    </div>
<?php
}