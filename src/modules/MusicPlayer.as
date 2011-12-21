package modules
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.EventDispatcher;
	import flash.events.IEventDispatcher;
	import flash.events.MouseEvent;
	import flash.media.Sound;
	import flash.media.SoundChannel;
	import flash.media.SoundTransform;
	
	import spark.components.supportClasses.Range;

	public class MusicPlayer extends EventDispatcher
	{
		/**  */
		protected var _music : Sound;
		
		/**  */
		protected var _channel : SoundChannel;
		
		/**  */
		protected var _playing : Boolean;
		
		
		/**  */
		protected var _playButton : Sprite;
		
		/**  */
		protected var _pauseButton : Sprite;
		
		/**  */
		protected var _stopButton : Sprite;
		
		/**  */
		protected var _prevButton : Sprite;
		
		/**  */
		protected var _nextButton : Sprite;
		
		/**  */
		protected var _timeSlider : Range;
		
		/**  */
		protected var _volumeSlider : Range;
		
		
		public function set music( music : Sound ) : void
		{
			if( _playing ) stop();
			_music = music;
		}
		
		public function get music() : Sound
		{
			return _music;
		}
		
		public function set time( time : Sound ) : void
		{
			// pause() 코드는 play 함수 안에 구현되어있음.
			play( time );
			
			if( !_playing )
				pause();
		}
		
		public function get time() : int
		{
			return _channel.position;
		}
		
		public function set volume( volume : Number ) : void
		{
			var tempSoundTransform : SoundTransform = _channel.soundTransform;
			tempSoundTransform.volume = volume;
			_channel.soundTransform = tempSoundTransform;
		}
		
		public function get volume() : Number
		{
			return _channel.soundTransform.volume;
		}
		
		public function get playing() : Boolean
		{
			return _playing;
		}
		
		public function set playButton( playButton : Sprite ) : void
		{
			_playButton = playButton;
			_playButton.addEventListener( MouseEvent.CLICK, onPlayButtonClick );
		}
		
		public function get playButton() : Sprite
		{
			return _playButton;
		}
		
		public function set pauseButton( pauseButton : Sprite ) : void
		{
			_pauseButton = pauseButton;
			_pauseButton.addEventListener( MouseEvent.CLICK, onPauseButtonClick );
		}
		
		public function get pauseButton() : Sprite
		{
			return _pauseButton;
		}
		
		public function set stopButton( stopButton : Sprite ) : void
		{
			_stopButton = stopButton;
			_stopButton.addEventListener( MouseEvent.CLICK, onStopButtonClick );
		}
		
		public function get stopButton() : Sprite
		{
			return _stopButton;
		}
		
		public function set prevButton( prevButton : Sprite ) : void
		{
			_prevButton = prevButton;
			_prevButton.addEventListener( MouseEvent.CLICK, onPrevButtonClick );
		}
		
		public function get prevButton() : Sprite
		{
			return _prevButton;
		}
		
		public function set timeSlider( timeSlider : Sprite ) : void
		{
			_timeSlider = timeSlider;
			_timeSlider.addEventListener( Event.CHANGE, onTimeSliderValueChange );
		}
		
		public function get timeSlider() : Range
		{
			return _timeSlider;
		}
		
		public function set volumeSlider( volumeSlider : Sprite ) : void
		{
			_volumeSlider = volumeSlider;
			_volumeSlider.addEventListener( Event.CHANGE, onVolumeSliderValueChange );
		}
		
		public function get stopButton() : Range
		{
			return _stopButton;
		}
		
		
		/**
		 * Contructor.
		 */
		public function MusicPlayer()
		{
			
		}
		
		/**
		 * 
		 */
		public function play( time : int = 0 ) : void
		{
			if( _playing ) pause();
			_channel = _music.play( _time = time );
		}
		
		/**
		 * 
		 */
		public function pause() : void
		{
			_channel.stop();
			_time = _channel.position;
		}
		
		/**
		 * 
		 */
		public function stop() : void
		{
			pause();
			_time = 0;
		}
		
		/**
		 * 
		 */
		protected function onPlayButtonClick( e : MouseEvent ) : void
		{
			if( _playButton == _pauseButton )
			{
				
			}
		}
		
		/**
		 * 
		 */
		protected function onPauseButtonClick( e : MouseEvent ) : void
		{
			if( _playButton == _pauseButton )
			{
				
			}
		}
		
		/**
		 * 
		 */
		protected function onStopButtonClick( e : MouseEvent ) : void
		{
			
		}
		
		/**
		 * 
		 */
		protected function onPrevButtonClick( e : MouseEvent ) : void
		{
			
		}
		
		/**
		 * 
		 */
		protected function onNextButtonClick( e : MouseEvent ) : void
		{
			
		}
		
		/**
		 * 
		 */
		protected function onTimeSliderValueChange( e : Event ) : void
		{
			
		}
		
		/**
		 * 
		 */
		protected function onVolumeSliderValueChange( e : Event ) : void
		{
			
		}
	}
}