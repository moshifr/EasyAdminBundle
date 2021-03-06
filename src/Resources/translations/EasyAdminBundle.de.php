<?php

return [
    'page_title' => [
        // 'dashboard' => '',
        'detail' => '%entity_label_singular% <small>(#%entity_short_id%)</small>',
        'edit' => '%entity_label_singular% <small>(#%entity_short_id%)</small>',
        'index' => '%entity_label_plural%',
        'new' => '%entity_label_singular% erstellen',
        'exception' => 'Fehler',
    ],

    'datagrid' => [
        // 'hidden_results' => '',
        'no_results' => 'Keine Ergebnisse gefunden.',
    ],

    'paginator' => [
        'first' => 'Erste',
        'previous' => 'Zurück',
        'next' => 'Nächste',
        'last' => 'Letzte',
        'counter' => '<strong>%start%</strong> - <strong>%end%</strong> von <strong>%results%</strong>',
        'results' => '{0} Keine Ergebnisse|{1} <strong>1</strong> Ergebnis|]1,Inf] <strong>%count%</strong> Ergebnisse',
    ],

    'label' => [
        'true' => 'Ja',
        'false' => 'Nein',
        'empty' => 'Leer',
        'null' => 'Null',
        'nullable_field' => 'Feld leer lassen',
        'object' => 'PHP-Objekt',
        'inaccessible' => 'Nicht zugreifbar',
        'inaccessible.explanation' => 'Es gibt keine Getter-Methode für diese Eigenschaft oder die Eigenschaft ist nicht public.',
        'form.empty_value' => 'kein Wert',
    ],

    'field' => [
        // 'code_editor.view_code' => '',
        // 'text_editor.view_content' => '',
    ],

    'action' => [
        'entity_actions' => 'Aktionen',
        'new' => '%entity_label_singular% erstellen',
        'search' => 'Suchen',
        'detail' => 'Anzeigen',
        'edit' => 'Ändern',
        'delete' => 'Löschen',
        'cancel' => 'Abbrechen',
        'index' => 'Zurück zur Übersicht',
        'deselect' => 'Auswahl aufheben',
        'add_new_item' => 'Ein neues Element hinzufügen',
        'remove_item' => 'Element entfernen',
        'choose_file' => 'Datei auswählen',
        // 'close' => '',
        // 'create' => '',
        // 'create_and_add_another' => '',
        // 'create_and_continue' => '',
        // 'save' => '',
        // 'save_and_continue' => '',
    ],

    'batch_action_modal' => [
        // 'title' => '',
        // 'content' => '',
        // 'action' => '',
    ],

    'delete_modal' => [
        'title' => 'Soll das Element wirklich gelöscht werden?',
        'content' => 'Aktion kann nicht rückgängig gemacht werden.',
    ],

    'filter' => [
        'title' => 'Filtern',
        'button.clear' => 'Zurücksetzen',
        'button.apply' => 'Anwenden',
        'label.is_equal_to' => 'ist gleich',
        'label.is_not_equal_to' => 'ist nicht gleich',
        'label.is_greater_than' => 'ist größer als',
        'label.is_greater_than_or_equal_to' => 'ist größer oder gleich',
        'label.is_less_than' => 'ist kleiner als',
        'label.is_less_than_or_equal_to' => 'ist kleiner als oder gleich',
        // 'label.is_between' => '',
        'label.contains' => 'enthält',
        'label.not_contains' => 'enthält nicht',
        'label.starts_with' => 'beginnt mit',
        'label.ends_with' => 'endet mit',
        'label.exactly' => 'ist genau',
        'label.not_exactly' => 'ist nicht genau',
        'label.is_same' => 'ist gleich',
        'label.is_not_same' => 'ist nicht gleich',
        'label.is_after' => 'ist nach',
        'label.is_after_or_same' => 'ist nach oder am gleichen',
        'label.is_before' => 'ist vor',
        'label.is_before_or_same' => 'ist vor oder am gleichen',
    ],

    'form' => [
        'are_you_sure' => 'Vorgenommene Änderungen wurden noch nicht gespeichert.',
        'tab.error_badge_title' => 'Eine ungültige Eingabe|%count% ungültige Eingaben',
    ],

    'user' => [
        'logged_in_as' => 'Angemeldet als',
        'unnamed' => 'Nicht benannter Benutzer',
        'anonymous' => 'Anonymer Benutzer',
        'sign_out' => 'Abmelden',
        'exit_impersonation' => 'Benutzerimitation verlassen',
    ],

    'login_page' => [
        'username' => 'Benutzername',
        'password' => 'Passwort',
        'sign_in' => 'Login',
    ],

    'exception' => [
        'entity_not_found' => 'Dieses Element ist nicht mehr verfügbar.',
        'entity_remove' => 'Dieses Element kann nicht gelöscht werden, weil andere Elemente darauf angewiesen sind.',
        'forbidden_action' => 'Die gewünschte Aktion kann kann mit diesem Element nicht ausgeführt werden.',
    ],
];
