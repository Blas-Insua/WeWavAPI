<!DOCTYPE html>
<html lang="es-AR">
<head>
    
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style2.css">
</head>
<body class="textwhite">

	<header>
        <nav>   
            <div id='nav1'>
                <a id="PageLogo" class="logo" href="home/">WeWav</a>  
                <div id="search">
                    <form action="search/" method="get">
                        <input name="q" type="text" placeholder="Search artists, tracks or genres...">
                        <button></button>
                    </form>
                </div>                
                <div id='menu'>                     
                    <button id="menuBtn">
                        <span class="menuline"></span>
                        <span class="menuline"></span>
                        <span class="menuline"></span>
                    </button>
                    <div id="menuBar">   
                        
                        {if $smarty.session.rol != 3}           
                            <p id="profileIcon"><span class="userLogo"><img src="{if $photo_dir!=null}{$photo_dir}{else}./images/profile_photos/default.png{/if}"></img></span>{$smarty.session.name}</p>                 
                            <a id="profile" href="about/{$smarty.session.name}/" class="menuRoute">My Profile</a>
                            {if $smarty.session.rol != 2}
                                <details class="menuRoute">                                
                                    <summary>System management</summary>
                                    <ul>
                                        <li><a class="managementRoute" href="management/tracks/">Tracks</a></li>
                                        <li><a class="managementRoute" href="management/accounts/">Accounts</a></li>
                                        <li><a class="managementRoute" href="management/genres/">Genres</a></li>
                                    </ul>
                                </details>
                            {/if}
                            <a id="logout" href="logout/" class="menuRoute">LogOut</a>                            
                        {else}
                            <a id="login" href="login/" class="menuRoute">Login</a>
                            <a id="signup" href="signup/" class="menuRoute">Signup</a>                            
                        {/if}    
                    </div>
                </div>
            </div>
            <div id='nav2'>
                <a id="home" href="home/" class="navRoute"><img src="./images/homeIcon2.png"><span>Home</span></img></a>
                <a id="artists" href="artists/" class="navRoute"><img src="./images/artistsIcon.png"><span>Artists</span></a>
                <a id="tracks" href="tracks/" class="navRoute"><img src="./images/tracksIcon.png"><span>Tracks</span></a>
                <a id="genres" href="genres/" class="navRoute"><img src="./images/genresIcon.png"><span>Genres</span></a>
                {if $smarty.session.rol != 3}<a id="upload" href="upload/" class="navRoute"><img src="./images/uploadIcon.png"><span>Upload</span></a>{/if}                   
            </div>
            <button id="navDisplay"><img src="./images/navDisplayButton.png"></img></button>    
        </nav>    
        
    </header>
    <main>