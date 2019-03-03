<!--
    DESIGNED BY ADAM CZWORDON
--><!DOCTYPE html>
<html lang="<?php if( $_GET["lang"]=="eng") {$eng=true; echo "en-US";} else {$eng=false;echo "pl";} ?>">
<head>
    <?php
    $engText = array(
        "title" => "From street Krańcowa to the edge of the stratosphere",
        "headerDesc" => "Innovative project of students from school nr2 from Ostrzeszów",
        "nav2" => "About",
        "nav3" => "Team",
        "nav4" => "Transmission",
        "nav5" => "Support",
        "nav6" => "Contact",
        "photoDesc" => "Students with professor Szałkowski",
        "header1" => "About project",
        "p1" => "A group of radio players under the direction of Grzegorz Szałkowski is carrying out a project to launch a stratospheric balloon with instrumentation. The planned start will take place on March 15, 2019 at 11:00 am on the school pitch at school nr 2 in Ostrzeszów.",
        "p2" => "We will take out the probes with cameras and shortwave transmitters in the stratosphere, and the received signals will be decoded and presented on school screens. We also encourage all interested parties to independently decode broadcast images and measurement data on their own smartphones. We are happy to help and show how you can watch the impulses from our transmitters.",
        "p3" => "Radio reception will be possible all the time during the climb, or more than 30 km up, until probes land on the surface. We would like to see how the world looks from the upper layers of the atmosphere and check whether continuous communication with our ground station will be maintained at every stage of the flight. We are also planning, for some time, to connect to the International Space Station (ISS) from our school radio station.",
        "p4" => "About us",
        "p5" => "We are a group of enthusiasts who want to make our yard of School No. 2 more attractive with the help of all scientific projects, aimed at showing that science does not always go down with boredom and monotony, but can be very interesting and developing new interests.",
        "p6" => "On board our probe will have:",
        "li1" => "SSTV transmitter",
        "li2" => "ATV transmitter",
        "li3" => "Two RS41 radiosonds",
        "li4" => "Camera",
        "p7" => "Tonal frequency:",
        "li5" => "APRS: 432.500MHz",
        "li6" => "RTTY: 436,600MHz + 437,700MHz",
        "li7" => "SSTV: 144,500MHz",
        "li8" => "ATV: 1.2GHz",
        "header2" => "Poll",
        "p8" => "We often look for meteorological radiosondes with only the equipment decoding the position of the probe and the walkie-talkie, thanks to which we know the signal level and we can get closer to this probe. Although we have a decoded probe position, it is not always reliable and we support the shortwave radio. We have already been on several such trips and unfortunately not all are successful.",
        "header3" => "News",
        "header4" => "Team",
        "schoolName" => "Schools No. 2 <br> them. Polish-Norwegian Friendship in Ostrzeszów",
        "header5" => "Transmission",
        "kontakt" => "Contact",
        "fNav1" => "School website",
        "fNav2" => "Event",
        "fNav3" => "Support",
        "fNav4" => "Login",
        "fNav5" => "All rights reserved &copy;"
    );
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?php if($eng){echo $engText["title"];}else{echo 'Z ulicy Krańcowej po Krańce Stratosfery';} ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta keywords="zs2, sonda kosmiczna, FUM, Ostrzeszów, informatyka, radio, projekt, kosmos, sonda, krótkofalówka">
    <meta name="description" content="Projekt jest realizowany przez grupę młodych amatorów krótkofalarstwa pod kierownictwem Grzegorza Szałkowskiego. Mamy na celu zobaczenie jak wygląda świat na wyższych warstwach atmosfery oraz sprawdzenie czy na każdym etapie lotu będzie zachowana ciągła łączność z naszą naziemną stacją. Planujemy również za jakiś czas połączyć się z Międzynarodową Stacją Kosmiczną z naszej stacji." />
    <meta name="theme-color" content="#222222"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/" type="image/x-icon">
    <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="manifest.json">

    <?php

    ini_set("display_errors", 1);
	require_once 'dbconnect.php';
	$conn = mysqli_connect($host, $user, $password);
	mysqli_query($conn, "SET CHARSET utf8");
	mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
	mysqli_select_db($conn, $database);
		
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		echo "\n Error: ".$conn->connect_errno." Opis: ".$conn->connect_error;
    }

    ?>

</head>
<body>
    <div class="top clearfix" id="top">
        <div class="top-left">
            <header class="header-text">
                <h1 class="header-h1"><?php if($eng){echo $engText["title"];}else{echo 'Z ulicy Krańcowej po Krańce Stratosfery';} ?></h1>
                <p class="header-p"><?php if($eng){echo $engText["headerDesc"];}else{echo 'Innowacyjny projekt uczniów ZS2 Ostrzeszów.';} ?></p>
            </header>
            <div id="nav" class="nav-container">
                <nav class="nav">
                    <ul class="nav-ul clearfix">
                        <li class="nav-li">
                            <a href="#top" class="nav-a">Start</a>
                        </li>
                        <li class="nav-li">
                            <a href="#about" class="nav-a"><?php if($eng){echo $engText["nav2"];}else{echo 'O projekcie';} ?></a>
                        </li>
                        <li class="nav-li">
                            <a href="#team" class="nav-a"><?php if($eng){echo $engText["nav3"];}else{echo 'Zespół';} ?></a>
                        </li>
                        <li class="nav-li">
                            <a href="#transmission" class="nav-a important"><?php if($eng){echo $engText["nav4"];}else{echo 'Transmisja';} ?></a>
                        </li>
                        <li class="nav-li">
                            <a href="https://zrzutka.pl/8amf3y" rel="noopener" class="nav-a" target="_blank"><?php if($eng){echo $engText["nav5"];}else{echo 'Wesprzyj';} ?></a>
                        </li>
                        <li class="nav-li">
                            <a href="#contact" class="nav-a"><?php if($eng){echo $engText["nav6"];}else{echo 'Kontakt';} ?></a>
                        </li>
                    </ul>
                </nav>
            </div>
            
        </div>

        <div class="team-element">
            <div class="top-team"><span class="img-description"><?php if($eng){echo $engText["photoDesc"];}else{echo 'Uczniowie z prof. Grzegorzem Szałkowskim';} ?></span></div>
        </div>
    </div>
    <div id="nav-mobile"></div>
    <main>
        <article class="content">
            <div class="content-section zs2logo" id="about">
                <h2><?php if($eng){echo $engText["header1"];}else{echo 'O projekcie';} ?></h2>
                <p><?php if($eng){echo $engText["p1"];}else{echo 'Grupa radiowców pod kierunkiem Grzegorza Szałkowskiego realizuje projekt startu balonu stratosferycznego wraz z oprzyrządowaniem. Planowany start odbędzie się 15 marca 2019 roku o godzinie 11:00 na boisku szkolnym przy Zespole Szkół nr 2 w Ostrzeszowie.';} ?></p>

                <p><?php if($eng){echo $engText["p2"];}else{echo 'Wyniesiemy w stratosferę sondy z kamerami i nadajnikami krótkofalarskimi, a odbierane sygnały będą dekodowane i prezentowane na szkolnych ekranach. Zachęcamy również wszystkich zainteresowanych do samodzielnego dekodowania nadawanych obrazów i danych pomiarowych na własnych smartfonach. Chętnie udzielimy pomocy i pokażemy jak można oglądać impulsy z naszych nadajników.';} ?></p>
                
                <p><?php if($eng){echo $engText["p3"];}else{echo 'Odbiór radiowy możliwy będzie cały czas podczas wznoszenia, czyli ponad 30 km w górę, aż do momentu wylądowania sond na powierzchni ziemi.
                Chcielibyśmy zobaczyć jak wygląda świat z wyższych warstw atmosfery oraz sprawdzić czy na każdym etapie lotu będzie zachowana ciągła łączność z naszą naziemną stacją. Planujemy również, za jakiś czas, połączyć się z Międzynarodową Stacją Kosmiczną (ISS) z naszej szkolnej radiostacji.';} ?></p>
            </div>

            <div class="content-section">
                <h2><?php if($eng){echo $engText["p4"];}else{echo 'O nas';} ?></h2>
                <p><?php if($eng){echo $engText["p5"];}else{echo 'Jesteśmy grupą zapaleńców którzy chcą uczynić nasze podwórko Zespołu Szkół nr.2 bardziej atrakcyjne za pomocą wszelakich projektów naukowych, mających na celu ukazanie, że nauka nie zawsze idzie w parzę z nudą i monotonią, ale może być bardzo ciekawa i rozwijająca nowe zainteresowania.';} ?></p>
            </div>
            
            
            <div class="content-section">
                <p><?php if($eng){echo $engText["p6"];}else{echo 'Na pokładzie naszej sondy znajdzie się:';} ?></p>
                <ul>
                    <li><?php if($eng){echo $engText["li1"];}else{echo 'Nadajnik SSTV';} ?></li>
                    <li><?php if($eng){echo $engText["li2"];}else{echo 'Nadajnik ATV';} ?></li>
                    <li><?php if($eng){echo $engText["li3"];}else{echo 'Dwie radiosondy RS41';} ?></li>
                    <li><?php if($eng){echo $engText["li4"];}else{echo 'Kamera';} ?></li>
                </ul>

                <p><?php if($eng){echo $engText["p7"];}else{echo 'Częstoliwości:';} ?></p>
                <ul>
                    <li><?php if($eng){echo $engText["li5"];}else{echo 'APRS: 432,500MHz';} ?></li>
                    <li><?php if($eng){echo $engText["li6"];}else{echo 'RTTY: 436,600MHz + 437,700MHz';} ?></li>
                    <li><?php if($eng){echo $engText["li7"];}else{echo 'SSTV: 144,500MHz';} ?></li>
                    <li><?php if($eng){echo $engText["li8"];}else{echo 'ATV: 1,2GHz';} ?></li>
                </ul>
            </div>

            <div class="content-section">
                <h2><?php if($eng){echo $engText["header2"];}else{echo 'Sonda';} ?></h2>
                <p><?php if($eng){echo $engText["p8"];}else{echo 'Często szukamy radiosondy meteorologiczne mając do dyspozycji tylko sprzęt dekodujący pozycję sondy oraz krótkofalówkę, dzięki której znamy poziom sygnału i możemy się zbliżyć do tej sondy. Mimo, że mamy zdekodowaną pozycję sondy nie zawsze jest to miarodajne i wspieramy się krótkofalówką. Byliśmy już na kilku takich wyprawach i niestety nie każda jest powodzeniem.';} ?></p>
            </div>

            <div class="content-section posts">

                <h2 class="center"><?php if($eng){echo $engText["header3"];}else{echo 'Aktualności';} ?></h2>
                <!--<div class="post-el">
                    <h2 class="post-title">Tytuł</h2>
                    <p class="post-content">Treść</p>
                    <p class="post-info">Opublikowano <time datetime="2011-01-07T20:40:06+00:00" class="dt-published" itemprop="datePublished">07.01.2011</time> w kategorii test</p>
                </div>-->
                <?php
                $query = mysqli_query($conn, "SELECT wpisy.id,wpisy.tytul,wpisy.tresc,wpisy.data,kategorie.nazwa FROM wpisy INNER JOIN kategorie ON wpisy.kategoria = kategorie.idKat WHERE wpisy.widoczny=1");

                while($row = mysqli_fetch_assoc($query)) {
                    echo '<div class="post-el"><h2 class="post-title">'.$row["tytul"].'</h2>
                    <div class="post-content">'.$row["tresc"].'</div>
                    <p class="post-info">Opublikowano <time datetime="'.$row["data"].'" class="dt-published" itemprop="datePublished">'.$row["data"].'</time> w kategorii '.$row["nazwa"].'</p></div>';
                }
                ?>
            </div>
        </article>

        <section class="team-section" id="team">
            <div class="team-center clearfix">
                <div class="team-panel">
                    <h2><?php if($eng){echo $engText["header4"];}else{echo 'Zespół';} ?></h2>
                    <ul class="team-ul clearfix">
                        <li class="team-li"><span class="team-span">prof. Grzegorz Szałkowski</span></li>
                        <li class="team-li"><span class="team-span">Artur Matys</span></li>
                        <li class="team-li"><span class="team-span">Adam Czwordon</span></li>
                        <li class="team-li"><span class="team-span">Bartłomiej Płonka</span></li>
                        <li class="team-li"><span class="team-span">Cezary Walczak</span></li>
                        <li class="team-li"><span class="team-span">Filip Michałczyk</span></li>
                        <li class="team-li"><span class="team-span">Kacper Kolebski</span></li>
                        <li class="team-li"><span class="team-span">Magda Kryś</span></li>
                        <li class="team-li"><span class="team-span">Aleksandra Matysik</span></li>
                        <li class="team-li"><span class="team-span">Mateusz Kacyna</span></li>
                        <li class="team-li"><span class="team-span">Olivier Kasprzak</span></li>
                        <li class="team-li"><span class="team-span">Patryk Adamski</span></li>
                        <li class="team-li"><span class="team-span">Patryk Sikora</span></li>
                    </ul>
                </div>
                <div class="team-right">
                
                    <div class="img-container">
                        <img src="img/photo1.jpeg" class="team-img" alt="4 people, one speaking with a microphone">
                    </div>
                    <div class="img-container">
                        <img src="img/photo3.jpeg" class="team-img" alt="Frequency chart on monitor screen">
                    </div>
                    <div class="team-triangle">
                        <strong class="text-logo"><?php if($eng){echo $engText["schoolName"];}else{echo 'Zespół Szkół Nr 2 <br> im. Przyjaźni Polsko-Norweskiej w Ostrzeszowie';} ?></strong> 
                    </div>

                </div>
            </div>

        </section>

        <div>
            <iframe width="490" height="310" src="https://tracker.habhub.org/index.html?embed=1&hidelist=1&hidegraph=0&expandgraph=0&filter=SP3KRE%3BSP6ZWR" class="habhub-iframe" title="Mapa Habhub"></iframe>
        </div>

        <section class="transmission-panel" id="transmission">
            <div class="transmission-heading">
                <h2><?php if($eng){echo $engText["header5"];}else{echo 'Transmisja';} ?></h2>
            </div>
            
            <?php 
                $query = mysqli_query($conn, "SELECT * FROM transmisja LIMIT 1");
                $row = mysqli_fetch_assoc($query);
            ?>
            <iframe src="<?php echo $row["url"].'?autoplay=1&rel=0';?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="yt-player" title="Transmisja na żywo z balonu stratosferycznego"></iframe>
            
        </section>

        <section class="content contact clearfix" id="contact">

            <h2 class="big-h2"><?php if($eng){echo $engText["kontakt"];}else{echo 'Kontakt';} ?></h2>
            <p>
            Zespół Szkół Nr 2 im. Przyjaźni Polsko-Norweskiej w Ostrzeszowie<br>
            ul. Krańcowa 7<br>
            63-500 Ostrzeszów<br>
            tel.<br> <a href="tel:++48627320775,1">+48 62 732 07 75</a><br>
            e-mail:<br> <a href="mailto:sekretariat@zs2.ostrzeszow.pl">sekretariat@zs2.ostrzeszow.pl</a>
            </p>
            <p>
            Nauczyciel Prowadzący:<br>
            Grzegorz Szałkowski<br>
            tel.<br> <a href="tel:+48605406552,1">+48 605 406 552</a><br>
            e-mail:<br> <a href="mailto:stratosfera.ostrzeszow@gmail.com">stratosfera.ostrzeszow@gmail.com</a>
            </p>

        </section>

    </main>
    <footer class="footer">
        <nav class="footer-nav">
            <ul class="footer-ul">
                <li class="footer-li"><a href="#top">Start</a></li>
                <li class="footer-li"><a href="http://www.zsz2.ostrzeszow.pl/" target="_blank" rel="noopener"><?php if($eng){echo $engText["fNav1"];}else{echo 'Strona szkoły';} ?></a></li>
                <li class="footer-li"><a href="https://www.facebook.com/zs2ostrzeszow/" target="_blank" rel="noopener">Facebook</a></li>
                <li class="footer-li"><a href="https://www.facebook.com/events/2146897728954444/" target="_blank" rel="noopener"><?php if($eng){echo $engText["fNav2"];}else{echo 'Wydarzenie';} ?></a></li>
                <li class="footer-li"><a href="https://zrzutka.pl/8amf3y" target="_blank" rel="noopener"><?php if($eng){echo $engText["fNav3"];}else{echo 'Wesprzyj';} ?></a></li>
                <li class="footer-li"><a href="zaplecze/1/2/index.php" target="_blank" rel="noopener"><?php if($eng){echo $engText["fNav4"];}else{echo 'Zaloguj';} ?></a></li>
                <li class="footer-li"><a href="https://github.com/Smokolisz/zs2sonda" target="_blank" rel="noopener">GitHub</a></li>
            </ul>
            <a href="?lang=pl" title="Strona w języku polskim"><img src="img/pl2.png" alt="Polska flaga"></a>
            <a href="?lang=eng" title="Website in English language"><img src="img/eng2.jpg" alt="English flag"></a>
            <!-- https://github.com/Smokolisz/zs2sonda -->
            <p class="copyright"><?php if($eng){echo $engText["fNav5"];}else{echo 'Wszelkie prawa zastrzeżone &copy;';} ?></p>
        </nav>
    </footer>
    <script src="js/app.js"></script>

    <?php
	mysqli_close($conn);
	?>
</body>
</html>