<?php
function renderFieldLines()
{
    global $kwmPetfinderGlobals;

    foreach ($kwmPetfinderGlobals['fieldVisibility']['fields'] as $field => $value) {
        $optionNameList = $kwmPetfinderGlobals['fieldVisibility']['fieldOptionPrefixList'] . $field;
        $optionNameDetail = $kwmPetfinderGlobals['fieldVisibility']['fieldOptionPrefixDetail'] . $field;
?>
        <tr>
            <td>
                <?php echo $field === 'Groesse' ? 'Größe' : $field; ?>
            </td>
            <td>
                <input type="checkbox" name="<?php echo $optionNameList; ?>" value="1" <?php if (esc_attr(get_option($optionNameList)) === '1') echo 'checked' ?> />
            </td>
            <td>
                <input type="checkbox" name="<?php echo $optionNameDetail; ?>" value="1" <?php if (esc_attr(get_option($optionNameDetail)) === '1') echo 'checked' ?> />
            </td>
        </tr>
<?php
    }
}

function renderSectionLines()
{
    global $kwmPetfinderGlobals;

    foreach (getSectionsOrdered() as $section => $value) {
        $optionName = $kwmPetfinderGlobals['fieldVisibility']['sectionOptionPrefixDetail'] . $section;
?>
        <tr class="ui-state-default <?php echo $value['unsortable'] === true ? 'unsortable' : '' ?>">
            <td>
                <?php if ($value['unsortable'] !== true) { ?>
                    <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                <?php } ?>
                <span class="section-name">
                    <?php echo $section; ?>
                </span>
            </td>
            <td>
                <input type="checkbox" name="<?php echo $optionName; ?>" value="1" <?php if (esc_attr(get_option($optionName)) === '1') echo 'checked' ?> />
            </td>
        </tr>
<?php
    }
}

function kwm_petfinder_settings_page_field_visibility()
{
    global $kwmPetfinderGlobals;
    ?>
    <div class="wrap">
        <h1>KWM - Petfinder</h1>

        <form method="post" action="options.php">
            <?php settings_fields('kwm-petfinder-settings-group-field-visibility'); ?>
            <?php do_settings_sections('kwm-petfinder-settings-group-visibility'); ?>

            <fieldset name="fields">
                <legend>Sichtbare Felder</legend>
                <table class="form-table">
                    <thead>
                        <tr>
                            <td>
                                Feldname
                            </td>
                            <td>
                                Listenansicht
                            </td>
                            <td>
                                Detailansicht
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php renderFieldLines(); ?>
                    </tbody>
                </table>
            </fieldset>

            <fieldset name="sections">
                <legend>Sichtbare Blöcke</legend>
                Angehakte Blöcke werden in der Detailansicht angezeigt (sofern für die entsprechende Liste zugelassen). Per drag&drop definieren
                Sie das Layout der Blöcke.
                <br><br>
                Das Layout ist einspaltig auf Smartphones, sonst zweispaltig. Die Nummerierung der Blöcke hängt vom gewählten Layout im Shortcode ab:
                <br><br>
                * feste Zeilen: links nach rechts, oben nach unten (5. Stelle befindet sich in der 3. Reihe links usw.)<br>
                * lose Zeilen: erst linke Spalte voll, dann die Rechte (Blöcke teilen sich automatisch an so dass beide Spalten möglichst gleich lang sind)

                <table class="form-table" id="section-visiblity-settings">
                    <thead>
                        <tr>
                            <td>
                                Blockname
                            </td>
                            <td>
                                Sichtbar?
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php renderSectionLines(); ?>
                    </tbody>
                </table>

                <input
                    type="hidden"
                    name="<?php echo $kwmPetfinderGlobals['fieldVisibility']['optionSectionOrder']; ?>"
                    value="<?php echo get_option($kwmPetfinderGlobals['fieldVisibility']['optionSectionOrder']); ?>"
                />
            </fieldset>

            <input type="hidden" name="<?php echo $kwmPetfinderGlobals['fieldVisibility']['optionConfigureHappened']; ?>" value="1">

            <?php submit_button(); ?>
        </form>
    </div>
<?php
}
?>