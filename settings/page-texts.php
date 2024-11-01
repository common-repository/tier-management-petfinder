<?php
function kwm_petfinder_settings_page_texts()
{
    global $kwmPetfinderGlobals;
?>
    <div class="wrap">
        <h1>KWM - Petfinder</h1>

        <form method="post" action="options.php">
            <?php settings_fields('kwm-petfinder-settings-group-texts'); ?>
            <?php do_settings_sections('kwm-petfinder-settings-group-texts'); ?>

            <fieldset name="general">
                <legend>Texte</legend>

                <table class="form-table settings-texts">
                    <tr>
                        <th>
                             Standard
                        </th>
                        <th>
                            Benutzerdefiniert
                        </th>
                    </tr>
<?php
                    foreach($kwmPetfinderGlobals['texts'] as $id => $value) {
                        $optionName = $kwmPetfinderGlobals['optionPrefix'] . 'text_' . $id;

                        if (is_array($value)) {
                            $default = $value['default'];
                            $hint = $value['hint'];
                        } else {
                            $default = $value;
                            $hint = null;
                        }
?>
                        <tr>
                            <td>
                                <?php echo $default; ?>
                            </td>
                            <td>
                                <input type="text" name="<?php echo $optionName; ?>" value="<?php echo htmlspecialchars(get_option($optionName)) ?>" />
                                <?php if ($hint) echo $hint; ?>
                            </td>
                        </tr>
<?php
                    }
?>
                </table>
            </fieldset>

            <?php submit_button(); ?>
        </form>
    </div>
<?php
}
