<?php
$kwmPetfinderGlobals = [
    'optionPrefix' => 'kw_pefinder_',
    'fieldVisibility' => [
        'fields' => [
            'Aufnahmedatum' => ['defaults' => [
                'list' => true, 'detail' => true
            ]],
            'Aufenthaltsort' => ['defaults' => [
                'list' => true, 'detail' => true
            ]],
            'Funddatum' => ['defaults' => [
                'list' => false, 'detail' => false
            ]],
            'Fundort' => ['defaults' => [
                'list' => false, 'detail' => false
            ]],
            'Fundtier' => ['defaults' => [
                'list' => true, 'detail' => false
            ]],
            'Geburtsdatum'  => ['defaults' => [
                'list' => true, 'detail' => true
            ]],
            'Geschlecht' => ['defaults' => [
                'list' => true, 'detail' => true
            ]],
            'Gewicht' => ['defaults' => [
                'list' => false, 'detail' => true
            ]],
            'Groesse' => ['defaults' => [
                'list' => false, 'detail' => true
            ]],
            'Kastriert' => ['defaults' => [
                'list' => false, 'detail' => true
            ]],
            'Merkmale' => ['defaults' => [
                'list' => false, 'detail' => true
            ]],
            'Rasse' => ['defaults' => [
                'list' => true, 'detail' => true
            ]],
            'Preis' => ['defaults' => [
                'list' => false, 'detail' => false
            ]],
            'Status' => ['defaults' => [
                'list' => true, 'detail' => true
            ]],
            'Tierart' => ['defaults' => [
                'list' => true, 'detail' => true
            ]],
            'Vermitteltdatum' => ['defaults' => [
                'list' => false, 'detail' => true
            ]],
            'Verstorben' => ['defaults' => [
                'list' => false, 'detail' => false
            ]]
        ],
        'sections' => [
            'Bilder' => ['defaults' => true],
            'Allgemein' => ['defaults' => true],
            'Beschreibung' => ['defaults' => true],
            'Eigenschaften' => ['defaults' => true],
            'Krankheiten' => ['defaults' => true],
            'Impfungen' => ['defaults' => true],
            'Patenschaftsbedarf' => ['defaults' => true],
            'Paten' => ['defaults' => true],
            'Vermittlungskontakt' => ['defaults' => true, 'unsortable' => true],
            'Patenschaftskontakt' => ['defaults' => true, 'unsortable' => true],
            'Teilen' => ['defaults' => true, 'unsortable' => true]
        ],
    ],
    'texts' => [
        'loading' => 'Lädt...',
        'place' => 'Aufenthaltsort',
        'foundling' => 'Fundtier',
        'foundPlace' => 'Fundort',
        'foundDate' => 'Funddatum',
        'mediatedDate' => 'Vermittelt am',
        'diedDate' => 'Verstorben am',
        'sex' => 'Geschlecht',
        'weight' => 'Gewicht',
        'castrated' => 'Kastriert',
        'breed' => 'Rasse',
        'species' => 'Tierart',
        'attributes' => 'Merkmale',
        'allCategories' => 'Alle Kategorien',
        'handicap' => 'Handicap',
        'junior' => 'Junior',
        'senior' => 'Senior',
        'emergency' => 'Notfall',
        'sponsorRequest' => 'Patengesuch',
        'foreignPet' => 'Fremdvermittlung',
        'next' => 'Nächstes',
        'previous' => 'Vorheriges',
        'description' => 'Beschreibung',
        'status' => 'Status',
        'searchingSponsor' => 'Paten gesucht',
        'noSponsors' => 'Aktuell keine Paten',
        'generalInformation' => 'Allgemeine Infos',
        'animalNotFound' => 'Tier wurde nicht gefunden.',
        'error' => 'Es ist ein Fehler aufgetreten. Bitte versuchen Sie es später noch einmal.',
        'animalsFound' => 'Folgende Tiere haben wir passend zu ihrer Suche gefunden',
        'noAnimalsFound' => 'Es wurden keine Einträge zu ihrer Suche gefunden.',
        'nextAnimal' => 'Tier vor',
        'previousAnimal' => 'Tier zurück',
        'backToList' => 'zurück zur Liste',
        'details' => 'Details',
        'errorLoading' => 'Es ist ein Fehler beim Laden der Daten aufgetreten. Bitte versuchen Sie es später erneut.',
        'requestSuccess' => 'Ihre Anfrage wurde erfolgreich übermittelt. Herzlichen Dank!',
        'requestIntro' => 'Herzlichen Dank dass Sie sich für {tiername} interessieren. Bitte geben Sie hier ihre Daten an. Wir setzen uns dann schnellstmöglich mit ihnen in Verbindung. Mit * markierte Felder sind Pflichtfelder.',
        'pleaseSelect' => 'Bitte wählen',
        'personalData' => 'Persönliche Daten',
        'salutation' => 'Anrede',
        'title' => 'Titel',
        'firstname' => 'Vorname',
        'lastname' => 'Nachname',
        'birthday' => 'Geburtsdatum',
        'address' => 'Adresse',
        'street' => 'Straße und Hausnummer',
        'postcode' => 'PLZ',
        'city' => 'Ort',
        'country' => 'Land',
        'contactData' => 'Kontaktdaten',
        'email' => 'E-Mail',
        'phone' => 'Telefon',
        'mobile' => 'Handy',
        'size' => 'Größe',
        'yourMessage' => 'Ihre Nachricht',
        'dataProtection' => 'Einwilligungserklärung in die Datenverarbeitung*: Ich willige ein, dass meine oben eingegebenen Daten per Email versendet werden und für den Zweck der Kontaktaufnahme elektronisch gespeichert werden. Die Daten werden nach der Bearbeitung meiner Anfrage umgehend gelöscht, sofern keine gesetzlichen Aufbewahrungspflichten bestehen. Eine Nutzung zu einem anderen Zweck oder eine Datenweitergabe an Dritte findet nicht statt. Diese Einwilligung kann ich jederzeit widerrufen. Hierzu genügt die Textform.',
        'sendRequest' => 'Anfrage senden',
        'share' => 'Teilen',
        'reserved' => 'Reserviert',
        'protectionFee' => 'Schutzgebühr',
        'adoptionContact' => 'Vermittlungskontakt',
        'sponsoringContact' => 'Patenschaftskontakt',
        'loginToReuqest' => 'Bitte melden Sie sich an oder registrieren Sie sich um Kontakt aufzunehmen.',
        'onlineRequest' => ['default' => 'Vermittlungsanfrage', 'hint' => 'internes Formular'],
        'externalRequest' => ['default' => 'Vermittlungsanfrage', 'hint' => 'externes Formular'],
        'onlineSponsorRequest' => ['default' => 'Patenschaftsanfrage', 'hint' => 'internes Formular'],
        'externalSponsorRequest' => ['default' => 'Patenschaftsanfrage', 'hint' => 'externes Formular'],
        'filterResults' => 'Ergebnisse filtern',
        'properties' => 'Eigenschaften',
        'allItemsSelected' => 'Alle ausgewählt',
        'selectItems' => 'Eigenschaften filtern',
        'selectSex' => 'Geschlecht filtern',
        'selectPlace' => 'Aufenthaltsort filtern',
        'selectSpecies' => 'Spezies filtern',
        'insertQuery' => 'Suchbegriff eingeben...',
        'inShelterSince' => 'Bei uns seit',
        'back' => 'Zurück',
        'forward' => 'Weiter',
        'illnesses' => 'Krankheiten',
        'vaccinations' => 'Impfungen',
        'noIllnesses' => 'Keine Krankheiten bekannt',
        'noVaccinations' => 'Keine Impfungen bekannt',
        'noProperties' => 'Keine Eigenschaften bekannt',
        'noData' => 'Keine Daten',
        'sponsoringNeedMonthly' => 'Monatsbedarf',
        'sponsoringNeedOnetime' => 'Einmaliger Bedarf',
        'sponsoringNeedCovered' => 'Davon bereits erhalten',
        'sponsorListHeadline' => 'Patenliste',
        'sponsorneedsHeadline' => 'Patenschaftsbedarf',
        'imagesHeadline' => 'Bilder',
        'sponsorNoNeed' => 'Aktuell kein Bedarf',
        'requestSubject' => [
            'default' => 'Website: {anfrageart} für {tiername} ({lfdnr})',
            'hint' => 'Betreff für Anfrage-Email. Mögliche Platzhalter: {anfrageart} (Adoptionsanfrage, Patenschaftsanfrage), {tiername}, {lfdnr}, {internebezeichnung}'
        ],
        'requestType' => 'Anfrageart',
        'contactPerson' => 'Ansprechpartner',
        'caringPerson' => 'Betreuer',
        'fosterPerson' => 'Pflegestelle',
        'contactName' => [
            'default' => 'Name',
            'hint' => 'Label für Name Kontaktperson'
        ],
        'contactPhone' => [
            'default' => 'Telefon',
            'hint' => 'Label für Telefon Kontaktperson'
        ],
        'contactMobile' => [
            'default' => 'Mobil',
            'hint' => 'Label für Mobil Kontaktperson'
        ],
        'contactEmail' => [
            'default' => 'E-Mail',
            'hint' => 'Label für E-Mail Kontaktperson'
        ],
        'contactAvailable' => [
            'default' => 'Erreichbarkeit',
            'hint' => 'Label für Erreichbarkeit Kontaktperson'
        ],
        'contactCity' => [
            'default' => 'Ort',
            'hint' => 'Label für Ort Kontaktperson'
        ]
    ]
];

$kwmPetfinderGlobals['fieldVisibility']['optionConfigureHappened'] = $kwmPetfinderGlobals['optionPrefix'] . 'field_visibility_configure_happened';
$kwmPetfinderGlobals['fieldVisibility']['optionSectionOrder'] = $kwmPetfinderGlobals['optionPrefix'] . 'field_visibility_section_order';
$kwmPetfinderGlobals['fieldVisibility']['fieldOptionPrefixList'] = $kwmPetfinderGlobals['optionPrefix'] . 'field_visibility_field_list_';
$kwmPetfinderGlobals['fieldVisibility']['fieldOptionPrefixDetail'] = $kwmPetfinderGlobals['optionPrefix'] . 'field_visibility_field_detail_';
$kwmPetfinderGlobals['fieldVisibility']['sectionOptionPrefixDetail'] = $kwmPetfinderGlobals['optionPrefix'] . 'field_visibility_section_detail_';
