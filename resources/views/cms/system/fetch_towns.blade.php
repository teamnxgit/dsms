@foreach($towns as $town)
    <option value="{{$town->id}}">{{$town->name}}</option>
@endforeach