var audio_context;

function __log(e, data) {
  log.innerHTML += "\n" + e + " " + (data || '');
}

$(function() {

  try {
    // webkit shim
    window.AudioContext = window.AudioContext || window.webkitAudioContext;
    navigator.getUserMedia = ( navigator.getUserMedia ||
                     navigator.webkitGetUserMedia ||
                     navigator.mozGetUserMedia ||
                     navigator.msGetUserMedia);
    window.URL = window.URL || window.webkitURL;

    var audio_context = new AudioContext;
//    __log('Audio context set up.');
//    __log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
  } catch (e) {
    alert('No web audio support in this browser!');
  }

  $('.recorder .start').on('click', function() {
    $this = $(this);
    $recorder = $this.parent();

    navigator.getUserMedia({audio: true}, function(stream) {
      var recorderObject = new MP3Recorder(audio_context, stream, { statusContainer: $recorder.find('.status'), statusMethod: 'replace' });
      $recorder.data('recorderObject', recorderObject);

      recorderObject.start();
    }, function(e) { });
  });

  $('.recorder .stop').on('click', function() {
    $this = $(this);
    $recorder = $this.parent();

    recorderObject = $recorder.data('recorderObject');
    recorderObject.stop();

    recorderObject.exportMP3(function(base64_mp3_data) {
      var url = 'data:audio/mp3;base64,' + base64_mp3_data;
      var au  = document.createElement('audio');
//      upload(url);

//      var fd=new FormData();
//      fd.append("newwavfile.wav",url);


      au.controls = true;
      au.src = url;
      document.getElementById('audioclip').value = url;
      var fcau = document.createElement('audio');
      fcau.src = document.getElementById('audioclip').value;
        
      document.getElementById("submitrecording").style.display = "block";
      $recorder.append(au);

      recorderObject.logStatus('');
    });

  });

});