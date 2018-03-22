<div class="container-fluid">    
        <button class="top_button" onclick="topFunction()" id="btn_top" title="Go to top">
            <img class="top_arrow" src="arrow.svg">
        </button>
        <div class="row strip">

            <div class="col-3" style="padding:0px">
                <div class="row strip">

                    <div class="col-10 connexion">
                        <?php
                            if(basename($_SERVER['PHP_SELF']) == "new_user.php") { 
                        ?>
                            <a href="index.php">
                                <div class="btn_accueil">
                                    Retour à la <br/>Page d'accueil
                                </div>
                            </a>
                        <?php
                            } else {
                        ?>
                            <!-- Si connecté
                                <div class=panel_user>
                                <a href="index.php">
                                    <img src="hayden.jpg" class="pp"/>
                                    </a>
                                </div>
                            -->

                            <a href="index.php">
                                <div class=connect>
                                    Se connecter
                                </div>
                            </a>
                            <a href="new_user.php">
                                <div class="register">
                                    S'inscrire
                                </div>
                            </a>
                        <?php
                            }
                        ?>
                    </div>



                    <div class="col-2">
                    </div>
                </div>
            </div> 

            <div class="col-6 ">
                <div class="row" style="height:5vw">
                    <div class="col-1">
                         
                    </div>
                    <div class="col-11" style="padding:0px">
                        <?php
                            if(basename($_SERVER['PHP_SELF']) == "new_user.php") { 
                        ?>
                            <dic class="register_title"> Inscription à la plateforme</h1>
                        <?php
                            } else {
                        ?>
                        <div class="searchbar">
                            <form action="action_page.php" class="form">
                                <input class="search" type="text" placeholder="Rechercher..."  name="search">
                                <div class="others">
                                    
                                    <button type="submit" class="submit">
                                        <img class="magnifier" src="search.svg"/>
                                    </button>
                                    <select class="category">
                                        <option value="cours">Cours</option>
                                        <option value="utilisateur">Utilisateur</option>
                                        <option value="compétence">Compétence</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
            </div> 
            
            <div class="col-3">
                <div class="row strip">

                    <div class="col-5">
                    </div>

                    <div class="col-7 udepsi_strip">
                        <a href = "index.php" class="mainpagebutton">
                            <img class="udepsi_logo" src="logo.png" alt"logo epsi"/>
                            <img class="epsi_logo" src="epsi_l.png" alt="logo epsi"/> 
                        </a>
                    </div>
                </div>
            </div>

        </div>