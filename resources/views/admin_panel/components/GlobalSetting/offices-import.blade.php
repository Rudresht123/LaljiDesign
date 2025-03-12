
<select name="{{ $name ?? 'sub_status' }}" style=" text-transform: uppercase;" {{isset($required)? $required : ''}} class="{{ $class ?? 'form-select w-100' }}">
<option value="">Please Select</option>   
@foreach(offices() as $office)
        <option value="{{ $office->id }}" 
            {{ isset($selectid) && $selectid == $office->id ? 'selected' : '' }}>
            {{ $office->office_name }}
        </option>
    @endforeach
</select>
