
<select name="{{ $name ?? 'sub_status' }}" style=" text-transform: uppercase;" {{isset($required)? $required : ''}} class="{{ $class ?? 'form-select w-100' }}">
<option value="">Please Select</option>   
@foreach(subcategory() as $subcategory)
        <option value="{{ $subcategory->id }}" 
            {{ isset($selectid) && $selectid == $subcategory->id ? 'selected' : '' }}>
            {{ $subcategory->subcategory }}
        </option>
    @endforeach
</select>
