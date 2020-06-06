URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var rec; 							//Recorder.js object
var input; 							//MediaStreamAudioSourceNode we'll be recording
let counterClick = 0;

var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record

var recordButton = document.getElementById("recordButton");

recordButton.addEventListener("mousedown", startRecording);
recordButton.addEventListener("mouseup", stopRecording);

function startRecording() {
    var constraints = { audio: true, video:false }

    // Show Record Info Block
    document.getElementById('record_information').classList.remove('hide');

    recordButton.disabled = false;

    navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
        if (counterClick) {
            audioContext = new AudioContext();

            gumStream = stream;

            input = audioContext.createMediaStreamSource(stream);

            rec = new Recorder(input, {numChannels: 1})

            //start the recording process
            rec.record()

            setInterval(function () {
                if (rec.recording) {
                    let record_time = document.getElementById('record_time');
                    let record_bits = document.getElementById('record_bits');
                    record_time.innerText = Math.round(audioContext.currentTime) + 'sec';
                    record_bits.innerText = Math.ceil(parseInt(record_time.innerText) / 30) * 100 + ' bits';

                    if (parseInt(record_time.innerText) > 30) {
                        record_time.style.color = 'darkred';
                        record_time.style.fontWeight = 'bold';
                    }
                }
            }, '1000');
        }

        counterClick++;
    }).catch(function(err) {
        recordButton.disabled = false;
    });
}

function pauseRecording(){
    if (counterClick) {
        if (rec.recording) {
            //pause
            rec.stop();
            pauseButton.innerHTML = "Resume";
        } else {
            //resume
            rec.record()
            pauseButton.innerHTML = "Pause";

        }
    }
}

function stopRecording() {
    if (counterClick) {
        console.log("stopButton clicked");

        recordButton.disabled = false;

        rec.stop();

        gumStream.getAudioTracks()[0].stop();

        rec.exportWAV(createDownloadLink);
    }
}

function createDownloadLink(blob) {
    let url = URL.createObjectURL(blob);
    let au = document.createElement('audio');
    let div = document.createElement('div');
    let filename = new Date().toISOString() + sendingData.thread_id + '_' + sendingData.user_id;

    au.controls = true;
    au.src = url;

    div.appendChild(au);

    let xhr = new XMLHttpRequest();
    let fd = new FormData();
    fd.append("audio_data", blob, filename);
    xhr.open("POST", upload_file,true);
    xhr.onload=function(e) {
        if(this.readyState === 4) {
            sendingData.audio = filename + ".wav";
            sendingData.timing = document.getElementById('record_time').innerText;
        }
    };
    xhr.send(fd);

    //add the li element to the ol
    recordingsList.innerHTML = "";
    recordingsList.appendChild(div);
}