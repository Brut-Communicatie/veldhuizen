<?php

// Generate Database for footer information

function veldhuizenFooterDatabase () {
    global $wpdb;
    $table_name = $wpdb->prefix . "veldhuizen_footer"; 
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    plaats text NOT NULL,
    soort text NOT NULL,
    straat text NOT NULL,
    adres text NOT NULL,
    telefoon text NOT NULL,
    email text NOT NULL,
    key text NOT NULL,
    PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    $test = dbDelta( $sql );
    var_dump( $test );
}
veldhuizenFooterDatabase();
// Init Footer Menu page

function veldhuizen_footer() {
  add_menu_page("Footer", "Footer", 'read', "manrollo-plugin", "editFooter");
}
add_action( 'admin_menu', 'veldhuizen_footer' );

function editFooter(){
 
    echo '<h1>hoi</h1>';

    if(isset($_POST['submitFooter'])){
        global $wpdb;
        $table_name = $wpdb->prefix . "veldhuizen_footer"; 

        $plaats = $_POST['plaats'];
        $soort = $_POST['soort'];
        $straat = $_POST['straat'];
        $adres = $_POST['adres'];
        $telefoon = $_POST['telefoon'];
        $email = $_POST['email'];
        $key = $_POST['key'];

        $insert = $wpdb->insert( 
            $table_name, 
            array( 
                'plaats' => $plaats, 
                'soort' => $soort, 
                'straat' => $straat, 
                'adres' => $adres,
                'telefoon' => $telefoon,
                'email' => $email,
                'key' => $key
            )
        );        
        var_dump($insert);
    }

    echo '<h1>Footer items</h1>';
    echo '<form method="POST">';
    echo '<input type="text" name="plaats" placeholder="Plaats"/>';
    echo '<input type="text" name="soort" placeholder="Soort"/>';
    echo '<input type="text" name="straat" placeholder="Straat"/>';
    echo '<input type="text" name="adres" placeholder="Adres"/>';
    echo '<input type="text" name="telefoon" placeholder="Telefoon"/>';
    echo '<input type="text" name="email" placeholder="Email"/>';
    echo '<input type="text" name="key" placeholder="Key"/>';
    echo '<button name="submitFooter">Toevoegen</button>';
    echo '</form>';

}

