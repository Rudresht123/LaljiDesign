@if($schoolname)
<table>
    <tr>
        <td colspan="{{$colspan}}">{{$schoolname}}</td>
    </tr>
    <tr>
        <td colspan="{{$colspan}}">{{$schooladdress}}</td>
    </tr>
</table>
@endif
<table>
    {!!html_entity_decode($data)!!}
</table>
