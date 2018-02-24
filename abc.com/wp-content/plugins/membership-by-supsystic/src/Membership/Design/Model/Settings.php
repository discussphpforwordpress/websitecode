<?php

class Membership_Design_Model_Settings extends Membership_Base_Model_Settings
{
	protected $settingField = 'design';
	
	public function defaultSettings() 
	{
		return array (
			'general' => array(
				'default-theme-colors' => 'false',
				'avatar-style' => 'round',
				'primary-button-color' => 'rgb(33, 133, 208)',
				'primary-button-hover-color' => 'rgb(25, 105, 164)',
				'primary-button-text-color' => 'rgb(255, 255, 255)',
				'secondary-button-color' => 'rgb(224, 225, 225)',
				'secondary-button-hover-color' => 'rgb(202, 203, 205)',
				'secondary-button-text-color' => 'rgba(0, 0, 0, 0.8)',
				// 'primary-color' => 'rgb(72, 153, 153)',
				// 'secondary-color' => 'rgb(17, 122, 122)',

				'label-text-color' => 'rgba(0, 0, 0, 0.87)',
				'input-border-color' => 'rgba(34, 36, 38, .15)',
				'input-border-focus-color' => 'rgb(133, 183, 217)',
				'input-background-color' => 'rgb(255, 255, 255)',
				'input-background-focus-color' => 'rgb(255, 255, 255)',
				'input-text-color' => 'rgba(0, 0, 0, 0.87)',
				'input-placeholder-color' => 'rgba(0, 0, 0, 0.67)',
				// 'help-icon-background-color' => '',
				// 'help-icon-text-color' => '',
				// 'show-asterisk' => 'true',
				// 'asterisk-color' => '',
			),
			'menu' => array(
				'add-logout-link' => 'false',
				'remove-login-registration' => 'false',
			),
			'activity' => array(
				'show-filter' => 'true',
				'default-filter' => 'site-wide',
				'type' => array(
					'posts' => 'true',
					'photos' => 'true',
					'shares' => 'true',
					'likes' => 'true',
					'comments' => 'true',
					'groups' => 'true',
					'social' => 'true',
					'forum' => 'true',
				)
			),
 			'profile' => array(
				'container-max-width' => '100%',
				'header-background-color' => 'rgb(255, 255, 255)',
				'show-display-name' => 'true',
				// 'area-max-width' => '',
				// 'primary-button-text' => '',
				// 'secondary-button-text' => '',
				// 'base-background-color' => '',
				// 'header-background-color' => '',
				// 'default-photo' => '',
				// 'default-cover-photo' => '',
				// 'header-meta-text-color' => '',
				// 'header-link-color' => '',
				// 'header-link-hover-color' => '',
				// 'header-icon-link-color' => '',
				// 'header-icon-link-hover-color' => '',
			),
			'auth' => array(
				'registration-primary-button-text' => 'Registration',
				// 'registration-max-width' => '',
				// 'registration-secondary-button-text' => '',
				// 'registration-secondary-button-url' => '',
				// 'registration-default-role' => 'true',
				// 'login-max-width' => '',
				'login-primary-button-text' => 'Log In',
				'login-secondary-button' => 'true',
				'login-secondary-button-text' => 'Create account',
				'login-secondary-button-url' => '/registration',
				'login-show-remember-me' => 'true',
				'login-google-recaptcha-enable' => 'false',
				'login-google-recaptcha-theme' => 'light',
				'login-google-recaptcha-type' => 'image',
				'login-google-recaptcha-size' => 'normal',
			),
			'members' => array(
				'roles-to-display' => array('all'),
				'show-only-with-avatar' => 'false',
				'show-only-with-cover' => 'false',
                'show-load-more-button' => 'true',
                'show-pages' => 'false',
                'show-tabs' => 'false',
				'sort-users-by' => 'new-users-first',
				'show-friends-and-followers' => 'true'
			),
		);
	}

	protected static $fontsList = array("initial", "Abel", "Abril Fatface", "Aclonica", "Acme", "Actor", "Adamina", "Advent Pro",
		"Aguafina Script", "Aladin", "Aldrich", "Alegreya", "Alegreya SC", "Alex Brush", "Alfa Slab One", "Alice",
		"Alike", "Alike Angular", "Allan", "Allerta", "Allerta Stencil", "Allura", "Almendra", "Almendra SC", "Amaranth",
		"Amatic SC", "Amethysta", "Andada", "Andika", "Angkor", "Annie Use Your Telescope", "Anonymous Pro", "Antic",
		"Antic Didone", "Antic Slab", "Anton", "Arapey", "Arbutus", "Architects Daughter", "Arimo", "Arizonia", "Armata",
		"Artifika", "Arvo", "Asap", "Asset", "Astloch", "Asul", "Atomic Age", "Aubrey", "Audiowide", "Average",
		"Averia Gruesa Libre", "Averia Libre", "Averia Sans Libre", "Averia Serif Libre", "Bad Script", "Balthazar",
		"Bangers", "Basic", "Battambang", "Baumans", "Bayon", "Belgrano", "Belleza", "Bentham", "Berkshire Swash",
		"Bevan", "Bigshot One", "Bilbo", "Bilbo Swash Caps", "Bitter", "Black Ops One", "Bokor", "Bonbon", "Boogaloo",
		"Bowlby One", "Bowlby One SC", "Brawler", "Bree Serif", "Bubblegum Sans", "Buda", "Buenard", "Butcherman",
		"Butterfly Kids", "Cabin", "Cabin Condensed", "Cabin Sketch", "Caesar Dressing", "Cagliostro", "Calligraffitti",
		"Cambo", "Candal", "Cantarell", "Cantata One", "Cardo", "Carme", "Carter One", "Caudex", "Cedarville Cursive",
		"Ceviche One", "Changa One", "Chango", "Chau Philomene One", "Chelsea Market", "Chenla", "Cherry Cream Soda",
		"Chewy", "Chicle", "Chivo", "Coda", "Coda Caption", "Codystar", "Comfortaa", "Coming Soon", "Concert One",
		"Condiment", "Content", "Contrail One", "Convergence", "Cookie", "Copse", "Corben", "Cousine", "Coustard",
		"Covered By Your Grace", "Crafty Girls", "Creepster", "Crete Round", "Crimson Text", "Crushed", "Cuprum", "Cutive",
		"Damion", "Dancing Script", "Dangrek", "Dawning of a New Day", "Days One", "Delius", "Delius Swash Caps",
		"Delius Unicase", "Della Respira", "Devonshire", "Didact Gothic", "Diplomata", "Diplomata SC", "Doppio One",
		"Dorsa", "Dosis", "Dr Sugiyama", "Droid Sans", "Droid Sans Mono", "Droid Serif", "Duru Sans", "Dynalight",
		"EB Garamond", "Eater", "Economica", "Electrolize", "Emblema One", "Emilys Candy", "Engagement", "Enriqueta",
		"Erica One", "Esteban", "Euphoria Script", "Ewert", "Exo", "Expletus Sans", "Fanwood Text", "Fascinate", "Fascinate Inline",
		"Federant", "Federo", "Felipa", "Fjord One", "Flamenco", "Flavors", "Fondamento", "Fontdiner Swanky", "Forum",
		"Francois One", "Fredericka the Great", "Fredoka One", "Freehand", "Fresca", "Frijole", "Fugaz One", "GFS Didot",
		"GFS Neohellenic", "Galdeano", "Gentium Basic", "Gentium Book Basic", "Geo", "Geostar", "Geostar Fill", "Germania One",
		"Give You Glory", "Glass Antiqua", "Glegoo", "Gloria Hallelujah", "Goblin One", "Gochi Hand", "Gorditas",
		"Goudy Bookletter 1911", "Graduate", "Gravitas One", "Great Vibes", "Gruppo", "Gudea", "Habibi", "Hammersmith One",
		"Handlee", "Hanuman", "Happy Monkey", "Henny Penny", "Herr Von Muellerhoff", "Holtwood One SC", "Homemade Apple",
		"Homenaje", "IM Fell DW Pica", "IM Fell DW Pica SC", "IM Fell Double Pica", "IM Fell Double Pica SC",
		"IM Fell English", "IM Fell English SC", "IM Fell French Canon", "IM Fell French Canon SC", "IM Fell Great Primer",
		"IM Fell Great Primer SC", "Iceberg", "Iceland", "Imprima", "Inconsolata", "Inder", "Indie Flower", "Inika",
		"Irish Grover", "Istok Web", "Italiana", "Italianno", "Jim Nightshade", "Jockey One", "Jolly Lodger", "Josefin Sans",
		"Josefin Slab", "Judson", "Julee", "Junge", "Jura", "Just Another Hand", "Just Me Again Down Here", "Kameron",
		"Karla", "Kaushan Script", "Kelly Slab", "Kenia", "Khmer", "Knewave", "Kotta One", "Koulen", "Kranky", "Kreon",
		"Kristi", "Krona One", "La Belle Aurore", "Lancelot", "Lato", "League Script", "Leckerli One", "Ledger", "Lekton",
		"Lemon", "Lilita One", "Limelight", "Linden Hill", "Lobster", "Lobster Two", "Londrina Outline", "Londrina Shadow",
		"Londrina Sketch", "Londrina Solid", "Lora", "Love Ya Like A Sister", "Loved by the King", "Lovers Quarrel",
		"Luckiest Guy", "Lusitana", "Lustria", "Macondo", "Macondo Swash Caps", "Magra", "Maiden Orange", "Mako", "Marck Script",
		"Marko One", "Marmelad", "Marvel", "Mate", "Mate SC", "Maven Pro", "Meddon", "MedievalSharp", "Medula One", "Merriweather",
		"Metal", "Metamorphous", "Michroma", "Miltonian", "Miltonian Tattoo", "Miniver", "Miss Fajardose", "Modern Antiqua",
		"Molengo", "Monofett", "Monoton", "Monsieur La Doulaise", "Montaga", "Montez", "Montserrat", "Moul", "Moulpali",
		"Mountains of Christmas", "Mr Bedfort", "Mr Dafoe", "Mr De Haviland", "Mrs Saint Delafield", "Mrs Sheppards",
		"Muli", "Mystery Quest", "Neucha", "Neuton", "News Cycle", "Niconne", "Nixie One", "Nobile", "Nokora", "Norican",
		"Nosifer", "Nothing You Could Do", "Noticia Text", "Nova Cut", "Nova Flat", "Nova Mono", "Nova Oval", "Nova Round",
		"Nova Script", "Nova Slim", "Nova Square", "Numans", "Nunito", "Odor Mean Chey", "Old Standard TT", "Oldenburg",
		"Oleo Script", "Open Sans", "Open Sans Condensed", "Orbitron", "Original Surfer", "Oswald", "Over the Rainbow",
		"Overlock", "Overlock SC", "Ovo", "Oxygen", "PT Mono", "PT Sans", "PT Sans Caption", "PT Sans Narrow", "PT Serif",
		"PT Serif Caption", "Pacifico", "Parisienne", "Passero One", "Passion One", "Patrick Hand", "Patua One", "Paytone One",
		"Permanent Marker", "Petrona", "Philosopher", "Piedra", "Pinyon Script", "Plaster", "Play", "Playball", "Playfair Display",
		"Podkova", "Poiret One", "Poller One", "Poly", "Pompiere", "Pontano Sans", "Port Lligat Sans", "Port Lligat Slab",
		"Prata", "Preahvihear", "Press Start 2P", "Princess Sofia", "Prociono", "Prosto One", "Puritan", "Quantico",
		"Quattrocento", "Quattrocento Sans", "Questrial", "Quicksand", "Qwigley", "Radley", "Raleway", "Rammetto One",
		"Rancho", "Rationale", "Redressed", "Reenie Beanie", "Revalia", "Ribeye", "Ribeye Marrow", "Righteous", "Rochester",
		"Rock Salt", "Rokkitt", "Ropa Sans", "Rosario", "Rosarivo", "Rouge Script", "Ruda", "Ruge Boogie", "Ruluko",
		"Ruslan Display", "Russo One", "Ruthie", "Sail", "Salsa", "Sancreek", "Sansita One", "Sarina", "Satisfy", "Schoolbell",
		"Seaweed Script", "Sevillana", "Shadows Into Light", "Shadows Into Light Two", "Shanti", "Share", "Shojumaru",
		"Short Stack", "Siemreap", "Sigmar One", "Signika", "Signika Negative", "Simonetta", "Sirin Stencil", "Six Caps",
		"Slackey", "Smokum", "Smythe", "Sniglet", "Snippet", "Sofia", "Sonsie One", "Sorts Mill Goudy", "Special Elite",
		"Spicy Rice", "Spinnaker", "Spirax", "Squada One", "Stardos Stencil", "Stint Ultra Condensed", "Stint Ultra Expanded",
		"Stoke", "Sue Ellen Francisco", "Sunshiney", "Supermercado One", "Suwannaphum", "Swanky and Moo Moo", "Syncopate",
		"Tangerine", "Taprom", "Telex", "Tenor Sans", "The Girl Next Door", "Tienne", "Tinos", "Titan One", "Trade Winds",
		"Trocchi", "Trochut", "Trykker", "Tulpen One", "Ubuntu", "Ubuntu Condensed", "Ubuntu Mono", "Ultra", "Uncial Antiqua",
		"UnifrakturCook", "UnifrakturMaguntia", "Unkempt", "Unlock", "Unna", "VT323", "Varela", "Varela Round", "Vast Shadow",
		"Vibur", "Vidaloka", "Viga", "Voces", "Volkhov", "Vollkorn", "Voltaire", "Waiting for the Sunrise", "Wallpoet",
		"Walter Turncoat", "Wellfleet", "Wire One", "Yanone Kaffeesatz", "Yellowtail", "Yeseva One", "Yesteryear", "Zeyada"
	);

	public function getFontsList() {
		return self::$fontsList;
	}

	public function getFontsListForSelector() {
		$fl = array();
		if(count(self::$fontsList)) {
			foreach(self::$fontsList as $elem) {
				$fl[] = array(
					'value' => $elem,
					'title' => $elem,
				);
			}
		}
		return $fl;
	}
	
	public function getWpMenuListForSelector() {
		$menuRes = array();

		$menus = wp_get_nav_menus();
		if(count($menus)) {
			foreach($menus as $mVal) {
				if(property_exists($mVal, 'term_id') && property_exists($mVal, 'name')) {
					$menuRes[] = array(
						'title' => $mVal->name,
						'value' => $mVal->term_id,
					);
				}
			}
		}

		return $menuRes;
	}
}