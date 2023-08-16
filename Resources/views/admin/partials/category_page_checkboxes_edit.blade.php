<hr>
<div class="form-group">
    <label class="control-label col-md-3">{{ __('onehotel::admin.active_reservation_btn') }}:</label>
    <div class="col-md-6">
        <label class="switch pull-left">
            <input type="checkbox" name="with_reservation_btn" class="success" data-size="small" @if(old('with_reservation_btn') || (isset($model) && $model->with_reservation_btn))
                {{ 'checked' }}
                @else
                {{ 'active' }}
                @endif>
            <span class="slider"></span>
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">{!! __('onehotel::admin.360_panorama_btn') !!}:</label>
    <div class="col-md-6">
        <label class="switch pull-left">
            <input type="checkbox" name="with_tour_btn" class="success" data-size="small" @if(old('with_tour_btn') || (isset($model) && $model->with_tour_btn))
                {{ 'checked' }}
                @else
                {{ 'active' }}
                @endif>
            <span class="slider"></span>
        </label>
    </div>
</div>
