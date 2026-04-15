
@extends('staff.layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Management - WashDepot</title>
    <link rel="stylesheet" href="{{ asset('css/admin/shop.css') }}">
</head>
<body>

    
    <div class="content">
        <div class="card">
            <h2>Shop Management</h2>

            <div class="sub-tabs">
                <span>Edit Shop Prices</span>
            </div>

            <div class="inner-card">
                <h3>Edit Shop Prices</h3>

                <form method="POST" action="/admin/shop/prices">
                    @csrf

                    <div class="field-row">
                        <label>Base Price :</label>
                        <input type="number" name="base_price" min="0">
                    </div>

                    <div class="field-row">
                        <label>Additional per Kg :</label>
                        <input type="number" name="additional_per_kg" min="0">
                    </div>

                    <div class="field-row">
                        <label>Base Kg :</label>
                        <input type="number" name="base_kg" min="0">
                    </div>

                    <div class="addons-box">
                        <h4>Custom/Add-Ons</h4>

                        <div class="addon-item">
                            <p>Powdered Soap</p>
                            <div class="addon-brand">
                                <span>Tide</span>
                                <input type="number" name="tide_price" min="0">
                            </div>
                        </div>

                        <div class="addon-item">
                            <p>Liquid Soap</p>
                            <div class="addon-brand">
                                <span>Surf</span>
                                <input type="number" name="surf_price" min="0">
                            </div>
                        </div>

                        <div class="addon-item">
                            <p>Fabric Conditioner</p>
                            <div class="addon-brand">
                                <span>Downy</span>
                                <input type="number" name="downy_price" min="0">
                            </div>
                        </div>

                    </div>

                    <div class="btn-row">
                        <button type="submit" class="btn-confirm">Confirm</button>
                        <button type="button" class="btn-cancel" id="cancelBtn">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin/shop.js') }}"></script>
</body>
</html>