<?php
function kwm_petfinder_settings_page_shortcode()
{
?>
    <script>
        window.kwmPetfinderApiEndpoint = '<?php echo get_site_url() . '/wp-json/kwm-petfinder/api'; ?>';
    </script>

    <div class="wrap">
        <h1>KWM - Petfinder</h1>

        <h2 class="mt-4">Shortcode generieren</h2>
        <p>
            Das Plugin kann über einen Shortcode auf beliebigen Seiten oder Posts eingebunden werden. Hier können Sie den Shortcode generieren.
            Wählen Sie hierzu die gewünschten Einstellungen, kopieren Sie dann den Shortcode am Ende der Seite und fügen ihn an der gewünschten Stelle ein.
        </p>

        <form onChange="kwmPetfinderGenerateShortcode()">
            <fieldset>
                <legend>Vorfilterung</legend>
                <table class="form-table">
                    <tr>
                        <th>Listen-Kategorie</th>
                        <td>
                            <select style="width: 100%;" id="shortcodeGeneratorCategory">
                                <option value="vermittelbar" selected>Vermittelbar</option>
                                <option value="vermittelt">Vermittelt</option>
                                <option value="verstorben">Verstorben</option>
                                <option value="fundtier">Fundtier</option>
                                <option value="fremdvermittlung">Fremdvermittlung</option>
                                <option value="handicap">Handicap</option>
                                <option value="notfall">Notfall</option>
                                <option value="senior">Senior</option>
                                <option value="junior">Junior</option>
                                <option value="paten">Paten</option>
                                <option value="patengesuch">Patengesuch</option>
                                <option value="patengedeckt">Paten gedeckt</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Liste nach Spezies vorfiltern</th>
                        <td>
                            <select style="width: 100%;" id="shortcodeGeneratorSpeciesPreFilter" multiple>
                                <option value="">Nein</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Liste nach Geschlecht vorfiltern</th>
                        <td>
                            <select style="width: 100%;" id="shortcodeGeneratorSexPreFilter" multiple>
                                <option value="">Nein</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Liste nach Aufenthaltsort vorfiltern</th>
                        <td>
                            <select style="width: 100%;" id="shortcodeGeneratorPlacePreFilter" multiple>
                                <option value="">Nein</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Liste nach Krankheit vorfiltern</th>
                        <td>
                            <select style="width: 100%;" id="shortcodeGeneratorIllnessPreFilter" multiple>
                                <option value="">Nein</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Liste nach Vermittlungsjahr vorfiltern</th>
                        <td>
                            <select style="width: 100%;" id="shortcodeGeneratorMediatedYearPreFilter" multiple>
                                <option value="">Nein</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>Einstellungen Nutzer-Filter</legend>
                <table class="form-table">
                    <tr>
                        <th>Filter Freitext (Name und interne Bezeichnung)</th>
                        <td><input type="checkbox" id="shortcodeGeneratorFilterText" value="1" /></td>
                    </tr>
                    <tr>
                        <th>Filter Tierart</th>
                        <td><input type="checkbox" id="shortcodeGeneratorFilterSpecies" value="1" /></td>
                    </tr>
                    <tr>
                        <th>Filter Geschlecht</th>
                        <td><input type="checkbox" id="shortcodeGeneratorFilterSex" value="1" /></td>
                    </tr>
                    <tr>
                        <th>Filter Aufenthaltsort</th>
                        <td><input type="checkbox" id="shortcodeGeneratorFilterPlace" value="1" /></td>
                    </tr>
                    <tr>
                        <th>Filter Eigenschaften</th>
                        <td><input type="checkbox" id="shortcodeGeneratorFilterAttributes" value="1" /></td>
                    </tr>
                    <tr>
                        <th>Filter Kategorie</th>
                        <td><input type="checkbox" id="shortcodeGeneratorFilterCategory" value="1" /></td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>Kontakteinstellungen</legend>
                <table class="form-table">
                    <tr>
                        <th>Anfrageart Vermittlung</th>
                        <td>
                            <select style="width: 100%;" id="shortcodeGeneratorRequestType" multiple>
                                <option value="" selected>keine</option>
                                <option value="betreuer">Betreuer</option>
                                <option value="ansprechpartner">Ansprechpartner</option>
                                <option value="pflegestelle">Pflegestelle</option>
                                <option value="intern">Kontaktformular intern</option>
                                <option value="extern">Kontaktformular extern (wie in Petfinder Einstellungen angegeben)</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Anfrageart Patenschaft</th>
                        <td>
                            <select style="width: 100%;" id="shortcodeGeneratorSponsorRequestType" multiple>
                                <option value="" selected>keine</option>
                                <option value="betreuer">Betreuer</option>
                                <option value="ansprechpartner">Ansprechpartner</option>
                                <option value="intern">Kontaktformular intern</option>
                                <option value="extern">Kontaktformular extern (wie in Petfinder Einstellungen angegeben)</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>Layout-Einstellungen</legend>
                <table class="form-table">
                    <tr>
                        <th>Anzahl der Spalten in der Detailansicht (nur Desktop)</th>
                        <td>
                            <select style="width: 100%;" id="shortcodeGeneratorColCount">
                                <option value="1">1</option>
                                <option value="2" selected>2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Wie viele Tiere sollen pro Seite in der Listenansicht angezeigt werden?</th>
                        <td><input style="width: 100%;" type="text" id="shortcodeGeneratorPerPage" value="10"></td>
                    </tr>
                    <tr>
                        <th>Layout der Liste</th>
                        <td>
                            <select style="width: 100%;" id="shortcodeGeneratorListLayout">
                                <option value="vertical" selected>Vertikal</option>
                                <option value="horizontal">Horizontal</option>
                                <option value="imageonly">Nur Bild</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Layout der Blöcke in der Detailansicht (desktop)</th>
                        <td>
                            <select style="width: 100%;" id="shortcodeGeneratorDetailLayout">
                                <option value="fixed" selected>Feste Reihen</option>
                                <option value="masonry">Lose Reihen</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>Sonstiges</legend>
                <table class="form-table">
                    <tr>
                        <th>Detailansicht eines Tieres ermöglichen?</th>
                        <td><input type="checkbox" id="shortcodeGeneratorDetailLinkEnabled" value="1" /></td>
                    </tr>
                    <tr>
                        <th>Zufälliger Auszug</th>
                        <td>
                            <input type="checkbox" id="shortcodeGeneratorRandomCompendium" value="1" /><br>
                            Sucht zufällig {Anzahl pro Seite} Tiere aus den verfügbaren heraus und stellt sie in einer Liste dar ohne Paginierung
                        </td>
                    </tr>
                    <tr>
                        <th>Fremdvermittlungen in Listen anzeigen (Vermittelbar, Handicap, Junior, Senior, Notfall, Verstorben)</th>
                        <td>
                            <input type="checkbox" id="shortcodeGeneratorShowForeignPets" value="1" /><br>
                            Zeigt auch Fremdvermittlungstiere in den genannten Listen an
                        </td>
                    </tr>
                </table>
            </fieldset>

            <fieldset style="border-color: green">
                <legend style="font-weight: bold; color: green">Shortcode (über Button kopieren und auf Seite einfügen)</legend>
                <textarea style="width: 100%;" id="shortcodeGeneratorResult" rows="3"></textarea>
                <button type="button" class="btn btn-primary" onClick="jQuery('#shortcodeGeneratorResult')[0].select(); document.execCommand('copy');">Shortcode in Zwischenablage Kopieren</button>
            </fieldset>
        </form>
    </div>
<?php
}
