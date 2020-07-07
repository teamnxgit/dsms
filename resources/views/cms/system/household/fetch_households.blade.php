<option></option>
@foreach($households as $household)
    <option value="{{$household->id}}">{{$household->house_no}}</option>
@endforeach