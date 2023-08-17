@php use App\Helpers\WebsiteHelper;use Illuminate\Http\Request; @endphp
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="oneHotel" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseOneHotel" aria-expanded="false" aria-controls="collapseRetailObjectsRestaurant">
        <h4 class="panel-title">
            <a>
                <i class="fas fa-hotel"></i> <span>{{ __('onehotel::admin.hotel') }}</span>
            </a>
        </h4>
    </div>
    <div id="collapseOneHotel" class="panel-collapse collapse" role="tabpanel" aria-labelledby="oneHotel">
        <div class="panel-body">
            <ul class="nav">
                <li><a href="{{ route('admin.retail-objects-restaurants.index') }}" class="{{ WebsiteHelper::isActiveRoute('admin.retail-objects-restaurants.*') ? 'active' : '' }}"><i class="fas fa-copyright"></i> <span>Заетост на стаи</span></a></li>
                <li><a href="{{ route('admin.retail-objects-restaurants.settings.index') }}" class="{{ WebsiteHelper::isActiveRoute('admin.retail-objects-restaurants.settings.*') ? 'active' : '' }}"><i class="fas fa-cogs"></i> <span>{{ __('onehotel::admin.settings.index') }}</span></a></li>
            </ul>
        </div>
    </div>
</div>
