<div class="profile-sidebar sidebar_profile">
    <div class="portlet light profile-sidebar-portlet ">
        <div class="profile-userpic">
            <img src="{{ $data->image !== null ? asset('images/'.$data->image) : asset('images/user.png') }}" class="img-responsive" alt="{{ $data->username }}">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"> {{ $data->username }} </div>
        </div>
        <div class="profile-userbuttons">
            @if($data->pending == 1)
                <a href="{{ route('confirm-user', $data->id) }}" class="btn btn-circle btn-warning confirm-btn btn-sm"><i class="fa fa-check"></i> {{ __('lang.approve') }}</a>
            @endif
            @if($data->block == 1)
                <a href="{{ route('unblock-user', $data->id) }}" class="btn btn-circle main_icon f_white confirm-btn btn-sm"><i class="fa fa-check"></i> {{ __('lang.unblock') }}</a>
            @else
                <a href="{{ route('block-user', $data->id) }}" class="btn btn-circle confirm-btn black_icon f_white btn-sm"><i class="fa fa-ban"></i> {{ __('lang.block') }}</a>
            @endif
            <a href="{{ route('edit-user', $data->id) }}" class="btn btn-circle blue_icon f_white btn-sm"><i class="fa fa-edit"></i> {{ __('lang.edit') }}</a>
        </div>
        <div class="profile-usermenu">
            <ul class="nav">
                <li class="{{ Request::is('dashboard/users/'.$data->id.'/view') ? 'active' : '' }}">
                    <a href="{{ route('view-user', $data->id) }}">
                        <i class="icon-settings"></i> {{ __('lang.account') }}
                    </a>
                </li>
                <li class="{{ Request::is('dashboard/users/'.$data->id.'/addresses') ? 'active' : '' }}">
                    <a href="{{ route('addresses-user', $data->id) }}">
                        <i class="icon-pointer"></i> {{ __('lang.addresses') }}
                    </a>
                </li>
                <li class="{{ Request::is('dashboard/users/'.$data->id.'/favourites') ? 'active' : '' }}">
                    <a href="{{ route('favourites-user', $data->id) }}">
                        <i class="icon-heart"></i> {{ __('lang.favorites') }}
                    </a>
                </li>
                <li class="{{ Request::is('dashboard/users/'.$data->id.'/orders') ? 'active' : '' }}">
                    <a href="{{ route('orders-user', $data->id) }}">
                        <i class="icon-basket-loaded"></i> {{ __('lang.orders') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>