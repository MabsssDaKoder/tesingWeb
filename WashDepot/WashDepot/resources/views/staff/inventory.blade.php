@extends('staff.layout')

@section('title', 'Inventory')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/staff/inventory.css') }}">
@endsection

@section('content')
<h2 class="page-title">Inventory Management</h2>

<div class="inventory-card">

    <div class="inventory-toolbar">
        <input type="text" placeholder="Search item name..." class="search-input">
        <button class="btn-categories">Categories</button>
    </div>

    <table class="inventory-table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Categories</th>
                <th>Re-Order Point</th>
                <th>Stocks</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Downy - Passion</td>
                <td>Fabric Conditioner</td>
                <td>50</td>
                <td>40</td>
                <td><span class="status good">Good</span></td>
                <td><button class="btn-notify">Notify</button></td>
            </tr>
            <tr>
                <td>Tide</td>
                <td>Powdered Detergent</td>
                <td>60</td>
                <td>20</td>
                <td><span class="status reorder">Re-Order</span></td>
                <td><button class="btn-notify">Notify</button></td>
            </tr>
            <tr>
                <td><span class="alert-icon">!</span> Surf</td>
                <td>Powdered Detergent</td>
                <td>60</td>
                <td>0</td>
                <td><span class="status outofstock">Out of Stocks</span></td>
                <td><button class="btn-notify">Notify</button></td>
            </tr>
        </tbody>
    </table>

</div>
@endsection