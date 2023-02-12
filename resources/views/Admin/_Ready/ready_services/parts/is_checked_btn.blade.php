<div
    class="form-check form-switch form-check-custom form-check-solid">

    <input class="form-check-input" name="is_active" type="hidden"
           value="inactive" id="flexSwitchDefault"/>
    <input
        class="form-check-input form-control form-control-solid mb-3 mb-lg-0"
        onchange="update_is_checked(this,'{{route('ready_services.change_is_checked')}}')"
        value="{{ $id }}" name="status" type="checkbox" @if($is_checked == 1) checked @endif
        id="flexSwitchDefault"/>
</div>
