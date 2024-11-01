function isEmpty(value) {
    return (value == null || value == '' || value.length === 0);
}

function kwmPetfinderGenerateShortcode() {
    var shortcode = '[kwm-petfinder';

    shortcode += (' kategorie=' + jQuery('#shortcodeGeneratorCategory').val());

    if (!isEmpty(jQuery('#shortcodeGeneratorSpeciesPreFilter').val())) {
        shortcode += ' vorauswahl-spezies=' + jQuery('#shortcodeGeneratorSpeciesPreFilter').val();
    }

    if (!isEmpty(jQuery('#shortcodeGeneratorPlacePreFilter').val())) {
        shortcode += ' vorauswahl-aufenthaltsort=' + jQuery('#shortcodeGeneratorPlacePreFilter').val();
    }

    if (!isEmpty(jQuery('#shortcodeGeneratorIllnessPreFilter').val())) {
        shortcode += ' vorauswahl-krankheit=' + jQuery('#shortcodeGeneratorIllnessPreFilter').val();
    }

    if (!isEmpty(jQuery('#shortcodeGeneratorMediatedYearPreFilter').val())) {
        shortcode += ' vorauswahl-vermittlungsjahr=' + jQuery('#shortcodeGeneratorMediatedYearPreFilter').val();
    }
    
    if (!isEmpty(jQuery('#shortcodeGeneratorSexPreFilter').val())) {
        shortcode += ' vorauswahl-geschlecht=' + jQuery('#shortcodeGeneratorSexPreFilter').val();
    }

    if (jQuery('#shortcodeGeneratorFilterText').prop('checked')) {
        shortcode += ' filter-text=1';
    }

    if (jQuery('#shortcodeGeneratorFilterSpecies').prop('checked')) {
        shortcode += ' filter-tierart=1';
    }

    if (jQuery('#shortcodeGeneratorFilterSex').prop('checked')) {
        shortcode += ' filter-geschlecht=1';
    }

    if (jQuery('#shortcodeGeneratorFilterPlace').prop('checked')) {
        shortcode += ' filter-aufenthaltsort=1';
    }

    if (jQuery('#shortcodeGeneratorFilterAttributes').prop('checked')) {
        shortcode += ' filter-eigenschaften=1';
    }

    if (jQuery('#shortcodeGeneratorFilterCategory').prop('checked')) {
        shortcode += ' filter-kategorie=1';
    }

    if (jQuery('#shortcodeGeneratorRequestType').val().filter(function(value) { return !!value; }).length) {
        shortcode += (' kontakt=' + jQuery('#shortcodeGeneratorRequestType').val());
    }

    if (jQuery('#shortcodeGeneratorSponsorRequestType').val().filter(function(value) { return !!value; }).length) {
        shortcode += (' kontakt-patenschaft=' + jQuery('#shortcodeGeneratorSponsorRequestType').val());
    }

    shortcode += ' spalten=' + jQuery('#shortcodeGeneratorColCount').val();
    shortcode += ' pro-seite=' + jQuery('#shortcodeGeneratorPerPage').val();
    shortcode += ' listen-layout=' + jQuery('#shortcodeGeneratorListLayout').val();
    shortcode += ' detail-layout=' + jQuery('#shortcodeGeneratorDetailLayout').val();

    if (jQuery('#shortcodeGeneratorDetailLinkEnabled').prop('checked')) {
        shortcode += ' details=1';
    }

    if (jQuery('#shortcodeGeneratorRandomCompendium').prop('checked')) {
        shortcode += ' zufallsauszug=1';
    }

    if (jQuery('#shortcodeGeneratorShowForeignPets').prop('checked')) {
        shortcode += ' fremdvermittlungen=1';
    }

    shortcode += ']';
    jQuery('#shortcodeGeneratorResult').val(shortcode);
}

function kwmPetfinderAppendOptions(optionsArray, id, field) {
    if (optionsArray.length) {
        optionsArray.forEach(function(item, index) {
            jQuery(id).append('<option value="' + (item.id || item[field]) + '">' + item[field] + '</option>');
        });
    }
}

jQuery(document).ready(function($) {
    if (window.kwmPetfinderApiEndpoint) {
        jQuery.ajax({
            url: window.kwmPetfinderApiEndpoint + '/species',
            dataType: 'json'
        }).then(function(response) {
            kwmPetfinderAppendOptions(response, '#shortcodeGeneratorSpeciesPreFilter', 'Art');
            kwmPetfinderGenerateShortcode();
        }).fail(function(error) {
            jQuery('#shortcodeGeneratorSpeciesPreFilter').append('Konnte Optionen nicht laden');
        });
    
        jQuery.ajax({
            url: window.kwmPetfinderApiEndpoint + '/sex',
            dataType: 'json'
        }).then(function(response) {
            kwmPetfinderAppendOptions(response, '#shortcodeGeneratorSexPreFilter', 'Sex');
            kwmPetfinderGenerateShortcode();
        }).fail(function(error) {
            jQuery('#shortcodeGeneratorSexPreFilter').append('Konnte Optionen nicht laden');
        });
    
        jQuery.ajax({
            url: window.kwmPetfinderApiEndpoint + '/place',
            dataType: 'json'
        }).then(function(response) {
            kwmPetfinderAppendOptions(response, '#shortcodeGeneratorPlacePreFilter', 'Ort');
            kwmPetfinderGenerateShortcode();
        }).fail(function(error) {
            jQuery('#shortcodeGeneratorPlacePreFilter').append('Konnte Optionen nicht laden');
        });

        jQuery.ajax({
            url: window.kwmPetfinderApiEndpoint + '/illness',
            dataType: 'json'
        }).then(function(response) {
            kwmPetfinderAppendOptions(response, '#shortcodeGeneratorIllnessPreFilter', 'Name');
            kwmPetfinderGenerateShortcode();
        }).fail(function(error) {
            jQuery('#shortcodeGeneratorIllnessPreFilter').append('Konnte Optionen nicht laden');
        });

        jQuery.ajax({
            url: window.kwmPetfinderApiEndpoint + '/mediated-year',
            dataType: 'json'
        }).then(function(response) {
            kwmPetfinderAppendOptions(response, '#shortcodeGeneratorMediatedYearPreFilter', 'Year');
            kwmPetfinderGenerateShortcode();
        }).fail(function(error) {
            jQuery('#shortcodeGeneratorMediatedYearPreFilter').append('Konnte Optionen nicht laden');
        });
    }

    jQuery('#section-visiblity-settings tbody').sortable({
        items: 'tr:not(.unsortable)',
        update: function(event, ui) {
            var sections = jQuery.map(ui.item.parents('tbody').find('tr'), function(row) {
                return jQuery(row).find('span.section-name').text().trim()
            }).filter(section => !!section).join();

            ui.item.parents('fieldset').find('input[type="hidden"').val(sections);
        }
    });
});