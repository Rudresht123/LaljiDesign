
<select name="{{ $name ?? 'status' }}" style=" text-transform: uppercase;" {{isset($required)? $required : ''}} class="{{ $class ?? 'form-select w-100' }}"
@if(isset($data))@foreach ($data as $key=>$value) data-{{$key}}="{{$value}}" @endforeach @endif
>
<option value="">Please Select</option>   
@foreach(status() as $status)
        <option value="{{ $status->id }}" 
            {{ isset($selectid) && $selectid == $status->id ? 'selected' : '' }}>
            {{ $status->status_name }}
        </option>
    @endforeach
</select>
