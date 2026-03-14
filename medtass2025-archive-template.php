<?php
/**
 * Template Name: Medtass 2025 Archive Landing
 * Description: Self-contained custom WordPress page template that recreates the archived Medtass 2025 landing page with internal multi-page navigation and Wayback assets.
 */

$menu_items = [
    ['label' => 'Home', 'slug' => 'home'],
    ['label' => 'MED TASS', 'slug' => 'medtass'],
    ['label' => 'Segreteria Scientifica', 'slug' => 'segreteria'],
    ['label' => 'Faculty', 'slug' => 'faculty'],
    ['label' => 'Programma', 'slug' => 'programma'],
    ['label' => 'Partners', 'slug' => 'partner'],
    ['label' => 'Sede del Congresso', 'slug' => 'sede'],
    ['label' => 'Iscrizioni', 'slug' => 'iscrizione'],
    ['label' => 'Contatti', 'slug' => 'contatti'],
];

$valid_pages = [];
foreach ($menu_items as $menu_item) {
    $valid_pages[] = $menu_item['slug'];
}

$current_page = isset($_GET['medtass_page']) ? sanitize_key(wp_unslash($_GET['medtass_page'])) : 'home';
if (!in_array($current_page, $valid_pages, true)) {
    $current_page = 'home';
}

$base_page_url = get_permalink();
if (empty($base_page_url)) {
    $base_page_url = home_url('/');
}

$page_urls = [];
foreach ($menu_items as $menu_item) {
    if ($menu_item['slug'] === 'home') {
        $page_urls[$menu_item['slug']] = remove_query_arg('medtass_page', $base_page_url);
    } else {
        $page_urls[$menu_item['slug']] = add_query_arg('medtass_page', $menu_item['slug'], $base_page_url);
    }
}

$scientific_secretariat = [
    [
        'name' => 'Gaetano Burgio',
        'role' => 'Direttore del Corso / Comitato Scientifico',
        'bio' => 'Responsabile dell’UO di Anestesia e Sala Operatoria dell’Istituto Mediterraneo Trapianti e Terapie ad alta specializzazione (ISMETT) di Palermo, Sicilia-Italia',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/Gaetano-Burgio-180x180.jpg',
    ],
    [
        'name' => 'Raymond M. Planinsic',
        'role' => 'Direttore del Corso / Comitato Scientifico',
        'bio' => 'Professor of Anesthesiology and Perioperative Medicine - University of Pittsburgh School of Medicine - Director of Transplantation Anesthesiology - University of Pittsburgh Medical Center - Pittsburgh, Pennsylvania USA',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/planinsic-raymond-1245205780-180x180.jpg',
    ],
    [
        'name' => 'Giuseppe Chiaramonte',
        'role' => 'Comitato Scientifico',
        'bio' => 'Responsabile del Centro di Simulazione “Fiandaca” ed Anestesista dell’Istituto Mediterraneo Trapianti e Terapie ad alta specializzazione (ISMETT) di Palermo, Sicilia-Italia',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/1517407760543-180x180.jpg',
    ],
    [
        'name' => 'Gennaro Martucci',
        'role' => 'Comitato Scientifico',
        'bio' => 'Responsabile dell’UO di Anestesia pediatrica dell’Istituto Mediterraneo Trapianti e Terapie ad alta specializzazione (ISMETT) di Palermo, Sicilia-Italia',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/Gennaro-Martucci-180x180.jpg',
    ],
    [
        'name' => 'Giovanna Panarello',
        'role' => 'Comitato Scientifico',
        'bio' => 'Responsabile dell’UO di Terapia Intensiva dell’Istituto Mediterraneo Trapianti e Terapie ad alta specializzazione (ISMETT) di Palermo, Sicilia-Italia',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/fam_2022W-180x180.png',
    ],
];

$faculty_columns = [
    [
        'Antonio Filippo Arcadipane - Palermo',
        'Giuseppe Arena - Palermo',
        'Pamela Asaro - Palermo',
        'Gabriele Baldini - Firenze',
        'Claudia Bianco - Palermo',
        'Gianni Biancofiore - Pisa',
        'Elena Bignami - Parma',
        'Ilenia Bonanno - Catania',
        'Eleonora Bonicolini - Palermo',
        'Gaetano Burgio - Palermo',
        'Guido Capitanio - Palermo',
        'Paolo Capuano - Palermo',
        'Giuseppe Chiaramonte - Palermo',
        'Sara Coppolecchia - Palermo',
        'Antonio D’Anna - Palermo',
        'Anita Farinella - Palermo',
        'Giuseppe Feltrin - Roma',
    ],
    [
        'Roberta Gallinoro - Palermo',
        'Antonello Giarratano - Palermo',
        'Salvatore Gruttadauria - Palermo',
        'Mark E. Hudson - Pittsburgh',
        'Giovanni Lino - Palermo',
        'Fabio Lullo - Palermo',
        'Gennaro Martucci - Palermo',
        'Vincenzo Mazzarese - Palermo',
        'Maria Teresa Mazzeo - Messina',
        'Duilio Pagano - Palermo',
        'Cesira Palmeri - Palermo',
        'Giovanna Panarello - Palermo',
        'Ettore Panascia - Catania',
        'Salvatore Pasta - Palermo',
        'Bruna Piazza - Termini Imerese',
        'Marcello Piazza - Palermo',
        'Michele Pilato - Palermo',
    ],
    [
        'Stefania Pintacuda - Palermo',
        'Raymond M. Planinsic - Pittsburgh',
        'Francesco Pugliese - Roma',
        'Maurizio Ranieri - Palermo',
        'Baldo Renda - Palermo',
        'Luigi Riccioni - Roma',
        'Matteo Rossetti - Palermo',
        'Francesca Rubulotta - Catania',
        'Maria Scarlata - Palermo',
        'Sergio Sciacca - Palermo',
        'Kenichi Tanaka - Oklahoma City',
        'Giorgia Tancredi - Palermo',
        'Antonino Toscano - Torino',
        'Aisha Ullah - Pittsburgh',
        'Paolo Zanatta - Treviso',
        'Alberto Zanella - Milano',
        'Marinella Zanierato - Torino',
    ],
];

$program_days = [
    [
        'title' => 'Venerdì 16 Maggio 2025',
        'items' => [
            '08:00 Registrazione dei partecipanti',
            '08:30 Opening Remarks - Gaetano Burgio, Raymond M. Planinsic',
            '08:45 Grand Opening - Victor Scott Memorial - Antonio Filippo Arcadipane',
            '09:00 Grand Opening - Ruolo del Medico nella medicina Perioperatoria - Elena Bignami',
            'Didactic I',
            'Moderano: Giuseppe Feltrin - Ettore Panascia - Michele Pilato',
            '09:15 Il Paziente con Scompenso Cardiaco: le nuove frontiere farmacologica vs l’assistenza meccanica Dall’ ECMO al VAD - Sergio Sciacca',
            '09:35 ECMO nell’ARDS: le indicazioni stanno aumentando - Da definire',
            '10:00 ECMO nella Perfusione Regionale nel potenziale donatore a Cuore Fermo - Marinella Zanierato',
            '10:40 Coffee break',
            '11:00 Simulation: Crisis Management',
            'Lab 1: Ventilare o Rimpiazzare la Ventilazione? - Matteo Rossetti, Giorgia Tancredi, Maurizio Rainieri',
            'Lab 2: Individuazione del potenziale donatore di Organi: il donatore DCD - Sara Coppolecchia, Ilenia Bonanno, Paolo Zanatta',
            'Lab 3: L’assetto coagulativo durante le assistenze extracorporee - Gennaro Martucci, Tanaka, Roberta Gallinoro',
            '13:00 Lunch',
            'Didactic II',
            'Moderano: Giuseppe Arena, Maria Teresa Mazzeo, Vincenzo Mazzarese',
            '14:15 La CRRT nel paziente critico: dallo scompenso cardiaco all’insufficienza del graft - Giovanna Panarello',
            '14.40 Il paziente con Danno cerebrale Devastante e con prognosi infausta: l’assistenza di Fine Vita in terapia intensiva - Luigi Riccioni',
            '15.00 La Gestione responsabile di una terapia intensiva: tra sostenibilità e prendersi cura - Francesco Pugliese',
            '15.20 Il ruolo chiave dei professionisti della cura: i Fisioterapisti e gli Infermieri - Da definire',
            '15:50 Coffee break',
            '16:00 Simulation: ECMO',
            'Lab 1: ECMO nella insufficienza cardiaca - Giovanni Lino, Cesira Palmeri',
            'Lab 2: ECMO nella insufficienza respiratoria - Guido Capitanio, Zanella Alberto',
            'Lab 3: ECMO nella Perfusione Regionale - Marinella Zanierato, Claudia Bianco',
            '17:30 Chiusura dei lavori della giornata',
        ],
    ],
    [
        'title' => 'Sabato 17 Maggio 2025',
        'items' => [
            '08:30 Apertura dei lavori - Gaetano Burgio, Raymond M. Planinsic',
            '08:45 L’intelligenza Artificiale: la trasformazione del prendersi cura - da definire',
            'Didactic I',
            'Moderano: Marcello Piazza, Giandomenico Biancofiore, Antonello Giarratano',
            '09:15 Donazione di Fegato da Donatore Vivente: l’esperienza di 15 anni di un singolo centro - Raymond M. Planinsic',
            '09:35 Donazione di Fegato da donatore DCD: come scelgo la macchina di perfusione ex vivo - Duilio Pagano',
            '10:00 Cosa ho imparato dalla gestione del donatore di Polmone? - Alberto Zanella',
            '10:20 Il Trattamento Anestesiologico nella chirurgia pediatrica maggiore - Gennaro Martucci',
            '10:40 Presentation of ISMETT Clinical Innovations and Teaching Excellence Awards - Gaetano Burgio, Mark E. Hudson, Raymond M. Planinsic',
            '10:45 Coffee break',
            '11:00 Simulation: Crisis Management',
            'Lab 1: Il paziente trapiantato di Polmone da sottoporre ad una chirurgia minore - Maria Scarlata Asaro',
            'Lab 2: Il paziente trapiantato di Fegato da sottoporre ad una chirurgia minore - Gianni Biancofiore, Giuseppe Chiaramonte',
            'Lab 3: Il paziente portatore di VAD da sottoporre ad una chirurgia minore - Eleonora Bonicolini',
            '13:00 Lunch',
            'Didactic II',
            'Moderano: Baldo Renda, Salvatore Gruttadauria, Bruna Piazza, Francesca Rubulotta',
            '14:00 L’anestesia Loco-Regionale nella chirurgia maggiore - Antonio Toscano',
            '14.20 La pre-riabilitazione prima della chirurgia maggiore - Gabriele Baldini',
            '14.40 Strategie per affrontare l’ipertensione portale in sala operatoria - Aisha Ullah',
            '15:00 Coffee break',
            '16:00 Plenary Simulation: new frontiers in clinical practice',
            'Lab 1: La realtà aumentata nella pratica clinica - Salvatore Pasta, Elena Bignami',
            'Lab 2: Quale blocco per quale chirurgia - Paolo Capuano, Stefania Pintacuda',
            'Lab 3: Gestione degli accessi vascolari difficili nel paziente critico - Fabio Lullo, Antonio D’Anna, Anita Farinella',
            '17:30 Verifica dell’apprendimento',
            '18:00 Chiusura dei lavori del Convegno',
        ],
    ],
];

$partners = [
    [
        'name' => 'ESRA Italia',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/esra.png',
    ],
    [
        'name' => 'ITACTAIC',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/itactaic.png',
    ],
    [
        'name' => 'SIAARTI',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/siarti.png',
    ],
    [
        'name' => 'Università degli Studi di Palermo',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/02/UNIPA.png',
    ],
];

$sponsors = [
    [
        'name' => 'Dea Medical',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/dea-medical.png',
    ],
    [
        'name' => 'Disposable',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/disposable.png',
    ],
    [
        'name' => 'Drager',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/drager.png',
    ],
    [
        'name' => 'Esaote',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/esaote.png',
    ],
    [
        'name' => 'Formedical',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/formedical.png',
    ],
    [
        'name' => 'Medicina',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/02/medicina.png',
    ],
    [
        'name' => 'Teleflex',
        'image' => 'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/02/teleflex.png',
    ],
];

$venue_gallery = [
    'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/benvenuti-al-saracen-1240x826-1-1030x686.jpg',
    'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/Location-per-eventi-Tramonto-Terrazza-Marine.jpg',
    'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/parco-mediterraneo-saracen.jpg',
    'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/prato-panorama-saracen.jpg',
    'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/Saracen-Teatro-del-Sole-Allestimento-Platea-1240x826-1-1030x686.jpg',
    'https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/terrazza-marine-sera.jpg',
];

$total_faculty = 0;
foreach ($faculty_columns as $faculty_column) {
    $total_faculty += count($faculty_column);
}

$view_meta = [
    'medtass' => [
        'eyebrow' => 'Congress Overview',
        'title' => 'MED TASS',
        'intro' => 'A focused overview of the symposium mission, the clinical themes driving the 2025 edition, and the simulation-based learning model that defines the congress.',
        'highlights' => [
            ['label' => 'Format', 'value' => 'Magistral lectures, labs, and direct expert exchange'],
            ['label' => 'Clinical Focus', 'value' => 'Critical care, transplantation, perioperative medicine, ECMO'],
            ['label' => 'Teaching Style', 'value' => 'High-value practical transfer for everyday clinical work'],
        ],
        'cta_label' => 'Meet The Scientific Secretariat',
        'cta_slug' => 'segreteria',
    ],
    'segreteria' => [
        'eyebrow' => 'Scientific Leadership',
        'title' => 'Segreteria Scientifica',
        'intro' => 'The academic direction of MED TASS 2025 is guided by transplant, anesthesia, and simulation leaders with strong clinical and teaching experience.',
        'highlights' => [
            ['label' => 'Core Team', 'value' => count($scientific_secretariat) . ' lead profiles featured'],
            ['label' => 'Disciplines', 'value' => 'Transplant anesthesia, intensive care, pediatric anesthesia, simulation'],
            ['label' => 'Goal', 'value' => 'Translate expertise into applied training and scientific discussion'],
        ],
        'cta_label' => 'Explore Faculty',
        'cta_slug' => 'faculty',
    ],
    'faculty' => [
        'eyebrow' => 'Guest Speakers',
        'title' => 'Faculty',
        'intro' => 'A broad faculty network brings together national and international voices from Palermo, Pittsburgh, Rome, Milan, Turin, Catania, and beyond.',
        'highlights' => [
            ['label' => 'Faculty Count', 'value' => $total_faculty . ' listed contributors'],
            ['label' => 'Geography', 'value' => 'Italy and international transplant centers'],
            ['label' => 'Coverage', 'value' => 'Critical care, transplantation, donor management, regional anesthesia'],
        ],
        'cta_label' => 'View Program',
        'cta_slug' => 'programma',
    ],
    'programma' => [
        'eyebrow' => 'Two-Day Schedule',
        'title' => 'Programma',
        'intro' => 'The program combines didactic sessions, simulation labs, faculty-led discussions, and practical workshops across two congress days in Palermo.',
        'highlights' => [
            ['label' => 'Duration', 'value' => '2 days of structured scientific content'],
            ['label' => 'Tracks', 'value' => 'Didactic sessions, crisis simulation, ECMO, plenary labs'],
            ['label' => 'Approach', 'value' => 'Balanced mix of lectures and practical scenarios'],
        ],
        'cta_label' => 'View Registration',
        'cta_slug' => 'iscrizione',
    ],
    'partner' => [
        'eyebrow' => 'Institutional Support',
        'title' => 'Partners',
        'intro' => 'The congress is backed by scientific societies, academic institutions, and supporting companies aligned with anesthesia, transplantation, and intensive care.',
        'highlights' => [
            ['label' => 'Patrocini', 'value' => count($partners) . ' institutional supporters shown'],
            ['label' => 'Sponsor Grid', 'value' => count($sponsors) . ' sponsor marks included'],
            ['label' => 'Relevance', 'value' => 'Aligned with clinical training and congress infrastructure'],
        ],
        'cta_label' => 'See Venue',
        'cta_slug' => 'sede',
    ],
    'sede' => [
        'eyebrow' => 'Congress Venue',
        'title' => 'Sede Del Congresso',
        'intro' => 'Saracen Sands Hotel offers a sea-facing congress setting near Palermo, with accessibility, event infrastructure, and hospitality suitable for a two-day medical symposium.',
        'highlights' => [
            ['label' => 'Venue', 'value' => 'Saracen Sands Hotel & Congress Centre'],
            ['label' => 'Location', 'value' => 'Isola delle Femmine, Palermo'],
            ['label' => 'Gallery', 'value' => count($venue_gallery) . ' archived venue images included'],
        ],
        'cta_label' => 'Contact The Organizers',
        'cta_slug' => 'contatti',
    ],
    'iscrizione' => [
        'eyebrow' => 'Registration',
        'title' => 'Iscrizioni',
        'intro' => 'The registration page focuses attention on the congress form, enrollment timing, and the practical next step for attendees planning participation.',
        'highlights' => [
            ['label' => 'Call To Action', 'value' => 'Direct registration emphasis'],
            ['label' => 'Deadline Note', 'value' => 'Registrations accepted until 30 April 2025'],
            ['label' => 'Audience', 'value' => 'Participants interested in high-level perioperative and transplant education'],
        ],
        'cta_label' => 'Open Contact Page',
        'cta_slug' => 'contatti',
    ],
    'contatti' => [
        'eyebrow' => 'Organizer Contacts',
        'title' => 'Contatti',
        'intro' => 'Organizer details, contact information, and a non-functional display form are kept together so the page looks complete while preserving the same visual language.',
        'highlights' => [
            ['label' => 'Organizer', 'value' => 'FAM Eventi Soc. Coop.'],
            ['label' => 'Contact Type', 'value' => 'Email, address, organizer identity, social presence'],
            ['label' => 'Layout', 'value' => 'Static form preview with shared site footer and navigation'],
        ],
        'cta_label' => 'Back To Home',
        'cta_slug' => 'home',
    ],
];
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <?php wp_head(); ?>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap");

        :root {
            --md-bg: #f3f3f3;
            --md-surface: #ffffff;
            --md-surface-soft: #f8f8f8;
            --md-border: rgba(55, 40, 108, 0.12);
            --md-header-bg: #322459;
            --md-heading: #37286c;
            --md-copy: #949494;
            --md-copy-strong: #6f6f74;
            --md-accent: #ef7828;
            --md-accent-deep: #5a1f59;
            --md-hero-overlay: rgba(50, 36, 89, 0.82);
            --md-shadow: 0 24px 64px rgba(44, 29, 88, 0.12);
            --md-radius: 26px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-width: 320px;
            background: var(--md-bg);
            font-family: "Lato", Arial, sans-serif;
            color: var(--md-copy);
            scroll-behavior: auto;
        }

        body {
            overflow-x: hidden;
        }

        img,
        iframe {
            display: block;
            max-width: 100%;
        }

        button,
        input,
        textarea,
        select,
        label,
        iframe {
            pointer-events: none;
            cursor: default !important;
        }

        a {
            color: inherit;
            text-decoration: none;
            pointer-events: auto;
            cursor: pointer;
        }

        .medtass-page {
            position: relative;
            background: var(--md-bg);
        }

        .md-container {
            width: min(100% - 40px, 1460px);
            margin: 0 auto;
        }

        .md-header {
            position: sticky;
            top: 0;
            z-index: 20;
            background: rgba(50, 36, 89, 0.96);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .md-header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 18px 0;
        }

        .md-logo img {
            width: 220px;
            height: auto;
        }

        .md-nav {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 14px 22px;
            flex-wrap: wrap;
        }

        .md-nav a {
            font-size: 15px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.84);
            letter-spacing: 0.04em;
            text-transform: uppercase;
            transition: opacity 160ms ease;
        }

        .md-nav a:hover,
        .md-nav a.is-active {
            color: #ffffff;
            opacity: 1;
        }

        .md-nav a.is-active {
            position: relative;
        }

        .md-nav a.is-active::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: -8px;
            height: 2px;
            background: var(--md-accent);
        }

        .md-hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            background:
                linear-gradient(0deg, var(--md-hero-overlay), var(--md-hero-overlay)),
                url("https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/save-the-date-ismett-ok-2-copia-1.png") center/cover no-repeat;
        }

        .md-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at top left, rgba(239, 120, 40, 0.32), transparent 26%),
                radial-gradient(circle at bottom right, rgba(255, 255, 255, 0.08), transparent 28%);
        }

        .md-hero-inner {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(260px, 360px);
            gap: 36px;
            align-items: end;
            padding: 130px 0 110px;
        }

        .md-kicker {
            margin: 0 0 22px;
            color: #ffffff;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        .md-hero-title {
            margin: 0;
            color: #ffffff;
            font-size: clamp(3.5rem, 9vw, 6.7rem);
            line-height: 0.95;
            font-weight: 900;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .md-hero-subtitle {
            margin: 20px 0 0;
            max-width: 860px;
            color: #efefef;
            font-size: clamp(1.2rem, 2.7vw, 2rem);
            line-height: 1.5;
            font-weight: 300;
        }

        .md-hero-subtitle strong {
            color: var(--md-accent);
            font-weight: 700;
        }

        .md-rule {
            width: 72px;
            height: 4px;
            margin: 38px auto 0;
            background: #111111;
        }

        .md-rule-light {
            margin: 34px 0 0;
            background: #ffffff;
        }

        .md-cta-panel {
            justify-self: end;
            width: 100%;
            padding: 24px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
        }

        .md-cta-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 78px;
            border-radius: 12px;
            background: var(--md-accent);
            color: #ffffff;
            font-size: 24px;
            font-weight: 900;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .md-section {
            padding: 100px 0;
        }

        .md-subpage-hero {
            background:
                linear-gradient(0deg, rgba(50, 36, 89, 0.9), rgba(50, 36, 89, 0.9)),
                url("https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/save-the-date-ismett-ok-2-copia-1.png") center/cover no-repeat;
            color: #ffffff;
        }

        .md-subpage-hero-inner {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(280px, 0.85fr);
            gap: 40px;
            align-items: center;
            padding: 88px 0;
        }

        .md-subpage-hero h1 {
            margin: 10px 0 0;
            color: #ffffff;
            font-size: clamp(3.2rem, 6vw, 5.2rem);
            line-height: 0.98;
            font-weight: 900;
            text-transform: uppercase;
        }

        .md-subpage-hero p {
            margin: 18px 0 0;
            max-width: 820px;
            color: rgba(255, 255, 255, 0.84);
            font-size: 20px;
            line-height: 1.8;
        }

        .md-kicker-subpage {
            margin: 0;
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .md-subpage-panel {
            padding: 28px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.08);
        }

        .md-subpage-panel h3 {
            margin: 0 0 16px;
            color: #ffffff;
            font-size: 20px;
            line-height: 1.3;
            text-transform: uppercase;
        }

        .md-subpage-panel p {
            margin: 0 0 10px;
            color: rgba(255, 255, 255, 0.78);
            font-size: 16px;
            line-height: 1.7;
        }

        .md-highlight-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
            margin-top: 46px;
        }

        .md-highlight-card {
            padding: 26px 24px;
            border-radius: 18px;
            background: var(--md-surface);
            box-shadow: var(--md-shadow);
        }

        .md-highlight-card h3 {
            margin: 0 0 10px;
            color: var(--md-accent-deep);
            font-size: 16px;
            line-height: 1.3;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .md-highlight-card p {
            margin: 0;
            color: var(--md-copy-strong);
            font-size: 20px;
            line-height: 1.55;
            font-weight: 700;
        }

        .md-section-soft {
            background: #f8f8f8;
        }

        .md-section-heading {
            margin: 0;
            color: var(--md-heading);
            text-align: center;
            font-size: clamp(3rem, 5.2vw, 4.6rem);
            line-height: 1;
            font-weight: 300;
            text-transform: uppercase;
        }

        .md-section-heading strong {
            font-weight: 900;
        }

        .md-section-intro {
            max-width: 860px;
            margin: 18px auto 0;
            color: var(--md-copy);
            text-align: center;
            font-size: 20px;
            line-height: 1.75;
        }

        .md-about-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.55fr) minmax(320px, 0.95fr);
            gap: 64px;
            margin-top: 70px;
            align-items: start;
        }

        .md-copy p {
            margin: 0 0 22px;
            color: var(--md-copy);
            font-size: 24px;
            line-height: 1.65;
            font-weight: 400;
        }

        .md-signoff {
            margin-top: 18px;
            text-align: right;
            color: var(--md-copy-strong);
            font-size: 24px;
        }

        .md-signoff strong {
            display: block;
            color: var(--md-heading);
            font-weight: 700;
            line-height: 1.6;
        }

        .md-video-stack {
            display: grid;
            gap: 34px;
        }

        .md-video-card {
            overflow: hidden;
            border-radius: 18px;
            background: #1f1f1f;
            box-shadow: var(--md-shadow);
        }

        .md-video-card iframe {
            width: 100%;
            height: 315px;
            border: 0;
            filter: grayscale(0.18);
        }

        .md-team-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 22px;
            margin-top: 60px;
        }

        .md-team-card {
            height: 100%;
            padding: 28px 22px 30px;
            border-radius: 22px;
            background: var(--md-surface);
            box-shadow: var(--md-shadow);
            text-align: center;
        }

        .md-team-card img {
            width: 180px;
            height: 180px;
            margin: 0 auto 22px;
            border-radius: 999px;
            object-fit: cover;
            box-shadow: 0 12px 34px rgba(55, 40, 108, 0.14);
        }

        .md-team-card h3 {
            margin: 0 0 10px;
            color: var(--md-heading);
            font-size: 28px;
            line-height: 1.15;
        }

        .md-role {
            margin: 0 0 14px;
            color: var(--md-accent-deep);
            font-size: 18px;
            font-weight: 700;
            line-height: 1.45;
        }

        .md-bio {
            margin: 0;
            color: var(--md-copy);
            font-size: 18px;
            line-height: 1.65;
        }

        .md-faculty-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 42px;
            margin-top: 60px;
        }

        .md-faculty-column {
            padding: 36px 34px;
            border-radius: 22px;
            background: var(--md-surface);
            box-shadow: var(--md-shadow);
        }

        .md-faculty-column p {
            margin: 0 0 14px;
            color: var(--md-copy);
            font-size: 24px;
            line-height: 1.5;
        }

        .md-program-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 50px;
            margin-top: 60px;
            align-items: start;
        }

        .md-program-card {
            padding: 42px 36px;
            border-radius: 22px;
            background: var(--md-surface);
            box-shadow: var(--md-shadow);
        }

        .md-program-card h3 {
            margin: 0;
            color: var(--md-heading);
            font-size: clamp(2.1rem, 4vw, 3.1rem);
            line-height: 1.05;
            font-weight: 300;
            text-transform: uppercase;
        }

        .md-program-card .md-rule {
            margin: 34px 0 28px;
        }

        .md-program-card p {
            margin: 0 0 20px;
            color: var(--md-copy);
            font-size: 20px;
            line-height: 1.6;
        }

        .md-program-card p strong {
            color: var(--md-accent-deep);
        }

        .md-download-wrap {
            margin-top: 34px;
        }

        .md-download {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 96px;
            border-radius: 8px;
            background: var(--md-accent-deep);
            color: #ffffff;
            font-size: 28px;
            font-weight: 700;
        }

        .md-logo-grid,
        .md-sponsor-grid {
            display: grid;
            gap: 28px;
            margin-top: 54px;
        }

        .md-logo-grid {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .md-sponsor-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .md-logo-card {
            min-height: 198px;
            padding: 24px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.58);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .md-logo-card img {
            max-height: 112px;
            width: auto;
            object-fit: contain;
        }

        .md-subheading {
            margin: 12px 0 0;
            text-align: center;
            color: var(--md-copy);
            font-size: 18px;
            line-height: 1.5;
        }

        .md-venue-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(320px, 0.82fr);
            gap: 56px;
            margin-top: 60px;
            align-items: start;
        }

        .md-venue-copy h3,
        .md-venue-contact h4 {
            margin: 0 0 18px;
            color: var(--md-heading);
            text-transform: uppercase;
        }

        .md-venue-copy h3 {
            font-size: clamp(2.6rem, 5vw, 4.1rem);
            line-height: 1.02;
            font-weight: 900;
        }

        .md-venue-copy p,
        .md-venue-contact p {
            margin: 0 0 18px;
            color: var(--md-copy);
            font-size: 22px;
            line-height: 1.65;
        }

        .md-venue-contact {
            padding-top: 16px;
        }

        .md-venue-contact h4 {
            font-size: 22px;
            line-height: 1.2;
            font-weight: 900;
        }

        .md-venue-contact strong {
            display: block;
            margin-bottom: 18px;
            color: var(--md-accent-deep);
            font-size: 24px;
            line-height: 1.45;
        }

        .md-gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-top: 54px;
        }

        .md-gallery-grid img {
            width: 100%;
            height: 280px;
            object-fit: cover;
        }

        .md-register {
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(0deg, rgba(72, 27, 73, 0.76), rgba(72, 27, 73, 0.76)),
                url("https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/save-the-date-ismett-ok-2-copia-1.png") center/cover no-repeat;
        }

        .md-register-inner {
            padding: 130px 0;
            text-align: center;
        }

        .md-register h2 {
            margin: 0;
            color: #ffffff;
            font-size: clamp(2.8rem, 5vw, 4.7rem);
            line-height: 1.08;
            font-weight: 300;
            text-transform: uppercase;
        }

        .md-register h2 strong {
            font-weight: 900;
        }

        .md-register p {
            margin: 18px auto 0;
            max-width: 760px;
            color: rgba(255, 255, 255, 0.85);
            font-size: 18px;
            line-height: 1.7;
        }

        .md-register .md-cta-button {
            width: min(100%, 340px);
            margin: 34px auto 0;
        }

        .md-contact-layout {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0;
            overflow: hidden;
            border-radius: 28px 28px 0 0;
            box-shadow: var(--md-shadow);
        }

        .md-contact-column {
            padding: 54px 48px;
        }

        .md-contact-column:first-child {
            background: #fcfcfc;
        }

        .md-contact-column:last-child {
            background: #ffffff;
        }

        .md-contact-column h3 {
            margin: 0;
            color: var(--md-heading);
            text-align: center;
            font-size: clamp(2.3rem, 4.5vw, 3.4rem);
            line-height: 1.05;
            font-weight: 300;
        }

        .md-contact-rule {
            margin: 34px auto 36px;
        }

        .md-organizer {
            display: grid;
            grid-template-columns: 180px minmax(0, 1fr);
            gap: 28px;
            align-items: start;
        }

        .md-organizer img {
            width: 180px;
            height: 180px;
            object-fit: cover;
        }

        .md-organizer h4 {
            margin: 0 0 16px;
            color: var(--md-heading);
            font-size: 28px;
            line-height: 1.2;
        }

        .md-organizer p,
        .md-contact-copy {
            margin: 0 0 14px;
            color: var(--md-copy);
            font-size: 22px;
            line-height: 1.65;
        }

        .md-socials {
            display: flex;
            gap: 14px;
            margin-top: 18px;
        }

        .md-social {
            width: 52px;
            height: 52px;
            border-radius: 999px;
            border: 1px solid rgba(55, 40, 108, 0.18);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--md-heading);
            font-size: 18px;
            font-weight: 900;
        }

        .md-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .md-form-field {
            display: block;
        }

        .md-form-field.md-full {
            grid-column: 1 / -1;
        }

        .md-form-field span {
            display: block;
            margin-bottom: 8px;
            color: var(--md-copy-strong);
            font-size: 15px;
            font-weight: 700;
        }

        .md-form-field input,
        .md-form-field textarea {
            width: 100%;
            border: 1px solid rgba(55, 40, 108, 0.12);
            border-radius: 10px;
            background: #fafafa;
            color: var(--md-copy);
            padding: 15px 16px;
            font: inherit;
        }

        .md-form-field textarea {
            min-height: 140px;
            resize: none;
        }

        .md-checkbox {
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .md-checkbox input {
            width: 18px;
            height: 18px;
            margin-top: 4px;
        }

        .md-checkbox p {
            margin: 0;
            color: var(--md-copy);
            font-size: 16px;
            line-height: 1.6;
        }

        .md-submit {
            width: 160px;
            min-height: 54px;
            border-radius: 10px;
            background: var(--md-accent-deep);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 700;
        }

        .md-map iframe {
            width: 100%;
            height: 600px;
            border: 0;
        }

        .md-footer {
            background: var(--md-header-bg);
        }

        .md-footer-top {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 36px;
            padding: 44px 0;
        }

        .md-footer-card h4 {
            margin: 0 0 20px;
            color: #ffffff;
            font-size: 26px;
            line-height: 1.2;
            text-transform: uppercase;
        }

        .md-footer-card p {
            margin: 0 0 12px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 20px;
            line-height: 1.6;
        }

        .md-footer-card img {
            width: 180px;
            height: auto;
            margin-bottom: 18px;
        }

        .md-footer-brand {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .md-footer-brand img {
            width: 300px;
            max-width: 100%;
            height: auto;
        }

        .md-socket {
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            padding: 22px 0 30px;
            color: rgba(255, 255, 255, 0.84);
            font-size: 16px;
            text-align: center;
        }

        .md-socket small {
            display: block;
            margin-top: 8px;
            color: rgba(255, 255, 255, 0.68);
            font-size: 14px;
            letter-spacing: 0.04em;
        }

        .md-scroll-indicator {
            position: fixed;
            right: 24px;
            bottom: 24px;
            z-index: 10;
            width: 70px;
            height: 70px;
            border-radius: 4px;
            background: rgba(112, 99, 149, 0.92);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: 700;
            box-shadow: 0 18px 32px rgba(51, 34, 92, 0.18);
        }

        @media (max-width: 1380px) {
            .md-team-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .md-logo-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 1180px) {
            .md-header {
                position: relative;
            }

            .md-header-inner,
            .md-hero-inner,
            .md-subpage-hero-inner,
            .md-about-grid,
            .md-venue-grid,
            .md-contact-layout,
            .md-footer-top {
                grid-template-columns: 1fr;
            }

            .md-header-inner {
                display: block;
                text-align: center;
            }

            .md-logo {
                display: inline-block;
                margin-bottom: 20px;
            }

            .md-nav {
                justify-content: center;
            }

            .md-hero {
                min-height: auto;
            }

            .md-hero-inner {
                padding: 100px 0 80px;
            }

            .md-cta-panel {
                justify-self: start;
                max-width: 360px;
            }

            .md-faculty-grid,
            .md-program-grid,
            .md-highlight-grid,
            .md-gallery-grid,
            .md-sponsor-grid {
                grid-template-columns: 1fr;
            }

            .md-organizer {
                grid-template-columns: 1fr;
            }

            .md-footer-brand {
                justify-content: flex-start;
            }
        }

        @media (max-width: 860px) {
            .md-section {
                padding: 76px 0;
            }

            .md-copy p,
            .md-faculty-column p,
            .md-venue-copy p,
            .md-venue-contact p,
            .md-organizer p,
            .md-contact-copy {
                font-size: 19px;
            }

            .md-team-grid,
            .md-logo-grid,
            .md-form-grid {
                grid-template-columns: 1fr;
            }

            .md-team-card,
            .md-faculty-column,
            .md-program-card,
            .md-contact-column {
                padding-left: 24px;
                padding-right: 24px;
            }

            .md-video-card iframe {
                height: 240px;
            }

            .md-gallery-grid img {
                height: 220px;
            }

            .md-map iframe {
                height: 420px;
            }
        }

        @media (max-width: 640px) {
            .md-container {
                width: min(100% - 26px, 1460px);
            }

            .md-nav {
                gap: 10px 14px;
            }

            .md-nav a,
            .md-register p,
            .md-subheading,
            .md-checkbox p {
                font-size: 14px;
            }

            .md-subpage-hero p,
            .md-highlight-card p {
                font-size: 17px;
            }

            .md-copy p,
            .md-faculty-column p,
            .md-program-card p,
            .md-venue-copy p,
            .md-venue-contact p,
            .md-organizer p,
            .md-contact-copy,
            .md-footer-card p {
                font-size: 17px;
            }

            .md-program-card,
            .md-faculty-column,
            .md-team-card,
            .md-contact-column {
                border-radius: 18px;
            }

            .md-team-card img {
                width: 140px;
                height: 140px;
            }

            .md-scroll-indicator {
                width: 52px;
                height: 52px;
                right: 14px;
                bottom: 14px;
                font-size: 24px;
            }
        }
    </style>
</head>
<body <?php body_class('medtass-archive-body'); ?>>
<?php wp_body_open(); ?>
<div class="medtass-page">
    <header class="md-header">
        <div class="md-container md-header-inner">
            <a class="md-logo" href="<?php echo esc_url($page_urls['home']); ?>">
                <img src="https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/med.png" alt="Medtass 2025" />
            </a>
            <nav class="md-nav" aria-label="Medtass navigation">
                <?php foreach ($menu_items as $item) : ?>
                    <a class="<?php echo $current_page === $item['slug'] ? 'is-active' : ''; ?>" href="<?php echo esc_url($page_urls[$item['slug']]); ?>"><?php echo esc_html($item['label']); ?></a>
                <?php endforeach; ?>
            </nav>
        </div>
    </header>

    <?php if ($current_page === 'home') : ?>
        <section class="md-hero">
            <div class="md-container md-hero-inner">
                <div>
                    <p class="md-kicker">Palermo 16/17 Maggio 2025</p>
                    <h1 class="md-hero-title">MED TASS 2025</h1>
                    <p class="md-hero-subtitle">
                        <strong>Mediterranean Transplantation</strong><br />
                        <strong>Anesthesiology</strong><br />
                        <strong>and Simulation Symposium</strong>
                    </p>
                    <div class="md-rule md-rule-light"></div>
                </div>
                <div class="md-cta-panel">
                    <a class="md-cta-button" href="<?php echo esc_url($page_urls['iscrizione']); ?>">Iscriviti</a>
                </div>
            </div>
        </section>

        <section class="md-section" id="medtass">
            <div class="md-container">
                <h2 class="md-section-heading">Benvenuti al <strong>MEDTASS</strong></h2>
                <div class="md-rule"></div>
                <div class="md-about-grid">
                    <div class="md-copy">
                        <p>L’ottava edizione di MEDTASS si pone nel contesto nazionale come un appuntamento di riferimento per l’approfondimento delle più innovative metodologie e approcci terapeutici nella cura del paziente critico. Attraverso un programma ricco di letture magistrali, laboratori interattivi e momenti di confronto diretto con esperti, il congresso offrirà un’occasione unica per aggiornarsi sulle ultime frontiere della pratica clinica.</p>
                        <p>L’edizione 2025 si aprirà con un omaggio a Victor Scott, anestesista e rianimatore il cui contributo pionieristico in Trapiantologia presso ISMETT continua a ispirare le nuove generazioni. I suoi insegnamenti saranno il punto di partenza per un viaggio tra i temi più attuali, dal supporto extracorporeo nei setting avanzati di assistenza, alla gestione ottimale delle risorse in Terapia Intensiva, alle nuove frontiere nella donazione a cuore fermo. Il programma approfondirà, inoltre, la gestione perioperatoria di casi complessi e le nuove tecniche di anestesia loco-regionale, senza trascurare il ruolo crescente di Intelligenza Artificiale e Realtà Aumentata a supporto dell’anestesia.</p>
                        <p>Le sessioni pratiche, parte integrante del congresso, permetteranno ai corsisti di confrontarsi con gli esperti e i casi clinici proposti renderanno più efficace il trasferimento delle informazioni.</p>
                        <p>Particolare attenzione sarà dedicata all’importanza del lavoro multidisciplinare, coinvolgendo infermieri, terapisti motori e respiratori nelle sessioni teoriche e pratiche, per promuovere un’assistenza di qualità sempre più integrata e personalizzata.</p>
                        <p>MEDTASS è, come ormai da tradizione, un congresso che mette al centro il confronto e l’apprendimento attivo, con l’obiettivo di trasformare le conoscenze in strumenti concreti per la pratica quotidiana.</p>
                        <div class="md-signoff">
                            <em>I Direttori del Corso</em>
                            <strong>Gaetano Burgio</strong>
                            <strong>Raymond M. Planinsic</strong>
                        </div>
                    </div>
                    <div class="md-video-stack">
                        <div class="md-video-card">
                            <iframe loading="lazy" title="Burgio Presentazione Medtass 2025" src="https://web.archive.org/web/20250218172252/https://www.youtube.com/embed/QdHGnvfj_ng?feature=oembed&amp;autoplay=0&amp;loop=0&amp;controls=1&amp;mute=0" allowfullscreen></iframe>
                        </div>
                        <div class="md-video-card">
                            <iframe loading="lazy" title="Planinsic Presentazione Medtass 2025" src="https://web.archive.org/web/20250218172252/https://www.youtube.com/embed/0ywGXeVCM_w?feature=oembed&amp;autoplay=0&amp;loop=0&amp;controls=1&amp;mute=0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="md-section md-section-soft" id="segreteria">
            <div class="md-container">
                <h2 class="md-section-heading">Segreteria Scientifica</h2>
                <div class="md-rule"></div>
                <div class="md-team-grid">
                    <?php foreach ($scientific_secretariat as $member) : ?>
                        <article class="md-team-card">
                            <img src="<?php echo esc_url($member['image']); ?>" alt="<?php echo esc_attr($member['name']); ?>" />
                            <h3><?php echo esc_html($member['name']); ?></h3>
                            <p class="md-role"><?php echo esc_html($member['role']); ?></p>
                            <p class="md-bio"><?php echo esc_html($member['bio']); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="md-section" id="faculty">
            <div class="md-container">
                <h2 class="md-section-heading">Faculty</h2>
                <div class="md-rule"></div>
                <div class="md-faculty-grid">
                    <?php foreach ($faculty_columns as $column) : ?>
                        <div class="md-faculty-column">
                            <?php foreach ($column as $line) : ?>
                                <p><?php echo esc_html($line); ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="md-section md-section-soft" id="programma">
            <div class="md-container">
                <h2 class="md-section-heading">Programma</h2>
                <div class="md-rule"></div>
                <div class="md-program-grid">
                    <?php foreach ($program_days as $day) : ?>
                        <article class="md-program-card">
                            <h3><?php echo esc_html($day['title']); ?></h3>
                            <div class="md-rule"></div>
                            <?php foreach ($day['items'] as $item) : ?>
                                <?php
                                $formatted = esc_html($item);
                                if (strpos($item, 'Didactic') === 0 || strpos($item, 'Coffee break') !== false || strpos($item, 'Simulation:') !== false || strpos($item, 'Plenary Simulation') !== false) {
                                    $formatted = '<strong>' . esc_html($item) . '</strong>';
                                } elseif (strpos($item, 'Moderano:') === 0) {
                                    $formatted = '<em>' . esc_html($item) . '</em>';
                                }
                                ?>
                                <p><?php echo $formatted; ?></p>
                            <?php endforeach; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
                <div class="md-download-wrap">
                    <a class="md-download" href="<?php echo esc_url($page_urls['programma']); ?>">Download Programma</a>
                </div>
            </div>
        </section>

        <section class="md-section" id="partner">
            <div class="md-container">
                <h2 class="md-section-heading"><strong>Patrocini</strong></h2>
                <div class="md-rule"></div>
                <div class="md-logo-grid">
                    <?php foreach ($partners as $partner) : ?>
                        <div class="md-logo-card">
                            <img src="<?php echo esc_url($partner['image']); ?>" alt="<?php echo esc_attr($partner['name']); ?>" />
                        </div>
                    <?php endforeach; ?>
                </div>

                <h2 class="md-section-heading" style="margin-top: 72px;"><strong>Sponsor</strong></h2>
                <p class="md-subheading">(in aggiornamento)</p>
                <div class="md-sponsor-grid">
                    <?php foreach ($sponsors as $sponsor) : ?>
                        <div class="md-logo-card">
                            <img src="<?php echo esc_url($sponsor['image']); ?>" alt="<?php echo esc_attr($sponsor['name']); ?>" />
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="md-section md-section-soft" id="sede">
            <div class="md-container">
                <h2 class="md-section-heading"><strong>Sede</strong> del <strong>Congresso</strong></h2>
                <div class="md-rule"></div>
                <div class="md-venue-grid">
                    <div class="md-venue-copy">
                        <h3>Saracen Sands Hotel</h3>
                        <p>Il Saracen Sands Hotel è situato ad Isola delle Femmine, in una posizione strategica che pone la struttura a soli pochi km dall’aeroporto di Palermo e dalla città.</p>
                        <p>Si sviluppa in un’area di oltre 3 ettari tra i monti Mollica e Raffo Rosso, il promontorio di Capo Gallo con la sua Riserva Naturale e tra i suggestivi borghi marinari di Mondello e Sferracavallo.</p>
                        <p>Grazie alla sua posizione privilegiata fronte mare, i congressisti potranno godere di splendidi panorami nei momenti di pausa.</p>
                        <p>La struttura gode anche di un ampio parcheggio.</p>
                    </div>
                    <div class="md-venue-contact">
                        <h4>Contatti</h4>
                        <strong>Saracen Sands Hotel &amp; Congress Centre</strong>
                        <p>Via Libertà 128/A<br />90040 Isola delle Femmine<br />Palermo</p>
                        <p>Tel.: +39 091 8671 423</p>
                        <p>Fax.: +39 091 8671 371</p>
                        <p>E-mail: info@saracenhotelpalermo.com</p>
                        <p>Sito web: saracenhotelpalermo.com</p>
                    </div>
                </div>

                <div class="md-gallery-grid">
                    <?php foreach ($venue_gallery as $image) : ?>
                        <img src="<?php echo esc_url($image); ?>" alt="Saracen Sands Hotel" />
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="md-register" id="iscrizione">
            <div class="md-container md-register-inner">
                <h2>Per iscriverti al congresso <strong>compila il nostro form</strong></h2>
                <p>Sarà possibile accettare le iscrizioni pervenute entro il 30 aprile 2025.</p>
                <a class="md-cta-button" href="<?php echo esc_url($page_urls['iscrizione']); ?>">Iscriviti</a>
                <div class="md-rule md-rule-light" style="margin-left:auto;margin-right:auto;"></div>
            </div>
        </section>

        <section class="md-section" id="contatti">
            <div class="md-container">
                <div class="md-contact-layout">
                    <div class="md-contact-column">
                        <h3>Segreteria Organizzativa</h3>
                        <div class="md-rule md-contact-rule"></div>
                        <div class="md-organizer">
                            <img src="https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/fam_2022W-180x180.png" alt="FAM Eventi" />
                            <div>
                                <h4>FAM EVENTI SOC. COOP.</h4>
                                <p>Via Bainsizza n.9 - 90144 - Palermo</p>
                                <p>segreteria@fam-eventi.it</p>
                                <p>P.Iva/C.F.: 070 211 50 821</p>
                                <p>SDI: 5RUO82D</p>
                                <div class="md-socials">
                                    <span class="md-social">f</span>
                                    <span class="md-social">ig</span>
                                    <span class="md-social">in</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md-contact-column">
                        <h3>Resta in contatto con noi</h3>
                        <div class="md-rule md-contact-rule"></div>
                        <div class="md-form-grid">
                            <label class="md-form-field">
                                <span>Name</span>
                                <input type="text" value="" disabled />
                            </label>
                            <label class="md-form-field">
                                <span>E-Mail</span>
                                <input type="email" value="" disabled />
                            </label>
                            <label class="md-form-field md-full">
                                <span>Subject</span>
                                <input type="text" value="" disabled />
                            </label>
                            <label class="md-form-field md-full">
                                <span>Message</span>
                                <textarea disabled></textarea>
                            </label>
                            <label class="md-form-field md-full md-checkbox">
                                <input type="checkbox" disabled />
                                <p>Accetto i termini e le condizioni stabilite sulla Privacy Policy.</p>
                            </label>
                            <div class="md-form-field md-full">
                                <span class="md-submit">Submit</span>
                            </div>
                        </div>
                        <p class="md-contact-copy" style="margin-top: 24px;">Se ti servono informazioni sull’evento o sulla modalità di iscrizione non esitare a contattarci.</p>
                    </div>
                </div>
                <div class="md-map">
                    <iframe loading="lazy" title="Saracen Sands Hotel map" src="https://web.archive.org/web/20250218172252if_/https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3136.1681008997857!2d13.23823837679815!3d38.18276918855189!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1319ea2f027e580f%3A0x7db23be3e8147ef3!2sSaracen%20Sands%20Hotel%20%26%20Congress%20Centre!5e0!3m2!1sit!2sit!4v1737625579400!5m2!1sit!2sit" allowfullscreen></iframe>
                </div>
            </div>
        </section>
    <?php else : ?>
        <?php $meta = $view_meta[$current_page]; ?>
        <section class="md-subpage-hero">
            <div class="md-container md-subpage-hero-inner">
                <div>
                    <p class="md-kicker-subpage"><?php echo esc_html($meta['eyebrow']); ?></p>
                    <h1><?php echo esc_html($meta['title']); ?></h1>
                    <p><?php echo esc_html($meta['intro']); ?></p>
                    <div class="md-rule md-rule-light"></div>
                </div>
                <div class="md-subpage-panel">
                    <h3>Quick Navigation</h3>
                    <p>This page keeps the same archive-inspired header and footer while loading a dedicated content view for the selected section.</p>
                    <p><strong style="color:#ffffff;"><?php echo esc_html($meta['cta_label']); ?></strong></p>
                    <a class="md-cta-button" href="<?php echo esc_url($page_urls[$meta['cta_slug']]); ?>"><?php echo esc_html($meta['cta_label']); ?></a>
                </div>
            </div>
        </section>

        <section class="md-section">
            <div class="md-container">
                <div class="md-highlight-grid">
                    <?php foreach ($meta['highlights'] as $highlight) : ?>
                        <article class="md-highlight-card">
                            <h3><?php echo esc_html($highlight['label']); ?></h3>
                            <p><?php echo esc_html($highlight['value']); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <?php if ($current_page === 'medtass') : ?>
            <section class="md-section md-section-soft">
                <div class="md-container">
                    <h2 class="md-section-heading">Benvenuti al <strong>MEDTASS</strong></h2>
                    <div class="md-rule"></div>
                    <div class="md-about-grid">
                        <div class="md-copy">
                            <p>L’ottava edizione di MEDTASS si pone nel contesto nazionale come un appuntamento di riferimento per l’approfondimento delle più innovative metodologie e approcci terapeutici nella cura del paziente critico. Attraverso un programma ricco di letture magistrali, laboratori interattivi e momenti di confronto diretto con esperti, il congresso offrirà un’occasione unica per aggiornarsi sulle ultime frontiere della pratica clinica.</p>
                            <p>L’edizione 2025 si aprirà con un omaggio a Victor Scott, anestesista e rianimatore il cui contributo pionieristico in Trapiantologia presso ISMETT continua a ispirare le nuove generazioni. I suoi insegnamenti saranno il punto di partenza per un viaggio tra i temi più attuali, dal supporto extracorporeo nei setting avanzati di assistenza, alla gestione ottimale delle risorse in Terapia Intensiva, alle nuove frontiere nella donazione a cuore fermo.</p>
                            <p>Particolare attenzione sarà dedicata all’importanza del lavoro multidisciplinare, coinvolgendo infermieri, terapisti motori e respiratori nelle sessioni teoriche e pratiche, per promuovere un’assistenza di qualità sempre più integrata e personalizzata.</p>
                        </div>
                        <div class="md-video-stack">
                            <div class="md-video-card">
                                <iframe loading="lazy" title="Burgio Presentazione Medtass 2025" src="https://web.archive.org/web/20250218172252/https://www.youtube.com/embed/QdHGnvfj_ng?feature=oembed&amp;autoplay=0&amp;loop=0&amp;controls=1&amp;mute=0" allowfullscreen></iframe>
                            </div>
                            <div class="md-video-card">
                                <iframe loading="lazy" title="Planinsic Presentazione Medtass 2025" src="https://web.archive.org/web/20250218172252/https://www.youtube.com/embed/0ywGXeVCM_w?feature=oembed&amp;autoplay=0&amp;loop=0&amp;controls=1&amp;mute=0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php elseif ($current_page === 'segreteria') : ?>
            <section class="md-section md-section-soft">
                <div class="md-container">
                    <h2 class="md-section-heading">Segreteria Scientifica</h2>
                    <div class="md-rule"></div>
                    <div class="md-team-grid">
                        <?php foreach ($scientific_secretariat as $member) : ?>
                            <article class="md-team-card">
                                <img src="<?php echo esc_url($member['image']); ?>" alt="<?php echo esc_attr($member['name']); ?>" />
                                <h3><?php echo esc_html($member['name']); ?></h3>
                                <p class="md-role"><?php echo esc_html($member['role']); ?></p>
                                <p class="md-bio"><?php echo esc_html($member['bio']); ?></p>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php elseif ($current_page === 'faculty') : ?>
            <section class="md-section md-section-soft">
                <div class="md-container">
                    <h2 class="md-section-heading">Faculty</h2>
                    <div class="md-rule"></div>
                    <div class="md-faculty-grid">
                        <?php foreach ($faculty_columns as $column) : ?>
                            <div class="md-faculty-column">
                                <?php foreach ($column as $line) : ?>
                                    <p><?php echo esc_html($line); ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php elseif ($current_page === 'programma') : ?>
            <section class="md-section md-section-soft">
                <div class="md-container">
                    <h2 class="md-section-heading">Programma</h2>
                    <div class="md-rule"></div>
                    <div class="md-program-grid">
                        <?php foreach ($program_days as $day) : ?>
                            <article class="md-program-card">
                                <h3><?php echo esc_html($day['title']); ?></h3>
                                <div class="md-rule"></div>
                                <?php foreach ($day['items'] as $item) : ?>
                                    <?php
                                    $formatted = esc_html($item);
                                    if (strpos($item, 'Didactic') === 0 || strpos($item, 'Coffee break') !== false || strpos($item, 'Simulation:') !== false || strpos($item, 'Plenary Simulation') !== false) {
                                        $formatted = '<strong>' . esc_html($item) . '</strong>';
                                    } elseif (strpos($item, 'Moderano:') === 0) {
                                        $formatted = '<em>' . esc_html($item) . '</em>';
                                    }
                                    ?>
                                    <p><?php echo $formatted; ?></p>
                                <?php endforeach; ?>
                            </article>
                        <?php endforeach; ?>
                    </div>
                    <div class="md-download-wrap">
                        <a class="md-download" href="<?php echo esc_url($page_urls['iscrizione']); ?>">Vai Alle Iscrizioni</a>
                    </div>
                </div>
            </section>
        <?php elseif ($current_page === 'partner') : ?>
            <section class="md-section md-section-soft">
                <div class="md-container">
                    <h2 class="md-section-heading"><strong>Patrocini</strong></h2>
                    <div class="md-rule"></div>
                    <div class="md-logo-grid">
                        <?php foreach ($partners as $partner) : ?>
                            <div class="md-logo-card">
                                <img src="<?php echo esc_url($partner['image']); ?>" alt="<?php echo esc_attr($partner['name']); ?>" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <h2 class="md-section-heading" style="margin-top: 72px;"><strong>Sponsor</strong></h2>
                    <p class="md-subheading">(in aggiornamento)</p>
                    <div class="md-sponsor-grid">
                        <?php foreach ($sponsors as $sponsor) : ?>
                            <div class="md-logo-card">
                                <img src="<?php echo esc_url($sponsor['image']); ?>" alt="<?php echo esc_attr($sponsor['name']); ?>" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php elseif ($current_page === 'sede') : ?>
            <section class="md-section md-section-soft">
                <div class="md-container">
                    <h2 class="md-section-heading"><strong>Sede</strong> del <strong>Congresso</strong></h2>
                    <div class="md-rule"></div>
                    <div class="md-venue-grid">
                        <div class="md-venue-copy">
                            <h3>Saracen Sands Hotel</h3>
                            <p>Il Saracen Sands Hotel è situato ad Isola delle Femmine, in una posizione strategica che pone la struttura a soli pochi km dall’aeroporto di Palermo e dalla città.</p>
                            <p>Si sviluppa in un’area di oltre 3 ettari tra i monti Mollica e Raffo Rosso, il promontorio di Capo Gallo con la sua Riserva Naturale e tra i suggestivi borghi marinari di Mondello e Sferracavallo.</p>
                            <p>Grazie alla sua posizione privilegiata fronte mare, i congressisti potranno godere di splendidi panorami nei momenti di pausa.</p>
                            <p>La struttura gode anche di un ampio parcheggio.</p>
                        </div>
                        <div class="md-venue-contact">
                            <h4>Contatti</h4>
                            <strong>Saracen Sands Hotel &amp; Congress Centre</strong>
                            <p>Via Libertà 128/A<br />90040 Isola delle Femmine<br />Palermo</p>
                            <p>Tel.: +39 091 8671 423</p>
                            <p>Fax.: +39 091 8671 371</p>
                            <p>E-mail: info@saracenhotelpalermo.com</p>
                            <p>Sito web: saracenhotelpalermo.com</p>
                        </div>
                    </div>
                    <div class="md-gallery-grid">
                        <?php foreach ($venue_gallery as $image) : ?>
                            <img src="<?php echo esc_url($image); ?>" alt="Saracen Sands Hotel" />
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php elseif ($current_page === 'iscrizione') : ?>
            <section class="md-register">
                <div class="md-container md-register-inner">
                    <h2>Per iscriverti al congresso <strong>compila il nostro form</strong></h2>
                    <p>Sarà possibile accettare le iscrizioni pervenute entro il 30 aprile 2025.</p>
                    <a class="md-cta-button" href="<?php echo esc_url($page_urls['contatti']); ?>">Contatta La Segreteria</a>
                    <div class="md-rule md-rule-light" style="margin-left:auto;margin-right:auto;"></div>
                </div>
            </section>
            <section class="md-section">
                <div class="md-container">
                    <div class="md-highlight-grid">
                        <article class="md-highlight-card">
                            <h3>Registration Note</h3>
                            <p>The internal CTA now opens a dedicated registration view instead of a dead archive button.</p>
                        </article>
                        <article class="md-highlight-card">
                            <h3>Visual Match</h3>
                            <p>The violet header, footer, and archive imagery are preserved across the full browsing flow.</p>
                        </article>
                        <article class="md-highlight-card">
                            <h3>Next Step</h3>
                            <p>Use the contact page from the main CTA to continue into organizer information.</p>
                        </article>
                    </div>
                </div>
            </section>
        <?php elseif ($current_page === 'contatti') : ?>
            <section class="md-section md-section-soft">
                <div class="md-container">
                    <div class="md-contact-layout">
                        <div class="md-contact-column">
                            <h3>Segreteria Organizzativa</h3>
                            <div class="md-rule md-contact-rule"></div>
                            <div class="md-organizer">
                                <img src="https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/fam_2022W-180x180.png" alt="FAM Eventi" />
                                <div>
                                    <h4>FAM EVENTI SOC. COOP.</h4>
                                    <p>Via Bainsizza n.9 - 90144 - Palermo</p>
                                    <p>segreteria@fam-eventi.it</p>
                                    <p>P.Iva/C.F.: 070 211 50 821</p>
                                    <p>SDI: 5RUO82D</p>
                                    <div class="md-socials">
                                        <span class="md-social">f</span>
                                        <span class="md-social">ig</span>
                                        <span class="md-social">in</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="md-contact-column">
                            <h3>Resta in contatto con noi</h3>
                            <div class="md-rule md-contact-rule"></div>
                            <div class="md-form-grid">
                                <label class="md-form-field">
                                    <span>Name</span>
                                    <input type="text" value="" disabled />
                                </label>
                                <label class="md-form-field">
                                    <span>E-Mail</span>
                                    <input type="email" value="" disabled />
                                </label>
                                <label class="md-form-field md-full">
                                    <span>Subject</span>
                                    <input type="text" value="" disabled />
                                </label>
                                <label class="md-form-field md-full">
                                    <span>Message</span>
                                    <textarea disabled></textarea>
                                </label>
                                <label class="md-form-field md-full md-checkbox">
                                    <input type="checkbox" disabled />
                                    <p>Accetto i termini e le condizioni stabilite sulla Privacy Policy.</p>
                                </label>
                                <div class="md-form-field md-full">
                                    <span class="md-submit">Submit</span>
                                </div>
                            </div>
                            <p class="md-contact-copy" style="margin-top: 24px;">Se ti servono informazioni sull’evento o sulla modalità di iscrizione non esitare a contattarci.</p>
                        </div>
                    </div>
                    <div class="md-map">
                        <iframe loading="lazy" title="Saracen Sands Hotel map" src="https://web.archive.org/web/20250218172252if_/https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3136.1681008997857!2d13.23823837679815!3d38.18276918855189!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1319ea2f027e580f%3A0x7db23be3e8147ef3!2sSaracen%20Sands%20Hotel%20%26%20Congress%20Centre!5e0!3m2!1sit!2sit!4v1737625579400!5m2!1sit!2sit" allowfullscreen></iframe>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>

    <footer class="md-footer">
        <div class="md-container md-footer-top">
            <div class="md-footer-card">
                <h4>Segreteria Organizzativa</h4>
                <img src="https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/fam_2022W-180x180.png" alt="FAM Eventi" />
                <p>Via Bainsizza n.9 - 90144 - Palermo</p>
                <p>segreteria@fam-eventi.it</p>
                <p>www.fam-eventi.it</p>
            </div>
            <div class="md-footer-brand">
                <img src="https://web.archive.org/web/20250218172252im_/https://www.medtass2025.it/wp-content/uploads/2025/01/med-300x138.png" alt="Medtass 2025" />
            </div>
        </div>
        <div class="md-container">
            <div class="md-socket">
                © Copyright - Medtass2025
                <small>By NH Solutions</small>
            </div>
        </div>
    </footer>

    <div class="md-scroll-indicator" aria-hidden="true">^</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
