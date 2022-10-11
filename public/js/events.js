(function ($) {

    $(document).ready(function() {

        function addRow(block) {
            let row = $(block.clone());
            row.find('input').attr('value', '');
            $(row).insertAfter(block);

            $('#post-form .faq-fields').each(function(index, el){
                $(el).find('input').each(function(){
                    let name = $(this).attr('name');
                    $(this).attr('name', name.replace(/\[(\d)\]/gm, '['+index+']'));
                })
            });


            return false
        }

        $('#post-form').on('click', 'button.btn-remove-row', function (){
            if ($('.input-add-remove-container').length == 1) {
                addRow($(this).parents('.form-group'))
            }
            $(this).parents('.form-group').remove();
            return false;

        })
        $('#post-form').on('click', 'button.btn-add-row', function (){
            addRow($(this).parents('.form-group'))
        })
    })

})(jQuery);
