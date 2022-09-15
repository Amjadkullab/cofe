<ul id="notificationlist">
    @foreach ($notifications as $notification )

    <li class="nav-item dropdown">

        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span id="newnotifications" class="badge badge-warning navbar-badge">{{$new}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">{{$new}}</span>
          <div class="dropdown-divider"></div>
          <a href="{{$notification->data['url']}} ? $notify_id ={{$notification->id}}" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i>
            @if($notification->unread())
            <strong>*</strong>
            @endif
            {{$notification->data['body']}}
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
      </li>


    @endforeach


</ul>
