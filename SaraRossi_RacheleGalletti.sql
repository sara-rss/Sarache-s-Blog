-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Lug 09, 2024 alle 22:54
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SaraRossi_RacheleGalletti`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `blog`
--

CREATE TABLE `blog` (
  `cod_blog` int(10) UNSIGNED NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `descrizione` varchar(1000) NOT NULL,
  `id_utente` int(10) UNSIGNED NOT NULL,
  `categ` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `blog`
--

INSERT INTO `blog` (`cod_blog`, `titolo`, `descrizione`, `id_utente`, `categ`) VALUES
(10, 'Equitazione', 'L\'equitazione è uno sport olimpico che prevede l\'abbinamento fra uomo e cavallo. Può essere praticato sia singolarmente che in gare organizzate per squadra, in strutture coperte, in maneggi all\'aperto o in campagna (a seconda della disciplina scelta). L\'equitazione e l\'ippica sono gli unici sport al mondo in cui uomini e donne, cavalli e cavalle, gareggiano insieme e alla pari.', 6, 9),
(12, 'Pugilato', 'Il pugilato è uno sport da combattimento in cui due persone, che di solito indossano guanti protettivi e altri dispositivi di protezione (come fasce per le mani e paradenti), si affrontano prendendosi a pugni per una durata di tempo predeterminata in un apposito ring di pugilato. Sebbene il termine \"pugilato\" sia comunemente attribuito alla boxe occidentale, in cui sono coinvolti solo i pugni, il pugilato si è sviluppato in vari modi nelle diverse aree geografiche e culture. In termini globali, la boxe è un insieme di sport da combattimento incentrati sul colpire, in cui due avversari si affrontano in un combattimento usando almeno i pugni, e possibilmente coinvolgendo altre azioni come calci, gomitate, ginocchiate e testate, a seconda delle regole. Alcune forme dello sport moderno sono boxe occidentale, pugilato a mani nude, kickboxing, Muay thai, lethwei, savate e Sanda. Le tecniche di boxe sono state incorporate in molte arti marziali, sistemi militari e altri sport da combattimento', 7, 19),
(13, 'Ice Nine Kills', 'Gli Ice Nine Kills (a volte abbreviato in lettere maiuscole INK) sono un gruppo musicale statunitense formatosi nel 2002 a Boston, principalmente noto per i suoi testi legati all\'horror.\r\nDopo i primi lavori autoprodotti pubblicati tra il 2002 e il 2009, principalmente affini al post-hardcore e allo ska punk, dal secondo album in studio Safe Is Just a Shadow, pubblicato dalla Red Blue Records nel 2010, il gruppo si è spostato su sonorità più vicine al metalcore, senza però abbandonare la loro vena sperimentale.', 8, 8),
(14, 'Inside Out ', 'Inside Out è un film d\'animazione del 2015 diretto da Pete Docter e Ronnie del Carmen; prodotto dai Pixar Animation Studios, in co-produzione con Walt Disney Pictures, e distribuito da Walt Disney Studios Motion Pictures. \r\nTRAMA: Crescere non è sempre facile e Riley, una ragazzina di 11 anni, se ne rende conto quando per seguire il lavoro del padre a San Francisco è costretta a lasciare la sua vita nel Midwest. Come tutti, Riley è guidata dalle cinque emozioni principali - Gioia, Paura, Rabbia, Disgusto e Tristezza - che vivono nella sua mente e che la aiutano ad affrontare la quotidianità. Mentre Riley fatica ad adattarsi alla nuova grande città, nel quartier generale delle emozioni monta l\'agitazione: sebbene Gioia cerchi di mantenere uno visione positiva delle cose, le restanti emozioni entrano in conflitto sul modo migliore per esplorare la nuova realtà in cui si trovano.', 8, 15),
(15, 'Friends', 'Friends è una sitcom statunitense creata da David Crane e Marta Kauffman e prodotta dal 1994 al 2004. La serie ruota attorno a un gruppo di sei amici a Manhattan, formato dalle ragazze Rachel Green, Monica Geller e Phoebe Buffay, e dai ragazzi Ross Geller, Chandler Bing e Joey Tribbiani. La serie è stata prodotta dalla Bright/Kauffman/Crane Productions in collaborazione con la Warner Bros. Television. Friends ha sempre ricevuto consensi durante la sua messa in onda, diventando una delle più popolari serie televisive. La sitcom ricevette una candidatura agli Emmy Award, vincendo il premio come miglior commedia per l\'ottava stagione, nel 2002. Lo show occupa il 21º posto nella classifica delle miglior serie commedia di tutti i tempi.', 7, 22),
(16, 'Sound Wall', 'Benvenuti su Sound Wall,\r\nil punto di riferimento per gli appassionati di musica di ogni genere! Qui troverete recensioni approfondite di album, reportage esclusivi di concerti, le ultime news dal mondo musicale e molto altro. Unisciti a noi per scoprire nuovi talenti e rivivere i momenti più emozionanti delle vostre band e artisti preferiti. Che tu sia un fan di lunga data o un curioso esploratore musicale, questo è il posto giusto per te!', 10, 8),
(17, 'CineMania', 'CineMania è il tuo portale dedicato all\'universo cinematografico dove passione e critica si incontrano. Qui esploriamo film di ogni genere, dalle epiche avventure ai drammi intimi, dalle commedie leggere ai thriller mozzafiato. CineMania si impegna a fornire contenuti informativi e stimolanti per tutti gli appassionati di cinema. Siamo qui per condividere la nostra passione, educare gli spettatori sulle opere cinematografiche e creare una comunità di amanti del cinema che amano discutere e scoprire insieme.', 11, 7),
(18, 'Arte e Design: Esplorazioni Contemporanee', 'In questo spazio virtuale, esploriamo il vasto mondo dell\'arte contemporanea e del design innovativo con passione e curiosità. Il nostro obiettivo è di fornire ispirazione, conoscenza e una prospettiva critica su tutto ciò che riguarda l\'arte e il design, sia nel contesto storico che contemporaneo.\r\n\r\nCosa troverete nel nostro blog:\r\n\r\nEsplorazioni artistiche: Analizziamo opere d\'arte moderne e contemporanee, esaminando il loro impatto culturale, sociale ed estetico. Dalle installazioni ai dipinti, dalle sculture alle performance, ci immergiamo nelle interpretazioni e nelle influenze che guidano gli artisti.\r\n\r\nEventi e mostre: Copriamo eventi culturali, mostre d\'arte e fiere di design di rilievo globale, recensendo le esperienze e le opere presentate e fornendo aggiornamenti sulle manifestazioni da non perdere.', 12, 6),
(19, 'Esplorazioni Globali', '\"Esplorazioni Globali\" è la vostra risorsa dedicata all\'esplorazione dei tesori culturali e alle avventure mozzafiato in tutto il mondo. Qui troverete guide dettagliate, racconti di viaggio ispiratori e consigli pratici per scoprire città affascinanti, paesaggi spettacolari e incontri indimenticabili. Siate pronti a esplorare, scoprire e imparare attraverso le nostre storie di viaggio! 🌍✈️', 13, 17),
(20, 'Pagine e Parole: Recensioni Letterarie', 'Benvenuti su \"Pagine e Parole\", il luogo dove le storie prendono vita attraverso recensioni approfondite di libri. Esploriamo romanzi, saggi, thriller e molto altro ancora, offrendo un\'analisi critica che celebra la bellezza della letteratura e la potenza delle parole. Unisciti a noi nel viaggio attraverso i mondi creati dagli scrittori più talentuosi di oggi e di ieri.', 14, 11);

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `id_cat` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `cat_padre` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`id_cat`, `tipo`, `cat_padre`) VALUES
(1, 'Tecnologia', 0),
(2, 'Viaggi', 0),
(3, 'Cucina', 0),
(4, 'Fitness', 0),
(5, 'Moda', 0),
(6, 'Arte e Design', 0),
(7, 'Film e TV', 0),
(8, 'Musica', 0),
(9, 'Sport', 0),
(10, 'Salute e Benessere', 0),
(11, 'Libri', 0),
(12, 'Finanza', 0),
(13, 'Lifestyle', 0),
(14, 'Fai da te', 0),
(15, 'Animazione', 0),
(16, 'Smartphone', 1),
(17, 'Destinazioni', 2),
(18, 'Ricette italiane', 3),
(19, 'Esercizi cardio', 4),
(20, 'Scarpe', 5),
(21, 'Pittura', 6),
(22, 'Serie TV', 7),
(23, 'Generi musicali', 8),
(24, 'Calcio', 9),
(25, 'Alimentazione sana', 10),
(26, 'Auto elettriche', 11),
(27, 'Investimenti', 12),
(28, 'Viaggi low-cost', 2),
(29, 'Vita di coppia', 13),
(30, 'Progetti fai da te', 14),
(31, 'Cartoni animati', 15);

-- --------------------------------------------------------

--
-- Struttura della tabella `coautori`
--

CREATE TABLE `coautori` (
  `id_utente` int(11) NOT NULL,
  `id_blog` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `coautori`
--

INSERT INTO `coautori` (`id_utente`, `id_blog`) VALUES
(13, 16);

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `id_comm` int(10) UNSIGNED NOT NULL,
  `text` varchar(1000) NOT NULL,
  `id_utente` int(10) UNSIGNED NOT NULL,
  `id_post` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `commento`
--

INSERT INTO `commento` (`id_comm`, `text`, `id_utente`, `id_post`) VALUES
(13, 'Bellissimo sport!', 6, 12),
(14, 'Sempre top ', 7, 14),
(17, 'Mi rispecchio in questo personaggio', 6, 16),
(18, 'Sottovalutata', 7, 16),
(19, 'Ho adorato questo personaggio!', 8, 18),
(20, 'Un personaggio troppo sopravvalutato', 14, 17),
(21, 'Il mio sogno nel cassetto è provare questo sport', 14, 12),
(22, 'un film spettacolare', 12, 20),
(23, 'una meta da sogno!!', 12, 19),
(25, 'ottimo libro per avvicinarsi a certe tematiche', 13, 22),
(26, 'i biglietti costano troppo!!', 13, 21),
(27, 'troppo difficile!!', 11, 10),
(28, 'l\'unico sport che mi ha appassionato davvero', 11, 13),
(31, 'un artista a 360 gradi', 11, 23),
(32, 'in assoluto il mio gruppo preferito', 10, 26),
(36, 'bellissimo amo', 10, 27);

-- --------------------------------------------------------

--
-- Struttura della tabella `likes`
--

CREATE TABLE `likes` (
  `id_like` int(10) UNSIGNED NOT NULL,
  `id_utente` int(10) UNSIGNED NOT NULL,
  `id_post` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `likes`
--

INSERT INTO `likes` (`id_like`, `id_utente`, `id_post`) VALUES
(11, 6, 15),
(12, 7, 14),
(13, 7, 13),
(14, 8, 16),
(15, 7, 17),
(16, 9, 18),
(17, 8, 18),
(18, 8, 14),
(20, 6, 10),
(23, 6, 16),
(24, 14, 18),
(25, 14, 17),
(26, 14, 13),
(27, 14, 12),
(28, 14, 10),
(29, 14, 19),
(30, 14, 20),
(31, 12, 22),
(32, 12, 21),
(33, 12, 20),
(34, 12, 19),
(35, 13, 24),
(36, 13, 23),
(37, 13, 22),
(38, 13, 21),
(39, 11, 26),
(40, 11, 25),
(41, 11, 10),
(42, 11, 13),
(43, 11, 22),
(46, 11, 23),
(48, 10, 26),
(51, 10, 27),
(52, 10, 25),
(55, 10, 28);

-- --------------------------------------------------------

--
-- Struttura della tabella `modelli`
--

CREATE TABLE `modelli` (
  `id_mod` int(10) UNSIGNED NOT NULL,
  `layout` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `modelli`
--

INSERT INTO `modelli` (`id_mod`, `layout`) VALUES
(1, 'Arial'),
(2, 'Helvetica'),
(3, 'Times New Roman'),
(4, 'Courier New'),
(5, 'Verdana'),
(6, 'Georgia'),
(7, 'Palatino'),
(8, 'Garamond'),
(9, 'Comic Sans MS'),
(10, 'Impact');

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `id_post` int(10) UNSIGNED NOT NULL,
  `titolo_post` varchar(100) NOT NULL,
  `testo` varchar(3000) NOT NULL,
  `data_ora` datetime NOT NULL,
  `img1` varchar(100) DEFAULT NULL,
  `img2` varchar(100) DEFAULT NULL,
  `cod_blog` int(10) UNSIGNED NOT NULL,
  `id_utente` int(10) UNSIGNED NOT NULL,
  `id_mod` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`id_post`, `titolo_post`, `testo`, `data_ora`, `img1`, `img2`, `cod_blog`, `id_utente`, `id_mod`) VALUES
(10, 'Monta inglese', 'La caratteristica principale che contraddistingue la monta inglese è la sua sella.\r\nSi tratta di una sella più piccola di quella western, senza pomolo e con una coppia di cuscini posti sotto al seggio riempiti di lana, schiuma o aria. Fra i due cuscini c\'è un canale mediano che impedisce il contatto diretto delle parti più rigide della sella con il dorso dell\'animale. Inoltre, le selle inglesi hanno su entrambi i lati un lembo di cuoio che si pone fra la gamba del cavaliere e il cavallo.', '2024-06-27 16:47:33', 'equitazione-monta-inglese2.jpg', '', 10, 6, 0),
(12, 'Monta americana', 'L\'equitazione americana (ma anche monta western o monta americana), è la monta tipica dei \"cowboy\" ma non solo. Si pratica usando finimenti e selle di tipo americano, caratterizzate da arcione e pomello. In genere si guida il cavallo impugnando le redini e utilizzando soprattutto le gambe. L\'abbigliamento è meno formale rispetto a quello per l\'equitazione inglese, in quanto si cavalca con jeans, stivali western, camicia e cappello da cowboy. Ormai però, anche nella monta americana l\'abbigliamento da gara è diventato più sofisticato, dato che si cerca di combinare i colori del cavallo a quelli della camicia o del sottosella, con l\'obiettivo di creare un\'immagine gradevole all\'occhio. Sono molto apprezzati anche i chaps, tipici dei cowboy.', '2024-06-27 16:51:48', 'equitazione-monta-western3.jpg', '', 10, 7, 0),
(13, 'Sparring', 'Lo sparring nella boxe è una parola che deriva dalla lingua inglese. La radice principale è l’espressione “SPAR”, che letteralmente significa combattere contro altre persone che fungono da avversari. Ciò significa che lo sparring è un partner che aiuta nell\'allenamento degli incontri di boxe.\r\nLa sua funzione non è altro che quella di allenare i pugili con grande tecnica e realismo. Questi vengono solitamente utilizzati poche settimane prima dell\'incontro di boxe. A differenza di un allenatore, questo esperto combatte con l\'altro in modo realistico, come se fosse il suo avversario in combattimento. Ciò ti consente di perfezionare abilità, movimenti e tecniche.\r\nLa parola sparring all\'interno della scuola di boxe può riferirsi a 2 cose. Il primo è l\' attività fisica stessa, ma anche lo specialista che svolge l\'attività . Nel gergo popolare di questa disciplina è conosciuta anche come “Fare guanti”.', '2024-06-27 17:10:04', 'sparring-2.600x420.32352.jpg', 'sparring-boxe-muay-thai-kickboxing-guanti-savate-sanda-k1-kombatnet.jpeg', 12, 7, 0),
(14, 'A Grave Mistake', '\"A Grave Mistake\" è una canzone della band metal americana per il loro album del 2018 The Silver Scream. Il video musicale racconta la storia di una versione romanzata del cantante Spencer Charnas, che commette omicidi credendo di essere il Corvo dei fumetti e del film Crow.', '2024-06-27 17:16:43', 'ab67616d0000b2734a8747304f922f010ed33cdc.jpg', '', 13, 8, 0),
(15, 'Hip to be scared', 'Hip to be scared (Disponibile ad essere spaventato) è la traccia numero quattro del sesto album degli Ice Nine Kills, The Silver Scream 2: Welcome To Horrorwood, pubblicato il 15 ottobre del 2021. La canzone, che vede la partecipazione di Jacoby Shaddix dei Papa Roach, omaggia il film American Psycho del 2000.', '2024-06-27 17:18:09', '746bc413e81e614952a1f6579b6177bb.300x300x1.jpg', '', 13, 8, 0),
(16, 'Tristezza', 'È l’emozione blu ed è un personaggio femminile. È stata la seconda emozione a nascere e per parte del film ha un ruolo indefinito, tanto che è lei stessa a non capire quale sia la sua utilità. Poi scopriamo che Tristezza serve per esternare il bisogno di Riley di ricevere conforto dalle persone che le vogliono bene. Tristezza gioca un ruolo determinante. Spesso considerata un’emozione da evitare, anche nel mondo reale in quanto emozione “negativa”, Tristezza ci dimostra quanto sia importante accogliere ogni tipo di emozione. La tristezza non è infatti un’emozione da nascondere, ma da ascoltare.', '2024-06-27 17:23:09', 'inside-out-tristezza.jpg', '', 14, 8, 0),
(17, 'Chandler Bing', 'Chandler Bing è uno dei sei protagonisti della serie televisiva Friends, andata in onda dal 1994 al 2004. Il personaggio è interpretato da Matthew Perry, che ha contribuito a renderlo uno dei più amati e iconici della storia della televisione.\r\nChandler è un uomo ironico e sarcastico, che nasconde dietro la sua corazza un carattere fragile e vulnerabile.', '2024-06-27 17:31:06', 'matthew-perry-chandler-bing-friends.webp', 'chandler-bing-friends-matthew-perry-1200x900.png', 15, 7, 5),
(18, 'Monica Geller', 'L\'attrice Courteney Cox è Monica Geller, sorella minore di Ross che lavora come cuoca. Piena di nevrosi, maniaca delle regole, è la migliore amica di Rachel. Nelle prime due stagione è fidanzata con l’attempato Richard, interpretato da Tom Selleck. Dalle fine della quarta stagione frequenta Chandler che successivamente sposerà e con il quale adotterà due gemelli.', '2024-06-27 17:35:11', 'CHm94AjUEAAKbnk.jpg', 'monica-geller-copertina-1.png', 15, 9, 4),
(19, 'Vietnam in 15 giorni: Itinerari da non perdere', 'Se è il tuo primo viaggio in Vietnam e desideri seguire un itinerario di 15 giorni, le mete imperdibili da prendere in considerazione sono Hanoi, Hue, Hoi An e Ho Chi Minh City. Per visitare ognuna di queste località servono almeno un paio di giorni. Tuttavia, oltre a queste destinazioni principali, con due settimane a disposizione avrai ancora spazio nel tuo itinerario per includere alcune affascinanti escursioni aggiuntive.\r\n\r\nA questo punto, non ti resta che decidere dove trascorrere gli altri giorni a disposizione. Secondo noi, bisognerebbe innanzitutto decidere in base ai propri interessi che, per nostra esperienza, si traducono principalmente in tre tipi di itinerari:\r\n\r\nUn itinerario classico, da nord a sud, che include una visita alle spettacolari aree montane del Vietnam settentrionale, un’avventura emozionante in crociera nella maestosa baia di Halong e un affascinante giro sul pittoresco Delta del Mekong nel Vietnam meridionale.\r\nOppure, se desideri visitare le località meno turistiche, puoi optare per un itinerario alla scoperta del Vietnam settentrionale e centrale, che ti offre più tempo per immergerti nella cultura autentica e svelando i segreti nascosti di queste affascinanti regioni.\r\nInfine, se il mare è la tua passione, potresti considerare un itinerario appositamente pensato per gli amanti del mare. Questo itinerario ti permetterà di goderti più giorni nel Vietnam centrale e meridionale, dove potrai dedicarti alle meraviglie delle spiagge e alle acque cristalline, regalandoti momenti di puro relax e piacere.', '2024-06-30 17:03:54', 'baia_di_ha_long_2508657.jpg', 'Saigon-vietnam.jpg', 19, 14, 2),
(20, 'Il Dottor Stranamore – Ovvero: come ho imparato a non preoccuparmi ed amare la bomba', 'Il film \"Il dottor Stranamore\" di Stanley Kubrick si apre con una telefonata del presidente Muffley agli alti vertici sovietici, un momento cruciale che rappresenta il cuore della critica del regista al mondo contemporaneo. Kubrick utilizza questa farsa cinematografica per smantellare e mitizzare le prassi della politica internazionale e delle dinamiche di potere, concentrandosi sul tema della guerra nucleare come epitome dell\'autodistruzione e della negazione dell\'umanità stessa. La bomba nucleare, protagonista silenziosa ma onnipresente, non è solo un\'arma di distruzione di massa, ma un simbolo della fragilità e della follia umana.\r\n\r\nIl film esplora il tema della virilità e della sua crisi attraverso il personaggio del generale Ripper, interpretato magistralmente da Sterling Hayden, il quale avvia un attacco nucleare contro l\'Unione Sovietica senza possibilità di ritorno. Questo gesto catastrofico si trasforma in una comica tragedia, una parodia della guerra fredda e delle politiche belliche che Kubrick ridicolizza con un umorismo tagliente. Ambientato durante la crisi dei missili cubani del 1962, il film riflette sul significato esistenziale e politico della guerra, trasformando un romanzo serio in una satira che svela l\'assurdità e la comicità nel cuore della tragedia umana.\r\n\r\nKubrick gioca sapientemente con i nomi dei personaggi, caricandoli di significati ironici e rendendoli emblemi della parodia della realtà politica. Il presidente Muffley, il generale Ripper, il dottor Stranamore stesso (interpretato da Peter Sellers in una delle sue interpretazioni più iconiche), sono tutti esempi di come Kubrick affronta il tema della guerra con una satira graffiante che smaschera il degrado della società moderna e delle sue istituzioni. Il film, con il suo stile visivamente potente e la sua narrazione serrata, non si prende mai troppo sul serio, ma colpisce nel suo esplorare l\'incubo della guerra nucleare e nell\'affrontare temi profondi con un umorismo che fa riflettere.', '2024-06-30 17:07:59', 'dottor-stranamore-poster-.jpg', '', 17, 14, 3),
(21, 'Guida alla Biennale Arte 2024 a Venezia', 'Dal 20 aprile al 24 novembre 2024, Venezia ospiterà la 60esima Esposizione Internazionale d’Arte, un evento che si preannuncia come uno dei più inclusivi nella storia della Biennale. Curata con maestria da Adriano Pedrosa, l’edizione è intitolata “Stranieri Ovunque – Foreigners Everywhere”, un tema che sfida i canoni tradizionali dell’arte per dare voce agli artisti storicamente marginalizzati e al sud del mondo.\r\n\r\nQuesto titolo non è casuale: in un mondo globalizzato, la mobilità umana e l’identità sono temi cruciali. La Biennale 2024 affronta queste questioni con sensibilità, aprendo spazio a voci e prospettive da ogni angolo del pianeta.\r\n\r\nL’ispirazione per il tema deriva dalle opere del collettivo Claire Fontaine, noto per le sue sculture al neon con la scritta “Stranieri Ovunque”, che incarnano il senso di estraneità nella società globale contemporanea. Questo titolo invita a riflettere sulla complessità dell’estraneità e sulla realtà interconnessa del mondo moderno.\r\n\r\nIl curatore Adriano Pedrosa ha dichiarato: “Si parlerà di artisti che sono stranieri, immigrati, espatriati, diasporici, esiliati e rifugiati, in particolare di coloro che si sono spostati tra il Sud e il Nord del mondo. Migrazione e decolonizzazione saranno temi centrali”.\r\n\r\nRoberto Cicutto, Presidente della Biennale, ha sottolineato l’importanza di questa edizione, definendola “una finestra sul mondo” che riflette la società globale e interconnessa. Ha elogiato il ruolo di Adriano Pedrosa come primo curatore della Biennale Arte proveniente dall’America Latina, incaricato di portare un nuovo punto di vista sull’arte contemporanea.\r\n\r\nDurante i mesi dell’esposizione, la città di Venezia ospiterà opere esposte all’aperto e performance artistiche interattive, offrendo al pubblico un’esperienza unica per immergersi nell’arte contemporanea e esplorare il tema “Stranieri Ovunque” in tutte le sue sfaccettature.', '2024-06-30 17:10:03', 'Biennale-di-Venezia-2024-MDM_MAHKU-131_Ph-by-Matteo-De-Mayda.jpg', '00-1874-2000-750-Foto-Haupt-Binder-universes-art.jpg', 18, 12, 0),
(22, 'Recensione: \"Invisibili\" un libro di Caroline Perez', 'Caroline Criado Perez con il suo saggio intitolato “Invisbili” offre al pubblico un titolo che scuote e invita a focalizzare la propria attenzione su un mondo incentrato e costruito sulla prospettiva maschile tanto da risultare privo di qualsivoglia dato effettivo e concreto su quel che riguarda la sfera femminile.\r\nL’elaborato ha inizio da una raccolta di dati inerenti alla scomparsa di donne in una determinata dimensione sociale che vengono poi tra loro incrociati e messi in contrapposizione. Da questo assunto iniziano a emergere lacune, assenze, vuoti. Queste mancanze, che non consentono di identificare un quadro completo e che dunque non consentono di avere una prospettiva effettiva di questa dimensione, trovano fondamento in una struttura che da epoche lontane ha una radice patriarcale ben precisa e delineata sull’uomo. Per sua impostazione, dunque naturale, questa è pertanto refrattaria all’inserimento della donna in società. La sua presenza è ammessa esclusivamente per questioni meramente relative all’assistenza famigliare.\r\nDopo questa prima focalizzazione l’analisi si sposta sui perché ed entra nel vivo del suo essere. Perché questi dati sono assenti? Sono le donne ad aver deciso di essere invisibili e di non esserci o ciò è determinato esclusivamente da meccanismi esterni? Attraverso molteplici fonti ricavate anche dall’Organizzazione Mondiale della sanità, Carolina Criado Perez cerca una risposta. Osserva che spesso sono le stesse donne ad accontentarsi o a decidere di fare un passo indietro in ruoli meno di prestigio perché consapevoli di essere scartate a prescindere dal sistema. Ancora osserva le diseguaglianze dal punto di vista reddituale, sanitario, finanziario, lavorativo e sociale. Analizza il come queste dimensioni siano create e pensate quale veste maschile e quindi inadatta all’altro sesso. Introduce anche degli esempi concreti di realtà all’interno delle quali la donna non riesce a crearsi uno spazio perché ostacolata dalla propria condizione. Il solo essere madre, ad esempio, è considerato quale un lavoro a parte e dunque non coadiuvabile con quello atto a creare sostentamento. Vengono inoltre prese in esame anche le realtà più povere e dove paradossalmente è per la donna più semplice trovare un impiego semplicemente perché le varie sfere della vita riescono ad essere gestite in una soluzione unica, circostanza, questa, non realizzabile nelle realtà più urbanizzate.\r\n“Invisibili” è un titolo che scuote, che incuriosisce e che apre alla riflessione. L’obiettivo dell’autrice è certamente quello di dischiudere una porta su una problematica molto attuale e invitare il lettore e ad aprirsi ad una prospettiva di dialogo e meditazione.\r\nUn componimento sinceramente molto interessante, ben costruito, ben argomentato e ben fondato che merita di essere letto e su cui soffermarsi con apertura mentale.', '2024-06-30 17:11:06', '61he8mA7WoL._AC_UF1000,1000_QL80_.jpg', '', 20, 12, 0),
(23, 'Keith Haring, vita e opere del grande street artist americano', 'Keith Haring (Reading, 1958 – New York, 1990) è uno degli artisti più noti del XX secolo grazie al suo stile che risulta immediatamente riconoscibile anche ai non addetti ai lavori. Tramite la sua arte, lo statunitense Keith Haring, tra i maggiori street artist di sempre, si è fatto portatore dei temi sociali e politici più in voga dell’epoca, come la difesa dei diritti civili e la lotta contro le discriminazioni nei confronti delle minoranze, contro il razzismo e l’omofobia. Inoltre, si è mosso come capofila per la campagna di sensibilizzazione contro l’assunzione di crack e si è espresso più volte favorevolmente riguardo all’introduzione dell’educazione sessuale nelle scuole, al fine di evitare la diffusione di malattie sessualmente trasmissibili.\r\n\r\nTuttavia, nonostante Haring desse molta importanza ai significati delle sue opere, ha sempre preferito non fornirne una spiegazione, lasciandole inoltre quasi tutte senza nome. Infatti, l’artista sosteneva che esplicitare una definizione limitasse i lavori artistici unicamente all’interpretazione dell’autore, relegando in tal modo il pubblico a un ruolo prettamente passivo. Invece, Keith Haring voleva che lo spettatore avesse un ruolo attivo nell’elaborazione dell’opera, al pari dell’artista stesso, perché credeva che anche il pubblico dovesse partecipare al processo creativo sviluppando la propria interpretazione dell’opera.', '2024-06-30 17:12:47', 'image.jpg', 'haring-scaled-1.jpg', 18, 13, 0),
(24, 'Viaggio in Cina senza visto!', 'Oggi è possibile entrare in Cina senza il visto, sia turistico che per affari o lavoro. Questo grazie al fatto che l’importante paese asiatico ha deciso di aderire alla convenzione dell’Aja. Vanno in pensione anche le legalizzazioni dei documenti pubblici e altri strumenti di controllo che burocratizzavano vari passaggi per le aziende interessate a fare affari con le imprese cinesi. Ecco cosa devi sapere.\r\n\r\nCome ci ricorda il sito www.visaforchina.cn, è possibile saltare le procedure per fare il visto cinese per tutte le persone con passaporto valido. Questo aggiornamento è valido non solo per i cittadini italiani ma anche per francesi, olandesi, malesi, tedeschi, spagnoli. Questo è valido dal 1 dicembre 2023 al 30 novembre 2024.\r\nSi tratta di una misura in via sperimentale ma comunque dalla portata rivoluzionaria. C’è un limite al periodo? Sì, puoi entrare in Cina senza visto solo per ingressi di massimo 15 giorni. Ma rientrano in questa facilitazione tutti i visti per la Cina, compresi quelli turistici e per motivi professionali, semplice scalo o di lavoro.\r\n\r\nIn questi casi, le motivazioni che hanno spinto la Cina a entrare nella convenzione dell’Aja – e semplificare notevolmente le pratiche per accedere nel paese – riguardano la necessità/volontà di attrarre imprese estere. Secondo Mao Ning, Vicedirettrice del Dipartimento dell’informazione del Ministero degli esteri cinese, bisogna «facilitare lo scambio tra cinesi e stranieri, favorire uno sviluppo di alta qualità e un’apertura di alto livello». Fino a questo momento, solo Singapore e Brunei erano le nazioni esentate.', '2024-06-30 17:13:49', 'cose-da-sapere-cina.jpg', 'Progetto-senza-titolo-14.jpg', 19, 13, 0),
(25, 'Punk e Pop: la storia dei Prozac + attraverso i loro Album iconici', '\r\nI Prozac + sono una band che ha fatto della vitalità dei concerti dal vivo il cuore della propria identità musicale. Grazie al successo dei loro album \"Acidoacida\" e \"3 Prozac +\", che mescolano punk e pop con ironia, hanno guadagnato una notevole popolarità. Con Eva alla voce, Gian Maria alla chitarra e Elisabetta al basso, il gruppo si è distinto anche per essere stato supporto degli U2 nel 1997 e per le oltre duecento esibizioni dal vivo in due anni. I loro testi, spesso controversi, esplorano il disagio giovanile senza moralismi, affrontando temi come la tossicodipendenza in modo provocatorio. Nonostante le critiche sulla ripetitività, la band ha venduto oltre 160.000 copie di \"Acidoacida\" e continua a evolversi con album come \"Miodio\".', '2024-06-30 17:17:00', '70d8a20f114f392e9c8ce1f23e8b7f15.jpg', 'prozac.jpg', 16, 11, 0),
(26, 'Gorillaz, un progetto pioniere dell’attuale fluidità dei generi musicali', 'Damon Albarn, frontman del gruppo rock Blur, e il fumettista Jamie Hewlett crearono i Gorillaz nel 1998 durante la loro convivenza in un appartamento sulla strada di Westbourne Grove a Notting Hill. L\'idea nacque mentre i due stavano guardando MTV: «se guardate MTV troppo a lungo, è un po\' un inferno, non c\'è nessuna sostanza. Così abbiamo avuto quest\'idea della cartoon band, qualcosa che sarebbe valsa la pena di commentare».\r\n\r\nI Gorillaz fanno uscire nel 2023 il loro ottavo album. L\'album, realizzato tra il 2021 e il 2022 con la produzione di Greg Kurstin e Remi Kabaka Jr., narra il trasferimento del quartetto dalla natia Londra alla California per diffondere un messaggio quasi religioso ai loro seguaci.\r\n\r\nIl disco vede collaborazioni di alto livello: Thundercat arricchisce la title track \"Cracker Island\" con il suo cyberfunk, mentre Stevie Nicks presta la sua voce a \"Oil\". \"The Tired Influencer\" richiama gli anni \'80 e \"Baby Queen\" allude a un aneddoto del 1997 con la principessa thailandese. \"Silent Running\" e \"New Gold\" sono due dei brani più riusciti, con contributi di Adeleye Omotayo, Tame Impala e Bootie Brown. Bad Bunny partecipa al reggaeton \"Tormenta\", e l\'album si chiude con \"Skinny Ape\" e \"Possession Island\", quest\'ultima con la voce di Beck Hansen.\r\n\r\nDamon Albarn sembra trovarsi più a suo agio nel progetto Gorillaz che in qualsiasi altro contesto artistico, confermato dal numero di album dei Gorillaz che ha raggiunto quello dei Blur. Nonostante la cancellazione del film animato dei Gorillaz da parte di Netflix, \"Cracker Island\" promette di non deludere i fan.', '2024-06-30 17:17:59', 'gorillaz1.webp', 'gorillaz2.webp', 16, 11, 5),
(27, 'La Zona d’interesse svela l’orrore di ieri e di oggi', 'Arriva in sala uno dei grandi film dell’ultima edizione del festival di Cannes, dove ha vinto il Grand prix speciale della giuria. È La zona d’interesse dell’inglese Jonathan Glazer, liberamente tratto dall’omonimo romanzo di Martin Amis. Un’opera ipnotica e dalla narrazione a suo modo serrata nel raccontare la mostruosità dell’Olocausto. Un capolavoro assoluto, che dietro le apparenze va oltre la questione trattata e investe la percezione della contemporaneità.\r\n\r\nLavora sulla rappresentazione delle piccole cose della vita quotidiana, che spesso sono le cose belle, e dà grande densità a una narrazione minimale per mezzo di un enorme lavoro di regia: taglio e composizione delle inquadrature, lavoro sulla profondità di campo e sul montaggio, fondamentale nel rendere il ritmo serrato. Un film che per certi aspetti sembra bucolico ed edificante, se non fosse che racconta il quotidiano del comandante del campo di sterminio di Auschwitz, che viveva lì accanto con moglie e figli, in una casa graziosa e con giardino. Un piccolo paradiso luminoso, verde e fiorito. Dietro al muro s’intravedono vagamente le ciminiere dei forni crematori. Quasi rimossi dal campo visivo. E già molto è detto con questo: si può rimuovere anche quello che si vede. Anzi, perfino quello che si fa si può non vederlo. Si può far finta di non vedere, di non aver capito.\r\n\r\nSe è vero che il cinema è sguardo, qui diventa una questione chiave, analizzata da una prospettiva molto originale, che al suo interno racchiude anche la questione del rimosso.', '2024-06-30 17:22:53', 'coverlg.jpg', 'pad.mymovies.jpg', 17, 10, 0),
(28, 'Joy Division - Unknown Pleasures ', 'La carriera dei Joy Division è stata breve ma intensa, focalizzata su due album iconici: \"Unknown Pleasures\" e \"Closer\". Questi album sono considerati non solo pietre miliari ma enormi poli magnetici per i loro fan vecchi e nuovi, rappresentando il contrasto tra il grezzo e il levigato, incarnato rispettivamente dal primo e dal secondo album. Il cuore della loro musica è il dramma umano, incarnato nella lucida disperazione di Ian Curtis in \"Unknown Pleasures\" e nelle sue stesse esequie in \"Closer\", che sono un testamento di potenza inaudita.\r\n\r\nLa musica dei Joy Division agisce su di noi in modo immediato e intenso: o respinge con un senso di disgusto simile a un rifiuto istintivo, o cattura, trascinando l\'ascoltatore in un abisso di disperazione che distrugge ogni difesa.\r\n\r\nIan Curtis è paragonato per l\'intensità della sua espressione a Lou Reed per i testi crudi e a Jim Morrison per l\'intensità vocale. Ma il loro impatto va oltre la personalità carismatica di Curtis, definendo una nuova formula musicale che ha dato vita al movimento dark-wave.\r\n\r\nLa band è emersa alla fine degli anni \'70, in un contesto di punk e post-punk, distinguendosi per un suono oscuro e decadente che ha influenzato profondamente il genere dark. Dopo una fase iniziale con la Factory Records e il produttore Martin Hannett, i Joy Division hanno raggiunto la loro forma definitiva con \"Unknown Pleasures\" nel 1979, caratterizzato da un suono unico e dalla copertina enigmatica che riflette il loro contenuto oscuro.\r\n\r\nOgni traccia di \"Unknown Pleasures\" è un\'immersione in un mondo di tensione nervosa e patologica, dove la musica riflette e amplifica il mal di vivere fino alle sue estreme conseguenze. Questo album è stato il fondamento per il movimento dark, con canzoni come \"Disorder\", \"Day Of The Lords\", e \"New Dawn Fades\" che rappresentano picchi di espressione emotiva e sonora.\r\n\r\nCon \"Closer\", il secondo e ultimo album prima della morte di Curtis, il gruppo ha completato il suo percorso verso un\'arte eterna, esplorando temi ancora più profondi e personali. La loro musica continua a toccare temi esistenziali universali, lasciando un\'impronta indelebile sulla storia della musica rock.', '2024-06-30 17:28:43', 'joy-division-l-origine-della-copertina-di-unknown-pleasures-wide-site-cifrh.jpg', 'Joy_Division_promo_photo.jpg', 16, 10, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id_utente` int(10) UNSIGNED NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto_prof` varchar(100) DEFAULT NULL,
  `premium` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id_utente`, `nome`, `cognome`, `email`, `password`, `foto_prof`, `premium`) VALUES
(4, 'vincenzo', 'sammartino', 'v.sammartino@studenti.unipi.it', '$2y$10$nDenMZaWKie5Ic/MbR4i2uw0R2lHZf9weVcYFJDTJGxt5nScnNWDu', '', 0),
(6, 'Rachele', 'Galletti', 'racheleg13@gmail.com', '$2y$10$k6XQAl7G/dGsZuEBN8.t/uHPvn5xafNfhuTjjHshKaCFPJVMKkCaK', '', 0),
(7, 'Monica', 'Granchi', 'monicagranchi@tiscali.it', '$2y$10$SXiZdj.bjqiEDEKqL.Fx3.M9iflHQ4AOoITdqnhTu0kyDLNT42j32', '', 1),
(8, 'Diego', 'Moretto', 'diegomoretto@gmail.com', '$2y$10$E6Rm6qfd7jW6tZGtjavN3uo/BJwIOvO.M0iJLf6XCWYwU8s8sLWTK', '', 0),
(9, 'Sara', 'Scarvaci', 'sara12@gmail.com', '$2y$10$wBN9FOGhns/CTFDNhEI3TO/sfIbcxne0GKWarY.pehYg5J8PTs.Qu', 'uploads/659e956a8443e.jpeg', 1),
(10, 'sara', 'rossi', 'sarar973@gmail.com', '$2y$10$FITCBzavTjjLtWUr5amLgOQFa8i6Z5cwk2/bJt.pyQfI7/8L6agk6', 'uploads/Schermata 2024-06-26 alle 16.53.07.png', 1),
(11, 'Emanuele', 'Mori', 'emamori@gmail.com', '$2y$10$dUX3ilEjdtRgEioY5mPRjuj0b163quskSHqYAnHz6SsMwUOYn7hiG', 'uploads/leaning_tower_of_pisa_wallpapers-normal.jpg', 1),
(12, 'Ginevra', 'Cammelli', 'ginsa@gmail.com', '$2y$10$7HwFurtOUW9ydj06kQ5UMe8oE8buZfLx5Xv6VQPkmRlh8H9hEcrvi', 'uploads/Viareggio-9-scaled-1-1.jpg', 0),
(13, 'Margherita', 'Meccheri', 'marghe.mcc@gmail.com', '$2y$10$8H7XSWmF3sDafvvTCEBZPeCssThVZzkJKkZl7MJgq8HlX0qymXgKi', '', 0),
(14, 'Alexander', 'Luchini', 'alexluchini@tiscali.it', '$2y$10$jjYEx7OIyx/l43c82adzXOejFZAVV.LNp1lNYjysgg963W3NY1h42', '', 1),
(15, 'sara', 'rossi', 'sarar953@gmail.com', '$2y$10$VBphKbq2Vl9HqVl1moA0RuiC.k9PpOhW6vXB7RzCgW0V8pZKGScxm', '', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`cod_blog`),
  ADD KEY `categ` (`categ`);

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indici per le tabelle `coautori`
--
ALTER TABLE `coautori`
  ADD PRIMARY KEY (`id_utente`,`id_blog`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`id_comm`),
  ADD KEY `post` (`id_post`),
  ADD KEY `id_utente` (`id_utente`);

--
-- Indici per le tabelle `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `id_post` (`id_post`),
  ADD KEY `id_utente` (`id_utente`);

--
-- Indici per le tabelle `modelli`
--
ALTER TABLE `modelli`
  ADD PRIMARY KEY (`id_mod`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_utente` (`id_utente`),
  ADD KEY `cod_blog` (`cod_blog`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id_utente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `blog`
--
ALTER TABLE `blog`
  MODIFY `cod_blog` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `id_comm` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT per la tabella `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT per la tabella `modelli`
--
ALTER TABLE `modelli`
  MODIFY `id_mod` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id_utente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`categ`) REFERENCES `categoria` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `commento_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`cod_blog`) REFERENCES `blog` (`cod_blog`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
