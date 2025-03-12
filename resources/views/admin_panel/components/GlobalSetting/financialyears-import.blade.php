
<select name="{{ $name ?? 'sub_status' }}" style=" text-transform: uppercase;" {{isset($required)? $required : ''}} class="{{ $class ?? 'form-select w-100' }}">
<option value="">Please Select</option>   
@foreach(financialyears() as $financialyear)
        <option value="{{ $financialyear->id }}" 
            {{ isset($selectid) && $selectid == $financialyear->id ? 'selected' : '' }}>
            {{ $financialyear->financial_session }}
        </option>
    @endforeach
</select>
