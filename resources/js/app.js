import './bootstrap';

(function ($) {

    let $initialPrice = parseInt($('#initialPrice').text().slice(1));
    let $calculatedPrice = $initialPrice;

    function priceAdjustment(ammount = 0, type = 'add') {
        let ammountParsed = parseInt(ammount);

        if (type == 'add') {
            $calculatedPrice = $calculatedPrice + ammountParsed;
        } else {
            $calculatedPrice = $calculatedPrice - ammountParsed;
        }

        $('#initialPrice strong').text('R' + $calculatedPrice + '.00');
    }

    $(document).ready(function () {

        $('#funeral_cover, #sms_confirmation').on('change', function (event) {
            if ($(event.target).is(":checked")) {
                priceAdjustment($(event.target).data('ammount-change'));
            } else {
                priceAdjustment($(event.target).data('ammount-change'), 'subtract');
            }
        });

    });
})(jQuery);
