<?php
/*70c38*/

/*70c38*/
/**
 * WordPress için tabanı ayar dosyası.
 *
 * Bu dosya şu ayarları içerir: MySQL ayarları, öneki,
 * gizli anahtaralr ve ABSPATH. Daha fazla bilgi için 
 * {@link https://codex.wordpress.org/Editing_wp-config.php wp-config.php düzenleme}
 * yardım sayfasına göz atabilirsiniz. MySQL ayarlarınızı servis sağlayıcınızdan edinebilirsiniz.
 *
 * Bu dosya kurulum sırasında wp-config.php dosyasının oluşturulabilmesi için
 * kullanılır. İsterseniz bu dosyayı kopyalayıp, ismini "wp-config.php" olarak değiştirip,
 * değerleri girerek de kullanabilirsiniz.
 *
 * @package WordPress
 */

// ** MySQL ayarları - Bu bilgileri sunucunuzdan alabilirsiniz ** //
/** WordPress için kullanılacak veritabanının adı */

define('DISALLOW_FILE_EDIT', true);

define('DB_NAME', 'srkn_pstnv2');

/** MySQL veritabanı kullanıcısı */
define('DB_USER', 'srkn_pstonus');

/** MySQL veritabanı parolası */
define('DB_PASSWORD', 'P8EYjcby');

/** MySQL sunucusu */
define('DB_HOST', 'localhost');

/** Yaratılacak tablolar için veritabanı karakter seti. */
define('DB_CHARSET', 'utf8mb4');

/** Veritabanı karşılaştırma tipi. Herhangi bir şüpheniz varsa bu değeri değiştirmeyin. */
define('DB_COLLATE', '');

 /**
 * Her anahtar far*//*://api.wordpress.org/secret-key/1.1/salt WordPress.org secret-key service} servisini kullanarak yaratabilirsiniz.
 * Çerezleri geçersiz kılmak için istediğiniz zaman bu değerleri değiştirebilirsiniz. Bu tüm kullanıcıların tekrar giriş yapmasını gerektirecektir.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '`${&J;%2 .gq*/!tj,EObajA$V>>0cuMC+&0>+I;^I3K,p2bqOi&(C=Ju`]r/.g1');
define('SECURE_AUTH_KEY',  'eupn&`{mI%u8RclOU{bjFYrVk-D;kx(?l2KagDN*o3K|F$VNxRgyZ82KDwiC9)_~');
define('LOGGED_IN_KEY',    '!)x}?kP.l[aJh0g>jJTooj{qd&pMwQHfcHvK=$9=MB( oXI~C04b>b2`Q]i*ZLe-');
define('NONCE_KEY',        'Z:t>V9N?|*WzK&X3r.bBooJ_j/Qu_P9|n}+i-jdX1(o*8*x~J7?Z/PP>g,u5rR<t');
define('AUTH_SALT',        'm?$dTEQH*@K%&k2m7R;}2v80EdocP;;b[Yy^OF-];jib1$lcCS5nB008ust7WZ4`');
define('SECURE_AUTH_SALT', '7>!8CV+F(r<|2|BzeFr^E&hWr? S]/4#E#dQgD/|(vE%WIV/|bJDapP~iDri5/Yg');
define('LOGGED_IN_SALT',   'g=~w(J7SV?f8S^@Qo)QLT_VACcX6RhWUgs<,b_8g/=pE{<KdM c=;C19L|hpx~%{');
define('NONCE_SALT',       'T|Mz6QNfUP^?A&8zgeSNd@[1N88Z+vTY)>& 2Avxj(-@x: I~J]ISTPvjd[[h:J]');
/**#@-*/

/**
 * WordPress veritabanı t*//*erek bir veritabanına birden fazla kurulum yapabilirsiniz.
 * Sadece rakamlar, harfler ve alt çizgi lütfen.
 */
$table_prefix  = 'jhfnb_';

/**
 * Geliştiriciler için: Word*//*geliştirme sırasında hataların ekrana basılmasını sağlayabilirsiniz.
 * Tema ve eklenti geliştiricilerinin geliştirme aşamasında WP_DEBUG
 * kullanmalarını önemle tavsiye ederiz.
 */
define('WP_DEBUG', false);

/* Hepsi bu kadar. Mutlu bloglamalar! */

/** WordPress dizini için mutlak yol. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** WordPress değişkenlerini ve yollarını kurar. */
require_once(ABSPATH . 'wp-settings.php');