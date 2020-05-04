<div class="container">
            <img class="wideImage" src="<?php echo get_stylesheet_directory_uri()?>/Images/49531010-48dad180-f8b1-11e8-8d89-1e61320e1d82.png" alt="Placeholder">
            <div class="wavemotif-loader waveUIGREY wavePerusUpsidedown"></div>
            <div class="pageTitleText">
                <h1><?php the_title(); ?></h1>
                <p>dolor, sit amet consectetur adipisicing elit. Cumque labore repellat delectus suscipit, provident,
                    quis
                </p>
            </div>
        </div>

        <div class="container Eventtext">
            <h2>Tule yritystapahtumiimme ja vaikutu</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam debitis, totam odio ad quibusdam dolore
                dolor,
                odit repellendus omnis deserunt eligendi vitae nulla reprehenderit libero, cum aliquam corporis magni
                eius.
            </p>
        </div>

        <!--Events -->

        <div class="EventContainer">
            <div class="wavemotif-loader waveUIGREY waveTyrsky"></div>
            <!--Events Categories-->
            <div class="bgGrey">
                <header>Tapahtumia</header>
                <h4>Rajaa Tapahtumia:</h4>
                <div class="EventCategories">
                    <?php
                        $eventCats = get_terms(array(
                            'taxonomy' => 'event-category'
                        ));

                        foreach($eventCats as $eventCat) {
                            echo "<a class='palvelu-filter' href='javascript:void(0)' data-filter='" . $eventCat->slug . "'>" . ucwords($eventCat->name) . "</a>";
                        }
                    ?>
                </div>

                <!--Events Cards-->

                <div class="EventCards">
                    
                </div>
                <div class="wavemotif-loader waveUIGREY waveTyrsky Upsidedown"></div>
            </div>
        </div>

        <!--Swirly Divider-->


        <!-- Square image with Text box on the right-->
        <div class="container">
            <img class="squareImageLeft" src="/Images/49531010-48dad180-f8b1-11e8-8d89-1e61320e1d82.png"
                alt="Placeholder">
            <div class="overlayImageRight bgGrey">
                <h3>Tapahtumamateriaalit</h3>
                <p>dolor, sit amet consectetur adipisicing elit. Cumque labore repellat delectus suscipit, provident,
                    quis
                    asperiores esse amet numquam corporis nesciunt minima, accusantium doloribus dicta ratione mollitia
                    eius
                    quam quod?
                </p>
                <div class="eventsButton"> Katso tapahtumamateriaalit</div>
            </div>
        </div>

        <div class="container">

            <!-- Square image with Text box on the left -->
            <img class="squareImageRight" src="/Images/49531010-48dad180-f8b1-11e8-8d89-1e61320e1d82.png"
                alt="Placeholder">
            <div class="overlayImageLeft">
                <h2>Tietoa meistä</h2>
                <p>dolor, sit amet consectetur adipisicing elit. Cumque labore repellat delectus suscipit, provident,
                    quis
                    asperiores esse amet numquam corporis nesciunt minima, accusantium doloribus dicta ratione mollitia
                    eius
                    quam quod?
                </p>
                <div class="eventsButton"> Lue lisää</div>
            </div>
        </div>

        <!-- map -->
        <div style="bottom: 0px;" class="wavemotif-loader waveUIGREY wavePerus"></div>
        <div class="mapcontainer">
            <div class="mapTextOverlay">
                <h2>Miten löydät perille</h2>
                <p>Toimipisteemme sijaitsee Kalliossa Helsingin Kaupunginteatteria vastapäätä</p>
                <h4>Liikenneyhteydet:</h4>
                <p>Lähin metropysäkki luoksemme on Hakaniemi.</p>
                <p>Raitiovaunuilla 3 ja 9 pääset Kallion virastotalo-pysäkille, josta kävelyä n. 650m.</p>
                <p>Omalla autolla asioidessasi meillä voit vapaasti pysäköidä takapihallemme asiakkaille varatuille
                    paikoille.</p>
                <p>Huomioithan kuitenkin, että portti on auki ma-pe klo 8:30-16:00.</p>
            </div>
            <div class="map">
                <h1>Map will go here</h1>
            </div>
        </div>

<script type="text/javascript">
    function getFilteredEvents(categoryName = '', eventsOffset = 0) {
        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == "") {
                    if (!!document.querySelector("#loadMessage")) {
                        document.querySelector(".EventCards").removeChild(document.querySelector("#loadMessage"));
                    }
                    document.querySelector(".EventCards").innerHTML = "<p id='loadMessage'>There is not any events under that category :(</p>";
                }else{
                    if (!!document.querySelector("#loadMessage")) {
                        document.querySelector(".EventCards").removeChild(document.querySelector("#loadMessage"));
                    }
                    if (!!document.querySelector("#loadMoreEvents")) {
                        document.querySelector(".EventCards").removeChild(document.querySelector("#loadMoreEvents"));
                    }
                    document.querySelector(".EventCards").innerHTML += this.responseText;

                    if (this.responseText.includes("id='loadMoreEvents'")) {
                        checkIfLoadMoreButtonIsLoaded();
                    }
                }
            }else if(this.status == 404 || this.status == 400) {
                if (!!document.querySelector("#loadMessage")) {
                        document.querySelector(".EventCards").removeChild(document.querySelector("#loadMessage"));
                    }
                document.querySelector(".EventCards").innerHTML = "There was an error...";
            }else{
                if (!!document.querySelector("#loadMessage")) {
                        document.querySelector(".EventCards").removeChild(document.querySelector("#loadMessage"));
                    }
                document.querySelector(".EventCards").innerHTML += "<p id='loadMessage'>Loading events...</p>";
            }
        }

        request.open("POST", '<?php echo get_site_url() . "/wp-admin/admin-ajax.php"; ?>', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
        request.send("action=getFilteredEvents&categoryName=" + categoryName + "&eventsOffset=" + eventsOffset);
    }

    function unselectAllFilterButtons() {
        document.querySelectorAll(".palvelu-filter").forEach(filterButton => {
            filterButton.classList.remove("palvelu-filter-selected");
        });
    }

    document.querySelectorAll(".palvelu-filter").forEach(filterButton => {
        filterButton.onclick = function() {
            document.querySelector('.EventCards').innerHTML = '';
            getFilteredEvents(filterButton.dataset.filter);
            unselectAllFilterButtons();
            filterButton.classList.add("palvelu-filter-selected");
        }
    });

    function checkIfLoadMoreButtonIsLoaded() {
        if (!!!document.querySelector("#loadMoreEvents")) {
            setTimeout(function() {
                checkIfLoadMoreButtonIsLoaded();
            }, 200);
        }else{
            document.querySelector("#loadMoreEvents").onclick = function() {
                if (!!document.querySelector(".palvelu-filter-selected")) {
                    getFilteredEvents(document.querySelector(".palvelu-filter-selected").dataset.filter, document.querySelector("#loadMoreEvents").dataset.offset);
                }else{
                    getFilteredEvents('', document.querySelector("#loadMoreEvents").dataset.offset);
                }
            }
        }
    }

    getFilteredEvents();
    checkIfLoadMoreButtonIsLoaded();
</script>