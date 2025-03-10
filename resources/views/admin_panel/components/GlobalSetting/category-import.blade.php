
<select name="{{ $name ?? 'category_id' }}" style=" text-transform: uppercase;" {{isset($required)? $required : ''}} class="{{ $class ?? 'form-select w-100' }}">
<option value="">Please Select</option>    
@foreach(categories() as $category)
        <option value="{{ $category->id }}" 
            {{ isset($selectid) && $selectid == $category->id ? 'selected' : '' }}>
            {{ $category->category_name }}
        </option>
    @endforeach
</select>
