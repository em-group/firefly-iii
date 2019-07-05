<?php

/**
 * form.php
 * Copyright (c) 2018 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III.
 *
 * Firefly III is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Firefly III is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Firefly III. If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

return [
    // new user:
    'bank_name'                   => 'Navn på bank',
    'bank_balance'                => 'Saldo',
    'savings_balance'             => 'Sparesaldo',
    'credit_card_limit'           => 'Kredittkortgrense',
    'automatch'                   => 'Finn automatisk',
    'skip'                        => 'Hopp over',
    'enabled'                     => 'Aktivert',
    'name'                        => 'Navn',
    'active'                      => 'Aktiv',
    'amount_min'                  => 'Minimumsbeløp',
    'amount_max'                  => 'Maksimumsbeløp',
    'match'                       => 'Treff på',
    'strict'                      => 'Streng modus',
    'repeat_freq'                 => 'Gjentas',
    'journal_currency_id'         => 'Valuta',
    'currency_id'                 => 'Valuta',
    'transaction_currency_id'     => 'Valuta',
    'external_ip'                 => 'Serverens eksterne IP',
    'attachments'                 => 'Vedlegg',
    'journal_amount'              => 'Beløp',
    'journal_source_name'         => 'Inntektskonto (kilde)',
    'keep_bill_id'                => 'Regning',
    'journal_source_id'           => 'Brukskonto (kilde)',
    'BIC'                         => 'BIC',
    'verify_password'             => 'Bekreft passordsikkerhet',
    'source_account'              => 'Kildekonto',
    'destination_account'         => 'Målkonto',
    'journal_destination_id'      => 'Brukskonto (destinasjon)',
    'asset_destination_account'   => 'Destinasjonskonto',
    'include_net_worth'           => 'Inkluder i formue',
    'asset_source_account'        => 'Kildekonto',
    'journal_description'         => 'Beskrivelse',
    'note'                        => 'Notater',
    'split_journal'               => 'Del opp denne transaksjonen',
    'split_journal_explanation'   => 'Del denne transaksjonen opp i flere deler',
    'currency'                    => 'Valuta',
    'account_id'                  => 'Aktivakonto',
    'budget_id'                   => 'Busjett',
    'openingBalance'              => 'Startsaldo',
    'tagMode'                     => 'Taggmodus',
    'tag_position'                => 'Stedtagg',
    'virtualBalance'              => 'Virtuell balanse',
    'targetamount'                => 'Målbeløp',
    'accountRole'                 => 'Kontorolle',
    'openingBalanceDate'          => 'Startsaldodato',
    'ccType'                      => 'Betalingsplan for kredittkort',
    'ccMonthlyPaymentDate'        => 'Månedlig betalingsdato for kredittkort',
    'piggy_bank_id'               => 'Sparegris',
    'returnHere'                  => 'Gå tilbake hit',
    'returnHereExplanation'       => 'Gå tilbake hit etter lagring for å legge til på nytt.',
    'returnHereUpdateExplanation' => 'Gå tilbake hit etter endring.',
    'description'                 => 'Beskrivelse',
    'expense_account'             => 'Utgiftskonto',
    'revenue_account'             => 'Inntektskonto',
    'decimal_places'              => 'Desimaler',
    'exchange_rate_instruction'   => 'Utenlandske valutaer',
    'source_amount'               => 'Beløp (kilde)',
    'destination_amount'          => 'Beløp (destinasjon)',
    'native_amount'               => 'Opprinnelig beløp',
    'new_email_address'           => 'Ny epostadresse',
    'verification'                => 'Bekreftelse',
    'api_key'                     => 'API-nøkkel',
    'remember_me'                 => 'Husk meg',
    'liability_type_id'           => 'Gjeldstype',
    'interest'                    => 'Rente',
    'interest_period'             => 'Renteperiode',

    'source_account_asset'        => 'Kildekonto (aktivakonto)',
    'destination_account_expense' => 'Destinasjonskonto (utgiftskonto)',
    'destination_account_asset'   => 'Destinasjonskonto (aktivakonto)',
    'source_account_revenue'      => 'Kildekonto (inntektskonto)',
    'type'                        => 'Type',
    'convert_Withdrawal'          => 'Konverter uttak',
    'convert_Deposit'             => 'Konverter innskudd',
    'convert_Transfer'            => 'Konverter overføring',

    'amount'                      => 'Beløp',
    'foreign_amount'              => 'Utenlandske beløp',
    'existing_attachments'        => 'Eksisterende vedlegg',
    'date'                        => 'Dato',
    'interest_date'               => 'Rentedato',
    'book_date'                   => 'Bokføringsdato',
    'process_date'                => 'Prosesseringsdato',
    'category'                    => 'Kategori',
    'tags'                        => 'Tagger',
    'deletePermanently'           => 'Slett permanent',
    'cancel'                      => 'Avbryt',
    'targetdate'                  => 'Måldato',
    'startdate'                   => 'Startdato',
    'tag'                         => 'Tagg',
    'under'                       => 'Under',
    'symbol'                      => 'Symbol',
    'code'                        => 'Kode',
    'iban'                        => 'IBAN',
    'accountNumber'               => 'Kontonummer',
    'creditCardNumber'            => 'Kredittkortnummer',
    'has_headers'                 => 'Overskrifter',
    'date_format'                 => 'Datoformat',
    'specifix'                    => 'Bank- eller filspesifikke rettelser',
    'attachments[]'               => 'Vedlegg',
    'store_new_withdrawal'        => 'Lagre nytt uttak',
    'store_new_deposit'           => 'Lagre nytt innskudd',
    'store_new_transfer'          => 'Lagre ny overføring',
    'add_new_withdrawal'          => 'Opprett nytt uttak',
    'add_new_deposit'             => 'Opprett nytt innskudd',
    'add_new_transfer'            => 'Opprett ny overføring',
    'title'                       => 'Tittel',
    'notes'                       => 'Notater',
    'filename'                    => 'Filnavn',
    'mime'                        => 'Mime-type',
    'size'                        => 'Størrelse',
    'trigger'                     => 'Utløser',
    'stop_processing'             => 'Stopp prosessering',
    'start_date'                  => 'Startgrense',
    'end_date'                    => 'Sluttgrense',
    'export_start_range'          => 'Start på eksportgrense',
    'export_end_range'            => 'Slutt på eksportgrense',
    'export_format'               => 'Filformat',
    'include_attachments'         => 'Ta med opplastede vedlegg',
    'include_old_uploads'         => 'Ta med importert data',
    'accounts'                    => 'Eksporter transaksjoner fra disse kontoene',
    'delete_account'              => 'Slett konto ":name"',
    'delete_bill'                 => 'Slett regning ":name"',
    'delete_budget'               => 'Slett budsjett ":name"',
    'delete_category'             => 'Slett kategori ":name"',
    'delete_currency'             => 'Slett valuta ":name"',
    'delete_journal'              => 'Slett transaksjon med beskrivelse ":description"',
    'delete_attachment'           => 'Slett vedlegg ":name"',
    'delete_rule'                 => 'Slett regel ":title"',
    'delete_rule_group'           => 'Slett regelgruppe ":title"',
    'delete_link_type'            => 'Slett lenketype ":name"',
    'delete_user'                 => 'Slett bruker ":email"',
    'delete_recurring'            => 'Slett gjentakende transaksjon ":title"',
    'user_areYouSure'             => 'Hvis du sletter brukeren ":email", vil alt bli borte. Det er ikke mulig å angre eller gjenopprette brukeren. Hvis du sletter din egen bruker, vil du miste tilgangen til '.config('app.name').'.',
    'attachment_areYouSure'       => 'Er du sikker på at du vil slette vedlegget ved navn ":name"?',
    'account_areYouSure'          => 'Er du sikker på at du vil slette brukeren ved navn ":name"?',
    'bill_areYouSure'             => 'Er du sikker på at du vil slette regningen ved navn ":name"?',
    'rule_areYouSure'             => 'Er du sikker på at du vil slette regelen ved navn ":title"?',
    'ruleGroup_areYouSure'        => 'Er du sikker på at du vil slette regelgruppen ved navn ":title"?',
    'budget_areYouSure'           => 'Er du sikker på at du vil slette budsjettet ved navn ":name"?',
    'category_areYouSure'         => 'Er du sikker på at du vil slette kategorien ved navn ":name"?',
    'recurring_areYouSure'        => 'Er du sikker på at du vil slette gjentakende transaksjonen ved navn ":title"?',
    'currency_areYouSure'         => 'Er du sikker på at du vil slette valutaen ved navn ":name"?',
    'piggyBank_areYouSure'        => 'Er du sikker på at du vil slette sparegrisen ved navn ":name"?',
    'journal_areYouSure'          => 'Er du sikker på at du vil slette transaksjonen med beskrivelse ":description"?',
    'mass_journal_are_you_sure'   => 'Er du sikker på at du vil slette disse transaksjonene?',
    'tag_areYouSure'              => 'Er du sikker på at du vil slette taggen ":tag"?',
    'journal_link_areYouSure'     => 'Er du sikker på at du vil slette koblingen mellom <a href=":source_link">:source</a> og <a href=":destination_link">:destination</a>?',
    'linkType_areYouSure'         => 'Er du sikker på at du vil slette koblingstypen ":name" (":inward" / ":outward")?',
    'permDeleteWarning'           => 'Sletting av data fra '.config('app.name').' er permanent, og kan ikke angres.',
    'mass_make_selection'         => 'Du kan fortsatt forhindre at elementer slettes ved å fjerne avkrysningen.',
    'delete_all_permanently'      => 'Slett valgte elementer permanent',
    'update_all_journals'         => 'Oppdater disse transaksjonene',
    'also_delete_transactions'    => 'Den ene transaksjonen som er koblet til denne kontoen, vil også bli slettet. | Alle :count transaksjoner som er koblet til denne kontoen, slettes også.',
    'also_delete_connections'     => 'Den ene transaksjonen som er knyttet til denne koblingstypen, vil miste denne forbindelsen. | Alle :count transaksjoner knyttet til denne koblingstypen vil miste forbindelsen.',
    'also_delete_rules'           => 'Den ene regelen som er knyttet til denne regelgruppen, vil også bli slettet. | Alle de :count reglene som er knyttet til denne regelgruppen slettes også.',
    'also_delete_piggyBanks'      => 'Den ene sparegrisen som er koblet til denne kontoen, vil også bli slettet. | Alle de :count sparegrisene knyttet til denne kontoen slettes også.',
    'bill_keep_transactions'      => 'Ingen transaksjoner knyttet til denne regningen blir slettet.|Ingen av de :count transaksjonene knyttet til denne regningen vil bli slettet.',
    'budget_keep_transactions'    => 'Ingen transaksjoner knyttet til dette budsjettet blir slettet.|Ingen av de :count transaksjonene knyttet til dette budsjettet vil bli slettet.',
    'category_keep_transactions'  => 'Ingen transaksjoner knyttet til denne kategorien blir slettet.|Ingen av de :count transaksjonene knyttet til denne kategorien vil bli slettet.',
    'recurring_keep_transactions' => 'Ingen transaksjoner knyttet til denne gjentakende transaksjonen blir slettet.|Ingen av de :count transaksjonene knyttet til denne gjentakende transaksjonen vil bli slettet.',
    'tag_keep_transactions'       => 'Ingen transaksjoner knyttet til denne tag blir slettet.|Ingen av de :count transaksjonene knyttet til denne tag vil bli slettet.',
    'check_for_updates'           => 'Se etter oppdateringer',

    'email'                 => 'Epostadresse',
    'password'              => 'Passord',
    'password_confirmation' => 'Passord (gjenta)',
    'blocked'               => 'Er sperret?',
    'blocked_code'          => 'Årsak til sperring',
    'login_name'            => 'Logg inn',

    // import
    'apply_rules'           => 'Bruk regler',
    'artist'                => 'Artist',
    'album'                 => 'Album',
    'song'                  => 'Sang',


    // admin
    'domain'                => 'Domene',
    'single_user_mode'      => 'Deaktiver brukerregistrering',
    'is_demo_site'          => 'Er demonettsted',

    // import
    'import_file'           => 'Importer fil',
    'configuration_file'    => 'Konfigurasjonsfil',
    'import_file_type'      => 'Importer filtype',
    'csv_comma'             => 'Et komma (,)',
    'csv_semicolon'         => 'Et semikolon (;)',
    'csv_tab'               => 'En tabulator (usynlig)',
    'csv_delimiter'         => 'CSV-feltskilletegn',
    'csv_import_account'    => 'Standard importkonto',
    'csv_config'            => 'CSV-importkonfigurasjon',
    'client_id'             => 'Klient-ID',
    'service_secret'        => 'Service-hemmelighet',
    'app_secret'            => 'App-hemmelighet',
    'app_id'                => 'App ID',
    'secret'                => 'Secret',
    'public_key'            => 'Offentlig nøkkel',
    'country_code'          => 'Landskode',
    'provider_code'         => 'Bank eller dataleverandør',
    'fints_url'             => 'FinTS API URL',
    'fints_port'            => 'Port',
    'fints_bank_code'       => 'Bankkode',
    'fints_username'        => 'Brukernavn',
    'fints_password'        => 'PIN / Passord',
    'fints_account'         => 'FinTS konto',
    'local_account'         => config('app.name').' konto',
    'from_date'             => 'Dato fra',
    'to_date'               => 'Dato til',


    'due_date'                => 'Forfallsdato',
    'payment_date'            => 'Betalingsdato',
    'invoice_date'            => 'Fakturadato',
    'internal_reference'      => 'Intern referanse',
    'inward'                  => 'Innvendig beskrivelse',
    'outward'                 => 'Utvendig beskrivelse',
    'rule_group_id'           => 'Regelgruppe',
    'transaction_description' => 'Transaksjonsbeskrivelse',
    'first_date'              => 'Første dato',
    'transaction_type'        => 'Transaksjonstype',
    'repeat_until'            => 'Gjenta til',
    'recurring_description'   => 'Gjentakende transaksjonsbeskrivelse',
    'repetition_type'         => 'Type repetisjon',
    'foreign_currency_id'     => 'Utenlandsk valuta',
    'repetition_end'          => 'Repetisjon slutter',
    'repetitions'             => 'Repetisjoner',
    'calendar'                => 'Kalender',
    'weekend'                 => 'Helg',
    'client_secret'           => 'Client Secret',

];
