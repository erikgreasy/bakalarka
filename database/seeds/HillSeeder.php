<?php

use App\Hill;
use App\HillImage;
use Illuminate\Database\Seeder;

class HillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $hill = Hill::create([
            'name'  => 'Rysy',
            'height'    => 2503,
            'description'   => 'Od východného vrcholu tvorí prvý hraničný bod medzi Slovenskom a Poľskom na hlavnom hrebeni a severozápadný vrchol je najvyšším bodom Poľska. Na sever vysiela dlhý vedľajší hrebeň medzi Dolinu Rybiego Potoku a Bielovodskú dolinu. Medzi Rysmi a najbližším západným susedom - Žabím koňom, leží Žabie sedlo. Od Ťažkého štítu na juhovýchode oddeľuje Rysy sedlo Váha a od Malých Rysov v bočnom, na sever vybiehajúcom hrebeni Sedielko pod Rysmi. Horolezecky najatraktívnejšia je 400 metrová východná stena.[3]

            Rysy majú tri vrcholy:
            
            prostredný (hlavný) (2 503,0 m n. m.),[1] leží na Slovensku.
            severozápadný (2 498,7 m n. m.),[1] najvyšší bod Poľska.
            juhovýchodný (2 473 m n. m.), leží na Slovensku.
            
            Turisticky prístupný severozápadný vrchol Rysov (2 498,7 m n. m.) - najvyšší bod Poľska
            Severozápadný vrchol zároveň slúži, od roku 2000, ako hraničný peší prechod po červená turistická značka červenej značke do Poľska. Otvorený je v čase letnej turistickej sezóny. Rysy (ich severozápadný vrchol) sú najvyšším bodom Poľska.
            
            Na úbočí Rysov sa v nadmorskej výške 2 250 m n. m. nachádza najvyššie položená horská chata v Tatrách i na Slovensku, Chata pod Rysmi.
            
            Na úpätí Rysov (na slovenskej strane) sa nachádzajú 3 malé karovo-morénové jazerá - Žabie plesá (Veľké, Malé a Vyšné), na poľskej strane ležia dve plesá: Czarny Staw pod Rysami a najväčšie tatranské pleso - Morskie Oko.',
            'latitude'  => 49.17906,
            'longitude'    => 20.08855,
            'mountain_id'   => 1,
            'thumbnail_path'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1e/Rysy_2.jpg/1280px-Rysy_2.jpg'
        ]);
        HillImage::create([
            'hill_id'   => $hill->id,
            'path'      => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/Rysy_004.JPG/1280px-Rysy_004.JPG'
        ]);
        HillImage::create([
            'hill_id'   => $hill->id,
            'path'      => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Chata_pod_Rysmi_001.JPG/1280px-Chata_pod_Rysmi_001.JPG'
        ]);


        $hill = Hill::create([
            'name'              => 'Kriváň',
            'height'            => 2494,
            'description'       => 'Kriváň (poľ. Krywań, nem. Kriwan, maď. Kriván) je vrch na konci rázsochy, ktorá sa od hlavného hrebeňa Vysokých Tatier odvetvuje v Čubrine. Leží nad Nefcerkou, Kôprovou a Važeckou dolinou na svojimi J a JZ výbežkami zasahuje do Liptovskej kotliny. Je to jeden z najvyšších vrchov Slovenska. Dosahuje výšku 2 494,7 m n. m. Od 19. storočia je neoficiálnym symbolom slobody Slovákov a slovanskej súdržnosti.

            Medzi rokmi 1960 až 1990 bol zobrazený s vatrou na znaku Slovenska v štátnom znaku Česko-Slovenska. Dočasne nahradil tradičný slovenský znak s trojvrším a krížom, ktorý je dnes v štátnej symbolike Slovenskej republiky. V roku 2005 bolo rozhodnuté, že bude zobrazený aj na slovenských eurominciach. Po Kriváni je pomenovaná aj planétka (24260) Kriváň.',
            'latitude'          => 49.162778,
            'longitude'         => 19.999722,
            'mountain_id'       => 1,
            'thumbnail_path'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/84/Kriv%C3%A1%C5%88.JPG/1280px-Kriv%C3%A1%C5%88.JPG'
        ]);
        HillImage::create([
            'hill_id'   => $hill->id,
            'path'      => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Z%C3%A1pad_slnka_za_Kriv%C3%A1%C5%88om.jpg/1280px-Z%C3%A1pad_slnka_za_Kriv%C3%A1%C5%88om.jpg'
        ]);
        HillImage::create([
            'hill_id'   => $hill->id,
            'path'      => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/Vrcholov%C3%BD_kr%C3%AD%C5%BE_na_Kriv%C3%A1ni.jpg/1280px-Vrcholov%C3%BD_kr%C3%AD%C5%BE_na_Kriv%C3%A1ni.jpg'
        ]);
       

        $hill = Hill::create([
            'name'              => 'Ďumbier',
            'height'            => 2043,
            'description'       => 'Ďumbier sa na severe javí ako mohutný vysokohorský masív s 500 m vysokými stenami, piliermi a žliabkami do ľadovcových kotlov v koncoch Bystrej a Ludárovej doliny. Miernejšie južné svahy pokrýva pole žulových balvanov. Vrch je súčasťou hlavného hrebeňa, ktorý sa práve v masíve Ďumbiera rozdvojuje a pokým východne smerujúce rameno zakončuje mohutná Štiavnica, juhovýchodne smerujúce rameno vedie cez Králičku do sedla Čertovica a pokračuje Kráľovohoľskými Tatrami. Severným smerom vybieha rázsocha Ludárovej hole. Severné svahy odvodňuje Bystrá a Ludárov potok, smerujúce Štiavnicou do Váhu, z južnej časti prúdi voda Bystriankou do Hrona.',
            'latitude'          => 48.93661,
            'longitude'         => 19.64017,
            'mountain_id'       => 2,
            'thumbnail_path'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/%C4%8Eumbier1.JPG/1280px-%C4%8Eumbier1.JPG'
        ]);

        HillImage::create([
            'hill_id'   => $hill->id,
            'path'      => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/%C4%8Eumbier_001.JPG/1280px-%C4%8Eumbier_001.JPG'
        ]);
        HillImage::create([
            'hill_id'   => $hill->id,
            'path'      => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/%C4%8Eumbier_003.JPG/1280px-%C4%8Eumbier_003.JPG'
        ]);


        $hill = Hill::create([
            'name'              => 'Chopok',
            'height'            => 2023,
            'description'       => 'Chopok, ležiaci v srdci pohoria, patrí medzi najnavštevovanejšie lokality Nízkych Tatier. Môže za to jednoduchá dostupnosť lanovkami, ktoré zo severu (z Jasnej) i juhu (zo Srdiečka) pohodlne vyvezú turistov na hrebeň pod samotný vrchol. Vrch tak býva častým východiskom túr na Ďumbier a ku Chate generála Milana Rastislava Štefánika, s pokračovaním cez Králičku do sedla Čertovica. Mimo hlavného vrcholu, pod ktorým stojí Kamenná chata pod Chopkom, je západne od rotundy - vrcholovej stanice druhý, nižší vrchol. V jeho blízkosti je inštalovaná meteorologická stanica. Severovýchodne sa nachádza mohutný ľadovcový kotol s Lukovým plieskom. Severné svahy odvodňujú prítoky Demänovky, južné svahy odvádzajú vodu do riečky Bystrianka.


            Meteorologická stanica a stanica bývalej lanovky neďaleko vrcholu Chopka.
            Svahy Chopka sú vyhľadávaným miestom zimnej i letnej turistiky: stredisko Jasná leží na severnej Liptovskej a stredisko Kosodrevina na južnej Horehronskej strane. V decembri 2012 bolo obnovené spojenie oboch regiónov lanovkami.',
            'latitude'          => 48.94301,
            'longitude'         => 19.59313,
            'mountain_id'       => 2,
            'thumbnail_path'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Pohled_na_zimni_Chopok.jpg/1280px-Pohled_na_zimni_Chopok.jpg'
        ]);

        HillImage::create([
            'hill_id'   => $hill->id,
            'path'      => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/49/Chopok_stanica.JPG/1280px-Chopok_stanica.JPG'
        ]);
        HillImage::create([
            'hill_id'   => $hill->id,
            'path'      => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Pohled_na_zimni_Chopok.jpg/1280px-Pohled_na_zimni_Chopok.jpg'
        ]);


        $hill = Hill::create([
            'name'              => 'Veľký Kriváň',
            'height'            => 2023,
            'description'       => 'Tento lúčnatý vrch s vrcholom nad hornou hranicou rozšírenia kosodreviny je výborným vyhliadkovým bodom s kruhovým výhľadom. Veľký Kriváň pokrývajú sčasti suťové polia, časť svahov pokrývajú porasty čučoriedky obyčajnej. Veľká nadmorská výška a hôľnatý vrchol poskytujú kruhový výhľad na okolité vrcholy i pohoria. Pri vhodných podmienkach je viditeľná napr. Babia hora i Pilsko v Oravských Beskydách, Veľký Choč a vrchy Západných aj Vysokých Tatier, mnohé vrchy Veľkej Fatry a Nízkych Tatier, Strážov, západným smerom Lysá hora, Kněhyně a Smrk v Moravsko-sliezskych Beskydách i Veľká Rača a mnohé ďalšie vrcholy Kysuckých Beskýd.',
            'latitude'          => 49.18765,
            'longitude'         => 19.03097,
            'mountain_id'       => 3,
            'thumbnail_path'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d7/N%C3%A1rodn%C3%AD_park_Mal%C3%A1_Fatra%2C_Ve%C4%BEk%C3%BD_Kriv%C3%A1%C5%88.JPG/1280px-N%C3%A1rodn%C3%AD_park_Mal%C3%A1_Fatra%2C_Ve%C4%BEk%C3%BD_Kriv%C3%A1%C5%88.JPG'
        ]);

        HillImage::create([
            'hill_id'   => $hill->id,
            'path'      => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3b/Ve%C4%BEk%C3%BD_Kriv%C3%A1%C5%88_a_Snilovsk%C3%A9_Sedlo_-_panoramio.jpg/1280px-Ve%C4%BEk%C3%BD_Kriv%C3%A1%C5%88_a_Snilovsk%C3%A9_Sedlo_-_panoramio.jpg'
        ]);
        HillImage::create([
            'hill_id'   => $hill->id,
            'path'      => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fd/Velk%C3%BD_Kriv%C3%A1%C5%88_ze_Snilovsk%C3%A9ho_sedla.jpg/1280px-Velk%C3%BD_Kriv%C3%A1%C5%88_ze_Snilovsk%C3%A9ho_sedla.jpg'
        ]);


        $hill = Hill::create([
            'name'              => 'Veľký Rozsutec',
            'height'            => 1609,
            'description'       => 'Rázovitý vrch sa nachádza na severnom okraji pohoria, v geomorfologickom podcelku Krivánska Fatra a jej atraktívnej časti Rozsutce.[4] Vrch leží v Žilinskom kraji, na rozhraní okresov Žilina a Dolný Kubín a zasahuje na katastrálne územia obcí Terchová a Párnica[5], okrajovo severným úbočím aj Zázrivá. Najbližší vrchol v hlavnom hrebeni je južne ležiaci Stoh (1 607 m n. m.), západným susedom sú Boboty (1 085 m n. m.), severným Malý Rozsutec (1 344 m n. m.) a juhovýchodným Osnica (1 363 m n. m.).',
            'latitude'          => 49.2316,
            'longitude'         => 19.0985,
            'mountain_id'       => 3,
            'thumbnail_path'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/20/Velky_Rozsutec.jpg/1280px-Velky_Rozsutec.jpg'
        ]);

        HillImage::create([
            'hill_id'   => $hill->id,
            'path'      => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Rozsutec_v_zime.jpg/1280px-Rozsutec_v_zime.jpg'
        ]);
        HillImage::create([
            'hill_id'   => $hill->id,
            'path'      => 'https://upload.wikimedia.org/wikipedia/commons/f/f6/Rozsutec.jpg'
        ]);


        $hill = Hill::create([
            'name'              => 'Veľký Choč',
            'height'            => 1611,
            'description'       => 'Veľký Choč je s výškou 1 611 m n. m. dominantým vrchom Chočských vrchov, viditeľný už od Štrby a z celej Dolnej Oravy. Vrchol je turisticky veľmi vyhľadávaný. Má tvar nepravidelnej pyramídy s početnými bralnými partiami. Z vrcholu Choča je vynikajúci kruhový výhľad. Jeho vrchol je porastený kosodrevinou, od Valaskej Dubovej má mierne stúpajúci tvar, kým zo severu a od Lúčok je v príkrom zráze.

            Vrch bol ospievaný mnohými básnikmi, medzi inými aj P. O. Hviezdoslavom, ktorý pochádzal z Vyšného Kubína, ležiaceho priamo pod Veľkým Chočom. Choč je považovaný za jeden z najkrajších vrchov Slovenska.',
            'latitude'          => 49.15097,
            'longitude'         => 19.34341,
            'mountain_id'       => 4,
            'thumbnail_path'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/View_of_Tatras_from_Choc.jpg/1280px-View_of_Tatras_from_Choc.jpg'
        ]);

        HillImage::create([
            'hill_id'   => $hill->id,
            'path'      => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/View_of_Tatras_from_Choc.jpg/1280px-View_of_Tatras_from_Choc.jpg'
        ]);
        HillImage::create([
            'hill_id'   => $hill->id,
            'path'      => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/Velky_Choc_from_Liptov.jpg/1280px-Velky_Choc_from_Liptov.jpg'
        ]);
        
        
        $hill = Hill::create([
            'name'              => 'Prosečné',
            'height'            => 1372,
            'description'       => 'Prosečné je výrazný vrch v Chočských vrchoch na Slovensku, najvyšší bod ich najvýchodnejšieho rovnomenného podcelku.

            Jeho masív je zo severu ohraničený Zubereckou brázdou, z východu Kvačianskou dolinou, z juhu Liptovskou kotlinou a zo západu Prosieckou dolinou. Budovaný je dolomitmi a vápencami.',
            'latitude'          => 49.1747,
            'longitude'         => 19.5136,
            'mountain_id'       => 4,
            'thumbnail_path'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/Velke_borove_leto_pohlad_na_prosecne.jpg/1280px-Velke_borove_leto_pohlad_na_prosecne.jpg'
        ]);

    }
}
