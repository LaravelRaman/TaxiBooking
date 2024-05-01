'use strict';
$('.clockpicker').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true,
    container: 'body'
}).find('input').change(function(){
    console.log(this.value);
});

if (/Mobile/.test(navigator.userAgent)) {
    $('.clockpicker').clockpicker()
        .find('input').prop('readOnly', true);
}