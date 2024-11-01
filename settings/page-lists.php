<?php
function kwm_petfinder_get_sorting_setting($title, $list, $fields)
{
    ?>
    <tr valign="top">
        <th scope="row">
            <?php echo $title; ?>
        </th>
        <td>
            <select name="kw_pefinder_list_sorting_column<?php echo $list; ?>">
                <option value="">
                    Keine Sortierung
                </option>
                <?php
                    foreach ($fields as $field) {
                        ?>
                        <option value="<?php echo $field; ?>" <?php if (esc_attr(get_option('kw_pefinder_list_sorting_column' . $list)) === $field) echo 'selected' ?>>
                            <?php echo $field; ?>
                        </option>
                        <?php
                    }
                ?>
            </select>
        </td>
        <td>
            <select name="kw_pefinder_list_sorting_order<?php echo $list; ?>">
                <option value="desc" <?php if (esc_attr(get_option('kw_pefinder_list_sorting_order' . $list)) === 'desc') echo 'selected' ?>>
                    Absteigend
                </option>
                <option value="asc" <?php if (esc_attr(get_option('kw_pefinder_list_sorting_order' . $list)) === 'asc') echo 'selected' ?>>
                    Aufsteigend
                </option>
            </select>
        </td>
    </tr>
    <?php
}

function kwm_petfinder_settings_page_lists()
{
?>
    <div class="wrap">
        <h1>KWM - Petfinder</h1>

        <form method="post" action="options.php">
            <?php settings_fields('kwm-petfinder-settings-group-lists'); ?>
            <?php do_settings_sections('kwm-petfinder-settings-group-lists'); ?>

            <fieldset name="lists">
                <legend>Listen Einstellungen</legend>
                <fieldset name="lists">
                    <legend>Tiere</legend>
                    <table class="form-table">
                        <tr>
                            <th>
                                Interne Nr verbergen
                            </th>
                            <td>
                                <input type="checkbox" name="kw_pefinder_hide_internal_nr" value="1" <?php if (esc_attr(get_option('kw_pefinder_hide_internal_nr')) === '1') echo 'checked' ?> />
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Laufende Nr verbergen
                            </th>
                            <td>
                                <input type="checkbox" name="kw_pefinder_hide_serial_nr" value="1" <?php if (esc_attr(get_option('kw_pefinder_hide_serial_nr')) === '1') echo 'checked' ?> />
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Badges (Junior, Senior, Notfall, Handicap, Paten) anzeigen
                            </th>
                            <td>
                                <input type="checkbox" name="kw_pefinder_show_badges" value="1" <?php if (esc_attr(get_option('kw_pefinder_show_badges')) === '1') echo 'checked' ?> />
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Patensuche anzeigen
                            </th>
                            <td>
                                <input type="checkbox" name="kw_pefinder_show_searching_sponsors" value="1" <?php if (esc_attr(get_option('kw_pefinder_show_searching_sponsors')) === '1') echo 'checked' ?> />
                            </td>
                        </tr>
                        <?php kwm_petfinder_get_sorting_setting('Sortierung (Vermittelbar und Fundtiere)', '', ['Aufnahmedatum']); ?>
                        <?php kwm_petfinder_get_sorting_setting(' Sortierung (Vermittelt)', '_vermittelt', ['Vermitteltdatum']); ?>
                        <?php kwm_petfinder_get_sorting_setting('Sortierung (Fremdvermittlung)', '_fremdvermittlung', ['Aufnahmedatum']); ?>
                        <?php kwm_petfinder_get_sorting_setting('Sortierung (Verstorben)', '_verstorben', ['Verstorben']); ?>
                        <?php kwm_petfinder_get_sorting_setting('Sortierung (Paten gesucht)', '_patengesuch', ['Aufnahmedatum']); ?>
                        <?php kwm_petfinder_get_sorting_setting('Sortierung (Paten gedeckt)', '_patengedeckt', ['Aufnahmedatum']); ?>
                        <?php kwm_petfinder_get_sorting_setting('Sortierung (Senior, Junior, Handicap, Notfall)', '_andere', ['Aufnahmedatum']); ?>
                    </table>
                </fieldset>
                <fieldset>
                    <legend>Paten</legend>
                    <table class="form-table">
                        <tr>
                            <th>
                                Patenliste einzeilig anzeigen
                            </th>
                            <td>
                                <input type="checkbox" name="kw_pefinder_sponsors_list_one_line" value="1" <?php if (esc_attr(get_option('kw_pefinder_sponsors_list_one_line')) === '1') echo 'checked' ?> />
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Vermittelte Tiere in Patengesuchen anzeigen
                            </th>
                            <td>
                                <input type="checkbox" name="kw_pefinder_sponsors_list_show_adopted" value="1" <?php if (esc_attr(get_option('kw_pefinder_sponsors_list_show_adopted')) === '1') echo 'checked' ?> />
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Tiere mit voll gedeckten Patenschaften nicht anzeigen
                            </th>
                            <td>
                                <input type="checkbox" name="kw_pefinder_sponsors_list_filter_covered" value="1" <?php if (esc_attr(get_option('kw_pefinder_sponsors_list_filter_covered')) === '1') echo 'checked' ?> />
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Paten mit Ort anzeigen
                            </th>
                            <td>
                                <input type="checkbox" name="kw_pefinder_sponsors_list_show_city" value="1" <?php if (esc_attr(get_option('kw_pefinder_sponsors_list_show_city')) === '1') echo 'checked' ?> />
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </fieldset>

            <?php submit_button(); ?>
        </form>
    </div>
<?php
}
