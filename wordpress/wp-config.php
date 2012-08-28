<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'ecomania');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'root');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'NKUI,nIp+(V[HPO>KMBc]C`:p.TTgiPf@or#8{izT8Vl5g9>Q)1ExpBTJQP/rH?C'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', 'L*.cC_wdK>H2Gm4rH [i~_ExL,Q!Qt&$,a2COOnR:+pmJwcPL+6N8Su<k=56Q_ S'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', '^#]Pj@H7p9TX2qV8Gue3N9m5$/q!pONtZ@-2;bi|v,nlBnE1U17IKrzPJmkR&Su<'); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', '6#UifB-!s7%U_/LTJcv=.X0P],R( v_)EBnb2g7ZB!xO}hZ_w!fNV]{(hx;kIi~)'); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', '_t^_Po5xpf9:(z){Szs;-^BF//#`>]*@wO-Jgy@r*s=K+>o{|J<[*=fC}sUWkyN '); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', 'm.M,Yms;-;[a?:du@?5|7H#>g_L92emZ-#n#%2>YG,0}}+e2Zh168|{gA]&;&mQ)'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', '9LBBr.Ypy=!2^y|#ZV_T9G5>]subLI}sWd.Kgo@BX<DHiH,|kpj76NJQa_Di6@Wx'); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', 'K+zrfH[M=<fF=OXdNr_<,|2vO_P&R1=VP;9YY+sosWuKLQcY2kSMeQTa$W?87?KL'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';

/**
 * Idioma de WordPress.
 *
 * Cambia lo siguiente para tener WordPress en tu idioma. El correspondiente archivo MO
 * del lenguaje elegido debe encontrarse en wp-content/languages.
 * Por ejemplo, instala ca_ES.mo copiándolo a wp-content/languages y define WPLANG como 'ca_ES'
 * para traducir WordPress al catalán.
 */
define('WPLANG', 'es_ES');

/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

