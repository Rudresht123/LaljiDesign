<select  name="{{ $name ?? 'attorney_id' }}" {{isset($required)? $required : ''}} class="{{ $class ?? 'form-select w-100' }}">
<option  value="">Please Select</option>  
@foreach(attorneys() as $attorney)
        <option value="{{ $attorney->id }}" 
            {{ isset($selectid) && $selectid == $attorney->id ? 'selected' : '' }}>
            {{ $attorney->attorneys_name }}
        </option>
    @endforeach
</select>
