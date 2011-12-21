<?php
include 'curl.php';

$query = $_GET['query'];
$page = $_GET['page'];
if( !isset( $page ) )
	$page = 1;

$query = str_replace( ' ', '+', $query );

$url = 'http://m.music.daum.net/search/list?type=song&query='.$query.'&page_no='.$page;
$html = split( '<div class="wrap_cont">', file_get_contents_curl( $url ) );
$len = count( $html) - 1;
$res = array();
for( $i = 0; $i < $len; $i++ )
{
	$res[$i]['song_id'] = get_song_id( $html[$i + 1] );
	$res[$i]['album_id'] = get_album_id( $html[$i + 1] );
	$res[$i]['title'] = urlencode( get_title( $html[$i + 1] ) );
	$res[$i]['artist'] = urlencode( get_artist( $html[$i + 1] ) );
	$res[$i]['album'] = urlencode( get_album( $html[$i + 1] ) );
}

echo urldecode( json_encode( $res ) );

function get_song_id( $src )
{
	$song_id = split( '<div id="sId_', $src );
	$song_id = split( '"', $song_id[1] );
	return $song_id[0];
}

function get_album_id( $src )
{
	$album_id = split( 'album_id=', $src );
	$album_id = split( '"', $album_id[1] );
	return $album_id[0];
}

function get_title( $src )
{
	$title = split( '<strong class="tit">', $src );
	$title = split( '</strong>', $title[1] );
	
	return remove_bold_tag( $title[0] );
}

function get_artist( $src )
{
	$artist = split( '<span class="txt_info">', $src );
	$artist = split( '<span class="txt_bar">', $artist[1] );
	return remove_bold_tag( $artist[0] );
}

function get_album( $src )
{
	$album = split( '</span>', $src );
	return $album[2];
}

function remove_bold_tag( $src )
{
	$res = str_replace( '<b>', '', $src );
	$res = str_replace( '</b>', '', $res );
	return $res;
}
?>
