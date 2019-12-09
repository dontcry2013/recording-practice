<?php 
	get_header();
	$post_id = get_the_ID();
    $custom_fields = get_post_custom($post_id);
    $next_post_id = $custom_fields["next_link"][0];
    if(!empty($next_post_id)){
    	$next_link = get_permalink($next_post_id);	
    }
?>

<style>
    .flex_center{
        display: -webkit-flex;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .outerborder{
        margin: 10px 0px;
        padding-bottom: 40px;
    }
    .cls_head{
        width:100%; 
        height: 42px; 
        margin: 8px;
        position: relative;    
    }
    .cls_head_btn{
        left: 0; 
        position: absolute; 
        height: 100%;
        width: 52px;
    }
    .panel i.glyphicon{
        font-size: 25px;
    }
    .cls_inline{
        display: inline-block;
    }
    .cls_inner_text{
        font-size: 30px;
        font-weight: bold;
    }
    .cls_inner_text_small{
        font-size: 23px;
        font-weight: bold;
    }
    #recordingslist audio{
        float: left;
        margin-right: 10px;
    }
    .wf{
        clear: both;
    }
    .cls_left_10{
        margin-left: 10px
    }
    #recordingslist > div{
        padding: 5px;
        margin-bottom: 10px;
    }
    #answer {
        /*height: 300px;*/
        resize: both;
        overflow: auto;
        white-space: pre-wrap;       /* Since CSS 2.1 */
        white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
        white-space: -pre-wrap;      /* Opera 4-6 */
        white-space: -o-pre-wrap;    /* Opera 7 */
        word-break: keep-all !important;
    }
    .mycenter {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translateX(-50%) translateY(-50%);
      -webkit-transform: translateX(-50%) translateY(-50%);
    }
    @media (max-width: 1024px) {
        .container{
            padding:0px !important;
        }
        .container_fluid{
            padding:0px !important;
        }
        .full-container{
            padding:0px !important;   
        }
        #main{
            padding:0px !important;   
        }
    }
</style>
<?php include("inc/recorder.js") ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.2.3/wavesurfer.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<!-- <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<!-- <div id="div_outer_most" class="flex_center"> -->
    <div class="container-fluid">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="cls_head" style="margin-top: 22px">
                    <a type="button" id="id_guide_btn" class="btn btn-danger cls_head_btn">
                        <i class="glyphicon glyphicon-question-sign"></i>
                    </a>
                    <div id="id_guide" class="cls_inline cls_inner_text" style="margin-left: 80px;"><?php echo $custom_fields['sp_title'][0] ?></div>
                </div>  
            </div>
            
            <div class="panel-body" style="background-color: rgb(221, 221, 221);">
                <div class="row" style="text-align: center">
                    <div>
                        <audio id="id_audio" controls="controls" src="<?php echo wp_get_attachment_url($custom_fields['sp_audio'][0]) ?>"></audio>
                    </div>
                    <div>
                        <a type="button" id="id_start_audio" class="btn btn-primary" onclick="document.querySelector('#id_audio').play();mAudio.ontimeupdate = undefined;">
                            开始
                        </a>
                        <a type="button" id="id_stop_audio" class="btn btn-primary" onclick="document.querySelector('#id_audio').pause();mAudio.ontimeupdate = timeUpateCb;">
                            停止
                        </a>
                    </div>
                </div>
                <br>
                <div class="col-lg-12 col-md-12">
                    <div style="text-align: center; vertical-align: middle;">
                        <div id="id_tip" style="display: inline-block;">
                            请准备
                        </div>
                        <div id="id_timer" style="display: inline-block;">
                            00:00
                        </div>
                    </div>
                    <div class="" style="text-align: center">
                        <a type="button" id="id_start_now" class="btn btn-primary">
                            立即开始
                        </a>
                        <a type="button" id="id_start_again" class="btn btn-primary">
                            重新开始
                        </a>
                        <a type="button" id="id_stop" class="btn btn-primary">
                            停止
                        </a>
                        <a type="button" class="btn btn-primary" onclick="return location.href = '<?php echo $next_link ?>';">
                            随机练习
                        </a>
                        <a type="button" class="btn btn-primary" onclick="return location.href = '<?php echo $next_link ?>';">
                            下一个练习
                        </a>
                    </div>
                    <blockquote style="font-size:12px;">全局快捷键：<b>空格</b>: 暂停／播放；<b>回车</b>：开始／结束录音；<b>shift</b>:播放最后一个录音；<b>左右方向键</b>：快退／快进；。
                    </blockquote>  
                </div>
                 <div>
                    <h2>Recordings</h2>
                    <div id="recordingslist"></div>
                </div>
                <div>
                    <h2>Whiteboard</h2>
                    <a type="button" class="btn btn-success" onclick="document.querySelector('#id_wb').style.display = document.querySelector('#id_wb').style.display == 'none'?'block':'none'">显示／隐藏</a>
                    <a type="button" type="button" class="btn btn-primary" onclick="var b = document.querySelector('#id_ta').getAttribute('spellcheck')=='false'?'true':'false'; document.querySelector('#id_ta').setAttribute('spellcheck', b)">添加／取消拼写检查</a>
                    <div id="id_wb" style="margin: 5px 0; display: none;">
                        <textarea id="id_ta" rows="24" spellcheck="false" style="width:100%;" onfocusin="focusFunction()" onfocusout="loseFunction()"> </textarea>
                    </div>
                </div>
                <div>
                    <h2>Answer</h2>
                    <pre id="answer" style="">
                        <?php echo $custom_fields['sp_text'][0] ?>;
                    </pre>
                </div>
                <div>
                    <h2>Log</h2>
                    <pre id="log"></pre>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->


<script>
    function __log(e, data) {
        log.innerHTML += "\n" + e + " " + (data || '');
    }
    var audio_context;
    var recorder, isRecording = false;
    function startUserMedia(stream) {
        var input = audio_context.createMediaStreamSource(stream);
        __log('Media stream created.');
        // Uncomment if you want the audio to feedback directly
        //input.connect(audio_context.destination);
        //__log('Input connected to audio context destination.');
        
        recorder = new Recorder(input);
        __log('Recorder initialised.');
    }
    function startRecording() {
        isRecording = true;
        recorder && recorder.record();
        __log('Recording...');
    }
    function stopRecording(cb) {
        isRecording = false;
        recorder && recorder.stop();
        __log('Stopped recording.');
        cb();
        recorder.clear();
    }
    var idx = 0;
    window.onload = function init() {
        try {
          // webkit shim
          window.AudioContext = window.AudioContext || window.webkitAudioContext;
          navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia;
          window.URL = window.URL || window.webkitURL;
          
          audio_context = new AudioContext;
          __log('Audio context set up.');
          __log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
        } catch (e) {
          alert('No web audio support in this browser!');
        }
        
        navigator.getUserMedia({audio: true}, startUserMedia, function(e) {
          __log('No live audio input: ' + e);
        });
    };

    var tipSrc = "https://www.zacqin.top/wp-content/uploads/2017/10/readygo.ogg";
    var tipAudio = new Audio(tipSrc);
    function playClip(startOffset, endOffset, playbackRate = 1, cbBefore, cbAfter) {
        // if(tipAudio.readyState != 4){
        //     return;
        // }
        var tipAudio = new Audio(tipSrc);
        tipAudio.onloadedmetadata = function() {
            this.playbackRate = playbackRate;
            this.currentTime = startOffset;
            cbBefore && cbBefore();
            this.play();
        };

        tipAudio.ontimeupdate = function() {
            if (this.currentTime >= endOffset) {
                endOffset = undefined; //防止timeupdate调用比pause快，从而使cb调用多次
                this.pause();
                this.onpause = function() {
                    cbAfter && cbAfter();
                };
            }
        };
    }
    function goSound(cb){
        playClip(1.5, 1.5+0.7, 1, undefined, cb);
    }
    function readySound(cb){
        playClip(.6, .6+.7, 1, undefined, cb);
    }
    function completeSound(cb){
        playClip(3, 3+.9, 1, cb);
    }
    

    var latestBigger, arrTime;
    var mAudio = document.querySelector('#id_audio');

    function findLatestBigger(arr, point){
        return arr.find(function(elem){
            return elem > point;
        });
    }
    
    <?php if (!empty($custom_fields['sp_time'][0])) { ?>
        arrTime = <?php echo $custom_fields['sp_time'][0] ?>;
        console.log(arrTime);
        latestBigger = arrTime[0];
        var timeUpateCb = function() {
            if (latestBigger && this.currentTime >= latestBigger) {
                this.pause();
                latestBigger = findLatestBigger(arrTime, mAudio.currentTime);
            }
        };
        mAudio.ontimeupdate = timeUpateCb;
        mAudio.onseeked = function() {
            latestBigger = findLatestBigger(arrTime, mAudio.currentTime);
        };
    <?php  } ?>

    var gap = 3;
    function rewind(audioElement) {
        // audioElement.playbackRate = -3.0;
        audioElement.currentTime -= gap; 
     }
    function fastforward(audioElement) {
        // audioElement.playbackRate = 3.0;
        audioElement.currentTime += gap;
    }

    var canResponse = true;
    var lastStopTime;
    function doc_keyDown(e) {
        console.log(e.keyCode);
        switch(e.keyCode){
            case 13: //enter
                if(!canResponse){
                    return false;
                }
                canResponse = false;
                setTimeout(function(){
                    canResponse = true;
                }, 1000);

                var bool = jQuery("#id_start_now").prop("disabled");
                console.log("是否禁用立刻开始按钮", bool);
                if(!bool){
                    goSound(function(){
                        jQuery("#id_start_now").trigger("click");
                    });
                } else{
                    completeSound(function(){
                        jQuery("#id_stop").trigger("click");
                    });
                }
                e.preventDefault();
            break;
            case 16: //shift
                var audio = jQuery("#recordingslist>div:last-child audio")[0];
                if(audio){
                    audio.paused ? audio.play() : audio.pause();
                }
                e.preventDefault();
            break;
            case 32: //space
                if(!mAudio){
                    mAudio = document.querySelector('#id_audio');
                }
                mAudio.paused ? mAudio.play() : mAudio.pause();
                e.preventDefault();
            break;
            case 37: //left
                rewind(mAudio);
                e.preventDefault();
            break;
            case 39: //right
                fastforward(mAudio);
                e.preventDefault();
            break;
            case 190: //>
                goSound(function(){
                    console.log("erere");
                });
                e.preventDefault();
            break;
            case 121: //f10
                if(!mAudio){
                    mAudio = document.querySelector('#id_audio');
                }
                
                if(mAudio.paused){
                    lastStopTime = mAudio.currentTime;
                    mAudio.play();
                } else{
                    mAudio.pause();
                }
                e.preventDefault();
            break;
            case 122: //f11
                if(!mAudio){
                    mAudio = document.querySelector('#id_audio');
                }
                mAudio.currentTime = lastStopTime;
                mAudio.play();
                e.preventDefault();
            break;
        }
        return false;
    }
    function doc_keyF10Down(e) {
        switch(e.keyCode){
            // case 37: //left
            //     rewind(mAudio);
            //     e.preventDefault();
            // break;
            // case 39: //right
            //     fastforward(mAudio);
            //     e.preventDefault();
            // break;
            case 121: //f10
                if(!mAudio){
                    mAudio = document.querySelector('#id_audio');
                }
                if(mAudio.paused){
                    lastStopTime = mAudio.currentTime;
                    mAudio.play();
                } else{
                    mAudio.pause();
                }
                e.preventDefault();
            break;
            case 122: //f11
                if(!mAudio){
                    mAudio = document.querySelector('#id_audio');
                }
                mAudio.currentTime = lastStopTime;
                mAudio.play();
                e.preventDefault();
            break;
        }
        
        return false;
    }
    document.addEventListener('keydown', doc_keyDown, false);
    function focusFunction(){
        document.removeEventListener('keydown', doc_keyDown, false);
        document.addEventListener('keydown', doc_keyF10Down, false);
    }
    function loseFunction(){
        document.removeEventListener('keydown', doc_keyF10Down, false);
        document.addEventListener('keydown', doc_keyDown, false);
    }

    jQuery(function($) {
        console.log(123);
        var myTimer, mDuration = 10, mPrepareDuration = 3, display = $("#id_timer");

        function startTimer(duration, display, cbBefore, cbAfter) {
            var timer = duration, minutes, seconds;
            var changeTag = function(){
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.text(minutes + ":" + seconds);
            }

            if(cbBefore){
                cbBefore();
            }
            changeTag();
            myTimer = setInterval(function () {
                --timer;
                changeTag();
                if (timer <= 0) {
                    clearInterval(myTimer);
                    if(cbAfter){
                        cbAfter();    
                    }
                }
            }, 1000);
        }

        var luyin = function(dur, dom){
            startTimer(dur, dom, function(){
                $("#id_tip").text("开始录音");
                startRecording(this);
            }, function(){
                $("#id_tip").text("录音结束");
                $("#id_start_now").prop("disabled", false);
                $("#id_start_again").prop("disabled", false);
                $("#id_stop").prop("disabled", false);
                stopRecording(function(){
                    createDownloadLink();
                });
            });
        }

        var start3Seconds = function(){
            startTimer(3, display, function(){
                $("#id_tip").text("请准备");
            }, function(){
                console.log("3秒播放完成");
                luyin(mDuration, display);
            });
        }

        // startTimer(mDuration, display, function(){

        // }, function(){
        //     luyin();
        // });

        var $w = 0;
        function showWave(a,d){
            var wav = $('div.wf', a.parentNode);
            if( !wav.length ){
                var id = 'wav_'+(++$w);
                wav = $(a.parentNode).append('<div class="wf" id="'+id+'"></div>');
                var txt = $(a).html();
                $(a).html('正在加载并绘制声音波形图');
                var ws = WaveSurfer.create({ container: '#'+id, waveColor: 'violet', progressColor: 'purple', scrollParent: true, fillParent: false}); 
                ws.on('ready', function () { $(a).html(txt); });
                var audio = $('audio', a.parentNode);
                audio.on('timeupdate', function(){
                    var wt = parseFloat(ws.getCurrentTime())||0;
                    var at = parseFloat(this.currentTime)||0;
                    ws.skip( at-wt );
                });
                ws.load(d || audio.attr('src'));
                wav.show();

                id = "slider"+$w;
                wav.append('<input class="sl" id="'+id+'" type="range" min="1" max="200" value="1" style="width: 50%" />');
                var slider = $("#"+id);
                slider[0].oninput = function () {
                  var zoomLevel = Number(this.value);
                  ws.zoom(zoomLevel);
                };
            }else{
                wav.toggle();
                $(a.parentNode.querySelector("input")).toggle();
            }
            return false;
        }

        function createDownloadLink() {
            idx++;
            recorder && recorder.exportWAV(function(blob) {
                var newWavesurfer;
                var url = URL.createObjectURL(blob);
                var dv = document.createElement('div');
                var au = document.createElement('audio');
                var mDownload = document.createElement('a');
                var mWave = document.createElement('a');
                var mUpload = document.createElement('a');
                var mDelete = document.createElement('a');

                au.controls = true;
                au.src = url;

                mDownload.href = url;
                mDownload.className += " btn btn-sm btn-default";
                mDownload.download = new Date().toISOString() + '.wav';
                mDownload.innerHTML = "下载";
                mWave.className += " btn btn-sm btn-success cls_left_10";
                mWave.innerHTML = "音波";
                mWave.id = "btn"+idx;
                mUpload.className += " btn btn-sm btn-primary cls_left_10";
                mUpload.innerHTML = "上传";
                mUpload.id = "upload"+idx;
                mDelete.className += " btn btn-sm btn-danger cls_left_10";
                mDelete.innerHTML = "删除";
                mDelete.id = "upload"+idx;

                dv.appendChild(au);
                dv.appendChild(mDownload);
                dv.appendChild(mWave);
                dv.appendChild(mUpload);
                dv.appendChild(mDelete);

                mWave.onclick = function(){
                    showWave(this);
                }

                mDelete.onclick = function(){
                    $(this.parentNode).remove();
                }

                recordingslist.appendChild(dv);
            });
        }

        $("#id_stop").click(function(){
            $("#id_tip").text("开始结束");
            $(this).prop("disabled", true);
            $("#id_start_now").prop("disabled", false);
            $("#id_start_again").prop("disabled", false);
            clearInterval(myTimer);
            if(isRecording){
                stopRecording(function(){
                    createDownloadLink();
                });
            }
        });
        $("#id_start_now").click(function(){
            $(this).prop("disabled", true);
            $("#id_stop").prop("disabled", false);
            $("#id_start_again").prop("disabled", false);
            clearInterval(myTimer);
            // start3Seconds();
            luyin(1200, display);
        });
        $("#id_start_again").click(function(){
            $(this).prop("disabled", true);
            $("#id_stop").prop("disabled", false);
            $("#id_start_now").prop("disabled", false);
            clearInterval(myTimer);
            
            startTimer(mDuration, display, function(){
                $("#id_tip").text("请准备");
            }, function(){
                luyin(mDuration, display);
            });
        });



    });










</script>

<?php 
get_footer();
/*
echo "<pre>";
var_dump($custom_fields);
echo $next_link;
echo wp_get_attachment_url($custom_fields['sp_audio'][0]);
echo "</pre>";
?>