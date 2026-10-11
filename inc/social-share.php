<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\ClCar_Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$url   = urlencode( get_permalink() );
$title = urlencode( get_the_title() );

$defaults = array (
	'facebook' => array(
		'url'  => "http://www.facebook.com/sharer.php?u=$url",
		'icon' => 'fa-brands fa-facebook-f',
	),
	'twitter'  => array(
		'url'  => "https://twitter.com/intent/tweet?source=$url&text=$title:$url",
		'icon' => 'fa-brands fa-x-twitter'
	),
	'linkedin' => array(
		'url'  => "http://www.linkedin.com/shareArticle?mini=true&url=$url&title=$title",
		'icon' => 'fa-brands fa-linkedin-in'
	),
	'pinterest'=> array(
		'url'  => "http://pinterest.com/pin/create/button/?url=$url&description=$title",
		'icon' => 'fa-brands fa-pinterest-p'
	),
	'tumblr'   => array(
		'url'  => "http://www.tumblr.com/share?v=3&u=$url &quote=$title",
		'icon' => 'fa-brands fa-tumblr'
	),
	'reddit'   => array(
		'url'  => "http://www.reddit.com/submit?url=$url&title=$title",
		'icon' => 'fa-brands fa-reddit-alien'
	),
	'vk'       => array(
		'url'  => "http://vkontakte.ru/share.php?url=$url",
		'icon' => 'fa-brands fa-vk'
	),
);

foreach ( $sharer as $key => $value ) {
	if ( !empty($value) ) {
		unset( $defaults[$value] );
	}
}

$sharers = apply_filters( 'rdtheme_social_sharing_icons', $defaults );
?>
<ul class="item-social">
    <?php foreach ( $sharers as $key => $sharer ): ?>
        <li class="social-<?php echo esc_attr( $key );?>">
			<a href="<?php echo esc_url( $sharer['url'] );?>" target="_blank"><i class="<?php echo esc_attr( $sharer['icon'] );?>"></i></a>
		</li>
    <?php endforeach; ?>
</ul>