"use strict";
(function($) {
    "use strict";
//Minimum and Maxium Date
$('#booking_date').datepicker({
    language: 'en',
    minDate: new Date(), // Now can select only dates, which goes after 
    autoClose: true,
    onSelect: function() {
        update_summary('booking_date');
    }
})
$('#return_date').datepicker({
    language: 'en',
    minDate: new Date(), // Now can select only dates, which goes after 
    autoClose: true,
    onSelect: function() {
        update_summary('return_date');
    }
})
$('.booking_date').find('span').on("click",function(){
    $('#booking_date').focus();
});
$('.return_date').find('span').on("click",function(){
    $('#return_date').focus();
});
$('#return_date').datepicker().on('changeDate',function(){
    
});
$('#booking_date').datepicker().on('changeDate',function(){
    
});
//Disable Days of week
    var disabledDays = [0, 6];

    $('#disabled-days').datepicker({
        language: 'en',
        onRenderCell: function (date, cellType) {
            if (cellType == 'day') {
                var day = date.getDay(),
                    isDisabled = disabledDays.indexOf(day) != -1;
                return {
                    disabled: isDisabled
                }
            }
        }
    })
})(jQuery);