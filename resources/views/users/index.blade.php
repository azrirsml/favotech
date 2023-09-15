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
                            <a href="{{ route('users.change_status', $user) }}" @class([
                                'btn btn-sm',
                                'btn-success' => $user->status != 'active',
                                'btn-danger' => $user->status == 'active',
                            ])>
                                {{ $user->status == 'active' ? 'Banned' : 'Active' }}
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-table>
    </x-card>
</x-app-layout>
