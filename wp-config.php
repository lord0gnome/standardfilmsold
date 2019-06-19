<?php
@ini_set('upload_max_size' , '32M');

define('ENV', 'dev');

define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST']);
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);

define('UBP_SITEURL', 'http://standard.anonymous.paris');
// define('UBP_IS_LOCAL', true);

/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'standard');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'standard');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'CUCskUjwcVP6F4');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'mysql.anonymous.paris');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données.
  * N'y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '8_f=khR=w[KGwJPW{>ic5JwsGkUyi6{}>,i+KsvI<9 >Fcged5-^jXWl)1M;nNb+');
define('SECURE_AUTH_KEY',  ':dzjc_x0SqQs>~Rh6:< @@N>WK0S^UVb[Gsa)d= ,|/%c`z?+s_a{d_{s[R@e;eS');
define('LOGGED_IN_KEY',    '5S-j?6KYEJUi:y&+(xGPp+0Kb@vV-s%wxz3dM4^^?i[/6<?sw`c2igSF$lVU@iaP');
define('NONCE_KEY',        'y^CGl{qgTE_&~;y YjVC(RNYS|L7`Pv/+q9*)(r/OJg5GyC||~c]|{u7$4N,-?};');
define('AUTH_SALT',        'm2Y9y+VGf[#[$~X50Qw)HGZ/z2x%+L_x0PyZ^g#1w#GXNQ+b[uo(c^=2}N(I6L2A');
define('SECURE_AUTH_SALT', 'caCg^wOgOA-6SqQz_3OBWKZ]9$8,a9iKh|<0W@iX+<}unjydC1:Q4+>+(nUQFk{5');
define('LOGGED_IN_SALT',   'NjVJjwQo[(nxx&J5+2c2bi>uclp*`+hsQo--g5XeRc]z~{us$s7[[@;lkx8w@7gt');
define('NONCE_SALT',       'x*BG1TW-.xyo^/TcwBD8)C>?yy:;>H#7s%p{7PW3 jh%xQB|bN_8t$sQW7w{l?P`');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'ano_';

/**
 * Pour les développeurs : le mode deboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 */
define('WP_DEBUG', ENV === 'dev' ? true : false);
define('WP_DEBUG_LOG', true);
ini_set('error_log', dirname(__FILE__) . '/wp-content/debug.log'); /* path to server-writable log file */

if (defined('ENV') && ENV === 'dev') {
	define('FS_METHOD', 'direct');
}

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');