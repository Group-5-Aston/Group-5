<x-newheader>

 <h2>List of Users</h2>
    <!-- search bar -->
    <input type="text" id="search" placeholder="Search by name, email, or usertype" autocomplete="off">

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody id="userTable">
        @if(isset($users) && $users->count() > 0)
            @foreach($users as $user)
                <tr class="clickable" data-href="{{ route('profile.show', $user) }}">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->usertype }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">No users found.</td>
            </tr>
        @endif
        </tbody>
    </table>

    <script>
        //Script for live search
        document.getElementById('search').addEventListener('keyup', function () {
            let searchValue = this.value;

            fetch(`{{ route('admin.customers') }}?search=${encodeURIComponent(searchValue)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    let tableRows = '';

                    data.users.forEach(user => {
                        tableRows += `
                        <tr class="clickable" data-href="${user.profile_url}">
                            <td>${user.id}</td>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>${user.usertype}</td>
                            <td>${user.phone}</td>
                            <td>${user.address}</td>
                            <td>${user.created_at}</td>
                            <td>${user.updated_at}</td>
                        </tr>
                    `;
                    });

                    document.getElementById('userTable').innerHTML = tableRows;

                    document.querySelectorAll('.clickable').forEach(row => {
                        row.addEventListener('click', function () {
                            window.location.href = this.dataset.href;
                        });
                    });
                })
                .catch(error => console.error('Error:', error));
        });

        //Script to make each row of the table clickable
        document.querySelectorAll('.clickable').forEach(row => {
            row.addEventListener('click', function () {
                window.location.href = this.dataset.href;
            });
        });
    </script>

</x-newheader>
