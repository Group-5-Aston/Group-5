<p>User ID: {{$user->id}}</p>

<form method="POST" action="{{ route('adminprofile.edit', ['user' => $user->id] )}}">
    @csrf
    @method('PATCH')
    <fieldset @if($user->usertype === 'admin') disabled @endif>
        <input type="text" name="name" value="{{$user->name}}">
        <input type="text" name="email" value="{{$user->email}}">
        <input type="text" name="phone" value="{{$user->phone}}">
        <input type="text" name="address" value="{{$user->address}}">
        <input type="submit" value="edit">
    </fieldset>
</form>

<form method="POST" action="{{ route('adminprofile.destroy', ['user'=>$user->id]) }}">
    @csrf
    @method('DELETE')
    <fieldset @if($user->usertype === 'admin') disabled @endif>
        <input type="submit" value="delete">
    </fieldset>
</form>
<h1>Orders</h1>
<p>This users orders will show here when the orders table is functional</p>


