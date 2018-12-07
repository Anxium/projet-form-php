$(document).ready(function(){
    $('select').formSelect(); // affiche le select

    $('select').on('change', function() {
        if ($(this).val().length >= 4) {
            $(this).val($(this).data('value'));
            alert('Vous ne pouvez séléctionner que 3 sujets maximum.')
            $('select').formSelect();
        } else {
            $(this).data('value', $(this).val());
        }
    });
});