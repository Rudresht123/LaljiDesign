
<select name="{{ $name ?? 'sub_status' }}" style=" text-transform: uppercase;" {{isset($required)? $required : ''}} class="{{ $class ?? 'form-select w-100' }}">
<option value="">Please Select</option>   
@foreach(substatus() as $substatus)
        <option value="{{ $substatus->id }}" 
            {{ isset($selectid) && $selectid == $substatus->id ? 'selected' : '' }}>
            {{ $substatus->substatus_name }}
        </option>
    @endforeach
</select>
