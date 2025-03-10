
<select name="{{ $name ?? 'consultant' }}" style=" text-transform: uppercase;" {{isset($required)? $required : ''}} class="{{ $class ?? 'form-select w-100' }}">
<option value="">Please Select</option>   
@foreach(consultants() as $consultant)
        <option value="{{ $consultant->id }}" 
            {{ isset($selectid) && $selectid == $consultant->id ? 'selected' : '' }}>
            {{ $consultant->consultant_name }}
        </option>
    @endforeach
</select>
