import './bootstrap';

window.Echo.private(`App.Models.User.${UserId}`).notification(function(data){
    $('#notificationlist').prepend(`
    <li class="nav-item dropdown">

    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-bell"></i>
      <span id="newnotifications" class="badge badge-warning navbar-badge">{{$new}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-header">{{$new}}</span>
      <div class="dropdown-divider"></div>
      <a href="${data.url}? $notify_id =${data.id}" class="dropdown-item">
        <i class="fas fa-envelope mr-2"><
        ${data.body}
        <span class="float-right text-muted text-sm"> {{$notification->data['title']}}</span>
      </a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item">
        <i class="fas fa-users mr-2"></i> 8 friend requests
        <span class="float-right text-muted text-sm">12 hours</span>
      </a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item">
        <i class="fas fa-file mr-2"></i> 3 new reports
        <span class="float-right text-muted text-sm">2 days</span>
      </a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
  </li>`);
  let count =  Number ($('#newnotifications').text())
  count ++ ;

($('#newnotifications').text(count))
});


window.Echo.join(`messages.${userId}`).listen('.message.created',function(data){
    alert(data.message.message)
})



