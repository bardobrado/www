<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'wordpress_beta' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'rato' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', 'mmuniz20' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '}I6d%eGf,{({HDE>|^;,>oNRjmCNd0`:Sa0?jpup/FSWL>L!:Rzp<exc}2ph%}w(' );
define( 'SECURE_AUTH_KEY',  ']|u,4!jT#^1NYqQ/C$<Qyzpl7HQh1Pj9QlI_%bL[LMl9K+GffgK~w0ikxILPrW8h' );
define( 'LOGGED_IN_KEY',    'YpW>BwQ{7)jDN`Sb![.G%%oh6XArgpMwc{-@mSMypvC]@S!<Wy>4g_!!Oe|PL` S' );
define( 'NONCE_KEY',        '!?DAw.Rd&2w<_J},t9=]v&Bhu}KO9IeXkyIXuDMP4>(5rG-rW:X|kb]13pOVIjgZ' );
define( 'AUTH_SALT',        'mbBR)Y0?m>s?u1LjG_0SB|%nBj8R#lU_<y^+`v7><6T]bOv1aX5l~_?Nag3=@/1(' );
define( 'SECURE_AUTH_SALT', '=1eJQ)V`-.Qd>L>s<q.Uh@i0`N qw@!S ~iP&#t:p`#k>hLWCn!$pSIq:6Tr5DKx' );
define( 'LOGGED_IN_SALT',   '1^-qQL]g9z8VY]? 7?dQ^y3jus(Koe(4&0WI<wh<U_H>Y4IkPn@_]n6v8NvjZN+d' );
define( 'NONCE_SALT',       '&(v4Z;1z!Vm(QYFalw8-@~$RR#H?=A$+D-ar<Yo`-|sX-l%Y9D;A3e(B~S~4~[N<' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
