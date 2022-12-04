<nav class="menu">
    <ul class="items">
        <a href="{{route('home')}}" style="color: white">
            <li class="item">
                <i class="fa fa-home" aria-hidden="true"></i>
            </li>
        </a>
        <a target="_blank" href="{{route('profile.edit')}}" style="color: white">
            <li class="item ">
                <i class="fa fa-edit" aria-hidden="true"></i>
            </li>
        </a>
        <a href="{{route('users')}}" style="color: white">
            <li class="item  {{ ((request()->is('users')) == 1) ? 'item-active' : '' }}">
                <i class="fa fa-user" aria-hidden="true"></i>
            </li>
        </a>
        <a href="{{route('inbox')}}" style="color: white">
            <li class="item {{ ((request()->is('inbox')) == 1) ? 'item-active' : '' }}">
                <i class="fa fa-inbox" aria-hidden="true"></i>
            </li>
        </a>
        <a href="{{route('archive')}}" style="color: white">
            <li class="item {{ ((request()->is('archive')) == 1) ? 'item-active' : '' }}">
                <i class="fa fa-archive" aria-hidden="true"></i>
            </li>
        </a>

    </ul>
</nav>
