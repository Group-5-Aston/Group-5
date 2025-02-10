<p>User ID: {{$user->id}}</p>
<form method="POST" action="">
    @csrf
    @method('PATCH')
    <input type="text" name="name" value="{{$user->name}}">
<input type="text" name="email" value="{{$user->email}}">
<input type="text" name="phone" value="{{$user->phone}}">
<input type="text" name="address" value="{{$user->address}}">
<input type="submit" value="edit">
</form>
<button type="button">Delete Account</button>

<h1>Orders</h1>
<p>This users orders will show here when the orders table is functional</p>


