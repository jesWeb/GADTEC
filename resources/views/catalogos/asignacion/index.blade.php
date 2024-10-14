@extends('layouts.app')


@section('body')

<div class="container mt-5">
    <div class="mx-4 overflow-hidden rounded-lg shadow-lg md:mx-10">
        <table class="w-full table-fixed">
            <thead>
                <tr class="bg-gray-100">
                    <th class="w-1/4 px-6 py-4 font-bold text-left text-gray-600 uppercase">Name</th>
                    <th class="w-1/4 px-6 py-4 font-bold text-left text-gray-600 uppercase">Email</th>
                    <th class="w-1/4 px-6 py-4 font-bold text-left text-gray-600 uppercase">Phone</th>
                    <th class="w-1/4 px-6 py-4 font-bold text-left text-gray-600 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr>
                    <td class="px-6 py-4 border-b border-gray-200">John Doe</td>
                    <td class="px-6 py-4 truncate border-b border-gray-200">johndoe@gmail.com</td>
                    <td class="px-6 py-4 border-b border-gray-200">555-555-5555</td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <span class="px-2 py-1 text-xs text-white bg-green-500 rounded-full">Active</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 border-b border-gray-200">Jane Doe</td>
                    <td class="px-6 py-4 truncate border-b border-gray-200">janedoe@gmail.com</td>
                    <td class="px-6 py-4 border-b border-gray-200">555-555-5555</td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <span class="px-2 py-1 text-xs text-white bg-red-500 rounded-full">Inactive</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 border-b border-gray-200">Jane Doe</td>
                    <td class="px-6 py-4 truncate border-b border-gray-200">janedoe@gmail.com</td>
                    <td class="px-6 py-4 border-b border-gray-200">555-555-5555</td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <span class="px-2 py-1 text-xs text-white bg-red-500 rounded-full">Inactive</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 border-b border-gray-200">Jane Doe</td>
                    <td class="px-6 py-4 truncate border-b border-gray-200">janedoe@gmail.com</td>
                    <td class="px-6 py-4 border-b border-gray-200">555-555-5555</td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <span class="px-2 py-1 text-xs text-white bg-red-500 rounded-full">Inactive</span>
                    </td>
                </tr>
                <!-- Add more rows here -->
            </tbody>
        </table>
    </div>

</div>

@endsection
