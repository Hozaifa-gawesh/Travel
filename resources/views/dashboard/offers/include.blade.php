<div class="profile-sidebar sidebar_profile menu_product">
    <div class="portlet light profile-sidebar-portlet ">
        <div class="profile-usermenu">
            <ul class="nav">
                <li class="{{ Route::is('view-offer',$data->id) ? 'active' : '' }}">
                    <a href="{{ route('view-offer',$data->id) }}"><i class="icon-info"></i> {{ trans('lang.general') }}</a>
                </li>
                <li class="{{ Route::is('gallery-offer',$data->id) ? 'active' : '' }}">
                    <a href="{{ route('gallery-offer',$data->id) }}"><i class="icon-picture"></i> Gallery</a>
                </li>
                <li class="{{ Route::is('cities-offer',$data->id) ? 'active' : '' }}">
                    <a href="{{ route('cities-offer',$data->id) }}"><i class="icon-puzzle"></i> {{ trans('lang.cities') }}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
