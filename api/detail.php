<?php
include 'curl.php';

$song_id = $_GET['song_id'];
$album_id = $_GET['album_id'];
if( !isset( $song_id ) )
{
	echo 'Invalid song_id.';
	return;
}

if( !isset( $album_id ) )
{
	echo 'Invalid album_id.';
	return;
}

$html_lyrics = file_get_contents_curl( 'http://m.music.daum.net/song/vcliplyrics?song_id='.$song_id );
$html_album = file_get_contents_curl( 'http://m.music.daum.net/album/main?album_id='.$album_id );

$res = array();
$title = get_title( $html_lyrics );
$res['title'] = urlencode( $title );
$res['artist'] = urlencode( get_artist( $html_album ) );
$res['album'] = urlencode( get_album( $html_album ) );
$res['cover_url'] = urlencode( get_cover_url( $html_album ) );
$res['lyrics'] = urlencode( get_lyrics( $html_lyrics ) );
$res['track'] = urlencode( get_track( $html_album, $title ) );
$res['total_track'] = urlencode( get_total_track( $html_album ) );

echo urldecode( json_encode( $res ) );

function get_title( $src )
{
	$title = split( '<h4 class="tit">', $src );
	$title = split( "\r\n", $title[1] );
	return $title[0];
}

function get_artist( $src )
{
	$artists = split( 'class="txt_artist">', $src );
	$len = count( $artists );
	$artist = '';
	for( $i = 1; $i < $len; $i++ )
	{
		$current_artist = split( '</a>', $artists[$i] );
		$artist .= $current_artist[0];
		
		if( $i < $len - 1 )
		{
			$artist .= ', ';
		}
	}
	
	return $artist;
}

function get_album( $src )
{
	$album = split( '<h4 class="tit">', $src );
	$album = split( '</h4>', $album[1] );
	return $album[0];
}

function get_cover_url( $src )
{
	$num = split( 'http://m1.daumcdn.net/cfile', $src );
	$num = split( '/', $num[1] );
	$id = split( '/C94x94/', $src );
	$id = split( '"', $id[1] );	
	return 'http://i1.daumcdn.net/cfile'.$num[0].'/S200x200/'.$id[0];
}

function get_lyrics( $src )
{
	$lyrics = split( '<p class="lyrics">', $src );
	$lyrics = split( '<br/>', $lyrics[1] );
	$lyrics = str_replace( "\r\n", '', $lyrics[0] );
	$lyrics = str_replace( '	', '', $lyrics );
	$lyrics = str_replace( '<br />', '\n', $lyrics );
	return $lyrics;
}

function get_track( $src, $title )
{
	$songs = split( '<span class="num_rank">', $src );
	$len = count( $songs );
	for( $i = 1; $i < $len; $i++ )
	{
		$song_title = split( '<strong class="tit">', $songs[$i] );
		$song_title = split( '</strong>', $song_title[1] );
//		echo 'song_title : '.$song_title[0].'<br />title_____ : '.$title.'<br />';
		
//		if( $song_title[0] == $title )
		if( strpos( $title, $song_title[0] ) > -1 )
		{
//			echo 'same!!<br />';
			$track = split( '</span>', $songs[$i] );
			return $track[0];
		}
	}
	
	return -1;
}

function get_total_track( $src )
{
	return count( split( '<span class="num_rank">', $src ) ) - 1;
}
?>
