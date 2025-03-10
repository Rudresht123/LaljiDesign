
<select name="{{ $name ?? 'trademark_class' }}" style=" text-transform: uppercase;" {{isset($required)? $required : ''}} class="{{ $class ?? 'form-select w-100' }}">
<option value="">Please Select</option>   
@foreach(ipclasses() as $ipclasse)
        <option value="{{ $ipclasse->id }}" 
            {{ isset($selectid) && $selectid == $ipclasse->id ? 'selected' : '' }}>
            {{ $ipclasse->class_name }}
        </option>
    @endforeach
</select>
