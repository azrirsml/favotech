<x-app-layout>
    <x-card title="Manage Users">
        <x-table>
            <x-slot:header>
                <th>ID</th>
                <th>User</th>
                <th>Roles</th>
                <th>Status</th>
                <th></th>
            </x-slot:header>

            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->roles()->pluck('name') }}</td>
                    <td>{{ $user->status }}</td>
                    <td>
                        <div class="btn btn-group">
                            @if ($user->status == 'active')
                                <a class="btn btn-primary btn-sm" href="{{ route('users.banned', $user) }}">Banned</a>
                            @else
                                <a class="btn btn-primary btn-sm" href="{{ route('users.unbanned', $user) }}">Unbanned</a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-table>
    </x-card>
</x-app-layout>
