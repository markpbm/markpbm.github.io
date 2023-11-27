<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href=".../../../css/pantalon.css">
</head>
<body>
<header>
            <nav class="menu">
                <section class="menu_contenedor">
                    <h1 class="menu_logo">TODO A TU ALCANCE.</h1>

                    <ul class="menu_links">
                        <li class="menu_item">
                            <a href="../index.html" class="menu_link">VOLVER</a>
                        </li>
        
                        <li class="menu_item menu_item--mostrar">
                            <a href="#" class="menu_link">CATEGORÍA <span class="material-symbols-outlined menu_arrow">
                                expand_more</span></a>
        
                            <ul class="submenu">
                                <li class="submenu_dentro">
                                    <a href="pantalon.html" class="menu_link menu_link--dentro">PANTALON</a>
                                </li>
        
                                <li class="submenu_dentro">
                                    <a href="blusa.html" class="menu_link menu_link--dentro">BLUSAS</a>
                                </li>
        
                                <li class="submenu_dentro">
                                    <a href="camisa.html" class="menu_link menu_link--dentro">CAMISAS</a>
                                </li>
        
                                <li class="submenu_dentro">
                                    <a href="ropa.html" class="menu_link menu_link--dentro">ROPAS</a>
                                </li>
        
                                <li class="submenu_dentro">
                                    <a href="vestido.html" class="menu_link menu_link--dentro">VESTIDOS</a>
                                </li>
        
                                <li class="submenu_dentro">
                                    <a href="zapatilla.html" class="menu_link menu_link--dentro">ZAPATILLAS</a>
                                </li>
        
                            </ul>
                        </li>
        
                        <li class="menu_item">
                            <a href="#" class="menu_link">CONTACTO</a>
                        </li>
        
                    </ul>

                    <div class="menu_hamburger">
                        <span class="material-symbols-outlined" class="menu_span">
                            menu
                        </span>
                    </div>
                </section>
            </nav>
        </header>
