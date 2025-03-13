

<select name="{{ $name ?? 'status' }}"  id="{{ $id ?? 'status' }}" style=" text-transform: uppercase;" {{isset($required)? $required : ''}} class="{{ $class ?? 'form-select w-100' }}"
    @if(isset($data))@foreach ($data as $key=>$value) data-{{$key}}="{{$value}}" @endforeach @endif
    >
    <option value="">Please Select</option>
    @foreach($statuss as $status)
    <option data-slug="{{$status->slug ?? ''}}" data-id="{{$status->id ??''}}" value="{{ $status->id }}"
        {{ isset($selectid) && $selectid == $status->id ? 'selected' : '' }}>
        {{ $status->status_name }}
    </option>
    @endforeach
</select>