$('document').ready(function() {
    $('#edit-field-match-result-0-value-wrapper').appendTo($('#edit-field-match-status-value-wrapper'));

    $('#edit-field-match-status-value').change(function() {
       if($(this).val() == 'Complete') {
           $('#edit-field-match-result-0-value-wrapper').slideDown('slow');
       }
       else {
           $('#edit-field-match-result-0-value-wrapper').slideUp('slow');
       }
    });

    $('#edit-field-match-status-value').change();
    
    //$("select#edit-field-players-club-nid-nid").val(Drupal.settings.team_id);
    if (Drupal.settings.team_id > 1)
    $("select#edit-field-players-club-nid-nid").attr("disabled", "disabled");

   // alert(Drupal.settings.team_id);
});