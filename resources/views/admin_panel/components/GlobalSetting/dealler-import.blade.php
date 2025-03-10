
<select name="{{ $name ?? 'deal_with' }}" style=" text-transform: uppercase;" {{isset($required)? $required : ''}} class="{{ $class ?? 'form-select w-100' }}">
<option value="">Please Select</option>   
@foreach(deallers() as $dealler)
        <option value="{{ $dealler->id }}" 
            {{ isset($selectid) && $selectid == $dealler->id ? 'selected' : '' }}>
            {{ $dealler->dealler_name ?? '' }}
        </option>
    @endforeach
</select>
