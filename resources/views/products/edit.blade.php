@extends('layouts.app')
@section('title', 'Edit Product')
@section('meta')
    <meta name="description" content="Edit product details in our inventory management system. Modify the product information including name, description, price, and stock.">
    <meta name="keywords" content="Edit Product, Inventory Management, Product Form">
@endsection
@section('content')
<div class="container">
    <h1>Edit Product</h1>

    <div id="surveyContainer"></div>

    <form id="productForm" method="POST" action="{{ route('products.update', $product->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" id="productData" name="productData" value='@json($product)'>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>

<script>
    // Get the product data from Blade
    const product = @json($product);

    // Define the survey JSON
    const surveyJSON = {
        title: "Edit Product Form",
        pages: [
            {
                elements: [
                    { name: "name", type: "text", title: "Product Name", isRequired: true, defaultValue: product.name },
                    { name: "description", type: "comment", title: "Description", defaultValue: product.description },
                    { name: "price", type: "text", inputType: "number", title: "Price", isRequired: true, defaultValue: product.price },
                    { name: "stock", type: "text", inputType: "number", title: "Stock", isRequired: true, defaultValue: product.stock }
                ]
            }
        ]
    };

    // Create the Survey model
    const survey = new Survey.Model(surveyJSON);

    // Handle survey completion
    survey.onComplete.add(function(result) {
        document.getElementById("productData").value = JSON.stringify(result.data);
    });

    // Render the survey
    document.addEventListener("DOMContentLoaded", function() {
        survey.render(document.getElementById("surveyContainer"));
    });
</script>
@endsection
