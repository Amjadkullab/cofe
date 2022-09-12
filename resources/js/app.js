import './bootstrap';

window.Echo.private(`App.Models.User.${UserId}`).notification(function(data){
    alert(data.body)

});




