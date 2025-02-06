jQuery(document).ready(function ($) {
    $('.waveform-container').each(function () {
        var container = this;
        var audioUrl = $(container).data('audio-url');

        var wavesurfer = WaveSurfer.create({
            container: container,
            waveColor: 'white',
            progressColor: 'gray',
            height: 50, // Set the waveform height to 50px
            normalize: true, // Add this line to enable normalization
        });

        wavesurfer.load(audioUrl);

        var playPauseButton = $(container).closest('.audio-player-container').find('.waveform-play-pause');
        var icon = playPauseButton.find('i');

        playPauseButton.on('click', function () {
            wavesurfer.playPause();
            updateIcon();
        });

        wavesurfer.on('finish', function () {
            icon.removeClass('fa-pause').addClass('fa-play');
        });

        function updateIcon() {
            if (wavesurfer.isPlaying()) {
                icon.removeClass('fa-play').addClass('fa-pause');
            } else {
                icon.removeClass('fa-pause').addClass('fa-play');
            }
        }
    });
});
