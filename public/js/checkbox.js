$(function(){
    $('.input-group-addon.beautiful').each(function () {

        var $widget = $(this),
            $input = $widget.find('input'),
            type = $input.attr('type');
        var settings = {
            checkbox: {
                true: { icon: 'fa fa-check-circle-o' },
                false: { icon: 'fa fa-circle-o' }
            },
            radio: {
                true: { icon: 'fa fa-dot-circle-o' },
                false: { icon: 'fa fa-circle-o' }
            }
        };

        $widget.prepend('<span class="' + settings[type].false.icon + '"></span>');

        $widget.on('click', function () {
            $input.prop('checked', !$input.is(':checked'));
            updateDisplay();
        });

        function updateDisplay() {
            var isChecked = $input.is(':checked') ? 'true' : 'false';
            $widget.find('.fa').attr('class', settings[type][isChecked].icon);
        }

        updateDisplay();
    });
});