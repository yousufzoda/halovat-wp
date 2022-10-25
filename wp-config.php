<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'komrony_w1' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'komrony_w1' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'p4HQ8SR6' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'y?Y*|g>z&UV`96&8qqWC0wAD`yIae{TQDY{s>eWp_-HQ;!)nm&4Qdq7TV62+B8&`' );
define( 'SECURE_AUTH_KEY',  'ALD$C/&7|5=]Gm,=dHAfFTnd,y-8{r5=|0eWx`i[cH7:-G~619vq(vj8ZO_XSmi?' );
define( 'LOGGED_IN_KEY',    'r/[pz[KlK !#)8vjzh~c{<N&qDQS#Fi=eLpo{qGRvJT1p>e];w,JEcTq*,6yGA5D' );
define( 'NONCE_KEY',        'nv[AVCQ8BChmtO@(FpY}4){%uQu;.hRqVlz;tYB1N!Lr*]f@CAG<$#FvS!^D% /1' );
define( 'AUTH_SALT',        'Z$l<ow5~{y<BYzH*Fy@0h&j%^bWE!cl_F9veY!$961v5b;YA$y;rVmiD]6E}4VP^' );
define( 'SECURE_AUTH_SALT', 'Io1EzX{Q&])A,C:%:2P{4f+3O%p~R@G)TqR:RCu12t%]iSy?x/@+A]f1{#h*)wx4' );
define( 'LOGGED_IN_SALT',   'jR@xR&urw[2R{8P1>/ >FAXYbg&ng~!11^~r=qxR91 BV$P|D.WkP]ND`oLML&Rm' );
define( 'NONCE_SALT',       '=7_E9@MuRz2}h:IrmvY([Sc?hz}`#,Nj0WUUZsT^{Dp5[`.3lo+w QJoZLsa4pL;' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );