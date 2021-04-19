<?php
echo '
<div class="colorlib-loader"></div>

<div id="page">
    <nav class="colorlib-nav" role="navigation">
        <div class="top-menu">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div id="colorlib-logo"><a href="http://www.fauser.edu">ITT Fauser</a></div>
                    </div>
                    <div class="col-md-10 text-right menu-1">
                        <ul>
                            <li><a href="index.jsp">Home</a></li>
                            <li><a href="nuovadomanda.jsp">Nuova domanda</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section id="home" class="video-hero" style="height: 700px; background-image: url(images/cover_img_1.jpg);  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
        <div class="overlay"></div>
        <a class="player" data-property="{videoURL:\'https://www.youtube.com/watch?v=vqqt5p0q-eU\',containment:\'#home\', showControls:false, autoPlay:true, loop:true, mute:true, startAt:0, opacity:1, quality:\'default\'}"></a>
        <div class="display-t text-center">
            <div class="display-tc">
                <div class="container">
                    <div class="col-md-12 col-md-offset-0">
                        <div class="animate-box">
                            <h2>DOMANDE &amp; RISPOSTE</h2>
                            <p>Applicazione didattica per gli studenti dell&#39;ITT &ldquo;G. Fauser&rdquo; di Novara</p>
                            <p><a href="#elenco" class="btn btn-primary btn-lg btn-custom">Elenco domande</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
'
?>