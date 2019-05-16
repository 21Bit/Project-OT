<div class="form-group">
	<div class="row">
        <div class="col-sm-3 col-xs-12"> 
        	 <label for="{{ $field['name'] }}"> @lang('label.'. snake_case($field['label']))</label><br>
        	<small>
        		@if($field['description']) @lang('label.'. snake_case($field['description'])) @endif
        	</small>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="{{ $field['type'] }}"
           name="{{ $field['name'] }}"
           min="{{ $field['min'] }}"
           max="{{ $field['max'] }}"
           value="{{ old($field['name'], \setting($field['name'])) }}"
           class="form-control {{ array_get( $field, 'class') }}"
           id="{{ $field['name'] }}"
           placeholder="@lang('label.'. snake_case($field['label']))">
        </div>
    </div>
</div>
<br>
