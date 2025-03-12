
<select name="{{ $name ?? 'category_id' }}"  style=" text-transform: uppercase;" {{isset($required)? $required : ''}} class="{{ $class ?? 'form-select w-100' }}"
@if(isset($data))@foreach ($data as $key=>$value) data-{{$key}}="{{$value}}" @endforeach @endif
>
<option value="">Please Select</option>    
@foreach(categories() as $category)
        <option value="{{ $category->id }}" 
            {{ isset($selectid) && $selectid == $category->id ? 'selected' : '' }}>
            {{ $category->category_name }}
        </option>
    @endforeach
</select>
