var placeSelected = "Albay";
$(document).ready(function()
{ 
    $("#dropdown-button").click(function(){
        $("#places-dropdown").slideToggle();
    });
    $('#profile-dropdown').click(function(){
        $("#user-dropdown").slideToggle();
    });
    $('#places-dropdown').on('click',function(e)
    {
            $('#topic').val($(e.target).text());
            $('#places-form').submit();
    });
    
    var passed = 'getId';
    $.post('ajax/set.php', {passed: passed}, function(data)  //user is what we're passing in, and usern is what php will reference it with.
    {                                                               //data there is what php will return or "echo"
        $('a#nav_name_user').text(data+' ');
        $('a#nav_name_user').append('<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>');
    });
});
