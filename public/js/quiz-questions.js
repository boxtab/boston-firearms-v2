(function($){
    $(document).ready(function(){

        // Question list appearing fix
        $('.page-step').fadeIn();


        // Toolbar extra buttons
        var btnFinish = $('<button></button>').text('Finish')
            .addClass('btn btn-info')
            .on('click', onFinishClick);
        $("#quiz-wizard").on("showStep", onShowStepHandler);
        $("#quiz-wizard").on("leaveStep", onLeaveStepHandler);

        // SmartWizard initialize
        const quizWizard = $('#quiz-wizard').smartWizard({
            theme: 'progress',
            selected: quizParams.currentStep,
            backButtonSupport: false,
            autoAdjustHeight: false,
            enableURLhash: false,
            transition: {
                animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
                speed: '400', // Transion animation speed
            },
            toolbarSettings: {
                toolbarPosition: 'bottom', // none, top, bottom, both
                toolbarButtonPosition: 'center', // left, right, center
                showNextButton: false, // show/hide a Next button
                showPreviousButton: false, // show/hide a Previous button
                toolbarExtraButtons: []
            },
            anchorSettings: {
                anchorClickable: false, // Enable/Disable anchor navigation
                enableAllAnchors: false, // Activates all anchors clickable all times
                markDoneStep: true, // Add done state on navigation
                markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                removeDoneStepOnNavigateBack: false, // While navigate back done step after active step will be cleared
                enableAnchorOnDoneStep: false // Enable/Disable the done steps navigation
            }
        });

        $('.button-next').click(function (){
            quizWizard.smartWizard('next');
            return false;
        })
        $('.arrow-back').click(function (){
            quizWizard.smartWizard('prev');
            return false;
        })

        $('#quiz-wizard .button-finish').click(function (){
            stepFormProcess(quizParams.stepsCount-1, quizParams.stepsCount)
            return false;
        })
        function onLeaveStepHandler(e, anchorObject, currentStepIndex, nextStepIndex, stepDirection)
        {
            //console.log('onleave:', stepDirection);
            if (stepDirection == 'backward') {
                return true;
            }
            return stepFormProcess(currentStepIndex, nextStepIndex);
        }
        function stepFormProcess(currentStepIndex, nextStepIndex)
        {
            let $form = $('#step-' + (currentStepIndex+1) + ' form');
            if ($form.length == 1) {
                let selected = $form.find('input:checked').length == 1 || ($form.find('textarea').length == 1 && $form.find('textarea').val().length > 10);
                if (!selected) {
                    alert('Please, select answer')
                    return false;
                }
                let data = $form.serializeArray();
                data.push({name:'current_step', value:currentStepIndex})
                return sendRequest(quizParams.ajaxUrl, data);
            }
            return false;
        }
        function onShowStepHandler(e, anchorObject, stepNumber, stepDirection, stepPosition)
        {
            //console.log('onShow:', stepNumber);
            //fbq('trackCustom', 'Question'+(stepNumber+1)+'-Loaded');
        }
        function sendRequest(ajaxUrl,formData)
        {
            return new Promise((resolve, reject) => {
                // Ajax call to fetch your content
                $.ajax({
                    method  : "POST",
                    url     : ajaxUrl,
                    data    : formData,
                    dataType: 'json',
                    beforeSend: function( xhr ) {
                        // Show the loader
                        quizWizard.smartWizard("loader", "show");
                    }
                }).done(function( res ) {
                    console.log(res);
                    if (res.success) {
                        //fbq('trackCustom', 'Question'+res.currentStep+'-Submitted');
                    }
                    if (res.redirect) {
                        location.href = res.redirect;
                        resolve(false)
                    }
                    resolve(res.success);
                    // Hide the loader
                    quizWizard.smartWizard("loader", "hide");
                }).fail(function(err, textStatus, errorThrown) {
                    // Hide the loader
                    quizWizard.smartWizard("loader", "hide");
                    if (quizParams.failUrl) {
                        location.href = quizParams.failUrl;
                    }
                    // Reject the Promise with error message to show as content
                    reject( false );
                });

            });
        }

        function onFinishClick()
        {
            //console.log('Finish button Clicked');
        }

    });
})(jQuery)
