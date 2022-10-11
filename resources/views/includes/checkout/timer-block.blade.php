<div class="important double">
    <div class="text">
        Due to high demand, <br>
        your spot is reserved for :
    </div>
    <div class="time">
        {{ $startTime?? '05:00' }}
    </div>
</div>

@push('footer-inline-scripts')
<script type="text/javascript">
    (function($){
        $(document).ready(function (){
            /*if ($('#reserved-timer').length) {
                let timerStart = parseInt($('#reserved-timer').val());
                startTimer(!isNaN(timerStart) ? timerStart : 300, $('div.time'))
            }*/
            let timerStart = 300
            startTimer(!isNaN(timerStart) ? timerStart : 300, $('div.time'))
            function startTimer(duration, display) {
                let timer = duration, minutes, seconds;

                let interval = setInterval(function () {
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    $(display).text(minutes + ":" + seconds);
                    //$('#reserved-timer').val(timer)
                    if (--timer < 0) {
                        //$('#reserved-timer').val(0)
                        clearInterval(interval)
                        $(display).text('Expired');
                    }
                }, 1000);
            }
        })
    })(jQuery)
</script>
@endpush
